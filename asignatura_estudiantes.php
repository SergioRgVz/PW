<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="UTF-8">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Curso: <?php echo $_POST["nombre_asig"] ?></title>
</head>

<body>
    <header>
        <h2>
            <?php
                echo $_POST["nombre_asig"];
            ?>
        </h2>
    </header>

    <?php
        session_start();
        $_SESSION["id_asig"] = $_POST["id_asig"];
        $_SESSION["nombre_asig"] = $_POST["nombre_asig"];
    ?>

    <p><a>Examen</a></p>

</body>

</html>