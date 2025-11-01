<?php
require_once '../models/Nota.php';
require_once '../models/Estudiante.php';
require_once '../models/Materia.php';

class NotaController
{
    private $model;
    private $estudianteModel;
    private $materiaModel;

    public function __construct()
    {
        $this->model = new Nota();
        $this->estudianteModel = new Estudiante();
        $this->materiaModel = new Materia();
    }

    public function index()
    {
        $notas = $this->model->getAll();
        include '../views/nota/listar.php';
    }

    public function create()
    {
        $estudiantes = $this->estudianteModel->getAll();
        $materias = $this->materiaModel->getAll();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $estudiante = $_POST['estudiante'];
            $materia = $_POST['materia'];
            $actividad = trim($_POST['actividad']);
            $nota = floatval($_POST['nota']);
            if (empty($estudiante) || empty($materia) || empty ($actividad) || $nota <0 || $nota >5) {
                echo "Todos los campos son obligatorios y la nota debe estar entre 0 y 5.";
                return;
            }
            if ($this->model->create($estudiante, $materia, $actividad, $nota)) {
                header("Location: index.php?controller=nota&action=index");
            } else {
                echo "Error al crear la nota. Verifica que la materia esté en el programa del estudiante.";
            }
        } else {
            include "../views/nota/crear.php";
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nota = floatval($_POST['nota']);
            if ($nota < 0 || $nota > 5) {
                echo "La nota debe estar entre 0 y 5.";
                return;
            } if ($this->model->update($id, $nota)) {
                header("Location: index.php?controller=nota&action=index");
            } else {
                echo "Error al actualizar la nota.";
            }
        } else {
            $nota = $this->model->getById($id);
            if (!$nota) {
                echo "Nota no encontrada.";
                return;
            }
            include "../views/nota/editar.php";
        }
    }

    public function delete($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["confirm"]) && $_POST["confirm"] == "yes") {
                if ($this->model->delete($id)) {
                    header("Location: index.php?controller=nota&action=index");
                } else {
                    echo "Error al eliminar la nota.";
                }
            } else {
                header("Location: index.php?controller=nota&action=index");
            }
        } else {
            include "../views/nota/eliminar.php";
        }
    } 
}