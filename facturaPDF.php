
<?php

require_once __DIR__ . '/vendor/autoload.php';

session_start();

if(!isset($_SESSION["nombre"])){ header("Location: http://localhost/WampCode/Yurani_Duque"); }

include "Config/Conexion.php";

$id = $_GET["id"];

$conexion = new Conexion();

$query = "SELECT * FROM facturas WHERE id = $id";
$statement = $conexion->pdo->query($query);
$factura = $statement->fetchAll(PDO::FETCH_OBJ)[0];

$query = "SELECT * FROM clientes WHERE id = $factura->cliente_id";
$statement = $conexion->pdo->query($query);
$cliente = $statement->fetchAll(PDO::FETCH_OBJ)[0];

$query = "SELECT * FROM compras WHERE factura_id = $id";
$statement = $conexion->pdo->query($query);
$compras = $statement->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * FROM empleados WHERE id = " . $compras[0]->empleado_id;
$statement = $conexion->pdo->query($query);
$empleado = $statement->fetchAll(PDO::FETCH_OBJ)[0];

$productos = [];
$index = 0;

foreach($compras as $compra){
   $query = $compra->producto_id == null ?
   "SELECT * FROM servicios WHERE id = '$compra->servicio_id'" :
   "SELECT * FROM productos WHERE id = '$compra->producto_id'" ;
   $statement = $conexion->pdo->query($query);
   $producto = $statement->fetchAll(PDO::FETCH_OBJ)[0];
   $productos[$index] = $producto;
   $index++;
}

$conexion->cerrarConexion();

$contenido .=
   "<body>
      <h2 style='text-align: center'>Factura de compra</h2>
      <h4 style='text-align: center'>Refrigeracion JK S.A ltda - NIT: 16788787-1</h4>
      <h4 style='text-align: center'>Dirección: Carrera 112 - 42 Cali</h4>
      <h5 style='text-align: center'>Número de factura: " . str_pad($factura->id, 6, "0", STR_PAD_LEFT) . "</h5>
      <h5 style='text-align: center'>Fecha: $factura->fecha_hora</h5>
      <br>
      <p><strong>Cliente:</strong> $cliente->nombre $cliente->apellido. <strong>Documento:</strong> $cliente->documento.</p>
      <p><strong>Vendedor:</strong> $empleado->nombre $empleado->apellido. <strong>Documento:</strong> $empleado->documento.</p>
      <table style='border: none; width: 100%;'>
         <tr>
            <th style='text-align: left'><small>producto/servicio</small></th>
            <th><small>cantidad</small></th>
            <th><small>costo unitario</small></th>
            <th><small>costo total</small></th>
         </tr>";


for($i = 0; $i < count($compras); $i++){
   $contenido .=
      "<tr>
         <td><small>" . $productos[$i]->nombre . "</small></td>
         <td style='text-align: center'><small>" . $compras[$i]->cantidad_producto . "</small></td>
         <td style='text-align: center'><small>" . $productos[$i]->costo_unitario . "</small></td>
         <td style='text-align: center'><small>" . $compras[$i]->costo_compra . "</small></td>
      </tr>";
}

$contenido .=
      "</table>
      <p><strong>Total bruto:</strong> " . ($factura->costo_factura * 0.89) . "</p>
      <p><strong>Total neto:</strong> $factura->costo_factura (IVA 19%)</p>
   </body>";

$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($contenido);

$nombreArchivo = str_replace(" ", "_", "$cliente->apellido $cliente->nombre");
$nombreArchivo .= "_" . str_pad($factura->id, 6, "0", STR_PAD_LEFT);
$nombreArchivo .= "_" . str_replace(" ", "_", $factura->fecha_hora);

$mpdf->Output($nombreArchivo . ".pdf", "D");

?>
