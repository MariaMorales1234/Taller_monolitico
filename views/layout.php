<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma Academica</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Plataforma Academica</h1>
        <p>Sistema de gestión académica</p>
    </div>
    <nav>
        <a href="../public/index.php?controller=programa&action=index">Programas</a>
        <a href="../public/index.php?controller=estudiante&action=index">Estudiantes</a>
        <a href="../public/index.php?controller=materia&action=index">Materias</a>
        <a href="../public/index.php?controller=nota&action=index">Notas</a>
    </nav>
    <div class="main">
        <div class="container">
            <?php
                if (isset($content) && !empty($content)) {
                    echo $content;
                } else {
                    echo '<p>Haga click en uno de los botones del menu para empezar a hacer consultas</p>';
                }
            ?>
        </div>
    </div>
    <div class="footer">
        <p></p>
    </div>
</body>
</html>