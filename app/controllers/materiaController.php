<?php
namespace App\Controller;

use App\Models\Entites\Materia;

require_once __DIR__ . '/../model/entities/Materia.php';

class MateriaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Materia();
    }

    public function index()
    {
        $materias = $this->model->obtenerTodas();
        include __DIR__ . '/../view/materias/index.php';
    }

    public function create()
    {
        include __DIR__ . '/../view/materias/create.php';
    }

    public function store()
    {
        if (!empty($_POST['codigo']) && !empty($_POST['nombre']) && !empty($_POST['programa_id'])) {
            $this->model->crear($_POST['codigo'], $_POST['nombre'], $_POST['programa_id']);
            header("Location: index.php?controller=materia&action=index");
            exit;
        } else {
            echo "⚠️ Todos los campos son obligatorios.";
        }
    }

    public function edit()
    {
        $codigo = $_GET['codigo'] ?? null;
        if ($codigo) {
            $materia = $this->model->obtenerPorCodigo($codigo);
            include __DIR__ . '/../view/materias/edit.php';
        } else {
            echo "No se encontró la materia.";
        }
    }

    public function update()
    {
        if (!empty($_POST['codigo']) && !empty($_POST['nombre'])) {
            $this->model->actualizar($_POST['codigo'], $_POST['nombre']);
            header("Location: index.php?controller=materia&action=index");
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
            header("Location: index.php?controller=materia&action=index");
            exit;
        } else {
            echo "No se especificó la materia a eliminar.";
        }
    }
}
