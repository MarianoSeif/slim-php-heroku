<?php

class User
{
    private $nombre;
    private $pass;
    private $email;

    public function __construct($nombre, $pass, $email)
    {
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->email = $email;
    }

    public function __toCsv()
    {
        return $this->nombre.",".$this->pass.",".$this->email."\n";
    }

    public function guardar($file){
        if(fwrite($file, $this->__toCsv())){
            return 'Los datos fueron guardados';
        }else{
            return 'ERROR al escribir el archivo';
        }
    }
    public function listar($outputHtml){
        $outputHtml = $outputHtml.'<li>User: '.$this->getNombre().', Pass: '.$this->getPass().', eMail: '.$this->getEmail().'</li>';
        return $outputHtml;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getPass(){
        return $this->pass;
    }

    public function getEmail(){
        return $this->email;
    }

}