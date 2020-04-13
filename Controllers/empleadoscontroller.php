<?php

include '../Models/Empleado.php';

class EmpleadosController extends Empleado{

   public function insert(){
      Include '../Views/Empleados/Insert.php';
   }

   public function Index(){
      $empleados = $this->SearchAllEmpleados();
      Include '../Views/EmpleadosIndex.php';
   }

   public function VerifyInsert($id, $Cedula, $nombre, $apellido, $telefono, $sueldo, $cargo){
      $this->Id = $id;
      $this->Cedula = $Cedula;
      $this->Nombre = $nombre;
      $this->Apellido = $apellido;
      $this->Telefono = $telefono;
      $this->Sueldo = $sueldo;
      $this->Cargo = $cargo;
      
      $this->SaveInfoempleados();
      $this->redirect();
   }

   public function VerifyUpdate($id, $Cedula, $nombre, $apellido, $telefono, $sueldo, $cargo){
      $this->Id = $id;
      $this->Cedula= $Cedula;
      $this->Nombre = $nombre;
      $this->Apellido = $apellido;
      $this->Telefono = $telefono;
      $this->Sueldo = $sueldo;
      $this->Cargo = $cargo;
      $this->SaveInfoempleados();
      $this->redirect();
   }

   public function Delete($id){
      $this->Id = $id;
      $this->DeleteEmpleado();
      $this->redirect();  
   }

   public function Update($id){
      $this->Id = $id;
      $objetoretornado = $this->SearchEmpleado();
      require '../Views/Empleados/Update.php';
   }

   public function redirect(){
      header("location: EmpleadosController.php?accion=Index");
   }
}

if (isset($_GET['accion']) && $_GET['accion'] == "Insert") {
   $ic = new EmpleadosController(); 
   $ic->Insert();
}


if (isset($_POST['accion']) && $_POST['accion'] == "Insert") {
   $ic = new EmpleadosController(); 
   $id = $_POST['Id'];
   $Cedula = $_POST['Cedula'];
   $nombre = $_POST['Nombre'];
   $apellido= $_POST['Apellido'];
   $telefono = $_POST['Telefono'];
   $sueldo = $_POST['Sueldo'];
   $cargo = $_POST['Cargo'];
   $ic->VerifyInsert($id, $cedula, $nombre, $apellido, $telefono, $sueldo, $cargo);
}

if (isset($_GET['accion']) && $_GET['accion'] == "Index") {
   $ic = new EmpleadosController(); 
   $ic->Index();
}

if (isset($_GET['accion']) && $_GET['accion'] == "delete") {
   $ic = new EmpleadosController(); 
   $ic->Delete($_GET['id']);
}

if (isset($_GET['accion']) && $_GET['accion'] == "update") {
   $ic = new EmpleadosController(); 
   $ic->Update($_GET['id']);
}

if (isset($_POST['accion']) && $_POST['accion'] == "update") {
   $ic = new EmpleadosController(); 
   $id = $_POST['Id'];
   $cedula= $_POST['Cedula'];
   $nombre = $_POST['Nombre'];
   $apellido = $_POST['Apellido'];
   $telefono = $_POST['Telefono'];
   $sueldo = $_POST['Sueldo'];
   $cargo = $_POST['Cargo'];
   $ic->VerifyUpdate($id, $cedula, $nombre, $apellido, $telefono, $sueldo, $cargo);
}

?>