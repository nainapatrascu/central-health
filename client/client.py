import sys
import json
import requests
from flask import Flask, request, jsonify

app = Flask(__name__)

url_server = "http://server:5000"

@app.route('/', methods=['GET'])
def index():
    r = requests.get(url=url_server)
    if r.status_code == 200:
        return r.json()
    return json.dumps({"Error":"Something is wrong!"})

@app.route('/adauga-pacient', methods=['POST'])
def adauga_pacient():
    url = url_server + "/adauga-pacient"
    r = requests.post(url=url, json=request.get_json()) 
    if r.status_code == 200:
        return r.json()
    return json.dumps({"Error":"Something is wrong!"})

@app.route('/adauga-fisa-internare', methods=['POST'])
def adauga_fisa_internare():
    url = url_server + "/adauga-fisa-internare"
    r = requests.post(url=url, json=request.get_json()) 
    if r.status_code == 200:
        return r.json()
    return json.dumps({"Error":"Something is wrong!"})

@app.route('/adauga-persoana-contact', methods=['POST'])
def adauga_persoana_contact():
    url = url_server + "/adauga-persoana-contact"
    r = requests.post(url=url, json=request.get_json()) 
    if r.status_code == 200:
        return r.json()
    return json.dumps({"Error":"Something is wrong!"})

@app.route('/externeaza', methods=['POST'])
def externeaza():
    url = url_server + "/externeaza"
    r = requests.post(url=url, json=request.get_json()) 
    if r.status_code == 200:
        return r.json()
    return json.dumps({"Error":"Something is wrong!"})

@app.route('/get_pacient', methods=['POST'])
def get_pacient():
    url = url_server + "/get_pacient"
    r = requests.post(url=url, json=request.get_json()) 
    if r.status_code == 200:
        return r.json()
    return json.dumps({"Error":"Something is wrong!"})

@app.route('/nr_internati', methods=['GET'])
def get_nr_internati():
    url = url_server + "/nr_internati"
    r = requests.get(url=url)
    if r.status_code == 200:
    	return r.json()
    return json.dumps({"Error":"Something is wrong!"})

@app.route('/nr_paturi_libere', methods=['GET'])
def get_nr_paturi():
    url = url_server + "/nr_paturi_libere"
    r = requests.get(url=url)
    if r.status_code == 200:
        return r.json()
    return json.dumps({"Error":"Something is wrong!"})

if __name__ == '__main__':
    app.run(host='0.0.0.0')
