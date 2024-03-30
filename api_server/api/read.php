<?php
// rendo accessibile questo endpoint a tutti (anyone)
header("Access-Control-Allow-Origin: *");
// specifico il formato del contenuto (JSON)
header("Content-Type: application/json; charset=UTF-8");

// includo le classi per la gestione dei dati
include_once '../dataMgr/Database.php';
include_once '../dataMgr/Tavolo.php';
 
// creo una connessione al DBMS
$database = new Database();
$db = $database->getConnection();
 
// creo un'istanza di Prodotto
$tavolo = new Tavolo($db);
 
// invoco il metodo read() che restituisce l'elenco dei prodotti
$stmt = $tavolo->read(); // N.B. $stmt è un recordset!

// if($stmt->rowCount()>0) { // se ci sono dei prodotti...
if ($stmt) { // se ci sono dei prodotti...
    // creo una coppia "tavoli: [lista-di-prodotti]"
    $tavoli_list = array();
    $tavoli_list["tavoli"] = array();

    foreach ($stmt as $row) { // la funzione fetch (libreria PDO) con parametro PDO::FETCH_ASSOC invocata su un PDOStatement, restituisce un record ($row), in particolare un array le cui chiavi sono i nomi delle colonne della tabella 
		// costruisco un array associativo ($tavolo_item) che rappresenta ogni singolo prodotto...
        $tavolo_item = array(
            "numero" => $row['numero'],
            "persone" => $row['persone'],
            "esterno" => $row['esterno'],
            "disponibilita" => $row['disponibilita']
        );
		// ... e lo aggiungo al fondo di lista-di-prodotti
        array_push($tavoli_list["tavoli"], $tavolo_item); // la funzione array_push inserisce al fondo 
        //dell'array $tavoli_list["tavoli"] l'elemento che consiste nell'array ($tavolo_item)
    }
 
    http_response_code(200); // imposto il response code 200 = tutto ok

	// trasformo la coppia tavoli: [lista-di-prodotti] in un oggetto JSON vero e proprio e lo invio in HTTP response
    echo json_encode($tavoli_list);
}
else { // se NON ci sono  prodotti...
    http_response_code(404); // imposto il response code 404 = Not found
    // creo un oggetto JSON costituito dalla coppia message: testo-del-messaggio
    echo json_encode(array("message" => "No tavoli found"));
}
?>