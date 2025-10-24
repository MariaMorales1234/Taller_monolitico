<?php
namespace App\Controller;

use App\Model\Entities\Nota;

require_once __DIR__ . '/../model/entities/Nota.php';

class NotaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Nota();
    }

    public function index()
    {
        $notas = $this->model->obtenerTodas();
        include __DIR__ . '/../view/notas/index.php';
    }

    public function create()
    {
        include __DIR__ . '/../view/notas/create.php';
    }

    public function store()
    {
        if (!empty($_POST['estudiante_id']) && !empty($_POST['materia_id']) && !empty($_POST['nota'])) {
            $this->model->crear($_POST['estudiante_id'], $_POST['materia_id'], $_POST['nota']);
            header("Location: index.php?controller=nota&action=index");
            exit;
        } else {
            echo "⚠️ Todos los campos son obligatorios.";
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $nota = $this->model->obtenerPorId($id);
            include __DIR__ . '/../view/notas/edit.php';
        } else {
            echo "No se encontró la nota.";
        }
    }

    public function update()
    {
        if (!empty($_POST['id']) && isset($_POST['nota'])) {
            $this->model->actualizar($_POST['id'], $_POST['nota']);
            header("Location: index.php?controller=nota&action=index");
            exit;
        } else {
            echo "⚠️ Datos incompletos.";
        }
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->eliminar($id);
            header("Location: index.php?controller=nota&action=index");
            exit;
        } else {
            echo "No se especificó la nota a eliminar.";
        }
    }
}
