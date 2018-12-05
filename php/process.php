<?php 
session_start();
include "conection.php";
//id_cli_beh
$T=$_POST["total"];
$pago=$_POST["txtpago"];	
	
$cambio = $pago - $T;	

if ($pago >= $T)
{

if(!isset($_SESSION["cart"])){

print "<script language='JavaScript'>window.location='../login.php';</script>";
}
else
{
if(!empty($_POST)){
	
	

$q1 = $con->query("insert into facturas(fecha_beh,acredito_beh,id_clif_beh,monto_pagado,cambio) values(curdate(),0,3,$pago,$cambio)");
	
	//$q1 = $con->query("insert into facturas(fecha_beh,acredito_beh,id_clif_beh) values(curdate(),\"$_POST[acredito]\",\"$_SESSION[id_cli_beh]\")");

if($q1){
$cart_id = $con->insert_id;
foreach($_SESSION["cart"] as $c){

	$q1 = $con->query("insert into detalles(foliof_beh,id_prodf_beh,cantidad_beh) value((select max(folio_beh) as factura from facturas),$c[product_id],$c[q])");
	
	$q2 = $con->query("update productos set existencia_beh = existencia_beh - $c[q] where id_prod_beh = $c[product_id]");
	
	
}
//unset($_SESSION["cart"]);
}

//$T=$_POST["total"];
//$pago=$_POST["txtpago"];	
	
//$cambio = $pago - $T;	
$C=$_SESSION["nomb_cli_beh"].' '.$_SESSION["ap_cli_beh"];
print "<script language='JavaScript'> var cliente='$C';var total='$T'; var pago='$pago'; var cambio='$cambio'; alert('¡Felicidades! ' + cliente + ' su Compra se ha completado con exito con un total de $' + total + ' Se pago con $' + pago + ' Y su Cambio fue de $ ' + cambio  + ' .¡Gracias vuelva pronto!;)');window.location='../products.php';</script>";
}
}
}
else
{
print "<script language='JavaScript'> alert('¡Tu Pago No es Suficiente! Gracias vuelva pronto!;)');window.location='../products.php';</script>";	
	
}
?>