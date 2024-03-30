<?php
session_start();
    $ok=$_GET["var_nascosta"];

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
    //elimina lo sxonto funzione per admin  
    $result=$db->prepare("UPDATE utenti SET sconto=sconto-1 WHERE username=?");
    if(!$result->bindParam(1, $ok)){
        echo "errore bind";
    }
    $risp=$result->execute();


    if($risp){header("Location:utenti.php");
        }else{echo "Ops, qualcosa è andato storto...";}
$db=NULL;
       

?>