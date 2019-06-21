<?php
namespace Backend\Model;
require_once __DIR__.'/../Database/Connection.php';

use Backend\Database\Connection as Connection;

class Base {
    private static $table;

    public static function setTable($name){
        self::$table = $name;
    }
    public static function All(){
        $newc = new Connection();
        $data = array();
        $newc->connect();
        $query = "SELECT * FROM ".self::$table."";
        $result = mysqli_query($newc->conn,$query);
        if($result){
        for($i=0;$i<mysqli_num_rows($result);$i++){
            $row = mysqli_fetch_assoc($result);
            array_push($data, $row);
        }
        }
        print_r(json_encode($data));
        $newc->close();
    }
    public static function find($id){
        $newc = new Connection();
        $data = array();
        $newc->connect();
        $query = "SELECT * FROM ".self::$table." WHERE id='$id'";
        $result = mysqli_query($newc->conn,$query);
        if($result){
        for($i=0;$i<mysqli_num_rows($result);$i++){
            $row = mysqli_fetch_assoc($result);
            array_push($data, $row);
        }
        }
        print_r(json_encode($data));
        $newc->close();
    }
    public static function Where($column,$op,$string){
        $newc = new Connection();
        $data = array();
        $newc->connect();
        $query = "SELECT * FROM ".self::$table." WHERE ".$column."".$op."'".$string."'";
        $result = mysqli_query($newc->conn,$query);
        if($result){
        for($i=0;$i<mysqli_num_rows($result);$i++){
            $row = mysqli_fetch_assoc($result);
            array_push($data, $row);
        }
        }
        print_r(json_encode($data));
        $newc->close();
    }

}
