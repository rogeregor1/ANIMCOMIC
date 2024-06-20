<?php

include 'lib/db.php';
include 'controladores/carritoCompras.php';
?>
<?php
if ($_POST) {
    $total = 0;
    $SID = session_id();
    $Correo = $_POST['email'];
    foreach ($_SESSION['CARRITO'] as $indice => $producto) {

        $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']);
    }
    $sentencia = $pdo->prepare("INSERT INTO `tblVentas` 
    (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `status`) 
    VALUES (NULL, :ClaveTransaccion, '', NOW(), :Correo, :Total, 'pendiente');");

    $sentencia->bindParam(":ClaveTransaccion", $SID);
    $sentencia->bindParam(":Correo", $Correo);
    $sentencia->bindParam(":Total", $total);
    $sentencia->execute();
    $idVenta = $pdo->lastInsertId();

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {

        $sentencia = $pdo->prepare("INSERT INTO `tblDetalleVenta` 
        (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `DESCARGADO`) 
        VALUES (NULL, :IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD, '0');");

        $sentencia->bindParam(":IDVENTA", $idVenta);
        $sentencia->bindParam(":IDPRODUCTO", $producto['ID']);
        $sentencia->bindParam(":PRECIOUNITARIO", $producto['PRECIO']);
        $sentencia->bindParam(":CANTIDAD", $producto['CANTIDAD']);
        $sentencia->execute();
    }
    //echo "<h3>" . $total . "</h3>";
?>
<?php } else {
  echo "<br><br><br><h3>No hay tranferencia </h3>";
} ?>
</div>
<div class="jumbotron text-center">
    <h1 class="display-4">!Paso Final</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de Pagar con PaPal la cantidad de:
    <h4>€<?php echo number_format($total, 2); ?></h4>
    </p>
    <p>Los productos podran ser descargados una vez se procese el pago<br>
    <strong>(para aclaraciones: rogerhurtado1809@gmail.com)</strong></p>
</div>
