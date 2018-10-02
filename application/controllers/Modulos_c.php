<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modulos_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Modulo_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['modulo'] = $this->Modulo_m->modulo();
		$data['modulo_padre'] = $this->Modulo_m->modulo_padre();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='6') {
				$entra=1;
			}
		}
		if($entra=='1'){ 	
			$this->load->view('modulo/modulo_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function nuevo()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();		
		$data['modulo_padre'] = $this->Modulo_m->modulo_padre();
		$this->load->view('modulo/agregar_v',$data);	
	}

	public function agregar()
	{
		$this->Modulo_m->agregar(); 
	}

	public function editar()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();	
		$data['modulos'] = $this->Modulo_m->modulo_ver($_GET["id"]);
		$data['modulo_padre'] = $this->Modulo_m->modulo_padre();
		$this->load->view('modulo/editar_v',$data);
	}	

	public function modificar()
	{
		$this->Modulo_m->modificar($this->input->post("id"),$this->input->post("modulo"),$this->input->post("modulo_padre"),$this->input->post("url"),$this->input->post("icono")); 
		$this->listar();
		
	}	

	public function inactivo()
	{
		$this->Modulo_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select m.id_modulo , m.nombre , m.url , m.modulo_padre,e.estados from  modulo as m INNER JOIN estados as e on (m.estado=e.id_estados)  where (id_modulo=".$this->input->post("id").")")->row();
		$dato["id_modulo"]=$r->id_modulo;
		$dato["descripcion"]=$r->nombre;
		$dato["url"]=$r->url;
		$dato["modulo_padre"]=$r->modulo_padre;
		$dato["estado"]=$r->estados;
		$dato["url1"]= base_url().'Modulos_c/editar/?id=';
		echo json_encode($dato);
	}

	public function activo()
	{
		$this->Modulo_m->activo($this->input->post("id")); 
		$r = $this->db->query("select m.id_modulo , m.nombre , m.url , m.modulo_padre,e.estados from  modulo as m INNER JOIN estados as e on (m.estado=e.id_estados)  where (id_modulo=".$this->input->post("id").")")->row();
		$dato["id_modulo"]=$r->id_modulo;
		$dato["descripcion"]=$r->nombre;
		$dato["url"]=$r->url;
		$dato["modulo_padre"]=$r->modulo_padre;
		$dato["estado"]=$r->estados;
		$dato["url1"]= base_url().'Modulos_c/editar/?id=';
		echo json_encode($dato);
	}

}

?>