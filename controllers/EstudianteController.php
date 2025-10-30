<?php
namespace App\Controllers;

use App\Models\Entities\Estudiante;

require_once __DIR__ . '/../models/entities/Estudiante.php';

class EstudianteController
{
    private $model;

    public function __construct()
    {
        $this->model = new Estudiante();
    }

    public function index()
    {
        $estudiantes = $this->model->obtenerTodos();
        include __DIR__ . '/../../views/students/index.php';
    }

    public function create()
    {
        include __DIR__ . '/../../views/students/create.php';
    }

    public function store()
    {
        if (
            !empty($_POST['codigo']) &&
            !empty($_POST['nombre']) &&
            !empty($_POST['email']) &&
            !empty($_POST['programa'])
        ) {
            $this->model->crear($_POST['codigo'], $_POST['nombre'], $_POST['email'], $_POST['programa']);
            header("Location: index.php?controller=estudiante&action=index");
            exit;
        } else {
            echo "Todos los campos son obligatorios.";
        }
    }

    public function edit()
    {
        $codigo = $_GET['codigo'] ?? null;
        if ($codigo) {
            $estudiante = $this->model->obtenerPorCodigo($codigo);
            if ($estudiante) {
                include __DIR__ . '/../../views/students/edit.php';
            } else {
                echo "Estudiante no encontrado.";
            }
        } else {
            echo "Código de estudiante no especificado.";
        }
    }

    public function update()
    {
        if (!empty($_POST['codigo']) && !empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['programa'])) {
            $codigo = $_POST['codigo'];
            // Validar si tiene notas registradas
            if ($this->model->tieneNotas($codigo)) {
                echo "No se puede modificar el estudiante porque tiene notas registradas.";
                return;
            }

            $this->model->actualizar($codigo, $_POST['nombre'], $_POST['email'], $_POST['programa']);
            header("Location: index.php?controller=estudiante&action=index");
            exit;
        } else {
            echo "Datos incompletos.";
        }
    }

    public function delete()
    {
        $codigo = $_GET['codigo'] ?? null;
        if ($codigo) {
            // Confirmación (opcional vía modal JS)
            if ($this->model->tieneNotas($codigo)) {
                echo "No se puede eliminar el estudiante porque tiene notas registradas.";
                return;
            }

            $this->model->eliminar($codigo);
            header("Location: index.php?controller=estudiante&action=index");
            exit;
        } else {
            echo "Código de estudiante no especificado.";
        }
    }

    public function getAll()
    {
        return $this->model->obtenerTodos();
    }
}
