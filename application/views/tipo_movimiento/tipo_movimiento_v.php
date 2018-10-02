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

		<h3 class="heading_b uk-margin-bottom">TIPO MOVIMIENTO</h3>

		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<table id="dt_default"   class="uk-table"   cellspacing="0"  width="100%">
					<thead>
						<tr>
							<th width="50px">ID</th>
							<th width="200px">TIPO MOVIMIENTO</th>
							<th width="80px">ESTADO</th>
							<th width="50px">ELIMINAR</th>
						</tr>
					</thead>
					<tbody >
						<?php foreach($tipo as $value){ ?>
						<tr id="<?php echo $value->id_tipo_movimiento; ?>" ondblclick="editar(<?php echo $value->id_tipo_movimiento; ?>)"  >
							<td><?php echo $value->id_tipo_movimiento; ?></td>
							<td><?php echo $value->descripcion; ?></td>
							<td><?php echo $value->estados; ?></td>
							<td class="jtable-command-column" ><center> 
								<?php if ($value->estado=='1') { ?>
								<a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo(<?php echo $value->id_tipo_movimiento; ?>)"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>
								<?php }else{ ?>
								<a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="activo(<?php echo $value->id_tipo_movimiento; ?>)"><span style="color: #7cb342;" class="material-icons">done</span></a>
								<?php } ?>
							</center></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>	 
			</div>
		</div>

		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#agregar_caja'}"  >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>

		<div id="agregar_caja"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">AGREGAR TIPO MOVIMIENTO</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="tipo_movimiento">TIPO MOVIMIENTO<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="tipo_movimiento" required class="md-input" />
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

		<div id="editar_tipo_movimiento"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">EDITAR TIPO MOVIMIENTO</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="modificar_caja">TIPO MOVIMIENTO<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="modificar_tipo_movimiento" value=" " required class="md-input" />
							<input type="hidden"   id="id_tipo_movimiento" />
						</div>
					</div>            
				</div>
				<div class="uk-grid">
					<div class="uk-width-1-1">
						<button type="submit" class="md-btn md-btn-primary uk-modal-close" id="modificar" >GUARDAR</button>
					</div>
				</div> 
			</div>
		</div>
	</div>
	<?php include('public/js.inc');?>

	<script type="text/javascript">

		$('#guardar').click(function(){
			var tipo_movimiento = $('#tipo_movimiento').val();
			if (tipo_movimiento!='') {
				$.post("<?php echo base_url();?>Tipo_movimiento_c/agregar", {"tipo_movimiento": tipo_movimiento}, function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var addData = []; 
					addData.push ('<td class="  ">'+$object.id_tipo_movimiento+'</td>');
					addData.push ('<td class="  ">'+$object.descripcion+'</td>');
					addData.push ('<td class="  ">'+$object.estado+'</td>');
					addData.push ('<td class="jtable-command-column" ><center><a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_tipo_movimiento+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>');
					t.fnAddData(addData);
					t.fnSort([0,'desc']);
					$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_tipo_movimiento+')');

					$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_tipo_movimiento);
					$('#tipo_movimiento').val('');
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
			var tipo = $('#modificar_tipo_movimiento').val();
			var id = $('#id_tipo_movimiento').val();
			if (tipo!='') {
				$.ajax({
					url : "<?php echo base_url();?>Tipo_movimiento_c/modificar",
					data : {tipo : tipo, id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						if ($object.id_estados=='0') {
							var button='<a title="ACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_tipo_movimiento+')"><span style="color: #7cb342;" class="material-icons">done</span></a>';
						}else{
							var button='<a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_tipo_movimiento+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>';
						}
						var datos =  [$object.id_tipo_movimiento,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center>'+button+'</center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_tipo_movimiento)[0]);
						$('#modificar_tipo_movimiento').val('');
					}
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

		function editar(id) {
			$.ajax({
				url : "<?php echo base_url();?>Tipo_movimiento_c/editar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#editar_tipo_movimiento").show();
					$("#id_tipo_movimiento").val(type.id_tipo_movimiento);
					$("#modificar_tipo_movimiento").val(type.descripcion);
				}
			});
		}

		function inactivo(id) {
			$.ajax({
				url : "<?php echo base_url();?>Tipo_movimiento_c/inactivo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_tipo_movimiento,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="ACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_tipo_movimiento+')"><span style="color: #7cb342;" class="material-icons">done</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_tipo_movimiento)[0]);
				}
			});
		}

		function activo(id) {
			$.ajax({
				url : "<?php echo base_url();?>Tipo_movimiento_c/activo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_tipo_movimiento,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_tipo_movimiento+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_tipo_movimiento)[0]);
				}
			});
		}

	</script>
</body>
</html>