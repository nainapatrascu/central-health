from typing import List, Dict
from flask import Flask, request, jsonify
import mysql.connector
import json
from collections import deque, namedtuple, OrderedDict
import sys

app = Flask(__name__)


@app.route('/', methods=['GET'])
def index():
    return json.dumps({"Server Status":"Running"})

@app.route('/adauga-pacient', methods=['POST'])
def adauga_pacient():
    cnp = request.json['cnp']
    nume = request.json['nume']
    prenume = request.json['prenume']
    sex = request.json['sex']
    ocupatie = request.json['ocupatie']
    data = request.json['data']
    asigurat = request.json['asigurat']
    id_fisa_internare = request.json['id_fisa_internare']

    config = {
        'user': 'root',
        'password': 'root',
        'host': 'db',
        'port': '3306',
        'database': 'pacienti'
    }
    connection = mysql.connector.connect(**config)
    cursor = connection.cursor()
    cursor.callproc('pacienti.adauga_pacient', \
            [int(cnp), nume, prenume, sex, ocupatie, data, asigurat, int(id_fisa_internare)])
    connection.commit()
    cursor.close()
    connection.close()

    return json.dumps({"pacient_adaugat":"succes"})

@app.route('/adauga-fisa-internare', methods=['POST'])
def adauga_fisa_internare():
    id_fisa_internare = request.json['id_fisa_internare']
    motive_internare = request.json['motive_internare']
    istoric_boala_actuala = request.json['istoric_boala_actuala']
    istoric_boli_anterioare = request.json['istoric_boli_anterioare']
    istoric_boli_familie = request.json['istoric_boli_familie']
    fumator = request.json['fumator']
    consumator_alcool = request.json['consumator_alcool']
    id_fisa_investigatii = request.json['id_fisa_investigatii']
    id_sectie = request.json['id_sectie']

    config = {
        'user': 'root',
        'password': 'root',
        'host': 'db',
        'port': '3306',
        'database': 'pacienti'
    }
    connection = mysql.connector.connect(**config)
    cursor = connection.cursor()
    cursor.callproc('pacienti.adauga_fisa_internare', \
            [int(id_fisa_internare), motive_internare, istoric_boala_actuala,\
            istoric_boli_anterioare, istoric_boli_familie, fumator,\
            consumator_alcool, int(id_fisa_investigatii), int(id_sectie)])
    connection.commit()
    cursor.close()
    connection.close()

    return json.dumps({"fisa_internare_adaugata":"succes"})

@app.route('/adauga-persoana-contact', methods=['POST'])
def adauga_persoana_contact():
    cnp_pacient = request.json['cnp_pacient']
    nume = request.json['nume']
    prenume = request.json['prenume']
    relatie = request.json['relatie']
    nr_telefon = request.json['nr_telefon']
    adresa_email = request.json['adresa_email']

    config = {
        'user': 'root',
        'password': 'root',
        'host': 'db',
        'port': '3306',
        'database': 'pacienti'
    }
    connection = mysql.connector.connect(**config)
    cursor = connection.cursor()
    cursor.callproc('pacienti.adauga_persoana_contact', \
            [int(cnp_pacient), nume, prenume, relatie, nr_telefon, adresa_email])
    connection.commit()
    cursor.close()
    connection.close()

    return json.dumps({"persoana_contact_adaugata":"succes"})

@app.route('/externeaza', methods=['POST'])
def externeaza():
    cnp = request.json['cnp']
    config = {
        'user': 'root',
        'password': 'root',
        'host': 'db',
        'port': '3306',
        'database': 'pacienti'
    }
    connection = mysql.connector.connect(**config)
    cursor = connection.cursor()
    cursor.callproc('ext2', [int(cnp)])
    connection.commit()
    cursor.close()
    connection.close()

    return json.dumps({"externat":"succes"})

@app.route('/get_pacient', methods=['POST'])
def get_pacient():
    cnp = request.json['cnp']
    config = {
        'user': 'root',
        'password': 'root',
        'host': 'db',
        'port': '3306',
        'database': 'pacienti'
    }

    connection = mysql.connector.connect(**config)
    cursor = connection.cursor(buffered=True)
    cursor.execute('SELECT * FROM pacient where cnp like \'' + str(cnp) + '\'')
    results = [[cnp, nume, prenume, sex, ocupatie, data, asigurat, \
        id_fisa_internare] for [cnp, nume, prenume, sex, ocupatie, data, \
        asigurat, id_fisa_internare] in cursor]
    cursor.close()
    connection.close()

    if len(results) == 1:
        arr = results[0]
        return json.dumps({"cnp":arr[0],"nume":arr[1],"prenume":arr[2],\
                "sex":arr[3],"ocupatie":arr[4],"data":str(arr[5]),\
                "asigurat":arr[6],"id_fisa_internare":arr[7]})
    return json.dumps({"cnp":"null"})

@app.route('/nr_internati', methods=['GET'])
def get_nr_internati():
    config = {
        'user': 'root',
        'password': 'root',
        'host': 'db',
        'port': '3306',
        'database': 'pacienti'
    }
    connection = mysql.connector.connect(**config)
    cursor = connection.cursor(buffered=True)
    cursor.execute('SELECT get_nr_pacienti()')
    connection.commit()
    res = cursor.fetchone()
    cursor.close()
    connection.close()

    return json.dumps({"nr_internati":res[0]})

@app.route('/nr_paturi_libere', methods=['GET'])
def get_nr_paturi():
    config = {
        'user': 'root',
        'password': 'root',
        'host': 'db',
        'port': '3306',
        'database': 'pacienti'
    }
    connection = mysql.connector.connect(**config)
    cursor = connection.cursor(buffered=True)
    cursor.execute('SELECT get_nr_locuri_libere()')
    connection.commit()
    res = cursor.fetchone()
    cursor.close()
    connection.close()

    return json.dumps({"nr_paturi_libere":res[0]})

if __name__ == '__main__':
    app.run(host='0.0.0.0')
