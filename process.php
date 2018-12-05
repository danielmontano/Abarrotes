<?php 
session_start();
include "conection.php";

if(!isset($_SESSION["id_cli_beh"])){

print "<script language='JavaScript'>window.location='../login.php';</script>";
}
else
{
if(!empty($_POST)){

 $q1 = $con->query("insert into facturas(fecha_beh,acredito_beh,id_clif_beh) values(curdate(),\"$_POST[acredito]\",\"$_SESSION[id_cli_beh]\")");

if($q1){
$cart_id = $con->insert_id;
foreach($_SESSION["cart"] as $c){
$q1 = $con->query("insert into detalles(foliof_beh,id_prodf_beh,cantidad_beh) value((select max(folio_beh) as factura from facturas),$c[product_id],$c[q])");
}
unset($_SESSION["cart"]);
}

$T=$_POST["total"];
$C=$_SESSION["nomb_cli_beh"].' '.$_SESSION["ap_cli_beh"];
print "<script language='JavaScript'> var cliente='$C';var total='$T'; alert('¡Felicidades! ' + cliente + ' su Compra se ha completado con exito con un total de $' + total + '.¡Gracias vuelva pronto!;)');window.location='../products.php';</script>";
}
}
?>