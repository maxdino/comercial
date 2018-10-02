<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="es"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Remove Tap Highlight on Windows Phone IE -->
	<meta name="msapplication-tap-highlight" content="no"/>
	<title>COMERCIAL HILARIO</title>
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/foto/logo/logo_3.png" sizes="16x16">
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/foto/logo/logo_3.png" sizes="32x32">
	<?php include('public/css.inc');?>
	<style type="text/css">
	.fila:hover{
		background: #3c76d23b;
	}
</style>
<body class=" sidebar_main_open sidebar_main_swipe">
	<?php include('includes/menu.inc');?>  
	<h3 class="heading_b uk-margin-bottom">VENTAS</h3>
	<div class="md-card uk-margin-medium-bottom">
		<div class="md-card-content">
			<div >
				<table id="dt_default" class="uk-table "   cellspacing="0"  width="100%">
					<thead>

						<tr>
							<th>ID</th>
							<th>CLIENTE</th>
							<th>FECHA</th>
							<th>NRO SERIE</th>
							<th>SUBTOTAL</th>
							<th>IGV</th>
							<th>DESCUENTO</th>
							<th width="50px"></th>
						</tr>
					</thead>

					<tbody id="pagina">
						<?php foreach($ventas as $value){ ?>
						<tr id="<?php echo $value->id_venta; ?>" class="fila"  >
							<td><?php echo $value->id_venta; ?></td>
							<td><?php echo $value->nombre; ?></td>
							<td><?php echo $value->fecha; ?></td>
							<td><?php echo $value->nro_serie; ?></td>
							<td><?php echo $value->subtotal; ?></td>
							<td><?php echo $value->igv; ?></td>
							<td><?php echo $value->descuento; ?></td>
							<td class="jtable-command-column">
								<center>
									<a title="EDITAR" class="jtable-command-button jtable-edit-command-button" href="<?php echo base_url().'Cliente_c/editar/?id='.$value->id_cliente; ?>"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a>
								</center>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>	
		</div>
	</div>
	<div class="md-fab-wrapper md-fab-in-card md-fab-speed-dial">
		<a class="md-fab md-fab-primary" href="#"><i class="material-icons">menu</i></a>
		<div class="md-fab-wrapper-small">
			<a class="md-fab md-fab-small md-fab-success" title="FACTURA" href="<?php echo base_url();?>Ventas_c/factura"><i class="material-icons">&#xe242;</i></a>
			<a class="md-fab md-fab-small md-fab-success" title="BOLETA" href="<?php echo base_url();?>Ventas_c/boleta"><i class="material-icons">&#xe241;</i></a>
			<a class="md-fab md-fab-small md-fab-success" title="GUIA DE REMISIÓN" href="<?php echo base_url();?>Ventas_c/guia"><i class="material-icons">&#xe065;</i></a>
		</div>
	</div>
</div>
<?php include('public/js.inc');?>

<script type="text/javascript">


	$('#modificar').click(function(){

		var proveedor = $('#modificar_proveedor').val();
		var id = $('#id_proveedor').val();
		if (proveedor!='') {
			$.ajax({
				url : "<?php echo base_url();?>proveedor_c/modificar",
				data : {proveedor : proveedor, id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_proveedor,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_proveedor+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_proveedor)[0]);

					$('#proveedor').val(''); 
				}
			});
		}
	});

	function inactivo(id) {
		$.ajax({
			url : "<?php echo base_url();?>Proveedor_c/inactivo",
			data : { id : id},
			type : 'POST',
			success : function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var datos =  [$object.id_proveedor,$object.descripcion,$object.empresa,$object.ruc,$object.departamentos,$object.estado,'<td class="jtable-command-column"><center><a title="VER" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_proveedor('+$object.id_proveedor+')" ><span class="material-icons" style="color: #cccc00;" >visibility</span></a> <a title="EDITAR" class="jtable-command-button jtable-edit-command-button" href="'+$object.url+$object.id_proveedor+'"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a> <a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_proveedor+')"><span style="color: #7cb342;" class="material-icons">done</span></a></center></td>'];
				t.fnUpdate(datos,$('#dt_default tr#'+$object.id_proveedor)[0]);
			}
		});
	}

	function activo(id) {
		$.ajax({
			url : "<?php echo base_url();?>Proveedor_c/activo",
			data : { id : id},
			type : 'POST',
			success : function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var datos =  [$object.id_proveedor,$object.descripcion,$object.empresa,$object.ruc,$object.departamentos,$object.estado,'<td class="jtable-command-column"><center><a title="VER" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_proveedor('+$object.id_proveedor+')" ><span class="material-icons" style="color: #cccc00;" >visibility</span></a> <a title="EDITAR" class="jtable-command-button jtable-edit-command-button" href="'+$object.url+$object.id_proveedor+'"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a> <a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_proveedor+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>'];
				t.fnUpdate(datos,$('#dt_default tr#'+$object.id_proveedor)[0]);

			}
		});
	}

</script>
</body>
</html>