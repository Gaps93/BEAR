#! /usr/bin/python
# -*- coding:utf-8 -*-

import json
import flask
from flask import request
app = flask.Flask(__name__)

@app.route('/')
def index():
	return "Hello !"

@app.route('/processjson', methods=['GET'])
def processjson():

	with open('datas.json') as json_data:
		data_dict = json.load(json_data)
	resultat= ""
	for mac in data_dict.keys():
		res= data_dict.get(mac)
		for attribut in res.keys():
			resultat += str(attribut)+":"+str(res.get(attribut))+"\n"
	return (resultat) 

if __name__ == '__main__':
	app.run(debug=True)
