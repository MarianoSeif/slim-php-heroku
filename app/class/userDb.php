<?php

include_once 'AccesoDatos.php';

class UserDb implements JsonSerializable
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

    /* Ej Parte 10 - A */
    public static function getAllUsersOrdered($modo)
    {
        switch ($modo) {
            case 'asc':
                $order = 'ASC';
                break;
            case 'desc':
                $order = 'DESC';
                break;
            default:
                echo "opcion incorrecta \n";
                return false;
                break;
        }
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios ORDER BY apellido $order, nombre $order");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "UserDb");
    }

    /* Ej 10 - J */
    public static function getUsersByStr($str)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE nombre LIKE CONCAT('%', :string1, '%') OR apellido LIKE CONCAT('%', :string2, '%')");
        $consulta->bindValue(':string1', $str, PDO::PARAM_STR);
        $consulta->bindValue(':string2', $str, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function cambiarPass($pass, $newPass)
    {
        if($this->clave == $pass){
            $this->clave = $newPass;
            return true;
        }else{
            echo "Password incorrecta. \n";
            return false;
        }
    }
    
    public static function buscarUsuario($atributo = 'id', $valor)
    {
        switch ($atributo) {
            case 'id':
                $column = 'id';
                break;
            case 'mail':
                $column = 'mail';
                break;
        }
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE $column = :valor");
        $consulta->bindValue(':valor', $valor, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "UserDb");
    }

    public static function validarUsuario($email, $pass)
    {
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
    
    public function update(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET clave = :clave WHERE mail = :mail");
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $consulta->execute();
    }

    public function save()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios(nombre,apellido,mail,fecha,localidad,clave) values(:nombre,:apellido,:mail,:fecha,:localidad,:clave)");
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
        $consulta->bindValue(':fecha', date('Y-m-d'), PDO::PARAM_STR);
        return $consulta->execute();
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