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

    $instruccion = "select P.N_Pregunta, P.Enunciado, P.R_Correcta, T.N_Tema, T.Nombre_Tema from tema T, pregunta P, asignatura A where P.ID_Tema=T.N_Tema AND A.ID_Asignatura=T.ID_Asignatura order by P.N_Pregunta";
    $consulta = mysqli_query($conexion, $instruccion)
        or die("Fallo en la consulta");

    $nfilas = mysqli_num_rows($consulta);
    if($nfilas > 0)
    {
        print ("<FORM ACTION='preguntas.php' METHOD='post'>\n");
        print("<TABLE>\n");
        print("<TR>\n");
        print("<TH>Nº Pregunta</TH>\n");
        print("<TH>Enunciado</TH>\n");
        print("<TH>Nº Tema</TH>\n");
        print("<TH>Nombre del tema</TH>\n");
        print("<TH>Respuesta correcta</TH>\n");
        print("<TH>Editar</TH>\n");
        print("<TH>Borrar</TH>\n");

        for($i=0; $i<$nfilas; $i++)
        {
            $resultado = mysqli_fetch_array($consulta);
            print("<TR>\n");
            print("<TD>" . $resultado['N_Pregunta'] . "</TD>\n");
            print("<TD>" . $resultado['Enunciado'] . "</TD>\n");
            print("<TD>" . $resultado['N_Tema'] . "</TD>\n");
            print("<TD>" . $resultado['Nombre_Tema'] . "</TD>\n");
            if($resultado['R_Correcta']==1)
                print("<TD>Verdadero</TD>\n");
            else
                print("<TD>Falso</TD>\n");
            ?>
            <TD>
            <form method=post action=editar_pregunta.php>
                <button type="submit">Editar</button>
                <input type="hidden" value="<?=$resultado['N_Pregunta']?>" name="n_preg">
            </form>
            <?php
            $id = '"'.$resultado['N_Pregunta'].'"';
            print ("<TD> <input type='CHECKBOX' name='borrar[]' value=$id> </TD>\n");
            print("</TR>\n");
        }
        
        print("</TABLE>\n");
        print ("<input type='SUBMIT' name='eliminar' value='Borrar las seleccionadas'>\n");
        print ("</FORM>\n");
    }

    ?>
    <form method=post action=crear_pregunta.php>
        <button type="submit" name="crear">Añadir nueva pregunta</button>
        <input type="hidden" value="<?=$nfilas?>" name="nfilas">
    </form>

    <?php

    mysqli_close($conexion);
    ?>

</body>

</html>