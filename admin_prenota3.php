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
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>
<?php

if(controllo_admin()){

    $Username=$_SESSION["username"];
 
    $erroreDB = "";
    try {
      $db = new PDO('mysql:dbname=pietra_luna;host=localhost;charset=utf8;', 'root', '' );
    }
    catch (PDOException $ex) {
      $erroreDB = $ex->getMessage();
    }

    if($erroreDB!==""){
        echo $erroreDB;
    }
        
        $N=$_POST["N"];
        
    $Cognome=$_SESSION["ia2"];
    $Nome=$_SESSION["ia1"];
    $Usernamee=$_SESSION["ia"];
    $Oraa=$_SESSION["oraa"];
    $Personee=$_SESSION["persone_postii"];

   $preno="$Oraa, $Personee persone, tavolo n $N";

   //aggiornamento con la prenotazione dell'utente attraverso bind param poiche dati che vengono da una form quindi non affidabili

    $stmt=$db->prepare("UPDATE utenti 
    SET prenotazioni=?
    WHERE username=?");
    if(!$stmt->bindParam(1, $preno)){
        echo "errore bind";
    }
    if(!$stmt->bindParam(2, $Usernamee)){
        echo "errore bind";
    }
    $risp=$stmt->execute();

      
//aggiungo un punto
    

    $stmt2=$db->prepare("UPDATE utenti
        SET punti=punti+1
        WHERE username=?");
                if(!$stmt2->bindParam(1, $Usernamee)){
                    echo "errore bind";
                }
  
            $rep=$stmt2->execute();
  //tavolo diventa non disponibile
                       
       $stmt3=$db->prepare("UPDATE tavoli SET disponibilita=0 WHERE numero=?");  
       if(!$stmt3->bindParam(1, $N)){
        echo "errore bind";
    }

       $risp1= $stmt3->execute();

        if($risp and $rep and $risp1){
            echo "<center><div style='border: 2px solid #ffc107; border-radius: 2%; padding: 2%; margin: 5% auto;' 
            class='profilo col-md-7'><h1>Inserimento avvenuto correttamente</h1><br><a class='btn btn-warning' href='prenotazioni_ute.php'>Visualizza</a></center>"  ;
            }
        
        else{echo "<h4>Ops, qualcosa e' andato storto...</h4></center>";}

     

   
        
    }
$db= NULL
 ?>