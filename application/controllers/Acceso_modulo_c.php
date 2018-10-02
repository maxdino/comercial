<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acceso_modulo_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Acceso_modulo_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{

		if(isset($_SESSION["user"])){ 
			$data['permisos'] = $this->Principal_m->traer_modulos();
			$data['perfil'] = $this->Acceso_modulo_m->perfil();
			$data['modulo'] = $this->Acceso_modulo_m->modulo_padre();
			$this->load->view('acceso_modulo/acceso_modulo_v',$data);
		}else{
			redirect(site_url("Portal_c"));	
		}
	}

	public function modulo()
	{
		$modulo = $this->Acceso_modulo_m->modulo($this->input->post("modulo"));
		$perfil_modulo = $this->Acceso_modulo_m->perfil_modulo($this->input->post("perfil"));
		$html = ''; 
		if ($this->input->post("modulo")!='') {
		foreach ($modulo as $value) {
				$vali='0';
			foreach ($perfil_modulo as $values){
				if ($value->id_modulo==$values->id_modulo) {
				$vali='1';
				}}
		if ($vali=='0') {		
			$html.= '
					<p ALIGN=right>
					<label for="'.$value->id_modulo.'" class="inline-label">'.$value->nombre.'</label>	
					<input type="checkbox" class="ch" name="acceso_modulo[]" id="acceso_modulo[]" value="'.$value->id_modulo.'"  />
                    </p> 
                    ';
        }else{
        	$html.= '
					<p ALIGN=right>
					<label for="'.$value->id_modulo.'" class="inline-label">'.$value->nombre.'</label>	
					<input type="checkbox" class="ch" name="acceso_modulo[]" id="acceso_modulo[]" value="'.$value->id_modulo.'" checked />
                    </p>
                    ';
        } 
		}
		echo $html;
		}
	}	

	public function agregar()
	{
		$modulo = $this->Acceso_modulo_m->modulo($_POST['id_modulo']);
		foreach ($modulo as $value) {        
        $this->db->where('id_perfil_usuario',$_POST['id_perfil']);
        $this->db->where('id_modulo',$value->id_modulo);
        $this->db->delete('permisos');
    	}
        for ($i=0; $i <count($_POST['acceso_modulo']) ; $i++) { 

          $datos = array(  "id_perfil_usuario" => $_POST['id_perfil'],
                           "id_modulo" =>  $_POST['acceso_modulo'][$i],
                           "estado" => '1',
                        );
        $r = $this->db->insert("permisos",$datos);
      }			
	}	

}

?>