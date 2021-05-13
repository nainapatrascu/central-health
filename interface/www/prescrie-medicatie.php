<?php
/*
if (!empty($_GET['location'])) {
    /**
     * Here we build the url we'll be using to access the google maps api
     */
    $maps_url = 'http://127.0.0.1:8083/eww';
    $maps_json = file_get_contents($maps_url);
    $maps_array = json_decode($maps_json, true);
    #$lat = $maps_array['results'][0]['geometry']['location']['lat'];
    #$lng = $maps_array['results'][0]['geometry']['location']['lng'];
    /**
     * Time to make our Instagram api request. We'll build the url using the
     * coordinate values returned by the google maps api
     */
    /*
    $url = 'https://' .
        'api.instagram.com/v1/media/search' .
        '?lat=' . $lat .
        '&lng=' . $lng .
        '&client_id=CLIENT-ID'; //replace "CLIENT-ID"
    $json = file_get_contents($url);
    $array = json_decode($json, true);
}
*/
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


<div class="row">
    <div class="column left">
	    <h2></h2>
		<br>
		<br>
		<br>
    </div>

    <div class="column middle">
	<form action="" method="get">
	    <h2>Prescrie medicatie</h2>
		<br>
		<br>
	    <!-- TODO TODO TODO : update id medicatie in fisa de investigatii a pacientului-->
	    <!-- !!!!!!!!!!!!!!!!!!!!!! -->
	    <!-- !!!!!!!!!!!!!!!!!!!!! -->

		CNP pacient: <input type="text" name="cnp"/><br>
		ID medicatie: <input type="text" name="id-med"/><br>
		Nume medicatie: <input type="text" name="nume-med"/><br>
		Cantitate medicatie: <input type="text" name="cantitate"/><br>
		Perioada: <input type="text" name="perioada"/><br>
	</form>

	<br>
	<br>
	<br>
	<br>

	<!-- TODO: onclick send http request -->
	<button type="submit" class="button">Prescrie</button>
    </div>

    <div class="column right">
	    <h2></h2>
		<br>
		<br>
    </div>
</div>


</body>
</html>
