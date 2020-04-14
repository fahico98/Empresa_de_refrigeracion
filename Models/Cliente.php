<?php

include '../Config/Conexion.php';

class Cliente{

   protected $documento;
   protected $nombre;
   protected $apellido;
   protected $edad;
   protected $telefono;
   protected $direccion;
   protected $email;
   protected $placa;
   protected $porPagina = 2;
   
   protected function guardarCliente(){
      $conexion = new Conexion();
      $query = "INSERT INTO clientes (documento, nombre, apellido, edad, telefono, direccion, email, placa) 
         VALUES (:documento, :nombre, :apellido, :edad, :telefono, :direccion, :email, :placa)"; 
      $statement = $conexion->pdo->prepare($query);
      $statement->bindValue(":documento", $this->documento);
      $statement->bindValue(":nombre", $this->nombre);
      $statement->bindValue(":apellido", $this->apellido);
      $statement->bindValue(":edad", $this->edad);
      $statement->bindValue(":telefono", $this->telefono);
      $statement->bindValue(":direccion", $this->direccion);
      $statement->bindValue(":email", $this->email);
      $statement->bindValue(":placa", $this->placa);
      $statement->execute();
      $conexion->cerrarConexion();
   }

   protected function actualizarCliente($id){
      $conexion = new Conexion();
      $query =
         "UPDATE clientes SET 
            documento = :documento,
            nombre = :nombre,
            apellido = :apellido,
            edad = :edad,
            telefono = :telefono,
            direccion = :direccion,
            email = :email,
            placa = :placa 
         WHERE (
            id = $id
         )";
      $statement = $conexion->pdo->prepare($query);
      $statement->bindValue(":documento", $this->documento);
      $statement->bindValue(":nombre", $this->nombre);
      $statement->bindValue(":apellido", $this->apellido);
      $statement->bindValue(":edad", $this->edad);
      $statement->bindValue(":telefono", $this->telefono);
      $statement->bindValue(":direccion", $this->direccion);
      $statement->bindValue(":email", $this->email);
      $statement->bindValue(":placa", $this->placa);
      $statement->execute();
      $conexion->cerrarConexion();
   }

   protected function seleccionarClientes($parametro = "nombre", $valor = "", $pagina = 1){
      $limite = "LIMIT " . ($pagina - 1) * $this->porPagina . ", " . $this->porPagina;
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM clientes ORDER BY id DESC $limite" : 
         "SELECT * FROM clientes WHERE $parametro LIKE '%" . htmlentities(addslashes($valor)) .
         "%' ORDER BY id DESC $limite";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return $statement->fetchAll(PDO::FETCH_OBJ);
   }

   protected function totalPaginas($parametro, $valor){
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM clientes ORDER BY id DESC" :
         "SELECT * FROM clientes WHERE $parametro LIKE '%" . htmlentities(addslashes($valor)) . "%' ORDER BY id DESC";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return ceil($statement->rowCount() / $this->porPagina);
   }

   protected function seleccionarPorParametro($parametro, $valor){
      $conexion = new Conexion();
      $query = "SELECT * FROM clientes WHERE $parametro = '$valor'";
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return $statement->rowCount() == 0 ? null : json_encode($statement->fetchAll(PDO::FETCH_OBJ)[0]);
   }

   protected function eliminarCliente($id){
      $conexion = new conexion();
      $query = "DELETE FROM clientes WHERE id = '$id'";
      $conexion->pdo->query($query);
      $conexion->cerrarConexion();
   }
}
