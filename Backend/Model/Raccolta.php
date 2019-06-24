<?php
namespace Backend\Model;

// require '../Database/Connection.php';
require_once __DIR__.'./Base.php';

use Backend\Database\Connection as Connection;
use Backend\Model\Base;

class Raccolta extends Base{
    public $id;
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

    public function up(){
        $newc = new Connection();
        $newc->connect();
        $this->imgurl = mysqli_real_escape_string($newc->conn,$this->imgurl);
        $query = "UPDATE ".self::$table." SET imgurl = '".$this->imgurl."' WHERE id = $this->id";
        $result = mysqli_query($newc->conn,$query) or die(mysqli_error($newc->conn));
        if($result){
             $data =  array('resp' => 'OK' );
             echo json_encode($data);
        }
        $newc->close();
        
    }
    public function remove(){
        $newc = new Connection();
        $newc->connect();
        $query = "DELETE FROM ".self::$table." WHERE id='".$this->id."'";
        $result = mysqli_query($newc->conn,$query) or die("impossibile eseguire query: ".mysqli_error($newc->conn));
        if($result){
            $data = (object) [
                'response' => 'OK'
            ];
        print_r(json_encode($data));
        }
        $newc->close();
    }
}

