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
}elseif(isset($_POST['insertar'])){
    $conexion = mysqli_connect('localhost','root','')
    or die('No se ha podido realizar la conexión');
    mysqli_select_db($conexion,'proyecto_pablo_araujo')
    or die('No se ha podido conectar a la base de datos');
    $instruccion = "select nombre from personajes where nombre ='".$_POST['nombre']."'";
        $consulta = mysqli_query($conexion, $instruccion);
        $numFilas = mysqli_num_rows($consulta);
        if($numFilas >= 1){
            print '<script language="javascript">alert("Personaje ya registrado");window.location.href="registrarUsuario.php"</script>';
        }else{
            if($_POST['imagen'] != ""){
                $instruccion = "insert into personajes(nombre, elemento, via, imagen) values ('".$_POST['nombre']."','".$_POST['elemento']."','".$_POST['via']."', '".$_POST['imagen']."')";}
            else{
                $instruccion = "insert into personajes(nombre, elemento, via) values ('".$_POST['nombre']."','".$_POST['elemento']."','".$_POST['via']."')";
            }
            $consulta = mysqli_query($conexion, $instruccion);
            header("Location:listaPersonajesManejable.php");
        }
}else{
    $conexion = mysqli_connect('localhost','root','')
    or die('No se ha podido realizar la conexión');
    mysqli_select_db($conexion,'proyecto_pablo_araujo')
    or die('No se ha podido conectar a la base de datos');
    print "<form action='Insertar.php' method='post'><input id='cerrar' type='submit' name='close' value='Cerrar sesión'></form>
    <br><center><h1>Añadir nuevo personaje</h1><form action='Insertar.php' method='post'>
    <table border=1>
    <tr><td>Nombre:</td><td><input type='text' name='nombre' required></td></tr>
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
    </table><p><input type='submit' name='insertar' value='Añadir PJ'></form><a href='listaPersonajesManejable.php'><input type='submit' name='cancelar' value='Cancelar'></a></p></center>";
}

?>
</body>
</html>