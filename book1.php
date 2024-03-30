
<?php
session_start();
include('functions.php');

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


<svg width="98%" height="110">
<rect width="9%" height="5" x="44%" />
</svg>
<?php

if(controllo())
{
    sessioni();
                
            if(isset($_POST["sconto"]))
                {
                    $sconto=$_POST["sconto"];
                    $_SESSION["sconto"]=$sconto;
                }
            
                $persone=$_POST["persone_posti"];
                $esterno="";
                if(!empty($_POST["esterno"])){
                    $esterno=$_POST["esterno"];
                    $_SESSION["esterno"]=$esterno;
                    echo $esterno;
                }
                $ora=$_POST["ora"];
                $_SESSION["ora"]=$ora;
                $_SESSION["persone_posti"]=$persone;

                $persone1=$persone+1;
                $erroreDB = "";
                try {
                  $db = new PDO("mysql:dbname=pietra_luna;host=localhost;charset=utf8;", "root", "" );
                }
                catch (PDOException $ex) {
                  $erroreDB = $ex->getMessage();
                }
              
                if($erroreDB!==""){
                  echo $erroreDB;
                }

                if(!empty($_POST["esterno"])){
                    $stmt=$db->prepare("SELECT numero,esterno,persone FROM tavoli WHERE $persone1>=persone and persone>=$persone and esterno=$esterno and disponibilita=1");
                    if(!$stmt->bindParam(1, $Personee1)){
                        echo "errore bind";
                    }
                    if(!$stmt->bindParam(2, $Personee)){
                        echo "errore bind";
                    }
                    if(!$stmt->bindParam(3, $Esternoo)){
                      echo "errore bind";
                  }
                  $risp=$stmt->execute();
                }else{
                    $stmt=$db->prepare("SELECT numero,esterno,persone FROM tavoli WHERE $persone1>=persone and persone>=$persone and disponibilita=1");
                    if(!$stmt->bindParam(1, $Personee1)){
                        echo "errore bind";
                    }
                    if(!$stmt->bindParam(2, $Personee)){
                        echo "errore bind";
                    }
                    $risp=$stmt->execute();
                }
                

            if($stmt){

                //mostra tavoli disponibili per le richieste dell'utente
            echo "<center><h1>Ecco i tavoli disponibili</h1>
                <table class='table table-striped'>
                
                <tr>
                <th>Numero del tavolo</th><th>Esterno</th><th>Numero massimo posti</th><th></th></tr>";
            foreach($stmt as $record){
                    $numero=$record["numero"];
                    if($record["esterno"]==1)
                    {
                        $esterno="Si";
                    }
                    elseif($record["esterno"]==2){
                        $esterno="No";
                    }
                    $persone=$record["persone"];
                    echo "<tr>
                    <td>$numero</td>
                    <td>$esterno</td>
                    <td>$persone</td>
                    <td><form action='conferma_prenotazione.php' method='post'>
                    <input type='hidden' name='id' value='$numero'>
                    <input type='submit' value='Prenota tavolo' class='btn btn-warning'></form>
                    </td></tr><br>";
                }
                echo "</table></br></br></br>";
            
            }
            else{
                echo "<center><br><br><h2>Non abbiamo nessun tavolo disponibile per le tue esigenze. Se devi prenotare un 
                tavolo per più di otto persone, chiamaci.</h2><br><br>
                <a href='book.php' class='btn btn-info' accesskey='s' tabindex='1'>Modifica prenotazione</a><br><br>
                <a href='index.php'  class='btn btn-info' accesskey='s' tabindex='1'>Ritorna alla home</a></center>";
            }
        
    
        }else{
        echo "<h2>Per poter prenotare, devi prima fare il login o compilare tutti i campi.</h2>";
    }


$db=NULL;

?>