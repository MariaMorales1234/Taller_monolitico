<?php
namespace App\Controller;

use App\Model\Entities\Programa;

require_once __DIR__ . '/../model/entities/Programa.php';

class ProgramaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Programa();
    }

    public function index()
    {
        $programas = $this->model->obtenerTodos();
        include __DIR__ . '/../view/programas/index.php';
    }

    public function create()
    {
        include __DIR__ . '/../view/programas/create.php';
    }

    public function store()
    {
        if (!empty($_POST['codigo']) && !empty($_POST['nombre'])) {
            $this->model->crear($_POST['codigo'], $_POST['nombre']);
            header("Location: index.php?controller=programa&action=index");
            exit;
        } else {
            echo "⚠️ Todos los campos son obligatorios.";
        }
    }

    public function edit()
    {
        $codigo = $_GET['codigo'] ?? null;
        if ($codigo) {
            $programa = $this->model->obtenerPorCodigo($codigo);
            include __DIR__ . '/../view/programas/edit.php';
        } else {
            echo "No se encontró el programa.";
        }
    }

    public function update()
    {
        if (!empty($_POST['codigo']) && !empty($_POST['nombre'])) {
            $this->model->actualizar($_POST['codigo'], $_POST['nombre']);
            header("Location: index.php?controller=programa&action=index");
            exit;
        } else {
            echo "⚠️ Datos incompletos.";
        }
    }

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
}
