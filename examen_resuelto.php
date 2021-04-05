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

    $conexion = mysqli_connect("localhost", "root", "", "examenes_online")
    or die("No se ha podido conectar con la base de datos");
    
    // echo("No he entrado en el ifisset");

if(isset($_POST["Examen_enviado"]))
{
    // echo("He entrado en el ifisset");
    $dni = $_SESSION["DNIe"];
    $id_examen = $_SESSION["ID_Examen"];
    for($i= 1; $i <=10; $i++)
    {
        $num_pregunta = $_POST['r'.$i.'_id'];
        $respuesta = $_POST['r'.$i];

        $instruccion = "insert into respuesta_examen (DNIe_Alumno, ID_Examen, N_Pregunta, Respuesta_Alumno, Hecho) values ('".$dni."', ".$id_examen.",".$num_pregunta.", ".$respuesta.",1);";
        $consulta = mysqli_query($conexion, $instruccion)
            or die("Fallo en la consulta de insertar");
        
    }


    ?> <h1 style="color:green">El examen se ha enviado correctamente.</h1 >
    <br> 
    <a href="inicio_estudiantes.php">Volver al inicio</a>
    <a href="calificacion_estudiante.php">Ver calificaciones</a>

<?php
}
?>

</body>

</html>