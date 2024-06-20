<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'lib/config.php';

$mensaje = "";

if (isset($_POST['btnAccion'])) {

    switch ($_POST['btnAccion']) {
        case 'Agregar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $ID = openssl_decrypt($_POST['id'], COD, KEY);
                $mensaje .= "ok Id correcto" . $ID . "<br/>";
            } else {
                $mensaje .= "Upss... Id incorrecto" . $ID . "<br/>";
            }

            if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                $NOMBRE = openssl_decrypt($_POST['nombre'], COD, KEY);
                $mensaje .= "OK NOMBRE" . $NOMBRE . "<br/>";
            } else {
                $mensaje .= "Upss... algo pasa con el nombre" . "<br/>";
                break;
            }

            if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
                $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
                $mensaje .= "OK CANTIDAD" . $CANTIDAD . "<br/>";
            } else {
                $mensaje .= "Upss... algo pasa con la cantidad" . "<br/>";
                break;
            }

            if (is_numeric(openssl_decrypt($_POST['stock'], COD, KEY))) {
                $STOCK = openssl_decrypt($_POST['stock'], COD, KEY);
                $mensaje .= "OK STOCK" . $STOCK . "<br/>";
            } else {
                $mensaje .= "Upss... algo pasa con el stock" . "<br/>";
                break;
            }

            if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                $PRECIO = openssl_decrypt($_POST['precio'], COD, KEY);
                $mensaje .= "OK PRECIO" . $PRECIO . "<br/>";
            } else {
                $mensaje .= "Upss... algo pasa con el precio" . "<br/>";
                break;
            }

            if (!isset($_SESSION['CARRITO'])) {

                $producto = array(
                    'ID' => $ID,
                    'NOMBRE' => $NOMBRE,
                    'CANTIDAD' => $CANTIDAD,
                    'STOCK' => $STOCK, // Assigning decrypted stock value to $STOCK
                    'PRECIO' => $PRECIO
                );
                $_SESSION['CARRITO'][0] = $producto;
                $mensaje = "Producto agregado al carrito";
            } else {
                $idProductos = array_column($_SESSION['CARRITO'], "ID");
                if (in_array($ID, $idProductos)) {
                    foreach ($_SESSION['CARRITO'] as &$producto) { // Using reference to update quantity
                        if ($producto['ID'] == $ID) {
                        if ($producto['CANTIDAD'] < $producto['STOCK']) { // Check if quantity is less than stock
                            $producto['CANTIDAD'] += 1; // Increment quantity
                            $mensaje = "Producto agregado al carrito";
                        } else {
                            $mensaje = "No se puede agregar más productos, alcanzado el límite de stock";
                        }
                        break;
                    }
                }         
                } else {

                    $NumeroProductos = count($_SESSION['CARRITO']);
                    $producto = array(
                        'ID' => $ID,
                        'NOMBRE' => $NOMBRE,
                        'CANTIDAD' => $CANTIDAD,
                        'STOCK' => $STOCK, // Assigning decrypted stock value to $STOCK
                        'PRECIO' => $PRECIO
                    );
                    $_SESSION['CARRITO'][$NumeroProductos] = $producto;
                    $mensaje = "Producto agregado al carrito";
                } 
                //$mensaje = print_r($_SESSION, true);
            }
            break;

        case "Eliminar":
            if (isset($_POST['id']) && isset($_POST['cantidad'])) {
                $ID = openssl_decrypt($_POST['id'], COD, KEY);
                $CANT = openssl_decrypt($_POST['cantidad'], COD, KEY);
                
                foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                    if ($producto['ID'] == $ID) {
                        if ($producto['CANTIDAD'] == 1) {
                            unset($_SESSION['CARRITO'][$indice]); // Eliminar el producto del carrito
                            //echo "<script>alert('Elemento borrado...');</script>";
                        } else {
                            $_SESSION['CARRITO'][$indice]['CANTIDAD'] -= 1; // Decrementar la cantidad
                            //echo "<script>alert('Cantidad actualizada...');</script>";
                        }
                        break;
                    }
                }
            } else {
                $mensaje .= "Upss... Id incorrecto" . $ID . "<br/>";
            }
            break;
    }
}
