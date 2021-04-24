<?php

class Venta
{
    private $id;
    private $codigoBarras;
    private $idUser;
    private $idProducto;
    private $cantidad;
    
    public function __construct($codigoBarras, $idUser, $cantidad)
    {
        $this->id = rand(1, 10000);
        $this->codigoBarras = $codigoBarras;
        $this->idUser = $idUser;
        $this->cantidad = $cantidad;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function guardarVenta(){
        $file = fopen('ventas.json', 'a');
        if($file){
            if(!fwrite($file, json_encode($this->jsonSerialize())."\n")){
                echo 'ERROR al escribir el archivo'."\n";
                fclose($file);
                return false;
            }
            fclose($file);
            return true;
        }else{
            echo 'Error de archivo'."\n";
            fclose($file);
            return false;
        }
    }
}
