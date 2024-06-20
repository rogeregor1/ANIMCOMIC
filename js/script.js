let mostrador = document.getElementById("mostrador");
let idSeleccionada = document.querySelector("#id");
let imgSeleccionada = document.querySelector("#img");
let nombreSeleccionado = document.querySelector("#nombre");
let stockSeleccionado = document.getElementById("stock");
let descripSeleccionada = document.getElementById("descripcion");
let precioSeleccionado = document.getElementById("precio");
let seleccion = document.getElementById("seleccion");

function cargar(info){
    quitarBordes();
    mostrador.style.width = "32%";
    seleccion.style.width = "68%";
    seleccion.style.opacity = "1";
    info.style.border = "4px solid red";

    idSeleccionada.innerHTML =  info.getElementsByTagName("input")[0].innerHTML;

    imgSeleccionada.src = info.getElementsByTagName("img")[0].src;
    
    nombreSeleccionado.innerHTML =  info.getElementsByClassName("cardTitle")[0].innerHTML;

    stockSeleccionado.innerHTML =  info.getElementsByClassName("cardStock")[0].innerHTML;

    descripSeleccionada.innerHTML =  info.getElementsByClassName("cardText")[0].innerHTML;

    precioSeleccionado.innerHTML =  info.getElementsByClassName("cardPrecio")[0].innerHTML;

}
function cerrar(){
    mostrador.style.width = "100%";
    seleccion.style.width = "0%";
    seleccion.style.opacity = "0";
    quitarBordes();
}
function quitarBordes(){
    var items = document.getElementsByClassName("info");
    for(i=0;i <items.length; i++){
        items[i].style.border = "none";
    }
}