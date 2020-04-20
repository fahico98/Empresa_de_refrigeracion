<?php

include '../Models/Login.php';
include_once 'StarterController.php';

$isc = new StarterController();

class LoginController extends Login{

   public function insert(){
      Include '../Views/Login/Insert.php';
   }

   public function Login(){
      Include '../Views/Login/Login.php';
   }

   public function Index(){
      Include '../Views/Login/Index.php';
   }

   public function cerrarSesion(){
      session_destroy();
      header("Location: http://localhost/WampCode/Yurani_Duque");
   }

   public function VerifyInsert($username,$password){
      $this->Username = $username;
      $this->Password = $password;
      $this->SaveInfoLogin();
   }

   // Fahico...!
   public function verificarLogin($usuario, $contrasena, $ajax = false){
      $this->usuario = $usuario;
      $this->contrasena = $contrasena;
      $datosLogin = $this->buscarLogin();
      if($datosLogin != null){
         if(password_verify($contrasena, $datosLogin->contrasena)){
            if($ajax){ echo("credenciales_validas"); }else{
               session_start();
               $_SESSION["id"] = $datosLogin->empleado_id;
               $_SESSION["nombre"] = $this->nombreEmpleado($datosLogin->empleado_id);
               $_SESSION["usuario"] = $datosLogin->usuario;
               $_SESSION["rol"] = $datosLogin->rol;
               header("Location: ../Views/dashboard.php");
            }
         }
      }
   }

   public function redirect(){
      header("location: LoginController.php?accion=Indexlo");
   }

   public function RedirectLogin(){
      header("location: LoginController.php?accion=Login");
   }
}

if(isset($_POST["accion"])){
   if($_POST["accion"] == "login"){
      $logCont = new LoginController();
      $logCont->verificarLogin($_POST["usuarioLogin"], $_POST["contrasenaLogin"], isset($_POST["ajax"]));
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "logout"){
      $logCont = new LoginController(); 
      $logCont->cerrarSesion();
   }
}

if(isset($_GET['accion']) && $_GET['accion'] == "Insertlo"){
   $ic = new LoginController(); 
   $ic->Insert();
}

if(isset($_GET['accion']) && $_GET['accion'] == "Indexlo"){
   $ic = new LoginController(); 
   $ic->Index();
}

if(isset($_GET['accion']) && $_GET['accion'] == "Login"){
   $ic = new LoginController(); 
   $ic->Login();
}

if(isset($_POST['accion']) && $_POST['accion'] == "Insert"){
   $ic = new LoginController(); 
   $username = $_POST['Username'];
   $contrasena = $_POST['Password'];
   $password = password_hash($contrasena, PASSWORD_ARGON2ID);
   $ic->VerifyInsert($username,$password);
}
