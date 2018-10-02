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

		<h3 class="heading_b uk-margin-bottom">PERFILES</h3>
		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<div >
					<table id="dt_default" class="uk-table "    cellspacing="0"  width="100%">
						<thead>
							<tr>
								<th>ID</th>
								<th>DESCRIPCIÓN</th>
								<th>ESTADO</th>
								<th></th>
							</tr>
						</thead>

						<tbody id="pagina">
							<?php foreach($perfil as $value){ ?>
								<tr id="<?php echo $value->id_perfil_usuario; ?>">
									<td><?php echo $value->id_perfil_usuario; ?></td>
									<td><?php echo $value->descripcion; ?></td>
									<td><?php echo $value->estados; ?></td>
									<td class="jtable-command-column"><center> <a title="EDITAR" data-uk-modal="{target:'#editar_perfil'}" class="jtable-command-button jtable-edit-command-button" onclick="editar(<?php echo $value->id_perfil_usuario; ?>)"><span class="uk-icon-pencil" style="color: #3399fff5;"></span></a>
										<?php if ($value->id_estados=='1') { ?>
											<a title="INACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="inactivo(<?php echo $value->id_perfil_usuario; ?>)"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>
										<?php }else{ ?>
											<a title="ACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="activo(<?php echo $value->id_perfil_usuario; ?>)"><span style="color: #7cb342;" class="material-icons">done</span></a>
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
			<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#agregar_perfil'}"  >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>

		<div id="agregar_perfil"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>

				<h2 class="heading_a">AGREGAR PERFIL</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="perfil">PERFIL<span class="req">*</span></label>
							<input type="text"   id="perfil" style="text-transform: uppercase;" required class="md-input" />
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

		<div id="editar_perfil"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>

				<h2 class="heading_a">EDITAR PERFIL</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="perfil">PERFIL<span class="req">*</span></label>
							<input type="text"   id="modificar_perfil" value=" " style="text-transform: uppercase;" required class="md-input" />
							<input type="hidden"   id="id_perfil" />
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

			var perfil = $('#perfil').val();
			if (perfil!='') {
				$.post("<?php echo base_url();?>Perfil_c/agregar", {"perfil": perfil}, function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var u = "{target:'#editar_perfil'}";
					var addData = []; 
					addData.push ('<td class="  ">'+$object.id_perfil_usuario+'</td>');
					addData.push ('<td class="  ">'+$object.descripcion+'</td>');
					addData.push ('<td class="  ">'+$object.estados+'</td>');
					addData.push ('<td class="jtable-command-column"><center><a title="EDITAR"  class="jtable-command-button jtable-edit-command-button" data-uk-modal="'+u+'" onclick="editar('+$object.id_perfil_usuario+')"><span class="uk-icon-pencil" style="color: #3399fff5;"></span></a> <a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_perfil_usuario+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>');
					t.fnAddData(addData);
					t.fnSort([0,'desc']);
					$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_perfil_usuario);
					$('#perfil').val('');
				});
			}
		});

		$('#modificar').click(function(){

			var perfil = $('#modificar_perfil').val();
			var id = $('#id_perfil').val();
			if (perfil!='') {
				$.ajax({
					url : "<?php echo base_url();?>Perfil_c/modificar",
					data : {perfil : perfil, id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						var u = "{target:'#editar_perfil'}";
						if ($object.id_estado=='1') {
							var op='<a title="INACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_perfil_usuario+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>';
						}else{
							var op='<a title="ACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_perfil_usuario+')"><span style="color: #7cb342;" class="material-icons">done</span></a>';
						}
						var datos =  [$object.id_perfil_usuario,$object.descripcion,$object.estados,'<td class="jtable-command-column"><center><a title="EDITAR"  class="jtable-command-button jtable-edit-command-button" data-uk-modal="'+u+'" onclick="editar('+$object.id_perfil_usuario+')"><span class="uk-icon-pencil" style="color: #3399fff5;"></span></a> '+op+'</center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_perfil_usuario)[0]);
						
						$('#perfil').val(''); 
					}
				});
			}
		});

		function editar(id) {

			$.ajax({
				url : "<?php echo base_url();?>Perfil_c/editar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					$("#id_perfil").val(type.id_perfil_usuario);
					$("#modificar_perfil").val(type.descripcion);
				}
			});
		}

		function inactivo(id) {
			$.ajax({
				url : "<?php echo base_url();?>Perfil_c/inactivo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var u = "{target:'#editar_perfil'}";
					var datos =  [$object.id_perfil_usuario,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center> <a title="EDITAR" data-uk-modal="'+u+'" class="jtable-command-button jtable-edit-command-button" onclick="editar('+$object.id_perfil_usuario+')"><span class="uk-icon-pencil" style="color: #3399fff5;"></span></a> <a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_perfil_usuario+')"><span style="color: #7cb342;" class="material-icons">done</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_perfil_usuario)[0]);
				}
			});
		}

		function activo(id) {
			$.ajax({
				url : "<?php echo base_url();?>Perfil_c/activo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var u = "{target:'#editar_perfil'}";
					var datos =  [$object.id_perfil_usuario,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center> <a title="EDITAR" data-uk-modal="'+u+'" class="jtable-command-button jtable-edit-command-button" onclick="editar('+$object.id_perfil_usuario+')"><span class="uk-icon-pencil" style="color: #3399fff5;"></span></a> <a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_perfil_usuario+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_perfil_usuario)[0]);
				}
			});
		}

	</script>
</body>
</html>