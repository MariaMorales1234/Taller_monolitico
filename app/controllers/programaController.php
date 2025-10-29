<?php
namespace App\Controllers;

use App\Model\Entities\Programa;
require_once __DIR__ . '/../models/entities/Programa.php';


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
        include __DIR__ . '/../views/programas/index.php';
    }

    public function create()
    {
        include __DIR__ . '/../views/programas/create.php';
    }

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

    public function getAll()
    {
        return $this->model->obtenerTodos();
    }

    public function show($codigo)
    {
        if (!$codigo) {
            return null;
        }
        return $this->model->obtenerPorCodigo($codigo);
    }

    public function canUpdate($codigo)
    {
        if (!$codigo) {
            return false;
        }

        $tieneEstudiantes = method_exists($this->model, 'tieneEstudiantes') ? $this->model->tieneEstudiantes($codigo) : false;
        $tieneMaterias = method_exists($this->model, 'tieneMaterias') ? $this->model->tieneMaterias($codigo) : false;

        return !$tieneEstudiantes && !$tieneMaterias;
    }

}