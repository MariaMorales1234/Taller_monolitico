<?php
// Activar reporte de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Obtener parámetros de la URL
$controller = $_GET['controller'] ?? 'programa';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;  // Cambiado de $codigo a $id para notas
$codigo = $_GET['codigo'] ?? null;  // Mantén $codigo para otros módulos

// Ruta al controlador
$controllerFile = "../controllers/{$controller}Controller.php";
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . 'Controller';
    if (class_exists($controllerClass)) {
        $controllerInstance = new $controllerClass();
        // Llamar a la acción
        if (method_exists($controllerInstance, $action)) {
            // Pasar $id para notas, $codigo para otros
            if ($controller == 'nota') {
                $controllerInstance->$action($id);
            } else {
                $controllerInstance->$action($codigo);
            }
        } else {
            echo "Acción '{$action}' no encontrada en el controlador '{$controller}'.";
        }
    } else {
        echo "Controlador '{$controllerClass}' no encontrado.";
    }
} else {
    echo "Archivo del controlador '{$controllerFile}' no encontrado.";
}
?>