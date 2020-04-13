<?php

include '../Config/Conexion.php';

class Servicios{

   protected $Id;
   protected $Codigo;
   protected $Mantenimiento;
   protected $Reparacion;
   protected $Venta_repuestos;

   protected function SaveInfoServicio(){

      $conexion = new conexion();

      $sql = "INSERT INTO Servicio (Codigo,Mantenimiento,Reparacion,Venta_repuestos) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      
      $insert = $conexion->stm->prepare($sql);
      $insert->bindParam(1,$this->Codigo);
      $insert->bindParam(2,$this->Mantenimiento);
      $insert->bindParam(3,$this->Reparacion);
      $insert->bindParam(4,$this->Venta_repuestos);
   
      $insert->execute();
   }

   protected function SearchAllServicios(){
      $conexion = new conexion();
      $sql = "SELECT * FROM servicio";
      $search = $conexion->stm->prepare($sql);
      $search->execute();
      $objetoretornado = $search->fetchAll(PDO::FETCH_OBJ);
      return $objetoretornado;
   }

   protected function DeleteServicio(){
      $conexion = new conexion();
      $sql = "DELETE FROM servicio WHERE id ='$this->Id'";
      $delete = $conexion->stm->prepare($sql);
      $delete->execute();
   }

   /*
   protected function SearchAllServicios(){
      $conexion = new conexion();
      $sql = "SELECT * FROM servicio WHERE id ='$this->Id'";
      $update = $conexion->stm->prepare($sql);
      $update->execute();
      $objetoretornado = $update->fetchAll(PDO::FETCH_OBJ);
      return  $objetoretornado;
   }
   */

   protected function Changeservi(){
      $conexion = new conexion();
      $sql = "UPDATE servicio SET codigo='$this->Codigo', mantenimiento='$this->Mantenimiento', 
         reparacion='$this->Reparacion', venta_repuestos='$this->Venta_repuestos',  WHERE id ='$this->Id'";
      $chnge = $conexion->stm->prepare($sql);
      $change->execute();
   }
}
