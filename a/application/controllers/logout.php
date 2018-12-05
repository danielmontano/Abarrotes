<?php
session_start();
unset($_SESSION["usuario_beh"]);
unset($_SESSION["id_usu_beh"]);
header("Location:index.php");