<?php
require_once __DIR__ . '/../database/Database.php';

class Nota
{
    private $db;
    private $table = "notas";

    public function __construct()
    {
        $this->db = new Database();
    }

    public function obtenerTodas()
    {
        $sql = "SELECT n.id, e.nombre AS estudiante, m.nombre AS materia, n.nota
                FROM {$this->table} n
                JOIN estudiantes e ON n.estudiante_id = e.id
                JOIN materias m ON n.materia_id = m.id";
        $result = $this->db->execSQL($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $result = $this->db->execSQL($sql, "i", $id);
        return $result->fetch_assoc();
    }

    public function crear($estudiante_id, $materia_id, $nota)
    {
        if ($nota < 0 || $nota > 5) return false;

        $sql = "INSERT INTO {$this->table} (estudiante_id, materia_id, nota)
                VALUES (?, ?, ROUND(?, 2))";
        return $this->db->execSQL($sql, "iid", $estudiante_id, $materia_id, $nota);
    }

    public function actualizar($id, $nota)
    {
        if ($nota < 0 || $nota > 5) return false;

        $sql = "UPDATE {$this->table} SET nota = ROUND(?, 2) WHERE id = ?";
        return $this->db->execSQL($sql, "di", $nota, $id);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        return $this->db->execSQL($sql, "i", $id);
    }

    // Promedio por materia
    public function promedioPorMateria($materia_id)
    {
        $sql = "SELECT ROUND(AVG(nota), 2) AS promedio FROM {$this->table} WHERE materia_id = ?";
        $result = $this->db->execSQL($sql, "i", $materia_id);
        $row = $result->fetch_assoc();
        return $row ? $row['promedio'] : 0;
    }
}
