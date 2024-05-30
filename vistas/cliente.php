<?php
include_once 'controladores/cards_mostrar.php';
$item = new Cards(5);
?>

<body>
    <?php
    include_once('layout/menu.php');
    ?>
    <main class="cards-container" id="productos">
        <?php
        $response = json_decode(file_get_contents('http://localhost/terminado/api/productos/api-productos.php?categoria=libros'), true);
        if ($response['statuscode'] == 200) {
            foreach ($response['items'] as $item) {
                include('layout/items.php');
            }
        } else {
            echo $response['response'];
        }
        ?>

    </main>

    <script src="js/main.js"></script>
</body>