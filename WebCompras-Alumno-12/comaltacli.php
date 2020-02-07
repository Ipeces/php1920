<html>
<head>
    <meta charset="UTF-8">
   <title>Web compras</title>
</head>

<body>
<h1>ALTA CLIENTE</h1>
<?php
include "conexion.php";


if (!isset($_POST) || empty($_POST)) { 

	
	
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Formulario-->

<div >
		
       <p> Nif Cliente </p><input type="text" name="nif" placeholder="nif" >
       
       <p> NOMBRE cliente </p><input type="text" name="nombre" placeholder="nombre" >
      
	
        <p>APELLIDO cliente </p><input type="text" name="apellido" placeholder="apellido" >
   
        <p>cp cliente </p><input type="text" name="cp" placeholder="cp" >
        
        <p>direccion cliente</p> <input type="text" name="direccion" placeholder="nombre" >
     
        <p>ciudad cliente </p><input type="text" name="ciudad" placeholder="ciudad" >
        

</div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
$nif=$_POST["nif"];
$nombre=$_POST["nombre"];
$apellido=$_POST["apellido"];
$cp=$_POST["cp"];
$direccion=$_POST["direccion"];
$ciudad=$_POST["ciudad"];
    if(empty($nif)){
        echo "el nif no puede estar vacio";
    }
    elseif ($nif) {
        $array_nif=verifnif($db);
        $nifrep=false;
        for ($i=0; $i < sizeof($array_nif); $i++) { 
            if($nif==$array_nif[$i]){
               $nifrep=true;
            }
          
            
        }
        if($nifrep==true){
            echo "tu nif ya existe";
        }
        else{
            $bien=comprobarnif($nif);
            if($bien==true){
                 var_dump("Por aqui");
            $CrearCliente="INSERT INTO CLIENTE (NIF,NOMBRE,APELLIDO,CP,DIRECCION,CIUDAD) VALUES('$nif','$nombre','$apellido','$cp','$direccion','$ciudad')" ;
            if(mysqli_query($db,$CrearCliente)){
            echo " Se ha creado su usuario";
            }
            else{
                echo "Ha ocurrido un  error a la hora de crear el usuario";
     
            }
            }
            else{
                echo "tu nif esta mal escrito";
            }
            
           
            
        }
    }
	
}
?>
<?php
// Funciones utilizadas en el programa
function vercategoria($db){
    $categoria=array();
    $sql = "SELECT NOMBRE FROM categoria";
    $resultado=mysqli_query($db,$sql);
    if($resultado){
        while($fila=mysqli_fetch_assoc($resultado)){

        $categoria[]=$fila['NOMBRE'];
            }
    }
    return $categoria;
}
function comprobarnif($nif){
	$letra = substr($nif, -1);
    $numeros = substr($nif, 0, -1);
	if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
		return true;
    }else{
		return false;
	}
}
function verifnif($db){
    $categoria=array();
    $sql = "SELECT NIF FROM CLIENTE";
    $resultado=mysqli_query($db,$sql);
    if($resultado){
        while($fila=mysqli_fetch_assoc($resultado)){

        $categoria[]=$fila['NIF'];
            }
    }
    return $categoria;
}
?>
</body>

</html>