#!/usr/bin/python3

import os, json, time
from http.server import BaseHTTPRequestHandler, HTTPServer

hostName = ""
hostPort = 8000

class SimpleHTTPRequestHandler(BaseHTTPRequestHandler):
	
	def do_GET(self):
		self.send_response(200)
		self.end_headers()
		self.wfile.write("Hello, world!")
	
	def do_POST(self):
		content_length = int(self.headers['Content-Length'])	# On récupère les données reçues
		body = self.rfile.read(content_length)				# body contient les données reçues
		
		chaine=body.decode()				# chaine décode les données JSON
		datas_rcv=json.loads(chaine)			# on converti en dictionnaire python les données JSON reçues
		
		if os.path.isfile('/tmp/datas.json'):		# Si le fichier datas.json existe déjà
			with open('/tmp/datas.json','r+') as f:		
				datas_file=json.load(f)		# On converti en dictionnaire les données du fichier déjà existant
			exist=False
			mac=""
			for macF in datas_file:			# Pour chaque @MAC (PC) dans le fichier
				for macR in datas_rcv:		# Pour chaque @MAC (PC) reçu
					mac=macR
					if macF == macR: # Si ce MAC existe déjà dans le fichier json
						datas_file[macF] = datas_rcv[macR] # On met à jour les données pour ce MAC
						exist=True
						
			if not exist: # Si le MAC n'existe pas
				datas_file[mac] = datas_rcv[mac]	# On crée une nouvelle entrée pour ce PC
			
			f=open('/tmp/datas.json','w+')
			f.write(json.dumps(datas_file, indent=4))	# On converti le dictionnaire en données en JSON dans datas.json
			f.close()			
		else:					# Si le fichier datas.json n'existe pas
			with open('/tmp/datas.json','w') as f:
				f.write(json.dumps(datas_rcv, indent=4))	# On rajoute les données reçues dans le fichier datas.json
				
				

httpd = HTTPServer((hostName, hostPort), SimpleHTTPRequestHandler)		# On crée le serveur
print(time.asctime(), "Server Starts - %s:%s" % (hostName, hostPort))
httpd.serve_forever()				# On fait tourner le serveur
