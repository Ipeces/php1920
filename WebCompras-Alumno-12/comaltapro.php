<html>
<head>
    <meta charset="UTF-8">

    <title>Web compras</title>
 
</head>

<body>
<h1>ALTA PRODUCTOS </h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	
	
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<h2 >Datos Producto</h2>
<div >
		
        <p>ID PRODUCTO </p><input type="text" name="id" placeholder="idproducto" >
        
        <p>NOMBRE PRODUCTO </p><input type="text" name="nombre" placeholder="nombre" >
        
      <p>  PRECIO PRODUCTO </p><input type="text" name="precio" placeholder="precio" >
   </div>    
	<div>
	<label for="categoria">Categorías:</label>
    <?php
$arraycategoria=vercategoria($db);
     echo ("<select name='categoria'><br>");
       foreach ($arraycategoria as $categoria) {
           echo("<option> $categoria </option>");
       } 
  echo("</select>");
        ?>
	</div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 

	// Aquí va el código al pulsar submit
    $id_producto=$_POST["id"];
    $nombre=$_POST["nombre"];
    $precio=$_POST["precio"];
    $nombre_categoria=$_POST["categoria"];
    
    $buscar_codigo="SELECT ID_CATEGORIA from CATEGORIA where nombre='$nombre_categoria'";
   
    $idk=mysqli_query($db,$buscar_codigo);
    $fila=mysqli_fetch_assoc($idk);
    $codigo_departamento=$fila['ID_CATEGORIA'];
var_dump($buscar_codigo);
    
    $insertar="INSERT INTO PRODUCTO (ID_PRODUCTO,NOMBRE,PRECIO,ID_CATEGORIA) values('$id_producto','$nombre','$precio','$codigo_departamento')";
    
    if(mysqli_query($db,$insertar)){
 echo ('<script language="javascript">alert("Creado correctamente")</script>');
    }
    else{
         echo ('<script language="javascript">alert("error")</script>');
    }
}
?>

<?php
// Funciones utilizadas en el programa

function vercategoria($db){
    $categoria=array();
    $sql = "SELECT NOMBRE FROM CATEGORIA";
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