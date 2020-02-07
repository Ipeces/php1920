<html>
<head>
    <meta charset="UTF-8">

    <title>Web compras</title>
</head>

<body>
<h1>Compra producto</h1>
<?php
include "conexion.php";
/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
    /* Se inicializa la lista valores*/
	echo '<form action="comconstock.php" method="post">';
?>
<div >
<!--Aplicacion-->

    <p>Nombre del producto.</p>
	    <?php
    $obtenernum_almacen=ver_num_almacen($db);
    
     echo ("<select name='nombre_producto'><br>");
       foreach ($obtenernum_almacen as $almacen) {
           echo("<option> $almacen </option>");
       } 
    echo("</select>");
        ?>
        <br>
		</div>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
  $nombre_producto=$_POST['nombre_producto'];
  $ver_id_producto="SELECT ID_PRODUCTO as id from PRODUCTO where NOMBRE='$nombre_producto'";


    $idk3=mysqli_query($db,$ver_id_producto);
    $fila3=mysqli_fetch_assoc($idk3);
    $unidadesquedan=$fila3['id'];




  $ver_cantidad_almacen="SELECT cantidad as canti from almacena where id_producto='$unidadesquedan'";

    $idk4=mysqli_query($db,$ver_cantidad_almacen);
    $fila4=mysqli_fetch_assoc($idk4);
    $unidadesrestantes=$fila4['canti'];
    $idk4=mysqli_query($db,$ver_cantidad_almacen);
    $fila4=mysqli_fetch_assoc($idk4);
    $unidadesrestantes=$fila4['canti'];
  
echo "Estas unidades son las que quedan del producto con nombre".$nombre_producto." = ". $unidadesrestantes;
}
?>
<?php
// Funciones utilizadas en el programa

function ver_num_almacen($db){
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