<?php

namespace App\Models\Entites;

use Database;

require_once __DIR__ . '/../database/Database.php';

class Programa
{
    private $db;
    private $table = "programas";

    public function __construct()
    {
        $this->db = new Database();
    }

    public function obtenerTodos()
    {
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->db->execSQL($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPorCodigo($codigo)
    {
        $sql = "SELECT * FROM {$this->table} WHERE codigo = ?";
        $result = $this->db->execSQL($sql, "s", $codigo);
        return $result->fetch_assoc();
    }

    public function crear($codigo, $nombre)
    {
        $sql = "INSERT INTO {$this->table} (codigo, nombre) VALUES (?, ?)";
        return $this->db->execSQL($sql, "ss", $codigo, $nombre);
    }

    // Solo se puede modificar si no tiene estudiantes ni materias
    public function actualizar($codigo, $nombre)
    {
        $sqlCheck = "SELECT (
                        (SELECT COUNT(*) FROM estudiantes WHERE programa_id = p.id) +
                        (SELECT COUNT(*) FROM materias WHERE programa_id = p.id)
                    ) AS total
                    FROM programas p WHERE codigo = ?";
        $check = $this->db->execSQL($sqlCheck, "s", $codigo)->fetch_assoc();

        if ($check['total'] > 0) return false;

        $sql = "UPDATE {$this->table} SET nombre = ? WHERE codigo = ?";
        return $this->db->execSQL($sql, "ss", $nombre, $codigo);
    }

    // Solo se puede eliminar si no tiene estudiantes ni materias
    public function eliminar($codigo)
    {
        $sqlCheck = "SELECT (
                        (SELECT COUNT(*) FROM estudiantes WHERE programa_id = p.id) +
                        (SELECT COUNT(*) FROM materias WHERE programa_id = p.id)
                    ) AS total
                    FROM programas p WHERE codigo = ?";
        $check = $this->db->execSQL($sqlCheck, "s", $codigo)->fetch_assoc();

        if ($check['total'] > 0) return false;

        $sql = "DELETE FROM {$this->table} WHERE codigo = ?";
        return $this->db->execSQL($sql, "s", $codigo);
    }
}
