<?php
session_start();
include("functions.php");  
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!--compatibilità con browser di elementi recenti-->
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" /> <!--visualizzazione corretta nello schermo-->
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
//controllo esistrnza sessione username che sia admin
if(controllo_admin()){

 $Username=$_SESSION["username"];

//passaggio    dei dati da admin_prenota1.php e salvataggio in sessione
    if(isset($_SESSION["ia"])){    
        $Oraa=$_POST["oraa"];
        $Personee=$_POST["persone_postii"];
        $Personee1=$Personee+1;
        if(!empty($_POST["esterno"])){
          $Esternoo=$_POST["esterno"];
          $_SESSION["esterno"]=$Esternoo;
        }
        $_SESSION["oraa"]=$Oraa;
        $_SESSION["persone_postii"]=$Personee;

        $Nome=$_SESSION["ia1"];
        $Cognome=$_SESSION["ia2"];
        $Usernamee=$_SESSION["ia"];
//connessione DB
        $erroreDB = "";
        try {
          $db = new PDO('mysql:dbname=pietra_luna;host=localhost;charset=utf8;', 'root', '' );
        }
        catch (PDOException $ex) {
          $erroreDB = $ex->getMessage();
        }
        if(!empty($_POST["esterno"])){
            $stmt=$db->prepare("SELECT numero,esterno,persone FROM tavoli WHERE ?>=persone and persone>=? 
            and esterno=? and disponibilita=1");
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
          $stmt=$db->prepare("SELECT numero,esterno,persone FROM tavoli WHERE ?>=persone and persone>=? and disponibilita=1");
          if(!$stmt->bindParam(1, $Personee1)){
            echo "errore bind";
        }
        if(!$stmt->bindParam(2, $Personee)){
            echo "errore bind";
        }
        $risp=$stmt->execute();
        }
            $erroreDB = "";
if($erroreDB != "") {
    $messaggio = "Messaggio dal DBMS: ".$erroreDB;
    header("Location: login.php");
}else{
            if($stmt){
//mostra tavoli compatibili con i dati trasmessi dalla form
            echo "<center><h1>Ecco i tavoli disponibili </h1>
            <p> (PRENOTAZIONE:H. $Oraa, per $Personee persone):<p>";    
                echo "<table class='table table-striped'>
                <tr><th>Numero del tavolo</th>  <th>Esterno</th>    <th>Numero massimo posti</th><th></th></tr>";
                foreach($stmt as $record){
                    $numero=$record["numero"];
                    $persone=$record["persone"];
//output si o no invece che 0 e 1 poiche poco usabile
                    if($record["esterno"]==1)
                    {$esterno="Si";       }
                    elseif($record["esterno"]==2){$esterno="No";   }
                    
                    echo "<tr>
                    <td>$numero</td>
                    <td>$esterno</td>
                    <td>$persone</td>
                    <td><form action='admin_prenota3.php' method='post'>
                    <input type='hidden' name='N' value='$numero'>
                    <input type='submit' class='btn btn-warning' value='VAI'></form>
                    </td></tr>";
                }echo "</table></center><br/> <br/> ";
            
            }else{
                echo "Nessun tavolo disponibile
                <br><a href='admin_prenota1.php'>Modifica</a>
                <br><a href='home_admin.php'>Home</a></center>"  ;
            }}
        
    }else{echo "non set";}   
    
}

$db = NULL;

 ?>     
            





