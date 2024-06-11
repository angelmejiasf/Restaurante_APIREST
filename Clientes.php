<?php

require_once './db/BaseDatos.php';
require_once './models/ClientesModel.php';

$clientesModel= new ClientesModel();

header("Content-type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $clientes = $clientesModel->obtenerTodosLosClientes();
    echo json_encode($clientes);
    exit();
}
