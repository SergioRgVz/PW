<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="UTF-8">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Editar pregunta</title>
</head>

<body>

<?php

error_reporting(E_ALL & ~E_NOTICE);
$id = $_GET['id'];
$conexion = mysqli_connect("localhost", "root", "", "examenes_online")
    or die("No se ha podido conectar con la base de datos");

if(isset($_POST['insertar'])){
    $enunciado = $_POST['enun'];
    $tema = $_POST['tema'];
    $r_correcta = $_POST['r_correcta'];
    $id = $_POST['id'];

    $instruccion = "update pregunta set Enunciado='$enunciado', R_Correcta=$r_correcta, ID_Tema=$tema where N_Pregunta=$id";

    $consulta = mysqli_query($conexion, $instruccion)
        or die("Fallo en la consulta actualizar");
    mysqli_close($conexion);
    header('Location: preguntas.php?agregada');
}

$instruccion = "select * from pregunta where N_Pregunta=$id";
$consulta = mysqli_query($conexion, $instruccion)
    or die("Fallo en la consulta editar");

$resultado = mysqli_fetch_array($consulta);

$enunciado = $resultado['Enunciado'];
$tema = $resultado['ID_Tema'];
$r_correcta = $resultado['R_Correcta'];
?>

<body style="padding:15px 15px 15px 15px">
    <h2 style=color:white>Editar pregunta</h2>
<form method="post" action="editar_pregunta.php">
    Enunciado:
    <br>
    <textarea style="width:400px "name="enun" maxlength=400><?=$enunciado?></textarea>
    <br>
    Tema:
    <input type="number" name="tema" min="1" value="<?=$tema?>" maxlength=2>
    <br>
    Selecciona la respuesta correcta:
    <br/>
    <?php
    if($r_correcta == 1)
    {?>
    <input name="r_correcta" type="radio" value="1" checked/>Verdadero
    <input name="r_correcta" type="radio" value="0"/>Falso
    <?php
    }
    else
    {?>
    <input name="r_correcta" type="radio" value="1"/>Verdadero
    <input name="r_correcta" type="radio" value="0" checked/>Falso
    <?php } ?>
    <br><br>
    <input type="submit" name="insertar" value="Guardar">
    <input type="reset" value="Limpiar">
    <input type="hidden" name="id" value=<?=$id?>>
</form>

</body>

</html>