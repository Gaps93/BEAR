#!/usr/bin/python
#coding: utf-8

import os
import json

with open('datas.json') as json_data:
    data_dict = json.load(json_data)
    print(data_dict)
