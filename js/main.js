
document.addEventListener('DOMContentLoaded', () =>{
    const cookies = document.cookie.split(';');
    let cookie = null;
    cookies.forEach(item =>{
        if(item.indexOf('items') > -1){
            cookie = item;
        }
    });
    if(cookie != null){
        const count = cookie.split('=')[1];
        //console.log(count);
        document.querySelector('.btn-carrito').innerHTML = `(${count}) Carrito`;
    }
})

const bCarrito = document.querySelector('.btn-carrito');

bCarrito.addEventListener('click', (e) =>{
    e.preventDefault();
    const carritoContainer = document.querySelector('#carrito-container');

    if(carritoContainer.style.display == ''){
        carritoContainer.style.display = 'block';
        actualizarCarritoUI();
    }else{
        carritoContainer.style.display = '';
    }
});

function actualizarCarritoUI(){
    fetch('http://localhost/ANIMCOMIC/api/carrito/api-carrito.php?action=mostrar')
    .then(response =>{
        return response.json();
    })
    .then(data =>{
        console.log(data);
        let tablaCont = document.querySelector('#tabla');
        let precioTotal = '';
        let formula = `<form action="index.php?vista=mostrarCarrito" id="formulario" method="POST">`;
        let html = ``;
        data.items.forEach(element => {
            html += `
                <div class='fila'>
                    <div class='imagen'><img src='img/producto/${element.imagen}' width='100%'/></div>
                    <div class='info'>
                        <input type='hidden' name="id"  value='${element.id}'/>
                        <div class='nombre' name="nombre" >${element.nombre}</div>
                        <input type='hidden' name="cantidad" value='${element.cantidad}'/>
                        <input type='hidden' name="stock"  value='${element.stock}'/>
                        <input type='hidden' name="precio"  value='${element.precio}'/>
                        <div>${element.cantidad} Unidades de €${element.precio}</div>
                        <div>Subtotal: €${element.subtotal}</div>
                        <div class='boton'><button class='btn btn-remove'>Quitar 1 del carrito</button></div>
                        </div>
                </div>
            `;
        });
            submit = `
            <input type="text" name="id" value="<?php echo openssl_encrypt($_POST['id'], COD, KEY); ?>">
            <input  type="text" name="nombre" value="<?php echo openssl_encrypt($_POST['nombre'], COD, KEY); ?>">
            <input  type="text" name="cantidad" value="<?php echo openssl_encrypt($_POST['cantidad'], COD, KEY); ?>">
            <input type="text" name="stock" value="<?php echo openssl_encrypt($_POST['stock'], COD, KEY); ?>">
            <input  type="text" name="precio" value="<?php echo openssl_encrypt($_POST['precio'], COD, KEY); ?>">
            <button class="btn btn-danger" type="submit">Enviar</button>
            `;
        precioTotal = `<p class="precio-total">Total: €${data.info.total}</p>`;
        tablaCont.innerHTML = precioTotal + formula + html + submit;
        document.cookie = `items=${data.info.count}`;
        document.querySelector('.btn-carrito').innerHTML = `(${data.info.count}) Carrito`;
        document.querySelectorAll('.btn-remove').forEach(boton =>{
            boton.addEventListener('click', () => {
                const id = boton.parentElement.parentElement.children[0].value;
                removeItemFromCarrito(id);
            })
        });
    });
}

const botones = document.querySelectorAll('.agregar-carrito');

botones.forEach(boton => {
    const id = boton.parentElement.parentElement.children[0].value;

    boton.addEventListener('click', e =>{
        addItemToCarrito(id);
    });
});

const addItemToCarrito = id =>{
    fetch('http://localhost/ANIMCOMIC/api/carrito/api-carrito.php?action=add&id=' + id)
    .then(response =>{
        return response.text();
    })
    .then(data =>{
        actualizarCarritoUI();
    });
};

const removeItemFromCarrito = id =>{
    fetch('http://localhost/ANIMCOMIC/api/carrito/api-carrito.php?action=remove&id=' + id)
    .then(response =>{
        return response.json();
    })
    .then(data =>{
        console.log(data.statuscode);
        actualizarCarritoUI();
    });
};
