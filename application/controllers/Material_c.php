<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Material_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Material_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['material'] = $this->Material_m->material();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='19') {
				$entra=1;
			}
		}
		if($entra=='1'){ 	
			$this->load->view('material/material_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		$this->Material_m->agregar(); 
		$r = $this->db->query("select max(id_material) as id_material from material")->row();
		$ultimo=$this->db->query("select  m.id_material as id_material,m.material as material  from  material as m where id_material=".$r->id_material."")->row();

		$dato["id_material"]=$ultimo->id_material;
		$dato["material"]=$ultimo->material;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("material");
		$this->db->where("id_material",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Material_m->modificar($this->input->post("id"),$this->input->post("material")); 
		$r = $this->db->query("select  c.id_material as id_material,c.material as material from  material as c where (id_material=".$this->input->post("id").")")->row();
		
		$dato["id_material"]=$r->id_material;
		$dato["material"]=$r->material;
		
		echo json_encode($dato);
	}	

	public function eliminar_material()
	{
		$r = $this->db->query("select * from  material  where(id_material=".$this->input->post("id").")")->row();
		$dato["id_material"]=$r->id_material;

		echo json_encode($dato);
	}

	public function eliminar()
	{
		$this->Material_m->eliminar();
	}

}

?>