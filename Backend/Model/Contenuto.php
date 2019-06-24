<?php
namespace Backend\Model;

// require '../Database/Connection.php';
require_once __DIR__.'./Base.php';

use Backend\Database\Connection as Connection;
use Backend\Model\Base;

class Contenuto extends Base{
    public $id;
    public $risorsa;

    private static $table = "contenuti";
    public function __construct(){
        parent::setTable(self::$table);
    }
    public static function findArg($id){
        $newc = new Connection();
        $data = array();
        $newc->connect();
        $query = "SELECT * FROM ".self::$table." WHERE domanda_id = '$id'";
        $result = mysqli_query($newc->conn,$query);
        if($result){
        for($i=0;$i<mysqli_num_rows($result);$i++){
            $row = mysqli_fetch_assoc($result);
            array_push($data, $row);
        }
        print_r(json_encode($data));
        mysqli_free_result($result);
        }
        $newc->close();
    }
    public function save(){
        $newc = new Connection();
        $newc->connect();
        $this->risorsa = mysqli_real_escape_string($newc->conn, $this->risorsa);
        $query = "INSERT INTO ".self::$table." (risorsa) VALUES ('".$this->risorsa."')";
        $result = mysqli_query($newc->conn,$query) or die(mysqli_error($newc->conn));
        if($result){
            $data = (object) [
                'response' => 'OK'
            ];
        print_r(json_encode($data));
        }
        $newc->close();
    }
    public function remove(){
        $newc = new Connection();
        $newc->connect();
        $query = "DELETE FROM ".self::$table." WHERE id='".$this->id."'";
        $result = mysqli_query($newc->conn,$query) or die(mysqli_error($newc->conn));
        if($result){
            $data = (object) [
                'response' => 'OK'
            ];
        print_r(json_encode($data));
        }
        $newc->close();
    }
}
