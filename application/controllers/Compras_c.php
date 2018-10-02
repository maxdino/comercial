<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compras_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Principal_m');
		$this->load->model('Producto_m');
		$this->load->model('Compras_m');
	}

	public function traer_stock()
	{

		$row = $this->db->get_where("almacen_producto",array("id_producto"=>$_POST["idproducto"],
			"id_almacen"=>$_POST["idalmacen"]))->row();

		if( $row->stock==''){
			
		$data["stok"] = "0";

		}else{
		$data["stok"] =$row->stock;
		}

		echo json_encode($data);
 



	}

	public function traer_proveedores()
	{
		// consulta para saber la fecha de la ultima compra que hizo a ese proveedor
		$array = array();
		$ultima_fecha = $this->db->query("select max(c.fecha) as ultima_fecha,c.id_proveedor from compras as c
						inner join proveedor as p on(c.id_proveedor=p.id_proveedor)
						inner join compras_producto as cp on(cp.id_compras=c.id_compras)
						inner join producto as pr on(pr.id_producto=cp.id_producto)
						where c.estado=0 and cp.id_producto=".$this->input->post('idproducto')."
						group by c.id_proveedor
						")->result();
		$i = 0;
		if(count($ultima_fecha)>0) {

			foreach ($ultima_fecha as $key => $value) {
				$rstl = $this->db->query("SELECT
				proveedor.razon_social,
				compras_producto.precio_unitario
				FROM
				compras_producto
				INNER JOIN producto ON producto.id_producto = compras_producto.id_producto
				INNER JOIN compras ON compras.id_compras = compras_producto.id_compras
				INNER JOIN proveedor ON proveedor.id_proveedor = compras.id_proveedor
				where producto.id_producto=".$this->input->post("idproducto")." and compras.id_proveedor=".$value->id_proveedor." and compras.fecha='".$value->ultima_fecha."' group by proveedor.razon_social,
				compras_producto.precio_unitario")->row();

				$array[$i]["razon_social"] = $rstl->razon_social;
				$array[$i]["precio_unitario"] = $rstl->precio_unitario;
				$i++;
			}
		}

		if(count($array)>0){
			$array["ok"] = 1;
		}else{
			$array["ok"] = 0;
		}
		echo json_encode($array);

	}

	public function desencriptar($array,$campos)
	{
		$select = array('""'=>"Seleccione");

		if(count($array)>0) {
			foreach ($array as $value) {

				$select[$value->$campos[0]] = $value->$campos[1];
			}
		}

		return $select;
	}

	public function index(){
		$permisos = $this->Principal_m->traer_modulos();
		$compras = $this->Compras_m->traer_compras();
		$proveedor = $this->Compras_m->proveedor();
		$empleado = $this->Compras_m->empleado();
		$transaccion = $this->Compras_m->modalidad_transaccion();

		$data["transaccion"] = $transaccion;
		$data["empleado"] = $empleado;
		$data["permisos"] = $permisos;
		$data["compras"] = $compras;
		$data["proveedor"] = $proveedor;
		$this->load->view('Compras/compras_v.php',$data);
	}


	public function traer_provincias()
	{
		$array = $this->db->group_by("Provincia")->get_where("ubigeo",array("Departamento"=>$this->input->post("departamento")))->result();
		$provincias = $this->desencriptar($array,["Provincia","Provincia"]);

		echo form_dropdown('', $provincias, '""', 'class="form-control" id="provincia" required');
	}

	public function traer_distritos()
	{
		$array = $this->db->get_where("ubigeo",array("Provincia"=>$this->input->post("provincia")))->result();
		$distritos = $this->desencriptar($array,["id_ubigeo","Distrito"]);

		echo form_dropdown('distrito', $distritos, '""', 'class="form-control" id="distrito" required');
	}

	public function nuevo(){
		$data["almacen"] = $this->Producto_m->almacen_producto();
		$data["departamentos"] = $this->desencriptar($this->db->group_by("Departamento")->get("ubigeo")->result(),["Departamento","Departamento"]);
		$data["marcas"] = $this->desencriptar($this->db->get_where("marca",array("estado"=>"1"))->result(),["id_marca","descripcion"]);
		$data["categorias"] = $this->desencriptar($this->db->get_where("categoria_producto",array("estado"=>"1"))->result(),["id_categoria_producto","descripcion"]);
		$permisos = $this->Principal_m->traer_modulos();
		$producto = $this->Compras_m->traer_productos();
		$producto2 = $this->Compras_m->traer_productos2();
		$transaccion = $this->Compras_m->modalidad_transaccion();
		$almacen_disponible = $this->Compras_m->almacen();
		$data["almacen_disponible"] = $almacen_disponible;
		$data["producto2"] = $producto2;
		$data["permisos"] = $permisos;
		$data["producto"] = $producto;
		$data["transaccion"] = $transaccion;

		$this->load->view('Compras/nuevo_v.php',$data);
	}


	public function registrar(){

		$registrar = $this->Compras_m->registrar();


	}
	public function ver(){

		$compra = $this->Compras_m->ver_compra($this->input->post("id_compras"));
		$compra_producto = $this->Compras_m->ver_compra_producto($this->input->post("id_compras"));
		$datos['compra']=$compra;
		$datos['compra_producto']=$compra_producto;
		$this->load->view('Compras/compras_ver_v.php',$datos);

	}

	public function correlativo(){
		if($this->input->post("id_tipo_documento")==1 || $this->input->post("id_tipo_documento")==2 || $this->input->post("id_tipo_documento")==3 ){
			$datos = $this->Ventas_m->correlativo();
			foreach ($datos as  $value) {
				if($value->numero == $value->max_numero){
					$codigo = $this->number_code(intval($value->codigo)+1,3).'-'.$this->number_code(1,7);
					echo $codigo;
				}else{
					$codigo = $this->number_code(intval($value->codigo),3).'-'.$this->number_code(intval($value->numero)+1,7);
					echo $codigo;
				}
			}
		}else{
			echo " ";
		}
	}

	public function number_code($number,$tam=0){
        $data="";
        $comodin="0";
        for($i=0;$i<$tam-strlen($number);$i++){
            $data.=$comodin;
        }
        $data.=$number;
        return $data;
    }
	public function paquetes(){

		$datos = $this->Ventas_m->paquetes();
		sleep(1);
		echo json_encode($datos);
	}

	public function productos(){
		$datos = $this->Ventas_m->productos();
		sleep(1);
		echo json_encode($datos);
	}
	public function parm(){
		$datos = $this->Compras_m->parm();
		foreach ($datos as $value) {
			$igv = $value->valor;
		}
		echo $igv;
	}

	public function eliminar(){
		$compras = $this->Compras_m->eliminar($this->input->post("id_compras"));
		$this->listar();exit;
	}


public function listar(){
		$html = '';
		$compras = $this->Compras_m->mostrar();
		$transaccion = $this->Compras_m->modalidad_transaccion();
		$proveedor = $this->Compras_m->proveedor();
		$empleado = $this->Compras_m->empleado();
		//print_r($tiposocios);
		foreach ($compras as $value){

		foreach ($transaccion as $values){
			if ($value->id_modalidad_transaccion==$values->id_modalidad_transaccion) {
				$transa=$values->descripcion;
			}
}
		foreach ($proveedor as $values1){
			if ($value->id_proveedor==$values1->id_proveedor) {
				$prove=$values1->razon_social;
			}
}
		foreach ($empleado as $values2){
			if ($value->id_empleado==$values2->id_empleado) {
				$emple=$values2->nombre.' '.$values2->apellido_paterno;
			}
}
	
		$html.= '<tr>
					<td> '.$value->id_compras.' </td>
					<td> '.$value->fecha.'</td>
					<td> '.$prove.'</td>
					<td> '.$emple.'</td>
					<td> '.$transa.'</td>
					<td> '.$value->monto.'</td>
					<td class="center">
						<div class="visible-md visible-lg hidden-sm hidden-xs">
						<a onclick=ver('.$value->id_compras.') class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="ver"><i class="fa fa-edit"></i></a>';
						if($value->estado == 1){
					$html.= '<a onclick=Eliminar('.$value->id_compras.') class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-times fa fa-white"></i></a>';
						}
					$html.='	</div>
						<div class="visible-xs visible-sm hidden-md hidden-lg">
							<div class="btn-group">
								<a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
								<i class="fa fa-cog"></i> <span class="caret"></span>
								</a>
								<ul role="menu" class="dropdown-menu pull-right dropdown-dark">
									<li>
										
									</li>
									<li>
										<a role="menuitem" tabindex="-1"  onclick="Eliminar('.$value->id_compras.')" data-toggle="modal" class="btn btn-xs btn-red tooltips" data-placement="top" >
										<i class="fa fa-times"></i> Eliminar
										</a>
									</li>
								</ul>
							</div>
						</div>
					</td>
				</tr>';
	
		}
		echo $html;
	}




}



?>