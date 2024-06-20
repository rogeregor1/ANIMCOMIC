<div class="cards__item">
    <div class="card-prod">
        <div class="info" onclick="cargar(this)">
            <input type="hidden" id="id" value="<?php echo $item['id']; ?>">
            <div id="img" class="contenedor-foto"><img src="img/producto/<?php echo $item['imagen']; ?>" /></div>
            <div class="card__content" data-id="<?php echo $item['id']; ?>" data-nombre="<?php echo $item['nombre']; ?>"
                data-precio="<?php echo $item['precio']; ?>">
                <div class="cardTitle" id="nombre"><?php echo $item['nombre']; ?></div>
                <div class="cardText" id="descripcion" hidden><?php echo $item['descripcion']; ?></div>
                <div class="cardPrecio" id="precio">€<?php echo $item['precio']; ?> </div>
                <div class="cardStock" id="stock" hidden>stock:<?php echo $item['stock']; ?>Unid.</div>
            </div>
        </div>
        <form action="#" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($item['id'], COD, KEY); ?>">
            <input type="hidden" name="nombre" id="nombre"
                value="<?php echo openssl_encrypt($item['nombre'], COD, KEY); ?>">
            <input type="hidden" name="precio" id="precio"
                value="<?php echo openssl_encrypt($item['precio'], COD, KEY); ?>">
            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">
            <input type="hidden" name="stock" id="stock"
                value="<?php echo openssl_encrypt($item['stock'], COD, KEY); ?>"><br><br>
            <button class="agregar-carrito" name="btnAccion" value="Agregar" type="submit">Agregar al
                Carrito</button>
        </form>
    </div>
</div>