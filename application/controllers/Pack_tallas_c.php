<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pack_tallas_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pack_tallas_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{

		if(isset($_SESSION["user"])){ 
			$data['permisos'] = $this->Principal_m->traer_modulos();
			$data['pack'] = $this->Pack_tallas_m->pack();
			$this->load->view('pack_tallas/pack_tallas_v',$data);
		}else{
			redirect(site_url("Portal_c"));	
		}
	}

	public function nuevo()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();		
		$data['tallas'] = $this->Pack_tallas_m->tallas();
		$this->load->view('pack_tallas/agregar_v',$data);	 
	}

	public function agregar()
	{
		$data=  array('pack_tallas' => strtoupper($this->input->post("pack_tallas")),
			'estado' => '1',
		);
		$this->db->insert("pack_tallas",$data);
		$r = $this->db->query("select max(id_pack_tallas) as id_pack_tallas from  pack_tallas")->row();
		$id=$r->id_pack_tallas;
		for ($i=0; $i <count($_POST['tallas']) ; $i++) { 
			$datos = array(
				"id_pack_tallas" => $id,
				"id_tallas" =>  $_POST['tallas'][$i]
			);
			$r = $this->db->insert("detalle_tallas",$datos);
		}
	}

	public function editar()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();	
		$data['pack_tallas'] = $this->Pack_tallas_m->ver_pack_tallas($_GET["id"]);
		$data['detalle_tallas'] = $this->Pack_tallas_m->detalle_tallas($_GET["id"]);
		$data['tallas'] = $this->Pack_tallas_m->tallas();
		$this->load->view('pack_tallas/editar_v',$data);	
	}	

	public function modificar()
	{
		$data=  array('pack_tallas' => strtoupper($this->input->post("pack_tallas")),
	);
		$this->db->where("id_pack_tallas",$this->input->post("id_pack_tallas"));
		$this->db->update("pack_tallas",$data);

		$this->db->where("id_pack_tallas",$this->input->post("id_pack_tallas"));
		$this->db->delete("detalle_tallas"); 

		$id=$this->input->post("id_pack_tallas");
		for ($i=0; $i <count($_POST['tallas']) ; $i++) { 
			$datos = array(
				"id_pack_tallas" => $id,
				"id_tallas" =>  $_POST['tallas'][$i]
			);
			$r = $this->db->insert("detalle_tallas",$datos);
		}
	}
	
	public function inactivo()
	{
		$this->Pack_tallas_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select p.id_pack_tallas , p.pack_tallas,e.estados from  pack_tallas as p INNER JOIN estados as e on (p.estado=e.id_estados)  where (id_pack_tallas=".$this->input->post("id").")")->row();
		$dato["id_pack_tallas"]=$r->id_pack_tallas;
		$dato["pack_tallas"]=$r->pack_tallas;
		$dato["estado"]=$r->estados;
		$dato["url"]=	base_url().'Pack_tallas_c/editar/?id=';
		
		echo json_encode($dato);
	}

	public function activo()
	{
		$this->Pack_tallas_m->activo($this->input->post("id")); 
		$r = $this->db->query("select p.id_pack_tallas , p.pack_tallas,e.estados from  pack_tallas as p INNER JOIN estados as e on (p.estado=e.id_estados)  where (id_pack_tallas=".$this->input->post("id").")")->row();
		$dato["id_pack_tallas"]=$r->id_pack_tallas;
		$dato["pack_tallas"]=$r->pack_tallas;
		$dato["estado"]=$r->estados;
		$dato["url"]=	base_url().'Pack_tallas_c/editar/?id=';
		
		echo json_encode($dato);
	}


}

?>