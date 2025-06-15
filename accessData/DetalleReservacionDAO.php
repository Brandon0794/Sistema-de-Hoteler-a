<?php
require_once __DIR__.'/../misc/Conexion.php';
require_once __DIR__.'/../model/DetalleReservacionH.php';

class DetalleReservacionDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM detalleReservacionh");
            $result = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = new DetalleReservacionH(
                    $row['idDetalle'],
                    $row['idReservacion'],
                    $row['idHabitacion']
                );
            }

            return $result;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function obtenerPorId($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.detalleReservacionh WHERE idDetalle = ?");
            $stmt->execute([$id]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new DetalleReservacionH(
                    $row['idDetalle'],
                    $row['idReservacion'],
                    $row['idHabitacion']
                );
            }

            return null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function insertar(DetalleReservacionH $objeto) {
        try {
            $sql = "INSERT INTO u484426513_ms225.detalleReservacionh(idReservacion, idHabitacion) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                $objeto->idReservacion,
                $objeto->idHabitacion
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $sql = "DELETE FROM u484426513_ms225.detalleReservacionh WHERE idDetalle = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function modificar(DetalleReservacionH $objeto) {
        try {
            $sql = "UPDATE u484426513_ms225.detalleReservacionh 
                    SET idReservacion = ?, idHabitacion = ?
                    WHERE idDetalle = ?";
            
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                $objeto->idReservacion,
                $objeto->idHabitacion,
                $objeto->idDetalle
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
