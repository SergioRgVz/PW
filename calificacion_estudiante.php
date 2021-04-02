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
        $id_asignatura = $_POST["id_asig"]; //Cambiar por variable de sesión
        $asignatura = $_POST["nombre_asig"]; //Cambiar por variable de sesión
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
            $calificacion = 0;
            ?>
            <TABLE>
            <?php
            for ($i=0; $i<$nfilas; $i++)
            {
                $fila = mysqli_fetch_array($consulta);
                ?>
                <TR>
                <TD><?= $fila['N_Pregunta'] ?></TD>
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
                    
                    $calificacion++;
                }
                
                ?>
                </TR>
            <?php } ?>
            </TABLE><BR>
        <?php }

        print ("<b>Calificación </b>" . $calificacion . "/10");

        //Actualizar número de suspensos, aprobados, notables, sobresalientes y la nota final del alumno.
        $DNIe = $_SESSION['DNIe'];
        $instruccion = "SELECT Nota_final, N_suspensos, N_aprobados, N_notables, N_sobresalientes FROM asignatura, matricula WHERE asignatura.ID_Asignatura = $id_asignatura AND matricula.DNIe = '$DNIe' AND matricula.ID_Asignatura = $id_asignatura";
        $consulta = mysqli_query($conexion, $instruccion)
            or die ("Fallo en la consulta");
        $resultado = mysqli_fetch_array ($consulta);

        if ($resultado['Nota_final'] == "")
        {
            if ($calificacion < 5)
            {
                $suspensos = $resultado['N_suspensos'];
                $suspensos++;
                $instruccion = "UPDATE asignatura, matricula SET N_suspensos = $suspensos, Nota_final = $calificacion WHERE asignatura.ID_Asignatura = $id_asignatura AND matricula.DNIe = '$DNIe' AND matricula.ID_Asignatura = $id_asignatura";
                $consulta = mysqli_query($conexion, $instruccion)
                    or die ("Fallo en la modificacion");

            } else if ($calificacion < 7)
            {
                $aprobados = $resultado['N_aprobados'];
                $aprobados++;
                $instruccion = "UPDATE asignatura, matricula SET N_aprobados = $aprobados, Nota_final = $calificacion WHERE asignatura.ID_Asignatura = $id_asignatura AND matricula.DNIe = '$DNIe' AND matricula.ID_Asignatura = $id_asignatura";
                $consulta = mysqli_query($conexion, $instruccion)
                    or die ("Fallo en la modificacion");

            } else if ($calificacion < 9)
            {
                $notables = $resultado['N_notables'];
                $notables++;
                $instruccion = "UPDATE asignatura, matricula SET N_notables = $notables, Nota_final = $calificacion WHERE asignatura.ID_Asignatura = $id_asignatura AND matricula.DNIe = '$DNIe' AND matricula.ID_Asignatura = $id_asignatura";
                $consulta = mysqli_query($conexion, $instruccion)
                    or die ("Fallo en la modificacion");

            } else
            {
                $sobresalientes = $resultado['N_sobresalientes'];
                $sobresalientes++;
                $instruccion = "UPDATE asignatura, matricula SET N_sobresalientes = $sobresalientes, Nota_final = $calificacion WHERE asignatura.ID_Asignatura = $id_asignatura AND matricula.DNIe = '$DNIe' AND matricula.ID_Asignatura = $id_asignatura";
                $consulta = mysqli_query($conexion, $instruccion)
                    or die ("Fallo en la modificacion");

            }
        }

        mysqli_close($conexion); ?>

</body>

</html>