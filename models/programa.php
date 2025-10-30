<?php
require_once '../config/database.php';

class Programa {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM programas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($codigo) {
        $stmt = $this->pdo->prepare("SELECT * FROM programas WHERE codigo = ?");
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($codigo, $nombre) {
        $stmt = $this->pdo->prepare("INSERT INTO programas (codigo, nombre) VALUES (?, ?)");
        return $stmt->execute([$codigo, $nombre]);
    }

    public function update($codigo, $nombre) {
        // Verificar si tiene estudiantes o materias relacionadas
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM estudiantes WHERE programa = ? UNION SELECT COUNT(*) FROM materias WHERE programa = ?");
        $stmt->execute([$codigo, $codigo]);
        $counts = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if ($counts[0] > 0 || $counts[1] > 0) return false;  // No se puede modificar
        $stmt = $this->pdo->prepare("UPDATE programas SET nombre = ? WHERE codigo = ?");
        return $stmt->execute([$nombre, $codigo]);
    }

    public function delete($codigo) {
        // Verificar si tiene estudiantes o materias relacionadas
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM estudiantes WHERE programa = ? UNION SELECT COUNT(*) FROM materias WHERE programa = ?");
        $stmt->execute([$codigo, $codigo]);
        $counts = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if ($counts[0] > 0 || $counts[1] > 0) return false;  // No se puede eliminar
        $stmt = $this->pdo->prepare("DELETE FROM programas WHERE codigo = ?");
        return $stmt->execute([$codigo]);
    }
}
?>