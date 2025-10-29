<?php
namespace App\Controller;

use App\Models\Entites\Nota;

require_once __DIR__ . '/../models/entities/Nota.php';

class NotaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Nota();
    }

    // 🔹 Mostrar todas las notas
    public function index()
    {
        $notas = $this->model->obtenerTodas();
        include __DIR__ . '/../view/notas/index.php';
    }

    // 🔹 Mostrar formulario de creación
    public function create()
    {
        include __DIR__ . '/../view/notas/create.php';
    }

    // 🔹 Guardar una nueva nota
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

    // 🔹 Editar nota (por id)
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

    // 🔹 Actualizar nota (por id)
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

    // 🔹 Eliminar nota (por id)
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

