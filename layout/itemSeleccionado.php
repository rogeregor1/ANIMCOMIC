<div class="seleccion" id="seleccion">
    <div class="cerrar" onclick="cerrar()">&#x2715</div>
    <div class="info">
        <img id="img" alt="" src="img/producto/<?php echo $item['imagen']; ?>" class="card-img-top" height="317px">
        <div class="card-body" style="background-color: lightgray;">
            <input type="hidden" id="id" value="<?php echo $item['id']; ?>">
            <h2 class="nombre" id="nombre"><?php echo $item['nombre']; ?></h2>
            <p class="descripcion" id="descripcion"><?php echo $item['descripcion']; ?></p>
            <div class="stock" id="stock"><?php echo $item['stock']; ?></div>
            <span class="precio" id="precio">€<?php echo $item['precio']; ?></span>
        </div>
    </div>
</div>