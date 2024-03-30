
<?php
session_start();
include ("functions.php");
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

<?php
if(controllo_admin()){

        $username=$_SESSION["username"];
        $_SESSION["username"]=$username;


    $erroreDB = "";
    try {
      $db = new PDO("mysql:dbname=pietra_luna;host=localhost;charset=utf8;", "root", "" );
    }
    catch (PDOException $ex) {
      $erroreDB = $ex->getMessage();
    }
//mostra utenti registrati per admin in una tabella con tasti per modificare
    echo "<div style='padding: 2%;'><center><h1>Ecco gli utenti:</h1>
    <a href='aggiungiutente0.php'>
    <input type='submit' class='btn btn-info' value='Aggiungi utente'/></a></center></div>";
 

    $stmt1=$db->query("SELECT username,nome,cognome,punti,sconto FROM utenti");

    echo "<table class='table table-striped'>
    <tr><th>Username</th> <th>Nome</th>  <th>Cognome</th> <th>Punti</th>   <th>Sconti</th> <th></th> <th></th> </tr>";
                    
    foreach($stmt1 as $record){
                        $Username=$record["username"];
                        if($Username!="admin"){
                        
                    $Nome=$record["nome"];
                    $Cognome=$record["cognome"];
                    $Punti=$record["punti"];
                    $Sconto=$record["sconto"];
                    $_SESSION["nome"]=$Nome;
                    $_SESSION["cognome"]=$Cognome;
                    $_SESSION["user"]=$Username;
                    
                    
                    echo "<tr>
                    <td>$Username</td>
                    <td>$Nome</td>
                    <td>$Cognome</td>
                    <td>$Punti</td>
                    <td>$Sconto</td>"; 
                    if($Sconto>0){
                    echo '<td> <button onclick="inviaDati(\''.$Username.'\')" class="btn btn-danger">Elimina Sconto</button></td>';}else{
                      echo '<td></td>';
                    }
                    echo "<td><form action='admin_prenota1.php' method='post'>
                    <input type='hidden' name='ia' value='$Username'>
                    <input type='hidden' name='ia1' value='$Nome'>
                    <input type='hidden' name='ia2' value='$Cognome'>
                    <center>
                    <input type='submit' class='btn btn-warning' value='Aggiungi o modifica prenotazione'></form></center></td>
                  </tr>";
                        }
                    }
                
            echo "</table>";
            echo "<center><form action='prenotazioni_ute.php'>
            <input type='submit' class='btn btn-info' value='Torna alle prenotazioni'/></form><br></center>
            <center><form action='home_admin.php'>
            <input type='submit' class='btn btn-info' value='Torna alla home'/></form><br></center>";
                    

        }else{session_unset();
        session_destroy();
            echo "<center><h2>Per poter procedere, devi prima fare il login </h2>
            </br></br><a href='index.php'> Login </a></center>";
    }


$db = NULL;

?>

<script>
function inviaDati(Username) {
  window.location.href = "eliminasconto.php?var_nascosta=" + Username;
}
</script>