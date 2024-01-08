<html>
    <head>
        <style>
            img{
            width: 100px;
            height: 100px;
        }
        body{
            background-image: url('ImagenesHonkai/background.jpg');
           }
        table{
            background-color: white;
            margin-top: 25px;
            width: 80%;
           }
        h1{
            color: green;
           }
        </style>
    </head>
    <body>
<?php
session_start();
    $conexion = mysqli_connect("localhost","root","")
    or die("No se puede realizar la conexión");
    mysqli_select_db($conexion, "proyecto_pablo_araujo")
    or die("No se puede conectar con la base de datos");
    $consulta = "select * from personajes";
    $consulta = mysqli_query($conexion, $consulta);
    $nfilas = mysqli_num_rows($consulta);
    print "<center>
    <h1>Personajes Honkai Star Rail</h1><table border=1>
    <tr><td>Nombre</td><td>Elemento</td><td>Vía</td><td>Imagen</td></tr>";
    for($i = 0; $i < $nfilas; $i++){
        $fila = mysqli_fetch_array($consulta);
        print "<tr><td>".$fila['nombre']."</td><td>".$fila['elemento']."</td><td>".$fila['via']."</td>";
        if($fila['imagen'] == ""){
            print "<td><a href='ImagenesHonkai/NoImage.jpg'><img src='ImagenesHonkai/NoImage.jpg'></a></td></tr>";
        }
        else{
            print "<td><a href='ImagenesHonkai/".$fila['imagen']."'><img src='ImagenesHonkai/".$fila['imagen']."'></a></td>";
        }
    };
    print "</table><br><a href='Inicio.php'><input type='submit' name='volver' value='Volver al Login'></a></center>";
?>
</body>
</html>