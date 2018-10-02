<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forma_pago_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Forma_pago_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['forma_pago'] = $this->Forma_pago_m->forma_pago();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='31') {
				$entra=1;
			}
		}
		if($entra=='1'){ 	
			$this->load->view('forma_pago/forma_pago_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		$this->Forma_pago_m->agregar(); 
		$r = $this->db->query("select max(id_forma_pago) as id_forma_pago from forma_pago")->row();
		$ultimo=$this->db->query("select f.id_forma_pago,f.descripcion,e.estados from  forma_pago as f inner join estados as e on f.estado=e.id_estados where id_forma_pago=".$r->id_forma_pago."")->row();

		$dato["id_forma_pago"]=$ultimo->id_forma_pago;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["estado"]=$ultimo->estados;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("f.id_forma_pago,f.descripcion");
		$this->db->from("forma_pago as f");
		$this->db->where("f.id_forma_pago",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Forma_pago_m->modificar($this->input->post("id"),$this->input->post("forma_pago")); 
		$ultimo=$this->db->query("select f.id_forma_pago,f.descripcion,e.estados,f.estado from forma_pago as f inner join estados as e on f.estado=e.id_estados where id_forma_pago=".$this->input->post("id")."")->row();
		$dato["id_forma_pago"]=$ultimo->id_forma_pago;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["estado"]=$ultimo->estados;
		$dato["id_estados"]=$ultimo->estado;
		echo json_encode($dato);
		
	}

	public function inactivo()
	{
		$this->Forma_pago_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select f.id_forma_pago,f.descripcion,e.estados from forma_pago as f inner join estados as e on f.estado=e.id_estados where (id_forma_pago=".$this->input->post("id").")")->row();
		$dato["id_forma_pago"]=$r->id_forma_pago;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;
		echo json_encode($dato);
	}

	public function activo()
	{
		$this->Forma_pago_m->activo($this->input->post("id")); 
		$r = $this->db->query("select f.id_forma_pago,f.descripcion,e.estados from forma_pago as f inner join estados as e on f.estado=e.id_estados where (id_forma_pago=".$this->input->post("id").")")->row();
		$dato["id_forma_pago"]=$r->id_forma_pago;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;
		echo json_encode($dato);
	}
}

?>