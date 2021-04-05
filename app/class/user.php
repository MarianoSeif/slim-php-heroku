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

    public static function validarUsuario($email, $pass){
        $usuarios = User::leerArhivoUsuarios();
        foreach ($usuarios as $usuario) {
            if($email == $usuario->getEmail()){
                if($pass == $usuario->getPass()){
                    return new User($usuario->getNombre(), $usuario->getPass(), $usuario->getEmail());
                }else{
                    echo 'Error en los datos';
                    return false;
                }
            }
        }
        echo 'Usuario no registrado';
    }

    public static function leerArhivoUsuarios(){
        $file = fopen('usuarios.csv', 'r');
        if($file){
            while(!feof($file)){
                $line = fgets($file);
                if($line){
                    $datos = explode(',', $line);
                    $user = new User(trim($datos[0]), trim($datos[1]), trim($datos[2]));
                    $usuarios[] = $user;
                }
            }
            fclose($file);
            return $usuarios;
        }else{
            echo 'ERROR No se pudo abrir el archivo';
        }
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