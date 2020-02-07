<html>
<head>
    <meta charset="UTF-8">
    <title>Web compras</title>
 
</head>

<body>
<h1>Compra producto </h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	
	
    /* Se inicializa la lista valores*/
	echo '<form action="compro.php" method="post">';
?>
<
<!--compra-->

<div >
   
   <p> Nombre de cliente.</p>

	
	    <?php
    $obtenernum_almacen=ver_num_almacen($db);
    $obtener_nombreproducto=ver_nombre_producto($db);
     echo ("<select name='nombre_cliente'><br>");
       foreach ($obtenernum_almacen as $almacen) {
           echo("<option> $almacen </option>");
       } 
    echo("</select>");
        ?>
        <br>
       <p> Nombres productos.</p>
    <?php
    
     echo ("<select name='nombre_producto'><br>");
       foreach ($obtener_nombreproducto as $producto) {
           echo("<option> $producto </option>");
       } 
    echo("</select>");
        ?>
        <br>
        <p>Cantidad</p>
    <input type='number' name='cantidad'></input>
    <br>
    <input type='date' name='fecha'></input>
	</div>
    </BR>
    
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
    $nombre_cliente=$_POST["nombre_cliente"];
    $nombre_producto=$_POST["nombre_producto"];
    $cantidad=$_POST['cantidad'];
    $fecha=$_POST['fecha'];

    $seleccion_dni="SELECT NIF as DNI FROM CLIENTE WHERE NOMBRE='$nombre_cliente'";
    $idk=mysqli_query($db,$seleccion_dni);
    $fila=mysqli_fetch_assoc($idk);
    $id_cliente=$fila['DNI'];
    
    $seleccion_id_producto="SELECT ID_PRODUCTO as ID FROM PRODUCTO WHERE NOMBRE='$nombre_producto'";
    $idk2=mysqli_query($db,$seleccion_id_producto);
    $fila2=mysqli_fetch_assoc($idk2);
    $id_producto=$fila2['ID'];


    $seleccion_cantidad_producto="SELECT CANTIDAD as UNIDADES FROM ALMACENA WHERE ID_PRODUCTO='$id_producto'";
    $idk3=mysqli_query($db,$seleccion_cantidad_producto);
    $fila3=mysqli_fetch_assoc($idk3);
    $unidades_que_quedan=$fila3['UNIDADES'];

    



    $insertarcompras="INSERT INTO COMPRA(NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES) VALUES('$id_cliente','$id_producto','$fecha',$cantidad)";

    

    if($unidades_que_quedan<$cantidad){
        echo "la cantidad que vas a comprar es superior a la que tienes en el almacen, no puedes";
    }
    else{
        $cambiarunidades="UPDATE ALMACENA set CANTIDAD=CANTIDAD-$cantidad where ID_PRODUCTO='$id_producto'";
        
        mysqli_query($db,$cambiarunidades);
        mysqli_query($db,$insertarcompras);
        echo "todo correcto";
    }


}
?>

<?php
// Funciones utilizadas en el programa

function ver_num_almacen($db){
    $categoria=[];
    $sql = "SELECT NOMBRE FROM CLIENTE";
  
    $resultado=mysqli_query($db,$sql);
    
    if($resultado){
   
        while($fila=mysqli_fetch_assoc($resultado)){
        $categoria[]=$fila['NOMBRE'];
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