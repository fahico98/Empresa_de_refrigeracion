<?php

include '../Config/Conexion.php';

class Servicio{

   protected $id;
   protected $nombre;
   protected $tipo;
   protected $costo;
   protected $observaciones;
   protected $porPagina = 2;

   protected function guardarServicio(){
      $conexion = new Conexion();
      $query = "INSERT INTO servicios (nombre, tipo, costo, observaciones) 
         VALUES (:nombre, :tipo, :costo, :observaciones)"; 
      $statement = $conexion->pdo->prepare($query);
      $statement->bindValue(":nombre", $this->nombre);
      $statement->bindValue(":tipo", $this->tipo);
      $statement->bindValue(":costo", $this->costo);
      $statement->bindValue(":observaciones", $this->observaciones);
      $statement->execute();
      $conexion->cerrarConexion();
   }

   protected function actualizarServicio($id){
      $conexion = new Conexion();
      $query =
         "UPDATE servicios SET 
            nombre = :nombre,
            tipo = :tipo,
            costo = :costo,
            observaciones = :observaciones
         WHERE (
            id = $id
         )";
      $statement = $conexion->pdo->prepare($query);
      $statement->bindValue(":nombre", $this->nombre);
      $statement->bindValue(":tipo", $this->tipo);
      $statement->bindValue(":costo", $this->costo);
      $statement->bindValue(":observaciones", $this->observaciones);
      $statement->execute();
      $conexion->cerrarConexion();
   }

   protected function seleccionarServicios($parametro = "nombre", $valor = "", $pagina = 1){
      $limite = "LIMIT " . ($pagina - 1) * $this->porPagina . ", " . $this->porPagina;
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM servicios ORDER BY id DESC $limite" : 
         "SELECT * FROM servicios WHERE $parametro LIKE '%" . htmlentities(addslashes($valor)) .
         "%' ORDER BY id DESC $limite";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return $statement->fetchAll(PDO::FETCH_OBJ);
   }

   protected function totalPaginas($parametro, $valor){
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM servicios ORDER BY id DESC" :
         "SELECT * FROM servicios WHERE $parametro LIKE '%" . htmlentities(addslashes($valor)) . "%' ORDER BY id DESC";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return ceil($statement->rowCount() / $this->porPagina);
   }

   protected function seleccionarPorParametro($parametro, $valor){
      $conexion = new Conexion();
      $query = "SELECT * FROM servicios WHERE $parametro = '$valor'";
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return $statement->rowCount() == 0 ? null : json_encode($statement->fetchAll(PDO::FETCH_OBJ)[0]);
   }

   protected function eliminarServicio($id){
      $conexion = new conexion();
      $query = "DELETE FROM servicios WHERE id = '$id'";
      $conexion->pdo->query($query);
      $conexion->cerrarConexion();
   }
}
