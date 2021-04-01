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
    ?>

    <p><a href='preguntas.php'>Banco de preguntas para el examen</a></p>
    <p><a href='resultados.php'>Resultados del examen</a></p>

</body>

</html>