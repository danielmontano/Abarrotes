<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM productos WHERE id_prod_beh='" . $_GET["id_prod_beh"] . "'");
			$itemArray = array($productByCode[0]["id_prod_beh"]=>array('producto_beh'=>$productByCode[0]["producto_beh"], 'id_prod_beh'=>$productByCode[0]["id_prod_beh"], 'quantity'=>$_POST["quantity"], 'precio_beh'=>$productByCode[0]["precio_beh"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["id_prod_beh"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["id_prod_beh"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}

		header("Location:../index.php");
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["id_prod_beh"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
		header("Location:../index.php");
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;
	header("Location:../index.php");	
}
}

?>
