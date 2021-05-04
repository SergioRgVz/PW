<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="UTF-8">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Resultados</title>
</head>

<body>
    <?php
        session_start();
        if (!isset($_SESSION["DNIe"]))
            header("location:index.php");

        if ($_SESSION["Rol"] == 1)
            header("location:inicio_profesores.php");
            
        $id_asignatura = $_SESSION["id_asig"];
        $asignatura = $_SESSION["nombre_asig"];
        $dni = $_SESSION["DNIe"];
    ?>

    <header>
        <h2><?php echo $asignatura; ?></h2>
    </header>
    
    <?php
        $conexion = mysqli_connect("localhost", "root", "", "examenes_online");
        $instruccion = "SELECT respuesta_examen.N_Pregunta, pregunta.Enunciado, respuesta_examen.Respuesta_Alumno, pregunta.R_Correcta FROM pregunta, examen, respuesta_examen WHERE pregunta.N_pregunta = respuesta_examen.N_pregunta AND respuesta_examen.ID_Examen = examen.ID_Examen AND examen.ID_Asignatura = $id_asignatura";
        $consulta = mysqli_query($conexion, $instruccion);

        $nfilas = mysqli_num_rows($consulta);
        if ($nfilas > 0)
        {
            ?>
            <TABLE>
            <?php
            for ($i=1; $i<=$nfilas; $i++)
            {
                $fila = mysqli_fetch_array($consulta);
                ?>
                <TR>
                <TD><?= $i ?></TD>
                <TD><?= $fila['Enunciado'] ?></TD>
                <?php
                if ($fila['Respuesta_Alumno'] != $fila['R_Correcta'])
                {
                    if($fila['Respuesta_Alumno']==1)
                        print("<TD class='error'>Verdadero</TD>\n");
                    else
                        print("<TD class='error'>Falso</TD>\n");
                } else
                {
                    if($fila['Respuesta_Alumno']==1)
                        print("<TD class='acierto'>Verdadero</TD>\n");
                    else
                        print("<TD class='acierto'>Falso</TD>\n");
                }
                
                ?>
                </TR>
            <?php } ?>
            </TABLE><BR>
            <?php

            $instruccion = "SELECT Nota_final FROM matricula WHERE DNIe = '$dni' AND ID_Asignatura = $id_asignatura";
            $consulta = mysqli_query($conexion, $instruccion);
            $fila = mysqli_fetch_array($consulta);

            print ("<b>Calificación </b>" . $fila['Nota_final'] . "/10");
        }

        mysqli_close($conexion); ?>

        <p><a href="inicio_estudiantes.php">Volver al inicio</a></p>

</body>

</html>