<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="UTF-8">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Examen</title>
</head>

<h2> Preguntas </h2>
<body>
<?php
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    if (!isset($_SESSION["DNIe"]))
        header("location:index.php");

    if ($_SESSION["Rol"] == 1)
        header("location:inicio_profesores.php");


    $conexion = mysqli_connect("localhost", "root", "", "examenes_online")
    or die("No se ha podido conectar con la base de datos");
    
    $id_asignatura = $_SESSION["id_asig"];
    $dni = $_SESSION["DNIe"];

    $instruccion = "SELECT ID_Examen FROM Examen WHERE ID_Asignatura = $id_asignatura";
    
    $consulta = mysqli_query($conexion, $instruccion);

    $id_examen = mysqli_fetch_array($consulta);

    $_SESSION["ID_Examen"] = $id_examen["ID_Examen"];

    $fecha_actual = date('Y-m-d');
    $instruccion = "SELECT fecha FROM Examen WHERE ID_Asignatura = $id_asignatura"; 
    $consulta = mysqli_query($conexion, $instruccion);
    $date = mysqli_fetch_array($consulta);

    $instruccion = "SELECT Hecho from respuesta_examen WHERE DNIe_Alumno = '$dni'";
    $consulta = mysqli_query($conexion, $instruccion);
    $hecho = mysqli_fetch_array($consulta);

    if($hecho['Hecho'] == 1)
    {
        ?>
        <p>Aqui puedes consultar tus calificaciones<p>
        
        <a href="calificacion_estudiante.php">Ver calificaciones</a>
        <?php
    }


    else{
    if($fecha_actual == $date['fecha'])
    {
        $instruccion = "SELECT * FROM pregunta WHERE ID_Tema IN (SELECT N_Tema FROM Tema WHERE ID_Asignatura = $id_asignatura) ORDER BY RAND() LIMIT 10";
        $consulta = mysqli_query($conexion, $instruccion);


        $nfilas = mysqli_num_rows($consulta);
        if($nfilas > 0)
        {
            $fila = mysqli_fetch_array($consulta);
            ?>
        <form method = post action = examen_resuelto.php>
            <?php 
            $num_ejercicio = 1;
            for($i=0; $i < 10; $i++)
            {
              
                ?>
                <br>
                <br>
                Ejercicio <?=$num_ejercicio?>: 

                <?= $fila['Enunciado'] ?>
                <br>
                Selecciona su respuesta <br>
                <input type = radio name = r<?= $num_ejercicio?> value = 1> Verdadero <br>
                <input type = radio name = r<?= $num_ejercicio?> value = 0> Falso <br>
                <input type = radio name = r<?= $num_ejercicio?> value = 2 checked> Dejar sin responder <br>
                <input type = "hidden" name=r<?= $num_ejercicio?>_id value=<?=$fila["N_pregunta"]?>> 
                
                <?php
                $num_ejercicio++;

                $fila = mysqli_fetch_array($consulta);
            }
            ?>
            <br><input type = "submit" name="Examen_enviado" value=Enviar>
        </form>
        <?php
        }

    }
    else
    {
        ?> 

        <h2>Vuelve el día del examen</h2>
        <a href="inicio_estudiantes.php">Volver al inicio</a>
        <?php   
        }
    }
    mysqli_close($conexion);
?>
</body>

</html>