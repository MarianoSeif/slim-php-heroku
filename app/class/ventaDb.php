<?php

include 'AccesoDatos.php';

class VentaDb
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
