<?php 
namespace App\Models\Entities;

use App\Models\Database\Database;

require_once __DIR__ . '/../../database/Database.php';

class Estudiante
{
    private $db;
    private $table = "estudiantes";

    public function __construct()
    {
        $this->db = new Database();
    }

    public function obtenerTodos()
    {
        $sql = "SELECT e.codigo, e.nombre, e.email, p.nombre AS programa
                FROM {$this->table} e
                JOIN programas p ON e.programa = p.codigo";
        $result = $this->db->execSQL($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function obtenerPorCodigo($codigo)
    {
        $sql = "SELECT e.codigo, e.nombre, e.email, p.nombre AS programa
                FROM {$this->table} e
                JOIN programas p ON e.programa = p.codigo
                WHERE e.codigo = ?";
        $result = $this->db->execSQL($sql, "s", $codigo);
        return $result->fetch_assoc();
    }

    public function crear($codigo, $nombre, $email, $programa)
    {
        $sql = "INSERT INTO {$this->table} (codigo, nombre, email, programa)
                VALUES (?, ?, ?, ?)";
        return $this->db->execSQL($sql, "ssss", $codigo, $nombre, $email, $programa);
    }

    public function actualizar($codigo, $nombre, $email, $programa)
    {
        $sql = "UPDATE {$this->table}
                SET nombre = ?, email = ?, programa = ?
                WHERE codigo = ?";
        return $this->db->execSQL($sql, "ssss", $nombre, $email, $programa, $codigo);
    }

    public function eliminar($codigo)
    {
        $sqlCheck = "SELECT COUNT(*) AS total FROM notas WHERE estudiante = ?";
        $check = $this->db->execSQL($sqlCheck, "s", $codigo)->fetch_assoc();

        if ($check['total'] > 0) return false;

        $sql = "DELETE FROM {$this->table} WHERE codigo = ?";
        return $this->db->execSQL($sql, "s", $codigo);
    }

    public function tieneNotas($codigo)
    {
        $sql = "SELECT COUNT(*) AS total FROM notas WHERE estudiante = ?";
        $result = $this->db->execSQL($sql, "s", $codigo);
        $row = $result->fetch_assoc();
        return $row['total'] > 0;
    }

}
