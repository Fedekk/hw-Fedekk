<?php
namespace Backend\Model;

// require '../Database/Connection.php';
require 'Base.php';

use Backend\Database\Connection as Connection;
use Backend\Model\Base;

class Multimedia extends Base{
    private static $table = "multimedia";
    public function __construct(){
        parent::setTable(self::$table);
    }
    public static function randomRow(){
        $newc = new Connection();
        $num = 0;
        $newc->connect();
        $query = "SELECT * FROM ".self::$table." ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($newc->conn,$query);
        $num = mysqli_num_rows($result);
        if($result){
        for($i=0;$i<$num;$i++){
            $row = mysqli_fetch_assoc($result);
        }
        print_r(json_encode($row));
        }
        $newc->close();
    }
}
