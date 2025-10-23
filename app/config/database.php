<?php

namespace App\Models\Databases;

use mysqli;
use Exception;

class GrupoAvanzadaDB
{
    private $hostDb = "localhost";
    private $nameDb = "taller_monolitico";
    private $userDb = "root";
    private $pwdDb = "12345*QWE";
    private $conexDb = null;

    public function __construct()
    {
        $this->conexDb = new mysqli(
            $this->hostDb,
            $this->userDb,
            $this->pwdDb,
            $this->nameDb
        );

        if ($this->conexDb->connect_error) {
            die("❌ Error de conexión: " . $this->conexDb->connect_error);
        }

        // Establecer codificación
        $this->conexDb->set_charset("utf8mb4");
    }

    /**
     * Ejecuta cualquier consulta SQL
     * @param string $sql
     * @param string|null $types  (por ejemplo "ssi")
     * @param mixed ...$params
     * @return mixed (mysqli_result | bool)
     */
    public function execSQL(string $sql, ?string $types = null, ...$params)
    {
        $stmt = $this->conexDb->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $this->conexDb->error);
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
