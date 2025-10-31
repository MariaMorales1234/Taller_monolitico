<?php
require_once '../models/Programa.php';

class ProgramaController {
    private $model;

    public function __construct() {
        $this->model = new Programa();
    }

    public function index() {
        $programas = $this->model->getAll();
        include '../views/programa/listar.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codigo = trim($_POST['codigo']);
            $nombre = trim($_POST['nombre']);
            if (empty($codigo) || empty($nombre)) {
                echo "Código y nombre son obligatorios.";
                return;
            }
            if ($this->model->create($codigo, $nombre)) {
                header('Location: index.php?controller=programa&action=index');
            } else {
                echo "Error al crear el programa.";
            }
        } else {
            include '../views/programa/crear.php';
        }
    }

    public function edit($codigo) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre']);
            if (empty($nombre)) {
                echo "El nombre del programa es obligatorio.";
                return;
            }
            if ($this->model->update($codigo, $nombre)) {
                header('Location: index.php?controller=programa&action=index');
            } else {
                echo "No se puede modificar, ya que tiene estudiantes o materias relacionadas.";
            }
        } else {
            $programa = $this->model->getById($codigo);
            if (!$programa) {
                echo "Programa no encontrado.";
                return;
            }
            include '../views/programa/editar.php';
        }
    }

    public function delete($codigo) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
                if ($this->model->delete($codigo)) {
                    header('Location: index.php?controller=programa&action=index');
                } else {
                    echo "No se puede eliminar, ya que tiene estudiantes o materias relacionadas.";
                }
            } else {
                header('Location: index.php?controller=programa&action=index');
            }
        } else {
            include '../views/programa/eliminar.php';
        }
    }
}