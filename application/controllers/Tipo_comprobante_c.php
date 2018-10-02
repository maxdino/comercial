<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipo_comprobante_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tipo_comprobante_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
			$data['permisos'] = $this->Principal_m->traer_modulos();
			$data['tipo_comprobante'] = $this->Tipo_comprobante_m->tipo_comprobante();
			$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
			$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='17') {
				$entra=1;
			}
		}
		if($entra=='1'){
			$this->load->view('tipo_comprobante/tipo_comprobante_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
 		$this->Tipo_comprobante_m->agregar(); 
	 	$r = $this->db->query("select max(id_tipo_comprobante) as id_tipo_comprobante from  tipo_comprobante")->row();
		$ultimo=$this->db->query("select m.id_tipo_comprobante,m.descripcion,e.estados from  tipo_comprobante as m inner join estados as e on m.estado=e.id_estados where id_tipo_comprobante=".$r->id_tipo_comprobante."")->row();

		$dato["id_tipo_comprobante"]=$ultimo->id_tipo_comprobante;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["estado"]=$ultimo->estados;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("tipo_comprobante");
		$this->db->where("id_tipo_comprobante",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Tipo_comprobante_m->modificar($this->input->post("id"),$this->input->post("tipo_comprobante")); 
		$r = $this->db->query("select m.id_tipo_comprobante as id_tipo_comprobante,m.descripcion as descripcion ,e.estados as estados from  tipo_comprobante as m inner join estados as e on m.estado=e.id_estados where(id_tipo_comprobante=".$this->input->post("id").")")->row();
		
		$dato["id_tipo_comprobante"]=$r->id_tipo_comprobante;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados; 
		
		echo json_encode($dato);
		
	}

	public function eliminar_tipo_comprobante()
	{
		$r = $this->db->query("select * from  tipo_comprobante  where(id_tipo_comprobante=".$this->input->post("id").")")->row();
		$dato["id_tipo_comprobante"]=$r->id_tipo_comprobante;
	
		echo json_encode($dato);
	}

	public function eliminar()
	{
		$this->Tipo_comprobante_m->eliminar();
	}


}

?>