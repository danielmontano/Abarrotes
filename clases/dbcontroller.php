<?php
$currency = '&#8377; '; //Currency Character or code
$db_host = "alexlapaz.db.8921605.eea.hostedresource.net";
$db_username = "alexlapaz";
$db_password = "AleXPro@41";
$db_name = "alexlapaz";
$conn;

$taxes              = array( //List your Taxes percent here.
                            'IVA' => 16
                            );						
//connect to MySql						
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);						
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>