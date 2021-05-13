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
<head>
<style>
body {
  background-color: oldlace;
}

h2 {
  color: grey;
  text-align: center;
  width: 100%;
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

* {box-sizing:border-box}

</style>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <title>hospital</title>
</head>
<body>


<form action="" method="get">
    <h2>Introduceti CNP-ul pacientului ce urmeaza a fi externat:</h2>
    <input type="text" name="cnp" id="cnp" value=""><br>
    <br>
    <br>
    <br>
    <br>

    <!-- TODO: onclick send http request -->
    <button type="submit" class="button">Externeaza</button>

    <?php
    if (!empty($_GET['cnp'])) {
      $url = 'http://client:5000/externeaza';
      $data = array('cnp' => $_GET['cnp']);
      $result = send_post_http($url, $data);
      $decoded = json_decode($result);
      if ($decode->externat == 'succes') {
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "Pacient externat cu succes!";
      } else {
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo $decoded->externat;
      }
    }
  ?>
</form>

</body>
</html>
