<html>
    <head>
        <style>
            #titulo{
                font-size: 28;
            }
           body{
            background-image: url('ImagenesHonkai/backgroundInicio.jpg');
            color: white;
            padding: 50px;
           }
           #video{
            margin-top: 50px;
           }
           #botonLista{
            margin-top: 30px;
           }
        </style>
    </head>
    <body>
<?php
session_start();
if(!isset($_SESSION['iniciado'])){
    if(isset($_POST['registrar'])){
        $conexion = mysqli_connect('localhost','root','')
        or die('No se ha podido realizar la conexión');
        mysqli_select_db($conexion,'proyecto_pablo_araujo')
        or die('No se ha podido conectar a la base de datos');
        $instruccion = "select login from usuarios where login ='".$_POST['nickname']."'";
        $consulta = mysqli_query($conexion, $instruccion);
        $numFilas = mysqli_num_rows($consulta);
        if($numFilas >= 1){
            print '<script language="javascript">alert("Nombre de usuario no disponible");window.location.href="registrarUsuario.php"</script>';
        }else{
            $instruccion = "insert into usuarios(login, psswrd, nombre, email) values ('".$_POST['nickname']."','".$_POST['passwrd']."','".$_POST['nombreReg']."', '".$_POST['email']."')";
            $consulta = mysqli_query($conexion, $instruccion);
            session_destroy();
            session_start();
            $_SESSION['iniciado'] = true;
            header("Location:listaPersonajesManejable.php");
        }
    }else{
        $conexion = mysqli_connect('localhost','root','')
        or die('No se ha podido realizar la conexión');
        mysqli_select_db($conexion,'proyecto_pablo_araujo')
        or die('No se ha podido conectar a la base de datos');
        print "<center><h1 id='titulo'>Registrar nuevo usuario</h1>
            <form action='registrarUsuario.php' method='post'>
            <table><tr><td>Nombre de usuario</td><td><input type='text' name='nickname' required></td></tr>
            <tr><td>Contraseña</td><td><input type='password' name='passwrd' required></td></tr>
            <tr><td>Nombre</td><td><input type='text' name='nombreReg' required></td></tr>
            <tr><td>Email</td><td><input type='text' name='email' required></td></tr></table>
            <br><input type='submit' name='registrar' value='Registrarse'></center>";
    }
}else{
    header("Location:listaPersonajesManejable.php");
}
?>
</body>
</html>
