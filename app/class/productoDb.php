<?php

include 'AccesoDatos.php';

class ProductoDb
{
    private $id;
    private $codigo_de_barra;
    private $nombre;
    private $tipo;
    private $stock;
    private $precio;
    private $fecha_de_creacion;
    private $fecha_de_modificacion; 

    public function __construct($codigo_de_barra = null, $nombre = null, $tipo = null, $stock = null, $precio = null, $id = null)
    {
        if(!is_null($codigo_de_barra)){
            $this->codigo_de_barra = $codigo_de_barra;
        }
        if(!is_null($nombre)){
            $this->nombre = $nombre;
        }
        if(!is_null($tipo)){
            $this->tipo = $tipo;
        }
        if(!is_null($stock)){
            $this->stock = $stock;
        }
        if(!is_null($precio)){
            $this->precio = $precio;
        }
    }

    public static function getAllProductos()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from productos");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "ProductoDb");
	}
   
    public static function crearListaHtml($productos){
        $outputHtml = '<ul>';
        foreach ($productos as $producto) {
            $outputHtml = $outputHtml.'<li>'.' Nombre: '.$producto->getNombre().', CodBarra: '.$producto->getCodigoDeBarra().', Stock: '.$producto->getStock().' Precio: '.$producto->getPrecio().'</li>';
        }
        $outputHtml = $outputHtml.'</ul>';
        
        return $outputHtml;
    }

    public function getCodigoDeBarra(){
        return $this->codigo_de_barra;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function getStock(){
        return $this->stock;
    }
    public function getPrecio(){
        return $this->precio;
    }

    public function setStock($cantidad){
        $this->stock = $cantidad;
        return $this;
    }
    
}