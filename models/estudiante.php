<?php
require_once '../config/database.php';

class Estudiante {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT e.*, p.nombre AS programa FROM estudiantes e JOIN programas p ON e.programa = p.codigo");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($codigo) {
        $stmt = $this->pdo->prepare("SELECT e.*, p.nombre AS programa FROM estudiantes e JOIN programas p ON e.programa = p.codigo WHERE e.codigo = ?");
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($codigo, $nombre, $email, $programa) {
        $stmt = $this->pdo->prepare("INSERT INTO estudiantes (codigo, nombre, email, programa) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$codigo, $nombre, $email, $programa]);
    }

    public function update($codigo, $nombre, $email, $programa) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM notas WHERE estudiante = ?");
        $stmt->execute([$codigo]);
        if ($stmt->fetchColumn() > 0) return false;
        $stmt = $this->pdo->prepare("UPDATE estudiantes SET nombre = ?, email = ?, programa = ? WHERE codigo = ?");
        return $stmt->execute([$nombre, $email, $programa, $codigo]);
    }

    public function delete($codigo) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM notas WHERE estudiante = ?");
        $stmt->execute([$codigo]);
        if ($stmt->fetchColumn() > 0) return false;
        $stmt = $this->pdo->prepare("DELETE FROM estudiantes WHERE codigo = ?");
        return $stmt->execute([$codigo]);
    }

    public function getByPrograma($programa) {
        $stmt = $this->pdo->prepare("SELECT * FROM estudiantes WHERE programa = ?");
        $stmt->execute([$programa]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>