<?php
namespace App\Controller;

use App\Models\Entites\Nota;

require_once __DIR__ . '/../models/entites/Nota.php';

class NotaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Nota();
    }

    // Listar todas las notas
    public function index()
    {
        $notas = $this->model->obtenerTodas();
        include __DIR__ . '/../view/notas/index.php';
    }

    // Mostrar formulario para crear nueva nota
    public function create()
    {
        include __DIR__ . '/../view/notas/create.php';
    }

    // Guardar una nueva nota
    public function store($estudiante = null, $materia = null, $actividad = null, $nota = null)
    {
        if ($estudiante && $materia && $actividad && $nota !== null) {
            return $this->model->crear($estudiante, $materia, $actividad, $nota);
        }

    // Si se usa desde un formulario sin parámetros explícitos
        if (!empty($_POST['estudiante']) && !empty($_POST['materia']) && !empty($_POST['actividad']) && isset($_POST['nota'])) {
            $this->model->crear($_POST['estudiante'], $_POST['materia'], $_POST['actividad'], $_POST['nota']);
            header("Location: index.php");
            exit;
        }

        echo "Todos los campos son obligatorios.";
        return false;
    }


    //  Mostrar formulario de edición
    public function edit()
    {
        $actividad = $_GET['actividad'] ?? null;

        if ($actividad) {
            $nota = $this->model->obtenerPorActividad($actividad);
            include __DIR__ . '/../view/notas/edit.php';
        } else {
            echo "No se encontró la nota.";
        }
    }

    // Actualizar una nota
    public function update()
    {
        if (!empty($_POST['actividad']) && isset($_POST['nota'])) {
            $actividad = $_POST['actividad'];
            $nota = floatval($_POST['nota']);

            if ($nota < 0 || $nota > 5) {
                echo "La nota debe estar entre 0 y 5.";
                return;
            }

            $this->model->actualizar($actividad, $nota);
            header("Location: index.php?controller=nota&action=index");
            exit;
        } else {
            echo "Datos incompletos.";
        }
    }

    // Eliminar nota
    public function delete()
    {
        $actividad = $_GET['actividad'] ?? null;

        if ($actividad) {
            $this->model->eliminar($actividad);
            header("Location: index.php?controller=nota&action=index");
            exit;
        } else {
            echo "No se especificó la nota a eliminar.";
        }
    }

    // Obtener todas las notas (para vistas o selects)
    public function getAll()
    {
        return $this->model->obtenerTodas();
    }

    public function obtenerNota($materia, $estudiante, $actividad)
    {
    // Asegúrate de que tu modelo Nota tiene el método obtenerPorClave()
    return $this->model->obtenerPorClave($materia, $estudiante, $actividad);
    }

}

