<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compra_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Compra_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{

		if(isset($_SESSION["user"])){ 
			$data['permisos'] = $this->Principal_m->traer_modulos();
			$data['compra'] = $this->Compra_m->compra();
			$this->load->view('compra/compra_v',$data);
		}else{
			redirect(site_url("Portal_c"));	
		}
	}

	public function formato()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$this->load->view('compra/formatos_v',$data);
	}

	public function factura()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['proveedor'] = $this->Compra_m->proveedor();	
		$data['unidad'] = $this->Compra_m->unidad();
		$data['almacen'] = $this->Compra_m->almacen();
		$this->load->view('compra/factura_v',$data);
	}

	public function boleta()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['proveedor'] = $this->Compra_m->proveedor();	
		$data['unidad'] = $this->Compra_m->unidad();
		$this->load->view('compra/boleta_v',$data);
	}

	public function pagina_agregar()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['proveedor'] = $this->Compra_m->proveedor();	
		$data['unidad'] = $this->Compra_m->unidad();
		$data['tipo_comprobante'] = $this->Compra_m->tipo_comprobante();
		$this->load->view('compra/agregar_v',$data);	 
	}

	public function agregar()
	{
		
		$data=  array('comprador' => strtoupper($this->input->post("nombre_comprador")),
			'direccion' => strtoupper($this->input->post("direccion")),
			'ruc' => $this->input->post("ruc"),
			'fecha_compra' => $this->input->post("fecha_compra"),
			'id_tipo_comprobante' => strtoupper($this->input->post("tipo_comprobante")),
			'subtotal' => $this->input->post("subtotal"),
			'igv' => $this->input->post("igv_actual"),
			'descuento' => $this->input->post("descuento"),
			'id_proveedor' => $this->input->post("proveedor"),
			'nro_factura' => $this->input->post("nro_comprobante"),
			'fecha' => date('Y-m-d'),
			'id_usuario' => $_SESSION["id_usuario"],
			'estado' => '1',
		);
		$this->db->insert("compra",$data);

		for ($i=0; $i <count($_POST['id_productos']) ; $i++) { 
			$r = $this->Compra_m->validar_producto($_POST['id_productos'][$i],$this->input->post("almacen"));
			if(!$r){
				$data=  array(
					'id_producto' => $_POST['id_productos'][$i],
					'id_almacen' => $this->input->post("almacen"),
					'cantidad' => $_POST['cantidad_comprada'][$i],
				);
				$this->db->insert("almacen_productos",$data);
			}else{
				$can = $this->db->query("select * from almacen_productos where id_producto=".$_POST['id_productos'][$i]." and id_almacen=".$this->input->post("almacen"))->row();
				$data=  array(
					'id_producto' => $_POST['id_productos'][$i],
					'id_almacen' => $this->input->post("almacen"),
					'cantidad' => $_POST['cantidad_comprada'][$i] + $can->cantidad,
				);
				$this->db->where("id_producto",$_POST['id_productos'][$i]);
				$this->db->where("id_almacen",$this->input->post("almacen"));
				$this->db->update("almacen_productos",$data);
			}
			$compra_mayor = $this->db->query("select max(id_compra) as mayor from compra ")->row();
			$data=  array(
				'id_productos' => $_POST['id_productos'][$i],
				'id_compras' => $compra_mayor->mayor,
				'precio' => $_POST['precio_producto'][$i],
				'cantidad' => $_POST['cantidad_comprada'][$i],
				'id_unidad_medida' => $_POST['unidad_medida'][$i],
			);
			$this->db->insert("productos_compra",$data);
		}
	}

	public function editar_compra()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['compra'] = $this->Compra_m->compra_editar($_GET["id"]);	
		$data['departamentos'] = $this->Compra_m->departamentos();
		$data['provincias'] = $this->Compra_m->provincias_ver();
		$data['distritos'] = $this->Compra_m->distritos_ver();		
		$this->load->view('compra/editar_v',$data);	 
	}	

	public function modificar()
	{

		if ($this->input->post("activar")!='1') {
			$estado='0';
		}else{
			$estado='1';
		}	
		if ($this->input->post("valida_imagen")!=1) {
			$foto=$_FILES["imagen"]["name"];
			$ruta=$_FILES["imagen"]["tmp_name"];
			$destino= "public/fotos/".$foto;
			copy($ruta, $destino);
		}else{
			$destino=$this->input->post("src_imagen");
		}
		$data=  array('descripcion' => strtoupper($this->input->post("compra")),
			'empresa ' => strtoupper($this->input->post("empresa")),
			'fecha' => date('Y-m-d'),
			'correo' => $this->input->post("correo"),
			'direccion' => strtoupper($this->input->post("direccion")),
			'telefono' => $this->input->post("telefono"),
			'celular' => $this->input->post("celular"),
			'id_departamentos' => $this->input->post("departamento"),
			'id_provincias' => $this->input->post("provincia"),
			'id_distritos' => $this->input->post("distrito"),
			'facebook' => $this->input->post("facebook"),
			'twitter' => $this->input->post("twitter"),
			'linkdin' => $this->input->post("linkdin"),
			'google' => $this->input->post("google"),
			'foto' => $destino,
			'estado' => $estado,
		);
		$this->db->where("id_compra",$this->input->post("id_compra"));
		$this->db->update("compra",$data); 
		
	}

	public function eliminar_compra()
	{
		$r = $this->db->query("select * from  compra  where(id_compra=".$this->input->post("id").")")->row();
		$dato["id_compra"]=$r->id_compra;

		echo json_encode($dato);
	}

	public function eliminar()
	{
		$this->Compra_m->eliminar();
	}

	public function productos_escoger()
	{	

		$r = $this->db->query("select id_productos as value,descripcion as text from productos ")->result();
		echo json_encode($r);
	}

	public function cantidad_producto()
	{
		$r = $this->db->query("select stock from productos where(id_productos=".$this->input->post("id").")")->row();
		$data['stock']=$r->stock;
		echo json_encode($data);
	}

	public function agregar_tabla()
	{
		$r = $this->db->query("select * from productos,unidad_medida where(id_productos=".$this->input->post("id").") and (id_unidad_medida=".$this->input->post("uni").")")->row();
		$data['id_productos']=$r->id_productos;
		$data['descripcion']=$r->descripcion;
		$data['id_unidad_medida']=$r->id_unidad_medida;
		$data['unidad_medida']=$r->unidad_medida;
		echo json_encode($data);
	}

	public function mostrar_comprobante($id)
	{
		$data['proveedor'] = $this->Compra_m->proveedor();	
		$data['unidad'] = $this->Compra_m->unidad();
		$data['tipo_comprobante'] = $this->Compra_m->tipo_comprobante();
		switch ($id) {
			case 1:
			$this->load->view('compra/factura_v',$data);
			break;
			case 3:
			$this->load->view('compra/boleta_v',$data);
			break;
			case 9:
			$this->load->view('compra/guia_remision_v',$data);
			break;
		}
		
	}

	public function mostrar_compra()
	{
		$html='';
		$compra= $this->Compra_m->compra_ver($this->input->post("id"));
		foreach ($compra as  $value) {

			$html.='<div class="md-card-head">

			<div class="uk-text-center">
			<img class="md-card-head-avatar" src="'.base_url().$value->foto.'" />
			</div>
			<h3 class="md-card-head-text uk-text-center">
			'.$value->descripcion.'
			<span class="uk-text-truncate">'.$value->empresa.'</span>
			</h3>
			</div>
			<div class="md-card-content">
			<ul class="md-list">
			<li>
			<div class="md-list-content">
			<span class="md-list-heading">INFORMACIÓN</span>
			</div>
			</li>
			<li>
			<div class="md-list-content">
			<span class="md-list-heading">UBICACIÓN</span>
			<span class="uk-text-small uk-text-muted">'.$value->departamentos.' - '.$value->provincias.' - '.$value->distritos.'</span>
			</div>
			</li>
			<li>
			<div class="md-list-content">
			<span class="md-list-heading">TELEFONO</span>
			<span class="uk-text-small uk-text-muted">'.$value->telefono.'</span>
			</div>
			</li>
			<li>
			<div class="md-list-content">
			<span class="md-list-heading">CELULAR</span>
			<span class="uk-text-small uk-text-muted">'.$value->celular.'</span>
			</div>
			</li>
			<li>
			<div class="md-list-content">
			<span class="md-list-heading">Email</span>
			<span class="uk-text-small uk-text-muted uk-text-truncate">'.$value->correo.'</span>
			</div>
			</li>
			<li>
			<div class="md-list-content">
			<span class="md-list-heading">DIRECCIÓN</span>
			<span class="uk-text-small uk-text-muted uk-text-truncate">'.$value->direccion.'</span>
			</div>
			</li>
			</ul>
			</div>';
		}

		
		echo $html;
	}
}

?>