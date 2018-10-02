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
	<body class=" sidebar_main_open sidebar_main_swipe">
		<?php include('includes/menu.inc');?>  

		<h3 class="heading_b uk-margin-bottom">FORMA DE PAGO</h3>

		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<table id="dt_default"   class="uk-table"   cellspacing="0"  width="100%">
					<thead>
						<tr>
							<th width="50px">ID</th>
							<th width="200px">FORMA PAGO</th>
							<th width="80px">ESTADO</th>
							<th width="50px"></th>
						</tr>
					</thead>
					<tbody >
						<?php foreach($forma_pago as $value){ ?>
						<tr id="<?php echo $value->id_forma_pago; ?>" ondblclick="editar(<?php echo $value->id_forma_pago; ?>)"  >
							<td><?php echo $value->id_forma_pago; ?></td>
							<td><?php echo $value->descripcion; ?></td>
							<td><?php echo $value->estados; ?></td>
							<td class="jtable-command-column" ><center> 
								<?php if ($value->estado=='1') { ?>
								<a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo(<?php echo $value->id_forma_pago; ?>)"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>
								<?php }else{ ?>
								<a title="ACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="activo(<?php echo $value->id_forma_pago; ?>)"><span style="color: #7cb342;" class="material-icons">done</span></a>
								<?php } ?>
							</center></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>	 
			</div>
		</div>

		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#agregar_forma'}"  >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/css/bootstrap.min.css">
		<div id="agregar_forma"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">AGREGAR FORMA PAGO</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="forma_pago">FORMA PAGO<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="forma_pago" required class="md-input" />
						</div>
					</div>           
				</div>
				<div class="uk-grid">
					<div class="uk-width-1-1">
						<button type="submit" class="md-btn md-btn-primary uk-modal-close" id="guardar" >GUARDAR</button>
					</div>
				</div> 
			</div>
		</div>

		<div id="editar_forma_pago"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">EDITAR FORMA PAGO</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="forma_pago_modificar">FORMA PAGO<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="forma_pago_modificar" required value=" " class="md-input" />
							<input type="hidden" id="id_forma_pago" />
						</div>
					</div>           
				</div>
				<div class="uk-grid">
					<div class="uk-width-1-1">
						<button type="submit" class="md-btn md-btn-primary uk-modal-close" id="modificar" >MODIFICAR</button>
					</div>
				</div> 
			</div>
		</div>
	</div>
	<?php include('public/js.inc');?>

	<script type="text/javascript">

		$('#guardar').click(function(){
			var forma_pago = $('#forma_pago').val();
			var tipo = $('#tipo_movimiento').val();
			if (forma_pago!=''&&tipo!='') {
				$.post("<?php echo base_url();?>forma_pago_c/agregar", {"forma_pago": forma_pago}, function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var addData = []; 
					addData.push ('<td class="  ">'+$object.id_forma_pago+'</td>');
					addData.push ('<td class="  ">'+$object.descripcion+'</td>');
					addData.push ('<td class="  ">'+$object.estado+'</td>');
					addData.push ('<td class="jtable-command-column" ><center><a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_forma_pago+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>');
					t.fnAddData(addData);
					t.fnSort([0,'desc']);
					$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_forma_pago+')');

					$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_forma_pago);
					$('#tipo_movimiento').val('');
					$('#forma_pago').val('');
				});
			}else{
				swal({
					title: "Error al Registrar Tipo Movimiento",
					text: "¡Llene los campos del Tipo Movimiento!",
					type: "error",
					showCancelButton: false,
					confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
					confirmButtonText: 'Ok!'
				}); 
			}
		});

		$('#modificar').click(function(){
			var forma_pago = $('#forma_pago_modificar').val();
			var id = $('#id_forma_pago').val();
			if (forma_pago!='') {
				$.ajax({
					url : "<?php echo base_url();?>forma_pago_c/modificar",
					data : {forma_pago : forma_pago , id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						if ($object.id_estados=='0') {
							var button='<a title="ACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_forma_pago+')"><span style="color: #7cb342;" class="material-icons">done</span></a>';
						}else{
							var button='<a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_forma_pago+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>';
						}
						var datos =  [$object.id_forma_pago,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center>'+button+'</center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_forma_pago)[0]);
						$('#modificar_tipo_movimiento').val('');
					}
				});
			}else{
				swal({
					title: "Error al Registrar Concepto Movimiento",
					text: "¡Llene los campos del Concepto Movimiento!",
					type: "error",
					showCancelButton: false,
					confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
					confirmButtonText: 'Ok!'
				}); 
			}
		});

		function editar(id) {
			$.ajax({
				url : "<?php echo base_url();?>forma_pago_c/editar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#editar_forma_pago").show();
					$("#id_forma_pago").val(type.id_forma_pago);
					$("#forma_pago_modificar").val(type.descripcion);
				}
			});
		}

		function inactivo(id) {
			$.ajax({
				url : "<?php echo base_url();?>forma_pago_c/inactivo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_forma_pago,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="ACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_forma_pago+')"><span style="color: #7cb342;" class="material-icons">done</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_forma_pago)[0]);
				}
			});
		}

		function activo(id) {
			$.ajax({
				url : "<?php echo base_url();?>forma_pago_c/activo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_forma_pago,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_forma_pago+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_forma_pago)[0]);
				}
			});
		}

	</script>
</body>
</html>