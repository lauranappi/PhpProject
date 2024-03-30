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
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<?php
session_start();
include ("functions.php");

if(controllo_admin()){

        $Username=$_SESSION["username"];

    echo "<center><h1>Prenotazioni:</h1>
    <p>Ricordati che se cancelli la prenotazione di un utente, <br>dovrai liberare anche il tavolo a lui assegnato dalla sezione tavoli</p><br>
    <center>
    <a href='utenti.php'> <input type='submit' class='btn btn-info' value='Nuova prenotazione'/> </a><br><br><br/>";





    $erroreDB = "";
    try {
      $db = new PDO("mysql:dbname=pietra_luna;host=localhost;charset=utf8;", "root", "" );
    }
    catch (PDOException $ex) {
      $erroreDB = $ex->getMessage();
    }

$pippo=$db->query("SELECT username,nome,cognome,punti,prenotazioni FROM utenti WHERE prenotazioni IS NOT NULL");

if($erroreDB != "") {
    $messaggio = "Messaggio dal DBMS: ".$erroreDB;
    header("Location: login.php");
}else{

//tabella prenotazioni di admin
        
    echo "<table class='table table-striped'>
            <tr><th>Username</th>  <th>Nome</th>      <th>Cognome</th>     <th>Prenotazione</th> <th>Punti</th>  <th></th>  </tr>";
                
                
                foreach($pippo as $record){
                    $Username=$record["username"];
                $Nome=$record["nome"];
                $Cognome=$record["cognome"];
                $Prenotazione=$record["prenotazioni"];
                $Punti=$record["punti"];
                echo "<tr>
                <td>$Username</td>
                <td>$Nome</td>
                <td>$Cognome</td>
                <td>$Prenotazione</td>
                <td>$Punti</td>
                <td><form action='modificautente.php' method='post'>
                <input type='hidden' name='id' value='$Username'>
                <input type='submit' class='btn btn-warning' value='cancella'>
                </form>

                </td></tr>";}
             echo "</table><br/>
            <form action='cancellaprenotaz.php'>
            <input type='submit' class='btn btn-warning' value='CANCELLA TUTTE LE PRENOTAZIONI'/></form>
            <form action='home_admin.php'>
            <input type='submit' class='btn btn-info' value='Indietro'/></form></center>";
     

    }   

    }else{session_unset();
        session_destroy();
            echo "<center><h2>Per poter procedere, devi prima fare il login </h2>
            </br></br><a href='index.php'> Login </a></center>";
    }
$db = NULL;
?>