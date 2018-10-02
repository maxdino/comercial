<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipo_movimiento_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tipo_movimiento_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['tipo'] = $this->Tipo_movimiento_m->tipo();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='24') {
				$entra=1;
			}
		}
		if($entra=='1'){ 	
			$this->load->view('tipo_movimiento/tipo_movimiento_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		$this->Tipo_movimiento_m->agregar(); 
		$r = $this->db->query("select max(id_tipo_movimiento) as id_tipo_movimiento from tipo_movimiento")->row();
		$ultimo=$this->db->query("select c.id_tipo_movimiento,c.descripcion,e.estados from  tipo_movimiento as c inner join estados as e on c.estado=e.id_estados where id_tipo_movimiento=".$r->id_tipo_movimiento."")->row();

		$dato["id_tipo_movimiento"]=$ultimo->id_tipo_movimiento;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["estado"]=$ultimo->estados;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("tipo_movimiento");
		$this->db->where("id_tipo_movimiento",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Tipo_movimiento_m->modificar($this->input->post("id"),$this->input->post("tipo")); 
		$r = $this->db->query("select c.id_tipo_movimiento as id_tipo_movimiento,c.descripcion as descripcion,c.estado as id_estados ,e.estados as estados from  tipo_movimiento as c inner join estados as e on c.estado=e.id_estados where(id_tipo_movimiento=".$this->input->post("id").")")->row();
		
		$dato["id_tipo_movimiento"]=$r->id_tipo_movimiento;
		$dato["descripcion"]=$r->descripcion;
		$dato["id_estados"]=$r->id_estados; 
		$dato["estado"]=$r->estados; 
		
		echo json_encode($dato);
		
	}

	public function inactivo()
	{
		$this->Tipo_movimiento_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select c.id_tipo_movimiento , c.descripcion,e.estados from  tipo_movimiento as c INNER JOIN estados as e on (c.estado=e.id_estados)  where (id_tipo_movimiento=".$this->input->post("id").")")->row();
		
		$dato["id_tipo_movimiento"]=$r->id_tipo_movimiento;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;		
		echo json_encode($dato);
	}

public function activo()
	{
		$this->Tipo_movimiento_m->activo($this->input->post("id")); 
		$r = $this->db->query("select c.id_tipo_movimiento , c.descripcion,e.estados from  tipo_movimiento as c INNER JOIN estados as e on (c.estado=e.id_estados)  where (id_tipo_movimiento=".$this->input->post("id").")")->row();
		
		$dato["id_tipo_movimiento"]=$r->id_tipo_movimiento;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;		
		echo json_encode($dato);
	}
}

?>