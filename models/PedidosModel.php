<?php

require_once './db/BaseDatos.php';

class PedidosModel extends Basedatos {

    private $db;
    private $table;

    public function __construct() {
        $this->db = new Basedatos();
        $this->table = "pedidosmenus";
    }

    public function obtenerPedidoCliente($idcliente) {
        $query = "SELECT * FROM $this->table WHERE IDCLIENTE = ?";
        $stmt = $this->db->getConexion()->prepare($query);
        $stmt->bindParam(1, $idcliente);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerDatosPedido($idpedido) {
        $query = "SELECT * FROM $this->table WHERE IDPEDIDOMENU = ?";
        $stmt = $this->db->getConexion()->prepare($query);
        $stmt->bindParam(1, $idpedido);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerConteoPedidosPorCliente() {
        $query = "SELECT IDCLIENTE, COUNT(*) as conteo FROM $this->table GROUP BY IDCLIENTE";
        $stmt = $this->db->getConexion()->prepare($query);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conteo = [];
        foreach ($resultados as $resultado) {
            $conteo[$resultado['IDCLIENTE']] = $resultado['conteo'];
        }
        return $conteo;
    }

    public function borrarPedido($idpedido) {
        $conexion = $this->db->getConexion();

        // Verificar si el alumno existe
        $query = "SELECT * FROM $this->table WHERE IDPEDIDOMENU = :idpedido";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':idpedido', $idpedido, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se encontró el alumno
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($resultados)) {
            return "<h2>ERROR AL BORRAR. EL PEDIDO NO EXISTE</h2>";
        }

        // Borrar el alumno
        $query = "DELETE FROM $this->table WHERE IDPEDIDOMENU = :idpedido";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':idpedido', $idpedido, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "<h2>PEDIDO BORRADO CORRECTAMENTE</h2>";
        } else {
            return "<h2>ERROR AL BORRAR EL PEDIDO</h2>";
        }
    }

    public function actualizarPedido($idpedido) {
        $conexion = $this->db->getConexion();

        $query = "UPDATE $this->table SET IDMENU = ? WHERE IDPEDIDOMENU = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$idpedido['IDMENU'], $idpedido['IDPEDIDOMENU']]);

        if ($stmt->rowCount() > 0) {
            return "<h2>PEDIDO ACTUALIZADO CORRECTAMENTE</h2>";
        } else {
            return "<h2>ERROR AL ACTUALIZAR EL PEDIDO</h2>";
        }
    }

    public function insertarPedido($idcliente, $menu) {
        try {
            $query = "SELECT COUNT(*) FROM $this->table WHERE IDMENU = ? AND IDCLIENTE = ?";

            $stmt = $this->db->getConexion()->prepare($query);
            $stmt->bindParam(1, $menu);
            $stmt->bindParam(2, $idcliente);

            $stmt->execute();
            $rowCount = $stmt->fetchColumn();

            if ($rowCount > 0) {
                return "<h2>ERROR: La receta ya está registrada</h2>";
            }
            $query = "INSERT INTO $this->table (IDCLIENTE, IDMENU, FECHAPEDIDO) VALUES (?, ?, NOW())";

            $stmt = $this->db->getConexion()->prepare($query);
            $stmt->bindParam(1, $idcliente);
            $stmt->bindParam(2, $menu);

            if ($stmt->execute()) {
                return "<h2>PEDIDO INSERTADO CORRECTAMENTE</h2>";
            } else {
                return "<h2>ERROR: No se ha podido insertar el pedido</h2>";
            }
        } catch (PDOException $e) {
            return "<h2>ERROR: No se ha podido insertar la receta</h2>";
        }
    }
}
