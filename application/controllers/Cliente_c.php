<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cliente_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['cliente'] = $this->Cliente_m->cliente();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='23') {
				$entra=1;
			}
		}
		if($entra=='1'){
			$this->load->view('cliente/cliente_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function nuevo()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['departamentos'] = $this->Cliente_m->departamentos();	
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='23') {
				$entra=1;
			}
		}
		if($entra=='1'){		
			$this->load->view('cliente/agregar_v',$data);	 
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		if ($_FILES["imagen"]["name"]!='') {
			$foto=$_FILES["imagen"]["name"];
			$ruta=$_FILES["imagen"]["tmp_name"];
			$destino= "public/foto/cliente".$foto;
			copy($ruta, $destino); 
		}else{
			$destino='public/foto/cliente/user.png';
		}

		$data=  array(
			'nombre' => strtoupper($this->input->post("cliente")),
			'dni ' => $this->input->post("dni"),
			'fecha' => date('Y-m-d H:i:s'),
			'direccion' => strtoupper($this->input->post("direccion")),
			'id_distritos' => $this->input->post("distrito"),
			'foto' => $destino,
		);
		$this->db->insert("cliente",$data);
	}

	public function editar()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['cliente'] = $this->Cliente_m->cliente_editar($_GET["id"]);	
		$data['departamentos'] = $this->Cliente_m->departamentos();
		$data['provincias'] = $this->Cliente_m->provincias_ver();
		$data['distritos'] = $this->Cliente_m->distritos_ver();	
		$cliente = $this->db->query("select id_distritos from cliente where(id_cliente=".$_GET["id"].")")->row();
		$distrito = $this->db->query("select id_provincias from distritos where(id_distritos=".$cliente->id_distritos.")")->row();
		$provincia = $this->db->query("select id_departamentos from provincias where(id_provincias=".$distrito->id_provincias.")")->row();
		$provi1 = $this->db->query("select id_provincias,provincias from provincias where(id_departamentos=".$provincia->id_departamentos.")")->result();
		$dis1 = $this->db->query("select id_distritos,distritos from distritos where(id_provincias=".$distrito->id_provincias.")")->result();
		$data['provi1'] = $provi1 ;
		$data['dis1'] = $dis1 ;
		$data['depa'] = $provincia->id_departamentos;	
		$data['provi'] = $distrito->id_provincias;	
		$data['dis'] = $cliente->id_distritos;	
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='23') {
				$entra=1;
			}
		}
		if($entra=='1'){	
			$this->load->view('cliente/editar_v',$data);	 
		}else{
			redirect(site_url("Principal_c"));	
		}
	}	

	public function modificar()
	{
		if ($this->input->post("valida_imagen")!="") {
			if ($this->input->post("valida_imagen")!=1) {
				$foto=$_FILES["imagen"]["name"];
				$ruta=$_FILES["imagen"]["tmp_name"];
				$destino= "public/fotos/".$foto;
				copy($ruta, $destino);
			}else{
				$destino=$this->input->post("src_imagen");
			}
		}
		$data=  array(
			'nombre' => strtoupper($this->input->post("cliente")),
			'dni ' => $this->input->post("dni"),
			'ruc ' => $this->input->post("ruc"),
			'fecha' => date('Y-m-d H:i:s'),
			'direccion' => strtoupper($this->input->post("direccion")),
			'id_distritos' => $this->input->post("distrito"),
			'foto' => $destino,
		);
		$this->db->where("id_cliente",$this->input->post("id_cliente"));
		$this->db->update("cliente",$data); 
	}

	public function ruc_validar()
	{
		$ruta = "https://ruc.com.pe/api/beta/ruc";
		$token = "f89b6f5f-28fb-476a-bac2-a1a28b9c8566-9886c9be-ced1-44d7-8b49-760f36a656eb";
		$rucaconsultar = $this->input->post("id");
		$data = array(
			"token"	=> $token,
			"ruc"   => $rucaconsultar
		);
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $ruta);
		curl_setopt(
			$ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
			)
		);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$respuesta  = curl_exec($ch);
		curl_close($ch);

		$leer_respuesta = json_decode($respuesta, true);
		if (isset($leer_respuesta['errors'])) {
	//Mostramos los errores si los hay
			echo $leer_respuesta['errors'];
		} 
		echo json_encode($leer_respuesta);
	}	

	public function dni_validar()
	{
		require_once APPPATH . 'libraries/reniec/vendor/autoload.php';
		$reniecDni = new Tecactus\Reniec\DNI('DJq6wHc3b3Zf14eOuKNkEAQMM8RAVm4dJ03ztFAP');
		$dni = $reniecDni->get($this->input->post("id"), true);
		echo json_encode($dni);
	}

	public function inactivo()
	{
		$this->Proveedor_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select p.id_proveedor , p.descripcion,p.empresa,p.ruc,d.departamentos,e.estados from  proveedor as p INNER JOIN departamentos as d on (p.id_departamentos=d.id_departamentos) INNER JOIN estados as e on (p.estado=e.id_estados)  where (id_proveedor=".$this->input->post("id").")")->row();
		$dato["id_proveedor"]=$r->id_proveedor;
		$dato["descripcion"]=$r->descripcion;
		$dato["empresa"]=$r->empresa;
		$dato["ruc"]=$r->ruc;
		$dato["departamentos"]=$r->departamentos;
		$dato["estado"]=$r->estados;
		$dato["url"]=	base_url().'Proveedor_c/editar_proveedor/?id=';

		echo json_encode($dato);
	}

	public function activo()
	{
		$this->Proveedor_m->activo($this->input->post("id")); 
		$r = $this->db->query("select p.id_proveedor , p.descripcion,p.empresa,p.ruc,d.departamentos,e.estados from  proveedor as p INNER JOIN departamentos as d on (p.id_departamentos=d.id_departamentos) INNER JOIN estados as e on (p.estado=e.id_estados)  where (id_proveedor=".$this->input->post("id").")")->row();
		$dato["id_proveedor"]=$r->id_proveedor;
		$dato["descripcion"]=$r->descripcion;
		$dato["empresa"]=$r->empresa;
		$dato["ruc"]=$r->ruc;
		$dato["departamentos"]=$r->departamentos;
		$dato["estado"]=$r->estados;
		$dato["url"]=	base_url().'Proveedor_c/editar_proveedor/?id=';

		echo json_encode($dato);
	}

	public function distritos()
	{
		$r = $this->db->query("select * from distritos where(id_provincias=".$this->input->post("id").")")->result();

		echo json_encode($r);
	}

	public function provincias()
	{
		$r = $this->db->query("select * from provincias where(id_departamentos=".$this->input->post("id").")")->result();

		echo json_encode($r);
	}

}

?>