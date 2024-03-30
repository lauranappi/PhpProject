<?php
include("functions.php");
session_start();


// inizializzo una variabile con un messaggio per l'utente
$messaggio = "";

// controllo che l'utente abbia scritto sia username sia password
if (!isset($_POST["username"]) || !isset($_POST["password"])) {
	$messaggio = "Username e/o password vuoti";
}
else {
$erroreDB = "";
try {
  $db = new PDO("mysql:dbname=pietra_luna;host=localhost;charset=utf8;", "root", "" );
}
catch (PDOException $ex) {
  $erroreDB = $ex->getMessage();
}
if ($erroreDB != "") {
    $messaggio = "Messaggio dal DBMS: ".$erroreDB;
    header("Location: login.php"); 
  }
  else { // se la connessione con il DBMS e la selezione del DB vanno bene...
    // uso un prepared stamenent della libreria PDO per inserire l'input dell'utente nella query
    // per evitare SQL injection devo ASSOLUTAMENTE EVITARE $db->query
    $stmt = $db->prepare("SELECT * FROM utenti WHERE username=:user");
    $stmt->bindParam(":user",$_POST["username"]);
    $stmt->execute();

    // controllo se il risultato della query è vuoto
    // prelevo il primo elemento dal resultSet ($rs) e lo metto nella var $ut (NB $ut è un array associativo!)
    // la funzione fetch (libreria PDO) con parametro PDO::FETCH_ASSOC: restituisce un array le cui chiavi sono i nomi delle colonne della tabella
    $username = $stmt->fetch(PDO::FETCH_ASSOC);
    #admin 
    if (!$username) { // se lo username non esiste
        $_SESSION['messaggio'] = "Username inesistente"; 
        header("Location: login.php"); 
    }
    else { // se lo username esiste, controllo la password
        if ($_POST["password"] != $username["password"]) { // se la password non è corretta
            $_SESSION['messaggio'] = "Password errata";
            header("Location: login.php"); 
      }
      else { // se la password è corretta
          // inizializzo una variabile di sessione (user)
          // uso il valore letto dal DB e non quello inserito dall'utente per ragioni di sicurezza
          $_SESSION["username"] = $username["username"];
          $username=$_SESSION["username"];
          header("Location: index.php"); 

        } // chiusura se password ok
    } // chiusura se username esiste

  } // chiusura DB ok
}

#admin 
if($_POST["username"] == "admin" && $_POST["password"] == "pietradiluna"){
    header("Location: home_admin.php"); 
    $_POST["username"]=$_SESSION["username"];
    $_SESSION["username"]=$username;
    $username=$_SESSION["username"];
}
?>