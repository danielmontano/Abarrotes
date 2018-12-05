<?php
session_start();
require_once ("./clsConexionBD.php");
// require_once ("./clsValidaciones.php");

class Usuarios {
    private $id_usu_beh;
    private $usuario_beh;
    private $clave_beh;
    private $foto_beh;
    private $alias_beh;
    private $ocupacion_beh;
    
    function leerFormulario(){
        $this->usuario_beh = $_POST["txtusuario"];
        $this->clave_beh = $_POST["txtpassw"];
        $this->foto_beh = $_POST["txtfoto"];
        $this->nomb_usu_beh = $_POST["txtnomb"];
        $this->ocupacion_beh = $_POST["txtocupacion"];
    }

    function ValidarUsuario(){
        $consulta = "Select * from usuarios where usuario_beh = ? and clave_beh = ?";
        try {
                $comando = ConexionBD::getInstance()->getDb()->prepare($consulta);
                $comando->execute(array($_POST["txtusuario"], $_POST["txtpassw"]));
                return $comando->fetchAll(PDO::FETCH_ASSOC);

         } catch (PDOException $e) {
            return false;
         }
        
    }

    function ValidarCliente(){
        $consulta = "Select * from clientes where usuario_beh = ? and clave_beh = ?";
        try {
                $comando = ConexionBD::getInstance()->getDb()->prepare($consulta);
                $comando->execute(array($_POST["txtusuario"], $_POST["txtpassw"]));
                return $comando->fetchAll(PDO::FETCH_ASSOC);

         } catch (PDOException $e) {
            return false;
         }
        
    }

    public function accion(){
        switch ($_GET["opc"]) {
            case '1':
                $resultado = $this->ValidarUsuario();
                $resultado2 = $this->ValidarCliente();
                if(count($resultado)>0){
                    $_SESSION["usuario_beh"] = $resultado[0]["usuario_beh"];
                    $_SESSION["id_usu_beh"] = $resultado[0]["id_usu_beh"];
                    $_SESSION["foto_beh"] = $resultado[0]["foto_beh"];
                    $_SESSION["nomb_usu_beh"] = $resultado[0]["nomb_usu_beh"];
                   $_SESSION["ocupacion_beh"] = $resultado[0]["ocupacion_beh"];
                   echo "1"; //Usuario Valido
                }
                else if(count($resultado2)>0){
                    $_SESSION["usuario_beh"] = $resultado2[0]["usuario_beh"];
                    $_SESSION["id_cli_beh"] = $resultado2[0]["id_cli_beh"];
                    $_SESSION["img_cli_beh"] = $resultado2[0]["img_cli_beh"];
                    $_SESSION["nomb_cli_beh"] = $resultado2[0]["nomb_cli_beh"];
                   $_SESSION["ap_cli_beh"] = $resultado2[0]["ap_cli_beh"];
                   $_SESSION["am_cli_beh"] = $resultado2[0]["am_cli_beh"];
                   $_SESSION["nivel_beh"] = $resultado2 [0]["nivel_beh"];
                   $_SESSION["email_beh"] = $resultado2[0]["email_beh"];
                   echo "2"; //Usuario Valido
                }
                else{
                    echo "0"; //Usuario NO Valido
                }
                break;
        }
    }
}

$objUsuario = new Usuarios();
$objUsuario->accion();
