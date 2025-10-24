<?php
require_once __DIR__ . '/../database/Database.php';

class Estudiante
{
    private $db;
    private $table = "estudiantes";

    public function __construct()
    {
        $this->db = new Database();
    }

    // Obtener todos los estudiantes con su programa
    public function obtenerTodos()
    {
        $sql = "SELECT e.*, p.nombre AS programa 
                FROM {$this->table} e 
                JOIN programas p ON e.programa_id = p.id";
        $result = $this->db->execSQL($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener estudiante por código
    public function obtenerPorCodigo($codigo)
    {
        $sql = "SELECT * FROM {$this->table} WHERE codigo = ?";
        $result = $this->db->execSQL($sql, "s", $codigo);
        return $result->fetch_assoc();
    }

    // Crear estudiante
    public function crear($codigo, $nombre, $correo, $programa_id)
    {
        $sql = "INSERT INTO {$this->table} (codigo, nombre, correo, programa_id)
                VALUES (?, ?, ?, ?)";
        return $this->db->execSQL($sql, "sssi", $codigo, $nombre, $correo, $programa_id);
    }

    // Actualizar (solo si no tiene notas)
    public function actualizar($codigo, $nombre, $correo)
    {
        $sqlCheck = "SELECT COUNT(*) AS total FROM notas 
                     WHERE estudiante_id = (SELECT id FROM estudiantes WHERE codigo = ?)";
        $check = $this->db->execSQL($sqlCheck, "s", $codigo)->fetch_assoc();

        if ($check['total'] > 0) return false;

        $sql = "UPDATE {$this->table} SET nombre = ?, correo = ? WHERE codigo = ?";
        return $this->db->execSQL($sql, "sss", $nombre, $correo, $codigo);
    }

    // Eliminar (solo si no tiene notas)
    public function eliminar($codigo)
    {
        $sqlCheck = "SELECT COUNT(*) AS total FROM notas 
                     WHERE estudiante_id = (SELECT id FROM estudiantes WHERE codigo = ?)";
        $check = $this->db->execSQL($sqlCheck, "s", $codigo)->fetch_assoc();

        if ($check['total'] > 0) return false;

        $sql = "DELETE FROM {$this->table} WHERE codigo = ?";
        return $this->db->execSQL($sql, "s", $codigo);
    }
}
