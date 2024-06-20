<?php
include '../controladores/cards_mostrar.php';
//$item = new Cards(5);
?>

<body>
    <?php
    include_once('layout/menu.php');
    ?>
    <main class="cards-container" id="productos">
        <?php
        $response = json_decode(file_get_contents('http://localhost/terminado/api/productos/api-productos.php?categoria=3'), true);
        if ($response['statuscode'] == 200) {
            foreach ($response['items'] as $item) {
                include('layout/items.php');
            }
        } else {
            echo $response['response'];
        }
        ?>
    </main>


</body>
    <script>
        /*
    document.addEventListener('DOMContentLoaded', () => {
        const carrito = document.getElementById('carrito-container');
        const tablaCont = document.querySelector('#tabla');
        const totalCarrito = document.getElementById('total');
        const productos = document.getElementById('productos');

        productos.addEventListener('click', agregarAlCarrito);

        function agregarAlCarrito(e) {
            if (e.target.classList.contains('agregar-carrito')) {
                const producto = e.target.parentElement;
                obtenerDatosProducto(producto);
            }
        }

        function obtenerDatosProducto(producto) {
                    const id = producto.getAttribute('data-id');
                    const nombre = producto.getAttribute('data-nombre');
                    const precio = parseFloat(producto.getAttribute('data-precio'));

                    // Agregar al carrito y enviar al servidor
                    agregarAlCarritoDOM(id, nombre, precio);
                    //enviarAlServidor(id);
                }

                function enviarAlServidor(producto_id) {
                    const xhr = new XMLHttpRequest();
                    const url = 'ruta_hacia_tu_archivo_php.php';
                    const params = 'producto_id=' + producto_id;

                    xhr.open('POST', url, true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log(xhr.responseText);
                        }
                    };

                    xhr.send(params);
                }


        function agregarAlCarritoDOM(id, nombre, precio) {
            const item = document.createElement('li');
            item.innerHTML = `${nombre} - $${precio.toFixed(2)} <button class="borrar-item" data-id="${id}">Eliminar</button>`;
            tablaCont.appendChild(item);

            actualizarTotal();
        }

        tablaCont.addEventListener('click', borrarItem);

        function borrarItem(e) {
            if (e.target.classList.contains('borrar-item')) {
                const item = e.target.parentElement;
                const itemId = e.target.getAttribute('data-id');

                tablaCont.removeChild(item);

                actualizarTotal();
            }
        }

        function actualizarTotal() {
            let total = 0;
            const itemsCarrito = tablaCont.querySelectorAll('li');

            itemsCarrito.forEach((item) => {
                const precio = parseFloat(item.textContent.split('-')[1].trim().replace('$', ''));
                total += precio;
            });

            totalCarrito.textContent = total.toFixed(2);
        }
    });
  */
    </script>
    