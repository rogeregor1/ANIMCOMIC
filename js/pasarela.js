//console.log('funcionando');

var fila = document.querySelector('.info');
var respuesta = document.getElementById('respuesta');
//console.dir(fila)
fila.addEventListener('submit', function(e){
    e.preventDefault();
    //console.log('me diste un click')

    var datos = new FormData(fila);

    console.log(datos)
    console.log(datos.get('id'))

    fetch('post.php',{
        method: 'POST',
        body: datos
    })
        .then( res => res.json())
        .then( data => {
            console.log(data)
            const respuesta = document.getElementById('respuesta')
            if(data === 'error'){
                respuesta.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    Llena todos los campos
                </div>
                `
            }else{
                respuesta.innerHTML = `
                <div class="alert alert-primary" role="alert">
                    ${data}
                </div>
                `
            }
        } )
})