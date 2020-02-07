<html>
<head>
    <meta charset="UTF-8">
   
    <title>Web compras</title>
    
</head>

<body>
<h1>Compras producto</h1>
<?php
include "conexion.php";
/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
    /* Se inicializa la lista valores*/
	echo '<form action="comconscom.php" method="post">';
?>
<div >
<!--Aplicacion-->

    Nif del cliente.
	    <?php
    $obtenernum_almacen=ver_num_almacen($db);
    
     echo ("<select name='nif'><br>");
       foreach ($obtenernum_almacen as $almacen) {
           echo("<option> $almacen </option>");
       } 
    echo("</select>");
        ?>
        <br>
<?php
    echo "<input type='date' name='fecha_desde'>";
    echo "<input type='date' name='fecha_hasta'>";
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 



if($_POST['fecha_desde']>$_POST['fecha_hasta']){
    echo "tus fechas estan mal revisalas";
}
else{
    $array=ver_compras($db);
   foreach($array as $row){
    echo $row;
   }
}
}

?>
<?php
// Funciones utilizadas en el programa

function ver_num_almacen($db){
    $categoria=[];
    $sql = "SELECT NIF FROM cliente";
  
    $resultado=mysqli_query($db,$sql);
    
    if($resultado){
   
        while($fila=mysqli_fetch_assoc($resultado)){
        $categoria[]=$fila['NIF'];
            }
    }
    return $categoria;
}
function ver_compras($db){
$fecha_desde=$_POST['fecha_desde'];
$fecha_hasta=$_POST['fecha_hasta'];
$nif_cliente=$_POST['nif'];
 $select_nombre_id=" SELECT producto.id_producto as id,producto.nombre as nombre,producto.precio as dinero from compra,producto where compra.id_producto=producto.id_producto and compra.nif='$nif_cliente' and compra.fecha_compra>='$fecha_desde' and compra.fecha_compra<='$fecha_hasta'";

    $idk3=mysqli_query($db,$select_nombre_id);
  $productos[]=null;
    
    
    if (mysqli_num_rows($idk3) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($idk3)) {
        $productos[]="Los productos son: id: " . $row["id"]. "  Name: " . $row["nombre"]." dinero:". $row['dinero'].'<br>'; 
        
    }
    } else {
    echo "0 resultados";

    }
    return $productos;
}
?>
</body>

</html>












