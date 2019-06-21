<?php
namespace Backend\Model;

// require '../Database/Connection.php';
require_once __DIR__.'./Base.php';

use Backend\Database\Connection as Connection;
use Backend\Model\Base;

class Raccolta extends Base{
    public $titolo;
    public $imgurl;
    public $idUtente;

    private static $table = "raccolte";
    public function __construct(){
        parent::setTable(self::$table);
    }
    public function save(){
        $newc = new Connection();
        $data = null;
        $newc->connect();
        $query = "INSERT INTO ".self::$table." (titolo,imgurl,idUtenti) VALUES ('$this->titolo', '$this->imgurl','$this->idUtente')";
        $result = mysqli_query($newc->conn,$query) or die(mysqli_error($newc->conn));
        if($result){
            echo ' ci entro';
            $data =  array('resp' => 'OK' );
        }
        else{
            $data = array('resp' => 'errore');
        }
        // mysqli_free_result($result);
        $newc->close();
        $resp = json_encode($data, JSON_PRETTY_PRINT);
        print_r($resp);
    }
}

