<?php
/*
* Este archio muestra los productos en una tabla.
*/
include "php/conection.php";

?>

<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../css/estilo.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/bootstrap.js"></script>
<style type="text/css">
  .containerc{
    padding: 20px 50px 20px 50px;
  }
</style>
  <title>Reportes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
</head>
</head>
<body>
<?php require_once("barra.php"); ?>;


<div class="containerc text-left">
     <button class="btn btn-primary" href="#" onclick="$('.containerc').load('c1.php');" >Producto mas vendido</button> 
     <button class="btn btn-primary" href="#" onclick="$('.containerc').load('c2.php');">Producto menos vendido</button>
     <button class="btn btn-primary" href="#" onclick="$('.containerc').load('c3.php');" >Cliente que mas ha comprado</button> 
     <button class="btn btn-primary" href="#" onclick="$('.containerc').load('c4.php');" >Cliente que menos ha comprado</button>
     <button class="btn btn-primary" href="#" onclick="$('.containerc').load('c5.php');" >Mejor mes de ventas</button>
    <button class="btn btn-primary" href="#" onclick="$('.containerc').load('c6.php');" >Clientes que no han comprado</button>
    <button class="btn btn-primary" href="#" onclick="$('.containerc').load('c7.php');" >Monto total de venta por fecha</button>
     <button class="btn btn-primary" href="#" onclick="$('.containerc').load('c8.php');" >Clientes que han comprado producto seleccionado</button>
     <button class="btn btn-primary" href="#" onclick="$('.containerc').load('c9.php');" >Clientes con mas de una factura</button>
     <button class="btn btn-primary" href="#"  onclick="$('.containerc').load('c10.php');" >Clientes que NO han comprado producto seleccionado</button> 
</div>
<?php require_once("pie.php"); ?>;
</body>
</html> 