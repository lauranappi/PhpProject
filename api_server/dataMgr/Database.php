
<?php
// classe PHP chiamata "Database" che si occupa di creare una connessione a un database MySQL
// la classe utilizza l'estensione PDO (PHP Data Objects) per creare la connessione
class Database{
 // i dettagli della connessione, come l'host, il nome del database, l'username e la password, sono specificati come proprietà private all'interno della classe
    private $host = "localhost";
    private $db_name = "pietra_luna";
    private $username = "root";
    private $password = "";
    private $conn;
 
    // il metodo "getConnection" viene utilizzato per creare e restituire un oggetto di connessione al chiamante
    public function getConnection(){
         $this->conn = null;
         try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name.";charset=utf8", $this->username, $this->password);
        }
        // in caso di errore durante la creazione della connessione, un messaggio di errore viene stampato a schermo
		catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
         return $this->conn;
    }
}
?>
