<?php
   
include '../Models/Producto.php';

class ProductosController extends Producto{

   public function seleccionar($parametro, $valor, $pagina){
      return $this->seleccionarProductos($parametro, $valor, $pagina);
   }

   public function seleccionarPorId($id){
      return $this->seleccionarPorParametro("id", $id);
   }

   public function seleccionarPorNombre($nombre){
      return $this->seleccionarPorParametro("nombre", $nombre);
   }

   public function seleccionarPorClase($clase){
      return $this->seleccionarPorParametro("clase", $clase);
   }

   public function seleccionarPorMarca($marca){
      return $this->seleccionarPorParametro("marca", $marca);
   }

   public function insertar($nombre, $clase, $marca, $cantidad, $costo_unitario, $observaciones){
      $this->nombre = $nombre;
      $this->clase = $clase;
      $this->marca = $marca;
      $this->cantidad = $cantidad;
      $this->costo_unitario = $costo_unitario;
      $this->observaciones = $observaciones;
      $this->guardarProducto();
   }

   public function editar($id, $nombre, $clase, $marca, $cantidad, $costo_unitario, $observaciones){
      $this->nombre = $nombre;
      $this->clase = $clase;
      $this->marca = $marca;
      $this->cantidad = $cantidad;
      $this->costo_unitario = $costo_unitario;
      $this->observaciones = $observaciones;
      $this->actualizarProducto($id);
   }

   public function eliminar($id){
      $this->eliminarProducto($id);
   }

   public function plantillaProductos($productos){
      $salida = "";
      if(count($productos) !== 0){
         foreach($productos as $producto){
            $salida .= 
               "<tr class='text-center'>
                  <th scope='row'>" . str_pad($producto->id, 6, "0", STR_PAD_LEFT) . "</th>
                  <td>" . $producto->nombre .            "</td>
                  <td>" . $producto->clase .             "</td>
                  <td>" . $producto->marca .             "</td>
                  <td>" . $producto->cantidad .          "</td>
                  <td>" . $producto->costo_unitario .    "</td>
                  <td>" . $producto->observaciones .     "</th>
                  <td class='celdaDeAccion'>
                     <a href='#' class='text-primary linkEditar' id='" . $producto->id . "'><small>Editar</small></a>
                     <a href='#' class='text-danger linkEliminar' id='" . $producto->id . "'><small>Eliminar</small></a>
                  </td>
               </tr>";
         }
      }else{
         $salida =
            "<tr><td colspan='9' class='text-center'>
               <h4>No hay productos para mostrar...</h4>
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
      $prodCont = new ProductosController();
      $salida = $prodCont->seleccionarPorId($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_nombre"){
      $prodCont = new ProductosController();
      $salida = $prodCont->seleccionarPorNombre($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}


if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_clase"){
      $prodCont = new ProductosController();
      $salida = $prodCont->seleccionarPorClase($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_marca"){
      $prodCont = new ProductosController();
      $salida = $prodCont->seleccionarPorMarca($_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_POST['accion'])){
   if($_POST['accion'] == "insertar"){
      $prodCont = new ProductosController();
      $prodCont->insertar(
         $_POST['nombre'],
         $_POST['clase'],
         $_POST['marca'],
         $_POST['cantidad'],
         $_POST['costo_unitario'],
         $_POST['observaciones']
      );
   }
}

if(isset($_POST["accion"])){
   if($_POST["accion"] == "editar"){
      $prodCont = new ProductosController();
      $prodCont->editar(
         $_POST['id'],
         $_POST['nombre'],
         $_POST['clase'],
         $_POST['marca'],
         $_POST['cantidad'],
         $_POST['costo_unitario'],
         $_POST['observaciones']
      );
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "seleccionar"){
      $prodCont = new ProductosController();
      echo $prodCont->plantillaProductos(
         $prodCont->seleccionar(
            $_GET["parametro"],
            $_GET["valor"],
            $_GET["pagina"]
         )
      );
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "paginacion"){
      $prodCont = new ProductosController();
      echo $prodCont->plantillaPaginacion(
         $_GET["parametro"],
         $_GET["valor"],
         $_GET["pagina"]
      );
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "eliminar"){
      $prodCont = new ProductosController();
      $prodCont->eliminar($_GET["id"]);
   }
}
