<?php
define("HOSTNAME", "alexlapaz.db.8921605.eea.hostedresource.net");
define("DATABASE", "alexlapaz");  //Nombre de la base de datos a la que se va a conectar
define("USERNAME", "alexlapaz");     //usuario de mysql
define("PASSW", "AleXPro@41");   //contraseña de mysql

/**
 * Clase para manejo de la base de datos
 * NOTA: No mover el codigo de esta clase... al menos que sepas realmente lo que haces
 */
class ConexionBD {

    private static $conexion = null;
    private static $pdo;

    final private function __construct() {
        try {
            self::getDb();
        } catch (PDOException $e) {
            echo 'Fallo la conexión: ' . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$conexion === NULL) {
            self::$conexion = new self();
        }
        return self::$conexion;
    }

    public function getDb() {
        if (self::$pdo == NULL) {
            self::$pdo = new PDO(
                    "mysql:dbname=" . DATABASE . 
                    ";host=" . HOSTNAME . 
                    ";port:63343;" , 
                    USERNAME, 
                    PASSW, 
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }

    final protected function __clone() {
        
    }

    function __destruct() {
        self::$pdo = NULL;
    }
}
