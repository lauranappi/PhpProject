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
if(controllo_admin()){
  //form per aggiungere un utente da parte dell'admin  
  $Username=$_SESSION["username"];
    echo "<center>
    <h1>Nuovo utente</h1>

    <form action='aggiungiutente1.php' class='form-group' method='post'>

    <label for='Username'>Username:</label> <br/>   
        <input type='text' class='form-control-lg' name='Username' required><br/><br/>

        <label for='Nome'>Nome:</label> <br/>   
        <input type='text'  class='form-control-lg' name='Nome' required><br/><br/>

        <label for='Cognome'>Cognome:</label> <br/>  
        <input type='text'  class='form-control-lg' name='Cognome' required><br/><br/>

        <label for='Password'>Password:</label> <br/>  
        <input type='text'  class='form-control-lg' name='Password' required><br/><br/>


        <input name='invia' type='submit' class='btn btn-warning' value='Aggiungi'>
      </form>
      <br><br>
      <a href='utenti.php' class='btn btn-info'> Indietro </a><br>

    </center>";}
?>