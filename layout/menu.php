<nav>
    <ul>
    <li class="nav-item active"><a class="nav-link" href="index.php?vista=mostrarCarrito" tabindex="-1" aria-disabled="true">
        Carrito(<?php echo empty($_SESSION['CARRITO']) ? 0 : count($_SESSION['CARRITO']); ?>)</a>
    </li>
        <li><a href="index.php?vista=home">Anime</a></li>
        <li><a href="index.php?vista=libros">Libros</a></li>
        <li><a href="index.php?vista=juguetes">Juguetes</a></li>
    </ul>
</nav>