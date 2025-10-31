<?php
require_once '../models/Estudiante.php';
require_once '../models/Programa.php'; 

class EstudianteController {
    private $model;
    private $programaModel;

    public function __construct() {
        $this->model = new Estudiante();
        $this->programaModel = new Programa();
    }

    public function index() {
        $estudiantes = $this->model->getAll();
        include '../views/estudiante/listar.php';
    }

    public function create() {
        $programas = $this->programaModel->getAll();  
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codigo = trim($_POST['codigo']);
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $programa = $_POST['programa'];
            if (empty($codigo) || empty($nombre) || empty($email) || empty($programa)) {
                echo "Todos los campos son obligatorios.";
                return;
            }
            if ($this->model->create($codigo, $nombre, $email, $programa)) {
                header('Location: index.php?controller=estudiante&action=index');
            } else {
                echo "Error al crear el estudiante.";
            }
        } else {
            include '../views/estudiante/crear.php';
        }
    }

    public function edit($codigo) {
        $programas = $this->programaModel->getAll();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $programa = $_POST['programa'];
            if (empty($nombre) || empty($email) || empty($programa)) {
                echo "Nombre, email y programa son obligatorios.";
                return;
            }
            if ($this->model->update($codigo, $nombre, $email, $programa)) {
                header('Location: index.php?controller=estudiante&action=index');
            } else {
                echo "No se puede modificar (tiene notas registradas).";
            }
        } else {
            $estudiante = $this->model->getById($codigo);
            if (!$estudiante) {
                echo "Estudiante no encontrado.";
                return;
            }
            include '../views/estudiante/editar.php';
        }
    }

    public function delete($codigo) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
                if ($this->model->delete($codigo)) {
                    header('Location: index.php?controller=estudiante&action=index');
                } else {
                    echo "No se puede eliminar (tiene notas registradas).";
                }
            } else {
                header('Location: index.php?controller=estudiante&action=index');
            }
        } else {
            include '../views/estudiante/eliminar.php';
        }
    }
}
?>