<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="UTF-8">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Iniciar sesión</title>
</head>

<body>

<?php
    error_reporting(E_ALL & ~E_NOTICE);
    $error = false;
    $aceptar = $_REQUEST['aceptar'];
    
    if (isset($aceptar))
    {
        session_start();
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        $conexion = mysqli_connect("localhost", "root", "", "examenes_online");
        $instruccion = "SELECT * FROM usuario WHERE Usuario='$usuario' AND Clave='$clave'";
        $consulta = mysqli_query($conexion, $instruccion);

        $fila = mysqli_fetch_array($consulta);

        $_SESSION["DNIe"] = $fila["DNIe"];

        if ($fila != null)
        {
            if ($fila["Rol"] == 0)
                header("location:inicio_estudiantes.php");
            else
                header("location:inicio_profesores.php");
        } else
        {
            $error = true;
        }
        mysqli_close($conexion);
    }
?>

<div class="centrar">
    <form method=post action="index.php" class="form_inicio">
        <h1>Identificación de usuario</h1>
        <?php
            if ($error)
            {
                print ("<SPAN CLASS='error'>" . "Los datos introducidos no fueron correctos." . "</SPAN>");
            }
        ?>
        <p><label for="usuario">Usuario</label></p>
        <p><input type="text" id="usuario" name="usuario"></p>
        <p><label for="clave">Contraseña</label></p>
        <p><input type="password" id="clave" name="clave"></p>
        <p><input type="submit" name="aceptar" value="Aceptar"></p>
    </form>
</div>

</body>

</html>