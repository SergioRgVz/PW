<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="UTF-8">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Inicio</title>
</head>

<body>
    <div class="centrar">
        <header>
            <h2>Asignaturas</h2>
        </header>
        <?php
            session_start();
            $conexion = mysqli_connect("localhost", "root", "", "examenes_online");
            $dni = $_SESSION["DNIe"];
            $instruccion = "SELECT * FROM asignatura WHERE ID_Asignatura IN (SELECT ID_Asignatura FROM coordina WHERE DNIe='$dni')";
            $consulta = mysqli_query($conexion, $instruccion);

            $nfilas = mysqli_num_rows($consulta);
            if ($nfilas > 0)
            {
                ?>
                <TABLE>
                <TR>
                <TH>Código</TH>
                <TH>Nombre</TH>
                <TH>Acción</TH>
                </TR>
                <?php
                for ($i=0; $i<$nfilas; $i++)
                {
                    $fila = mysqli_fetch_array($consulta);
                    ?>
                    <TR>
                    <TD><?= $fila['ID_Asignatura'] ?></TD>
                    <TD><?= $fila['Nombre_Asign'] ?></TD>
                    <TD>
                    <form method=post action="asignatura.php">
                        <button type="submit">Acceder</button>
                        <input type="hidden" value="<?=$fila["Nombre_Asign"]?>" name="nombre_asig">
                    </form>
                    </TD>
                    </TR>
                <?php } ?>
                </TABLE>
            <?php }
            mysqli_close($conexion); ?>
    </div>
</body>

</html>