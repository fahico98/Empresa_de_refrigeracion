
<?php


session_start();

if(!isset($_SESSION["nombre"])){
   header("Location: http://localhost/WampCode/Yurani_Duque");
}

include "Config/Conexion.php";

$id = $_GET["id"];

$conexion = new Conexion();

$query = "SELECT * FROM facturas WHERE id = $id";
$statement = $conexion->pdo->query($query);
$factura = $statement->fetchAll(PDO::FETCH_OBJ)[0];

$query = "SELECT * FROM compras WHERE factura_id = $id";
$statement = $conexion->pdo->query($query);
$compras = $statement->fetchAll(PDO::FETCH_OBJ);

$productos = [];
$index = 0;

foreach($compras as $compra){

   $query = $compra->producto_id == null ?
      "SELECT * FROM productos WHERE id = '$compra->producto_id'" :
      "SELECT * FROM servicios WHERE id = '$compra->servicio_id'" ;
   $statement = $conexion->pdo->query($query);
   $producto = $statement->fetchAll(PDO::FETCH_OBJ)[0];

   $productos[$index] = $producto;

   $index++;
}

$conexion->cerrarConexion();

?>
