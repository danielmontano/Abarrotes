<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Oxtro</title>
  <meta charset="utf-8">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="./css/estilo.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="./js/jquery-3.2.1.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/bootstrap.js"></script>
  <style>

    
     .containerc {  
      margin: 5%;
      margin-top:10px;
      
    }
    
    
  </style>
</head>
<body>

    <?php require_once("barra.php"); ?>;


<div class="containerc">    
 

 
<?php require_once("promo.php"); ?>;
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">leche yaqui</div>
        <div class="panel-body"><img src="imagenes/yaqui.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">de todos tamaños</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">aprovechaa!!</div>
        <div class="panel-body"><img src="imagenes/cors.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">cerveza corona,indio y mas</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">tecate roja</div>
        <div class="panel-body"><img src="imagenes/tecatee.png" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">para convivir con los compas</div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">tostitos</div>
        <div class="panel-body"><img src="imagenes/tosto.jpg" class="img-responsive" style="width:100% " alt="Image"></div>
        <div class="panel-footer">para el antojo</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">deliciosos rufles</div>
        <div class="panel-body"><img src="imagenes/rufles.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">tambien contamos con otros sabores</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">tecate light</div>
        <div class="panel-body"><img src="imagenes/teca.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">para compartir</div>
      </div>
    </div>
  </div>
  <?php require_once("servicios.php"); ?>;
</div>

 
 <br><br>

<footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4  col-md-2 col-sm-4 col-xs-6 ">
                    <h3> Nosotros </h3>
                    <ul>
                    <!--
                    <li><a href="#" onclick="$('.containerc').load('quienessomos.php');">¿Quiénes somos?</a></li>
                     <li ><a href="#" onclick="$('.containerc').load('historia.php');">Historia</a></li>
                     -->
                     <li ><a href="#" onclick="$('.containerc').load('acercade.php');">Acerca de </a></li>
                        <h5><b> Desarrolladores:</b></h5>
                        <table><tr>
                       <td><img src="imagenes/alejandro.jpg" width="30px"> David Alejandro Castruita Salazar<br>
                       <!--
                       </td></tr><tr><td><img src="imagenes/christian.jpg" width="30px"> Christian Espinoza<br>
                       </td></tr><tr><td><img src="imagenes/carlos.jpg" width="30px"> Carlos Hernández<br>
                       -->
                    </td></tr></table>
                    </ul>
                </div>
                
                <div class="col-lg-4  col-md-2 col-sm-4 col-xs-6 ">
                    <h3> Servicios </h3>
                    <ul>
                        <li> <a href="#"> Recargas Telcel </a> </li>
                        <li> <a href="#"> Recargas Movistar</a> </li>
                        <li> <a href="#"> Depósito bancario Bancomer</a> </li>
                        <li> <a href="#"> Depósito bancario Banamex</a> </li>
                    </ul>
                </div>
               
                <div class="col-lg-4  col-md-3 col-sm-6 col-xs-12 text-left">
                    <h3> ¡Contáctanos!</h3>
                    <ul>
                        <h5> OFICINA OXTRO domicilio:</h5>
                        <!--
                        <h7> Solidaridad y Colosio 199 colonia las Quintas cp.83180</h7><br>
                        <h7> Telefono: 6621524075</h7><br>
                        <h7> Email:contacto@oxtro.xyz</h7><br> <br>
                        <h5> REDES SOCIALES: </h5>
                        <h7> FB: facebook.com/oxtrooficial </h7><br>
                        <h7> TW: twitter.com/@oxtrooficial </h7><br>
                        <h7> IG: instagram.com/oxtrooficial </h7><br>
                        -->
                    </ul>
                    <ul class="social">
                       <!--
                        <li> <a href="https://www.facebook.com/Oxtro-636327386754784/" target="_blank"> <i class=" fa fa-facebook"><img src="imagenes/facebook.png">  </i> </a> </li>
                        <li> <a href="https://twitter.com/contactooxtro" target="_blank"> <i class="fa fa-twitter"> <img src="imagenes/twitter.png">  </i> </a> </li>
                        <li> <a href="https://www.instagram.com/contactooxtro/" target="_blank"> <i class="fa fa-instagram"><img src="imagenes/instagram.png">   </i> </a> </li>
                        -->
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
            <p class="pull-left"> Copyright © Oxtro online 2018. All right reserved. </p>
        </div>
    </div>
    <!--/.footer-bottom--> 
</footer>

</body>
</html>
