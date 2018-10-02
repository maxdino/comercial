<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pack_colores_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pack_colores_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{

		if(isset($_SESSION["user"])){ 
			$data['permisos'] = $this->Principal_m->traer_modulos();
			$data['pack'] = $this->Pack_colores_m->pack();
			$this->load->view('pack_colores/pack_colores_v',$data);
		}else{
			redirect(site_url("Portal_c"));	
		}
	}

	public function nuevo()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();		
		$data['colores'] = $this->Pack_colores_m->colores();
		$this->load->view('pack_colores/agregar_v',$data);	 
	}

	public function agregar()
	{
		$data=  array('pack_colores' => strtoupper($this->input->post("pack_color")),
			'estado' => '1',
		);
		$this->db->insert("pack_colores",$data);
		$r = $this->db->query("select max(id_pack_colores) as id_pack_colores from  pack_colores")->row();
		$id=$r->id_pack_colores;
		for ($i=0; $i <count($_POST['colores']) ; $i++) { 
			$datos = array(
				"id_pack_colores" => $id,
				"id_colores" =>  $_POST['colores'][$i]
			);
			$r = $this->db->insert("detalle_colores",$datos);
		}
	}

	public function editar()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();	
		$data['pack_colores'] = $this->Pack_colores_m->ver_pack_colores($_GET["id"]);
		$data['detalle_colores'] = $this->Pack_colores_m->detalle_colores($_GET["id"]);
		$data['colores'] = $this->Pack_colores_m->colores();
		$this->load->view('pack_colores/editar_v',$data);	
	}	

	public function modificar()
	{
		$data=  array('pack_colores' => strtoupper($this->input->post("pack_color")),
	);
		$this->db->where("id_pack_colores",$this->input->post("id_pack_color"));
		$this->db->update("pack_colores",$data);

		$this->db->where("id_pack_colores",$this->input->post("id_pack_color"));
		$this->db->delete("detalle_colores"); 
		$id=$this->input->post("id_pack_color");
		for ($i=0; $i <count($_POST['colores']) ; $i++) { 
			$datos = array(
				"id_pack_colores" => $id,
				"id_colores" =>  $_POST['colores'][$i]
			);
			$r = $this->db->insert("detalle_colores",$datos);
		}
	}

	public function eliminar_colores()
	{
		$r = $this->db->query("select * from  colores  where(id_colores=".$this->input->post("id").")")->row();
		$dato["id_colores"]=$r->id_colores;
		
		echo json_encode($dato);
	}

	public function inactivo()
	{
		$this->Pack_colores_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select p.id_pack_colores , p.pack_colores,e.estados from  pack_colores as p INNER JOIN estados as e on (p.estado=e.id_estados)  where (id_pack_colores=".$this->input->post("id").")")->row();
		$dato["id_pack_colores"]=$r->id_pack_colores;
		$dato["pack_colores"]=$r->pack_colores;
		$dato["estado"]=$r->estados;
		$dato["url"]=	base_url().'Pack_colores_c/editar/?id=';
		
		echo json_encode($dato);
	}

	public function activo()
	{
		$this->Pack_colores_m->activo($this->input->post("id")); 
		$r = $this->db->query("select p.id_pack_colores , p.pack_colores,e.estados from  pack_colores as p INNER JOIN estados as e on (p.estado=e.id_estados)  where (id_pack_colores=".$this->input->post("id").")")->row();
		$dato["id_pack_colores"]=$r->id_pack_colores;
		$dato["pack_colores"]=$r->pack_colores;
		$dato["estado"]=$r->estados;
		$dato["url"]=	base_url().'Pack_colores_c/editar/?id=';
		
		echo json_encode($dato);
	}
	
}

?>