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

		<h3 class="heading_b uk-margin-bottom">CONCEPTO MOVIMIENTO</h3>

		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<table id="dt_default"   class="uk-table"   cellspacing="0"  width="100%">
					<thead>
						<tr>
							<th width="50px">ID</th>
							<th width="200px">CONCEPTO MOVIMIENTO</th>
							<th width="80px">TIPO MOVIMIENTO</th>
							<th width="80px">ESTADO</th>
							<th width="50px"></th>
						</tr>
					</thead>
					<tbody >
						<?php foreach($concepto as $value){ ?>
						<tr id="<?php echo $value->id_concepto_movimiento; ?>" ondblclick="editar(<?php echo $value->id_concepto_movimiento; ?>)"  >
							<td><?php echo $value->id_concepto_movimiento; ?></td>
							<td><?php echo $value->descripcion; ?></td>
							<td><?php echo $value->tipo; ?></td>
							<td><?php echo $value->estados; ?></td>
							<td class="jtable-command-column" ><center> 
								<?php if ($value->estado=='1') { ?>
								<a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo(<?php echo $value->id_concepto_movimiento; ?>)"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>
								<?php }else{ ?>
								<a title="ACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="activo(<?php echo $value->id_concepto_movimiento; ?>)"><span style="color: #7cb342;" class="material-icons">done</span></a>
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
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/css/bootstrap.min.css">
		<div id="agregar_caja"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">AGREGAR CONCEPTO MOVIMIENTO</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="concepto_movimiento">CONCEPTO MOVIMIENTO<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="concepto_movimiento" required class="md-input" />
						</div>
					</div>           
				</div>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="tipo_movimiento">TIPO MOVIMIENTO<span class="req">*</span></label>
							<select id="tipo_movimiento" placeholder="TIPO MOVIMIENTO" autocomplete="off" name="tipo_movimiento" class="form-control" >
								<option value=""></option>
								<?php foreach($tipo as $values){ ?>
								<option value="<?php echo $values->id_tipo_movimiento; ?>"><?php echo $values->descripcion; ?></option>
								<?php } ?>
							</select>
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

		<div id="editar_concepto_movimiento"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">EDITAR CONCEPTO MOVIMIENTO</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="concepto_movimiento_modificar">CONCEPTO MOVIMIENTO<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="concepto_movimiento_modificar" required value=" " class="md-input" />
							<input type="hidden" id="id_concepto_movimiento" />
						</div>
					</div>           
				</div>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="modificar_tipo_movimiento">TIPO MOVIMIENTO<span class="req">*</span></label>
							<select id="modificar_tipo_movimiento" placeholder="TIPO MOVIMIENTO" autocomplete="off" name="modificar_tipo_movimiento" class="form-control" >
							</select>	
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
			var concepto_movimiento = $('#concepto_movimiento').val();
			var tipo = $('#tipo_movimiento').val();
			if (concepto_movimiento!=''&&tipo!='') {
				$.post("<?php echo base_url();?>Concepto_movimiento_c/agregar", {"concepto_movimiento": concepto_movimiento,"tipo": tipo}, function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var addData = []; 
					addData.push ('<td class="  ">'+$object.id_concepto_movimiento+'</td>');
					addData.push ('<td class="  ">'+$object.descripcion+'</td>');
					addData.push ('<td class="  ">'+$object.tipo+'</td>');
					addData.push ('<td class="  ">'+$object.estado+'</td>');
					addData.push ('<td class="jtable-command-column" ><center><a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_concepto_movimiento+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>');
					t.fnAddData(addData);
					t.fnSort([0,'desc']);
					$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_concepto_movimiento+')');

					$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_concepto_movimiento);
					$('#tipo_movimiento').val('');
					$('#concepto_movimiento').val('');
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
			var concepto_movimiento = $('#concepto_movimiento_modificar').val();
			var tipo = $('#modificar_tipo_movimiento').val();
			var id = $('#id_concepto_movimiento').val();
			if (concepto_movimiento!=''&&tipo!='') {
				$.ajax({
					url : "<?php echo base_url();?>Concepto_movimiento_c/modificar",
					data : {tipo : tipo,concepto_movimiento : concepto_movimiento , id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						if ($object.id_estados=='0') {
							var button='<a title="ACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_concepto_movimiento+')"><span style="color: #7cb342;" class="material-icons">done</span></a>';
						}else{
							var button='<a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_concepto_movimiento+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>';
						}
						var datos =  [$object.id_concepto_movimiento,$object.descripcion,$object.tipo,$object.estado,'<td class="jtable-command-column"><center>'+button+'</center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_concepto_movimiento)[0]);
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
			$("#modificar_tipo_movimiento").empty();
			$.ajax({
				url : "<?php echo base_url();?>Concepto_movimiento_c/editar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#editar_concepto_movimiento").show();
					$("#id_concepto_movimiento").val(type['concepto'].id_concepto_movimiento);
					$("#concepto_movimiento_modificar").val(type['concepto'].descripcion);
					$("#modificar_tipo_movimiento").append('<option value="'+type['concepto'].id_tipo_movimiento+'" >'+type['concepto'].tipo+'</option>');
					for (var i = 0; type['tipo'].length > i; i++) {
						$("#modificar_tipo_movimiento").append('<option value="'+type['tipo'][i].id_tipo_movimiento+'" >'+type['tipo'][i].descripcion+'</option>');
					}
				}
			});
		}

		function inactivo(id) {
			$.ajax({
				url : "<?php echo base_url();?>Concepto_movimiento_c/inactivo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_concepto_movimiento,$object.descripcion,$object.tipo,$object.estado,'<td class="jtable-command-column"><center><a title="ACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_concepto_movimiento+')"><span style="color: #7cb342;" class="material-icons">done</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_concepto_movimiento)[0]);
				}
			});
		}

		function activo(id) {
			$.ajax({
				url : "<?php echo base_url();?>Concepto_movimiento_c/activo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_concepto_movimiento,$object.descripcion,$object.tipo,$object.estado,'<td class="jtable-command-column"><center><a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_concepto_movimiento+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_concepto_movimiento)[0]);
				}
			});
		}

	</script>
</body>
</html>