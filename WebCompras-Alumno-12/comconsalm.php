<html>
<head>
    <meta charset="UTF-8">

    <title>Web compras</title>

</head>

<body>
<h1>Almacenes</h1>
<?php
include "conexion.php";
/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
    /* Se inicializa la lista valores*/
	echo '<form action="comconsalm.php" method="post">';
?>
<div >
<!--formulario-->

    Nombre del producto.
	    <?php
    $obtenernum_almacen=ver_num_almacen($db);
    
     echo ("<select name='numero_almacen'><br>");
       foreach ($obtenernum_almacen as $almacen) {
           echo("<option> $almacen </option>");
       } 
    echo("</select>");
        ?>
        <br>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
 $array_productos=ver_productos($db);
    foreach($array_productos as $row){
        echo $row;
        
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
function ver_productos($db){
 $numero_almacen=$_POST['numero_almacen'];
  
 $select_nombre_id=" SELECT almacena.id_producto as almacenar,producto.nombre as producir from almacena,producto where almacena.id_producto=producto.id_producto and almacena.num_almacen=$numero_almacen";

    $idk3=mysqli_query($db,$select_nombre_id);
  
    
    
    if (mysqli_num_rows($idk3) > 0) {

    while($row = mysqli_fetch_assoc($idk3)) {
        $productos[]="Los productos son: id: " . $row["almacenar"]. "  Name: " . $row["producir"].'<br>'; 
        
    }
} else {
    echo "0 resultados";

}
return $productos;
}
?>
</body>

</html>












