<?php

include '../Config/Conexion.php';

class Empleado{

   protected $Id;
   protected $Cedula;
   protected $Nombre;
   protected $apellido;
   protected $Telefono;
   protected $sueldo;
   protected $cargo;
   
   protected function SaveInfoEmpleados(){

      $conexion = new conexion();

      $sql = "INSERT INTO empleado (Id, Cedula, Nombre, Apellido, Telefono, Sueldo, Cargo, Foto, Foto_url) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      
      $insert = $conexion->stm->prepare($sql);
      $insert->bindParam(1, $this->Id);
      $insert->bindParam(2, $this->Cedula);
      $insert->bindParam(3, $this->Nombre);
      $insert->bindParam(4, $this->Apellido);
      $insert->bindParam(5, $this->Telefono);
      $insert->bindParam(6, $this->Sueldo);
      $insert->bindParam(7, $this->Cargo);
   
      $insert->execute();
   }

   protected function SearchAllEmpleados(){
      $conexion = new conexion();
      $sql = "SELECT * FROM empleado";
      $search = $conexion->stm->prepare($sql);
      $search->execute();
      $objetoretornado = $search->fetchAll(PDO::FETCH_OBJ);
      return $objetoretornado;
   }

   protected function Deleteempeado(){
      $conexion = new conexion();
      $sql = "DELETE FROM empleado WHERE id = '$this->Id'";
      $delete = $conexion->stm->prepare($sql);
      $delete->execute();
   }

   protected function Searchempleado(){
      $conexion = new conexion();
      $sql = "SELECT * FROM empleado WHERE id = '$this->Id'";
      $update = $conexion->stm->prepare($sql);
      $update->execute();
      $objetoretornado = $update->fetchAll(PDO::FETCH_OBJ);
      return  $objetoretornado;
   }

   protected function changeempleado(){
      $conexion = new conexion();
      $sql = "UPDATE empleado SET  id = '$this->Id', Cedula = '$this->Cedula' Nombre = '$this->Nombre',
         Apellido = '$this->Apellido', Telefono = '$this->Telefono', sueldo = '$this->Sueldo', Cargo = '$this->Cargo',
         foto='$this->Foto' WHERE id = '$this->Id'";
      $chnge = $conexion->stm->prepare($sql);
      $change->execute();
   }
}

?>