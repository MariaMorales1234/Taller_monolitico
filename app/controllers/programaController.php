<?php
namespace App\Controller;

require_once __DIR__ . '/../models/entities/Programa.php';
use App\Models\Entities\Programa;

class ProgramaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Programa();
    }

    // Mostrar todos los programas
    public function index()
    {
        $programas = $this->model->obtenerTodos();
        include __DIR__ . '/../views/programas/index.php';
    }

    // Formulario de creación
    public function create()
    {
        include __DIR__ . '/../views/programas/create.php';
    }

    // Guardar nuevo programa
    public function store()
    {
        if (!empty($_POST['codigo']) && !empty($_POST['nombre'])) {
            $this->model->crear($_POST['codigo'], $_POST['nombre']);
            header("Location: index.php?controller=programa&action=index");
            exit;
        } else {
            echo "Todos los campos son obligatorios.";
        }
    }

    // Formulario de edición
    public function edit()
    {
        $codigo = $_GET['codigo'] ?? null;
        if ($codigo) {
            $programa = $this->model->obtenerPorCodigo($codigo);
            include __DIR__ . '/../views/programas/edit.php';
        } else {
            echo "No se encontró el programa.";
        }
    }

    // Actualizar programa
    public function update()
    {
        if (!empty($_POST['codigo']) && !empty($_POST['nombre'])) {
            $this->model->actualizar($_POST['codigo'], $_POST['nombre']);
            header("Location: index.php?controller=programa&action=index");
            exit;
        } else {
            echo "Datos incompletos.";
        }
    }

    // Eliminar programa
    public function delete()
    {
        $codigo = $_GET['codigo'] ?? null;
        if ($codigo) {
            $this->model->eliminar($codigo);
            header("Location: index.php?controller=programa&action=index");
            exit;
        } else {
            echo "No se especificó el programa a eliminar.";
        }
    }

    // Obtener todos los programas (uso auxiliar)
    public function getAll()
    {
        return $this->model->obtenerTodos();
    }
}