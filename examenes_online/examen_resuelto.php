<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="UTF-8">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Examen</title>
</head>

<h2> Examen terminado </h2>
<body>
<?php
    error_reporting(E_ALL & ~E_NOTICE);

    session_start();
    if (!isset($_SESSION["DNIe"]))
        header("location:index.php");

    if ($_SESSION["Rol"] == 1)
        header("location:inicio_profesores.php");


if(isset($_POST["Examen_enviado"]))
{
    $dni = $_SESSION["DNIe"];
    $id_asignatura = $_SESSION["id_asig"];
    $id_examen = $_SESSION["ID_Examen"];
    $calificacion = 0;

    $conexion = mysqli_connect("localhost", "root", "", "examenes_online")
        or die("No se ha podido conectar con la base de datos");

    for($i= 1; $i <=10; $i++)
    {
        $num_pregunta = $_POST['r'.$i.'_id'];
        $respuesta = $_POST['r'.$i];

        $instruccion = "insert into respuesta_examen (DNIe_Alumno, ID_Examen, N_Pregunta, Respuesta_Alumno, Hecho) values ('".$dni."', ".$id_examen.",".$num_pregunta.", ".$respuesta.", 1)";
        $consulta = mysqli_query($conexion, $instruccion)
            or die("Fallo en la consulta de insertar");

        //Guardar calificación
        $instruccion_r_correcta = "SELECT pregunta.R_Correcta FROM pregunta, tema, examen WHERE pregunta.N_pregunta = $num_pregunta AND examen.ID_Asignatura = $id_asignatura AND pregunta.ID_Tema = tema.N_Tema AND tema.ID_Asignatura = examen.ID_Asignatura";
        $consulta_r_correcta = mysqli_query($conexion, $instruccion_r_correcta)
            or die("Fallo en la consulta de calificacion");
        
        $fila = mysqli_fetch_array($consulta_r_correcta);

        if ($respuesta == $fila['R_Correcta'])
            $calificacion++;
    }

    
    //Actualizar número de suspensos, aprobados, notables, sobresalientes y la nota final del alumno.
    $instruccion = "SELECT Nota_final, N_suspensos, N_aprobados, N_notables, N_sobresalientes FROM asignatura, matricula WHERE asignatura.ID_Asignatura = $id_asignatura AND matricula.DNIe = '$dni' AND matricula.ID_Asignatura = $id_asignatura";
    $consulta = mysqli_query($conexion, $instruccion)
        or die ("Fallo en la consulta");
    $resultado = mysqli_fetch_array ($consulta);

    if ($calificacion < 5)
    {
        $suspensos = $resultado['N_suspensos'];
        $suspensos++;
        $instruccion = "UPDATE asignatura, matricula SET N_suspensos = $suspensos, Nota_final = $calificacion WHERE asignatura.ID_Asignatura = $id_asignatura AND matricula.DNIe = '$dni' AND matricula.ID_Asignatura = $id_asignatura";
        $consulta = mysqli_query($conexion, $instruccion)
            or die ("Fallo en la modificacion");

    } else if ($calificacion < 7)
    {
        $aprobados = $resultado['N_aprobados'];
        $aprobados++;
        $instruccion = "UPDATE asignatura, matricula SET N_aprobados = $aprobados, Nota_final = $calificacion WHERE asignatura.ID_Asignatura = $id_asignatura AND matricula.DNIe = '$dni' AND matricula.ID_Asignatura = $id_asignatura";
        $consulta = mysqli_query($conexion, $instruccion)
            or die ("Fallo en la modificacion");

    } else if ($calificacion < 9)
    {
        $notables = $resultado['N_notables'];
        $notables++;
        $instruccion = "UPDATE asignatura, matricula SET N_notables = $notables, Nota_final = $calificacion WHERE asignatura.ID_Asignatura = $id_asignatura AND matricula.DNIe = '$dni' AND matricula.ID_Asignatura = $id_asignatura";
        $consulta = mysqli_query($conexion, $instruccion)
            or die ("Fallo en la modificacion");

    } else
    {
        $sobresalientes = $resultado['N_sobresalientes'];
        $sobresalientes++;
        $instruccion = "UPDATE asignatura, matricula SET N_sobresalientes = $sobresalientes, Nota_final = $calificacion WHERE asignatura.ID_Asignatura = $id_asignatura AND matricula.DNIe = '$dni' AND matricula.ID_Asignatura = $id_asignatura";
        $consulta = mysqli_query($conexion, $instruccion)
            or die ("Fallo en la modificacion");

    }

    mysqli_close($conexion);

    ?> <h1 style="color:green">El examen se ha enviado correctamente.</h1 >
    <br> 
    <a href="inicio_estudiantes.php">Volver al inicio</a>
    <a href="calificacion_estudiante.php">Ver calificaciones</a>

<?php
}
?>

</body>

</html>