<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unidad_medida_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Unidad_medida_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['unidad'] = $this->Unidad_medida_m->unidad_medida();	
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='16') {
				$entra=1;
			}
		}
		if($entra=='1'){
			$this->load->view('unidad_medida/unidad_medida_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		$this->Unidad_medida_m->agregar(); 
		$r = $this->db->query("select max(id_unidad_medida) as id_unidad_medida from  unidad_medida")->row();
		$ultimo=$this->db->query("select  u.id_unidad_medida as id_unidad_medida,u.unidad_medida as unidad_medida,  u.unidad as unidad  ,e.estados as estado from  unidad_medida as u inner join estados as e on u.estado=e.id_estados where id_unidad_medida=".$r->id_unidad_medida."")->row();

		$dato["id_unidad_medida"]=$ultimo->id_unidad_medida;
		$dato["unidad_medida"]=$ultimo->unidad_medida;
		$dato["unidad"]=$ultimo->unidad;
		$dato["estado"]=$ultimo->estado;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("unidad_medida");
		$this->db->where("id_unidad_medida",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Unidad_medida_m->modificar($this->input->post("id"),$this->input->post("unidad_medida"),$this->input->post("unidad")); 
		$r = $this->db->query("select  u.id_unidad_medida as id_unidad_medida,u.unidad_medida as unidad_medida, u.unidad as unidad  ,e.estados as estado from  unidad_medida as u inner join estados as e on u.estado=e.id_estados where(id_unidad_medida=".$this->input->post("id").")")->row();
		
		$dato["id_unidad_medida"]=$r->id_unidad_medida;
		$dato["unidad_medida"]=$r->unidad_medida;
		$dato["unidad"]=$r->unidad;
		$dato["estado"]=$r->estado; 
		
		echo json_encode($dato);
	}	

	public function eliminar_unidad_medida()
	{
		$r = $this->db->query("select * from  unidad_medida  where(id_unidad_medida=".$this->input->post("id").")")->row();
		$dato["id_unidad_medida"]=$r->id_unidad_medida;

		echo json_encode($dato);
	}

	public function eliminar()
	{
		$this->Unidad_medida_m->eliminar();
	}

}

?>