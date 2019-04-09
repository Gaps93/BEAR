#!/usr/bin/python3

import socket, os, json
import urllib
from urllib.parse import urlparse
from http.server import BaseHTTPRequestHandler, HTTPServer
import time
from io import BytesIO

hostName = ""
hostPort = 8000

class SimpleHTTPRequestHandler(BaseHTTPRequestHandler):
	
	def do_GET(self):
		self.send_response(200)
		self.end_headers()
		self.wfile.write("Hello, world!")
	
	def do_POST(self):
		content_length = int(self.headers['Content-Length'])
		body = self.rfile.read(content_length)
		
		chaine=body.decode()
		datas_rcv=json.loads(chaine)
		
		if os.path.isfile('/tmp/datas.json'):
			with open('/tmp/datas.json','r+') as f:
				datas_file=json.load(f)
			exist=False
			mac=""
			for macF in datas_file:
				for macR in datas_rcv:
					mac=macR
					if macF == macR: # Si ce MAC existe déjà dans le json
						datas_file[macF] = datas_rcv[macR] # On met à jour ses données
						exist=True
						
			if not exist: # Si le MAC n'existe pas
				datas_file[mac] = datas_rcv[mac]
			
			f=open('/tmp/datas.json','w+')
			f.write(json.dumps(datas_file, indent=4))
			f.close()			
		else:
			with open('/tmp/datas.json','w') as f:
				f.write(json.dumps(datas_rcv, indent=4))
				
				

httpd = HTTPServer((hostName, hostPort), SimpleHTTPRequestHandler)
print(time.asctime(), "Server Starts - %s:%s" % (hostName, hostPort))
httpd.serve_forever()
