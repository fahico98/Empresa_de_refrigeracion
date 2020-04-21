<?php

include '../Config/Conexion.php';

class RegistroVehiculos{

   protected $id;
   protected $cliente_id;
   protected $placa;
   protected $modelo;
   protected $porPagina = 20;
   
   protected function guardar(){
      $conexion = new Conexion();
      $query = "SELECT placa FROM clientes WHERE id = $this->cliente_id";
      $statement = $conexion->pdo->query($query);
      $this->placa = $statement->fetchAll(PDO::FETCH_OBJ)[0]->placa;
      $query = "INSERT INTO registro_vehiculos (cliente_id, placa, modelo) 
         VALUES ('$this->cliente_id', '$this->placa', :modelo)"; 
      $statement = $conexion->pdo->prepare($query);
      $statement->bindValue(":modelo", $this->modelo);
      $statement->execute();
      $conexion->cerrarConexion();
   }

   protected function terminar(){
      $conexion = new conexion();
      $query = "UPDATE registro_vehiculos SET fecha_hora_salida = CURRENT_TIMESTAMP() WHERE cliente_id = $this->cliente_id";
      $conexion->pdo->query($query);
      $conexion->cerrarConexion();
   }
   
   protected function eliminar(){
      $conexion = new conexion();
      $query = "SELECT cliente_id FROM registro_vehiculos WHERE id = $this->id";
      $statement = $conexion->pdo->query($query);
      $this->cliente_id = $statement->fetchAll(PDO::FETCH_OBJ)[0]->cliente_id;
      $query = "UPDATE clientes SET registrado = 0 WHERE id = $this->cliente_id";
      $conexion->pdo->query($query);
      $query = "DELETE FROM registro_vehiculos WHERE id = $this->id";
      $conexion->pdo->query($query);
      $conexion->cerrarConexion();
   }

   protected function seleccionarRegistros($parametro = "id", $valor = "", $pagina = 1){
      $limite = "LIMIT " . ($pagina - 1) * $this->porPagina . ", " . $this->porPagina;
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM registro_vehiculos ORDER BY id DESC $limite" : 
         "SELECT * FROM registro_vehiculos WHERE $parametro LIKE '%" . htmlentities(addslashes($valor)) .
         "%' ORDER BY id DESC $limite";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return $statement->fetchAll(PDO::FETCH_OBJ);
   }

   protected function totalPaginas($parametro, $valor){
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM registro_vehiculos ORDER BY id DESC" :
         "SELECT * FROM registro_vehiculos WHERE $parametro LIKE '%" . htmlentities(addslashes($valor)) . "%' ORDER BY id DESC";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return ceil($statement->rowCount() / $this->porPagina);
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

   protected function seleccionarPorParametro($parametro, $valor){
      $conexion = new Conexion();
      $query = "SELECT * FROM clientes WHERE $parametro = '$valor'";
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return $statement->rowCount() == 0 ? null : json_encode($statement->fetchAll(PDO::FETCH_OBJ)[0]);
   }

   protected function registrarVehiculo($id){
      $conexion = new Conexion();
      $query = "UPDATE clientes SET registrado = 1 WHERE (id = $id)";
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
   }

   protected function quitarRegistroVehiculo($id){
      $conexion = new Conexion();
      $query = "UPDATE clientes SET registrado = 0 WHERE (id = $id)";
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
   }

}
