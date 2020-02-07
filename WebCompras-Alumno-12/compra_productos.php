<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
  
    <title>Document</title>
   

</head>
<body>
    <h1 >COMPRA PRODUCTOS</h1>
	<?php
	/*Inserción en tabla*/
	require "conexion.php";
    session_start();
if (!isset($_POST) || empty($_POST)) { 
?>
    <div >
        <!--formulario-->
        <div >
         
            <p>Productos</p>
         
                    <form id="product-form" name="productos" action="compra_productos.php" method="POST">
                        <div>                           
                            <?php
                            $arraycategoria=vercategoria($db);
                            echo ("<select name='producto'><br>");
                            foreach ($arraycategoria as $categoria) {
                            echo("<option> $categoria </option>");
                            } 
                            echo("</select>");
                        ?>
                            </div>
                        
            <input type='number' name="unidades" placeholder='numero de unidades para comprar'>

                             
                         
             <input  type="submit" name="carro" value="Añadir al carro">
                        
                        
                        
                        
                    </form>
        </div>
        <br>
    </div>
    <a style='float:right;position:relative;bottom:220px' href='cerrar_sesion.php'><button  >Cerrar sesion</button></a>

	<?php
}
else {
    $producto=$_POST["producto"];
   
   
    $unidades=$_POST['unidades'];

    $insertar="SELECT NOMBRE as id from producto where id_producto='$producto'";

    $idk4=mysqli_query($db,$insertar);
    $fila4=mysqli_fetch_assoc($idk4);
    $id_producto=$fila4['id'];
    
//Añadimos al carrito
añadiralcarrito($id_producto,$unidades);
var_dump($_SESSION['producto']);
?>



<?php
echo("");
}

function vercategoria($db){
    $categoria=array();
    $sql = "SELECT ID_PRODUCTO FROM PRODUCTO";
    $resultado=mysqli_query($db,$sql);
    if($resultado){
        while($fila=mysqli_fetch_assoc($resultado)){

        $categoria[]=$fila['ID_PRODUCTO'];
            }
    }
    return $categoria;

}
function añadiralcarrito($producto,$unidades){

      $_SESSION['producto'][]=array(
        $_SESSION['usuario']=>array(
            'nombre'=>$producto,
            'unidades'=>$unidades,
        ),
    );
}
?>

</body>
</html>