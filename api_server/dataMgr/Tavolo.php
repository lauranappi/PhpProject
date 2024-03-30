<?php
class Tavolo {
	
	//connessione (inizializzata nel costruttore)
    private $conn;
 
    // proprietà dei prodotti
    public $numero;
    public $esterno;
    public $persone;
    public $disponibilita;
 
    // il construttore inizializza la variabile per la connessione al DB
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getNumero() {
        return $this->numero;
    }
    public function setNumero($numero_par) {
        $this->numero = $numero_par;
    }
    public function getEsterno() {
        return $this->esterno;
    }
    public function setEsterno($esterno_par) {
        $this->esterno = $esterno_par;
    }
    public function getPersone() {
        return $this->persone;
    }
    public function setPersone($persone_par) {
        $this->persone = $persone_par;
    }
    public function getDisponibilita(){
        return $this->disponibilita;
    }
    public function setDisponibilita($disponibilita_par) {
        $this->disponibilita = $disponibilita_par;
    }

		// servizio di lettura di tutti i prodotti
		function read() {
			// estraggo tutti i prodotti 
			$query = "SELECT * FROM tavoli ORDER BY tavoli.numero;";
			// preparo la query
			$stmt = $this->conn->prepare($query); 
			// eseguo la query
			$stmt->execute(); // NB $stmt conterrà il risultato dell'esecuzione della query (in questo caso un recordset)
	
			return $stmt; 
		}

			// servizio di lettura dei dati di un prodotto, dato il suo id
	function readOne() {
		// estraggo il prodotto con l'id indicato
		$query = "SELECT * FROM tavoli WHERE tavoli.numero = ?";
		// preparo la query
		$stmt = $this->conn->prepare($query);
		// invio il valore per il parametro
		$stmt->bindParam(1, $this->numero);
		// eseguo la query
		$stmt->execute(); // NB $stmt conterrà il risultato dell'esecuzione della query (in questo caso un recordset con un solo elemento)

		// leggo la prima (e unica) riga del risultato della query
		$row = $stmt->fetch(PDO::FETCH_ASSOC); // la funzione fetch (libreria PDO) con parametro PDO::FETCH_ASSOC invocata su un PDOStatement, restituisce un record ($row), in particolare un array le cui chiavi sono i nomi delle colonne della tabella 
 
		if ($row) {
			// inserisco i valori nelle variabili d'istanza 
			$this->numero = $row['numero'];
			$this->persone = $row['persone'];
			$this->esterno = $row['esterno'];
			$this->disponibilita = $row['disponibilita'];

		}
		else {
			// se non trovo il prodotto, imposto i valori delle variabili d'istanza a null
			$this->numero = null;
			$this->persone = null;
			$this->esterno = null;
			$this->disponibilita = null;

		}
		
		// la funzione readOne non restituisce un risultato, bensì modifica l'oggetto su cui viene invocata (cioè il prodotto)
	}
    
	// servizio di inserimento di un nuovo tavolo
	function create() {
		// inserisco il nuovo tavolo
		$query = "INSERT INTO tavoli SET
				  esterno=:esterno, persone=:persone, disponibilita=1";
		// preparo la query
		$stmt = $this->conn->prepare($query);

		// invio i valori per i parametri (NB i valori del nuovo prodotto sono nelle variabili d'istanza!!)
		$stmt->bindParam(":esterno", $this->esterno);
		$stmt->bindParam(":persone", $this->persone);
 
		// eseguo la query
		$stmt->execute(); // NB $stmt conterrà il risultato dell'esecuzione della query

		return $stmt;		
	}

	// servizio di aggiornamento dei dati di un prodotto
	function update() {
		// aggiorno i dati del prodotto con l'id indicato
		$query = "UPDATE tavoli SET
		persone= :p,
		esterno= :e,
					disponibilita = :d

					WHERE
					numero = :n";
	
		// preparo la query
		$stmt = $this->conn->prepare($query);
 
		// invio i valori per i parametri (NB i nuovi valori del prodotto sono nelle variabili d'istanza!!)
		$stmt->bindParam(':n', $this->numero);
		$stmt->bindParam(':p', $this->persone);
		$stmt->bindParam(':e', $this->esterno);
		$stmt->bindParam(':d', $this->disponibilita);
 
		// eseguo la query
		$stmt->execute(); // NB $stmt conterrà il risultato dell'esecuzione della query

		return $stmt;
	}

	// servizio di cancellazione di un prodotto
	function delete() {
		// cancello il prodotto con l'id indicato
		$query = "DELETE FROM tavoli WHERE numero = ?";
	
		// preparo la query
		$stmt = $this->conn->prepare($query);
	
		// invio il valore per il parametro
		$stmt->bindParam(1, $this->numero);

		// eseguo la query
		$stmt->execute(); // NB $stmt conterrà il risultato dell'esecuzione della query

		return $stmt;
	}

}
?>