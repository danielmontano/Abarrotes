<?php
session_start();
if(file_exists("./clsConexionBD.php")){
    require_once ("./clsValidaciones.php");
    require_once ("./clsConexionBD.php");
}else{
     require_once ("./clases/clsValidaciones.php");
    require_once ("./clases/clsConexionBD.php");
}

class Productos{
    private $id_prod_beh;
    private $imgdefault;
    private $producto_beh;
    private $precio_beh;
    private $existencia_beh;
    private $reorden_beh;
    private $img_prod_beh;
    private $validaciones = [];

    function leerFormulario(){
        $this->producto_beh = $_POST["txtproducto"];
        $this->precio_beh = $_POST["txtprecio"];
        $this->existencia_beh = $_POST["txtexistencia"];
        $this->reorden_beh = $_POST["txtreorden"];
        $this->imgdefault = $_POST["txtimgdefault"];
    }

    function Registrar(){
        try {
            $sql = "Insert into productos(producto_beh,precio_beh,existencia_beh,reorden_beh,img_prod_beh) values (?,?,?,?,?)";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($this->producto_beh, $this->precio_beh, $this->existencia_beh,$this->reorden_beh, $this->img_prod_beh));

            echo "1";
        } catch (PDOException $e) {
            echo "Error durante registro en la BD: " . $e->getMessage();
        }
    }

    function Actualizar(){
        try {
            $sql = "Update productos set producto_beh=?,precio_beh=?,existencia_beh=?,reorden_beh=?,img_prod_beh=? where id_prod_beh = ?";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($this->producto_beh, $this->precio_beh, $this->existencia_beh,$this->reorden_beh, $this->img_prod_beh, $this->id_prod_beh));

            echo "1";
        } catch (PDOException $e) {
            echo "Error durante registro en la BD: " . $e->getMessage();
        }
    }

    public static function Eliminar(){
        try {
            $sql = "Delete from productos where id_prod_beh = ?";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($_GET["id_prod_beh"]));

            echo "1";
        } catch (PDOException $e) {
            echo "Error durante registro en la BD: " . $e->getMessage();
        }
    }

    public static function ConsultarTodo(){
        $consulta = "Select * from productos";
        try {
                $comando = ConexionBD::getInstance()->getDb()->prepare($consulta);
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }
        public static function ConsultarPorProducto($id_prod_beh){
        $consulta = "Select * from productos where id_prod_beh= " . $id_prod_beh;
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
        if(!Validar::NoVacio($this->producto_beh)){
            $this->Validaciones["txtproducto"] = "Capture nombre del producto";
        }
        elseif (!Validar::longitudMax($this->producto_beh, 30)) {
            $this->Validaciones["txtproducto"] = "Nombre demasiado largo [Max. 30 caract.]";
        }
        //Descripcion
        if(!Validar::NoVacio($this->precio_beh)){
            $this->Validaciones["txtprecio"] = "Agregue precio";
        }
        if (!Validar::NoVacio($this->existencia_beh)) {
            $this->Validaciones["txtexistencia"] = "Agregue existencia";
        }

        if (!Validar::NoVacio($this->reorden_beh)) {
            $this->Validaciones["txtreorden"] = "Agregue reorden";
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
            $this->img_prod_beh = $this->imgdefault;
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
                        $this->img_prod_beh = $copiaImagen;
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
            $this->img_prod_beh = $this->imgdefault;
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
                    $this->id_prod_beh = $_GET["id_prod_beh"];
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

$objProductos = new Productos();
$objProductos->accion();
