<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="UTF-8">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Resultados</title>
</head>

<body>
    <header>
        <h2>Resultados</h2>
    </header>
    <?php
    session_start();
    $asignatura = $_SESSION["id_asig"];
    $conexion = mysqli_connect("localhost", "root", "", "examenes_online");
    $instruccion = "select usuario.DNIe, usuario.Nombre_Usuario, usuario.Apellido_Usuario, matricula.Nota_final from usuario, matricula where usuario.DNIe=matricula.DNIe and matricula.ID_Asignatura='$asignatura'";
    $consulta = mysqli_query($conexion, $instruccion);

    $nfilas = mysqli_num_rows($consulta);
    if ($nfilas > 0)
    {
        ?>
        <TABLE>
        <TR>
        <TH>DNI</TH>
        <TH>Nombre</TH>
        <TH>Calificación</TH>
        </TR>
        <?php
        for ($i=0; $i<$nfilas; $i++)
        {
            $fila = mysqli_fetch_array($consulta);
            ?>
            <TR>
            <TD><?= $fila['DNIe'] ?></TD>
            <TD><?= $fila['Nombre_Usuario'] . " " . $fila['Apellido_Usuario'] ?></TD>
            <TD><?= $fila['Nota_final'] ?></TD>
            </TR>
        <?php } ?>
        </TABLE>
        <?php }

    $instruccion = "SELECT * FROM asignatura WHERE ID_Asignatura='$asignatura'";
    $consulta = mysqli_query($conexion, $instruccion);

    $fila = mysqli_fetch_array($consulta);

    $nota_media = $fila['Nota_media'];

    //Calcular la nota media si no está ya almacenada
    if($nota_media == "")
    {
        $num_alumnos = $fila['N_suspensos'] + $fila['N_aprobados'] + $fila['N_notables'] + $fila['N_sobresalientes'];

        $suma = 0;
        $instruccion = "select Nota_final from matricula where ID_Asignatura='$asignatura'";
        $consulta = mysqli_query($conexion, $instruccion);
        $nfilas = mysqli_num_rows($consulta);

        for ($i=0; $i<$nfilas; $i++)
        {
            $nota = mysqli_fetch_array($consulta);
            $suma += $nota['Nota_final'];
        }

        $nota_media =  $suma / $num_alumnos;
        $instruccion = "UPDATE asignatura SET Nota_media = $nota_media WHERE asignatura.ID_Asignatura = $asignatura";
        $consulta = mysqli_query($conexion, $instruccion)
            or die ("Fallo en la modificacion");
    }

    ?>
    <BR><TABLE>
    <TR>
    <TH>Suspensos</TH>
    <TH>Aprobados</TH>
    <TH>Notables</TH>
    <TH>Sobresalientes</TH>
    <TH>Nota media</TH>
    </TR>

    <TR>
    <TD><?= $fila['N_suspensos'] ?></TD>
    <TD><?= $fila['N_aprobados'] ?></TD>
    <TD><?= $fila['N_notables'] ?></TD>
    <TD><?= $fila['N_sobresalientes'] ?></TD>
    <TD><?= $nota_media ?></TD>
    </TR>

    </TABLE>
    <?php 

    mysqli_close($conexion);
    ?>

</body>

</html>