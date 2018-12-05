8<?php
/*
* Este archio muestra los productos en una tabla.
*/
session_start();
include "php/conection.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Carrito de Compras</title>
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../css/estilo.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="./js/jquery-3.2.1.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/bootstrap.js"></script>
<link href="./css/style.css" rel="stylesheet" type="text/css">
  <style>
     .containerc {  
      margin: 10px 40px 10px 40px;
      margin-top:10px;
    }
  </style>
</head>
<body>
<?php require_once("./barra.php"); ?>
<br>
<div class="containerc">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1>Mi Carrito de Compras</h1>
      <br>
      <a href="./products.php"  class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span> Productos</a>
<?php

$products = $con->query("select * from productos");
if(isset($_SESSION["cart"]) && !empty($_SESSION["cart"])):
?>
<div  style="margin: 20px 50px 20px 50px">
<table class="table table-bordered">
<thead>
  <th>Producto</th>
  <th>Cantidad</th>
  <th>Precio Unitario</th>
  <th>Totales</th>
  <th><a href="php/delfromcart.php?todos=true" class="btn btn-danger">Eliminar Todo</a></th>
</thead>
<?php 

$promo = $con->query("select id_prodf_beh,producto_beh,fechai_beh,fechaf_beh,descuento_beh,descripcion_beh,img_prod_beh from (select * from promociones) as t1 join (select id_prod_beh,producto_beh,img_prod_beh from productos)as t2 on t1.id_prodf_beh=t2.id_prod_beh where fechaf_beh >now()"); 

while($pr=$promo->fetch_object()) {

  if(empty($_SESSION["promo"])){
$_SESSION["promo"] = array( array("id_prodf_beh"=>$pr->id_prodf_beh,"descuento_beh"=> $pr->descuento_beh));
}else
{
  $promotion = $_SESSION["promo"];   
  array_push($promotion, array("id_prodf_beh"=>$pr->id_prodf_beh,"descuento_beh"=> $pr->descuento_beh));
  $_SESSION["promo"] = $promotion;
}

}
/*
* Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
*/
$Encontrado = true;
foreach($_SESSION["cart"] as $c){
  
$products = $con->query("select id_prod_beh,producto_beh,precio_beh from productos where id_prod_beh=$c[product_id]");
$r = $products->fetch_object();
   
foreach ($_SESSION["promo"] as $p) {
    if($p["id_prodf_beh"] == $r->id_prod_beh)
      {
         $Encontrado = true;
         break;
      }
      else{
        $Encontrado = false;
       }  
    }
  ?>
<tr>
  <td><?php echo $r->producto_beh;?></td>
  <td><?php echo $c["q"];?></td>
<?php
if($Encontrado == true){
  ?>
  <td>$ <?php echo number_format($newprice=$r->precio_beh-($r->precio_beh*$p["descuento_beh"])/100,2); ?></td>
  <?php
  }
  else{
  ?>
  <td>$ <?php echo number_format($newprice=$r->precio_beh,2); ?></td>
  <?php
  }
  $total+=$c["q"]*$newprice; ?>
  <td>$ <?php echo number_format($c["q"]*$newprice,2); ?></td>
  <td class="text-center" style="width:150px;">
  <?php
  $found = false;
  foreach ($_SESSION["cart"] as $c) { if($c["product_id"]==$r->id_prod_beh){ $found=true; break; }}
  ?>
    <a href="php/delfromcart.php?id=<?php echo $c["product_id"];?>" class="btn btn-danger">Eliminar</a>
  </td>
</tr>
<?php } ?>
<tr>
    <th colspan="3">Subtotal</th>
  <th colspan="2">$ <?php echo number_format($total,2)?></th>
</tr>
hf<tr>
    <th colspan="3">IVA</th>
  <th colspan="2">$ <?php echo number_format($iva = $total*0.16,2)?></th>
</tr>
<tr>
    <th colspan="3">TOTAL</th>
  <th colspan="2">$ <?php echo number_format($total = $total+$iva,2);?></th>
</tr>



<form class="form-horizontal" method="post" action="./php/process.php">
<tr><th colspan="5">Monto a Pagar:
<input type="number"  name="txtpago" id="txtpago" placeholder="Monto de Pago">
 <!--
  <input type="radio" name="acredito" value="0" checked="checked"> Contado<br>
  <input type="radio" name="acredito" value="1"> Crédito<br>
  -->
  <input type="hidden" name="total" value="<?php echo $total?>">
</th></tr>

</table>
      <button type="submit" class="btn btn-primary">Procesar Venta</button>
  </form>
</div>



<?php else:?>
  <p class="alert alert-warning">El carrito está vacío.</p>
<?php endif;?>
<br><br>

    </div>
  </div>
</div>
<?php require_once("./pie.php"); ?>

</body>
</html> 