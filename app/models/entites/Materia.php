<?php

namespace App\Models\Entites;

use Database;

require_once __DIR__ . '/../database/Database.php';

class Materia
{
    private $db;
    private $table = "materias";

    public function __construct()
    {
        $this->db = new Database();
    }

    public function obtenerTodas()
    {
        $sql = "SELECT m.*, p.nombre AS programa
                FROM {$this->table} m
                JOIN programas p ON m.programa_id = p.id";
        $result = $this->db->execSQL($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPorCodigo($codigo)
    {
        $sql = "SELECT * FROM {$this->table} WHERE codigo = ?";
        $result = $this->db->execSQL($sql, "s", $codigo);
        return $result->fetch_assoc();
    }

    public function crear($codigo, $nombre, $programa_id)
    {
        $sql = "INSERT INTO {$this->table} (codigo, nombre, programa_id)
                VALUES (?, ?, ?)";
        return $this->db->execSQL($sql, "ssi", $codigo, $nombre, $programa_id);
    }

    // Solo se puede modificar si no tiene notas o estudiantes
    public function actualizar($codigo, $nombre)
    {
        $sqlCheck = "SELECT COUNT(*) AS total FROM notas 
                     WHERE materia_id = (SELECT id FROM materias WHERE codigo = ?)";
        $check = $this->db->execSQL($sqlCheck, "s", $codigo)->fetch_assoc();
        if ($check['total'] > 0) return false;

        $sql = "UPDATE {$this->table} SET nombre = ? WHERE codigo = ?";
        return $this->db->execSQL($sql, "ss", $nombre, $codigo);
    }

    // Solo se puede eliminar si no tiene notas o estudiantes
    public function eliminar($codigo)
    {
        $sqlCheck = "SELECT COUNT(*) AS total FROM notas 
                     WHERE materia_id = (SELECT id FROM materias WHERE codigo = ?)";
        $check = $this->db->execSQL($sqlCheck, "s", $codigo)->fetch_assoc();
        if ($check['total'] > 0) return false;

        $sql = "DELETE FROM {$this->table} WHERE codigo = ?";
        return $this->db->execSQL($sql, "s", $codigo);
    }
}
