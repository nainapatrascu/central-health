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

h1 {
  color: white;
  text-align: center;
}

h3 {
  color: grey;
  text-align: center;
}

p {
  font-family: verdana;
  font-size: 20px;
}

form {
margin: 0 auto;
width:100%;
}




/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

/* BUUTTTOOONNSSSSSSSSS */

.button-wrapper {
  text-align: center;
}

.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white;
  color: black;
  border: 2px solid #4CAF50;
  width: 100%;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

.button2 {
  background-color: white;
  color: black;
  border: 2px solid #008CBA;
  width: 100%;
}

.button2:hover {
  background-color: #008CBA;
  color: white;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

.button3 {
  background-color: white;
  color: black;
  border: 2px solid #f44336;
  width: 100%;
}

.button3:hover {
  background-color: #f44336;
  color: white;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

.button4 {
  background-color: white;
  color: black;
  border: 2px solid #f08080;
  width: 100%;
}

.button4:hover {
  background-color: #f08080;
  color: white;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

.button5 {
  background-color: white;
  color: black;
  border: 2px solid #555555;
  width: 100%;
}

.button5:hover {
  background-color: #555555;
  color: white;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

.button6 {
  background-color: white;
  color: yellow;
  border: 2px solid #ffff00;
  width: 100%;
}

.button6:hover {
  background-color: #ffff00;
  color: yellow;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

/* END BUTTTOOONNSSS */

/* SLIDE SHOW FOR TAB 2 (SPITAL) */
* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}

/* END SLIDE SHOW */


</style>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <title>hospital</title>
</head>
<body>


<!-- Tab links navigation -->
<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Operatiuni')">Operatiuni</button>
  <button class="tablinks" onclick="openTab(event, 'Spital')">Spital</button>
  <button class="tablinks" onclick="openTab(event, 'Sectii')">Sectii</button>
  <button class="tablinks" onclick="openTab(event, 'Doctori')">Doctori</button>
  <button class="tablinks" onclick="openTab(event, 'Contact')">Contact</button>
</div>

<!-- Tab content -->
<div id="Operatiuni">
</div>

<div id="Spital" class="tabcontent">
  <h3>Spitalul de urgenta</h3>
  <p align="center">„Scopul medicinii nu este numai sa vindece sau sa previna bolile,
    ci inca, sa perfectioneze pe oameni si sa-i faca fericiti si mai buni”</p>
                              <p align="right">HIPPOCRATE, parintele medicinii</p>
<!-- SLIDESHOW -->
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 5</div>
  <img src="img1.jpg" style="width:100%">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 5</div>
  <img src="img2.jpg" style="width:100%">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 5</div>
  <img src="img3.jpg" style="width:100%">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">4 / 5</div>
  <img src="img4.jpg" style="width:100%">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">5 / 5</div>
  <img src="img5.jpg" style="width:100%">
  <div class="text"></div>
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</div>

<div id="Sectii" class="tabcontent">
  <h3>Sectii</h3>
  <h4>1. Cardiologie</h4>
    ID sectie: 1<br>
    Numar paturi disponibile: 14<br>
  <h4>2. Chirurgie</h4>
    ID sectie: 2<br>
    Numar paturi disponibile: 27<br>
  <h4>3. Ortopedie</h4>
    ID sectie: 3<br>
    Numar paturi disponibile: 15<br>
  <h4>7. Neurologie</h4>
    ID sectie: 4<br>
    Numar paturi disponibile: 32<br>
  <h4>9. Pediatrie</h4>
    ID sectie: 5<br>
    Numar paturi disponibile: 26<br>
  <h4>10. Psihiatrie</h4>
    ID sectie: 6<br>
    Numar paturi disponibile: 12<br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<div id="Doctori" class="tabcontent">
  <h3>Doctori</h3>
  <p>Popescu Florin</p><br>
  <p>Constantinescu Mircea</p><br>
  <p>Radulescu Maria</p><br>
  <p>George Alexandra</p><br>
  <p>Stefan Radu</p><br>
  <p>Pop Andrei</p><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<div id="Contact" class="tabcontent">
  <h3>Contact</h3>
  <p>Strada Trandafirilor, nr. 79</p>
  <p>Telefon: 0722222222</p>
  <p>E-mail: spital@gmail.com</p>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>


<script>
function openTab(evt, tabName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<h3>Operatiuni posibile asupra pacientilor inregistrati in sistem</h3>

<h4 style="color:black;text-align:center;">Introduceti CNP pacient:</h4>
<!-- <p>This is a paragraph.</p> -->

  
<div class="button-wrapper">
<form name="form" action="" method="get">
    <input type="text" name="cnp_pacient" id="cnp_pacient" value="">
    <button id="cauta_pacient_button" name="cauta_pacient_button" type="submit" onClick='location.href="?cauta_pacient_button=1"'>Cauta pacient</button>

   <!-- <p id="demo"></p> -->
 </br>
   <?php
    if (!empty($_GET['cnp_pacient'])) {
      get_pacient($_GET['cnp_pacient']);
    }

    function get_pacient($cnp) {
      $url = 'http://client:5000/get_pacient';
      $data = array('cnp' => $cnp);
      $options = array(
        'http' => array(
          'method'  => 'POST',
          'header'  => 'Content-type: application/json',
          'content' => json_encode($data)
        )
      );
      $context  = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      if($result === false){
        $error = error_get_last();
        throw new Exception('POST request failed: ' . $error['message']);
      }
      $decoded = json_decode($result);

      if ($decoded->cnp == 'null') {
        echo "Nu exista in sistem niciun pacient cu CNP-ul introdus!";
      } else {
        echo "CNP: " . $decoded->cnp;
        echo "<br>";
        echo "Nume: " . $decoded->nume;
        echo "<br>";
        echo "Prenume: " . $decoded->prenume;
        echo "<br>";
        echo "Sex: " . $decoded->sex;
        echo "<br>";
        echo "Ocupatie: " . $decoded->ocupatie;
        echo "<br>";
        echo "Data internarii: " . $decoded->data;
        echo "<br>";
        echo "Asigurat: " . $decoded->asigurat;
        echo "<br>";
        echo "ID fisa de internare: " . $decoded->id_fisa_internare;
        echo "<br>";
      }
    }
  ?>
</form>
</div>

<!-- BUTTTONNNNSSSS -->
<h2>Operatiuni</h2>

<a href="interneaza.php" class="button button1" role="button">Interneaza</a>
<a href="externeaza.php" class="button button2" role="button">Externeaza</a>
<a href="solicita-investigatii.php" class="button button3" role="button">Solicita investigatii</a>
<a href="prescrie-medicatie.php" class="button button4" role="button">Prescrie medicatie</a>
<form name="formButtonX" action="" method="get">
<button type="button" class="button button1" id="buttonX" name="buttonX" type="submit" onClick='location.href="?buttonX=1"'>Total pacienti internati</button>

 </br>
   <?php
   if (isset($_GET['buttonX'])) {
    $url = 'http://client:5000/nr_internati';
    $options = array(
      'http' => array(
        'method'  => 'GET',
        'header'  => 'Content-type: application/json',
      )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if($result === false){
      $error = error_get_last();
      throw new Exception('POST request failed: ' . $error['message']);
    }
    $decoded = json_decode($result);
    echo "<br>";
    echo "Numarul de pacienti internati: " . $decoded->nr_internati;
    echo "<br>";
    echo "<br>";

   }
  ?>

</form>

<form name="formButtonY" action="" method="GET">
<button type="button" class="button button2" id="buttonY" name="buttonY" type="submit" onClick='location.href="?buttonY=1"'>Numar paturi disponibile</button>

</br>
   <?php
   if (isset($_GET['buttonY'])) {
    $url = 'http://client:5000/nr_paturi_libere';
    $options = array(
      'http' => array(
        'method'  => 'GET',
        'header'  => 'Content-type: application/json',
      )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if($result === false){
      $error = error_get_last();
      throw new Exception('POST request failed: ' . $error['message']);
    }
    $decoded = json_decode($result);
    echo "<br>";
    echo "Numarul de paturi disponibile in spital: " . $decoded->nr_paturi_libere;
    echo "<br>";
   }
  ?>

</form>


<br/>



</body>
</html>
