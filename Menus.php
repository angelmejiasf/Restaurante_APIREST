<?php

require_once './db/BaseDatos.php';
require_once './models/MenusModel.php';

$menusModel = new MenusModel();

header("Content-type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $menus = $menusModel->obtenerTodosLosMenus();

    echo json_encode($menus);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Obtener el ID del pasaje a borrar
    $idmenu = $_GET['id'];
    // Borrar el pasaje de la base de datos
    $res = $menusModel->eliminarMenu($idmenu);
    $resul['resultado'] = $res;
    echo $resul['resultado'];
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Obtener los datos del cuerpo de la solicitud
    $post = json_decode(file_get_contents('php://input'), true);
    // Actualizar el pasaje en la base de datos
    $res = $menusModel->actualizarMenu($post);
    $resul['mensaje'] = $res;
    echo $resul['mensaje'];
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del cuerpo de la solicitud
    $post = json_decode(file_get_contents('php://input'), true);
    // Guardar el pasaje en la base de datos
    $res = $menusModel->insertarMenu($post);
    $resul['resultado'] = $res;
    echo json_encode($resul);
    exit();
}