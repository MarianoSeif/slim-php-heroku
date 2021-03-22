<?php

class Rectangulo
{
    private $_vertice1;
    private $_vertice2;
    private $_vertice3;
    private $_vertice4;
    public $area;
    public $ladoDos;
    public $ladoUno;
    public $perimetro;

    public function __construct($v1, $v3)
    {
        $this->ladoUno = $v3->GetX()-$v1->GetX();
        $this->ladoDos = $v3->GetY()-$v1->GetY();
        $this->perimetro = 2 * $this->ladoUno + 2 * $this->ladoDos;
        $this->area = $this->ladoUno * $this->ladoDos;
    }

    public function mostrarDatos(){
        $datos = 'Base: '.$this->ladoUno.', Altura: '.$this->ladoDos.
            ', Area: '.$this->area.', Perimetro: '.$this->perimetro;
        
        return $datos;
    }

    public function Dibujar(){
        echo '<div class="container "id="rectangulo" style="width: '.($this->ladoUno * 30).'px; height: '.($this->ladoDos*30).'px; background-color: red;"></div>';
    }
}
