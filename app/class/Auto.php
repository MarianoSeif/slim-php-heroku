<?php

class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($marca, $color, $precio = 0, $fecha = null)
    {
        $this->_marca = $marca;
        $this->_color = $color;
        $this->_precio = $precio;
        $this->_fecha = $fecha;
    }

    public function AgregarImpuestos($impuesto)
    {
        $this->_precio += $impuesto;
        return $this->_precio;
    }

    public static function Add(Auto $a1, Auto $a2)
    {
        if ($a1->getMarca() == $a2->getMarca()){
            return ($a1->getPrecio() + $a2->getPrecio());
        }else{
            return 0;
        }
    }

    public static function MostrarAuto(Auto $auto)
    {
        echo 'Datos del auto: <br>';
        echo 'Marca: '.$auto->getMarca().'<br>';
        echo 'Color: '.$auto->getColor().'<br>';
        echo 'Precio: '.$auto->getPrecio().'<br>';
        echo 'Fecha: '.$auto->getFecha().'<br>';
        echo '<br>';
    }

    public function Equals(Auto $a1)
    {
        return $this->_marca == $a1->getMarca();
    }

    public function getMarca()
    {
        return $this->_marca;
    }

    public function getColor()
    {
        return $this->_color;
    }

    public function getPrecio()
    {
        return $this->_precio;
    }

    public function getFecha()
    {
        return $this->_fecha;
    }
}
