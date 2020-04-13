<?php

include '../Config/Conexion.php';

class Login{

   protected $id;
   protected $usuario;
   protected $contrasena;
   
   protected function SaveInfoLogin(){
      $conexion = new Conexion();
      $sql = "INSERT INTO users (Username, Password) VALUES (?, ?)";
      $insert = $conexion->stm->prepare($sql);
      $insert->bindParam(1, $this->usuario);
      $insert->bindParam(2, $this->contrasena);
      $insert->execute();
   }

   // Fahico...!
   protected function buscarLogin(){
      $conexion = new Conexion();
      $query = "SELECT * FROM login WHERE usuario = :usuario";
      $respuesta = $conexion->pdo->prepare($query);
      $respuesta->bindValue(":usuario", $this->usuario);
      $respuesta->execute();
      $objRespuesta = $respuesta->fetchAll(PDO::FETCH_OBJ);
      return count($objRespuesta) == 0 ? null : $objRespuesta[0];
   }

   // Fahico...!
   protected function nombreEmpleado($id){
      $conexion = new Conexion();
      $query = "SELECT * FROM empleados WHERE id = :id";
      $respuesta = $conexion->pdo->prepare($query);
      $respuesta->bindValue(":id", $id);
      $respuesta->execute();
      $objRespuesta = $respuesta->fetchAll(PDO::FETCH_OBJ);
      return count($objRespuesta) == 0 ? null : $objRespuesta[0]->nombre;
   }
}
