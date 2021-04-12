<?php

class Producto implements JsonSerializable
{
    private $id;
    private $codigoBarras;
    private $nombre;
    private $tipo;
    private $stock;
    private $precio;

    public function __construct($codigoBarras, $nombre, $tipo, $stock, $precio, $id = null)
    {
        if(is_null($id)){
            $this->id = rand(1, 10000);
        }else{
            $this->id = $id;
        }
            
        $this->codigoBarras = $codigoBarras;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
    }

    public static function buscarProducto($codigoBarras, $productos){
        foreach ($productos as $producto) {
            if($producto->getCodigoBarras() == $codigoBarras){
                $stock = $producto->getStock();
                if($stock == 0) echo "Producto sin stock \n";
                return $stock;
            }
        }
        return false;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function agregarProducto($lista){
        $existeEnStock = false;
        foreach ($lista as $producto) {
            if($producto->getCodigoBarras() == $this->getCodigoBarras()){
                $producto->setStock($producto->getStock()+$this->getStock());
                $existeEnStock = true;
                echo 'Actualizado'."\n";
                return $lista;
            }
        }
        if(!$existeEnStock){
            $lista[] = $this;
            echo 'Ingresado'."\n";
            return $lista;
        }
        return false;
    }

    public static function guardarArchivo($listaProductos){
        $file = fopen('productos.json', 'w');
        if($file){
            foreach ($listaProductos as $producto) {
                if(!fwrite($file, json_encode($producto->jsonSerialize())."\n")){
                    echo 'ERROR al escribir el archivo'."\n";
                    fclose($file);
                    return false;
                }
            }
            fclose($file);
            return true;
        }else{
            echo 'Error de archivo'."\n";
            fclose($file);
            return false;
        }
    }

    public static function leerArchivo(){
        $productos = [];
        $file = fopen('productos.json', 'r');
        if($file){
            while(!feof($file)){
                $line = fgets($file);
                if($line){
                    $datos = json_decode($line);
                    $producto = new Producto($datos->codigoBarras, $datos->nombre, $datos->tipo, $datos->stock, $datos->precio, $datos->id);
                    $productos[] = $producto;
                }
            }
            fclose($file);
            return $productos;
        }else{
            echo 'ERROR No se pudo abrir el archivo'."\n";
        }
    }

    public function getCodigoBarras(){
        return $this->codigoBarras;
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