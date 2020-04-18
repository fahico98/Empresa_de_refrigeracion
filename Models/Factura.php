<?php

include '../Config/Conexion.php';

class Factura{

   protected $id;
   protected $cliente;
   protected $fecha_hora;
   protected $costo;
   protected $porPagina = 20;

   protected function seleccionarFacturas($cliente_id, $parametro = "id", $valor = "", $pagina = 1){
      $limite = "LIMIT " . ($pagina - 1) * $this->porPagina . ", " . $this->porPagina;
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM facturas WHERE cliente_id = '$cliente_id' ORDER BY id DESC $limite" : 
         "SELECT * FROM facturas WHERE cliente_id = '$cliente_id' AND $parametro LIKE '%" . htmlentities(addslashes($valor)) .
         "%' ORDER BY id DESC $limite";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return $statement->fetchAll(PDO::FETCH_OBJ);
   }









   
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

   protected function totalPaginas($cliente_id, $parametro, $valor){
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM facturas WHERE cliente_id = '$cliente_id' ORDER BY id DESC" :
         "SELECT * FROM servicios WHERE cliente_id = '$cliente_id' AND $parametro LIKE '%" .
         htmlentities(addslashes($valor)) . "%' ORDER BY id DESC";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return ceil($statement->rowCount() / $this->porPagina);
   }

   protected function seleccionarPorParametro($cliente_id, $parametro = "", $valor = ""){
      $conexion = new Conexion();
      $query = strcmp($parametro, "") == 0 && strcmp($valor, "") == 0 ?
         "SELECT * FROM servicios WHERE cliente_id = '$cliente_id' ORDER BY id DESC" :
         "SELECT * FROM servicios WHERE $parametro LIKE '%" . htmlentities(addslashes($valor)) . "%' AND 
         cliente_id = '$cliente_id' ORDER BY id DESC";
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
