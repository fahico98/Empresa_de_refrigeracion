<?php
   
include '../Models/Servicios.php';

class ServiciosController extends servicio{

   public function insert(){
      Include '../Views/Servicios/Insert.php';
   }

   public function Index(){
      $clientes = $this->SearchAllServicios();
      Include '../Views/Servicios/Index.php';
   }

   public function VerifyInsert($codigo, $matenimiento, $reparacion, $venta_repuestos){
      $this->Codigo = $codigo;
      $this->Mantenimiento = $mantenimiento;
      $this->Reparacion = $reparacion;
      $this->Venta_repuestos = $Venta_repuestos;
      $this->SaveInfoServicios();
      $this->redirect();
   }

   public function VerifyUpdate($id, $codigo, $mantenimiento, $reparacion, $venta_repuestos){
      $this->Id = $id;
      $this->Codigo = $codigo;
      $this->Mantenimiento = $Mantenimiento;
      $this->Reparacion = $reparacion;
      $this->Venta_repuestos = $venta_repuestos;
      $this->ChangeServicios();
      $this->redirect();
   }

   public function Delete($id){
      $this->Id = $id;
      $this->DeleteServicios();
      $this->redirect();  
   }

   public function Update($id){
      $this->Id = $id;
      $objetoretornado = $this->Searchservicios();
      require '../Views/servicios/Update.php';
   }

   public function redirect(){
      header("location: ServiciosController.php?accion=Index");
   }
}

if (isset($_GET['accion']) && $_GET['accion'] == "Insert") {
   $ic = new ServiciosController(); 
   $ic->Insert();
}


if (isset($_POST['accion']) && $_POST['accion'] == "Insert") {
   $ic = new ServiciosController(); 
   $codigo = $_POST['Codigo'];
   $mantenimiento = $_POST['Mantenimiento'];
   $reparacion = $_POST['Reparacion'];
   $venta_repuestos = $_POST['Venta repuestos'];
   $ic->VerifyInsert($codigo,$mantenimiento,$reparacion,$venta_repuestos);
}

if (isset($_GET['accion']) && $_GET['accion'] == "Index") {
   $ic = new ServiciosController(); 
   $ic->Index();
}

if (isset($_GET['accion']) && $_GET['accion'] == "delete") {
   $ic = new ServiciosController(); 
   $ic->Delete($_GET['id']);
}

if (isset($_GET['accion']) && $_GET['accion'] == "update") {
   $ic = new ServiciosController(); 
   $ic->Update($_GET['id']);
}

if (isset($_POST['accion']) && $_POST['accion'] == "update") {
   $ic = new ServiciosController(); 
   $id = $_POST['Id'];
   $codigo = $_POST['Codigo'];
   $mantenimiento = $_POST['Mantenimiento'];
   $reparacion = $_POST['Reparacion'];
   $venta_repuestos = $_POST['Venta_repuestos'];
   $ic->VerifyUpdate($id, $codigo, $mantenimiento, $reparacion, $venta_repuestos);
}

?>