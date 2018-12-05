<?php 
session_start();
if(file_exists("./clsConexionBD.php")){
    require_once ("./clsConexionBD.php");
}else{
    require_once ("./clsConexionBD.php");
}

if(!empty($_SESSION["cart_products"])){
    try {
            $sql = "insert into facturas values(null,now(),0,?);";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($_SESSION["id_cli_beh"]));
        } catch (PDOException $e) {
            echo "Error durante registro en la BD: " . $e->getMessage();
        }
        echo "<script> alert('lasldsalldsaldasl');</script>";
      
}
 ?>
