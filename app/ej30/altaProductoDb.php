<?php

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
                        echo 'No se pudo hacer1';
                    }
                }
            }else{
                $producto = new ProductoDb($codigoDeBarras, $nombre, $tipo, intval($stock), floatval($precio), date('Y-m-d'), date('Y-m-d'));
                if($producto->save()){
                    echo 'Ingresado';
                }else{
                    echo 'No se pudo hacer2';
                }
            }
        }else{
            echo 'No se pudo hacer3';
        }
}else{
    echo 'No se pudo hacer4';
}

function no(){
    echo 'No se pudo hacer5';
}
