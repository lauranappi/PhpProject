<?php
include ("functions.php");


    if(isset($_POST["id"])){

    $id=$_POST["id"];
    

     
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
//modifica dati database di un utente per admin
    $result_a=$db->prepare("UPDATE utenti SET prenotazioni=NULL WHERE username=?");
    if(!$result_a->bindParam(1, $id)){
        echo "errore bind";
    }
    
    $risp1= $result_a->execute();

    $stmt=$db->prepare("SELECT sconto FROM utenti WHERE username=?");
    if(!$stmt->bindParam(1, $id)){
        echo "errore bind";
    }
    $esec=$stmt->execute();
    $record=$stmt->fetchColumn();

    print_r($record);

    if($record=="0"){
    $result_b=$db->prepare("UPDATE utenti SET punti=punti-1 WHERE username=?");
    if(!$result_b->bindParam(1, $id)){
        echo "errore bind";
    }
    $risp1= $result_b->execute();
}elseif($record=="1"){
        $result_b=$db->prepare("UPDATE utenti SET sconto=0 WHERE username=?");
        $result_f=$db->prepare("UPDATE utenti SET punti=punti+2 WHERE username=?");
        if(!$result_b->bindParam(1, $id)){
            echo "errore bind";
        }
        if(!$result_f->bindParam(1, $id)){
            echo "errore bind";
        }
        
        $risp1= $result_b->execute();   
        $rispf= $result_f->execute(); 
    }

    if($erroreDB != "") {
        $messaggio = "Messaggio dal DBMS: ".$erroreDB;
        header("Location: login.php");
    }else{
    
    if($db){
        header("Location: prenotazioni_ute.php");
        } 
    else {echo "Errore!";}

}}

$db = NULL;

?>


