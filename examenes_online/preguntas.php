<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="UTF-8">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Preguntas</title>
</head>

<body>

<header>
<h2>Preguntas</h2>
</header>

<?php
error_reporting(E_ALL & ~E_NOTICE);

    session_start();
    if (!isset($_SESSION["DNIe"]))
        header("location:index.php");

    if ($_SESSION["Rol"] == 0)
        header("location:inicio_estudiantes.php");

    $id_asig = $_SESSION["id_asig"];

    $conexion = mysqli_connect("localhost", "root", "", "examenes_online")
        or die("No se ha podido conectar con la base de datos");

    if(isset($_REQUEST['agregada']))
        echo '<h3 style="color: green">Se ha agregado correctamente</h3>';
    $eliminar = $_REQUEST['eliminar'];

    if(isset($eliminar))
    {
        $borrar = $_REQUEST['borrar'];
        $nfilas = count ($borrar);

        for($i=0; $i<$nfilas; $i++)
        {
            $instruccion = "delete from pregunta where N_Pregunta = $borrar[$i]";
            $consulta = mysqli_query($conexion,$instruccion)
                or die("Fallo al eliminar pregunta");
        }

        print("<P class='success'>Se han eliminado " . $nfilas . " preguntas<P>\n");
    }

    if(isset($_REQUEST['fecha']))
    {
        $fecha_ex= $_POST['fecha_examen'];

        $instruccion = "SELECT ID_Examen FROM examen WHERE ID_Asignatura = $id_asig";
        $consulta = mysqli_query($conexion,$instruccion)
            or die("Fallo en la consulta fecha");
        $resultado = mysqli_fetch_array($consulta);

        if($resultado[0] == null)
        {
            $instruccion = "insert into examen (fecha, ID_Asignatura) values ('$fecha_ex', $id_asig)";
            $consulta = mysqli_query($conexion, $instruccion)
                or die("Fallo en la consulta f1");

        }
        else
        {
            $id_e = $resultado['ID_Examen'];
            $instruccion = "update examen set fecha='$fecha_ex' where ID_Examen=$id_e";
            $consulta = mysqli_query($conexion, $instruccion)
                or die("Fallo en la consulta f2");
        }
    }

    $instruccion = "select P.N_Pregunta, P.Enunciado, P.R_Correcta, T.N_Tema, T.Nombre_Tema from tema T, pregunta P where P.ID_Tema=T.N_Tema AND T.ID_Asignatura = $id_asig order by P.N_Pregunta";
    $consulta = mysqli_query($conexion, $instruccion)
        or die("Fallo en la consulta");

    $nfilas = mysqli_num_rows($consulta);
    if($nfilas > 0)
    {
        print("<form method='post' action='preguntas.php'>\n");
        print("<TABLE>\n");
        print("<TR>\n");
        print("<TH>N?? Pregunta</TH>\n");
        print("<TH>Enunciado</TH>\n");
        print("<TH>N?? Tema</TH>\n");
        print("<TH>Nombre del tema</TH>\n");
        print("<TH>Respuesta correcta</TH>\n");
        print("<TH>Editar</TH>\n");
        print("<TH>Borrar</TH>\n");

        for($i=1; $i<=$nfilas; $i++)
        {
            $resultado = mysqli_fetch_array($consulta);
            print("<TR>\n");
            print("<TD>" . $i . "</TD>\n");
            print("<TD>" . $resultado['Enunciado'] . "</TD>\n");
            print("<TD>" . $resultado['N_Tema'] . "</TD>\n");
            print("<TD>" . $resultado['Nombre_Tema'] . "</TD>\n");
            if($resultado['R_Correcta']==1)
                print("<TD>Verdadero</TD>\n");
            else
                print("<TD>Falso</TD>\n");
            ?>
            <TD>
            <a href="editar_pregunta.php?id=<?=$resultado['N_Pregunta']?>">Editar</a>
            <?php
            $id = '"'.$resultado['N_Pregunta'].'"';
            print ("<TD> <input type='CHECKBOX' name='borrar[]' value=$id> </TD>\n");
            print("</TR>\n");
        }
        print("</TABLE>\n");
        print("<input type='submit' name='eliminar' value='Borrar las seleccionadas'>\n");
        print("</form>\n");
    }
    ?>
    <form method=post action=crear_pregunta.php>
        <button type="submit" name="crear">A??adir nueva pregunta</button>
    </form>

    <br>

    <form method=post action=preguntas.php>
        Introduzca la fecha del examen:
        <input type="date" name="fecha_examen">
        <button type="submit" name="fecha">A??adir fecha</button>
    </form>

    <?php
    mysqli_close($conexion);
    ?>

</body>

</html>