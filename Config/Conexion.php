<?php

class Conexion{

   public $pdo;

   public function __construct(){

      $db_host = "localhost";
      $db_name = "refrigeracion";
      $db_userName = "root";
      $db_password = "";

      try{
         
         $dns = "mysql:host=$db_host;charset=utf8";
         $this->pdo = new PDO($dns, $db_userName, $db_password);
         $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->pdo->query("USE $db_name");

      }catch(PDOException $th){
         echo "Error de Conexión: $th->getMessge()";
      }
   }
    
   public function cerrarConexion(){
      $pdo = null;
   }
}
