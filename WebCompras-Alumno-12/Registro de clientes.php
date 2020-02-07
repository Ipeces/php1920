<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>altausuario</title>
    
</head>

<body>
    <h1>ALTA Usuario</h1>

	<?php
	/*Inserción en tabla - mysql PDO*/

	require "conexion.php";


if (!isset($_POST) || empty($_POST)) { 
?>
	
	
	
    <div >
        <!--formulario-->
        
                    <div>
					
                    <h2>    Registro</h2>
                    
                    <form id="product-form" name="" action="Registro de clientes.php" method="POST" >
                        <div >
                            <input type="text" name="dni" placeholder="dni" >
                        </div>
                        <div>
                            <input type="text" name="Nombre" placeholder="Nombre" >
                        </div>
                        <div >
                            <input type="text" name="Apellido" placeholder="Apellido" >
                        </div>

                        <input type="submit" value="Crear usuario" >
                        <input type="reset" value="Borrar">
                    </form>
                </div>
                <br>
                
            
                           <a href=Login.php> <button name="login" value="O inicia sesion">Login</button></a>
              

           

        </div>

        <br>


   



</body>

</html>
	<?php
}
else{
$dni=$_POST['dni'];
$usuario=$_POST['Nombre'];
$apellido=$_POST['Apellido'];

if($dni!=null && $usuario!=null && $apellido!=null){
    $contraseña=strrev($apellido);
    
    $insertar="INSERT INTO registrouser(dni,usuario,clave) values('$dni','$usuario','$contraseña')";

     mysqli_error($db);
    
  if(mysqli_query($db,$insertar)){
    
    header('Location:Login.php');
	echo "registrado con éxito";
  }
  else{
      echo "error a la hora de insertar";
  }
}
else{
    echo ("No has introducido algo");
}	
}

?>