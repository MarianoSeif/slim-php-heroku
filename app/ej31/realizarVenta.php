<?php

require '../class/productoDb.php';
require '../class/userDb.php';
require '../class/ventaDb.php';


if( isset($_POST["codigoBarras"]) && !empty($_POST["codigoBarras"]) 
    && isset($_POST["id"]) && !empty($_POST["id"])
    && isset($_POST["cantidad"]) && !empty($_POST["cantidad"]) ){

        $codigoBarras = intval($_POST["codigoBarras"]);
        $cantidad = intval($_POST["cantidad"]);
        $idUser = intval($_POST["id"]);

        $productos = ProductoDb::buscarProducto($codigoBarras);
        $user = UserDb::buscarUsuario($idUser);
        
        if($productos[0] && !is_null($productos[0]) && ($stock = $productos[0]->getStock()) >= $cantidad && $user){
            $venta = new VentaDb($idUser, $productos[0]->getId(), $cantidad, date('Y-m-d'));
            if($venta->save()){
                $productos[0]->setStock($productos[0]->getStock()-$cantidad)->update();
                echo "venta realizada \n";
            }
        }else{
            echo "no se pudo hacer \n";
        }
}else{
    echo 'No se pudo hacer2';
}
