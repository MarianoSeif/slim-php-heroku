<?php

/*
Seif Mariano

Aplicación No 33 ( ModificacionProducto BD)
Archivo: modificacionproducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto:
el código de barras .
Retorna un :
“Actualizado” si ya existía y se actualiza
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase

*/

require '../class/productoDb.php';

if( isset($_POST["codigoBarras"]) && !empty($_POST["codigoBarras"]) 
    && isset($_POST["nombre"]) && !empty($_POST["nombre"]) 
    && isset($_POST["tipo"]) && !empty($_POST["tipo"]) 
    && isset($_POST["stock"]) && !empty($_POST["stock"]) 
    && isset($_POST["precio"]) && !empty($_POST["precio"]) ){

        $producto = new ProductoDb($_POST["codigoBarras"],$_POST["nombre"],$_POST["tipo"],$_POST["stock"],$_POST["precio"]);
        $productosEnDb = ProductoDb::buscarProducto($producto->getCodigoDeBarra());
        if($productosEnDb[0] && !is_null($productosEnDb[0])){
            if($producto->updateAll()){
                echo 'Actualizado';
            }else{
                echo 'No se pudo hacer';
            }
        }else{
            echo 'No se encontró el producto';
        }        
}else{
    echo 'ERROR: Debe enviar todos los datos';
}
