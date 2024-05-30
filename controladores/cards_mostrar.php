<?php

include_once 'lib/db.php';

class Cards extends Db{

    private $paginaActual;
    private $totalPaginas;
    private $nResultados;
    private $resultadosPorPagina;
    private $indice;

    private $error = false;

    function __construct($nPorPagina){
        parent::__construct();

        $this->resultadosPorPagina = $nPorPagina;
        $this->indice = 0;
        $this->paginaActual = 1;

        $this->calcularPaginas();
    }

    function mostrarProductos($cat){
        $response = json_decode(file_get_contents('http://localhost/ANIMCOMIC/api/productos/api-productos.php?categoria=' . $cat), true);
		if ($response['statuscode'] == 200) {
			foreach ($response['items'] as $item) {
				include('layout/items.php');
			}
		} else {
			echo $response['response'];
		}
	
    }
  
    function calcularPaginas(){
        $queryTotalResultados = $this->conexion()->query('SELECT COUNT(*) AS total FROM producto');
        $this->nResultados = $queryTotalResultados->fetch(PDO::FETCH_OBJ)->total; 
        $this->totalPaginas = round($this->nResultados / $this->resultadosPorPagina);

        if(isset($_GET['pagina'])){
            if(is_numeric($_GET['pagina'])){
                if($_GET['pagina']>=1 && $_GET['pagina'] <= $this->totalPaginas){
                $this->paginaActual = $_GET['pagina'];
                $this->indice = ($this->paginaActual - 1) * $this->resultadosPorPagina;
            }else{
                echo "no existe pagina";
                $this->error = true;
            }
        }else{
            echo "Error al mostrar pagina";
            $this->error = true;
        }
    
    }
}
    function mostrarPaginas(){
        $actual = '';
        echo "<ul>";

        for($i=0; $i < $this->totalPaginas; $i++){
            if(($i + 1) == $this->paginaActual){
                $actual = ' class="actual" ';
            }else{
                $actual = '';
            }
            echo '<li><a ' .$actual . 'href="?vista=home&pagina='. ($i + 1). '">'. ($i + 1) . '</a></li>';
        }
        echo "</ul>";
    }

    function mostrarTotalResultados(){
        return $this->nResultados;
    }

}
?>