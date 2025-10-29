<?php
namespace App\Models\Entities;

use App\Model\Database\Database;

require_once __DIR__ . '/../database/Database.php';

class Nota
{
    private $db;
    private $table = "notas";

    public function __construct()
    {
        $this->db = new Database();
    }

    // 🔹 Obtener todas las notas con JOIN a estudiantes y materias
    public function obtenerTodas()
    {
        $sql = "SELECT n.id, n.materia, n.estudiante, n.nota,
                       e.nombre AS nombre_estudiante,
                       m.nombre AS nombre_materia
                FROM {$this->table} n
                INNER JOIN estudiantes e ON n.estudiante = e.codigo
                INNER JOIN materias m ON n.materia = m.codigo";
        $result = $this->db->execSQL($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener nota por su ID
    public function obtenerPorID($id)
    {
        $sql = "SELECT n.id, n.materia, n.estudiante, n.nota,
                        e.nombre AS nombre_ estudiante,
                        m.nombre AS nombre_materia
                FROM {$this->table} n
                JOIN estudiantes e ON n.estudiante = e.codigo
                JOIN materias m ON n.materia = m.codigo
                WHERE n.id = ?";
        $result = $this->db->execSQL($sql, "i", $id);
        return $result->fetch_assoc();
    }

    // Crear nueva nota
    public function crear($materia, $estudiante, $nota)
    {
        //Valida nota de 0 a 5, con 2 decimales
        if ($nota < 0 || $nota > 5) return false;
        $nota = round($nota, 2);

        //Valida que exista materia
        $sql = "SELECT COUNT(*) AS existe FROM materias WHERE codigo = ?";
        $result = $this->db->execSQL($sql, "s", $materia);
        $row = $result->fetch_assoc();
        if ($row['existe'] == 0) return false;

        //Valida que exista estudiante
        $sql = "SELECT COUNT(*) AS existe FROM estudiantes WHERE codigo = ?";
        $result = $this->db->execSQL($sql, "s", $estudiante);
        $row = $result->fetch_assoc();
        if ($row['existe'] == 0) return false;

        //Inserta la nota
        $sql = "INSERT INTO {$this->table} (materia, estudiante, nota)
                VALUES (?, ?, ?)";
        return $this->db->execSQL($sql, "ssd", $materia, $estudiante, $nota);
    }


    // Actualizar nota por ID
    public function actualizar($id, $nota)
    {
        if ($nota < 0 || $nota > 5) return false;
        $nota = round($nota, 2);

        $sql = "UPDATE {$this->table} SET nota = ? WHERE id = ?";
        return $this->db->execSQL($sql, "di", $nota, $id);
    }

    // Eliminar nota por ID
    public function eliminar($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        return $this->db->execSQL($sql, "i", $id);
    }

    // Calcular promedio por materia
    public function promedioPorMateria($materia, $estudiante)
    {
        $sql = "SELECT ROUND(AVG(nota), 2) AS promedio
        FROM {$this->table}
        WHERE materia = ? AND estudiante = ?";
        $result = $this->db->execSQL($sql, "ss", $materia, $estudiante);
        $row = $result->fetch_assoc();
        return $row ? $row['promedio'] : 0;
    }

}