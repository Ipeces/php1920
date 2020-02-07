<html>
<head>
    <meta charset="UTF-8">
  
    <title>Web compras</title>
   
</head>

<body>
<h1>ALTA CLIENTE</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	
	
    /* Se inicializa la lista valores*/
	echo '<form action="comaltaam.php" method="post">';
?>

<!--formulario-->
<div>
		
        <p>Num_almacen </p><input type="text" readonly="readonly" name="nombre" placeholder="nif" >
        </br>
        <p>Localidad</p>
		<input type="text"  name="localidad" placeholder="nombre" >
</div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
$nombre=$_POST["nombre"];
$localidad=$_POST["localidad"];
$obtenernum_localidad=vercategoria($db);

var_dump($obtenernum_localidad);
    if($obtenernum_localidad==''){
        $obtenernum_localidad=10;
        $insertar_vacio="INSERT INTO ALMACEN(NUM_ALMACEN,LOCALIDAD) VALUES ($obtenernum_localidad,'$localidad')";
        mysqli_query($db,$insertar_vacio);
    }
    else{
        $obtenernum_localidad+=10;
        $insertar_no_vacio=$insertar_vacio="INSERT INTO ALMACEN(NUM_ALMACEN,LOCALIDAD) VALUES ($obtenernum_localidad,'$localidad')";
        mysqli_query($db,$insertar_no_vacio);
    }
}
?>

<?php
// Funciones utilizadas en el programa

function vercategoria($db){
    $categoria="";
    $sql = "SELECT NUM_ALMACEN FROM ALMACEN";
  
    $resultado=mysqli_query($db,$sql);
    
    if($resultado){
   
        while($fila=mysqli_fetch_assoc($resultado)){
        $categoria=$fila['NUM_ALMACEN'];
            }
    }
    return $categoria;
}
	




?>



</body>

</html>