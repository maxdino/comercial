<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marcas_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Marcas_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['marcas'] = $this->Marcas_m->marcas();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='8') {
				$entra=1;
			}
		}
		if($entra=='1'){ 
			$this->load->view('marcas/marcas_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		$this->Marcas_m->agregar(); 
		$r = $this->db->query("select max(id_marcas) as id_marcas from  marcas")->row();
		$ultimo=$this->db->query("select m.id_marcas,m.descripcion,e.estados from  marcas as m inner join estados as e on m.estado=e.id_estados where id_marcas=".$r->id_marcas."")->row();

		$dato["id_marcas"]=$ultimo->id_marcas;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["estado"]=$ultimo->estados;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("marcas");
		$this->db->where("id_marcas",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Marcas_m->modificar($this->input->post("id"),$this->input->post("marcas")); 
		$r = $this->db->query("select m.id_marcas as id_marcas,m.descripcion as descripcion ,e.estados as estados from  marcas as m inner join estados as e on m.estado=e.id_estados where(id_marcas=".$this->input->post("id").")")->row();
		
		$dato["id_marcas"]=$r->id_marcas;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados; 
		
		echo json_encode($dato);
		
	}

	public function eliminar_marcas()
	{
		$r = $this->db->query("select * from  marcas  where(id_marcas=".$this->input->post("id").")")->row();
		$dato["id_marcas"]=$r->id_marcas;

		echo json_encode($dato);
	}

	public function eliminar()
	{
		$this->Marcas_m->eliminar();
	}


}

?>