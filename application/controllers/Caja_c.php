<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caja_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Caja_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['caja'] = $this->Caja_m->caja();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='24') {
				$entra=1;
			}
		}
		if($entra=='1'){ 	
			$this->load->view('caja/caja_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		$this->Caja_m->agregar(); 
		$r = $this->db->query("select max(id_caja) as id_caja from caja")->row();
		$ultimo=$this->db->query("select c.id_caja,c.descripcion,e.estados from  caja as c inner join estados as e on c.estado=e.id_estados where id_caja=".$r->id_caja."")->row();

		$dato["id_caja"]=$ultimo->id_caja;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["estado"]=$ultimo->estados;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("caja");
		$this->db->where("id_caja",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Caja_m->modificar($this->input->post("id"),$this->input->post("caja")); 
		$r = $this->db->query("select c.id_caja as id_caja,c.descripcion as descripcion,c.estado as id_estados ,e.estados as estados from  caja as c inner join estados as e on c.estado=e.id_estados where(id_caja=".$this->input->post("id").")")->row();
		
		$dato["id_caja"]=$r->id_caja;
		$dato["descripcion"]=$r->descripcion;
		$dato["id_estados"]=$r->id_estados; 
		$dato["estado"]=$r->estados; 
		
		echo json_encode($dato);
		
	}

	public function inactivo()
	{
		$this->Caja_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select c.id_caja , c.descripcion,e.estados from  caja as c INNER JOIN estados as e on (c.estado=e.id_estados)  where (id_caja=".$this->input->post("id").")")->row();
		
		$dato["id_caja"]=$r->id_caja;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;		
		echo json_encode($dato);
	}

public function activo()
	{
		$this->Caja_m->activo($this->input->post("id")); 
		$r = $this->db->query("select c.id_caja , c.descripcion,e.estados from  caja as c INNER JOIN estados as e on (c.estado=e.id_estados)  where (id_caja=".$this->input->post("id").")")->row();
		
		$dato["id_caja"]=$r->id_caja;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;		
		echo json_encode($dato);
	}
}

?>