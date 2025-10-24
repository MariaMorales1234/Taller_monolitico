<?php
namespace App\Controller;

use App\Model\Entities\Estudiante;

require_once __DIR__ . '/../model/entities/Estudiante.php';

class EstudianteController
{
    private $model;

    public function __construct()
    {
        $this-> model = new Estudiante();
    }

    // Mostrar todos los estudiantes
    public function index()
    {
        $estudiantes = $this->model->obtenerTodos();
        include __DIR__ . '/../view/estudiantes/index.php';
    }

    // Formulario de creación
    public function create()
    {
        include __DIR__ . '/../view/estudiantes/create.php';
    }

    // Guardar nuevo estudiante
    public function store()
    {
        if (!empty($_POST['codigo']) && !empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['programa_id'])) {
            $this->model->crear($_POST['codigo'], $_POST['nombre'], $_POST['correo'], $_POST['programa_id']);
            header("Location: index.php?controller=estudiante&action=index");
            exit;
        } else {
            echo "⚠️ Todos los campos son obligatorios.";
        }
    }

    // Formulario de edición
    public function edit()
    {
        $codigo = $_GET['codigo'] ?? null;
        if ($codigo) {
            $estudiante = $this->model->obtenerPorCodigo($codigo);
            include __DIR__ . '/../view/estudiantes/edit.php';
        } else {
            echo "No se encontró el estudiante.";
        }
    }

    // Actualizar estudiante
    public function update()
    {
        if (!empty($_POST['codigo']) && !empty($_POST['nombre']) && !empty($_POST['correo'])) {
            $this->model->actualizar($_POST['codigo'], $_POST['nombre'], $_POST['correo']);
            header("Location: index.php?controller=estudiante&action=index");
            exit;
        } else {
            echo "⚠️ Datos incompletos.";
        }
    }

    // Eliminar estudiante
    public function delete()
    {
        $codigo = $_GET['codigo'] ?? null;
        if ($codigo) {
            $this->model->eliminar($codigo);
            header("Location: index.php?controller=estudiante&action=index");
            exit;
        } else {
            echo "No se especificó el estudiante a eliminar.";
        }
    }
}
