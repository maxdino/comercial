<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Perfil_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{

		if(isset($_SESSION["user"])){ 
			$data['permisos'] = $this->Principal_m->traer_modulos();
			$data['perfil'] = $this->Perfil_m->perfil();	
			$this->load->view('perfil/perfil_v',$data);
		}else{
			redirect(site_url("Portal_c"));	
		}
	}

	public function agregar()
	{
		$this->Perfil_m->agregar(); 
		$r = $this->db->query("select max(id_perfil_usuario) as id_perfil_usuario from  perfil_usuario")->row();
		$ultimo=$this->db->query("select p.id_perfil_usuario, p.descripcion,e.estados  from  perfil_usuario as p inner join estados as e on p.estado=e.id_estados  where id_perfil_usuario=".$r->id_perfil_usuario."")->row();

		$dato["id_perfil_usuario"]=$ultimo->id_perfil_usuario;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["estados"]=$ultimo->estados;
		echo json_encode($dato);
	}

	public function listar()
	{
		$html = ''; 	

		if ($this->input->post("valorBusqueda")=='') { 
			$perfil = $this->Perfil_m->perfil();
		}else{
			$perfil = $this->Perfil_m->perfil_busqueda($this->input->post("valorBusqueda"));	
		}
		$url = "'#editar_perfil'";
		foreach ($perfil as $value){
			$html.= '
			<tr>
				<td>'.$value->id_perfil_usuario.'</td>
				<td>'.$value->descripcion.'</td>
				<td>'.$value->estado.'</td>
				<td class="jtable-command-column"> <a title="EDITAR" data-uk-modal="{target:'.$url.'}" class="jtable-command-button jtable-edit-command-button" onclick="editar('.$value->id_perfil_usuario.')"><span class="uk-icon-pencil"></span></a></td>
			</tr>';
		}
		echo $html;
	}

	public function editar()
	{
		$this->db->select("*");
		$this->db->from("perfil_usuario");
		$this->db->where("id_perfil_usuario",$this->input->post("id"));
		$r = $this->db->get()->row(); 	
		
		echo json_encode($r);
	}	

	public function modificar()
	{
		$this->Perfil_m->modificar($this->input->post("id"),$this->input->post("perfil")); 
		$ultimo=$this->db->query("select p.id_perfil_usuario, p.descripcion,e.estados,p.estado as id_estado  from  perfil_usuario as p inner join estados as e on p.estado=e.id_estados  where id_perfil_usuario=".$this->input->post("id"))->row();

		$dato["id_perfil_usuario"]=$ultimo->id_perfil_usuario;
		$dato["id_estado"]=$ultimo->id_estado;
		$dato["descripcion"]=$ultimo->descripcion;
		$dato["estados"]=$ultimo->estados;
		echo json_encode($dato);
		
	}	

	public function inactivo()
	{
		$this->Perfil_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select p.id_perfil_usuario , p.descripcion,e.estados from  perfil_usuario as p INNER JOIN estados as e on (p.estado=e.id_estados)  where (id_perfil_usuario=".$this->input->post("id").")")->row();
		$dato["id_perfil_usuario"]=$r->id_perfil_usuario;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;
		
		echo json_encode($dato);
	}

	public function activo()
	{
		$this->Perfil_m->activo($this->input->post("id")); 
		$r = $this->db->query("select p.id_perfil_usuario , p.descripcion,e.estados from  perfil_usuario as p INNER JOIN estados as e on (p.estado=e.id_estados)  where (id_perfil_usuario=".$this->input->post("id").")")->row();
		$dato["id_perfil_usuario"]=$r->id_perfil_usuario;
		$dato["descripcion"]=$r->descripcion;
		$dato["estado"]=$r->estados;
		
		echo json_encode($dato);
	}

}

?>