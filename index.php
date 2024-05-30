<?php
require "inc/session_start.php";
require_once "lib/config.php";
require_once "php/main.php";
require_once "controladores/carritoCompras.php";
?>
    <?php
    if (!isset($_GET['vista']) || $_GET['vista'] == "") {
        $_GET['vista'] = "login";
    }

    if (is_file("./vistas/" . $_GET['vista'] . ".php") && $_GET['vista'] != "login" && $_GET['vista'] != "404") {
        include "./inc/head.php";
        include "./inc/navbar.php";
    ?>
        <div class="container">
            <!-- ALERTAS(todas las alertas) -->
            <?php if ($mensaje != "") { ?>
                <div class="alert alert-succsess">
                    <?php echo $mensaje; ?>
                    <a href="index.php?vista=mostrarCarrito" class="badge badge-success">Ver Carrito</a>
                </div>
            <?php } ?>

            <section class="contenido">
                <!-- CONTENEDOR DETALLES ITEM SELECCIONADO -->
                <?php include('layout/itemSeleccionado.php'); ?>
                
                <!-- CONTENEDOR TODOS LOS ITEMS GET_API X CATEGORIA -->
                <div class="mostrador" id="mostrador">
                    <?php include "./vistas/" . $_GET['vista'] . ".php"; ?>
                </div>
            </section>
        </div>

    <?php
        /*== Cerrar sesion ==*/
        if ((!isset($_SESSION['id']) || $_SESSION['id'] == "") || (!isset($_SESSION['rol']) || $_SESSION['rol'] == "")) {
            include "./vistas/logout.php";
            exit();
        }
    } else {
        if ($_GET['vista'] == "login") {
            include "./vistas/login.php";
        } else {
            include "./vistas/404.php";
        }
    }
    ?>
    <?php
    include "inc/script.php";
    include "inc/footer.php";
    ?>
