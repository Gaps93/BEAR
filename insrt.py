#!/usr/bin/python
#coding: utf-8

import mysql.connector
import json

with open('/tmp/datas.json') as json_data:
	data_dict = json.load(json_data)

conn = mysql.connector.connect(host="192.168.43.2",
                               user="root", password="root", 
                               database="bear")
cursor = conn.cursor()

for mac in data_dict.keys():
	res= data_dict.get(mac)

	insert_stmt = (
  "INSERT INTO `machine` (`Temps_Actif`, `Processeur`, `Carte_Graphique`, `RAM_Dispo`, `Nom_Machine`, `Espace_Disque`, `Adresse_Mac`, `RAM`, `Espace_Disque_Dispo`) "
  "VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
)

	data= [res["Temps_Actif"],res["Processeur"],res["Carte_Graphique"],res["RAM_Dispo"],res["Nom_Machine"],res["Espace_Disque"],res["Adresse_Mac"],res["RAM"],res["Espace_Disque_Dispo"]]

	print(data)


	cursor.execute(insert_stmt, data)
	conn.commit()

conn.close()

