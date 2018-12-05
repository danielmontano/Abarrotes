<?php
//session_start();
include "./php/conection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    .carousel {

    margin-bottom: 0;
  padding: 0 40px 30px 40px;
}
/* Reposition the controls slightly */
.carousel-control {
  left: -12px;
}
.carousel-control.right {
  right: -12px;
}
/* Changes the position of the indicators */
.carousel-indicators {
  right: 50%;
  top: auto;
  bottom: 0px;
  margin-right: -19px;
}
/* Changes the colour of the indicators */
.carousel-indicators li {
  background: #c0c0c0;
}
.carousel-indicators .active {
background: #333333;
}
  </style>
</head>
<body>
<br><br>
<div class="container text-left" style="margin-left: -5px;">
<?php  
$promociones = $con->query("select id_prodf_beh,producto_beh,fechai_beh,fechaf_beh,descuento_beh,descripcion_beh,img_prod_beh from (select * from promociones) as t1 join (select id_prod_beh,producto_beh,img_prod_beh from productos)as t2 on t1.id_prodf_beh=t2.id_prod_beh where fechaf_beh >now();");
$numslides = mysqli_num_rows($promociones);
?>

  <div class="container text-center">
  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width:100%; align-self: center; padding-left: 50px; height:640px">
    <!-- Indicators -->
    
    <ol class="carousel-indicators">
       <?php for ($i=0; $i <=  $numslides; $i++) { ?>
      <li data-target="#myCarousel" data-slide-to="<?php $i ?>"></li>
      <?php } ?>
    </ol>
   <img src="imagenes/promocionesHeader.png" alt="PROMO" style="width: 75% ;height: 160px;z-index: 3;margin-top: -60px">
   <div class="carousel-inner" >
    <!-- Wrapper for slides -->

    <div class="item active" >
        <table  style="width: 100%"><tr><td>
        <img src="imagenes/promo.jpg" alt="imagen" style="width:70%; height: 540px;z-index: -1">
        </td></tr></table>
        <div class="carousel-caption" style="background:rgba(0,0,15,0.6); padding: 1px;">
          <h2>¡Conozca nuestras increibles promociones!</h2>
          <p><h5>promociones oxtro</h5></p>
          <a href="./products.php"><h5>Ver Promociones</h5></a>
        </div>
      </div>

   <?php
   while($p=$promociones->fetch_object()) {  ?> 
      <div class="item">
        
        <table  style="width: 100%"><tr><td>
        <img src="alexlapaz/a/assets/uploads/files/Productos/<?php echo $p->img_prod_beh; ?>" alt="imagen" style="width:70%; height: 540px;z-index: -1"></td></tr></table>
        <div class="carousel-caption text-right" style="background:rgba(0,0,15,0.4);border-spacing: -100px ">
        <table style="width:100%">
        <thead>
        </thead>
        <th colspan="10">
          <h2 style="background:rgba(1,2,80,0.4); color:white; text-align: center;margin-top: -18px"><?php echo $p->producto_beh; ?></h2></th>
        <tbody>
        <tr><td colspan="8">
          <p><h3 style="color:#24E711;margin-top: -15px">Descuento: -<?php echo $p->descuento_beh; ?>%</h3><h5 ><?php echo $p->descripcion_beh; ?> <br></h5><h6 style="text-align: right">Fecha válida del <?php echo $p->fechai_beh; ?> Al <?php echo $p->fechaf_beh; ?></h6></p>
          <a href="./products.php"><h5 style="text-align: right;">Ver Promociones</h5></a> 
         </td><td>
         <img src="imagenes/OFERTA.png" style="width:100px;height:100px ;margin-top: -1px; ">
       </td></tr></tbody></table>
        </div>

       </div>


       <?php } ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
 </div>


</div>

</body>
</html>