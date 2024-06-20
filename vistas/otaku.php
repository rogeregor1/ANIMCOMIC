<body>
    <?php
    include_once ('layout/menu.php');
    ?>
    <main>
        <?php
        $response = json_decode(file_get_contents('http://localhost/ANIMCOMIC/api/productos/api-productos.php?categoria=otaku'), true);
        if ($response['statuscode'] == 200) {
            foreach ($response['items'] as $item) {
                include ('layout/items.php');
            }
        } else {
            echo $response['response'];
        }
        ?>
    </main>

    <script src="js/main.js"></script>
</body>