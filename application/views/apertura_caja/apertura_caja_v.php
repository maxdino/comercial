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
	<h3 class="heading_b uk-margin-bottom">APERTURA CAJA</h3>
	<div class="md-card uk-margin-medium-bottom">
		<div class="md-card-content">
			<table id="dt_default"   class="uk-table"   cellspacing="0"  width="100%">
				<thead>
					<tr>
						<th width="50px">ID</th>
						<th width="200px">USUARIO</th>
						<th width="50px">CAJA</th>
						<th width="80px">FECHA INICIO</th>
						<th width="50px">MONTO INICIAL</th>
						<th width="50px">MONTO CIERRE</th>
						<th width="50px">MONTO ACTUAL + APERTURA</th>
					</tr>
				</thead>
				<tbody >
					<?php foreach($apertura as $value){ ?>
					<tr id="<?php echo $value->id_sesion_caja; ?>"  class="fila"  >
						<td><?php echo $value->id_sesion_caja; ?></td>
						<td><?php echo $value->nombre.' '.$value->apellido; ?></td>
						<td><?php echo $value->descripcion; ?></td>
						<td><?php echo $value->fecha_entrada; ?></td>
						<td><?php echo number_format($value->monto_inicial, 2, '.', ''); ?></td>
						<td><?php echo number_format($value->monto_cierre, 2, '.', ''); ?></td>
						<td><?php echo number_format($value->monto_inicial+$value->monto_cierre, 2, '.', ''); ?></td>
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
			<h2 class="heading_a">APERTURAR CAJA</h2>
			<div id="form_validation" class="uk-grid" data-uk-grid-margin>
				<div class="uk-width-medium-1-1">
					<div class="parsley-row">
						<label for="fecha" style="color: #727272;">FECHA APERTURA<span class="req">*</span></label>
						<input type="text" name="fecha" id="fecha" disabled value="<?php echo date('Y-m-d'); ?>" class="md-input" />
					</div>
				</div>
			</div>
			<div id="form_validation" class="uk-grid" data-uk-grid-margin>
				<div class="uk-width-medium-1-2">
					<div class="parsley-row">
						<label for="sel1">CAJA</label>
						<select id="caja" placeholder="CAJA" autocomplete="off" name="caja" class="form-control" >
							<option value=""></option>
							<?php foreach($caja as $values){ ?>
							<option value="<?php echo $values->id_caja; ?>"><?php echo $values->descripcion; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="uk-width-medium-1-2">
					<div class="parsley-row">
						<label for="monto" >MONTO INICIAL<span class="req">*</span></label>
						<input type="text" style="text-transform: uppercase;"  id="monto" name="monto" class="md-input solo-numero" />
					</div>
				</div>
			</div>
			<div class="uk-grid">
				<div class="uk-width-1-1">
					<button type="submit" class="md-btn md-btn-primary uk-modal-close" id="guardar" >APERTURAR</button>
				</div>
			</div> 
		</div>
	</div>

</div>
<?php include('public/js.inc');?>

<script type="text/javascript">

	$('#guardar').click(function(){
		var caja = $('#caja').val();
		var monto = $('#monto').val();
		if (caja!=''&&monto!='') {
			$.post("<?php echo base_url();?>Apertura_caja_c/agregar", {"caja": caja,"monto": monto}, function(data) {
				$object = jQuery.parseJSON(data);
				if ($object.va=='1') {
					$actual = parseFloat(parseFloat($object.monto)+parseFloat($object.monto_cierre)).toFixed(2);
					var t = $('#dt_default').dataTable();
					var addData = []; 
					addData.push ('<td class="  ">'+$object.id_sesion_caja+'</td>');
					addData.push ('<td class="  ">'+$object.usuario+'</td>');
					addData.push ('<td class="  ">'+$object.caja+'</td>');
					addData.push ('<td class="  ">'+$object.fecha+'</td>');
					addData.push ('<td class="  ">'+parseFloat($object.monto).toFixed(2)+'</td>');
					addData.push ('<td class="  ">'+parseFloat($object.monto_cierre).toFixed(2)+'</td>');
					addData.push ('<td class="  ">'+$actual+'</td>');
					t.fnAddData(addData);
					t.fnSort([0,'desc']);
					//$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_sesion_caja+')');
					$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_caja);
				}else{
					swal({
						title: "La caja ya se encuentra abierta",
						text: "¡Deberia cerrar antes de dar apertura a otra!",
						type: "error",
						showCancelButton: false,
						confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
						confirmButtonText: 'Ok!'
					});  
				}
				$('#monto').val('');
				$('#caja').val('');
			});
		}else{
			swal({
				title: "Error al aperturar caja",
				text: "¡Llene los campos para la apertura de caja!",
				type: "error",
				showCancelButton: false,
				confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
				confirmButtonText: 'Ok!'
			}); 
		}
	});

	$('#modificar').click(function(){
		var caja = $('#modificar_caja').val();
		var id = $('#id_caja').val();
		if (caja!='') {
			$.ajax({
				url : "<?php echo base_url();?>Caja_c/modificar",
				data : {caja : caja, id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					if ($object.id_estados=='0') {
						var button='<a title="ACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_caja+')"><span style="color: #7cb342;" class="material-icons">done</span></a>';
					}else{
						var button='<a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_caja+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>';
					}
					var datos =  [$object.id_caja,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center>'+button+'</center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_caja)[0]);
					$('#caja').val('');
				}
			});
		}
	});

	function editar(id) {
		$.ajax({
			url : "<?php echo base_url();?>Caja_c/editar",
			data : {id : id},
			type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#editar_caja").show();
					$("#id_caja").val(type.id_caja);
					$("#modificar_caja").val(type.descripcion);
				}
			});
	}

	function inactivo(id) {
		$.ajax({
			url : "<?php echo base_url();?>Caja_c/inactivo",
			data : { id : id},
			type : 'POST',
			success : function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var datos =  [$object.id_caja,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="ACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_caja+')"><span style="color: #7cb342;" class="material-icons">done</span></a></center></td>'];
				t.fnUpdate(datos,$('#dt_default tr#'+$object.id_caja)[0]);
			}
		});
	}

	function activo(id) {
		$.ajax({
			url : "<?php echo base_url();?>Caja_c/activo",
			data : { id : id},
			type : 'POST',
			success : function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var datos =  [$object.id_caja,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="INACTIVAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_caja+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>'];
				t.fnUpdate(datos,$('#dt_default tr#'+$object.id_caja)[0]);
			}
		});
	}

	$(document).ready(function (){
		$('.solo-numero').keyup(function (){
			this.value = (this.value + '').replace(/[^0-9.]/g, '');
		});
	}); 
</script>
</body>
</html>