<?php

include '../Models/Cliente.php';

class ClientesController extends Cliente{
   
   // Fahico...!
   public function seleccionar($parametro, $valor, $pagina){
      return $this->seleccionarClientes($parametro, $valor, $pagina);
   }

   // Fahico...!
   public function seleccionarPorId($id){
      return $this->seleccionarPorParametro("id", $id);
   }

   public function seleccionarPorDocumento($documento){
      return $this->seleccionarPorParametro("documento", $documento);
   }

   public function seleccionarPorEmail($email){
      return $this->seleccionarPorParametro("email", $email);
   }

   public function seleccionarPorPlaca($placa){
      return $this->seleccionarPorParametro("placa", $placa);
   }

   // Fahico...!
   public function insertar($documento, $nombre, $apellido, $edad, $telefono, $direccion, $email, $placa){
      $this->documento = $documento;
      $this->nombre = $nombre;
      $this->apellido = $apellido;
      $this->edad = $edad;
      $this->telefono = $telefono;
      $this->direccion = $direccion;
      $this->email = $email;
      $this->placa = $placa;
      $this->guardarCliente();
   }

   public function editar($id, $documento, $nombre, $apellido, $edad, $telefono, $direccion, $email, $placa){
      $this->documento = $documento;
      $this->nombre = $nombre;
      $this->apellido = $apellido;
      $this->edad = $edad;
      $this->telefono = $telefono;
      $this->direccion = $direccion;
      $this->email = $email;
      $this->placa = $placa;
      $this->editar($id);
   }

   public function VerifyUpdate($id, $documento, $nombre, $edad, $telefono, $direccion, $correo, $placa){
      $this->Id = $id;
      $this->Documento = $documento;
      $this->Nombre = $nombre;
      $this->Edad = $edad;
      $this->Telefono = $telefono;
      $this->Direccion = $direccion;
      $this->Correo = $correo;
      $this->Placa = $placa;

      $this->ChangeClient();
      $this->redirect();
   }


   public function Delete($id){
      $this->Id = $id;
      $this->DeleteClient();
      $this->redirect();  
   }

   public function Update($id){
      $this->Id = $id;
      $objetoretornado = $this->SearchClient();
      require '../Views/Clientes/Update.php';
   }

   public function redirect(){
      header("location: ClientesController.php?accion=Index");
   }

   // Fahico...!
   public function plantillaClientes($clientes){
      $salida = "";
      if(count($clientes) !== 0){
         foreach($clientes as $cliente){
            $salida .= 
               "<tr class='text-center'>
                  <th scope='row'>" . str_pad($cliente->id, 6, "0", STR_PAD_LEFT) . "</th>
                  <td>" . $cliente->nombre . " " . $cliente->apellido . "</td>
                  <td>" . $cliente->documento .             "</td>
                  <td>" . $cliente->edad .                  "</td>
                  <td>" . $cliente->telefono .              "</th>
                  <td>" . $cliente->direccion .             "</td>
                  <td>" . $cliente->email .                 "</td>
                  <td>" . strtoupper($cliente->placa) .     "</td>
                  <td class='celdaDeAccion'>
                     <a href='#' class='text-primary linkEditar' id='" . $cliente->id . "'><small>Editar</small></a>
                     <a href='#' class='text-danger linkEliminar' id='" . $cliente->id . "'><small>Eliminar</small></a>
                  </td>
               </tr>";
         }
      }else{
         $salida = "<tr class='text-center'><h3>No hay clientes para mostrar...</h3><tr>";
      }
      return $salida;
   }

   // Fahico...!
   public function plantillaPaginacion($parametro, $valor, $pagina){
      $salida = "";
      $totalPaginas = $this->totalPaginas($parametro, $valor);
      for($i = 1 ; $i <= $totalPaginas; $i++){
         if($i == $pagina){
            $salida .= "<button type='button' class='btn btn-primary btn-sm ml-1 botonPagina' id='$i' disabled>$i</button>";
         }else{
            $salida .= "<button type='button' class='btn btn-primary btn-sm ml-1 botonPagina' id='$i'>$i</button>";
         }
      }
      return $salida;
   }
}

// Fahico...!
if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_id"){
      $cliCont = new ClientesController();
      $salida = $cliCont->seleccionarPorId($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}


// Fahico...!
if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_documento"){
      $cliCont = new ClientesController();
      $salida = $cliCont->seleccionarPorDocumento($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

// Fahico...!
if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_email"){
      $cliCont = new ClientesController();
      $salida = $cliCont->seleccionarPorEmail($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

// Fahico...!
if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_placa"){
      $cliCont = new ClientesController();
      $salida = $cliCont->seleccionarPorPlaca($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

// Fahico...!
if(isset($_POST['accion'])){
   if($_POST['accion'] == "insertar"){
      $cliCont = new ClientesController();
      $cliCont->insertar(
         $_POST['documento'],
         $_POST['nombre'],
         $_POST['apellido'],
         $_POST['edad'],
         $_POST['telefono'],
         $_POST['direccion'],
         $_POST['email'],
         $_POST['placa']
      );
   }
}

// Fahico...!
if(isset($_POST["accion"])){
   if($_POST["accion"] == "editar"){
      $cliCont = new ClientesController();
      $cliCont->editar(
         $_POST['id'],
         $_POST['documento'],
         $_POST['nombre'],
         $_POST['apellido'],
         $_POST['edad'],
         $_POST['telefono'],
         $_POST['direccion'],
         $_POST['email'],
         $_POST['placa']
      );
   }
}

// Fahico...!
if(isset($_GET['accion'])){
   if($_GET['accion'] == "seleccionar"){
      $cliCont = new ClientesController();
      echo $cliCont->plantillaClientes(
         $cliCont->seleccionar(
            $_GET["parametro"],
            $_GET["valor"],
            $_GET["pagina"]
         )
      );
   }
}

// Fahico...!
if(isset($_GET["accion"])){
   if($_GET["accion"] == "paginacion"){
      $cliCont = new ClientesController();
      echo $cliCont->plantillaPaginacion(
         $_GET["parametro"],
         $_GET["valor"],
         $_GET["pagina"]
      );
   }
}



if (isset($_GET['accion']) && $_GET['accion'] == "delete") {
   $ic = new ClientesController(); 
   $ic->Delete($_GET['id']);
}

if (isset($_GET['accion']) && $_GET['accion'] == "update") {
   $ic = new ClientesController(); 
   $ic->Update($_GET['id']);
}

if (isset($_POST['accion']) && $_POST['accion'] == "update") {
   $ic = new ClientesController(); 
   $id = $_POST['Id'];
   $documento = $_POST['Documento'];
   $nombre = $_POST['Nombre'];
   $edad = $_POST['Edad'];
   $telefono = $_POST['Telefono'];
   $direccion = $_POST['Direccion'];
   $placa = $_POST['Placa'];
   
   $ic->VerifyUpdate($id, $documento, $nombre, $edad, $telefono, $direccion, $correo, $placa);
}

