<?php
session_start();
$erroreDB = "";
try {
  $db = new PDO('mysql:dbname=pietra_luna;host=localhost;charset=utf8;', 'root', '' );
}
catch (PDOException $ex) {
  $erroreDB = $ex->getMessage();
}

if ($erroreDB != "") {
    $messaggio = "Messaggio dal DBMS: ".$erroreDB;
    header("Location: login.php"); 
}
else {
  //cancella prenotazione per admin
    $result=$db->prepare("UPDATE utenti SET prenotazioni=NULL");
    $risp=$result->execute();
    header("Location: prenotazioni_ute.php");
}
$db = NULL;
?>