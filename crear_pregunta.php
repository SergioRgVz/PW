<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="UTF-8">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Crear pregunta</title>
</head>

<?php

error_reporting(E_ALL & ~E_NOTICE);
$insertar = $_POST['insertar'];
$enunciado = $_POST['enun'];
$tema = $_POST['tema'];
$r_correcta = $_POST['r_correcta'];
$nPregunta = $_POST["nfilas"]+1;

if(isset($insertar))
{
    $conexion = mysqli_connect("localhost", "root", "", "examenes_online")
        or die("No se ha podido conectar con la base de datos");

    $instruccion = "insert into pregunta (N_Pregunta, Enunciado, R_Correcta, ID_Tema) values ('$nPregunta','$enunciado','$r_correcta','$tema')";
    $consulta = mysqli_query($conexion, $instruccion)
        or die("Fallo en la consulta");

    mysqli_close($conexion);
    header('Location: preguntas.php?agregada');
    
}

?>

<body style="padding:15px 15px 15px 15px">
    <h2>Crear pregunta</h2>
<form method="post" action="crear_pregunta.php">
    Enunciado:
    <br>
    <textarea style="width:400px "name="enun" maxlength=400></textarea>
    <br>
    Tema:
    <input type="number" name="tema" min="1" maxlength=2>
    <br>
    Selecciona la respuesta correcta:
    <br/>
    <input name="r_correcta" type="radio" value="1"/>Verdadero
    <input name="r_correcta" type="radio" value="0"/>Falso
    <br><br>
    <input type="submit" name="insertar" value="Guardar">
    <input type="reset" value="Limpiar">
    <input type="hidden" value="<?=$_POST['nfilas']?>" name="nfilas">
</form>


</body>

</html>