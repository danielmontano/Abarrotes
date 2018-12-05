<?php 
if(!isset($_SESSION["usuario_beh"]))
{
     header('location:http://oxtro.xyz');
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <script src="http://oxtro.xyz/js/jquery-3.2.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="http://oxtro.xyz/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.2.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="http://oxtro.xyz/css/estilobarra.css">
<link href="http://oxtro.xyz/css/estilo.css" rel="stylesheet">
<link href="http://oxtro.xyz/css/dropdown.css" rel="stylesheet">

<style>
 .containerc
    {
     margin: 10px 40px 20px 40px;
    }

    .foto{
    /* cambia estos dos valores para definir el tamaño de tu círculo */
    height: 300px;
    width: 290px;
    /* los siguientes valores son independientes del tamaño del círculo */
    background-repeat: no-repeat;
    
    background-size: 100% auto;
}
   .redondo {
    /* cambia estos dos valores para definir el tamaño de tu círculo */
    height: 37px;
    width: 37px;
    /* los siguientes valores son independientes del tamaño del círculo */
    background-repeat: no-repeat;
    background-position: 50%;
    border-radius: 50%;
    background-size: 100% auto;
}
 

</style>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<script type="text/javascript">

    function hacer_click(a)
    {
        $("#uno").load("../../../reportes/"+a);
        $('#dos').empty();
    }

    </script>

    </head>
<body>
<div id="flipkart-navbar">
    <div id="a" class="navbar container" >
        <div class="row row1">
         
	         <ul class="largenav" style="margin-left:-90px;">
           <ul id="b" class=" nav navbar-nav" >
           <li  id="b" class="dropdown" style="width:60px"><a id="b" class="dropdown-toggle" data-toggle="dropdown-toggle" data-toggle="dropdown" style="color:white" href='<?php echo site_url('examples/index')?>'>Inicio </a> </li>
           
    
           <li  id="b" class="dropdown pull-left" >
              <a  id="b" style="color:white" href="#" class="dropdown-toggle pull-left" data-toggle="dropdown">Reportes</a>
              <ul  id="b" class="dropdown-menu" >
                <li><a style="color:white" href="#" onclick="hacer_click('c1.php')">Producto más Vendido</a></li>
                <li class="divider"></li>
                <li><a style="color:white" href="#" onclick="hacer_click('c2.php')">Producto menos Vendido</a></li>
                <li class="divider"></li>
                <li><a style="color:white" href="#" onclick="hacer_click('c3.php')">Cliente que más ha comprado</a></li>
                <li class="divider"></li>
                <li><a style="color:white" href="#" onclick="hacer_click('c4.php')">Cliente que menos ha comprado</a></li>
                <li class="divider"></li>
                <li><a style="color:white" href="#" onclick="hacer_click('c5.php')">Mes de mejor venta</a></li>
                <li class="divider"></li>
                <li><a style="color:white" href="#" onclick="hacer_click('c6.php')">Clientes que no han comprado</a></li>
                <li class="divider"></li>
                <li><a style="color:white" href="#" onclick="window.location='../../../reportes/c7.php';">Total de ventas por fecha</a></li>
                <li class="divider"></li>
                <li><a style="color:white" href="#" onclick="window.location='../../../reportes/c8.php';">Clientes que han comprado producto Seleccionado</a></li>
                <li class="divider"></li>
                <li><a style="color:white" href="#" onclick="hacer_click('c9.php')">Clientes con más de una factura</a></li>
                <li class="divider"></li>
                <li><a style="color:white" href="#" onclick="window.location='../../../reportes/c10.php';">Clientes que No han comprado producto Seleccionado</a></li>
              </ul>
            </li>
            
             <li  id="c" class="dropdown text-center" >
              <a  id="c" style="color:white" href="#" class="dropdown-toggle text-center" data-toggle="dropdown">Información</a>
              <ul id="c" class="dropdown-menu" >
                <li id="c"><a id="c" style="color:white" href="http://oxtro.xyz/uml.pdf" target="_blank">UML</a></li>
                <li class="divider"></li>
                <li id="c"><a id="c" style="color:white" href="http://oxtro.xyz/MANUALTECNICO.pdf" target="_blank">Manual Técnico</a></li>
                <li class="divider"></li>
                <li id="c"><a id="c" style="color:white" href="http://oxtro.xyz/DOC1.pdf" target="_blank" >Base de Datos</a></li>

              </ul>
            </li>

         
    <li  id="c" class="dropdown" ><a id="c" class="dropdown-toggle" data-toggle="dropdown-toggle" data-toggle="dropdown" style="color:white" href='<?php echo site_url('examples/categorias_admin')?>'>Categorías</a> </li>
    <li  id="b" class="dropdown" ><a id="b" class="dropdown-toggle" data-toggle="dropdown-toggle" data-toggle="dropdown" style="color:white" href='<?php echo site_url('examples/ciudad_admin')?>'>Ciudades</a> </li>
		<li  id="b" class="dropdown" ><a id="b" class="dropdown-toggle" data-toggle="dropdown-toggle" data-toggle="dropdown" style="color:white" href='<?php echo site_url('examples/clientes_admin')?>'>Clientes</a> </li> 
		<li  id="b" class="dropdown" ><a id="b" class="dropdown-toggle" data-toggle="dropdown-toggle" data-toggle="dropdown" style="color:white" href='<?php echo site_url('examples/detalles_admin')?>'>Detalles</a> </li>
		<li  id="b" class="dropdown" ><a id="b" class="dropdown-toggle" data-toggle="dropdown-toggle" data-toggle="dropdown" style="color:white" href='<?php echo site_url('examples/facturas_admin')?>'>Facturas</a></li> 
		<li  id="b" class="dropdown" ><a id="b" class="dropdown-toggle" data-toggle="dropdown-toggle" data-toggle="dropdown" style="color:white" href='<?php echo site_url('examples/productos_admin')?>'>Productos</a> </li>
		<li  id="c" class="dropdown"  style="width: 105px"><a id="c" class="dropdown-toggle" data-toggle="dropdown-toggle" data-toggle="dropdown" style="color:white" href='<?php echo site_url('examples/promociones_admin')?>'>Promociones</a></li>
		<li  id="b" class="dropdown" ><a id="b" class="dropdown-toggle" data-toggle="dropdown-toggle" data-toggle="dropdown" style="color:white" href='<?php echo site_url('examples/usuarios_admin')?>'>Usuarios</a> </li>
     </ul>  
         </ul>
                 <?php 
            if(isset($_SESSION["id_usu_beh"]))
            {
            ?>
              <ul id="a" class=" nav navbar-nav pull-right" >
            
           <li class="dropdown" id="a" >
              <a   id="a" style="color:white" href="#" class="dropdown-toggle pull-right" data-toggle="dropdown"><?php echo $_SESSION["nomb_usu_beh"].'  '; ?><img class="redondo" src="http://oxtro.xyz/2017-3-oxtro/a/assets/uploads/files/Usuarios/<?php echo $_SESSION["foto_beh"]; ?>"></a>
              <ul  id="a" class="dropdown-menu" >
                <li id="a"><a  id="a" style="color:white" href="#">Usuario: <br><h4><?php echo $_SESSION["usuario_beh"]; ?></h4></a></li>
                <li class="divider"></li>
                <li id="a"><a  id="a" style="color:white" href="#">Ocupación: <br><h4><?php echo $_SESSION["ocupacion_beh"]; ?></h4></a></li>
                <li class="divider"></li>
                <li id="a"><a id="a" style="color:white" href='<?php echo site_url('../../../')?>'>Tienda<span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                <li class="divider"></li>
                <li id="a"><a id="a" style="color:white" href='<?php echo site_url('examples/logout')?>'>Cerrar Sesión<span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
              </ul>
            </li>
            </ul>
             <?php 
             }
            elseif(isset($_SESSION["id_cli_beh"]))
            {
            ?>
            <ul id="a" class=" nav navbar-nav pull-right" >
           <li class="dropdown" >
              <a  style="color:white" href="#" class="dropdown-toggle pull-right" data-toggle="dropdown"><?php echo $_SESSION["nomb_cli_beh"].'  '.$_SESSION["ap_cli_beh"].'  '.$_SESSION["am_cli_beh"]; ?><img class="redondo" src="http://oxtro.xyz/2017-3-oxtro/a/assets/uploads/files/Clientes/<?php echo $_SESSION["img_cli_beh"]; ?>"></a>
              <ul class="dropdown-menu" >
                <li><a style="color:white" href="#">Usuario: <br><h4><?php echo $_SESSION["usuario_beh"]; ?></h4></a></li>
                <li class="divider"></li>
                <li><a style="color:white" href="#">Email: <br><h4><?php echo $_SESSION["email_beh"]; ?></h4></a></li>
                <li class="divider"></li>
                <li><a style="color:white" href='<?php echo site_url('../../../')?>'>Tienda<span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                <li class="divider"></li>
                <li><a style="color:white" href='<?php echo site_url('examples/logout')?>'>Cerrar Sesión<span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
              </ul>
            </li>
            </ul>

               <?php 
            }
            ?>
                             
                      
	        </div>
	        </div>
	   </div>
    <div class="container" id="uno">
		<?php echo $output; ?>
    </div>
    
</body>
</html>
<?php
    }
?>
