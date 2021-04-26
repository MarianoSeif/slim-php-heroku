<?php

class AccesoDatos
{
    private static $ObjetoAccesoDatos;
    private $objetoPDO;
 
    private function __construct()
    {
        try { 
            
            $db = parse_url(getenv("DATABASE_URL"));

            $this->objetoPDO = new PDO("pgsql:" . sprintf(
                "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                $db["host"],
                $db["port"],
                $db["user"],
                $db["pass"],
                ltrim($db["path"], "/")
            ));
            //$this->objetoPDO->exec("SET CHARACTER SET utf8");

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
 
    public static function dameUnObjetoAcceso()
    { 
        if (!isset(self::$ObjetoAccesoDatos)) {          
            self::$ObjetoAccesoDatos = new AccesoDatos();
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