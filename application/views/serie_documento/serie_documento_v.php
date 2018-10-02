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
	<h3 class="heading_b uk-margin-bottom">SERIE DOCUMENTO</h3>
	<div class="md-card uk-margin-medium-bottom">
		<div class="md-card-content">
			<table id="dt_default"   class="uk-table"   cellspacing="0"  width="100%">
				<thead>
					<tr>
						
						<th width="10px">ID</th>
						<th width="50px">SERIE</th>
						<th width="80px">NUMERO CORRELATIVO</th>
						<th width="50px">NUMERO MAXIMO</th>
						<th width="50px">TIPO COMPROBANTE</th>
						<th width="50px">ESTADO</th>
						<th width="50px"></th>
					</tr>
				</thead>
				<tbody >
					<?php foreach($serie_documento as $value){ ?>
					<tr id="<?php echo $value->id_serie_documento; ?>"  class="fila"  >
						<td><?php echo $value->id_serie_documento; ?></td>
						<td><?php echo $value->serie; ?></td>
						<td><?php echo $value->numero; ?></td>
						<td><?php echo $value->max_numero; ?></td>
						<td><?php echo $value->tipo; ?></td>
						<td><?php echo $value->estados; ?></td>
						<td><center>
							<a title="EDITAR" class="jtable-command-button jtable-edit-command-button" onclick="editar(<?php echo $value->id_serie_documento; ?>)"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a>
						</center>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>	 
	</div>
</div>
<div class="md-fab-wrapper">
	<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#serie_documento'}"  >
		<i class="material-icons">&#xE145;</i>
	</a>
</div>
<link rel="stylesheet" href="<?php echo base_url();?>public/assets/css/bootstrap.min.css">
<div id="serie_documento"  class="uk-modal" role="dialog">
	<div class="uk-modal-dialog" >
		<button type="button" class="uk-modal-close uk-close"></button>
		<h2 class="heading_a">SERIE DOCUMENTO</h2>
		<div id="form_validation" class="uk-grid" data-uk-grid-margin>
			<div class="uk-width-medium-1-2">
				<div class="parsley-row">
					<label for="serie" ">SERIE<span class="req">*</span></label>
					<input type="text" name="serie" id="serie" class="md-input solo-numero" />
				</div>
			</div>
			<div class="uk-width-medium-1-2">
				<div class="parsley-row">
					<label for="numero_co" ">NÚMERO CORRELATIVO<span class="req">*</span></label>
					<input type="text" name="numero_co" id="numero_co"  class="md-input solo-numero" />
				</div>
			</div>
		</div>
		<div  class="uk-grid" data-uk-grid-margin>
			<div class="uk-width-medium-1-2">
				<div class="parsley-row">
					<label for="max_numero" >NÚMERO MAXIMO<span class="req">*</span></label>
					<input type="text" name="max_numero" id="max_numero"  class="md-input solo-numero" />
				</div>
			</div>
			<div class="uk-width-medium-1-2">
				<div class="parsley-row">
					<label for="tipo_comprobante">TIPO COMPROBANTE</label>
					<select id="tipo_comprobante" placeholder="TIPO COMPROBANTE" autocomplete="off" name="tipo_comprobante" class="form-control" >
						<option value=""></option>
						<?php foreach($tipo_comprobante as $values){ ?>
						<option value="<?php echo $values->id_tipo_comprobante; ?>"><?php echo $values->descripcion; ?></option>
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
<div id="serie_documento_editar"  class="uk-modal" role="dialog">
	<div class="uk-modal-dialog" >
		<button type="button" class="uk-modal-close uk-close"></button>
		<h2 class="heading_a">EDITAR SERIE DOCUMENTO</h2>
		<div class="uk-grid" data-uk-grid-margin>
			<div class="uk-width-medium-1-2">
				<div class="parsley-row">
					<label for="serie" ">SERIE<span class="req">*</span></label>
					<input type="text" name="serie_modificar" id="serie_modificar" value=" " class="md-input solo-numero" />
					<input type="hidden" name="id_serie_documento" id="id_serie_documento">
				</div>
			</div>
			<div class="uk-width-medium-1-2">
				<div class="parsley-row">
					<label for="numero_co_modificar" ">NÚMERO CORRELATIVO<span class="req">*</span></label>
					<input type="text" name="numero_co_modificar" id="numero_co_modificar" value=" " class="md-input solo-numero" />
				</div>
			</div>
		</div>
		<div  class="uk-grid" data-uk-grid-margin>
			<div class="uk-width-medium-1-2">
				<div class="parsley-row">
					<label for="max_numero_modificar" >NÚMERO MAXIMO<span class="req">*</span></label>
					<input type="text" name="max_numero_modificar" id="max_numero_modificar" value=" " class="md-input solo-numero" />
				</div>
			</div>
			<div class="uk-width-medium-1-2">
				<div class="parsley-row">
					<label for="tipo_comprobante_modificar">TIPO COMPROBANTE</label>
					<select id="tipo_comprobante_modificar" placeholder="TIPO COMPROBANTE" autocomplete="off" name="tipo_comprobante_modificar" class="form-control" >
						<?php foreach($tipo_comprobante as $values){ ?>
						<option value="<?php echo $values->id_tipo_comprobante; ?>"><?php echo $values->descripcion; ?></option>
						<?php } ?>
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
		var serie = $('#serie').val();
		var numero_co = $('#numero_co').val();
		var max_numero = $('#max_numero').val();
		var tipo_comprobante = $('#tipo_comprobante').val();
		if (serie!=''&&numero_co!=''&&max_numero!=''&&tipo_comprobante!='') {
			$.post("<?php echo base_url();?>Serie_documento_c/agregar", {"serie": serie,"numero_co": numero_co,"max_numero": max_numero,"tipo_comprobante": tipo_comprobante}, function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var addData = []; 
				addData.push ('<td class="  ">'+$object.id_serie_documento+'</td>');
				addData.push ('<td class="  ">'+$object.serie+'</td>');
				addData.push ('<td class="  ">'+$object.numero+'</td>');
				addData.push ('<td class="  ">'+$object.max_numero+'</td>');
				addData.push ('<td class="  ">'+$object.tipo_comprobante+'</td>');
				addData.push ('<td class="  ">'+$object.estado+'</td>');
				addData.push ('<td class="jtable-command-column"><center><a title="EDITAR" class="jtable-command-button jtable-edit-command-button" onclick="editar('+$object.id_serie_documento+')"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a></center></td>');
				t.fnAddData(addData);
				t.fnSort([0,'desc']);
					//$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_sesion_caja+')');
					$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_serie_documento);
					$('#monto').val('');
					$('#caja').val('');
				});
		}else{
			swal({
				title: "Error al Registrar Serie Documento",
				text: "¡Llene los campos para el Serie Documento!",
				type: "error",
				showCancelButton: false,
				confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
				confirmButtonText: 'Ok!'
			}); 
		}
	});

	$(document).ready(function (){
		$('.solo-numero').keyup(function (){
			this.value = (this.value + '').replace(/[^0-9.]/g, '');
		});
	}); 

	function editar(id) {
		$("#tipo_comprobante_modificar").empty();
		$.ajax({
			url : "<?php echo base_url();?>Serie_documento_c/editar",
			data : {id : id},
			type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					$object = jQuery.parseJSON(data);
					$("#id_serie_documento").val($object['serie_documento'].id_serie_documento);
					$("#serie_modificar").val($object['serie_documento'].serie);
					$("#numero_co_modificar").val($object['serie_documento'].numero);
					$("#max_numero_modificar").val($object['serie_documento'].max_numero);
					$("#tipo_comprobante_modificar").append('<option value="'+$object['serie_documento'].id_tipo_comprobante+'" >'+$object['serie_documento'].descripcion+'</option>');
					for (var i = 0; $object['tipo'].length > i; i++) {
						$("#tipo_comprobante_modificar").append('<option value="'+$object['tipo'][i].id_tipo_comprobante+'" >'+$object['tipo'][i].descripcion+'</option>');
					}
					UIkit.modal("#serie_documento_editar").show();
				}
			});
	}

	$('#modificar').click(function(){
		var id = $('#id_serie_documento').val();
		var serie = $('#serie_modificar').val();
		var numero_co = $('#numero_co_modificar').val();
		var max_numero = $('#max_numero_modificar').val();
		var tipo_comprobante = $('#tipo_comprobante_modificar').val();
		if (serie!=''&&numero_co!=''&&max_numero!=''&&tipo_comprobante!='') {
			$.ajax({
				url : "<?php echo base_url();?>Serie_documento_c/modificar",
				data : {serie : serie, numero_co : numero_co, max_numero : max_numero, tipo_comprobante : tipo_comprobante,id:id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_serie_documento,$object.serie,$object.numero,$object.max_numero,$object.tipo_comprobante,$object.estado,'<td class="jtable-command-column"><center><a title="EDITAR" class="jtable-command-button jtable-edit-command-button" onclick="editar('+$object.id_serie_documento+')"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_serie_documento)[0]);
				}
			});
		}else{
			swal({
				title: "Error al Modificar Serie Documento",
				text: "¡Llene los campos para el Serie Documento!",
				type: "error",
				showCancelButton: false,
				confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
				confirmButtonText: 'Ok!'
			}); 
		}
	});
</script>
</body>
</html>