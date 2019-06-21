<?php
namespace Backend\Model;

// require '../Database/Connection.php';
require_once __DIR__.'./Base.php';

use Backend\Database\Connection as Connection;
use Backend\Model\Base;

class Utente extends Base{
    private static $table = "utenti";
    public function __construct(){
        parent::setTable(self::$table);
    }
    public static function findArg($id){
        $data = array();
        $newc = new Connection();
        $newc->connect();
        $query = "SELECT * FROM ".self::$table." WHERE argomento_id = '$id'";
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
    public static function login($nickname, $password){
        $newc = new Connection();
        $newc->connect();
        $query = "SELECT * FROM ".self::$table." WHERE nickname = '$nickname' AND pwd = '$password'";
        $result = mysqli_query($newc->conn,$query);
        if($result){
         $n = mysqli_num_rows($result);
         return $n;
        }
        else{
            echo "Qualcosa e' andato storto";
        }
        mysqli_free_result($result);
        $newc->close();
    }
}
