<?php

$id = $_POST['id'];
$cantidad = $_POST['cantidad'];

if($id === '' || $cantidad=== ''){
    echo json_encode('error');
}else{
    echo json_encode('Correcto: <br>Id:'.$id.'<br>Cantidad:'.$cantidad);
}