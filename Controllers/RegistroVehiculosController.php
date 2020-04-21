<?php
   
include '../Models/RegistroVehiculos.php';

class RegistroVehiculosController extends RegistroVehiculos{

   public function seleccionar($parametro, $valor, $pagina){
      return $this->seleccionarRegistros($parametro, $valor, $pagina);
   }

   public function tablaClientes(){
      return file_get_contents("../Views/RegistroVehiculos/tablaClientes.php");
   }

   public function tablaRegistroVehiculos(){
      return file_get_contents("../Views/RegistroVehiculos/tablaRegistroVehiculos.php");
   }

   public function insertarRegistroVehiculo($cliente_id, $modelo){
      $this->cliente_id = $cliente_id;
      $this->modelo = $modelo;
      $this->guardar();
   }

   public function terminarRegistroVehiculo($cliente_id){
      $this->cliente_id = $cliente_id;
      $this->terminar();
   }

   public function eliminarRegistroVehiculo($id){
      $this->id = $id;
      $this->eliminar();
   }
   
   public function plantillaRegistroVehiculos($registros){
      $salida = "";
      if(count($registros) !== 0){
         foreach($registros as $registro){
            $salida .= 
               "<tr class='text-center'>
                  <th scope='row'>" . str_pad($registro->id, 6, "0", STR_PAD_LEFT) . "</th>
                  <td>" . strtoupper($registro->placa) . "</td>
                  <td>$registro->modelo</td>
                  <td>$registro->fecha_hora_entrada</td>";
            $salida .= ($registro->fecha_hora_salida == null) ?
               "<td>---</td>":
               "<td>$registro->fecha_hora_salida</td>";
            $salida .=
               "<td class='celdaDeAccion'>
                  <a href='#' class='text-danger linkEliminar' id='$registro->id'><small>eliminar</small></a>
               </td></tr>";
         }
      }else{
         $salida =
            "<tr><td colspan='6' class='text-center'>
               <h4>No hay registros para mostrar...</h4>
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

if(isset($_GET['accion'])){
   if($_GET['accion'] == "tabla_clientes"){
      $regVehiCont = new RegistroVehiculosController();
      echo $regVehiCont->tablaClientes();
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "tabla_registro_vehiculos"){
      $regVehiCont = new RegistroVehiculosController();
      echo $regVehiCont->tablaRegistroVehiculos();
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "seleccionar"){
      $regVehiCont = new RegistroVehiculosController();
      echo $regVehiCont->plantillaRegistroVehiculos(
         $regVehiCont->seleccionar(
            $_GET["parametro"],
            $_GET["valor"],
            $_GET["pagina"]
         )
      );
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "paginacion"){
      $regVehiCont = new RegistroVehiculosController();
      echo $regVehiCont->plantillaPaginacion(
         $_GET["parametro"],
         $_GET["valor"],
         $_GET["pagina"]
      );
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "insertar"){
      $regVehiCont = new RegistroVehiculosController();
      $regVehiCont->insertarRegistroVehiculo($_GET["cliente_id"], $_GET["modelo"]);
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "terminar"){
      $regVehiCont = new RegistroVehiculosController();
      $regVehiCont->terminarRegistroVehiculo($_GET["cliente_id"]);
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "eliminar"){
      $regVehiCont = new RegistroVehiculosController();
      $regVehiCont->eliminarRegistroVehiculo($_GET["id"]);
   }
}

