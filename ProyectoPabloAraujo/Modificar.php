<html>
    <head>
        <style>
            img{
            width: 100px;
            height: 100px;
        }
        body{
            background-image: url('ImagenesHonkai/backgroundIniciado.jpg');
            background-size: cover;
           }
        table{
            width: 60%;
            text-align: center;
            background-color: white;
            margin-top: 25px;
           }
        h1{
            color: black;
           }
        #cerrar{
            float: inline-end;
        }
        </style>
    </head>
    <body>
<?php
session_start();
if(isset($_POST["close"])){
    $_SESSION['iniciado'] = false;
    $_SESSION['user'] = null;
    session_destroy();
    header("Location:Inicio.php");
}elseif(!isset($_SESSION['iniciado'])){
    header("Location:Inicio.php");
}elseif(isset($_POST['modificar'])){
    if($_POST["editar"] == ""){
        print '<script language="javascript">alert("Selecciona un personaje");window.location.href="Modificar.php"</script>';
    }else{
        $conexion = mysqli_connect("localhost","root","")
        or die("No se puede realizar la conexión");
        mysqli_select_db($conexion,"proyecto_pablo_araujo")
        or die("No se puede conectar con la base de datos");
        $instruccion = "select * from personajes where nombre = '".$_POST['editar']."'";
        $consulta = mysqli_query($conexion,$instruccion);
        $fila = mysqli_fetch_array($consulta);
        print "<form action='Insertar.php' method='post'><input id='cerrar' type='submit' name='close' value='Cerrar sesión'></form>
        <br><center><h1>Modificar personaje</h1><form action='Modificar.php' method='post'>
        <table border=1>
        <tr><td>Nombre:</td><td><input type='text' name='nombre' value='".$fila['nombre']."' required></td></tr>
        <tr><td>Elemento:</td><td><select name='elemento' required>
        <option value='Fuego'>Fuego</option>
        <option value='Hielo'>Hielo</option>
        <option value='Viento'>Viento</option>
        <option value='Imaginario'>Imaginario</option>
        <option value='Cuantico'>Cuantico</option>
        <option value='Fisico'>Fisico</option>
        <option value='Rayo'>Rayo</option></select></td></tr>
        <tr><td>Vía:</td><td><select name='via' required>
        <option value='Destruccion'>Destruccion</option>
        <option value='Erudicion'>Erudicion</option>
        <option value='Caceria'>Caceria</option>
        <option value='Abundancia'>Abundancia</option>
        <option value='Armonia'>Armonia</option>
        <option value='Nihilidad'>Nihilidad</option>
        <option value='Conservacion'>Conservacion</option></select></td></tr>
        <tr><td>Imagen:</td><td><input type='file' name='imagen'></td></tr>
        <input type='hidden' name='imgOld' value='".$fila['imagen']."'>
        </table><p><input type='submit' name='editarPersonaje' value='Enviar'></form><a href='Modificar.php'><input type='submit' name='cancelar' value='Cancelar'></a></p></center>";
    }
}elseif(isset($_POST['editarPersonaje'])){
    $conexion = mysqli_connect("localhost","root","")
    or die("No se pudo realizar la conexión");
    mysqli_select_db($conexion,"proyecto_pablo_araujo")
    or die("No se pudo conectar a la base de datos");
    $instruccion = "update personajes set nombre='".$_POST['nombre']."', elemento='".$_POST['elemento']."', via='".$_POST['via']."'";
    if($_POST['imagen'] != ""){
        $instruccion = $instruccion.", imagen='".$_POST['imagen']."' where nombre='".$_POST['nombre']."'";
    }else{
        $instruccion = $instruccion.", imagen='".$_POST['imgOld']."' where nombre='".$_POST['nombre']."'";
    }
    $consulta = mysqli_query($conexion, $instruccion);
    header("Location:listaPersonajesManejable.php");
}else{
    $conexion = mysqli_connect("localhost","root","")
    or die("No se puede realizar la conexión");
    mysqli_select_db($conexion, "proyecto_pablo_araujo")
    or die("No se puede conectar con la base de datos");
    $instruccion = "select * from personajes";
    $consulta = mysqli_query($conexion, $instruccion);
    $nfilas = mysqli_num_rows($consulta);
    print "<form action='ListaPersonajesManejable.php' method='post'><input id='cerrar' type='submit' name='close' value='Cerrar sesión'>
    </form><br><center>
    <h1>Personajes Honkai Star Rail</h1><form action='Modificar.php' method='post'><table border=1>
    <tr><td>Nombre</td><td>Elemento</td><td>Vía</td><td>Imagen</td></tr>";
    for($i = 0; $i < $nfilas; $i++){
        $fila = mysqli_fetch_array($consulta);
        print "<tr><td>".$fila['nombre']."</td><td>".$fila['elemento']."</td><td>".$fila['via']."</td>";
        if($fila['imagen'] == ""){
            print "<td><a href='ImagenesHonkai/NoImage.jpg'><img src='ImagenesHonkai/NoImage.jpg'></a></td>";
        }
        else{
            print "<td><a href='ImagenesHonkai/".$fila['imagen']."'><img src='ImagenesHonkai/".$fila['imagen']."'></a></td>";
        }
        print "<td><input type='radio' name='editar' value='".$fila['nombre']."'></td></tr>";
    };
    print "</table><p><input type='submit' name='modificar' value='Editar PJ'></form><a href='listaPersonajesManejable.php'><input type='submit' name='cancelar' value='Cancelar'></a></p></center><br>
    <center>";
}
    ?>
</body>
</html>