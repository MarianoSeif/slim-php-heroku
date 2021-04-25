<?php

/*
Seif Mariano

Aplicación No 30 ( AltaProducto BD)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
, carga la fecha de creación y crear un objeto ,se debe utilizar sus métodos para poder
verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega .
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase

*/

require '../class/productoDb.php';

if( isset($_POST["codigoBarras"]) && !empty($_POST["codigoBarras"]) 
    && isset($_POST["nombre"]) && !empty($_POST["nombre"]) 
    && isset($_POST["tipo"]) && !empty($_POST["tipo"]) 
    && isset($_POST["stock"]) && !empty($_POST["stock"]) 
    && isset($_POST["precio"]) && !empty($_POST["precio"]) ){

        $codigoDeBarras = $_POST["codigoBarras"];
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];
        $stock = $_POST["stock"];
        $precio = $_POST["precio"];
        
        $productos = ProductoDb::buscarProducto($codigoDeBarras);
        
        if(isset($productos)){
            if(count($productos) > 0){
                if($productos[0]->getNombre() == $nombre && $productos[0]->getTipo() == $tipo && $productos[0]->getPrecio() == $precio){
                    $productos[0]->setStock($productos[0]->getStock() + $stock);
                    $productos[0]->setFechaModificacion();
                    if($productos[0]->update()){
                        echo 'Actualizado';
                    }else{
                        echo 'No se pudo hacer';
                    }
                }
            }else{
                $producto = new ProductoDb($codigoDeBarras, $nombre, $tipo, intval($stock), floatval($precio), date('Y-m-d'), date('Y-m-d'));
                if($producto->save()){
                    echo 'Ingresado';
                }else{
                    echo 'No se pudo hacer';
                }
            }
        }else{
            echo 'No se pudo hacer';
        }
}else{
    echo 'No se pudo hacer';
}
