<?php
namespace Backend\Database;
require 'Config/Database.php';

use Backend\Config\Database as Database;

class Connection extends Database{
    public $conn;
    public $responseText;
    public $responseCode;

    public function __construct(){
        $config = new Database();
        $this ->host = $config->host;
        $this ->user = $config->user;
        $this ->pass = $config->pass;
        $this ->db = $config->db;
    }
    public function connect(){
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass,$this->db);
        if(!$this->conn){
            $this->responseText = "Problemi connessione al db". mysqli_connect_errno();
            $this->responseCode = 1;
            exit();
        }
        else{
            $this->responseText = "Connessione con successo";
            $this->responseCode = 0;
        }
    }

    public function close(){
        $close = mysqli_close($this->conn);
        if($close) {$this->responseText = "Connessione chiusa con succeesso"; $this->responseCode = 1;}
        else {$this->responseText = "Problemi chiusura connessione". mysqli_connect_errno(); $this->responseCode =0;}
    }
}

?>