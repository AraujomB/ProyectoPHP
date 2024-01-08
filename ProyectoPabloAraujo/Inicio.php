<html>
    <head>
        <style>
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
        $conexion = mysqli_connect('localhost','root','')
        or die('No se ha podido realizar la conexión');
        mysqli_select_db($conexion,'proyecto_pablo_araujo')
        or die('No se ha podido conectar a la base de datos');
        print "<center><h1>Inicio de sesión</h1>
        <form action='Inicio.php' method='post'>
        <table>";
        print "<tr><td>Usuario:</td><td><input type='text' name='user'></td>
        <td>Contraseña:</td><td><input type='text' name='psswrd'></td>
        <td><input type='submit' name='enviar' value='Enviar'></td>
        </tr></table><br>¿No tienes cuenta?</td><td><a href='RegistrarUsuario.php'><input type='submit' name='crear' value='Registrarse'></a>
        </form><iframe id='video' width='560' height='315' src='https://www.youtube.com/embed/zlOnfjtTBic?si=YkVBunnwR96TOrWh' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>
            <br><a href='listaPersonajes.php'><input id='botonLista' type='submit' name='lista' value='Ver lista de personajes'></a></center>";
        if(isset($_POST['enviar'])){
            $conexion = mysqli_connect('localhost','root','')
            or die('No se ha podido realizar la conexión');
            mysqli_select_db($conexion,'proyecto_pablo_araujo')
            or die('No se ha podido conectar a la base de datos');
            $instruccion = "select * from usuarios where login='".$_POST['user']."'";
            $consulta = mysqli_query($conexion,$instruccion);
            $nfilas = mysqli_num_rows($consulta);
            if($nfilas == 1){
                $instruccion = "select * from usuarios where login = '".$_POST['user']."' and psswrd = '".$_POST['psswrd']."'";
                $consulta = mysqli_query($conexion,$instruccion);
                $nfilas = mysqli_num_rows($consulta);
                if($nfilas == 1){
                    session_destroy();
                    session_start();
                    $_SESSION['iniciado'] = true;
                    header("Location:listaPersonajesManejable.php");
                }
                else{
                    print '<script language="javascript">alert("Contraseña incorrecta");window.location.href="Inicio.php"</script>';
                }
            }else{
                print '<script language="javascript">alert("Usuario no registrado");window.location.href="Inicio.php"</script>';
            }
        }
}else{
    header("Location:listaPersonajesManejable.php");
}
?>
</body>
</html>