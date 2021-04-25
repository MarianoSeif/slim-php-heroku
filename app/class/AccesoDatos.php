<?php

class AccesoDatos
{
    private static $ObjetoAccesoDatos;
    private $objetoPDO;
 
    private function __construct($env = '')
    {
        try { 
            if($env = 'heroku'){
                $db = parse_url(getenv("DATABASE_URL"));
    
                $pdo = new PDO("pgsql:" . sprintf(
                    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                    $db["host"],
                    $db["port"],
                    $db["user"],
                    $db["pass"],
                    ltrim($db["path"], "/")
                ));
            }else{
                $this->objetoPDO = new PDO('mysql:host=localhost;dbname=prog33;charset=utf8', 'mfs','mariano81', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $this->objetoPDO->exec("SET CHARACTER SET utf8");
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage(); 
            die();
        }
    }
 
    public function RetornarConsulta($sql)
    {
        return $this->objetoPDO->prepare($sql);
    }
     
    public function RetornarUltimoIdInsertado()
    { 
        return $this->objetoPDO->lastInsertId();
    }
 
    public static function dameUnObjetoAcceso($env)
    { 
        if (!isset(self::$ObjetoAccesoDatos)) {          
            self::$ObjetoAccesoDatos = new AccesoDatos($env);
        } 
        return self::$ObjetoAccesoDatos;        
    }
 
 
     // Evita que el objeto se pueda clonar
    public function __clone()
    { 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }
}
?>