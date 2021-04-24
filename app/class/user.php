<?php
class User implements JsonSerializable
{
    private $nombre;
    private $pass;
    private $email;
    private $imagen;

    public function __construct($nombre, $apellido, $mail, $clave, $localidad, $imagen = null)
    {
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->email = $email;
        $this->imagen = $imagen;
    }

    public function persist()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (titel,interpret,jahr)values(:titulo,:cantante,:anio)");
        $consulta->bindValue(':titulo',$this->titulo, PDO::PARAM_INT);
        $consulta->bindValue(':anio', $this->año, PDO::PARAM_STR);
        $consulta->bindValue(':cantante', $this->cantante, PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
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

    public function guardarJson($file){
        $id = rand(1, 10000);
        $fecha = date('d/m/Y h:i:s');
        $linea = json_encode([$this->jsonSerialize(), $fecha])."\n";

        if(fwrite($file, $linea)){
            return 'Los datos fueron guardados';
        }else{
            return 'ERROR al escribir el archivo';
        }
    }

    public function listar($outputHtml){
        $outputHtml = $outputHtml.'<li>User: '.$this->getNombre().', Pass: '.$this->getPass().', eMail: '.$this->getEmail().'</li>';
        return $outputHtml;
    }

    public static function crearListaHtml($usuarios){
        $outputHtml = '<ul>';
        foreach ($usuarios as $usuario) {
            $outputHtml = $outputHtml.'<li><img width="100" height="100" src="./'.$usuario->getImagen().'">'.' User: '.$usuario->getNombre().', Pass: '.$usuario->getPass().', eMail: '.$usuario->getEmail().'</li>';
        }
        $outputHtml = $outputHtml.'</ul>';
        
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

    public static function leerArhivoUsuariosJson(){
        $file = fopen('usuarios.json', 'r');
        if($file){
            while(!feof($file)){
                $line = fgets($file);
                if($line){
                    $datos = json_decode($line);
                    $user = new User($datos[0]->nombre, $datos[0]->pass, $datos[0]->email, $datos[0]->imagen);
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

    public function getImagen(){
        return $this->imagen;
    }

}