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

    $conexion = mysqli_connect("localhost", "root", "", "examenes_online")
    or die("No se ha podido conectar con la base de datos");
    

    $dni = "77171748G";
    $id_asignatura = "21714063";
    $_SESSION["DNIe"]= "77171748G";

    $instruccion = "SELECT ID_Examen FROM Examen WHERE ID_Asignatura = $id_asignatura";
    
    $consulta = mysqli_query($conexion, $instruccion);

    $id_examen = mysqli_fetch_array($consulta);
    //$id_examen["ID_Examen"]++;
    $_SESSION["ID_Examen"] = $id_examen["ID_Examen"];


    $fecha_actual = date('Y-m-d');
    $instruccion = "SELECT fecha FROM Examen WHERE ID_Asignatura = $id_asignatura"; 
    $consulta = mysqli_query($conexion, $instruccion);
    $date = mysqli_fetch_array($consulta);

    if($fecha_actual == $date['fecha'])
    {
        $instruccion = "SELECT * FROM pregunta WHERE ID_Tema IN (SELECT N_Tema FROM Tema WHERE ID_Asignatura =$id_asignatura) ORDER BY RAND() LIMIT 10";
        $consulta = mysqli_query($conexion, $instruccion);


        $nfilas = mysqli_num_rows($consulta);
        if($nfilas > 0)
        {
            $fila = mysqli_fetch_array($consulta);
            ?>
        <form method = post action = examen_resuelto.php>
            <?php 
            $num_ejercicio = 1;
            var_dump($fila);
            for($i=0; $i < 10; $i++)
            {
              
                ?>
                Voy a imprimir la pregunta numero <?=$num_ejercicio?>
                <br>
                <br>
                <!-- <?=var_dump($fila);?> -->

                
                <br>
                <br>
                Ejercicio <?=$num_ejercicio?>: 

                <?= $fila['Enunciado'] ?>
                <br>
                Selecciona su respuesta <br>
                <input type = radio name = r<?= $num_ejercicio?> value = 1> Verdadero <br>
                <input type = radio name = r<?= $num_ejercicio?> value = 0> Falso <br>
                <input type = radio name = r<?= $num_ejercicio?> value = 2 checked> Dejar sin responder <br>
                <input type = "hidden" name=r<?= $num_ejercicio?>_id value=<?=$fila["N_Pregunta"]?>> 
                
                <?php
                $num_ejercicio++;
                // <hr></hr>
                $fila = mysqli_fetch_array($consulta);
            }
            ?>
            <input type = "submit" name="Examen_enviado" value=Enviar>
        </form>
            <?php
        }

    }
?>
</body>

</html>