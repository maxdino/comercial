<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ventas_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ventas_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['ventas'] = $this->Ventas_m->ventas();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='22') {
				$entra=1;
			}
		}
		if($entra=='1'){
			$this->load->view('ventas/ventas_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function factura()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['clientes'] = $this->Ventas_m->clientes();
		$data['almacen'] = $this->Ventas_m->almacen();
		$data['departamentos'] = $this->Ventas_m->departamentos();	
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='22') {
				$entra=1;
			}
		}
		if($entra=='1'){		
			$this->load->view('ventas/factura_v',$data);	 
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar_factura()
	{
		$data=  array(
			'id_cliente' => strtoupper($this->input->post("cliente_escoger")),
			'id_tipo_comprobante' => '1',
			'monto' => strtoupper($this->input->post("direccion")),
			'igv' => $this->input->post("igv_actual"),
			'descuento' => $this->input->post("descuento"),
			'nro_serie' => $destino,//falta corregir
			'fecha' => date('Y-m-d H:i:s'),
			'id_usuario' => $_SESSION["id_usuario"],
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
			if ($value->id_modulo=='22') {
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

	public function productos_escoger()
	{	
		$r = $this->db->query("select id_productos as value,descripcion as text from productos ")->result();
		echo json_encode($r);
	}

	public function cliente_escoger()
	{	
		$r = $this->db->query("select id_cliente as value,nombre as text from cliente WHERE ruc!='' ORDER BY nombre asc")->result();
		echo json_encode($r);
	}

	public function precios()
	{	
		$r = $this->db->query("select up.id_unidad_medida,up.precio, um.unidad_medida,up.id_producto from unidad_producto as up inner join unidad_medida as um on um.id_unidad_medida=up.id_unidad_medida where up.id_producto=".$this->input->post("id"))->result();
		echo json_encode($r);
	}

	public function agregar_cliente()
	{	
		$data=  array(
			'nombre' => strtoupper($this->input->post("add_nombre")),
			'dni ' => $this->input->post("add_dni"),
			'ruc ' => $this->input->post("add_ruc"),
			'id_distritos' => $this->input->post("distritos"),
			'fecha' => date('Y-m-d H:i:s'),
			'direccion' => strtoupper($this->input->post("add_direccion")),
		);
		$this->db->insert("cliente",$data);
		$r = $this->db->query("select max(id_cliente) as id_cliente from cliente WHERE ruc!='' ORDER BY nombre asc")->row();
		$r1 = $this->db->query("select id_cliente as value,nombre as text,direccion,ruc   from cliente WHERE ruc!='' and id_cliente=".$r->id_cliente." ORDER BY nombre asc")->row();
		echo json_encode($r1);
	}

	public function distritos()
	{
		$r = $this->db->query("select * from distritos where(id_provincias=".$this->input->post("id").") order by distritos")->result();
		echo json_encode($r);
	}

	public function provincias()
	{
		$r = $this->db->query("select * from provincias where(id_departamentos=".$this->input->post("id").") order by provincias")->result();
		echo json_encode($r);
	}

	public function cliente()
	{
		$r = $this->db->query("select * from cliente where(id_cliente=".$this->input->post("id").") ")->row();
		echo json_encode($r);
	}

	public function precio_seleccionado()
	{
		$r = $this->db->query("select * from unidad_producto where(id_unidad_medida=".$this->input->post("id").") and (id_producto=".$this->input->post("id_producto").") ")->row();
		echo json_encode($r);
	}

	public function agregar_tabla()
	{
		$r = $this->db->query("select * from unidad_producto as up inner join productos as p on  up.id_producto = p.id_productos  inner join unidad_medida as um on up.id_unidad_medida=um.id_unidad_medida where(up.id_producto=".$this->input->post("id").") and (up.id_unidad_medida=".$this->input->post("uni").")")->row();
		$data['id_productos']=$r->id_productos;
		$data['descripcion']=$r->descripcion;
		$data['id_unidad_medida']=$r->id_unidad_medida;
		$data['unidad_medida']=$r->unidad_medida;
		echo json_encode($data);
	}
}

?>