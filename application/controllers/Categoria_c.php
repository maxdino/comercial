<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Categoria_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{

		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['categoria'] = $this->Categoria_m->categoria();	
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='10') {
				$entra=1;
			}
		}
		if($entra=='1'){ 	
			$this->load->view('categoria/categoria_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		$this->Categoria_m->agregar(); 
		$r = $this->db->query("select max(id_categoria) as id_categoria from  categoria")->row();
		$ultimo=$this->db->query("select  c.id_categoria as id_categoria,c.descripcion as descripcion ,e.estados as estado from  categoria as c inner join estados as e on c.estado=e.id_estados where id_categoria=".$r->id_categoria."")->row();

		$dato["id_categoria"]=$ultimo->id_categoria;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["estado"]=$ultimo->estado;
		echo json_encode($dato);
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("categoria");
		$this->db->where("id_categoria",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Categoria_m->modificar($this->input->post("id"),$this->input->post("categoria")); 
		$r = $this->db->query("select  c.id_categoria as id_categoria,c.descripcion as descripcion ,e.estados as estado from  categoria as c inner join estados as e on c.estado=e.id_estados where(id_categoria=".$this->input->post("id").")")->row();
		
		$dato["id_categoria"]=$r->id_categoria;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estado; 
		
		echo json_encode($dato);
	}	

	public function eliminar_categoria()
	{
		$r = $this->db->query("select * from  categoria  where(id_categoria=".$this->input->post("id").")")->row();
		$dato["id_categoria"]=$r->id_categoria;

		echo json_encode($dato);
	}

	public function eliminar()
	{
		$this->Categoria_m->eliminar();
	}

}

?>