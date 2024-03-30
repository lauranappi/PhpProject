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
        $Usernamee=$_POST["Username"];
        $Nome=$_POST["Nome"];
        $Cognome=$_POST["Cognome"];
        $Password=$_POST["Password"];
        $erroreDB="";

if ($erroreDB != "") {
    $messaggio = "Messaggio dal DBMS: ".$erroreDB;
    header("Location: login.php");
}else{
//salvataggio dei dati trasmessi dall'utente sul db
        $result=$db->prepare("INSERT INTO utenti(Username, Nome, Cognome, Password) 
        VALUES (?,?,?,?) ");
             $result->bindParam(1, $Usernamee);
             $result->bindParam(2, $Nome);
             $result->bindParam(3, $Cognome);
             $result->bindParam(4, $Password);
            $res=$result->execute();

        if($Nome != "" && $Cognome != ""){
            echo "<center><div style='border: 2px solid #ffc107; border-radius: 2%; padding: 2%; margin: 5% auto;' 
            class='profilo col-md-7'><h1>Utente inserito correttamente</h1><br>";
            echo "<a href='utenti.php' class='btn btn-warning'> Visualizza </a><br><br></div></center>";

        } else {echo "<center><h1>Username già esistente</h1><a href='aggiungiutente0.php'> INDIETRO </a><br><br></center>";}
    
}

}
$db = NULL;
?>