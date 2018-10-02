<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Colores_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Colores_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['colores'] = $this->Colores_m->colores();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='13') {
				$entra=1;
			}
		}
		if($entra=='1'){ 	
			$this->load->view('colores/colores_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		$this->Colores_m->agregar(); 
		$r = $this->db->query("select max(id_colores) as id_colores from  colores")->row();
		$ultimo=$this->db->query("select c.id_colores,c.descripcion,e.estados from  colores as c inner join estados as e on c.estado=e.id_estados where id_colores=".$r->id_colores."")->row();

		$dato["id_colores"]=$ultimo->id_colores;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["estado"]=$ultimo->estados;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("colores");
		$this->db->where("id_colores",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Colores_m->modificar($this->input->post("id"),$this->input->post("colores"),$this->input->post("codigo")); 
		$r = $this->db->query("select c.id_colores as id_colores,c.descripcion as descripcion ,e.estados as estados from  colores as c inner join estados as e on c.estado=e.id_estados where(id_colores=".$this->input->post("id").")")->row();
		
		$dato["id_colores"]=$r->id_colores;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados; 
		
		echo json_encode($dato);
		
	}

	public function eliminar_colores()
	{
		$r = $this->db->query("select * from  colores  where(id_colores=".$this->input->post("id").")")->row();
		$dato["id_colores"]=$r->id_colores;

		echo json_encode($dato);
	}

	public function eliminar()
	{
		//$this->Colores_m->eliminar();
	}


}

?>