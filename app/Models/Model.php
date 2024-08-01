<?php

namespace App\Models;
use mysqli;

class Model{
    protected $dbhost = DB_HOST;
    protected $dbuser = DB_USER; 
    protected $dbpass = DB_PASS;
    protected $dbname = DB_NAME;
    protected $conection;
    protected $query;

    public function __construct()
    {
        $this->conection();
    }


    public function conection(){
        $this->conection = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if($this->conection->connect_error){
            die("Conexión fallida: " . $this->conection->connect_error);
        }
    }

    public function query($sql){
        $this->query = $this->conection->query($sql);
        return $this;
    }

    public function first(){
        return $this->query->fetch_assoc();
    }

    public function get(){
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    public function all(){
        $sql = "SELECT * FROM $this->table";
        return $this->query($sql)->get();
    }
}