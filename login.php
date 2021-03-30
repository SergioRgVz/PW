<?php
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    session_start();

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
        echo "Error en la autentificacion";
    }
    mysqli_close($conexion);
?>