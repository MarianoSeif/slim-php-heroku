<?php

/*
Seif Mariano

Parte 10
A. Obtener los detalles completos de todos los usuarios y poder ordenarlos
alfabéticamente de forma ascendente o descendente.
B. Obtener los detalles completos de todos los productos y poder ordenarlos
alfabéticamente de forma ascendente y descendente.
C. Obtener todas las compras filtradas entre dos cantidades.
D. Obtener la cantidad total de todos los productos vendidos entre dos fechas.
E. Mostrar los primeros “N” números de productos que se han enviado.
F. Mostrar los nombres del usuario y los nombres de los productos de cada venta.
G. Indicar el monto (cantidad * precio) por cada una de las ventas.
H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario
(ejemplo: 104).
I. Obtener todos los números de los productos vendidos por algún usuario filtrado por
localidad (ejemplo: ‘Avellaneda’).
J. Obtener los datos completos de los usuarios filtrando por letras en su nombre o
apellido.
K. Mostrar las ventas entre dos fechas del año.

*/

require '../class/userDb.php';
require '../class/productoDb.php';
require '../class/ventaDb.php';

if( isset($_POST["datos"]) && !empty($_POST["datos"]) 
    && isset($_POST["punto"]) && !empty($_POST["punto"])
){
    if($_POST["datos"] == 'punto10'){
        switch ($_POST["punto"]) {
            case 'A':
                if( isset($_POST["modo"]) && !empty($_POST["modo"])){
                    $users = userDb::getAllUsersOrdered($_POST["modo"]);
                    echo json_encode($users);
                }else{
                    echo 'faltan datos en el post';
                }
                break;
            case 'B':
                if( isset($_POST["modo"]) && !empty($_POST["modo"])){
                    $productos = ProductoDb::getAllProductsOrdered($_POST["modo"]);
                    echo json_encode($productos);
                }else{
                    echo 'faltan datos en el post';
                }   
                break;
            case 'C':
                if( isset($_POST["min"]) && !empty($_POST["min"]) && ctype_digit($_POST["min"])
                    && isset($_POST["max"]) && !empty($_POST["max"]) && ctype_digit($_POST["max"])) {
                        $ventas = VentaDb::getVentasBetween($_POST["min"], $_POST["max"]);
                        echo json_encode($ventas);
                }else{
                    echo 'faltan datos en el post';
                }
                break;
            case 'D':
                if( isset($_POST["fecha1"]) && !empty($_POST["fecha1"])
                    && isset($_POST["fecha2"]) && !empty($_POST["fecha2"])) {
                        $totalVentas = VentaDb::getVentasBetweenDates($_POST["fecha1"], $_POST["fecha2"]);
                        if( isset($totalVentas) && !empty($totalVentas) && !is_null($totalVentas)){
                            echo json_encode($totalVentas);
                        }else{
                            echo 'No se encontraron ventas';
                        }
                }else{
                    echo 'faltan datos en el post';
                }
                break;

            case 'E':
                if( isset($_POST["cantidad"]) && !empty($_POST["cantidad"])) {
                    $codigos = VentaDb::getPrimerasNVentas($_POST["cantidad"]);
                    if( isset($codigos) && !empty($codigos) && !is_null($codigos)){
                        echo json_encode($codigos);
                    }else{
                        echo 'No se encontraron productos';
                    }
                }else{
                    echo 'faltan datos en el post';
                }
                break;

            case 'F':
                $datos = VentaDb::getNombresVentas();
                if( isset($datos) && !empty($datos) && !is_null($datos)){
                    echo json_encode($datos);
                }else{
                    echo 'No se encontraron productos';
                }
                
                break;

            case 'G':
                $datos = VentaDb::getMontos();
                if( isset($datos) && !empty($datos) && !is_null($datos)){
                    echo json_encode($datos);
                }else{
                    echo 'No se encontraron datos';
                }
                break;
            
            case 'H':
                if( isset($_POST["codigo_de_barra"]) && !empty($_POST["codigo_de_barra"]) 
                    && isset($_POST["id"]) && !empty($_POST["id"])
                ){
                    $datos = VentaDb::getTotalProductoVendidoPorUsuario($_POST['codigo_de_barra'], $_POST['id']);
                    if( isset($datos) && !empty($datos) && !is_null($datos)){
                        echo json_encode($datos);
                    }else{
                        echo 'No se encontraron datos';
                    }
                }
                break;
            case 'I':
                if( isset($_POST["localidad"]) && !empty($_POST["localidad"])
                ){
                    $datos = VentaDb::getTotalProductoVendidoPorUsuarioLocalidad($_POST['localidad']);
                    if( isset($datos) && !empty($datos) && !is_null($datos)){
                        echo json_encode($datos);
                    }else{
                        echo 'No se encontraron datos';
                    }
                }
                break;
            case 'J':
                if( isset($_POST["str"]) && !empty($_POST["str"])
                ){
                    $datos = UserDb::getUsersByStr($_POST['str']);
                    if( isset($datos) && !empty($datos) && !is_null($datos)){
                        echo json_encode($datos);
                    }else{
                        echo 'No se encontraron datos';
                    }
                }
                break;
            case 'K':
                if( isset($_POST["fecha1"]) && !empty($_POST["fecha1"])
                    && isset($_POST["fecha2"]) && !empty($_POST["fecha2"])) {
                        $ventas = VentaDb::getVentasBetweenDates2($_POST["fecha1"], $_POST["fecha2"]);
                        if( isset($ventas) && !empty($ventas) && !is_null($ventas)){
                            echo json_encode($ventas);
                        }else{
                            echo 'No se encontraron datos';
                        }
                }else{
                    echo 'faltan datos en el post';
                }
                break;
            default:
                echo 'No existe esa opcion';
                break;
        }
    }
}else{
    echo 'complete todos los datos';
}