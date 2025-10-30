<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        // Configuración de la conexión
        $host = 'localhost';  // Cambia si tu servidor MySQL no está en localhost
        $db = 'notas';    // Nombre de la base de datos (de tu dump)
        $user = 'root';       // Usuario de MySQL (por defecto en XAMPP)
        $pass = '12345*QWE';           // Contraseña (vacía por defecto en XAMPP; cámbiala si tienes una)
        
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
           
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    // Método estático para obtener la instancia única (patrón Singleton)
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
?>