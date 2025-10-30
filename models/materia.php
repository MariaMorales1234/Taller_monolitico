<?php
require_once '../config/database.php';

class Materia {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT m.*, p.nombre AS programa FROM materias m JOIN programas p ON m.programa = p.codigo");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($codigo) {
        $stmt = $this->pdo->prepare("SELECT m.*, p.nombre AS programa FROM materias m JOIN programas p ON m.programa = p.codigo WHERE m.codigo = ?");
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($codigo, $nombre, $programa) {
        $stmt = $this->pdo->prepare("INSERT INTO materias (codigo, nombre, programa) VALUES (?, ?, ?)");
        return $stmt->execute([$codigo, $nombre, $programa]);
    }

    public function update($codigo, $nombre, $programa) {
        // Verificar si tiene notas relacionadas
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM notas WHERE materia = ?");
        $stmt->execute([$codigo]);
        if ($stmt->fetchColumn() > 0) return false;
        $stmt = $this->pdo->prepare("UPDATE materias SET nombre = ?, programa = ? WHERE codigo = ?");
        return $stmt->execute([$nombre, $programa, $codigo]);
    }

    public function delete($codigo) {
        // Verificar si tiene notas relacionadas
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM notas WHERE materia = ?");
        $stmt->execute([$codigo]);
        if ($stmt->fetchColumn() > 0) return false;
        $stmt = $this->pdo->prepare("DELETE FROM materias WHERE codigo = ?");
        return $stmt->execute([$codigo]);
    }

    public function getByPrograma($programa) {
        $stmt = $this->pdo->prepare("SELECT * FROM materias WHERE programa = ?");
        $stmt->execute([$programa]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>