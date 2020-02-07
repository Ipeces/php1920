<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<?php

if (!isset($_POST) || empty($_POST)) { 

?>
<body>
    <h1 >LOGIN</h1>

 <div >
        <!--Formulario inicio de sesion-->
        <div id="Login">
            <div >
                <div >
                    <div >
                        Login
                    </div>
                    <form id="product-form" name="" action="Login.php" method="POST">
                        <div >
                            <input type="text" name="usuario" placeholder="nombre" >
                        </div>
                        <div >
                            <input type="password" name="contrasena" placeholder="contraseña" >
                        </div>
                       

                        <input type="submit" value="Iniciar sesion" >
                        <input type="reset" value="Borrar" >
                    </form>
                </div>
                <br>
                <div >
                           <a href='Registro de clientes.php'> <button  name="login" value="O inicia sesion" >Registro</button></a>
                </div>

            </div>

        </div>
        <br>


    </div>

    <?php
}
else{


    include 'conexion.php';
    
    $usuario=$_POST['usuario'];
    $contraseña=$_POST['contrasena'];

   
    $correcto="SELECT dni as id from registrouser where usuario='$usuario' and clave='$contraseña'";

    $idk3=mysqli_query($db,$correcto);
    $fila3=mysqli_fetch_assoc($idk3);
    $unidadesrestantes=$fila3['id'];




    if($unidadesrestantes!=null){
        session_start();
        $_SESSION['usuario']=$usuario;
  
        echo ("<h1>Bienvenido ".$usuario."</h1>");
        echo ("<a style='float:right;position:relative;bottom:40px' href='cerrar_sesion.php'><button>Cerrar sesion</button></a>");
        echo ("<a href='compra_productos.php'><button>Comprar Productos</button></a><br>");
        echo ("<br><a href='consulta_compras.php'><button>Consulta compras</button></a>");

    }
    else{
        echo("No se ha podido iniciar sesión sus datos son incorrectos");
    }
}
?>