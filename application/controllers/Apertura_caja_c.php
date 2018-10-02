<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apertura_caja_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Apertura_caja_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['apertura'] = $this->Apertura_caja_m->apertura();
		$data['caja'] = $this->Apertura_caja_m->caja();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='26') {
				$entra=1;
			}
		}
		if($entra=='1'){ 	
			$this->load->view('apertura_caja/apertura_caja_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{	
		$v=$this->db->query("select count(id_sesion_caja) as id from sesion_caja  where id_caja=".$this->input->post("caja"))->row();
		$va2 = '0';
		if($v->id=='0'){
			$this->Apertura_caja_m->agregar();
			$va2 = '1';
		}else{
			$va = $this->db->query("select max(id_sesion_caja) as id from sesion_caja where id_caja=".$this->input->post("caja"))->row();
			$va1 = $this->db->query("select fecha_salida from sesion_caja where id_sesion_caja=".$va->id)->row();
			if ($va1->fecha_salida!=''&&$va1->fecha_salida!=null&&$va1->fecha_salida!='0000-00-00 00:00:00') {
				$this->Apertura_caja_m->agregar();
				$va2 = '1';
			}
		}
		$r = $this->db->query("select max(id_sesion_caja) as id from sesion_caja where id_caja=".$this->input->post("caja"))->row();
		$ul=$this->db->query("select * from sesion_caja as s inner join caja as c on s.id_caja=c.id_caja where s.id_sesion_caja=".$r->id)->row();
		$dato["id_sesion_caja"]=$ul->id_sesion_caja;
		$dato["fecha"]=$ul->fecha_entrada;
		$dato["monto"]=$ul->monto_inicial;
		$dato["monto_cierre"]=$ul->monto_cierre;
		$dato["usuario"]=$_SESSION["personal"].' '.$_SESSION["apellido"];
		$dato["caja"]=$ul->descripcion;
		$dato["va"]=$va2;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("caja");
		$this->db->where("id_caja",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Caja_m->modificar($this->input->post("id"),$this->input->post("caja")); 
		$r = $this->db->query("select c.id_caja as id_caja,c.descripcion as descripcion,c.estado as id_estados ,e.estados as estados from  caja as c inner join estados as e on c.estado=e.id_estados where(id_caja=".$this->input->post("id").")")->row();
		
		$dato["id_caja"]=$r->id_caja;
		$dato["descripcion"]=$r->descripcion;
		$dato["id_estados"]=$r->id_estados; 
		$dato["estado"]=$r->estados; 
		
		echo json_encode($dato);
		
	}

	public function inactivo()
	{
		$this->Caja_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select c.id_caja , c.descripcion,e.estados from  caja as c INNER JOIN estados as e on (c.estado=e.id_estados)  where (id_caja=".$this->input->post("id").")")->row();
		
		$dato["id_caja"]=$r->id_caja;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;		
		echo json_encode($dato);
	}

	public function activo()
	{
		$this->Caja_m->activo($this->input->post("id")); 
		$r = $this->db->query("select c.id_caja , c.descripcion,e.estados from  caja as c INNER JOIN estados as e on (c.estado=e.id_estados)  where (id_caja=".$this->input->post("id").")")->row();
		
		$dato["id_caja"]=$r->id_caja;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;		
		echo json_encode($dato);
	}
}

?>