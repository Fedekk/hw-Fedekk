<?php
namespace Backend\Model;

// require '../Database/Connection.php';
require 'Base.php';

use Backend\Database\Connection as Connection;
use Backend\Model\Base;

class Raccolta extends Base{
    private static $table = "raccolte";
    public function __construct(){
        parent::setTable(self::$table);
    }

}
