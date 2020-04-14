<?php

include '../Config/Conexion.php';

class Empleado{

   protected $id;
   protected $documento;
   protected $nombre;
   protected $apellido;
   protected $telefono;
   protected $cargo;
   protected $sueldo;
   protected $rol;
   protected $usuario;
   protected $contrasena;
   protected $porPagina = 2;

   protected function guardarEmpleado(){
      $conexion = new Conexion();
      $query = "INSERT INTO empleados (documento, nombre, apellido, telefono, cargo, sueldo) 
         VALUES (:documento, :nombre, :apellido, :telefono, :cargo, :sueldo)"; 
      $statement = $conexion->pdo->prepare($query);
      $statement->bindValue(":documento", $this->documento);
      $statement->bindValue(":nombre", $this->nombre);
      $statement->bindValue(":apellido", $this->apellido);
      $statement->bindValue(":telefono", $this->telefono);
      $statement->bindValue(":cargo", $this->cargo);
      $statement->bindValue(":sueldo", $this->sueldo);
      $statement->execute();
      $query = "SELECT id FROM empleados WHERE documento = :documento";
      $statement = $conexion->pdo->prepare($query);
      $statement->bindValue(":documento", $this->documento);
      $statement->execute();
      $id = $statement->fetchAll(PDO::FETCH_OBJ)[0]->id;
      $query = "INSERT INTO login (empleado_id, rol, usuario, contrasena) 
         VALUES ('$id', :rol, :usuario, :contrasena)"; 
      $statement = $conexion->pdo->prepare($query);
      $statement->bindValue(":rol", $this->rol);
      $statement->bindValue(":usuario", $this->usuario);
      $statement->bindValue(":contrasena", $this->contrasena);
      $statement->execute();
      $conexion->cerrarConexion();
   }

   protected function actualizarEmpleado($id){
      $conexion = new Conexion();
      $query =
         "UPDATE empleados SET 
            documento = :documento,
            nombre = :nombre,
            apellido = :apellido,
            telefono = :telefono,
            cargo = :cargo,
            sueldo = :sueldo
         WHERE (
            id = $id
         )";
      $statement = $conexion->pdo->prepare($query);
      $statement->bindValue(":documento", $this->documento);
      $statement->bindValue(":nombre", $this->nombre);
      $statement->bindValue(":apellido", $this->apellido);
      $statement->bindValue(":telefono", $this->telefono);
      $statement->bindValue(":cargo", $this->cargo);
      $statement->bindValue(":sueldo", $this->sueldo);
      $statement->execute();
      if(strcmp($this->contrasena, "") == 0){
         $query = "UPDATE login SET rol = :rol, usuario = :usuario WHERE (empleado_id = $id)";
         $statement = $conexion->pdo->prepare($query);
      }else{
         $query = "UPDATE login SET rol = :rol, usuario = :usuario, contrasena = :contrasena WHERE (empleado_id = $id)";
         $statement = $conexion->pdo->prepare($query);
         $statement->bindValue(":contrasena", $this->contrasena);
      }
      $statement->bindValue(":rol", $this->rol);
      $statement->bindValue(":usuario", $this->usuario);
      $statement->execute();
      $conexion->cerrarConexion();
   }

   protected function seleccionarEmpleados($parametro = "nombre", $valor = "", $pagina = 1){
      $limite = "LIMIT " . ($pagina - 1) * $this->porPagina . ", " . $this->porPagina;
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM empleados ORDER BY id DESC $limite" : 
         "SELECT * FROM empleados WHERE $parametro LIKE '%" . htmlentities(addslashes($valor)) .
         "%' ORDER BY id DESC $limite";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return $statement->fetchAll(PDO::FETCH_OBJ);
   }

   protected function totalPaginas($parametro, $valor){
      $query = strcmp($valor, "") == 0 ? "SELECT * FROM empleados ORDER BY id DESC" :
         "SELECT * FROM empleados WHERE $parametro LIKE '%" . htmlentities(addslashes($valor)) . "%' ORDER BY id DESC";
      $conexion = new Conexion();
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
      return ceil($statement->rowCount() / $this->porPagina);
   }

   protected function seleccionarPorParametro($parametro, $valor){
      $conexion = new Conexion();
      if(strcmp($parametro, "usuario") == 0){
         $query = "SELECT * FROM login WHERE usuario = '$valor'";
         $statement = $conexion->pdo->query($query);
         if($statement->rowCount() != 0){
            $empleado = $statement->fetchAll(PDO::FETCH_OBJ)[0];
            $query = "SELECT * FROM empleados WHERE id = '$empleado->empleado_id'";
            $statement = $conexion->pdo->query($query);
            $empleado = array_merge(
               (array) $empleado,
               (array) $statement->fetchAll(PDO::FETCH_OBJ)[0]
            );
            $empleado->contrasena = 
            $conexion->cerrarConexion();
            return json_encode($empleado);
         }else{
            $conexion->cerrarConexion();
            return null;
         }
      }else{
         $query = "SELECT * FROM empleados WHERE $parametro = '$valor'";
         $statement = $conexion->pdo->query($query);
         if($statement->rowCount() != 0){
            $empleado = $statement->fetchAll(PDO::FETCH_OBJ)[0];
            $query = "SELECT usuario, rol FROM login WHERE empleado_id = '$empleado->id'";
            $statement = $conexion->pdo->query($query);
            $empleado = array_merge(
               (array) $empleado,
               (array) $statement->fetchAll(PDO::FETCH_OBJ)[0]
            );
            $conexion->cerrarConexion();
            return json_encode($empleado);
         }else{
            $conexion->cerrarConexion();
            return null;
         }
      }
   }

   protected function eliminarEmpleado($id){
      $conexion = new conexion();
      $query = "DELETE FROM empleados WHERE id = '$id'";
      $conexion->pdo->query($query);
      /*
      $query = "DELETE FROM login WHERE empleado_id = '$id'";
      $conexion->pdo->query($query);
      */
      $conexion->cerrarConexion();
   }
}

?>