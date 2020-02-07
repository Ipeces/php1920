<html>
<head>
    <meta charset="UTF-8">
   <title>Web compras</title>
</head>

<body>
<h1>ALTA CLIENTE </h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	
	
    /* Se inicializa la lista valores*/
	echo '<form action="comaprpro.php" method="post">';
?>
<div class="container ">
<!--Aplicacion-->

  	
    <p>Num almacen.</p>
	    <?php
    $obtenernum_almacen=ver_num_almacen($db);
    $obtener_nombreproducto=ver_nombre_producto($db);
     echo ("<select name='num_almacen'><br>");
       foreach ($obtenernum_almacen as $almacen) {
           echo("<option> $almacen </option>");
       } 
    echo("</select>");
        ?>
        <br>
        <p>Nombres productos.</p>
    <?php
    
     echo ("<select name='nombre_producto'><br>");
       foreach ($obtener_nombreproducto as $producto) {
           echo("<option> $producto </option>");
       } 
    echo("</select>");
        ?>
        <br>
        <p<Cantidad</p>
	<input type='number' name='cantidad'></input>

	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
$nombre_producto=$_POST["nombre_producto"];
$numeros_almacen=$_POST["num_almacen"];
$cantidad=$_POST['cantidad'];



$resultado_departamentos = "SELECT id_producto as codigo FROM producto where nombre='$nombre_producto'";   
 $idk=mysqli_query($db,$resultado_departamentos);
 $fila=mysqli_fetch_assoc($idk);
 $id_producto=$fila['codigo'];


$insertar_en_almacena="INSERT INTO ALMACENA (NUM_ALMACEN,ID_PRODUCTO,CANTIDAD) VALUES ($numeros_almacen,'$id_producto',$cantidad)";

if(mysqli_query($db,$insertar_en_almacena)){
    echo 'correcto , lo has insertado con exito';
}
else{
    echo 'tienes algun error';
}
}
?>

<?php
// Funciones utilizadas en el programa

function ver_num_almacen($db){
    $categoria=[];
    $sql = "SELECT NUM_ALMACEN FROM ALMACEN";
  
    $resultado=mysqli_query($db,$sql);
    
    if($resultado){
   
        while($fila=mysqli_fetch_assoc($resultado)){
        $categoria[]=$fila['NUM_ALMACEN'];
            }
    }
    return $categoria;
}
function ver_nombre_producto($db){
    $categoria=[];
    $sql = "SELECT NOMBRE FROM PRODUCTO";
  
    $resultado=mysqli_query($db,$sql);
    
    if($resultado){
   
        while($fila=mysqli_fetch_assoc($resultado)){
        $categoria[]=$fila['NOMBRE'];
            }
    }
    return $categoria;
}
	




?>



</body>

</html>