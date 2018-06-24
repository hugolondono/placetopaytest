<?php

class conexion {

    private $host;
    private $user;
    private $password;
    private $dbname;
    private $message;
    private $link = null; //aqui se almacena la conexion con la base de datos.

    public function __construct() {
        include_once '../configs/config.php';
        $this->host = DN_HOST;
        $this->user = DB_USER;
        $this->password = DB_PASS;
        $this->dbname = DB_NAME;
    }

    //Metodo para conectarse a la base de datos MYSQL
    public function connect() {

        try {
            $this->link = new mysqli($this->host, $this->user, $this->password, $this->dbname);
            $this->link->set_charset('utf8');
        } catch (Exception $e) {
            $this->message = 'Imposible establecer la conexion: ' . $this->link->error;
            return false;
        }
        return $this->link;
    }

    public function disconnect() {
        $this->link->close();
    }

    public function getError() {
        return $this->message;
    }

}