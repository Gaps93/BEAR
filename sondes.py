#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import os
import json
import requests
import sys

sys.stderr= open('/tmp/sondes.log',"w")  # Créer le fichier sondes.log si besoin de voir les messages d'erreur

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

"""def adresse_mac():
	process = os.popen("/sbin/ifconfig eth0 | grep eth0 | awk '{ print $5 }'")
	if not isinstance(process,str):
		process = os.popen("/sbin/ifconfig eth0 | grep ether | awk '{ print $2 }'")
	mac = process.read()
	process.close()
	return mac.rstrip() """

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

def temps_actif():
    process = os.popen("uptime | awk ' { print $3 }' |cut -d',' -f1")
    temps = process.read()
    process.close()
    temps=temps.replace(":", "h")
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

def date():
    process = os.popen("date | awk ' {print $1,$2,$3,$4,$5}'")
    date = process.read()
    process.close()
    return date.rstrip()


#Extraction JSON

machine = {
    "Nom_Machine": nom_machine(),
    "Adresse_Mac": adresse_mac(),
    "RAM": memoire_total(),
    "RAM_Dispo": memoire_dispo(),
    "Processeur": nom_processeur(),
    "Temps_Actif": temps_actif(),
    "Espace_Disque": disk_max(),
    "Espace_Disque_Dispo": disk_dispo(),
    "Date": date()
}

r = requests.post("http://"+sys.argv[1], json={adresse_mac(): machine})
