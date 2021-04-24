<?php

include 'AccesoDatos.php';

class UserDb
{
    private $id;
    private $nombre;
    private $apellido;
    private $clave;
    private $mail;
    private $localidad;
    private $imagen;

    public function __construct($nombre = null, $apellido = null, $clave = null, $mail = null, $localidad = null, $imagen = null)
    {
        if(!is_null($nombre)){
            $this->nombre = $nombre;
        }
        if(!is_null($apellido)){
            $this->apellido = $apellido;
        }
        if(!is_null($clave)){
            $this->clave = $clave;
        }
        if(!is_null($mail)){
            $this->mail = $mail;
        }
        if(!is_null($localidad)){
            $this->localidad = $localidad;
        }
        if(!is_null($imagen)){
            $this->imagen = $imagen;
        }
    }

    public static function validarUsuario($email, $pass){
        $usuarios = UserDb::getAllUsers();
        foreach ($usuarios as $usuario) {
            if($email == $usuario->getEmail()){
                if($pass == $usuario->getPass()){
                    return new UserDb($usuario->getNombre(), $usuario->getApellido(), $usuario->getPass(), $usuario->getEmail(), $usuario->getLocalidad());
                }else{
                    echo 'Error en los datos';
                    return false;
                }
            }
        }
        echo 'Usuario no registrado';
        return false;
    }

    public function persist()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios(nombre,apellido,mail,fecha,localidad,clave) values(:nombre,:apellido,:mail,:fecha,:localidad,:clave)");
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
        $consulta->bindValue(':fecha', date('Y-m-d'), PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function getAllUsers()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from usuarios");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "UserDb");
	}

    public static function crearListaHtml($usuarios){
        $outputHtml = '<ul>';
        foreach ($usuarios as $usuario) {
            $outputHtml = $outputHtml.'<li>'.' User: '.$usuario->getNombreCompleto().', Pass: '.$usuario->getPass().', eMail: '.$usuario->getEmail().'</li>';
        }
        $outputHtml = $outputHtml.'</ul>';
        
        return $outputHtml;
    }

    public function getNombreCompleto(){
        return $this->nombre.' '.$this->apellido;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }

    public function getPass(){
        return $this->clave;
    }

    public function getEmail(){
        return $this->mail;
    }
    
    public function getLocalidad(){
        return $this->localidad;
    }

    public function getImagen(){
        return $this->imagen;
    }

}