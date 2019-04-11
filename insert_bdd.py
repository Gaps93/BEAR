#!/usr/bin/python
#coding: utf-8

import mysql.connector
import json

with open('/tmp/datas.json') as json_data: 	# On ouvre tout d'abord le fichier généré par ServerSimple.py qui contient nos données.
	data_dict = json.load(json_data)	# Pour des facilités d'insertion dans la base de données nous préferons manipuler nos données sous forme de dictionnaire python

# Connexion à la base de données 
conn = mysql.connector.connect(host="localhost",
                               user="root", password="root",
                               database="bear")

# Préparation de la requête d'insertion dans la base de données
				
cursor = conn.cursor()	# On instancie un curseur qui effectueras la requête sur notre base de données

vider_la_base= ("TRUNCATE TABLE `machine`")	# On effectue d'abord une requête qui vide la table déja existante afin d'éviter les conflits
cursor.execute(vider_la_base)

for mac in data_dict.keys():		# Début de fabrication de la requête d'insertion
	res= data_dict.get(mac)		# On vient lire chaque machine présente dans le fichier pour récuperer ses informations

# Insertion dans la base de données

	insert_stmt = (
  "INSERT INTO `machine` (`Temps_Actif`, `Processeur`, `Date`, `RAM_Dispo`, `Nom_Machine`, `Espace_Disque`, `Adresse_Mac`, `RAM`, `Espace_Disque_Dispo`) "
  "VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
)		

	data= [res["Temps_Actif"],res["Processeur"],res["Date"],res["RAM_Dispo"],res["Nom_Machine"],res["Espace_Disque"],res["Adresse_Mac"],res["RAM"],res["Espace_Disque_Dispo"]]
 
	cursor.execute(insert_stmt, data)	# Execution de la requête
	conn.commit()				# On demande à la base de données d'appliquer les changements

# Fermeture de connexion à la base de données

conn.close()	
