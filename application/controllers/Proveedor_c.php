<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Proveedor_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['proveedor'] = $this->Proveedor_m->proveedor();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='14') {
				$entra=1;
			}
		}
		if($entra=='1'){
			$this->load->view('proveedor/proveedor_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}


	public function pagina_agregar()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['departamentos'] = $this->Proveedor_m->departamentos();	
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='14') {
				$entra=1;
			}
		}
		if($entra=='1'){		
			$this->load->view('proveedor/agregar_v',$data);	 
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function agregar()
	{
		if ($this->input->post("activar")!='1') {
			$estado='0';
		}else{
			$estado='1';
		}	
		if ($_FILES["imagen"]["name"]!='') {
			$foto=$_FILES["imagen"]["name"];
			$ruta=$_FILES["imagen"]["tmp_name"];
			$destino= "public/fotos/".$foto;
			copy($ruta, $destino); 
		}else{
			$destino='';
		}

		$data=  array('descripcion' => strtoupper($this->input->post("proveedor")),
			'empresa ' => strtoupper($this->input->post("empresa")),
			'ruc ' => $this->input->post("ruc"),
			'fecha' => date('Y-m-d'),
			'correo' => $this->input->post("correo"),
			'direccion' => strtoupper($this->input->post("direccion")),
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
		$this->db->insert("proveedor",$data);
		$proveedor = $this->db->query("select max(id_proveedor) as proveedor from proveedor ")->row();
		for ($i=0; $i <count($_POST['telefono']) ; $i++) { 
			if ($_POST['telefono'][$i]!='') {
				$data=  array(
					'id_proveedor' => $proveedor->proveedor,
					'tipo_telefono' => '1',
					'telefono' => $_POST['telefono'][$i],
				);
				$this->db->insert("telefono",$data);
			}
		}
		for ($i=0; $i <count($_POST['celular']) ; $i++) { 
			if ($_POST['celular'][$i]!='') {
				$data=  array(
					'id_proveedor' => $proveedor->proveedor,
					'tipo_telefono' => '2',
					'telefono' => $_POST['celular'][$i],
				);
				$this->db->insert("telefono",$data);
			}
		}
	}

	public function editar_proveedor()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['proveedor'] = $this->Proveedor_m->proveedor_editar($_GET["id"]);	
		$data['telefono'] = $this->Proveedor_m->telefono_editar($_GET["id"]);
		$data['departamentos'] = $this->Proveedor_m->departamentos();
		$data['provincias'] = $this->Proveedor_m->provincias_ver();
		$data['distritos'] = $this->Proveedor_m->distritos_ver();	
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='14') {
				$entra=1;
			}
		}
		if($entra=='1'){	
			$this->load->view('proveedor/editar_v',$data);	 
		}else{
			redirect(site_url("Principal_c"));	
		}
	}	

	public function modificar()
	{

		if ($this->input->post("activar")!='1') {
			$estado='0';
		}else{
			$estado='1';
		}	
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
		$data=  array('descripcion' => strtoupper($this->input->post("proveedor")),
			'empresa ' => strtoupper($this->input->post("empresa")),
			'ruc ' => $this->input->post("ruc"),
			'fecha' => date('Y-m-d'),
			'correo' => $this->input->post("correo"),
			'direccion' => strtoupper($this->input->post("direccion")),
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
		$this->db->where("id_proveedor",$this->input->post("id_proveedor"));
		$this->db->update("proveedor",$data); 

		$this->db->where("id_proveedor",$this->input->post("id_proveedor"));
		$this->db->delete("telefono");

		for ($i=0; $i <count($_POST['telefono']) ; $i++) { 

			if ($_POST['telefono'][$i]!='') {
				$data=  array(
					'id_proveedor' => $this->input->post("id_proveedor"),
					'tipo_telefono' => '1',
					'telefono' => $_POST['telefono'][$i],
				);
				$this->db->insert("telefono",$data);
			}
		}
		for ($i=0; $i <count($_POST['celular']) ; $i++) { 
			if ($_POST['celular'][$i]!='') {
				$data=  array(
					'id_proveedor' => $this->input->post("id_proveedor"),
					'tipo_telefono' => '2',
					'telefono' => $_POST['celular'][$i],
				);
				$this->db->insert("telefono",$data);
			}
		}
	}

	public function ruc_validar()
	{
		$ruta = "https://ruc.com.pe/api/beta/ruc";
		$token = "0deec402-5836-4bc4-a5dc-515d8b6337db-3b42a158-b288-4fba-8675-fd3530e05076";
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


	public function mostrar_proveedor()
	{
		$html='';
		$proveedor= $this->Proveedor_m->proveedor_ver($this->input->post("id"));
		$telefono= $this->Proveedor_m->telefono_ver($this->input->post("id"));
		$val_cel= $this->Proveedor_m->validar_celular($this->input->post("id"));
		$val_tel= $this->Proveedor_m->validar_telefono($this->input->post("id"));
		foreach ($proveedor as  $value) {
			$html.='<div class="md-card-head" style="background: #39f;">
			<div class="uk-text-center"  >';
			if($value->foto==''){
				$html.= '<img src="'.base_url().'public/assets/img/avatars/user.png" id="mostrar_imagen" alt="user avatar"/>';
			}else{
				$html.= '<img class="md-card-head-avatar" src="'.base_url().$value->foto.'" />';
			}
			$html.='</div>
			<h3 class="md-card-head-text uk-text-center" style="color: #fff;">
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
			<li >
			<div class="md-list-content" >
			<span class="md-list-heading">UBICACIÓN</span>
			<span class="uk-text-small uk-text-muted">'.$value->departamentos.' - '.$value->provincias.' - '.$value->distritos.'</span>
			</div>
			</li>';
			if(count($val_tel)>0){
				$html.='<li>
				<div class="md-list-content">
				<span class="md-list-heading">TELEFONO</span>';
				foreach ($telefono as  $values) {
					if ($values->tipo_telefono=='1') {
						$html.='<span class="uk-text-small uk-text-muted">'.$values->telefono.'</span>';
					}	}
					$html.='</div>
					</li>';
				}
				if(count($val_cel)>0){
					$html.='<li>
					<div class="md-list-content">
					<span class="md-list-heading">CELULAR</span>';
					foreach ($telefono as  $values) {
						if ($values->tipo_telefono=='2') {
							$html.='<span class="uk-text-small uk-text-muted">'.$values->telefono.'</span>';
						}	}
						$html.='</div>
						</li>';
					}
					if($value->correo!=''){
						$html.='<li>
						<div class="md-list-content">
						<span class="md-list-heading">Email</span>
						<span class="uk-text-small uk-text-muted uk-text-truncate">'.$value->correo.'</span>
						</div>
						</li>';
					}
					if($value->direccion!=''){
						$html.='<li>
						<div class="md-list-content">
						<span class="md-list-heading">DIRECCIÓN</span>
						<span class="uk-text-small uk-text-muted uk-text-truncate">'.$value->direccion.'</span>
						</div>
						</li>';
					}
					$html.='</ul>
					</div>';
				}
				echo $html;
			}
		}

		?>