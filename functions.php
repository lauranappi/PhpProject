<?php

function connetti_al_database(){
	$erroreDB = "";
	try {
	  $database = new PDO('mysql:dbname=pietra_luna;host=localhost;charset=utf8;', 'root', '' );
	}
	catch (PDOException $ex) {
	  $erroreDB = $ex->getMessage();
	}

	if($erroreDB!==""){
		echo $erroreDB;
	}
}

function controllo()
{
    if(isset($_SESSION["username"])and !empty($_SESSION["username"])){
    return true;
}else{
    return false;
}
}

function controllo_admin(){
	
	if(isset($_SESSION["username"])and !empty($_SESSION["username"]) && $_SESSION['username'] == "admin"){
		return true;
	}else{
		return false;
	}
}

function sessioni()
{
    if(controllo()){
    $username=$_SESSION["username"];
    }
}

?>



