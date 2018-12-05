<?php
/*
* Este archio muestra los productos en una tabla.
*/
session_start();
include "php/conection.php";

?>

<!DOCTYPE html>
<html>
<head>
<style type="text/css">
  
</style>
  <title>Productos</title>
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
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
</head>
<body>
<?php require_once("./barra.php"); ?>
<br>


<div class="containerc text-center">

<?php 
if($_POST["nombProd"] or $_GET["nombProd"]){
  ?>

 <form method="post" action="products.php">
      <select name="idcat">
      <option value = "0">Inventarios</option>
  <?php $categorias = $con->query("select * from categorias");
   while($cat=$categorias->fetch_object()) {?>
<option value = "<?php echo $cat->id_cat_beh; ?> "><?php echo $cat->nombre_cat_beh; ?></option>
<?php } ?>
</select>
  <button type="submit" claass="mc-btn-action" style="background-color: #ffe11b; text-shadow: 1px 1px #b29d11;">Buscar</button>
  </form><br>
  <div class="row text-center">
<?php
if ($_GET["nombProd"]) 
  $np="".$_GET["nombProd"]."";
else
  $np="".$_POST["nombProd"]."";
?>


<?php
 $promo = $con->query("select id_prodf_beh,producto_beh,fechai_beh,fechaf_beh,descuento_beh,descripcion_beh,img_prod_beh from (select * from promociones) as t1 join (select id_prod_beh,producto_beh,img_prod_beh from productos)as t2 on t1.id_prodf_beh=t2.id_prod_beh where fechaf_beh >now();");

$products = $con->query("select * from productos where producto_beh like'%$np%' ORDER BY CASE WHEN producto_beh = '$np' THEN 0  
              WHEN producto_beh LIKE '$np%' THEN 1  
              WHEN producto_beh LIKE '%$np%' THEN 2  
              WHEN producto_beh LIKE '%$np' THEN 3  
              ELSE 4
         END, producto_beh ASC;"); 

$hay = $con->query("select * from productos where producto_beh like'%$np%';"); 
/*
* Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
*/$promo->fetch_object();
if(is_null($erre=$hay->fetch_object()))
 echo "<h1>No se encontraron resultados para '".$np."'"."</h1>";
else
  echo "<h1>Resultados para '".$np."'"."</h1>";
while($r=$products->fetch_object()):?>
<div class="col-sm-3 text-center">
<div class="panel panel-primary text-center">
     <div class="panel-body text-center">
     <img src="../alexlapaz/a/assets/uploads/files/productos/<?php echo $r->img_prod_beh; ?>" class="img-responsive" style=" align-self: center; height:250px ;width:100%">
      </div>
      <div class="panel-footer text-center">
      <ul class="list-group">
        <li class="list-group-item" style="display:inline-block;height:65px;width: 100%; padding: 1px;"><h4><?php echo ucwords($r->producto_beh); ?></h4></li>
        </ul>
<?php
   $Encontrado = true;
   $m=false;
   foreach($promo as $pr) {
    if($pr["id_prodf_beh"]==$r->id_prod_beh)
      {
         $Encontrado = true;  
         $m=true;
      break;
      }
      else{
        $Encontrado = false;
       $m=true;
       }  
    }
    if($m == false)
      $Encontrado=false;
      if($Encontrado == true){
      ?>
      <h5 style="color:red;">antes:<strike>$ <?php echo number_format($r->precio_beh,2);?></strike></h5>
      <h4 style="color:blue;"><?php echo "Con el ".$pr["descuento_beh"]."% de Descuento!";?></h4>
      <h3 style="color:green;">Ahora: $ <?php echo number_format($newprice=$r->precio_beh-($r->precio_beh*$pr["descuento_beh"])/100,2); ?> </h3>
  <?php
     }
     else{
  ?>
      <h5>Precio: </h5>
      <h4>Unitario: </h4>
      <h3 style='color:blue;'>$ <?php echo number_format($newprice=$r->precio_beh,2);?></h3>
  <?php
     }
  ?>
  <form class="form-inline" method="post" action="./php/addtocart.php">
  <?php
  $found = false;

  if(isset($_SESSION["cart"])){ foreach ($_SESSION["cart"] as $c) { if($c["product_id"]==$r->id_prod_beh){ $found=true; break; }}}
  ?>
  <?php if($found):?>
    <a href="cart.php" class="btn btn-primary" style="font-size: 16px; height: 37px">Agregado ( <?php echo $c["q"]?> )</a>
      </form> 
  </div>
  </div>
  </div>
  <?php else:?>
  <input type="hidden" name="nombproducto" value="<?php echo $np; ?>">
  <input type="hidden" name="product_id" value="<?php echo $r->id_prod_beh; ?>">
  <input type="hidden" name="cat" value="<?php echo $r->id_catf_beh; ?>">
      <input type="number" name="q" value="1" style="width:100px;" min="1" class="form-control" placeholder="Cantidad">
    <button type="submit" class="mc-btn-action" style="background-color: #ffe11b; text-shadow: 2px 2px #b29d11;border: none; font-size: 18px; padding: 8px 20px;">Agregar <img src="../imagenes/carrito3.png" width="20px" class="img" allign="text-center"></button>
  </form> 
  </div>
  </div>
  </div>
  <?php endif; ?>
<?php endwhile; ?>
<br> <br> <br> <br>

    </div>
  </div>























<?php }
else{?>

 <form method="post" action="products.php">
      <select name="idcat">
      <option value = "0">Inventarios</option>
  <?php $categorias = $con->query("select * from categorias");
   while($cat=$categorias->fetch_object()) {?>
<option value = "<?php echo $cat->id_cat_beh; ?> "><?php echo $cat->nombre_cat_beh; ?></option>
<?php } ?>
</select>
  <button type="submit" claass="mc-btn-action" style="background-color: #ffe11b; text-shadow: 1px 1px #b29d11;">Buscar</button>
  </form><br>
  <div class="row text-center">
<?php
/*
* Esta es la consula para obtener todos los productos de la base de datos.
*/

if(!empty($_POST["idcat"])){
    $cate=$_POST["idcat"];
}else if(!empty($_GET["idcat"])){
    $cate=$_GET["idcat"];
}
else{
    $cate=0;
}
$nombcat = $con->query("select nombre_cat_beh from categorias where id_cat_beh=$cate");
$nc=$nombcat->fetch_object();

if(is_null($nc))
  $nc->nombre_cat_beh="Inventarios";
?>
<h1><?php echo ucwords($nc->nombre_cat_beh);?></h1>

<?php
 $promo = $con->query("select id_prodf_beh,producto_beh,fechai_beh,fechaf_beh,descuento_beh,descripcion_beh,img_prod_beh from (select * from promociones) as t1 join (select id_prod_beh,producto_beh,img_prod_beh from productos)as t2 on t1.id_prodf_beh=t2.id_prod_beh where fechaf_beh >now();");

if($nc->nombre_cat_beh=="Promociones")
$products = $con->query("select id_prodf_beh,id_prodf_beh as id_prod_beh,producto_beh,precio_beh,fechai_beh,fechaf_beh,descuento_beh,descripcion_beh,img_prod_beh from (select * from promociones) as t1 join (select id_prod_beh,producto_beh,img_prod_beh,precio_beh from productos)as t2 on t1.id_prodf_beh=t2.id_prod_beh where fechaf_beh >now();");

else
$products = $con->query("select * from productos where id_catf_beh= $cate"); 
/*
* Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
*/$promo->fetch_object();
while($r=$products->fetch_object()):?>
<div class="col-sm-3 text-center">
<div class="panel panel-primary text-center">
     <div class="panel-body text-center">
     <img src="../alexlapaz/a/assets/uploads/files/productos/<?php echo $r->img_prod_beh; ?>" class="img-responsive" style=" align-self: center; height:250px ;width:100%">
      </div>
      <div class="panel-footer text-center">
      <ul class="list-group">
        <li class="list-group-item" style="display:inline-block;height:65px;width: 250px; padding: 1px;"><h4><?php echo ucwords($r->producto_beh); ?></h4></li>
        </ul>
<?php
   $Encontrado = true;
   $m=false;
   foreach($promo as $pr) {
   //echo " ".$pr["id_prodf_beh"]."- ".$r->id_prod_beh; 
    if($pr["id_prodf_beh"]==$r->id_prod_beh)
      {
         $Encontrado = true;  
         $m=true;
      break;
      }
      else{
        $Encontrado = false;
       $m=true;
       }  
    }
    if($m == false)
      $Encontrado=false;
      if($Encontrado == true){
      ?>
      <h5 style="color:red;">antes:<strike>$ <?php echo number_format($r->precio_beh,2);?></strike></h5>
      <h4 style="color:blue;"><?php echo "Con el ".$pr["descuento_beh"]."% de Descuento!";?></h4>
      <h3 style="color:green;">Ahora: $ <?php echo number_format($newprice=$r->precio_beh-($r->precio_beh*$pr["descuento_beh"])/100,2); ?> </h3>
  <?php
     }
     else{
  ?>
      <h5>Precio: </h5>
      <h4>Unitario: </h4>
      <h3 style='color:blue;'>$ <?php echo number_format($newprice=$r->precio_beh,2);?></h3>
  <?php
     }
  ?>
  <form class="form-inline" method="post" action="./php/addtocart.php">
  <?php
  $found = false;

  if(isset($_SESSION["cart"])){ foreach ($_SESSION["cart"] as $c) { if($c["product_id"]==$r->id_prod_beh){ $found=true; break; }}}
  ?>
  <?php if($found):?>
    <a href="cart.php" class="btn btn-primary" style="font-size: 16px;height: 37px">Agregado ( <?php echo $c["q"]?> )</a>
      </form> 
  </div>
  </div>
  </div>
  <?php else:?>
  <input type="hidden" name="idcate" value="<?php echo $cate; ?>">
  <input type="hidden" name="product_id" value="<?php echo $r->id_prod_beh; ?>">
  <input type="hidden" name="cat" value="<?php echo $r->id_catf_beh; ?>">
      <input type="number" name="q" value="1" style="width:100px;" min="1" class="form-control" placeholder="Cantidad">
    <button type="submit" class="mc-btn-action" style="background-color: #ffe11b; text-shadow: 2px 2px #b29d11;border: none; font-size: 18px; padding: 8px 20px;">Agregar <img src="../imagenes/carrito3.png" width="20px" class="img" allign="text-center"></button>
  </form> 
  </div>
  </div>
  </div>
  <?php endif; ?>
<?php endwhile; ?>
<br> <br> <br> <br>

    </div>
  </div>
  <?php }
  ?>
</div>
</body>
<?php require_once("./pie.php"); ?>
</body>
</html> 