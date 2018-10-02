<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Almacen_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Almacen_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{

		
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['almacen'] = $this->Almacen_m->almacen();	
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='18') {
				$entra=1;
			}
		}
		if($entra=='1'){ 	
			$this->load->view('almacen/almacen_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		$this->Almacen_m->agregar(); 
		$r = $this->db->query("select max(id_almacen) as id_almacen from  almacen")->row();
		$ultimo=$this->db->query("select  a.id_almacen as id_almacen,a.almacen as almacen  from  almacen as a where id_almacen=".$r->id_almacen."")->row();

		$dato["id_almacen"]=$ultimo->id_almacen;
		$dato["almacen"]=$ultimo->almacen;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("almacen");
		$this->db->where("id_almacen",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Almacen_m->modificar($this->input->post("id"),$this->input->post("almacen")); 
		$r = $this->db->query("select  c.id_almacen as id_almacen,c.almacen as almacen from  almacen as c where (id_almacen=".$this->input->post("id").")")->row();
		
		$dato["id_almacen"]=$r->id_almacen;
		$dato["almacen"]=$r->almacen;
		
		echo json_encode($dato);
	}	

	public function eliminar_almacen()
	{
		$r = $this->db->query("select * from  almacen  where(id_almacen=".$this->input->post("id").")")->row();
		$dato["id_almacen"]=$r->id_almacen;

		echo json_encode($dato);
	}

	public function eliminar()
	{
		$this->Almacen_m->eliminar();
	}

}

?>