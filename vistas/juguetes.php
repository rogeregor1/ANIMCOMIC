<?php
include_once 'controladores/cards_mostrar.php';
$item = new Cards(5);
?>
<body>
    <?php
    include_once('layout/menu.php');
    ?>
        <?php
        include "./inc/btn_back.php";
        ?>
        <main class="cards-container">
            <?php
            $response = json_decode(file_get_contents('http://localhost/ANIMCOMIC/api/productos/api-productos.php?categoria=1'), true);
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
    <script src="js/script.js"></script>
</body>