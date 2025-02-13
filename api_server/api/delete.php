<?php
// rendo accessibile questo endpoint a tutti (CORS)
header("Access-Control-Allow-Origin: *");
// definisco il metodo consentito per la request (CORS)
header("Access-Control-Allow-Methods: DELETE");
// definisco la validità massima dell'autorizzazione in secondi (CORS)
header("Access-Control-Max-Age: 3600");
// definisco i tipi di header consentiti (CORS)
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// specifico il formato della risposta (JSON)
header("Content-Type: application/json; charset=UTF-8");
 
// includo le classi per la gestione dei dati
include_once '../dataMgr/Database.php';
include_once '../dataMgr/Tavolo.php';

// creo una connessione al DBMS
$database = new Database();
$db = $database->getConnection();
 
// creo un'istanza di Prodotto
$tavolo = new Tavolo($db);

// dato che alla chiamata dell'endpoint abbiamo passato l'id nell'URL, leggo l'id nella richiesta GET
// inserisco l'id nella variabile di istanza id dell'oggetto $tavolo 
// N.B. forma compatta di if: se $_GET['id'] è settata, la leggo, altrimenti invoco la funzione die() che "uccide" lo script
$numero_toDel = isset($_GET['numero']) ? $_GET['numero'] : die();
$tavolo->setNumero($numero_toDel);

// invoco il metodo delete() che cancella il prodotto indicato
if ($tavolo->delete()) { // se va a buon fine...
    http_response_code(200); // response code 200 = tutto ok
    // creo un oggetto JSON costituito dalla coppia message: testo-del-messaggio
    echo json_encode(array("message" => "Il tavolo è stato cancellato"));
    }
else { // se l'aggiornamento è fallito...
    http_response_code(503); // response code 503 = service unavailable
    // creo un oggetto JSON costituito dalla coppia message: testo-del-messaggio
    echo json_encode(array("message" => "Impossibile cancellare il tavolo"));
}
?>