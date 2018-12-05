<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}
	public function _regcli_output($output = null)
	{
		$this->load->view('registroclientes.php',(array)$output);
	}
    public function productoss()
	{
			$crud = new grocery_CRUD();
			$crud->set_model('custom_query_model');
			$crud->set_table('clientes'); //Change to your table name
			$crud->basic_model->set_query_str('SELECT id_cli_beh,nivel_beh FROM clientes'); //Query text here
			$output = $crud->render();

			$this->_example_output($output);
	}

     public function _callback_nivel_default($value, $row)
    {
        return  "<input id='field-nivel_beh' type='hidden' name='nivel_beh' value='2' />";
    }
     public function _callback_limcredito_default($value, $row)
    {
        return  "<input id='field-limcredito_beh' type='hidden' name='limcredito_beh' value='0' />";
    }
	public function registro_clientes()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('bootstrap');
			$crud->set_table('clientes');
			$crud->set_subject('Cliente');
			$crud->set_relation('id_ciuf_beh','ciudad','nomb_ciu_beh');
		    $crud->display_as('nomb_cli_beh','Nombres');
		    $crud->display_as('ap_cli_beh','Apellido Paterno');
			$crud->display_as('am_cli_beh','Apellido Materno');
			$crud->display_as('calle_cli_beh','Calle');
			$crud->display_as('numc_cli_beh','Numero');
			$crud->display_as('colonia_cli_beh','Colonia');
			$crud->display_as('cp_cli_beh','CP');
			$crud->display_as('id_ciuf_beh','Ciudad');
			$crud->display_as('usuario_beh','Usuario');
			$crud->display_as('img_cli_beh','Imagen');
			$crud->display_as('clave_beh','Contraseña');
			$crud->display_as('email_beh','Email');
			$crud->required_fields('nomb_cli_beh','ap_cli_beh','am_cli_beh','calle_cli_beh','numc_cli_beh','colonia_cli_beh','cp_cli_beh','id_ciuf_beh','img_cli_beh','usuario_beh','clave_beh','email_beh');
            $crud->set_field_upload('img_cli_beh','assets/uploads/files/Clientes');

             $crud->field_type('clave_beh', 'password');
			$crud->unset_back_to_list();
			$crud->unset_list();


			$crud->field_type('nivel_beh', 'hidden');
			$crud->field_type('limcredito_beh', 'hidden');

			$crud->callback_field('nivel_beh', array($this, '_callback_nivel_default'));
			$crud->callback_field('limcredito_beh', array($this, '_callback_limcredito_default'));

			if ($this->input->post('nomb_cli_beh')!=null)
			$crud->set_rules( 'nomb_cli_beh', 'Nombre', 'regex_match[/^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ ,.]*$/u]' );
			
			
			if ($this->input->post('ap_cli_beh')!=null)
			$crud->set_rules( 'ap_cli_beh', 'Apellido Paterno', 'regex_match[/^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ ,.]*$/u]' );
			
			
			if ($this->input->post('am_cli_beh')!=null)
			$crud->set_rules( 'am_cli_beh', 'Apellido Materno', 'regex_match[/^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ ,.]*$/u]' );
			
			if ($this->input->post('cp_cli_beh')!=null) 
			$crud->set_rules('cp_cli_beh','Código Postal','numeric');
            
			$crud->set_lang_string("insert_success_message","<script type='text/javascript'> alert('Se ha registrado exitosamente.');window.location='http://loestasviendo.com';</script>");
			$output = $crud->render();

			$this->_regcli_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

public function productos_admin()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('bootstrap');
			$crud->set_table('productos');
			$crud->set_subject('Productos');
			$crud->set_relation('id_catf_beh','categorias','nombre_cat_beh');
			$crud->display_as('id_prod_beh','Id');
			$crud->display_as('producto_beh','Producto');
			$crud->display_as('precio_beh','Precio');
			$crud->display_as('existencia_beh','Existencia');
			$crud->display_as('reorden_beh','Reorden');
			$crud->display_as('img_prod_beh','Imagen');
			$crud->display_as('id_catf_beh','Categoría');
			$crud->required_fields('producto_beh','precio_beh','existencia_beh','reorden_beh','img_prod_beh','id_catf_beh');
			$crud->columns('id_prod_beh','producto_beh','precio_beh','img_prod_beh','existencia_beh','reorden_beh','id_catf_beh');
            $crud->set_field_upload('img_prod_beh','assets/uploads/files/Productos');
            $crud->callback_before_delete(array($this,'delete_thumb_prod'));
            $crud->unique_fields(array('producto_beh'));

        if( $this->input->post('precio_beh') != null ) 
            $crud->set_rules( 'precio_beh','Precio','numeric');

        if( $this->input->post( 'existencia_beh' ) != null )
            $crud->set_rules('existencia_beh','Existencia','numeric');

         if( $this->input->post( 'reorden_beh' ) != null )
            $crud->set_rules('reorden_beh','Reorden','numeric');


			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		$this->load->view('example2.php');
		
	}

	public function logout()
	{
     session_start();
     session_destroy();
     header("Location:http://loestasviendo.com");
	}

	public function categorias_admin()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('bootstrap');
			$crud->set_table('categorias');
			$crud->set_subject('Categoria');
			$crud->display_as('id_cat_beh','Id');
			$crud->display_as('nombre_cat_beh','Categoría');	
			$crud->display_as('foto_cat_beh','Imagen');			
			$crud->required_fields('nombre_cat_beh','foto_cat_beh');
			$crud->columns('id_cat_beh','nombre_cat_beh','foto_cat_beh');  
            $crud->set_field_upload('foto_cat_beh','assets/uploads/files/Categorias');
			$crud->callback_before_delete(array($this,'delete_thumb_cat'));
		     if( $this->input->post( 'nombre_cat_beh' ) != null ) {
  	        $crud->set_rules( 'nombre_cat_beh', 'Categoria', 'regex_match[/^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ ,.]*$/u]' );
  	         }
			 $crud->unique_fields(array('nombre_cat_beh'));
		   $output = $crud->render();

		

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function  ciudad_admin()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('bootstrap');
			$crud->set_table('ciudad');
			$crud->display_as('nomb_ciu_beh','Ciudad');
            $crud->display_as('id_ciu_beh','Id');
			$crud->set_subject('Ciudad');
			$crud->required_fields('nomb_ciu_beh');
            $crud->columns('id_ciu_beh','nomb_ciu_beh');
			$crud->unique_fields(array('nomb_ciu_beh'));
			if( $this->input->post( 'nomb_ciu_beh' ) != null ) {
			$crud->set_rules( 'nomb_ciu_beh', 'Ciudad', 'regex_match[/^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ ,.]*$/u]' );
			}
			$output = $crud->render();


			$this->_example_output($output);
	}

    public function clientes_admin()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('bootstrap');
			$crud->set_table('clientes');
			$crud->set_subject('Cliente');
			$crud->set_relation('id_ciuf_beh','ciudad','nomb_ciu_beh');
			$crud->display_as('nomb_cli_beh','Nombre');
			$crud->display_as('ap_cli_beh','Apellido Paterno');
			$crud->display_as('am_cli_beh','Apellido Materno');
			$crud->display_as('calle_cli_beh','Calle');
			$crud->display_as('numc_cli_beh','Numero');
			$crud->display_as('colonia_cli_beh','Colonia');
			$crud->display_as('cp_cli_beh','CP');
			$crud->display_as('id_ciuf_beh','Ciudad');
			$crud->display_as('usuario_beh','Usuario');
			$crud->display_as('limcredito_beh','Límite Credito');
			$crud->display_as('img_cli_beh','Imagen');
			$crud->display_as('clave_beh','Contraseña');
			$crud->display_as('nivel_beh','Nivel');
			$crud->display_as('email_beh','Email');
			$crud->required_fields('nomb_cli_beh','ap_cli_beh','am_cli_beh','calle_cli_beh','numc_cli_beh','colonia_cli_beh','cp_cli_beh','id_ciuf_beh','img_cli_beh','limcredito_beh','usuario_beh','clave_beh','email_beh','nivel_beh');
			$crud->columns('nomb_cli_beh','ap_cli_beh','am_cli_beh','calle_cli_beh','numc_cli_beh','id_ciuf_beh','img_cli_beh','limcredito_beh','usuario_beh');
            $crud->set_field_upload('img_cli_beh','assets/uploads/files/Clientes');
            $crud->callback_before_delete(array($this,'delete_thumb_cli'));
            //$crud->unique_fields(array('nomb_cli_beh','ap_cli_beh','am_cli_beh','calle_cli_beh','colonia_cli_beh','numc_cli_beh'));
            if( $this->input->post( 'nomb_cli_beh' ) != null ) {
             $crud->set_rules( 'nomb_cli_beh', 'Nombres', 'regex_match[/^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ ,.]*$/u]' );}
             if( $this->input->post( 'ap_cli_beh' ) != null ) {
             $crud->set_rules( 'ap_cli_beh', 'Apellido Paterno', 'regex_match[/^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ ,.]*$/u]' );}
             if( $this->input->post( 'am_cli_beh' ) != null ) {
             $crud->set_rules( 'am_cli_beh', 'Apellido Materno', 'regex_match[/^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ ,.]*$/u]' );}
             if( $this->input->post( 'numc_cli_beh' ) != null ) {
             $crud->set_rules('numc_cli_beh','Número de Casa','numeric');}
             if( $this->input->post( 'cp_cli_beh' ) != null ) {
             $crud->set_rules('cp_cli_beh','Código Postal','numeric');}
             if( $this->input->post( 'limcredito_beh' ) != null ) {
             $crud->set_rules('limcredito_beh','Límite de Crédito','numeric');}
             if( $this->input->post( 'nivel_beh' ) != null ) {
             $crud->set_rules('nivel_beh','Nivel','numeric');}


			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function detalles_admin()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('detalles');
			$crud->set_subject('Detalles');
			$crud->set_relation('foliof_beh','facturas','folio_beh');
			$crud->set_relation('id_prodf_beh','productos','producto_beh');
			$crud->display_as('det','Detalle');
			$crud->display_as('id_prodf_beh','Producto');
			$crud->display_as('cantidad_beh','Cantidad');
			$crud->required_fields('foliof_beh','id_prodf_beh','cantidad_beh');
			$crud->columns('det','foliof_beh','id_prodf_beh','cantidad_beh');
			$crud->display_as('foliof_beh','Folio');
			if( $this->input->post('cantidad_beh' ) != null ) {
             $crud->set_rules('cantidad_beh','Cantidad','numeric');}
			

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function facturas_admin()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('facturas');
			$crud->set_subject('Factura');
			$crud->set_relation('id_clif_beh','clientes','{nomb_cli_beh} {ap_cli_beh} {am_cli_beh}');
			$crud->display_as('folio_beh','Folio');
			$crud->display_as('fecha_beh','Fecha');
			$crud->field_type('acredito_beh', 'true_false', array('1' => 'Credito', '0' => 'Contado'));
			$crud->required_fields('fecha_beh','acredito_beh','id_clif_beh');
			$crud->columns('folio_beh','fecha_beh','acredito_beh','id_clif_beh');
			$crud->display_as('id_clif_beh','Cliente');
			$crud->display_as('acredito_beh','Tipo de pago');
			
 			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function promociones_admin()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('promociones');
			$crud->set_subject('promociones');
			$crud->set_relation('id_prodf_beh','productos','producto_beh');
			$crud->display_as('id_prom_beh','Id');
			$crud->display_as('fechai_beh','Fecha Inicio');
			$crud->display_as('fechaf_beh','Fecha Fin');
			$crud->display_as('descuento_beh','Descuento');
			$crud->display_as('descripcion_beh','Descripción');
			$crud->display_as('id_prodf_beh','Producto');
			$crud->required_fields('id_prodf_beh','fechai_beh','fechaf_beh','descuento_beh', 'descripcion_beh');
			$crud->columns('id_prom_beh','id_prodf_beh','fechai_beh','fechaf_beh','descuento_beh', 'descripcion_beh');

              if( $this->input->post( 'descuento_beh' ) != null ) 
               $crud->set_rules('descuento_beh','Descuento','numeric|max_length[2]');  
                $output = $crud->render();
                

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


public function usuarios_admin()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('usuarios');
			$crud->set_subject('Usuarios');
			$crud->display_as('id_usu_beh','Id');
			$crud->display_as('usuario_beh','Usuario');
			$crud->display_as('clave_beh','Clave');
			$crud->display_as('foto_beh','Imagen');
			$crud->display_as('nomb_usu_beh','Nombre');
			$crud->display_as('ocupacion_beh','Ocupación');
			$crud->required_fields('usuario_beh','clave_beh','foto_beh','nomb_usu_beh', 'ocupacion_beh');
			$crud->columns('id_usu_beh','usuario_beh','clave_beh','foto_beh','nomb_usu_beh', 'ocupacion_beh');
            $crud ->set_field_upload('foto_beh','assets/uploads/files/Usuarios');
            $crud->field_type('clave_beh', 'password');
            $crud->callback_before_delete(array($this,'delete_thumb_user'));
            $crud->unique_fields(array('usuario_beh'));
            if( $this->input->post( 'nomb_usu_beh' ) != null ) {
             $crud->set_rules( 'nomb_usu_beh', 'Nombre Completo', 'regex_match[/^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ ,.]*$/u]' );}
             if( $this->input->post( 'ocupacion_beh' ) != null ) {
             $crud->set_rules( 'ocupacion_beh', 'Ocupación', 'regex_match[/^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ ,.]*$/u]' );}
			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


//$this->grocery_crud->callback_after_upload(array($this,'example_callback_after_upload'));

	function delete_thumb_user($primary_key)
	{	// get your the images name
	$image = $this->db->get_where('usuarios', array('id_usu_beh'=>$primary_key), 1)->row_array();
	if
	(
	unlink($your_path.'assets/uploads/files/Usuarios/'.$image['foto_beh'])	
	//echo 'assets/uploads/files/Usuarios/'.$image['name']
	)
{
	return true;
}	
else{
	return false;
}	
	 }


function delete_thumb_cat($primary_key)
	{	// get your the images name
	$image = $this->db->get_where('categorias', array('id_cat_beh'=>$primary_key), 1)->row_array();
	if
	(
	unlink($your_path.'assets/uploads/files/Categorias/'.$image['foto_cat_beh'])	
	//echo 'assets/uploads/files/Usuarios/'.$image['name'];
	)
{
	return true;
}	
else{
	return false;
}	
	 }

	 function delete_thumb_cli($primary_key)
	{	// get your the images name
	$image = $this->db->get_where('clientes', array('id_cli_beh'=>$primary_key), 1)->row_array();
	if
	(
	unlink($your_path.'assets/uploads/files/Clientes/'.$image['img_cli_beh'])	
	//echo 'assets/uploads/files/Usuarios/'.$image['name']
	)
{
	return true;
}	
else{
	return false;
}	
	 }

	 function delete_thumb_prod($primary_key)
	{	// get your the images name
	$image = $this->db->get_where('productos', array('id_prod_beh'=>$primary_key), 1)->row_array();
	if
	(
	unlink($your_path.'assets/uploads/files/Productos/'.$image['img_prod_beh'])	
	//echo 'assets/uploads/files/Usuarios/'.$image['name']
	)
{
	return true;
}	
else{
	return false;
   }	
 }

}