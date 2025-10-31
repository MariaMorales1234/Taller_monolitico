<?php
require_once "../config/database.php";

class Nota {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT n.*, e.nombre AS estudiante, m. nombre AS materia FROM notas n JOIN estudiantes e ON n.estudiante = e.codigo JOIN materias m ON n.materia = m.codigo");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEstudiante($estudiante) {
        $stmt = $this->pdo->prepare("SELECT n.*, m.nombre AS materia FROM notas n JOIN materias m ON n.materia = m.codigo WHERE n.estudiante = ?");
        $stmt->execute([$estudiante]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create ($estudiante, $materia, $actividad, $nota) {
        if ($nota < 0 || $nota > 5) return false;
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM estudiantes e JOIN materias m ON e.programa = m.programa WHERE e.codigo = ? AND m.codigo = ?");
        $stmt->execute([$estudiante, $materia]);
        if ($stmt->fetchColumn() == 0) return false;
        $stmt = $this->pdo->prepare("INSERT INTO notas (estudiante, materia, actividad, nota) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$estudiante, $materia, $actividad, $nota]);
    }

    public function update($id, $nota) {
        if ($nota < 0 || $nota > 5) return false;
        $stmt = $this->pdo->prepare("UPDATE notas SET nota = ? WHERE id = ?");
        return $stmt->execute([$nota, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM notas WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getPromedio ($estudiante, $materia) {
        $stmt = $this->pdo->prepare("SELECT AVG(nota) FROM notas WHERE estudiante = ? AND materia = ?");
        $stmt->execute([$estudiante, $materia]);
        $avg = $stmt->fetchColumn();
        return $avg ? round($avg, 2) : 0;
    }

    public function getNotasPorMateria($materia) {
        $stmt = $this->pdo->prepare("SELECT n.*, e.nombre AS estudiante FROM notas n JOIN estudiantes e ON n.estudiante = e.codigo WHERE n.materia = ?");
        $stmt->execute([$materia]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM notas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}