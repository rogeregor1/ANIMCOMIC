<nav class="navbar" role="navigation" aria-label="main navigation">

    <div class="navbar-brand">
        <div class="navbar-item" href="index.php?vista=home">
            <img class="anime" src="./img/anime.svg" width="49px" height="50px">
        </div>
        <div>
            <h4 class="subtitle">¡Bienvenido <?php echo ": " . $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>!</h4>
        </div>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navMenu">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div id="navMenu" class="navbar-menu">

        <ul class="navbar-start">

            <li class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Carrito</a>
                <div class="navbar-dropdown">
                    <a href="index.php?vista=home" class="navbar-item">Shopping</a>
                    <a href="index.php?vista=listaCarritos" class="navbar-item">Mis Pedidos</a>
                    <a href="index.php?vista=mostrarCarrito&user_id_up=<?php echo $_SESSION['id']; ?>" class="navbar-item">Pasarela de pago</a>
                </div>
            </li>

            <?php if ($_SESSION['rol'] == 1) { ?>
                <li class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">Usuarios</a>
                    <div class="navbar-dropdown">
                        <a href="index.php?vista=user_new" class="navbar-item">Nuevo</a>
                        <a href="index.php?vista=user_list" class="navbar-item">Lista</a>
                        <a href="index.php?vista=user_search" class="navbar-item">Buscar</a>
                    </div>
                </li>
            <?php } ?>

            <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
                <li class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">Productos</a>
                    <div class="navbar-dropdown">
                        <a href="index.php?vista=product_new" class="navbar-item">Nuevo</a>
                        <a href="index.php?vista=product_list" class="navbar-item">Lista</a>
                        <a href="index.php?vista=product_category" class="navbar-item">Por categoría</a>
                        <a href="index.php?vista=product_search" class="navbar-item">Buscar</a>
                    </div>
                </li>

                <li class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">Categorias</a>
                    <div class="navbar-dropdown">
                        <a href="index.php?vista=category_new" class="navbar-item">Nueva</a>
                        <a href="index.php?vista=category_list" class="navbar-item">Lista</a>
                        <a href="index.php?vista=category_search" class="navbar-item">Buscar</a>
                    </div>
                </li>
            <?php } ?>

        </ul>
        <div class="navbar-end">
            <div class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"></a>
            </div>
            <div class="navbar-item">
                <div class="buttons">
                    <a style="color:#fff;" href="index.php?vista=user_update&user_id_up=<?php echo $_SESSION['id']; ?>" class="button is-primary is-rounded">
                        <strong>Mi cuenta</strong>
                    </a>
                    <a style="color:#fff;" href="index.php?vista=logout" class="button is-link is-rounded">
                        Salir
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>