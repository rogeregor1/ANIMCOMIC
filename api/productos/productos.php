<?php
include_once '../../lib/db.php';

class Productos extends DB{

    function __construct(){
        parent::__construct();
    }

    public function get($id){
        $query = $this->conexion()->prepare('SELECT * FROM producto WHERE producto_id = :id LIMIT 0,20');
        $query->execute(['id' => $id]);

        $row = $query->fetch();

        return [
                'id'        => $row['producto_id'],
                'nombre'    => $row['producto_nombre'],
                'precio'    => $row['producto_precio'],
                'descripcion'=> $row['descripcion'],
                'stock'     => $row['producto_stock'],
                'categoria' => $row['categoria_id'],
                'imagen'    => $row['producto_foto']
                ];
    }

    public function getItemsByCategory($category){
        $query = $this->conexion()->prepare('SELECT * FROM producto WHERE categoria_id = :cat LIMIT 0,10');
        $query->execute(['cat' => $category]);
        $items = [];
        
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $item = [
                    'id'        => $row['producto_id'],
                    'nombre'    => $row['producto_nombre'],
                    'precio'    => $row['producto_precio'],
                    'descripcion'=> $row['descripcion'],
                    'stock'     => $row['producto_stock'],
                    'categoria' => $row['categoria_id'],
                    'imagen'    => $row['producto_foto']
                    ];
            array_push($items, $item);
        }
        return $items;
    }
}
