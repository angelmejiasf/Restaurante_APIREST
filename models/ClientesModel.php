<?php

require_once './db/BaseDatos.php';

class ClientesModel extends Basedatos {

    private $db;
    private $table;

    public function __construct() {
        $this->db = new Basedatos();
        $this->table = "clientes";
    }
    
    public function obtenerTodosLosClientes() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->db->getConexion()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
