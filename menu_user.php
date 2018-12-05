<?php
session_start();
include_once("./clases/dbcontroller.php");

//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Productos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="./css/estilo.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="./js/jquery-3.2.1.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/bootstrap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
  <style>
     .containerc {  
      margin: 10px 40px 10px 40px;
      margin-top:10px;
    }
  </style>
</head>
<body>

    <?php require_once("barra.php"); ?>;
<div class="containerc">   
<h1 align="center">Productos</h1>


<!-- View Cart Box Start -->
<?php
if (isset($_GET['comprar'])) {
  echo "<script> alert('Su compra se ha registrado con exito');</script>";
  }

if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
{
  echo '<div class="cart-view-table-front" id="view-cart" style="z-index:3;">';
  echo '<h3>Mi Carrito</h3>';
  echo '<form method="post" action="cart_update.php">';
  echo '<table width="100%"  cellpadding="6" cellspacing="0">';
  echo '<tbody>';

  $total =0;
  $b = 0;
  foreach ($_SESSION["cart_products"] as $cart_itm)
  {
    $product_name = $cart_itm["product_name"];
    $product_qty = $cart_itm["product_qty"];
    $product_price = $cart_itm["product_price"];
    $product_code = $cart_itm["product_code"];
    $product_color = $cart_itm["product_color"];
    $bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
    echo '<tr class="'.$bg_color.'">';
    echo '<td>Cant <input type="text" size="1" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
    echo '<td>'.$product_name.'</td>';
    echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Quitar</td>';
    echo '</tr>';
    $subtotal = ($product_price * $product_qty);
    $total = ($total + $subtotal);
  }
  echo '<td colspan="4">';
  echo '<button type="submit">Actualizar</button><a href="view_cart.php" class="button">Comprar</a>';
  echo '</td>';
  echo '</tbody>';
  echo '</table>';
  
  $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
  echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
  echo '</form>';
  echo '</div>';

}
?>
<!-- View Cart Box End -->

<!-- Products List Start -->
<?php
$results = $mysqli->query("SELECT * FROM productos ORDER BY id_prod_beh ASC");
if($results){ 
$products_item = '<div class="row text-center" style="margin=50px">';
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
  <div class="col-sm-2 text-center">
  <form method="post" action="cart_update.php">
  <div class="panel-primary text-center">
  <div class="panel-body text-center">              
  <img src="2017-3-oxtro/a/assets/uploads/files/productos/{$obj->img_prod_beh}" class="img-responsive" style=" align-self: center; height:150px ;width:170px">
  <h6>{$obj->producto_beh}</h6>
   $ {$obj->precio_beh} 
   </div>
   <div class="panel-footer text-center">              
   <span>Cantidad</span>
   <select name="product_qty">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                    </select>  
  <input type="hidden" name="product_code" value="{$obj->id_prod_beh}" />
  <input type="hidden" name="type" value="add" />
  <input type="hidden" name="return_url" value="{$current_url}" />
  <button type="submit" class="mc-btn-action" style="background-color: #ffe11b; text-shadow: 1px 1px #b29d11;">Añadir <img src="imagenes/carrito3.png" width="20px" class="img" allign="text-center"></button>
  </div>
  </div>
  </form>
  </div>
EOT;
}
$products_item .= '</div>';
echo $products_item;
}
?>    

 </div><br><br>

<footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4  col-md-2 col-sm-4 col-xs-6 ">
                    <h3> Nosotros </h3>
                    <ul>
                    <li><a href="#" onclick="$('.containerc').load('quienessomos.php');">¿Quiénes somos?</a></li>
                     <li ><a href="#" onclick="$('.containerc').load('historia.php');">Historia</a></li>
                     <li ><a href="#" onclick="$('.containerc').load('acercade.php');">Acerca de </a></li>
                        <h5><b> Desarrolladores:</b></h5>
                        <table><tr>
                       <td><img src="imagenes/botello.jpg" width="30px"> Jorge Botello<br>
                       </td></tr><tr><td><img src="imagenes/christian.jpg" width="30px"> Christian Espinoza<br>
                       </td></tr><tr><td><img src="imagenes/carlos.jpg" width="30px"> Carlos Hernández<br>
                    </td></tr></table>
                    </ul>
                </div>
                
                <div class="col-lg-4  col-md-2 col-sm-4 col-xs-6 ">
                    <h3> Lorem Ipsum </h3>
                    <ul>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                    </ul>
                </div>
               
                <div class="col-lg-4  col-md-3 col-sm-6 col-xs-12 text-left">
                    <h3> ¡Contáctanos!</h3>
                    <ul>
                        <h5> OFICINA OXTRO domicilio:</h5>
                        <h7> Solidaridad y Colosio 199 colonia las Quintas cp.83180</h7><br>
                        <h7> Telefono: 6621524075</h7><br>
                        <h7> Email:contacto@oxtro.xyz</h7><br> <br>
                        <h5> REDES SOCIALES: </h5>
                        <h7> FB: facebook.com/oxtrooficial </h7><br>
                        <h7> TW: twitter.com/@oxtrooficial </h7><br>
                        <h7> IG: instagram.com/oxtrooficial </h7><br>
                    </ul>
                    <ul class="social">
                        <li> <a href="https://www.facebook.com/christian.espinoza.353"> <i class=" fa fa-facebook"><img src="imagenes/facebook.png">  </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-twitter"> <img src="imagenes/twitter.png">  </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-instagram"><img src="imagenes/instagram.png">   </i> </a> </li>
                    </ul>
                </div>

            </div>
            <!--/.row--> 
        </div>
        <!--/.container--> 
    </div>
    <!--/.footer-->
    
    <div class="footer-bottom">
        <div class=" container">
            <p class="pull-left"> Copyright © Oxtro online 2017. All right reserved. </p>
        </div>
    </div>
    <!--/.footer-bottom--> 
</footer>

</body>
</html>
<STYLE>


</STYLE>