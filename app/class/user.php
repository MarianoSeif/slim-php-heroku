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

}