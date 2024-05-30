<div class="cards__item">
    <div class="card-prod" onclick="cargar(this)">
        <input type="hidden" id="id" value="<?php echo $item['id']; ?>">
        <div id="img" class="contenedor-foto"><img src="img/producto/<?php echo $item['imagen']; ?>" /></div>
        <div class="card__content" data-id="<?php echo $item['id']; ?>" data-nombre="<?php echo $item['nombre']; ?>" data-precio="<?php echo $item['precio']; ?>">
            <div class="cardTitle" id="nombre"><?php echo $item['nombre']; ?></div>
            <div class="cardText" id="descripcion" hidden><?php echo $item['descripcion'];  ?></div>
            <div class="cardPrecio" id="precio">€<?php echo $item['precio']; ?> </div>
            <div class="cardStock" id="stock" hidden>stock:<?php echo $item['stock'];?>Unid.</div>
            <button class="agregar-carrito">Agregar al Carrito</button>
        </div>
    </div>
</div>