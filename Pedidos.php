<?php

require_once './db/BaseDatos.php';
require_once './models/PedidosModel.php';

$pedidosModel = new PedidosModel();

header("Content-type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idcliente'])) {
    $idcliente = $_GET['idcliente'];
    $pedidos = $pedidosModel->obtenerPedidoCliente($idcliente);
    echo json_encode($pedidos);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idpedido'])) {
    $idpedido = $_GET['idpedido'];
    $pedidos = $pedidosModel->obtenerDatosPedido($idpedido);
    echo json_encode($pedidos);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['accion']) && $_GET['accion'] == 'contar') {
    $conteo = $pedidosModel->obtenerConteoPedidosPorCliente();
    echo json_encode($conteo);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Obtener el ID del alumno a borrar
    $idpedido = $_GET['idpedido'];
    // Borrar el alumno de la base de datos
    $res = $pedidosModel->borrarPedido($idpedido);
    $resul['resultado'] = $res;
    echo $resul['resultado'];
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Obtener los datos del cuerpo de la solicitud
    $post = json_decode(file_get_contents('php://input'), true);

    // Actualizar el pasaje en la base de datos
    $res = $pedidosModel->actualizarPedido($post);
    $resul['mensaje'] = $res;
    echo $resul['mensaje'];
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = json_decode(file_get_contents('php://input'), true);

    if (isset($post['idcliente']) && isset($post['menu'])) {
        $res = $pedidosModel->insertarPedido($post['idcliente'], $post['menu']);
        $resul = ['resultado' => $res];
        echo json_encode($resul);
    }

    exit();
}