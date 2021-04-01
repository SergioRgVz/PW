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
        <TH>Nombre y apellidos</TH>
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

    $nfilas = mysqli_num_rows($consulta);
    if ($nfilas > 0)
    {
        ?>
        <BR><TABLE>
        <TR>
        <TH>Aprobados</TH>
        <TH>Notables</TH>
        <TH>Sobresalientes</TH>
        </TR>
        <?php
        for ($i=0; $i<$nfilas; $i++)
        {
            $fila = mysqli_fetch_array($consulta);
            ?>
            <TR>
            <TD><?= $fila['N_aprobados'] ?></TD>
            <TD><?= $fila['N_notables'] ?></TD>
            <TD><?= $fila['N_sobresalientes'] ?></TD>
            </TR>
        <?php } ?>
        </TABLE>
        <?php }

    mysqli_close($conexion);
    ?>

</body>

</html>