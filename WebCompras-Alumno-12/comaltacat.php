<html>
<head>
    <meta charset="UTF-8">
    <title>Web compras</title>
   
</head>

<body>
<h1>ALTA CATEGORÍAS </h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	
	
    /* Se inicializa la lista valores*/
	echo '<form action="comaltacat.php" method="post">';
?>
<div class="container ">
<!--Aplicacion-->

<h2>Datos Categoría</h2>

	
       <p> ID CATEGORIA</p> <input type="text" name="id" placeholder="idcategoria">
     
        <p>NOMBRE CATEGORIA </p><input type="text" name="nombre" placeholder="nombre" >
   

		</BR>
<?php
	echo '<div><input type="submit" value="Alta Categoría"></div>
	</form>';
} else { 
    $id=$_POST["id"];
    $nombre=$_POST["nombre"];
	//  código al pulsar submit
    $crear_categoria="INSERT into CATEGORIA (ID_CATEGORIA,NOMBRE) values('$id','$nombre')";
    
    if(mysqli_query($db,$crear_categoria)){
        echo ('<script language="javascript">alert("Creado correctamente")</script>');
    }
    else{
        echo mysql_error();
    }
}
?>

<?php
// Funciones utilizadas en el programa

?>



</body>

</html>