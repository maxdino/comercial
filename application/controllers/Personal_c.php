<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Personal_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{

		if(isset($_SESSION["user"])){ 
			$data['permisos'] = $this->Principal_m->traer_modulos();
			$data['personal'] = $this->Personal_m->personal();
			$data['perfil'] = $this->Personal_m->perfil();
					
			$this->load->view('personal/personal_v',$data);
		}else{
			redirect(site_url("Portal_c"));	
		}
	}

	public function agregar()
	{

		$this->Personal_m->agregar(); 
		$this->listar();

	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("usuario");
		$this->db->where("id_usuario",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Personal_m->modificar($this->input->post("id_usuario"),$this->input->post("nombre"),$this->input->post("perfil"),$this->input->post("nick"),$this->input->post("clave")); 
		$this->listar();
		
	}	

}

?>