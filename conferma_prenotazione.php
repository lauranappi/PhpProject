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
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <script src="jquery-3.6.0.js" type="text/javascript"></script>

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
<svg width="98%" height="110">
<rect width="9%" height="5" x="44%" />
</svg>
<?php


if(isset($_SESSION["username"])
&& isset($_SESSION["ora"])
&& isset($_SESSION["persone_posti"])
&& !empty($_SESSION["username"])
&& !empty($_SESSION["ora"])
&& !empty($_SESSION["persone_posti"])){

 $username=$_SESSION["username"];
	sessioni();
    $ora=$_SESSION["ora"];
    $persone_posti=$_SESSION["persone_posti"];
    $id=$_POST["id"];

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
    $preno="$ora, $persone_posti persone, tavolo n $id";
//salva i dati nel database se non ci sono errori e fa riepilogo prenotazione

    $stmt=$db->prepare("UPDATE utenti 
    SET prenotazioni=?
    WHERE username=?");
    if(!$stmt->bindParam(1, $preno)){
        echo "errore bind";
    }
    if(!$stmt->bindParam(2, $username)){
        echo "errore bind";
    }
    $risp=$stmt->execute();


    if(isset($_SESSION["sconto"]))
    {
    $sconto=$_SESSION["sconto"];
    $result1=$db->prepare("UPDATE utenti SET sconto=sconto+1 WHERE username=?");
    if(!$result1->bindParam(1, $username)){
        echo "errore bind";
    }
    $res=$result1->execute();




    $stmt=$db->prepare("SELECT punti FROM utenti WHERE username=?");
    if(!$stmt->bindParam(1, $username)){
        echo "errore bind";
    }
    $stmt->execute();
    $record=$stmt->fetch(PDO::FETCH_ASSOC);
    $pu=$record["punti"];

   //modifica i punti (ne toglie 3 perchè è stato utilizzato lo sconto) 
    if($pu>0){
 $result2=$db->prepare("UPDATE utenti SET punti=punti-3 WHERE username=?");
 if(!$result2->bindParam(1, $username)){
    echo "errore bind";
}
$res1=$result2->execute();

    }
}
//setta tavolo a non disponibile
    $result3=$db->prepare("UPDATE tavoli SET disponibilita='0' WHERE numero=?");
    if(!$result3->bindParam(1, $id)){
        echo "errore bind";
    }
    $res2=$result3->execute();


    $result4=$db->prepare("UPDATE utenti
    SET punti=punti+1
    WHERE username=?");
     if(!$result4->bindParam(1, $username)){
        echo "errore bind";
    }
    $res3=$result4->execute();

if($risp)
{

    echo "<center><div class='profilo' style='padding: 6%;'><h2>Prenotazione effettuata, grazie</h2><br/>
    La tua prenotazione è a nome <strong>$username</strong>, stasera alle 
    ore <strong>$ora</strong> per <strong>$persone_posti</strong> persone. 
    Numero del tavolo: <strong>$id</strong>.<br>
    Se hai uno sconto per la pizza, ti basterà ricordarcelo al momento del pagamento<br>
    Nel caso volessi cancellare o  modificare la prenotazione<br/><br/><br/>
    <div id='menu'> 
    <a id='cand' class='btn btn-info' href='tel:+390000000'>Chiama</a><br/><br/>
    <a href='index.php'  class='btn btn-info'  accesskey='s' tabindex='1'>Ritorna alla home</a><br/><br/>
    <a href='logout.php'  class='btn btn-info' accesskey='s' tabindex='1'>Logout</a><br><br></div></div></center>";
}
else{
    echo "Errore: prova a inserire tutti i campi o fai il login.";
}
    
}
$db= NULL;
?>