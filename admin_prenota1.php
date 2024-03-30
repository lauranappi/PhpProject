<?php
session_start();
include("functions.php");
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> Pietra di Luna </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <script src="jquery-3.6.0.js" type="text/javascript"></script>

  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
<?php
//controllo esistenza sessione username e salvataggio delle variabili per prenotazione
if(controllo_admin()){

  $Username=$_SESSION["username"];
    if(isset($_POST["ia"]) or isset($_SESSION["ia"])){
      if(isset($_POST["ia"])){
      $Usernamee=$_POST["ia"];
      $_SESSION["ia"]=$Usernamee;

      $Nome=$_POST["ia1"];
      $_SESSION["ia1"]=$Nome;

      $Cognome=$_POST["ia2"];
      $_SESSION["ia2"]=$Cognome;}
//form prenotazione per admin
      echo "<center><br/><h1>Prenota per un utente</h1>
      <form action='admin_prenota2.php' class='form-group' method='post'><br/>

      <label for='Ora'>Ora:</label> <br/>  
      <input tabindex='23' type='time' name='oraa' id='Ora' size='20' class='form-control-lg' maxlength='7' min='19:30' max='21:00' required><br/><br/>
          
      <label for='Persone'>Persone :</label> <br/> 	
      <input tabindex='24' type='number' name='persone_postii' id='Persone'  class='form-control-lg' required value='0' min='1' max='20' step='1'/><br/> <br/> 
      
      <label for='Persone'>Esterno:</label> <br/>
      <input type='radio' name='esterno' value='1'> Si
      <input type='radio' name='esterno' value='2'> No<br/>
      
      <br/><input tabindex='28' value='aggiungi' class='btn btn-warning' type='submit'>
        </form></br></br>
        <a href='utenti.php' class='btn btn-info'> Torna agli utenti </a></br></br>
      </center>";

    } else {echo "Errore";}

   
  }
?>