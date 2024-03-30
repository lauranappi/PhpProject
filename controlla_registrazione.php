<?php
session_start();
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



</head>
<?php
include('functions.php');
if(isset($_POST["username"]) && isset($_POST["nome"]) && isset($_POST["cognome"])
&& isset($_POST["password"]) && isset($_POST["password2"]) && isset($_POST["genere"]))
{
if($_POST["password"]==$_POST["password2"])
{
    //controlla dati registrazione e salva in db, salva variabili in sesione
    $username=$_POST["username"];
    $password=$_POST["password"];
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
 

    $stmt=$db->prepare("SELECT username FROM utenti WHERE username=?");
    if(!$stmt->bindParam(1, $username)){
        echo "errore bind";
    }
    $stmt->execute();
    $record=$stmt->fetch();
if(!$record)
{
    $nome=$_POST["nome"];
$cognome=$_POST["cognome"];
$password=$_POST["password"];
$genere=$_POST["genere"];
$stmt=$db->prepare("INSERT INTO utenti (username,password,nome,cognome,genere)
VALUES (?,?,?,?,?)");
       if(!$stmt->bindParam(1, $username)){
        echo "errore bind";
    }
    if(!$stmt->bindParam(2, $password)){
        echo "errore bind";
    }
    if(!$stmt->bindParam(3, $nome)){
        echo "errore bind";
    }
    if(!$stmt->bindParam(4, $cognome)){
        echo "errore bind";
    }
    if(!$stmt->bindParam(5, $genere)){
        echo "errore bind";
    }

       $risp1= $stmt->execute();

if($stmt==false)
{
    echo $stmt;
}else{
$_SESSION["username"]=$username;
$_SESSION["password"]=$password;
echo "<center><div style='border: 2px solid #ffc107; border-radius: 2%; padding: 2%; margin: 5% auto;' 
class='profilo col-md-7'><h2>Registrazione effettuata con successo.</h2><br/>
<a href='book.php' class='btn btn-warning'>Clicca qui per prenotare il tuo tavolo</a></div><center>";}
}
else{
    $_SESSION['mex']="Lo username che hai inserito esiste già. inseriscine uno diverso.";
    header("Location: registrazione.php");
}
}
else{
    $_SESSION['mex']="Le due password non corrispondono";
    header("Location: registrazione.php");
}
}
else{
    $_SESSION['mex']="Compila tutti i campi";
    header("Location: registrazione.php");
}
if(isset($conn))
{
    $db=NULL;
}
?>