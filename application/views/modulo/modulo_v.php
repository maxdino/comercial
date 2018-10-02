<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
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

		<h3 class="heading_b uk-margin-bottom">MODULOS</h3>
		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<div >
					<table id="dt_default" class="uk-table"   cellspacing="0"  width="100%">
						<thead>
							<tr>
								<th>ID</th>
								<th>DESCRIPCIÓN</th>
								<th>URL</th>
								<th>MODULO PADRE</th>
								<th>ESTADO</th>
								<th></th>
							</tr>
						</thead>

						<tbody id="pagina">
							<?php foreach($modulo as $value){ ?>
								<tr id="<?php echo $value->id_modulo; ?>">
									<td><?php echo $value->id_modulo; ?></td>
									<td><?php echo $value->nombre; ?></td>
									<td><?php echo $value->url; ?></td>
									<td><?php echo $value->modulo_padre; ?></td>
									<td><?php echo $value->estados; ?></td>
									<td class="jtable-command-column"><center> <a title="EDITAR"  class="jtable-command-button jtable-edit-command-button" href="<?php echo base_url().'Modulos_c/editar/?id='.$value->id_modulo; ?>"><span  style="color: #3399fff5;" class="uk-icon-pencil"></span></a>
										<?php if ($value->estado=='1') { ?>
											<a title="INACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="inactivo(<?php echo $value->id_modulo; ?>)"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>
										<?php }else{ ?>
											<a title="ACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="activo(<?php echo $value->id_modulo; ?>)"><span style="color: #7cb342;" class="material-icons">done</span></a>
										<?php } ?>	
									</center></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent" href="<?php echo base_url();?>Modulos_c/nuevo" id="recordAdd"  >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>
	</div>
</div>
<?php include('public/js.inc');?>

<script type="text/javascript">

	$('#guardar').click(function(){

		var modulo = $('#modulo').val();
		var modulo_padre = $('#modulo_padre').val();
		var url = $('#url').val();

		if (modulo!='' ) {
			$.ajax({
				url : "<?php echo base_url();?>Modulos_c/agregar",
				data : {modulo : modulo, modulo_padre : modulo_padre, url : url},
				type : 'POST',
				success : function(data) {
					$('#pagina').html(data);
					$('#modulo').val('');
					$('#modulo_padre').val('');
					$('#url').val('');
				}
			});
		}
	});

	$('#modificar').click(function(){

		var modulo = $('#modulo_editar').val();
		var padre = $('#modulo_padre_editar').val();
		var url = $('#url_editar').val();
		var id = $('#id_modulo_editar').val();
		if (modulo!='') {
			$.ajax({
				url : "<?php echo base_url();?>Modulos_c/modificar",
				data : {modulo : modulo, id : id, padre : padre , url : url },
				type : 'POST',
				success : function(data) {
					$('#pagina').html(data);
					$('#perfil').val('');
				}
			});
		}
	});

	function modulo_padre_e() {
		var padre = $('#modulo_padre_editar').val();	
		if (padre=='0') {
			$("#url_editar").attr("disabled","true");
		}else{
			$("#url_editar").removeAttr("disabled");
		}	
	}

	function inactivo(id) {
			$.ajax({
				url : "<?php echo base_url();?>Modulos_c/inactivo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_modulo,$object.descripcion,$object.url,$object.modulo_padre,$object.estado,'<td class="jtable-command-column"><center> <a title="EDITAR" href="'+$object.url1+''+$object.id_modulo+'" class="jtable-command-button jtable-edit-command-button" ><span class="uk-icon-pencil" style="color: #3399fff5;"></span></a> <a title="ACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_modulo+')"><span style="color: #7cb342;" class="material-icons">done</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_modulo)[0]);
				}
			});
		}

		function activo(id) {
			$.ajax({
				url : "<?php echo base_url();?>Modulos_c/activo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_modulo,$object.descripcion,$object.url,$object.modulo_padre,$object.estado,'<td class="jtable-command-column"><center> <a title="EDITAR" href="'+$object.url1+''+$object.id_modulo+'" class="jtable-command-button jtable-edit-command-button" ><span class="uk-icon-pencil" style="color: #3399fff5;"></span></a> <a title="INACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_modulo+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_modulo)[0]);
				}
			});
		}
</script>
</body>
</html>