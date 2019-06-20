<?php
namespace Backend\Config;

class Database {

    protected $host;
    protected $user;
    protected $pass;
    protected $db;

    public function __construct(){
        $this -> host = 'localhost';
        $this -> user = 'fede';
        $this -> pass = 'bubu';
        $this -> db = 'mhw3';
    }
}
?>