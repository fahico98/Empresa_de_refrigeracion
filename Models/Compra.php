
<?php

include '../Config/Conexion.php';

class Compra{

   protected $producto_id;
   protected $servicio_id;
   protected $empleado_id;
   protected $factura_id;
   protected $cantidad;
   protected $costo_compra;

   protected function insertarCompraProducto(){
      $this->insertarCompra("producto");
   }

   protected function insertarCompraServicio(){
      $this->insertarCompra("servicio");
   }

   private function insertarCompra($id_flag){
      $conexion = new Conexion();
      if(strcmp($id_flag, "producto") == 0){
         $query = "SELECT cantidad FROM productos WHERE id = $this->producto_id";
         $statement = $conexion->pdo->query($query);
         $cantidadActual = ($statement->fetchAll(PDO::FETCH_OBJ)[0])->cantidad;
         $nuevaCantidad = $cantidadActual - $this->cantidad;
         $query = "UPDATE productos SET cantidad = $nuevaCantidad WHERE id = $this->producto_id";
         $statement = $conexion->pdo->query($query);
         $query = 
            "INSERT INTO compras (
               producto_id,
               empleado_id,
               factura_id,
               cantidad_producto,
               costo_compra
            ) VALUES (
               $this->producto_id,
               $this->empleado_id,
               $this->factura_id,
               $this->cantidad,
               $this->costo_compra
            )";
      }else{
         $query = 
            "INSERT INTO compras (
               servicio_id,
               empleado_id,
               factura_id,
               cantidad_producto,
               costo_compra
            ) VALUES (
               $this->servicio_id,
               $this->empleado_id,
               $this->factura_id,
               $this->cantidad,
               $this->costo_compra
            )";
      }
      $statement = $conexion->pdo->query($query);
      $conexion->cerrarConexion();
   }

}

?>