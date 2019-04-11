# BEAR 
# Editeurs: Boran KOYUNCU, Rayen GOUASMI, Adil AHMED, Aïssatou Coulibaly et Elias AHLAL
Projet Applications Informatiques DUTRT2 (IUT DE VILLETANEUSE)

N.B: Notre logiciel est programmé pour fonctionner sur une machine type Debian9, nous ne garantissons pas son fonctionnement sur d'autres systèmes d'exploitation.

# Prérequis

L'installation du logiciel ainsi que sa configuration nécessitent un minimum de connaissance en termes de base de données et en réseaux.

Sur les machines clients:

- python3 et les modules suivants: requests et json
- script sondes.py

Sur la machine serveur:

- python3 et les modules suivants: http.server, mysql-connector, json
- Un serveur apache2 fonctionnel avec le répertoire /var/www/html/ accessible 
- php, mysql-server et phpmyadmin devront être installés 
- Scripts collect_json.py et insert_bdd.py
- Le contenu du répértoire "site" copié dans le répertoire /var/www/html/ de la machine

# Script sondes.py 

C'est ce script qui sera deployé sur les machines que l'on souhaite superviser. Il prend comme seul argument en ligne de commande l'adresse ip du serveur auquel seront envoyées les données. Par exemple si notre serveur possède l'adresse 192.168.43.2, on effectueras la commande d'éxecution suivante:

python3 sondes.py 192.168.43.2

L'ojectif étant que les sondes envoient périodiquement des informations à notre serveur il suffira de créer une tâche cron sur la machine cliente qui aura la syntaxe suivante :

# Exemple de tâche cron qui éxécute le script sondes.py toutes les minutes

Accéder à la table cron avec la commande crontab -e

on peut maintenant créer notre tâche :

m h  dom mon dow   command 
* *   *   *   *    python3 /tmp/sondes.py 192.168.43.3

Une fois tout cela fait la machine client est opérationnelle.

# Script collect_json.py

Ce script est déployé sur la machine serveur qui contiendras aussi le serveur web. Pas grand chose à vérifier sur ce script si ce n'est l'existence du fichier datas.json qu'il génère bien suite aux informations reçues par les sondes. Par défaut il est enregistré dans /tmp. Le serveur écoute sur le port 8000. Il faudras donc lancer le script avec la commande suivante :

python3 collecte_json.py

# Script insrt.py 

Cet éxécutable à pour rôle de remplir notre base de données convenablement. Il contient notamment les identifiants de connexion à la base de données. Il suffiras de créer un tâche crontab pour que le programme se lance en arrière-plan (cf # Script sondes.py)
