
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Serie_documento_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Serie_documento_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['serie_documento'] = $this->Serie_documento_m->serie_documento();
		$data['tipo_comprobante'] = $this->Serie_documento_m->tipo_comprobante();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='28') {
				$entra=1;
			}
		}
		if($entra=='1'){ 	
			$this->load->view('serie_documento/serie_documento_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{	
		$this->Serie_documento_m->agregar();
		$r = $this->db->query("select max(id_serie_documento) as id from serie_documento")->row();
		$ul=$this->db->query("select * from serie_documento as s inner join estados as e on s.estado=e.id_estados inner join tipo_comprobante as t on s.id_tipo_comprobante=t.id_tipo_comprobante where s.id_serie_documento=".$r->id)->row();
		$dato["id_serie_documento"]=$ul->id_serie_documento;
		$dato["serie"]=$ul->serie;
		$dato["numero"]=$ul->numero;
		$dato["max_numero"]=$ul->max_numero;
		$dato["tipo_comprobante"]=$ul->descripcion;
		$dato["estado"]=$ul->estados;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("serie_documento as s");
		$this->db->join("tipo_comprobante as t","s.id_tipo_comprobante=t.id_tipo_comprobante");
		$this->db->where("id_serie_documento",$this->input->post("id"));
		$r = $this->db->get()->row(); 
		$r1 = $this->db->query("select * from tipo_comprobante where id_tipo_comprobante!=".$r->id_tipo_comprobante)->result();
		$dato["serie_documento"] = $r;
		$dato["tipo"] = $r1;
		echo json_encode($dato);
	}	

	public function modificar()
	{
		$this->Serie_documento_m->modificar($this->input->post("id"),$this->input->post("serie"),$this->input->post("numero_co"),$this->input->post("max_numero"),$this->input->post("tipo_comprobante")); 
		$r = $this->db->query("select * from serie_documento as s inner join estados as e on s.estado=e.id_estados inner join tipo_comprobante as t on s.id_tipo_comprobante=t.id_tipo_comprobante where (s.id_serie_documento=".$this->input->post("id").")")->row();
		$dato["id_serie_documento"]=$r->id_serie_documento;
		$dato["serie"]=$r->serie;
		$dato["numero"]=$r->numero;
		$dato["max_numero"]=$r->max_numero;
		$dato["tipo_comprobante"]=$r->descripcion;
		$dato["estado"]=$r->estados;
		
		echo json_encode($dato);
		
	}

	public function inactivo()
	{
		$this->Serie_documento_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select c.id_caja , c.descripcion,e.estados from  caja as c INNER JOIN estados as e on (c.estado=e.id_estados)  where (id_caja=".$this->input->post("id").")")->row();
		
		$dato["id_caja"]=$r->id_caja;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;		
		echo json_encode($dato);
	}

	public function activo()
	{
		$this->Serie_documento_m->activo($this->input->post("id")); 
		$r = $this->db->query("select c.id_caja , c.descripcion,e.estados from  caja as c INNER JOIN estados as e on (c.estado=e.id_estados)  where (id_caja=".$this->input->post("id").")")->row();
		
		$dato["id_caja"]=$r->id_caja;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;		
		echo json_encode($dato);
	}
}

?>