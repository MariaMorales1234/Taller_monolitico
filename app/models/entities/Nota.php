<?php
namespace App\Models\Entites;

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
        $sql = "SELECT n.materia, n.estudiante, n.actividad, n.nota,
                       e.nombre AS nombre_estudiante,
                       m.nombre AS nombre_materia
                FROM {$this->table} n
                INNER JOIN estudiantes e ON n.estudiante = e.codigo
                INNER JOIN materias m ON n.materia = m.codigo";
        $result = $this->db->execSQL($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // 🔹 Obtener nota por actividad (clave principal)
    public function obtenerPorActividad($actividad)
    {
        $sql = "SELECT * FROM {$this->table} WHERE actividad = ?";
        $result = $this->db->execSQL($sql, "s", $actividad);
        return $result->fetch_assoc();
    }

    // 🔹 Crear nueva nota
    public function crear($estudiante, $materia, $actividad, $nota)
    {
        if ($nota < 0 || $nota > 5) return false;

         $sql = "INSERT INTO {$this->table} (materia, estudiante, actividad, nota)
            VALUES (?, ?, ?, ROUND(?, 2))";
        return $this->db->execSQL($sql, "sssd", $materia, $estudiante, $actividad, $nota);
    }


    // 🔹 Actualizar nota por actividad
    public function actualizar($actividad, $nota)
    {
        if ($nota < 0 || $nota > 5) return false;

        $sql = "UPDATE {$this->table} SET nota = ? WHERE actividad = ?";
        return $this->db->execSQL($sql, "ds", $nota, $actividad);
    }

    // 🔹 Eliminar nota por actividad
    public function eliminar($actividad)
    {
        $sql = "DELETE FROM {$this->table} WHERE actividad = ?";
        return $this->db->execSQL($sql, "s", $actividad);
    }

    // 🔹 Calcular promedio por materia
    public function promedioPorMateria($materia)
    {
        $sql = "SELECT ROUND(AVG(nota), 2) AS promedio FROM {$this->table} WHERE materia = ?";
        $result = $this->db->execSQL($sql, "s", $materia);
        $row = $result->fetch_assoc();
        return $row ? $row['promedio'] : 0;
    }

    public function obtenerPorClave($materia, $estudiante, $actividad)
    {
        $sql = "SELECT n.materia, n.estudiante, n.actividad, n.nota,
                   e.nombre AS nombre_estudiante,
                   m.nombre AS nombre_materia
                FROM notas n
                JOIN estudiantes e ON n.estudiante = e.codigo
                JOIN materias m ON n.materia = m.codigo
                WHERE n.materia = ? AND n.estudiante = ? AND n.actividad = ?";
        $result = $this->db->execSQL($sql, "sss", $materia, $estudiante, $actividad);
        return $result->fetch_assoc();
    }


}
