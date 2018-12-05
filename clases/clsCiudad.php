<?php
session_start();
if(file_exists("./clsConexionBD.php")){
    require_once ("./clsValidaciones.php");
    require_once ("./clsConexionBD.php");
}else{
     require_once ("./clases/clsValidaciones.php");
    require_once ("./clases/clsConexionBD.php");
}

class Ciudad{
    private $id_ciu_beh;
    private $nomb_ciu_beh;
    private $validaciones = [];

    function leerFormulario(){
        $this->nomb_ciu_beh = (isset($_POST["txtciudad"]) ? $_POST["txtciudad"] : "");
        
       
    }

    function Registrar(){
        try {
            $sql = "Insert into ciudad(nomb_ciu_beh) values (?)";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($this->nomb_ciu_beh));

            echo "1";
        } catch (PDOException $e) {
            echo "Error durante registro en la BD: " . $e->getMessage();
        }
    }

    function Actualizar(){
        try {
            $sql = "Update ciudad set nomb_ciu_beh=? where id_ciu_beh = ?";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($this->nomb_ciu_beh,$this->id_ciu_beh));

            echo "1";
        } catch (PDOException $e) {
            echo "Error durante registro en la BD: " . $e->getMessage();
        }
    }

    public static function Eliminar(){
        try {
            $sql = "Delete from ciudad where id_ciu_beh = ?";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($_GET["id_ciu_beh"]));

            echo "1";
        } catch (PDOException $e) {
            echo "Error durante registro en la BD: " . $e->getMessage();
        }
    }

    public static function ConsultarTodo(){
        $consulta = "Select * from ciudad";
        try {
                $comando = ConexionBD::getInstance()->getDb()->prepare($consulta);
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }
   public static function ConsultarPorCiudad($id_ciu_beh){
        $consulta = "Select * from ciudad where id_ciu_beh= " . $id_ciu_beh;
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
        if(!Validar::NoVacio($this->nomb_ciu_beh)){
            $this->Validaciones["txtciudad"] = "Capture nombre de la ciudad";
        }
        elseif (!Validar::longitudMax($this->nomb_ciu_beh, 30)) {
            $this->Validaciones["txtciudad"] = "Nombre demasiado largo [Max. 30 caract.]";
        }

        return count($this->Validaciones) == 0;
    }

      public function accion(){
        switch ($_GET["opc"]) {
            case '1':
                $this->leerFormulario();
                if($this->ValidaDatos()){
                  
                        $this->Registrar();    
                   
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
                    $this->id_ciu_beh = $_GET["id_ciu_beh"];
                    $this->leerFormulario();
                        $this->Actualizar();    
                    
                    break;
                    
                case '3':
                    $this->Eliminar();
                    break;
            }
        }
    }

$objCiudad = new Ciudad();
$objCiudad->accion();