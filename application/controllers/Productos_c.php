<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Productos_m');
		$this->load->model('Principal_m');
	}

	public function index()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['productos'] = $this->Productos_m->productos();
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='11') {
				$entra=1;
			}
		}
		if($entra=='1'){	
			$this->load->view('productos/productos_v',$data);
		}else{
			redirect(site_url("Principal_c"));	
		}
	}

	public function pagina_agregar()
	{
		$data['precio_unidad'] = $this->Productos_m->unidad();
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$data['pack_tallas'] = $this->Productos_m->pack_tallas();		
		$data['marcas'] = $this->Productos_m->marcas();
		$data['categoria'] = $this->Productos_m->categoria();
		$data['pack_colores'] = $this->Productos_m->pack_colores();	
		$data['material'] = $this->Productos_m->material();	
		$data['almacen'] = $this->Productos_m->almacen();	
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='11') {
				$entra=1;
			}
		}
		if($entra=='1'){			
			$this->load->view('productos/agregar_v',$data);	 
		}else{
			redirect(site_url("Principal_c"));	
		}
	}
	
	public function agregar()
	{
		$foto=$_FILES["foto"]["name"];
		if ($foto!='') {
			$ruta=$_FILES["foto"]["tmp_name"];
			$destino= "public/foto/".$foto;
			copy($ruta, $destino); 
		}else{
			$destino="public/foto/logo.png";
		}
		$data=  array('descripcion' => strtoupper($this->input->post("nombre_producto")),
			'stock_minimo' => $this->input->post("cantidad_minima"),
			'fecha' => date('Y-m-d'),
			'id_marcas' => $this->input->post("marca"),
			'id_material' => $this->input->post("material"),
			'id_categoria' => $this->input->post("categoria"),
			'id_pack_color' => $this->input->post("colores"),
			'id_pack_tallas' => $this->input->post("tallas"),
			'foto' => $destino,
			'estado' => '1',
		);
		$this->db->insert("productos",$data);
		$r = $this->db->query("select max(id_productos) as id_productos from  productos")->row();
		$id=$r->id_productos;
		for ($i=0; $i <count($_POST['precio']) ; $i++) { 
			$datos = array(
				"id_producto" => $id,
				"id_unidad_medida" =>  $_POST['unidad'][$i],
				"precio" =>  $_POST['precio'][$i]
			);
			$r = $this->db->insert("unidad_producto",$datos);
		}
		for ($i=0; $i <count($_POST['cantidad']) ; $i++) { 
			$datos = array(
				"id_producto" => $id,
				"id_almacen" =>  $_POST['almacen'][$i],
				"cantidad" =>  $_POST['cantidad'][$i]
			);
			$r = $this->db->insert("almacen_productos",$datos);
		}
	}

	public function editar_productos()
	{
		$data['permisos'] = $this->Principal_m->traer_modulos();
		$r = $this->db->query("select CONCAT(p.descripcion,' ',m.descripcion,' ',c.descripcion,' ',ma.material) as con from  productos as p inner join marcas as m on p.id_marcas=m.id_marcas inner join categoria as c on p.id_categoria=c.id_categoria inner join material as ma on p.id_material=ma.id_material  where(id_productos=".$_GET['id'].")")->result();
		$data["titulo_producto"]=$r;
		$data['productos_editar'] = $this->Productos_m->productos_editar($_GET["id"]);
		$data['almacen_productos'] = $this->Productos_m->almacen_productos($_GET["id"]);
		$data['unidad_producto'] = $this->Productos_m->unidad_producto($_GET["id"]);
		$data['pack_tallas'] = $this->Productos_m->pack_tallas();		
		$data['marcas'] = $this->Productos_m->marcas();
		$data['material'] = $this->Productos_m->material();		
		$data['categoria'] = $this->Productos_m->categoria();
		$data['pack_colores'] = $this->Productos_m->pack_colores();
		$data['almacen'] = $this->Productos_m->almacen();
		$data['unidad'] = $this->Productos_m->unidad();	
		$r = $this->Principal_m->validar_modulos($_SESSION["idperfil"]);
		$entra=0;
		foreach ($r as $value) {
			if ($value->id_modulo=='11') {
				$entra=1;
			}
		}
		if($entra=='1'){		
			$this->load->view('productos/editar_v',$data);	 
		}else{
			redirect(site_url("Principal_c"));	
		}
	}	
	
	public function modificar()
	{	
		if ( $this->input->post("vali_foto")=='0') {
			$data=  array('descripcion' => strtoupper($this->input->post("nombre_producto")),
				'stock_minimo' => $this->input->post("cantidad_minima"),
				'id_marcas' => $this->input->post("marca"),
				'id_material' => $this->input->post("material"),
				'id_categoria' => $this->input->post("categoria"),
				'id_pack_color' => $this->input->post("colores"),
				'id_pack_tallas' => $this->input->post("tallas"),
				'fecha_modificar' => date('Y-m-d H:i:s'),
				'cambios' =>	$this->input->post("cambios")+1,
				'estado' => '1',
			);
			$this->db->where("id_productos",$this->input->post("id_productos"));
			$this->db->update("productos",$data);
		}else{
			$foto=$_FILES["foto"]["name"];
			$ruta=$_FILES["foto"]["tmp_name"];
			$destino= "public/foto/".$foto;
			copy($ruta, $destino); 
			$data=  array('descripcion' => strtoupper($this->input->post("nombre_producto")),
				'stock_minimo' => $this->input->post("cantidad_minima"),
				'id_marcas' => $this->input->post("marca"),
				'id_material' => $this->input->post("material"),
				'id_pack_color' => $this->input->post("colores"),
				'id_pack_tallas' => $this->input->post("tallas"),
				'id_categoria' => $this->input->post("categoria"),
				'fecha_modificar' => date('Y-m-d H:i:s'),
				'cambios' =>	$this->input->post("cambios")+1,
				'foto' => $destino,
				'estado' => '1',
			);
			$this->db->where("id_productos",$this->input->post("id_productos"));
			$this->db->update("productos",$data);
		}

		$this->db->where("id_producto",$this->input->post("id_productos"));
		$this->db->delete("unidad_producto");

		$this->db->where("id_producto",$this->input->post("id_productos"));
		$this->db->delete("almacen_productos");

		for ($i=0; $i <count($_POST['cantidad']) ; $i++) { 
			$datos = array(
				"id_producto" => $this->input->post("id_productos"),
				"id_almacen" =>  $_POST['almacen'][$i],
				"cantidad" =>  $_POST['cantidad'][$i]
			);
			$r = $this->db->insert("almacen_productos",$datos);
		}

		for ($i=0; $i <count($_POST['precio']) ; $i++) { 
			$datos = array(
				"id_producto" => $this->input->post("id_productos"),
				"id_unidad_medida" =>  $_POST['unidad'][$i],
				"precio" =>  $_POST['precio'][$i]
			);
			$r = $this->db->insert("unidad_producto",$datos);
		}
	}	

	public function eliminar()
	{
		$this->Productos_m->eliminar();
	}

	public function categoria()
	{
		$r = $this->db->query("select * from  categoria  where(id_categoria=".$this->input->post("id").")")->row();
		$dato["categoria"]=$r->descripcion;

		echo json_encode($dato);
	}

	public function marcas()
	{
		$r = $this->db->query("select * from  marcas  where(id_marcas=".$this->input->post("id").")")->row();
		$dato["marcas"]=$r->descripcion;

		echo json_encode($dato);
	}

	public function material()
	{
		$r = $this->db->query("select * from  material  where(id_material=".$this->input->post("id").")")->row();
		$dato["material"]=$r->material;

		echo json_encode($dato);
	}

	public function max_producto()
	{
		$r = $this->db->query("select max(id_productos)+1 as maximo from  productos  ")->row();
		$dato["id_productos"]=$r->maximo;

		echo json_encode($dato);
	}

	public function inactivo()
	{
		$this->Productos_m->inactivo($this->input->post("id")); 
		$r = $this->db->query("select p.id_productos , p.id_marcas,p.id_categoria,p.id_material,p.fecha, 
			p.descripcion,m.descripcion as marcas, c.descripcion as categoria,e.estados from  productos as p INNER JOIN marcas as m on (p.id_marcas=m.id_marcas) INNER JOIN categoria as c on (p.id_categoria=c.id_categoria)
			INNER JOIN estados as e on (p.estado=e.id_estados)  where (id_productos=".$this->input->post("id").")")->row();
		$f=$r->fecha;
		$anio=$f[0].$f[1].$f[2].$f[3];
		$mes=$f[5].$f[6];
		$dia=$f[8].$f[9];
		$dato["id_productos"]=$r->id_productos;
		$dato["codigo"]=$r->id_productos.$r->id_marcas.$r->id_categoria.$r->id_material.$anio.$mes.$dia;
		$dato["productos"]=$r->descripcion;
		$dato["fecha"]=$r->fecha;
		$dato["marcas"]=$r->marcas;
		$dato["categoria"]=$r->categoria;
		$dato["estado"]=$r->estados;
		$dato["url"]=	base_url().'Productos_c/editar_productos/?id=';
		
		echo json_encode($dato);
	}

	public function activo()
	{
		$this->Productos_m->activo($this->input->post("id")); 
		$r = $this->db->query("select p.id_productos , p.id_marcas,p.id_categoria,p.id_material,p.fecha, 
			p.descripcion,m.descripcion as marcas, c.descripcion as categoria,e.estados from  productos as p INNER JOIN marcas as m on (p.id_marcas=m.id_marcas) INNER JOIN categoria as c on (p.id_categoria=c.id_categoria)
			INNER JOIN estados as e on (p.estado=e.id_estados)  where (id_productos=".$this->input->post("id").")")->row();
		$f=$r->fecha;
		$anio=$f[0].$f[1].$f[2].$f[3];
		$mes=$f[5].$f[6];
		$dia=$f[8].$f[9];
		$dato["id_productos"]=$r->id_productos;
		$dato["codigo"]=$r->id_productos.$r->id_marcas.$r->id_categoria.$r->id_material.$anio.$mes.$dia;
		$dato["productos"]=$r->descripcion;
		$dato["fecha"]=$r->fecha;
		$dato["marcas"]=$r->marcas;
		$dato["categoria"]=$r->categoria;
		$dato["estado"]=$r->estados;
		$dato["url"]=	base_url().'Productos_c/editar_productos/?id=';
		
		echo json_encode($dato);
	}

	public function mostrar_producto()
	{
		$html='';
		$productos= $this->Productos_m->productos_ver($this->input->post("id"));
		$tallas_ver= $this->Productos_m->tallas_ver($this->input->post("id"));
		$precios_ver= $this->Productos_m->productos_precio($this->input->post("id"));
		$categoria= $this->Productos_m->categoria();
		$marcas= $this->Productos_m->marcas();
		
		foreach ($productos as  $value) {

			$html.='<div class="" style="background: #39f;">
			<div class="uk-text-center"  >';
			$html.= '<img src="'.base_url().$value->foto.'" style="margin-top:20px;border:3px solid white; border-radius:8px;width:80px;height:120px;" id="mostrar_imagen" height="100" width="100" title="'.$value->descripcion.'" alt="'.$value->descripcion.'"/>';
			$html.='</div>
			<h3 class="md-card-head-text uk-text-center" style="color: #fff;">
			'.$value->descripcion.'
			<span class="uk-text-truncate"></span>
			</h3>
			</div>
			<div class="md-card-content">
			<ul class="md-list">
			<li>
			<div class="md-list-content">
			<span class="md-list-heading"><b>INFORMACIÓN</b></span>
			</div>
			</li>';
			foreach ($categoria as  $valuen) {
				if ($value->id_categoria==$valuen->id_categoria) {
					$html.='<li>
					<div class="md-list-content" >
					<span class="md-list-heading">CATEGORIA</span>
					<span class="uk-text-small uk-text-muted">'.$valuen->descripcion.'</span>
					</div>
					</li>';
				} }
				foreach ($marcas as  $valuen) {
					if ($value->id_marcas==$valuen->id_marcas) {
						$html.='<li>
						<div class="md-list-content">
						<span class="md-list-heading">MARCA</span>';	
						$html.='<span class="uk-text-small uk-text-muted">'.$valuen->descripcion.'</span>';
						$html.='</div>
						</li>';
					} }
					$html.='<li>
					<div class="md-list-content">
					<span class="md-list-heading">TALLAS</span>';	
					$html.='<span class="uk-text-small uk-text-muted">';
					foreach ($tallas_ver as  $valuen) {
						$html.= $valuen->descripcion.'  ';
					}
					$html.='</span>';
					$html.='</div></li>';
					$html.='<li>
					<div class="md-list-content">
					<span class="md-list-heading">PRECIOS</span>';	
					$html.='<span class="uk-text-small uk-text-muted">';
					foreach ($precios_ver as  $valuen) {
						$html.= $valuen->unidad_medida.' S/.'.$valuen->precio.'<br>';
					}
					$html.='</span>';
					$html.='</div></li>';
					$html.='</ul>
					</div>';
				}	
				echo $html;
			}

			public	function codigo_barras(){

				$filepath = (isset($_GET["filepath"])?$_GET["filepath"]:"");
				$text = (isset($_GET["text"])?$_GET["text"]:"0");
				$size = (isset($_GET["size"])?$_GET["size"]:"20");
				$orientation = (isset($_GET["orientation"])?$_GET["orientation"]:"horizontal");
				$code_type = (isset($_GET["codetype"])?$_GET["codetype"]:"code128");
				$print = (isset($_GET["print"])&&$_GET["print"]=='true'?true:false);
				$sizefactor = (isset($_GET["sizefactor"])?$_GET["sizefactor"]:"1");

				// This function call can be copied into your project and can be made from anywhere in your code
				self::barcode( $filepath, $text, $size, $orientation, $code_type, $print, $sizefactor );
			}

			public	function barcode( $filepath="", $text="0", $size="20", $orientation="horizontal", $code_type="code128", $print=false, $SizeFactor=1 ) {
				$code_string = "";
	// Translate the $text into barcode the correct $code_type
				if ( in_array(strtolower($code_type), array("code128", "code128b")) ) {
					$chksum = 104;
		// Must not change order of array elements as the checksum depends on the array's key to validate final code
					$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
					$code_keys = array_keys($code_array);
					$code_values = array_flip($code_keys);
					for ( $X = 1; $X <= strlen($text); $X++ ) {
						$activeKey = substr( $text, ($X-1), 1);
						$code_string .= $code_array[$activeKey];
						$chksum=($chksum + ($code_values[$activeKey] * $X));
					}
					$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

					$code_string = "211214" . $code_string . "2331112";
				} elseif ( strtolower($code_type) == "code128a" ) {
					$chksum = 103;
		$text = strtoupper($text); // Code 128A doesn't support lower case
		// Must not change order of array elements as the checksum depends on the array's key to validate final code
		$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","NUL"=>"111422","SOH"=>"121124","STX"=>"121421","ETX"=>"141122","EOT"=>"141221","ENQ"=>"112214","ACK"=>"112412","BEL"=>"122114","BS"=>"122411","HT"=>"142112","LF"=>"142211","VT"=>"241211","FF"=>"221114","CR"=>"413111","SO"=>"241112","SI"=>"134111","DLE"=>"111242","DC1"=>"121142","DC2"=>"121241","DC3"=>"114212","DC4"=>"124112","NAK"=>"124211","SYN"=>"411212","ETB"=>"421112","CAN"=>"421211","EM"=>"212141","SUB"=>"214121","ESC"=>"412121","FS"=>"111143","GS"=>"111341","RS"=>"131141","US"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","CODE B"=>"114131","FNC 4"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
		$code_keys = array_keys($code_array);
		$code_values = array_flip($code_keys);
		for ( $X = 1; $X <= strlen($text); $X++ ) {
			$activeKey = substr( $text, ($X-1), 1);
			$code_string .= $code_array[$activeKey];
			$chksum=($chksum + ($code_values[$activeKey] * $X));
		}
		$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

		$code_string = "211412" . $code_string . "2331112";
	} elseif ( strtolower($code_type) == "code39" ) {
		$code_array = array("0"=>"111221211","1"=>"211211112","2"=>"112211112","3"=>"212211111","4"=>"111221112","5"=>"211221111","6"=>"112221111","7"=>"111211212","8"=>"211211211","9"=>"112211211","A"=>"211112112","B"=>"112112112","C"=>"212112111","D"=>"111122112","E"=>"211122111","F"=>"112122111","G"=>"111112212","H"=>"211112211","I"=>"112112211","J"=>"111122211","K"=>"211111122","L"=>"112111122","M"=>"212111121","N"=>"111121122","O"=>"211121121","P"=>"112121121","Q"=>"111111222","R"=>"211111221","S"=>"112111221","T"=>"111121221","U"=>"221111112","V"=>"122111112","W"=>"222111111","X"=>"121121112","Y"=>"221121111","Z"=>"122121111","-"=>"121111212","."=>"221111211"," "=>"122111211","$"=>"121212111","/"=>"121211121","+"=>"121112121","%"=>"111212121","*"=>"121121211");

		// Convert to uppercase
		$upper_text = strtoupper($text);

		for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
			$code_string .= $code_array[substr( $upper_text, ($X-1), 1)] . "1";
		}

		$code_string = "1211212111" . $code_string . "121121211";
	} elseif ( strtolower($code_type) == "code25" ) {
		$code_array1 = array("1","2","3","4","5","6","7","8","9","0");
		$code_array2 = array("3-1-1-1-3","1-3-1-1-3","3-3-1-1-1","1-1-3-1-3","3-1-3-1-1","1-3-3-1-1","1-1-1-3-3","3-1-1-3-1","1-3-1-3-1","1-1-3-3-1");

		for ( $X = 1; $X <= strlen($text); $X++ ) {
			for ( $Y = 0; $Y < count($code_array1); $Y++ ) {
				if ( substr($text, ($X-1), 1) == $code_array1[$Y] )
					$temp[$X] = $code_array2[$Y];
			}
		}

		for ( $X=1; $X<=strlen($text); $X+=2 ) {
			if ( isset($temp[$X]) && isset($temp[($X + 1)]) ) {
				$temp1 = explode( "-", $temp[$X] );
				$temp2 = explode( "-", $temp[($X + 1)] );
				for ( $Y = 0; $Y < count($temp1); $Y++ )
					$code_string .= $temp1[$Y] . $temp2[$Y];
			}
		}

		$code_string = "1111" . $code_string . "311";
	} elseif ( strtolower($code_type) == "codabar" ) {
		$code_array1 = array("1","2","3","4","5","6","7","8","9","0","-","$",":","/",".","+","A","B","C","D");
		$code_array2 = array("1111221","1112112","2211111","1121121","2111121","1211112","1211211","1221111","2112111","1111122","1112211","1122111","2111212","2121112","2121211","1121212","1122121","1212112","1112122","1112221");

		// Convert to uppercase
		$upper_text = strtoupper($text);

		for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
			for ( $Y = 0; $Y<count($code_array1); $Y++ ) {
				if ( substr($upper_text, ($X-1), 1) == $code_array1[$Y] )
					$code_string .= $code_array2[$Y] . "1";
			}
		}
		$code_string = "11221211" . $code_string . "1122121";
	}

	// Pad the edges of the barcode
	$code_length = 20;
	if ($print) {
		$text_height = 30;
	} else {
		$text_height = 0;
	}
	
	for ( $i=1; $i <= strlen($code_string); $i++ ){
		$code_length = $code_length + (integer)(substr($code_string,($i-1),1));
	}

	if ( strtolower($orientation) == "horizontal" ) {
		$img_width = $code_length*$SizeFactor;
		$img_height = $size;
	} else {
		$img_width = $size;
		$img_height = $code_length*$SizeFactor;
	}

	$image = imagecreate($img_width, $img_height + $text_height);
	$black = imagecolorallocate ($image, 0, 0, 0);
	$white = imagecolorallocate ($image, 255, 255, 255);

	imagefill( $image, 0, 0, $white );
	if ( $print ) {
		imagestring($image, 5, 31, $img_height, $text, $black );
	}

	$location = 10;
	for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
		$cur_size = $location + ( substr($code_string, ($position-1), 1) );
		if ( strtolower($orientation) == "horizontal" )
			imagefilledrectangle( $image, $location*$SizeFactor, 0, $cur_size*$SizeFactor, $img_height, ($position % 2 == 0 ? $white : $black) );
		else
			imagefilledrectangle( $image, 0, $location*$SizeFactor, $img_width, $cur_size*$SizeFactor, ($position % 2 == 0 ? $white : $black) );
		$location = $cur_size;
	}
	
	// Draw barcode to the screen or save in a file
	if ( $filepath=="" ) {
		header ('Content-type: image/png');
		imagepng($image);
		imagedestroy($image);
	} else {
		imagepng($image,$filepath);
		imagedestroy($image);		
	}
}
}

?>