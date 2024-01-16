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
}elseif(isset($_POST['eliminarPJ'])){
    $conexion = mysqli_connect("localhost","root","")
    or die("No se pudo realizar la conexión");
    mysqli_select_db($conexion, "proyecto_pablo_araujo")
    or die("No se pudo conectar a la base de datos");
    $personajes = $_POST['eliminados'];
    foreach($personajes as $personaje){
        $instruccion="delete from personajes where nombre = '".$personaje."'";
        mysqli_query($conexion, $instruccion);
    }
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
    <h1>Personajes Honkai Star Rail</h1><form action='Eliminar.php' method='post'><table border=1>
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
        print "<td><input type='checkbox' name='eliminados[]' value='".$fila['nombre']."'></td></tr>";
    };
    print "</table><p><input type='submit' name='eliminarPJ' value='Eliminar'></form><a href='listaPersonajesManejable.php'><input type='submit' name='cancelar' value='Cancelar'></a></p></center><br>
    <center>";
}
    ?>
</body>
</html>