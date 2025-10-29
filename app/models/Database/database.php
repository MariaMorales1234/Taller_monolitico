<?php
namespace App\Models\Database;

use mysqli;
use Exception;

class Database
{
    private $hostDb = "localhost";
    private $nameDb = "taller_monolitico"; //Cambiar por el nombre que tengan en el phpmyadmin
    private $userDb = "root";
    private $pwdDb  = "Ana10776650648"; // Cambiar por la contraseña que tenga en el mysql
    private $conexDb = null;

    public function __construct()
    {

        $this->conexDb = new mysqli(
            $this->hostDb,
            $this->userDb,
            $this->pwdDb,
            $this->nameDb
        );

        // Validar conexión
        if ($this->conexDb->connect_error) {
            die(" Error de conexión a la base de datos: " . $this->conexDb->connect_error);
        }

        // Codificación UTF-8 para caracteres especiales
        $this->conexDb->set_charset("utf8mb4");
    }

    public function getConnection()
    {
        return $this->conexDb;
    }
    /**
     * Ejecuta consultas SQL seguras usando prepared statements
     * @param string 
     * @param string|null 
     * @param mixed
     * @return mixed 
     */
    public function execSQL(string $sql, ?string $types = null, ...$params)
    {
        $stmt = $this->conexDb->prepare($sql);

        if (!$stmt) {
            die(" Error al preparar la consulta: " . $this->conexDb->error);
        }

        if ($types && !empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $isSelect = str_starts_with(strtoupper(trim($sql)), "SELECT");

        if ($isSelect) {
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        } else {
            $ok = $stmt->execute();
            $stmt->close();
            return $ok;
        }
    }

    public function closeDB()
    {
        if ($this->conexDb) {
            $this->conexDb->close();
        }
    }
}
