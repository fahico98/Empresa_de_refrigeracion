<?php

include '../Models/Empleado.php';

class EmpleadosController extends Empleado{

   public function seleccionar($parametro, $valor, $pagina){
      return $this->seleccionarEmpleados($parametro, $valor, $pagina);
   }

   public function seleccionarPorId($id){
      return $this->seleccionarPorParametro("id", $id);
   }

   public function seleccionarPorDocumento($documento){
      return $this->seleccionarPorParametro("documento", $documento);
   }

   public function seleccionarPorUsuario($documento){
      return $this->seleccionarPorParametro("usuario", $documento);
   }

   public function insertar($documento, $nombre, $apellido, $telefono, $cargo, $sueldo, $rol, $usuario, $contrasena){
      $this->documento = $documento;
      $this->nombre = $nombre;
      $this->apellido = $apellido;
      $this->telefono = $telefono;
      $this->cargo = $cargo;
      $this->sueldo = $sueldo;
      $this->rol = $rol;
      $this->usuario = $usuario;
      $this->contrasena = $contrasena;
      $this->guardarEmpleado();
   }

   public function editar($id, $documento, $nombre, $apellido, $telefono, $cargo, $sueldo, $rol, $usuario, $contrasena){
      $this->documento = $documento;
      $this->nombre = $nombre;
      $this->apellido = $apellido;
      $this->telefono = $telefono;
      $this->cargo = $cargo;
      $this->sueldo = $sueldo;
      $this->rol = $rol;
      $this->usuario = $usuario;
      $this->contrasena = $contrasena;
      $this->actualizarEmpleado($id);
   }

   public function eliminar($id){
      $this->eliminarEmpleado($id);
   }

   public function plantillaEmpleados($empleados){
      $salida = "";
      if(count($empleados) !== 0){
         foreach($empleados as $empleado){
            $salida .= 
               "<tr class='text-center'>
                  <th scope='row'>" . str_pad($empleado->id, 6, "0", STR_PAD_LEFT) . "</th>
                  <td>" . $empleado->nombre . " " . $empleado->apellido . "</td>
                  <td>" . $empleado->documento .             "</td>
                  <td>" . $empleado->telefono .              "</th>
                  <td>" . $empleado->cargo .                 "</td>
                  <td>" . $empleado->sueldo .                "</td>
                  <td class='celdaDeAccion'>
                     <a href='#' class='text-primary linkEditar' id='" . $empleado->id . "'><small>Editar</small></a>
                     <a href='#' class='text-danger linkEliminar' id='" . $empleado->id . "'><small>Eliminar</small></a>
                  </td>
               </tr>";
         }
      }else{
         $salida =
            "<tr><td colspan='9' class='text-center'>
               <h4>No hay empleados para mostrar...</h4>
            </td></tr>";
      }
      return $salida;
   }

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


if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_id"){
      $empCont = new EmpleadosController();
      $salida = $empCont->seleccionarPorId($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_documento"){
      $empCont = new EmpleadosController();
      $salida = $empCont->seleccionarPorDocumento($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_usuario"){
      $empCont = new EmpleadosController();
      $salida = $empCont->seleccionarPorUsuario($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_POST['accion'])){
   if($_POST['accion'] == "insertar"){
      $empCont = new EmpleadosController();
      $empCont->insertar(
         $_POST['documento'],
         $_POST['nombre'],
         $_POST['apellido'],
         $_POST['telefono'],
         $_POST['cargo'],
         $_POST['sueldo'],
         $_POST['rol'],
         $_POST['usuario'],
         password_hash($_POST['contrasena'], PASSWORD_DEFAULT)
      );
   }
}

if(isset($_POST["accion"])){
   if($_POST["accion"] == "editar"){
      $empCont = new EmpleadosController();
      $contrasena = strcmp($_POST['contrasena'], "") == 0 ? "" :
         password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
      $empCont->editar(
         $_POST['id'],
         $_POST['documento'],
         $_POST['nombre'],
         $_POST['apellido'],
         $_POST['telefono'],
         $_POST['cargo'],
         $_POST['sueldo'],
         $_POST['rol'],
         $_POST['usuario'],
         $contrasena
      );
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "seleccionar"){
      $empCont = new EmpleadosController();
      echo $empCont->plantillaEmpleados(
         $empCont->seleccionar(
            $_GET["parametro"],
            $_GET["valor"],
            $_GET["pagina"]
         )
      );
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "paginacion"){
      $empCont = new EmpleadosController();
      echo $empCont->plantillaPaginacion(
         $_GET["parametro"],
         $_GET["valor"],
         $_GET["pagina"]
      );
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "eliminar"){
      $empCont = new EmpleadosController();
      $empCont->eliminar($_GET["id"]);
   }
}

?>