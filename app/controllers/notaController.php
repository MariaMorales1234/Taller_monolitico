<?php
namespace App\Controller;

use App\Models\Entities\Nota;

require_once __DIR__ . '/../models/entities/Nota.php';

class NotaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Nota();
    }

    // Mostrar todas las notas
    public function index()
    {
        $notas = $this->model->obtenerTodas();
        include __DIR__ . '/../view/notas/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        include __DIR__ . '/../view/notas/create.php';
    }

    // Guardar una nueva nota
    public function store()
    {
        if (
        !empty($_POST['materia_id']) &&
        !empty($_POST['estudiante_id']) &&
        !empty ($_POST['nota'])
        ) {
            $resultado = $this->model->crear(
                $_POST['materia_id'],
                $_POST['estudiante_id'],
                $_POST['nota']
            );

            if ($resultado) {
                header("Location: index.php?controller=nota&action=index");
                exit;
            } else {
                echo "Error al crear la nota. Verifique que la materia y el estudiante existan, y que la nota sea válida.";
            }
        } else {
            echo "Todos los campos son obligatorios.";
        }
    }

    // Editar nota (por id)
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $nota = $this->model->obtenerPorID($id);
            if ($nota) {
            include __DIR__ . '/../view/notas/edit.php';
        } else {
            echo "No se encontró la nota.";
        }
    } else {
        echo "Falta el parámetro ID.";
        }
    }

    // Actualizar nota (por id)
    public function update()
    {
        if (!empty($_POST['id']) && isset($_POST['nota'])) {
            $resultado = $this->model->actualizar($_POST['id'], $_POST['nota']);
            if ($resultado) {
            header("Location: index.php?controller=nota&action=index");
            exit;
        } else {
            echo "No se pudo actualizar la nota.";
        }
    } else {
            echo "Datos incompletos.";
        }
    }

    // Eliminar nota (por id)
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

    public function promedio() 
    {
        if (!empty($_GET['materia']) && !empty($_GET['estudiante'])) {
            $promedio = $this->model->promedioPorMateria($_GET['materia'], $_GET['estudiante']);
            echo "Promedio del estudiante en la materia: " . $promedio;
        } else {
            echo "Faltan parámetros para calcular el promedio.";
        }
    }
}

