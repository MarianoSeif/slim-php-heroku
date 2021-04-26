<?php

include_once 'AccesoDatos.php';
class ProductoDb implements JsonSerializable
{
    private $id;
    private $codigo_de_barra;
    private $nombre;
    private $tipo;
    private $stock;
    private $precio;
    private $fecha_de_creacion;
    private $fecha_de_modificacion; 

    public function __construct($codigo_de_barra = null, $nombre = null, $tipo = null, $stock = null, $precio = null, $fecha_de_creacion = null, $fecha_de_modificacion = null, $id = null)
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
        if(!is_null($fecha_de_creacion)){
            $this->fecha_de_creacion = $fecha_de_creacion;
        }
        if(!is_null($fecha_de_modificacion)){
            $this->fecha_de_modificacion = $fecha_de_modificacion;
        }
    }

    /* Ej Parte 10 - B */
    public static function getAllProductsOrdered($modo)
    {
        switch ($modo) {
            case 'asc':
                $order = 'ASC';
                break;
            case 'desc':
                $order = 'DESC';
                break;
            default:
                echo "opcion incorrecta \n";
                return false;
                break;
        }
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM productos ORDER BY nombre $order, tipo $order");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "ProductoDb");
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function updateAll()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE productos SET nombre = :nombre, tipo = :tipo, stock = :stock, precio = :precio, fecha_de_modificacion = :fecha_de_modificacion WHERE codigo_de_barra = :codigo_de_barra");
        $consulta->bindValue(':codigo_de_barra',$this->codigo_de_barra, PDO::PARAM_INT);
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_de_modificacion', date('Y-m-d'), PDO::PARAM_STR);
        return $consulta->execute();
    }
    
    public function update(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE productos SET stock = :stock, fecha_de_modificacion = :fecha_de_modificacion WHERE codigo_de_barra = :codigo_de_barra");
        $consulta->bindValue(':codigo_de_barra',$this->codigo_de_barra, PDO::PARAM_INT);
        $consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
        $consulta->bindValue(':fecha_de_modificacion', $this->fecha_de_modificacion, PDO::PARAM_STR);
        return $consulta->execute();
    }
    
    public function save(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO productos(codigo_de_barra, nombre, tipo, stock, precio, fecha_de_creacion, fecha_de_modificacion) VALUES (:codigo_de_barra, :nombre, :tipo, :stock, :precio, :fecha_de_creacion, :fecha_de_modificacion)");
        $consulta->bindValue(':codigo_de_barra', $this->codigo_de_barra, PDO::PARAM_INT);
        $consulta->bindValue(':nombre',trim($this->nombre), PDO::PARAM_STR);
        $consulta->bindValue(':tipo', trim($this->tipo), PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_de_creacion', trim($this->fecha_de_creacion), PDO::PARAM_STR);
        $consulta->bindValue(':fecha_de_modificacion', trim($this->fecha_de_modificacion), PDO::PARAM_STR);
        return $consulta->execute();
    }

    public static function buscarProducto($codigoDeBarras){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from productos where codigo_de_barra = :cod");
        $consulta->bindValue(':cod', $codigoDeBarras);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "ProductoDb");
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

    public function getId(){
        return $this->id;
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

    public function setFechaModificacion(){
        $this->fecha_de_modificacion = date('Y-m-d');
    }
    
}