<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Concepto_movimiento_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Concepto_movimiento_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['concepto'] = $this->Concepto_movimiento_m->concepto();
		$data['tipo'] = $this->Concepto_movimiento_m->tipo();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='30') {
				$entra=1;
			}
		}
		if($entra=='1'){ 	
			$this->load->view('concepto_movimiento/concepto_movimiento_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		$this->Concepto_movimiento_m->agregar(); 
		$r = $this->db->query("select max(id_concepto_movimiento) as id_concepto_movimiento from concepto_movimiento")->row();
		$ultimo=$this->db->query("select c.id_concepto_movimiento,c.descripcion,t.descripcion as tipo,e.estados from  concepto_movimiento as c inner join tipo_movimiento as t on c.id_tipo_movimiento=t.id_tipo_movimiento inner join estados as e on c.estado=e.id_estados where id_concepto_movimiento=".$r->id_concepto_movimiento."")->row();

		$dato["id_concepto_movimiento"]=$ultimo->id_concepto_movimiento;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["tipo"]=$ultimo->tipo;
		$dato["estado"]=$ultimo->estados;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("c.id_concepto_movimiento,c.descripcion,c.id_tipo_movimiento,t.descripcion as tipo");
		$this->db->from("concepto_movimiento as c");
		$this->db->join("tipo_movimiento as t","c.id_tipo_movimiento=t.id_tipo_movimiento");
		$this->db->where("c.id_concepto_movimiento",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		$r1 = $this->db->query("select * from tipo_movimiento where id_tipo_movimiento!=".$r->id_tipo_movimiento)->result();
		$dato["concepto"]=$r;
		$dato["tipo"]=$r1;
		echo json_encode($dato);
	}	

	public function modificar()
	{
		$this->Concepto_movimiento_m->modificar($this->input->post("id"),$this->input->post("concepto_movimiento"),$this->input->post("tipo")); 
		$ultimo=$this->db->query("select c.id_concepto_movimiento,c.descripcion,t.descripcion as tipo,e.estados,c.estado from  concepto_movimiento as c inner join tipo_movimiento as t on c.id_tipo_movimiento=t.id_tipo_movimiento inner join estados as e on c.estado=e.id_estados where id_concepto_movimiento=".$this->input->post("id")."")->row();
		$dato["id_concepto_movimiento"]=$ultimo->id_concepto_movimiento;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["tipo"]=$ultimo->tipo;
		$dato["estado"]=$ultimo->estados;
		$dato["id_estados"]=$ultimo->estado;
		echo json_encode($dato);
		
	}

	public function inactivo()
	{
		$this->Concepto_movimiento_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select c.id_concepto_movimiento,c.descripcion,t.descripcion as tipo,e.estados from  concepto_movimiento as c inner join tipo_movimiento as t on c.id_tipo_movimiento=t.id_tipo_movimiento inner join estados as e on c.estado=e.id_estados where (id_concepto_movimiento=".$this->input->post("id").")")->row();
		$dato["id_concepto_movimiento"]=$r->id_concepto_movimiento;
		$dato["descripcion"]=$r->descripcion;
		$dato["tipo"]=$r->tipo;
		$dato["estado"]=$r->estados;
		echo json_encode($dato);
	}

	public function activo()
	{
		$this->Concepto_movimiento_m->activo($this->input->post("id")); 
		$r = $this->db->query("select c.id_concepto_movimiento,c.descripcion,t.descripcion as tipo,e.estados from  concepto_movimiento as c inner join tipo_movimiento as t on c.id_tipo_movimiento=t.id_tipo_movimiento inner join estados as e on c.estado=e.id_estados where (id_concepto_movimiento=".$this->input->post("id").")")->row();
		$dato["id_concepto_movimiento"]=$r->id_concepto_movimiento;
		$dato["descripcion"]=$r->descripcion;
		$dato["tipo"]=$r->tipo;
		$dato["estado"]=$r->estados;
		echo json_encode($dato);
	}
}

?>