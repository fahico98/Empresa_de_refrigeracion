<?php
   
include '../Models/Servicio.php';

class ServiciosController extends Servicio{

   public function seleccionar($parametro, $valor, $pagina){
      return $this->seleccionarServicios($parametro, $valor, $pagina);
   }

   public function seleccionarPorId($id){
      return $this->seleccionarPorParametro("id", $id);
   }

   public function seleccionarPorNombre($nombre){
      return $this->seleccionarPorParametro("nombre", $nombre);
   }

   public function seleccionarPorTipo($tipo){
      return $this->seleccionarPorParametro("tipo", $tipo);
   }

   public function insertar($nombre, $tipo, $costo, $observaciones){
      $this->nombre = $nombre;
      $this->tipo = $tipo;
      $this->costo = $costo;
      $this->observaciones = $observaciones;
      $this->guardarServicio();
   }

   public function editar($id, $nombre, $tipo, $costo, $observaciones){
      $this->nombre = $nombre;
      $this->tipo = $tipo;
      $this->costo = $costo;
      $this->observaciones = $observaciones;
      $this->actualizarServicio($id);
   }

   public function eliminar($id){
      $this->eliminarServicio($id);
   }

   public function plantillaServicios($servicios){
      $salida = "";
      if(count($servicios) !== 0){
         foreach($servicios as $servicio){
            $salida .= 
               "<tr class='text-center'>
                  <th scope='row'>" . str_pad($servicio->id, 6, "0", STR_PAD_LEFT) . "</th>
                  <td>$servicio->nombre</td>
                  <td>$servicio->tipo</td>
                  <td>$servicio->costo</td>
                  <td><a href='#' class='verObservacionesServicio' id='$servicio->id'><small>ver</small></a></th>
                  <td class='celdaDeAccion' id='$servicio->id'>
                     <a href='#' class='text-primary linkEditar' id='$servicio->id'><small>Editar</small></a>
                     <a href='#' class='text-danger linkEliminar' id='$servicio->id'><small>Eliminar</small></a>
                  </td>
               </tr>";
         }
      }else{
         $salida =
            "<tr><td colspan='9' class='text-center'>
               <h4>No hay servicios para mostrar...</h4>
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
      $servCont = new ServiciosController();
      $salida = $servCont->seleccionarPorId($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_nombre"){
      $servCont = new ServiciosController();
      $salida = $servCont->seleccionarPorNombre($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_tipo"){
      $servCont = new ServiciosController();
      $salida = $servCont->seleccionarPorTipo($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_POST['accion'])){
   if($_POST['accion'] == "insertar"){
      $servCont = new ServiciosController();
      $servCont->insertar(
         $_POST['nombre'],
         $_POST['tipo'],
         $_POST['costo'],
         $_POST['observaciones']
      );
   }
}

if(isset($_POST["accion"])){
   if($_POST["accion"] == "editar"){
      $servCont = new ServiciosController();
      $servCont->editar(
         $_POST['id'],
         $_POST['nombre'],
         $_POST['tipo'],
         $_POST['costo'],
         $_POST['observaciones']
      );
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "seleccionar"){
      $servCont = new ServiciosController();
      echo $servCont->plantillaServicios(
         $servCont->seleccionar(
            $_GET["parametro"],
            $_GET["valor"],
            $_GET["pagina"]
         )
      );
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "paginacion"){
      $servCont = new ServiciosController();
      echo $servCont->plantillaPaginacion(
         $_GET["parametro"],
         $_GET["valor"],
         $_GET["pagina"]
      );
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "eliminar"){
      $servCont = new ServiciosController();
      $servCont->eliminar($_GET["id"]);
   }
}
