<?php
	session_start();
	//Questo script salva il colore in una variabile di sessione in modo che sia disponibile per tutte le pagine
	$msg = "";
	// leggo il parametro c
	if (isset($_GET["c"])) {
		// inizializzo una variabile di sessione (color)
		$_SESSION["colore"] = $_GET["c"];
		$msg = "Colore ".$_SESSION["colore"]." ricevuto e salvato in una variabile di sessione.";
	} else {
		$msg = "Non ho ricevuto il colore...";
	}
	echo $msg;
?>
