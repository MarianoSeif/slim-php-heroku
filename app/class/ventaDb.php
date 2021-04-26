<?php

include_once 'AccesoDatos.php';

class VentaDb implements JsonSerializable
{
    private $id;
    private $id_usuario;
    private $id_producto;
    private $cantidad;
    private $fecha_de_venta;
         
    public function __construct($id_usuario = null, $id_producto = null, $cantidad = null, $fecha_de_venta = null)
    {
        if(!is_null($id_usuario)){
            $this->id_usuario = $id_usuario;
        }
        if(!is_null($id_producto)){
            $this->id_producto = $id_producto;
        }
        if(!is_null($cantidad)){
            $this->cantidad = $cantidad;
        }
        if(!is_null($fecha_de_venta)){
            $this->fecha_de_venta = $fecha_de_venta;
        }
    }

    /* Ej 10 - K */
    public static function getVentasBetweenDates2($min, $max)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM ventas WHERE fecha_de_venta BETWEEN :minimo AND :maximo");
        $consulta->bindValue(':minimo', $min);
        $consulta->bindValue(':maximo', $max);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Ej 10 - I */
    public static function getTotalProductoVendidoPorUsuarioLocalidad($localidad)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT DISTINCT p.codigo_de_barra FROM ventas v JOIN productos p ON v.id_producto=p.id JOIN usuarios u ON v.id_usuario=u.id WHERE id_usuario=(SELECT id FROM usuarios WHERE localidad = :localidad LIMIT 1)");
        $consulta->bindValue(':localidad', $localidad, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Ej 10 - H */
    public static function getTotalProductoVendidoPorUsuario($cod, $id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT SUM(cantidad) AS Total FROM ventas JOIN productos p ON id_producto=p.id WHERE id_usuario=:id AND p.codigo_de_barra=:cod;");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':cod', $cod, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Ej 10 - G */
    public static function getMontos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT v.id AS Id, (v.cantidad * p.precio) AS Monto FROM ventas v JOIN productos p ON v.id_producto=p.id;");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }


    /* Ej 10 - F */
    public static function getNombresVentas()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT CONCAT(u.nombre, ' ',u.apellido) AS Usuario, p.nombre AS Producto FROM ventas v JOIN usuarios u ON id_usuario = u.id JOIN productos p ON id_producto = p.id");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Ej 10 - E */
    public static function getPrimerasNVentas($cantidad)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT DISTINCT p.codigo_de_barra FROM ventas JOIN productos p ON id_producto = p.id ORDER BY fecha_de_venta ASC LIMIT :cantidad");
        $consulta->bindValue(':cantidad', $cantidad);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Ej 10 - D */
    public static function getVentasBetweenDates($min, $max)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT SUM(cantidad) AS Total FROM ventas WHERE fecha_de_venta BETWEEN :minimo AND :maximo");
        $consulta->bindValue(':minimo', $min);
        $consulta->bindValue(':maximo', $max);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Ej 10 - C */
    public static function getVentasBetween($min, $max)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM ventas WHERE cantidad BETWEEN :minimo AND :maximo");
        $consulta->bindValue(':minimo', $min);
        $consulta->bindValue(':maximo', $max);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "VentaDb");
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function save()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO ventas(id_producto,id_usuario,cantidad,fecha_de_venta) values(:id_producto,:id_usuario,:cantidad,:fecha_de_venta)");
        $consulta->bindValue(':id_producto',$this->id_producto, PDO::PARAM_INT);
        $consulta->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
        $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
        $consulta->bindValue(':fecha_de_venta', $this->fecha_de_venta, PDO::PARAM_STR);
        return $consulta->execute();
    }
    
    public static function getAllVentas()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from ventas");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "VentaDb");
	}
   
    public static function crearListaHtml($ventas){
        $outputHtml = '<ul>';
        foreach ($ventas as $venta) {
            $outputHtml = $outputHtml.'<li>'.' id_producto: '.$venta->getIdProducto().', id_usuario: '.$venta->getIdUsuario().', fecha_de_venta: '.$venta->getFechaDeVenta().' Cantidad: '.$venta->getCantidad().'</li>';
        }
        $outputHtml = $outputHtml.'</ul>';
        
        return $outputHtml;
    }

    public function getIdProducto(){
        return $this->id_producto;
    }
    public function getIdUsuario(){
        return $this->id_usuario;
    }
    public function getFechaDeVenta(){
        return $this->fecha_de_venta;
    }
    public function getCantidad(){
        return $this->cantidad;
    }
    
}
