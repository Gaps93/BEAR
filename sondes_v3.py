#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import os
import json
import requests
from requests.auth import HTTPBasicAuth

#Definition des sondes

def nom_machine():
    process = os.popen("hostname")
    nom = process.read()
    process.close()
    return nom.rstrip()

def memoire_dispo():
    process = os.popen("cat /proc/meminfo | grep 'MemFree' | awk ' {print $2,$3} '")
    dispo = process.read()
    process.close()
    return dispo.rstrip()

def adresse_mac():
	process = os.popen("/sbin/ifconfig | head -1 | grep HWaddr | awk '{ print $5 }'")
	mac = process.read()
	mac = mac.rstrip()
	process.close()
	if mac == "":
		process = os.popen("/sbin/ifconfig | head -1 | grep ether | awk '{ print $2 }'")
		mac = process.read()
		process.close()
	return mac.rstrip()

def memoire_total():
    process = os.popen("cat /proc/meminfo | grep 'MemTotal' | awk ' {print $2,$3} '")
    total = process.read()
    process.close()
    return total.rstrip()

def nom_processeur():
    process = os.popen("cat /proc/cpuinfo | grep 'model name' | tail -n 1 | cut -d':' -f2")
    nom_proc = process.read()
    process.close()
    return nom_proc.rstrip()

def nom_graphique():
    process = os.popen("lspci| grep VGA | cut -d':' -f3")
    nom_graph = process.read()
    process.close()
    return nom_graph.rstrip()

def temps_actif():
    process = os.popen("uptime | awk ' { print $3 }' |cut -d',' -f1")
    temps = process.read()
    process.close()
    return temps.rstrip()

def disk_max():
    process = os.popen("df -h | grep -w '/' | awk ' { print $2 }'")
    max = process.read()
    process.close()
    return max.rstrip()

def disk_dispo():
    process = os.popen("df -h | grep -w '/'| awk ' { print $4 }'")
    dispo = process.read()
    process.close()
    return dispo.rstrip()

def test_ping():
    process = os.popen("ping 8.8.8.8 -c4")
    dispo = process.read()
    process2 = os.popen("echo $?")
    te = process2.read()
    process.close()
    process2.close()
    return te


#Extraction JSON

machine = {
    "Nom_Machine": nom_machine(),
    "Adresse_Mac": adresse_mac(),
    "RAM": memoire_total(),
    "RAM_Dispo": memoire_dispo(),
    "Processeur": nom_processeur(),
    "Carte_Graphique": nom_graphique(),
    "Temps_Actif": temps_actif(),
    "Espace_Disque": disk_max(),
    "Espace_Disque_Dispo": disk_dispo()
}

#~ a=requests.get('http://192.168.200.4:8000',auth=('projectbear','projectbear'))
#~ if a.status_code == 200 :
r = requests.post("http://192.168.200.4:8000", json={adresse_mac(): machine})
#~ else:
	#~ print("Authentification failed.")
