<<!DOCTYPE html>
<html lang="en">
<html>
<head>
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
	.footer-bottom{
  position:fixed;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1rem;
  text-align: center;
}
#a .button {
    background-color: #2874f0; /* Green */
    border: none;
    color: white;
    width: 450px;
    height: 55px;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 15px;
}
.button {
    background-color: #2874f0; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
</style>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="http://loestasviendo.com/css/estilo.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="./js/jquery-3.2.1.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>

<body>
<div class="container" id="dos">
      <div class="panel panel-default ">
		
    <?php 
            if(isset($_SESSION["id_usu_beh"]))
            {
            ?>
            <div class="panel-heading text-center"><strong><h1>¡Bienvenido <?php echo ' '.$_SESSION["nomb_usu_beh"]; ?>!</h1></strong></div>
    <div class="panel-body text-center">
    <img  class="foto" src="http://loestasviendo.com/a/assets/uploads/files/Usuarios/<?php echo $_SESSION["foto_beh"]; ?>"><br><br>
        <table class="text-left" align="center"><tr><td>
        <strong>Nombre: </strong></td><td> 
        <?php echo ' '.$_SESSION["nomb_usu_beh"]; ?></td></tr><tr><td>
       <strong>Usuario: </strong></td><td> 
        <?php echo ' '.$_SESSION["usuario_beh"]; ?></td></tr><tr><td>
         <strong>Ocupación: </strong> </td><td>
        <?php echo ' '.$_SESSION["ocupacion_beh"]; ?></td></tr>
        </table>
    </div>
                 <?php 
             }
            elseif(isset($_SESSION["id_cli_beh"]))
            {
            ?>
    <div class="panel-heading text-center"><strong><h1>¡Bienvenido <?php echo ' '.$_SESSION["nomb_cli_beh"] ?>!</h1></strong></div>
		<div class="panel-body text-center">
		<img  class="foto" src="http://loestasviendo.com/a/assets/uploads/files/Clientes/<?php echo $_SESSION["img_cli_beh"]; ?>"><br><br>
	  		<table class="text-left" align="center"><tr><td>
        <strong>Nombre: </strong></td><td> 
	  		<?php echo ' '.$_SESSION["nomb_cli_beh"].' '.$_SESSION["ap_cli_beh"].' '.$_SESSION["am_cli_beh"]; ?></td></tr><tr><td>
		   <strong>Usuario: </strong></td><td> 
	  		<?php echo ' '.$_SESSION["usuario_beh"]; ?></td></tr><tr><td>
		     <strong>Nivel: </strong> </td><td>
	  		<?php echo ' '.$_SESSION["nivel_beh"]; ?></td></tr>
		    </table>
		</div>

 <?php 
            }
            ?>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading text-center"><strong><h2>CRUDS</h2></strong></div>
		<div class="panel-body text-center">
    <a class="button" href='<?php echo site_url('examples/categorias_admin')?>'>Categorias</a>
    <a class="button" href='<?php echo site_url('examples/ciudad_admin')?>'>Ciudad</a>
    <a class="button" href='<?php echo site_url('examples/clientes_admin')?>'>Clientes</a>
    <a class="button" href='<?php echo site_url('examples/detalles_admin')?>'>Detalles</a>
    <a class="button" href='<?php echo site_url('examples/facturas_admin')?>'>Facturas</a>
    <a class="button" href='<?php echo site_url('examples/productos_admin')?>'>Productos</a>
    <a class="button" href='<?php echo site_url('examples/promociones_admin')?>'>Promociones</a>
    <a class="button" href='<?php echo site_url('examples/usuarios_admin')?>'>Usuarios</a>
		</div>
	</div>

<!--
 <div class="panel panel-default">
    <div class="panel-heading text-center"><strong><h2>INFORMACIÓN</h2></strong></div>
    <div class="panel-body text-center">
               <a class="button" style="color:white" href="http://oxtro.xyz/DOC1.pdf">Base de Datos</a>
               <a class="button" style="color:white" href="http://oxtro.xyz/uml.pdf">Diagramas UML</a>
               <a class="button" style="color:white" href="http://oxtro.xyz/MANUALTECNICO.pdf">Manual Técnico</a></div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading text-center"><strong><h2>REPORTES</h2></strong></div>
    <div id="a" class="panel-body">
          <a class="button" style="color:white" href="#" onclick="$('.containerc').load('../../../reportes/c1.php');">Producto más Vendido</a><br><br>
          <a  class="button" style="color:white" href="#" onclick="$('.containerc').load('../../../reportes/c2.php');">Producto menos Vendido</a><br><br>
          <a  class="button" style="color:white" href="#" onclick="$('.containerc').load('../../../reportes/c3.php');">Cliente que más ha comprado</a><br><br>
          <a  class="button" style="color:white" href="#" onclick="$('.containerc').load('../../../reportes/c4.php');">Cliente que menos ha comprado</a><br><br>
          <a  class="button" style="color:white" href="#" onclick="$('.containerc').load('../../../reportes/c5.php');">Mes de mejor venta</a><br><br>
          <a  class="button" style="color:white" href="#" onclick="$('.containerc').load('../../../reportes/c6.php');">Clientes que no han comprado</a><br><br>
          <a  class="button" style="color:white" href="#" onclick="window.location='../../../reportes/c7.php';">Total de ventas por fecha</a><br><br>
          <a  class="button" style="color:white" href="#" onclick="window.location='../../../reportes/c8.php';">Clientes que han comprado producto Seleccionado</a><br><br>
          <a  class="button" style="color:white" href="#" onclick="$('.containerc').load('../../../reportes/c9.php');">Clientes con más de una factura</a><br><br>
          <a  class="button" style="color:white" href="#" onclick="window.location='../../../reportes/c10.php';">Clientes que No han comprado producto Seleccionado</a><br><br>
       </div>
      </div>
      -->

</div>
<br><br><br><br><br><br><br><br>
<footer>    
    <div class="footer-bottom">
        <div class=" container">
            <p class="text-center">  Administración tienda OXTRO Online<br>Copyright © Oxtro online 2018. All right reserved. </p>
        </div>
    </div>
    <br><br><br><br><br>
    <!--/.footer-bottom--> 
</footer>
</body>
</html>
