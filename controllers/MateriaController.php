<?php
require_once '../models/Materia.php';
require_once '../models/Programa.php';  

class MateriaController {
    private $model;
    private $programaModel;

    public function __construct() {
        $this->model = new Materia();
        $this->programaModel = new Programa();
    }

    public function index() {
        $materias = $this->model->getAll();
        include '../views/materia/listar.php';
    }

    public function create() {
        $programas = $this->programaModel->getAll();  
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codigo = trim($_POST['codigo']);
            $nombre = trim($_POST['nombre']);
            $programa = $_POST['programa'];
            if (empty($codigo) || empty($nombre) || empty($programa)) {
                echo "Todos los campos son obligatorios.";
                return;
            }
            if ($this->model->create($codigo, $nombre, $programa)) {
                header('Location: index.php?controller=materia&action=index');
            } else {
                echo "Error al crear la materia.";
            }
        } else {
            include '../views/materia/crear.php';
        }
    }

    public function edit($codigo) {
        $programas = $this->programaModel->getAll();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre']);
            $programa = $_POST['programa'];
            if (empty($nombre) || empty($programa)) {
                echo "Nombre y programa son obligatorios.";
                return;
            }
            if ($this->model->update($codigo, $nombre, $programa)) {
                header('Location: index.php?controller=materia&action=index');
            } else {
                echo "No se puede modificar, ya que tiene notas registradas.";
            }
        } else {
            $materia = $this->model->getById($codigo);
            if (!$materia) {
                echo "Materia no encontrada.";
                return;
            }
            include '../views/materia/editar.php';
        }
    }

    public function delete($codigo) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
                if ($this->model->delete($codigo)) {
                    header('Location: index.php?controller=materia&action=index');
                } else {
                    echo "No se puede eliminar ya que tiene notas registradas.";
                }
            } else {
                header('Location: index.php?controller=materia&action=index');
            }
        } else {
            include '../views/materia/eliminar.php';
        }
    }
}