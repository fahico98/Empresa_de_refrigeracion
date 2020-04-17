<?php

include '../Config/Conexion.php';

class Producto{

   protected $id;
   protected $nombre;
   protected $clase;
   protected $marca;
   protected $cantidad;
   protected $costo_unitario;
   protected $observaciones;
   protected $porPagina = 20;

   protected function guardarProducto(){
      $conexion = new Conexion();
      $query = "INSERT INTO productos (nombre, clase, marca, cantidad, costo_unitario, observaciones) 
         VALUES (:nombre, :clase, :marca, :cantidad, :costo_unitario, :observaciones)"; 
      $statement = $conexion->pdo->prepare($query);
      $statement->bindValue(":nombre", $this->nombre);
      $statement->bindValue(":clase", $this->clase);
      $statement->bindValue(":marca", $this->marca);
      $statement->bindValue(":cantidad", $this->cantidad);
      $statement->bindValue(":costo_unitario", $this->costo_unitario);
      $statement->bindValue(":observaciones", $this->observaciones);
      $statement->execute();
      $conexion->cerrarConexion();
   }

   protected function actualizarProducto($id){
      $conexion = new Conexion();
      $query =
         "UPDATE productos SET 
            nombre = :nombre,
            clase = :clase,
            marca = :marca,
            cantidad = :cantidad,
            costo_unitario = :costo_unitario,
            observaciones = :observaciones
         WHERE (
            id = $id
         )";
      $statement = $conexion->pdo->prepare($query);
      $statement->bindValue(":nombre", $this->nombre);
      $statement->bindValue(":clase", $this->clase);
      $statement->bindValue(":marca", $this->marca);
      $statement->bindValue(":cantidad", $this->cantidad);
      $statement->bindValue(":costo_unitario", $this->costo_unitario);
      $statement->bindValue(":observaciones", $this->observaciones);
      $statement->execute();
      $conexion->cerrarConexion();
   }

   protected function seleccionarProductos($parametro = "nombre", $valor = "", $pagina = 1){
      $limite = "LIMIT " . ($pagina - 1) * $this->porPagina . ", " . $this->porPagina;
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM productos ORDER BY id DESC $limite" : 
         "SELECT * FROM productos WHERE $parametro LIKE '%" . htmlentities(addslashes($valor)) .
         "%' ORDER BY id DESC $limite";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return $statement->fetchAll(PDO::FETCH_OBJ);
   }

   protected function totalPaginas($parametro, $valor){
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM productos ORDER BY id DESC" :
         "SELECT * FROM productos WHERE $parametro LIKE '%" . htmlentities(addslashes($valor)) . "%' ORDER BY id DESC";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return ceil($statement->rowCount() / $this->porPagina);
   }

   protected function seleccionarPorParametro($parametro, $valor){
      $conexion = new Conexion();
      $query = "SELECT * FROM productos WHERE $parametro = '$valor'";
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return $statement->rowCount() == 0 ? null : json_encode($statement->fetchAll(PDO::FETCH_OBJ)[0]);
   }

   protected function eliminarProducto($id){
      $conexion = new conexion();
      $query = "DELETE FROM productos WHERE id = '$id'";
      $conexion->pdo->query($query);
      $conexion->cerrarConexion();
   }
}
