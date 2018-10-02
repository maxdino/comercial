<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tallas_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tallas_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['tallas'] = $this->Tallas_m->tallas();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='12') {
				$entra=1;
			}
		}
		if($entra=='1'){
			$this->load->view('tallas/tallas_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		$this->Tallas_m->agregar(); 
		$r = $this->db->query("select max(id_tallas) as id_tallas from  tallas")->row();
		$ultimo=$this->db->query("select  t.id_tallas as id_tallas,t.descripcion as descripcion ,e.estados as estado from  tallas as t inner join estados as e on t.estado=e.id_estados where id_tallas=".$r->id_tallas."")->row();

		$dato["id_tallas"]=$ultimo->id_tallas;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["estado"]=$ultimo->estado;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("tallas");
		$this->db->where("id_tallas",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Tallas_m->modificar($this->input->post("id"),$this->input->post("tallas")); 
		$r = $this->db->query("select  t.id_tallas as id_tallas,t.descripcion as descripcion ,e.estados as estado from  tallas as t inner join estados as e on t.estado=e.id_estados where(id_tallas=".$this->input->post("id").")")->row();
		
		$dato["id_tallas"]=$r->id_tallas;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estado; 
		
		echo json_encode($dato);
	}	

	public function eliminar_tallas()
	{
		$r = $this->db->query("select * from  tallas  where(id_tallas=".$this->input->post("id").")")->row();
		$dato["id_tallas"]=$r->id_tallas;

		echo json_encode($dato);
	}

	public function eliminar()
	{
		$this->Tallas_m->eliminar();
	}

}

?>