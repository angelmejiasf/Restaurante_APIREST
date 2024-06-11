<?php

require_once './db/BaseDatos.php';

class MenusModel extends Basedatos {

    private $db;
    private $table;

    public function __construct() {
        $this->db = new Basedatos();
        $this->table = "menus";
    }

    public function obtenerTodosLosMenus() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->db->getConexion()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarMenu($idmenu) {
        $conexion = $this->db->getConexion();

        // Verificar si el menú existe
        $query = "SELECT * FROM $this->table WHERE IDMENU = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id', $idmenu, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se encontró el menú
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($resultados)) {
            return "ERROR AL BORRAR. EL MENU NO EXISTE";
        }

        // Borrar los registros relacionados en la tabla pedidosmenus
        $query = "DELETE FROM pedidosmenus WHERE IDMENU = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id', $idmenu, PDO::PARAM_INT);
        $stmt->execute();

        // Borrar el menú de la tabla menus
        $query = "DELETE FROM $this->table WHERE IDMENU = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id', $idmenu, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "MENU BORRADO CORRECTAMENTE";
        } else {
            return "ERROR AL BORRAR EL MENU";
        }
    }

    public function actualizarMenu($idmenu) {
        $conexion = $this->db->getConexion();

        $query = "UPDATE $this->table SET NOMBRE = ?, PVP = ?, TIPO = ? WHERE IDMENU = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$idmenu['nombre'], $idmenu['pvp'], $idmenu['tipo'], $idmenu['idmenu']]);

        if ($stmt->rowCount() > 0) {
            return "REGISTRO ACTUALIZADO CORRECTAMENTE";
        } else {
            return "ERROR AL ACTUALIZAR EL PASAJE";
        }
    }

    public function insertarMenu($post) {
        try {
            // Si no hay problemas, insertar el pasaje
            $sql = "INSERT INTO $this->table (NOMBRE, PVP, FECHACREACION,TIPO) VALUES (?, ?, NOW(),?)";
            $sentencia = $this->db->getConexion()->prepare($sql);
            $sentencia->bindParam(1, $post['nombre']);
            $sentencia->bindParam(2, $post['pvp']);
            $sentencia->bindParam(3, $post['tipo']);

            $num = $sentencia->execute();

            // Verificar si la inserción fue exitosa
            if ($num) {
                return "<h2>REGISTRO INSERTADO CORRECTAMENTE</h2>";
            } else {
                return "<h2>ERROR: No se ha podido insertar el pasaje</h2>";
            }
        } catch (PDOException $e) {
            
        }
    }
}
