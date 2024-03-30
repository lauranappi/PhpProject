<?php
//stabilisco i permessi di lettura del file (anyone)
header("Access-Control-Allow-Origin: *");
// dichiaro il formato della risposta (json)
header("Content-Type: application/json; charset=UTF-8");
// dichiaro il metodo consentito per la request
header("Access-Control-Allow-Methods: GET");
 
// includo le classi per la gestione dei dati
include_once '../dataMgr/Database.php';
include_once '../dataMgr/Tavolo.php';

// creo una connessione al DBMS
$database = new Database();
$db = $database->getConnection();
 
// creo un'istanza di Prodotto
$tavolo = new Tavolo($db);

// leggo l'id nella richiesta (GET) e lo inserisco nella variabile di istanza id dell'oggetto $tavolo 
// N.B. forma compatta di if: se $_GET['id'] è settata, la leggo, altrimenti invoco la funzione die() che "uccide" lo script
$numero_toRead = isset($_GET['numero']) ? $_GET['numero'] : die();
$tavolo->setNumero($numero_toRead);
 
// invoco il metodo readOne() che restituisce le info del prodotto su cui viene invocato (l'id è già nella variabile id di $tavolo!)
// N.B. la funzione readOne(), in realtà, non restituisce un risultato, bensì modifica l'oggetto su cui viene invocata (cioè il prodotto), a cui chiedo i dati... 
$tavolo->readOne();
 
if($tavolo->persone!=null) { // se il prodotto esiste (il nome  non è nullo)...
    // costruisco un array associativo ($tavolo_item) che rappresenta il prodotto...
    $tavolo_item = array(
        "numero" => $tavolo->getNumero(),
        "esterno" => $tavolo->getEsterno(),
        "persone" => $tavolo->getPersone(),
        "disponibilita" => $tavolo->getDisponibilita(),

    );
    http_response_code(200); // response code 200 = tutto ok
    echo json_encode($tavolo_item); // ... e lo restituisco nella response, dopo averlo trasformato in oggetto JSON
}
else { // se il nome del prodotto NON esiste
    http_response_code(404); // response code 404 = Not found
    // creo un oggetto JSON costituito dalla coppia message: testo-del-messaggio
    echo json_encode(array("message" => "tavolo does not exist"));
}
?>