<?php
session_start();
if(file_exists("./clsConexionBD.php")){
    require_once ("./clsValidaciones.php");
    require_once ("./clsConexionBD.php");
}else{
     require_once ("./clases/clsValidaciones.php");
    require_once ("./clases/clsConexionBD.php");
}

class Clientes{
    private $id_cli_beh;
    private $nomb_cli_beh;
    private $ap_cli_beh;
    private $am_cli_beh;
    private $calle_cli_beh;
    private $numc_cli_beh;
    private $colonia_cli_beh;
    private $cp_cli_beh;
    private $limcredito_beh;
    private $id_ciuf_beh;
    private $img_cli_beh;
    private $imgdefault;
    private $validaciones = [];

    function leerFormulario(){
        $this->nomb_cli_beh = (isset($_POST["txtnombre"]) ? $_POST["txtnombre"] : "");
        $this->ap_cli_beh = $_POST["txtap"];
        $this->am_cli_beh = $_POST["txtam"];
        $this->calle_cli_beh = $_POST["txtcalle"];
        $this->numc_cli_beh = $_POST["txtnumc"];
        $this->colonia_cli_beh = $_POST["txtcolonia"];
        $this->cp_cli_beh = $_POST["txtcp"];
        $this->id_ciuf_beh = $_POST["cmbciudad"];
        $this->limcredito_beh = $_POST["txtlimcredito"];

        $this->usuario_beh = $_POST["txtusuarioc"];
        $this->clave_beh = $_POST["txtclavec"];
        $this->email_beh = $_POST["txtemail"];
        $this->nivel_beh = $_POST["cmbnivel"];
        $this->imgdefault = $_POST["txtimgdefault"];
       
    }

    function Registrar(){
        try {
            $sql = "Insert into clientes(nomb_cli_beh,ap_cli_beh,am_cli_beh,calle_cli_beh,numc_cli_beh,colonia_cli_beh,cp_cli_beh,id_ciuf_beh,limcredito_beh,img_cli_beh,usuario_beh,clave_beh,email_beh,nivel_beh) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($this->nomb_cli_beh, $this->ap_cli_beh, $this->am_cli_beh,$this->calle_cli_beh, $this->numc_cli_beh,$this->colonia_cli_beh,$this->cp_cli_beh,$this->id_ciuf_beh,$this->limcredito_beh,$this->img_cli_beh,$this->usuario_beh,$this->clave_beh,$this->email_beh,$this->nivel_beh));

            echo "1";
        } catch (PDOException $e) {
            echo "Error durante registro en la BD: " . $e->getMessage();
        }
    }

    function Actualizar(){
        try {
            $sql = "Update clientes set nomb_cli_beh=?,ap_cli_beh=?,am_cli_beh=?,calle_cli_beh=?,numc_cli_beh=?,colonia_cli_beh=?,cp_cli_beh=?,id_ciuf_beh=?,limcredito_beh=?,img_cli_beh=? where id_cli_beh = ?";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($this->nomb_cli_beh, $this->ap_cli_beh, $this->am_cli_beh,$this->calle_cli_beh, $this->numc_cli_beh,$this->colonia_cli_beh,$this->cp_cli_beh,$this->id_ciuf_beh,$this->limcredito_beh,$this->img_cli_beh, $this->id_cli_beh));

            echo "1";
        } catch (PDOException $e) {
            echo "Error durante registro en la BD: " . $e->getMessage();
        }
    }

    public static function Eliminar(){
        try {
            $sql = "Delete from clientes where id_cli_beh = ?";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($_GET["id_cli_beh"]));

            echo "1";
        } catch (PDOException $e) {
            echo "Error durante registro en la BD: " . $e->getMessage();
        }
    }

    public static function ConsultarTodo(){
        $consulta = "Select * from clientes";
        try {
                $comando = ConexionBD::getInstance()->getDb()->prepare($consulta);
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

 public static function ConsultarTodoN(){
        $consulta = "Select * from 
(select * from clientes)as t1 join (select id_ciu_beh,nomb_ciu_beh from ciudad)as t2 on t1.id_ciuf_beh = t2.id_ciu_beh
;";
        try {
                $comando = ConexionBD::getInstance()->getDb()->prepare($consulta);
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    public static function ConsultarPorCliente($id_cli_beh){
        $consulta = "Select * from clientes where id_cli_beh=" . $id_cli_beh;
        try {
                $comando = ConexionBD::getInstance()->getDb()->prepare($consulta);
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }
    function ValidaDatos(){
       //Nombre
        if(!Validar::NoVacio($this->nomb_cli_beh)){
            $this->Validaciones["txtnombre"] = "Capture nombre del cliente";
        }
        elseif (!Validar::longitudMax($this->nomb_cli_beh, 20)) {
            $this->Validaciones["txtnombre"] = "Nombre demasiado largo [Max. 20 caract.]";
        }
        //Descripcion
        if(!Validar::NoVacio($this->ap_cli_beh)){
            $this->Validaciones["txtap"] = "Capture apellido paterno del cliente";
        }
        elseif (!Validar::longitudMax($this->ap_cli_beh, 20)) {
            $this->Validaciones["txtap"] = "apellido demasiado largo [Max. 20 caract.]";
        }
       if(!Validar::NoVacio($this->am_cli_beh)){
            $this->Validaciones["txtam"] = "Capture apellido materno del cliente";
        }
        elseif (!Validar::longitudMax($this->am_cli_beh, 20)) {
            $this->Validaciones["txtam"] = "apellido demasiado largo [Max. 20 caract.]";
        }

        if(!Validar::NoVacio($this->calle_cli_beh)){
            $this->Validaciones["txtcalle"] = "Capture calle del domicilio del cliente";
        }
        elseif (!Validar::longitudMax($this->calle_cli_beh, 20)) {
            $this->Validaciones["txtcalle"] = "Nombre de la calle demasiado largo [Max. 20 caract.]";
        }

        if(!Validar::NoVacio($this->numc_cli_beh)){
            $this->Validaciones["txtnumc"] = "Capture numero de casa del cliente";
        }
        elseif (!Validar::longitudMax($this->numc_cli_beh, 5)) {
            $this->Validaciones["txtnumc"] = "escriba solo el numero de la casa del cliente [Max. 5 caract.]";
        }

        if(!Validar::NoVacio($this->colonia_cli_beh)){
            $this->Validaciones["txtcolonia"] = "Capture la colonia del domicilio del cliente";
        }
        elseif (!Validar::longitudMax($this->colonia_cli_beh, 20)) {
            $this->Validaciones["txtcolonia"] = "Nombre de la colonia demasiado largo [Max. 20 caract.]";
        }

        if(!Validar::NoVacio($this->cp_cli_beh)){
            $this->Validaciones["txtcp"] = "Capture el codigo postal del domicilio del cliente";
        }
        elseif (!Validar::longitudMax($this->cp_cli_beh, 6)) {
            $this->Validaciones["txtcp"] = "Escriba solo el codigo postal del cliente [Max. 6 caract.]";
        }

        return count($this->Validaciones) == 0;
    }
    
    
    function subirImagen(){
        $target_dir = "../imagenes/";
        //obtener la extension de la imagen  
        $posicion =  strrpos($_FILES["txtimagen"]["name"], '.', 1);
        $extension = substr($_FILES["txtimagen"]["name"], $posicion);
        $extension = strtolower($extension);
        //generar nuevo nombre para la imagen
        date_default_timezone_set('UTC');
        $date = new DateTime();
        $copiaImagen = "img" . date("Ymd") . date("His") . $_SESSION["id_usu_beh"] . $extension;  

        //Si no selecciono un archivo
        $estadoUpload = 0;
        if(empty($_FILES["txtimagen"]["name"])){
            $this->img_cli_beh = $this->imgdefault;
            return $estadoUpload;
        }

        //Esto se ejecuta si selecciono un archivo
        $check = getimagesize($_FILES["txtimagen"]["tmp_name"]);
        if($check == true) {
            // Check file size
            if ($_FILES["txtimagen"]["size"] <= 2048000) { //2 MB
                // Allow certain file formats
                if($extension == ".jpg" || $extension == ".png" || $extension == ".jpeg" || $extension == ".gif" ) {
                    if (move_uploaded_file($_FILES["txtimagen"]["tmp_name"], $target_dir . $copiaImagen)) {
                        $this->img_cli_beh = $copiaImagen;
                        $estadoUpload = 1;
                    } 
                    else {
                        $estadoUpload = -4;
                    }
                }
                else{
                    $estadoUpload = -3; //Formato de imagen NO valida
                }
            }
            else{
                $estadoUpload = -2; //Tamaño mayor a 2 MB
            }
        }
        else{
            $this->img_cli_beh = $this->imgdefault;
            $estadoUpload = -1; //No selecciono imagen
        }
        
        return $estadoUpload;
    }
      public function accion(){
        switch ($_GET["opc"]) {
            case '1':
                $this->leerFormulario();
                if($this->ValidaDatos()){
                  $estado = $this->subirImagen();
                    if($estado >= 0){
                        $this->Registrar();    
                    }else{
                        echo $estado;
                    }
                }
                else
                {

                     echo -5;
                     echo json_encode ([
                        'response' => count($this->Validaciones)===0,
                        'errors'   => $this->Validaciones
                        ]);
                }
                break;

                case '2':
                    $this->id_cli_beh = $_GET["id_cli_beh"];
                    $this->leerFormulario();
                    $estado = $this->subirImagen();
                    if($estado >= 0){
                        $this->Actualizar();    
                    }else{
                        echo $estado;
                    }
                    break;
                    
                case '3':
                    $this->Eliminar();
                    break;
            }
        }
    }

$objClientes = new Clientes();
$objClientes->accion();
