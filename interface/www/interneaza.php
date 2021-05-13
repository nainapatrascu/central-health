 <?php

    function send_post_http($url, $array_param) {
      $options = array(
        'http' => array(
          'method'  => 'POST',
          'header'  => 'Content-type: application/json',
          'content' => json_encode($array_param)
        )
      );
      $context  = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      if($result === false){
        $error = error_get_last();
        throw new Exception('POST request failed: ' . $error['message']);
      }
      return $result;
    }

  ?>

<!DOCTYPE html>
<html lang="en">

<?php
  function runMyFunction() {
    echo 'I just ran a php function';
  }

  if (isset($_GET['hello'])) {
    runMyFunction();
  }
?>

<head>
<style>
body {
  background-color: oldlace;
}

h2 {
  color: grey;
  text-align: center;
}

p {
  font-family: verdana;
  font-size: 20px;
}

form {
  margin: 0 auto;
  width:250px;
}

.column {
  float: left;
  padding: 10px;
  height: 300px;
}

.left, .right {
  width: 25%;
}

.middle {
  width: 50%;
}


.row:after {
  content: "";
  display: table;
  clear: both;
}

.button {
  display: inline-block;
  padding: 15px 25px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #000000;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
  margin:0 auto;
  display:block;
}

.button:hover {background-color: #009900;}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

.button-wrapper {
  text-align: center;
  position: absolute;
  right: 45%;
  bottom:   20%;
}

* {box-sizing:border-box}

</style>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <title>hospital</title>
</head>
<body>


<div class="row">
    <div class="column left">
	<form name="form" action="" method="get">
	    <h2>Date pacient</h2>
		<br>
		<br>
		Nume: <input type="text" name="nume" id="nume" align="left"><br>
		Prenume: <input type="text" name="prenume"><br>
		CNP: <input type="text" name="cnp" id="cnp"><br>
		Sex: <input type="text" name="sex"><br>
		Ocupatie: <input type="text" name="ocupatie"><br>
		Data internarii: <input type="text" name="data"><br>
		Asigurati (DA/NU): <input type="text" name="asigurat"><br>
		ID fisa de internare: <input type="text" name="id-fisa-internare"><br>
    <br>
    <br>
    <br>

    <button id="interneaza1" name="intereneaza1" type="submit" class="button" onClick='location.href="?intereneaza1=1"'>Adauga pacient</button>


      <?php
    if (!empty($_GET['nume']) && !empty($_GET['prenume']) && !empty($_GET['cnp']) && !empty($_GET['sex']) && !empty($_GET['ocupatie']) && !empty($_GET['data']) && !empty($_GET['asigurat']) && !empty($_GET['id-fisa-internare']))
    {
      $url = 'http://client:5000/adauga-pacient';
      $data = array('nume' => $_GET['nume'],
                    'prenume' => $_GET['prenume'],
                    'cnp' => $_GET['cnp'],
                    'sex'=> $_GET['sex'],
                    'ocupatie' => $_GET['ocupatie'],
                    'data' => $_GET['data'],
                    'asigurat' => $_GET['asigurat'],
                    'id_fisa_internare' => $_GET['id-fisa-internare']);
      $result = send_post_http($url, $data);
      $decoded = json_decode($result);
      if ($decoded->pacient_adaugat == 'succes') {
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "Succes!";
      }
  }
    ?>

	</form>

    </div>

    <div class="column middle">
	<form action="" method="get">
	    <h2>Fisa de internare</h2>
		<br>
		<br>
		ID fisa de internare: <input type="text" name="id-fisa-int"/><br>
		Motive internare: <input type="text" name="motive"/><br>
		Istoric boala actuala: <input type="text" name="boala-act"/><br>
		Istoric boli anterioare: <input type="text" name="boli-ant"/><br>
		Istoric boli familie: <input type="text" name="boli-fam"/><br>
		Fumator (DA/NU): <input type="text" name="fumator"/><br>
		Consumator alcool (DA/NU): <input type="text" name="alcool"/><br>
		ID fisa de investigatii: <input type="text" name="id-fisa-inv"/><br>
		ID sectie: <input type="text" name="id-sectie"/><br>
        <br>
    <br>
    <br>

        <button id="interneaza2" name="intereneaza2" type="submit" class="button" onClick='location.href="?intereneaza2=1"'>Adauga fisa de internare</button>

    <?php
  
      if (!empty($_GET['id-fisa-int']) && !empty($_GET['motive']) && !empty($_GET['boala-act']) && !empty($_GET['boli-ant']) && !empty($_GET['boli-fam']) && !empty($_GET['fumator']) && !empty($_GET['alcool']) && !empty($_GET['id-fisa-inv']) && !empty($_GET['id-sectie']))
      {
        $url = 'http://client:5000/adauga-fisa-internare';
        $data = array('id_fisa_internare' => $_GET['id-fisa-int'],
                      'motive_internare' => $_GET['motive'],
                      'istoric_boala_actuala' => $_GET['boala-act'],
                      'istoric_boli_anterioare'=> $_GET['boli-ant'],
                      'istoric_boli_familie' => $_GET['boli-fam'],
                      'fumator' => $_GET['fumator'],
                      'consumator_alcool' => $_GET['alcool'],
                      'id_fisa_investigatii' => $_GET['id-fisa-inv'],
                      'id_sectie' => $_GET['id-sectie']);
        $result = send_post_http($url, $data);
        $decoded = json_decode($result);
        if ($decoded->fisa_internare_adaugata == 'succes') {
          echo "<br>";
          echo "<br>";
          echo "<br>";
          echo "Succes!";
        }
      }


    ?>


	</form>

	<br>
	<br>
	<br>
	<br>
    </div>

    <div class="column right">
	<form action="" method="get">
	    <h2>Persoana de contact</h2>
		<br>
		<br>
		CNP pacient: <input type="text" name="cnp-pacient"><br>
		Nume: <input type="text" name="nume2"><br>
		Prenume: <input type="text" name="prenume2"><br>
    Relatie: <input type="text" name="relatie"><br>
		Numar de telefon: <input type="text" name="nr-tel"><br>
		Adresa de e-mail: <input type="text" name="mail"><br>
        <br>
    <br>
    <br>

    <button id="interneaza3" name="intereneaza3" type="submit" class="button" onClick='location.href="?intereneaza3=1"'>Adauga persoana de contact</button>


    <?php
    if (!empty($_GET['cnp-pacient']) && !empty($_GET['nume2']) && !empty($_GET['prenume2']) && !empty($_GET['relatie']) && !empty($_GET['nr-tel']) && !empty($_GET['mail']))
        {
          $url = 'http://client:5000/adauga-persoana-contact';
          $data = array('cnp_pacient' => $_GET['cnp-pacient'],
                        'nume' => $_GET['nume2'],
                        'prenume' => $_GET['prenume2'],
                        'relatie'=> $_GET['relatie'],
                        'nr_telefon' => $_GET['nr-tel'],
                        'adresa_email' => $_GET['mail']);
          $result = send_post_http($url, $data);
          $decoded = json_decode($result);
          if ($decoded->persoana_contact_adaugata == 'succes') {
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "Succes!";
          }
        }
    ?>


	</form>
    </div>
</div>


</body>
</html>
