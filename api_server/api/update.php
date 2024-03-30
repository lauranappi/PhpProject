<?php
// rendo accessibile questo endpoint a tutti (CORS)
header("Access-Control-Allow-Origin: *");
// definisco il metodo consentito per la request (CORS)
header("Access-Control-Allow-Methods: POST, PUT, PATCH");
// definisco la validità massima dell'autorizzazione in secondi (CORS)
header("Access-Control-Max-Age: 3600");
// definisco i tipi di header consentiti (CORS)
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// definisco il formato della risposta (json)
header("Content-Type: application/json; charset=UTF-8");
 
// includo le classi per la gestione dei dati
include_once '../dataMgr/Database.php';
include_once '../dataMgr/Tavolo.php';

// creo una connessione al DBMS
$database = new Database();
$db = $database->getConnection();
 
// creo un'istanza di Prodotto
$tavolo = new Tavolo($db);

// leggo i dati nel body della request (metodo POST/PUT/PATCH)
$data = json_decode(file_get_contents("php://input"));

// inserisco i valori nelle variabili di istanza dell'oggetto $tavolo (compreso l'id che indica il prodotto da aggiornare!)
$tavolo->setNumero($data->numero);
$tavolo->setPersone($data->persone);
$tavolo->setEsterno($data->esterno);
$tavolo->setDisponibilita($data->disponibilita);

// invoco il metodo update() che aggiorna i dati del prodotto
if($tavolo->update()) { // se va a buon fine...
    http_response_code(200); // response code 200 = tutto ok
    // creo un oggetto JSON costituito dalla coppia message: testo-del-messaggio
    echo json_encode(array("message" => "tavolo was updated"));
    }
else { // se l'aggiornamento è fallito...
    http_response_code(503); // response code 503 = service unavailable
    // creo un oggetto JSON costituito dalla coppia message: testo-del-messaggio
    echo json_encode(array("message" => "Unable to update tavolo"));
}
?>