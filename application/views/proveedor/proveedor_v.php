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

		<h3 class="heading_b uk-margin-bottom">PROVEEDOR</h3>
		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<div >
					<table id="dt_default" class="uk-table "   cellspacing="0"  width="100%">
						<thead>

							<tr>
								<th>ID</th>
								<th>PROVEEDOR</th>
								<th>EMPRESA</th>
								<th>RUC</th>
								<th>DEPARTAMENTO</th>
								<th>ESTADO</th>
								<th width="50px">ELIMINAR</th>
							</tr>
						</thead>

						<tbody id="pagina">
							<?php foreach($proveedor as $value){ ?>
								<tr id="<?php echo $value->id_proveedor; ?>" class="fila"  >
									<td><?php echo $value->id_proveedor; ?></td>
									<td><?php echo $value->descripcion; ?></td>
									<td><?php echo $value->empresa; ?></td>
									<td><?php echo $value->ruc; ?></td>
									<td><?php echo $value->departamentos; ?></td>
									<td><?php echo $value->estado; ?></td>
									<td class="jtable-command-column">
										<center>
											<a title="VER" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_proveedor(<?php echo $value->id_proveedor; ?>)" ><span class="material-icons" style="color: #cccc00;" >visibility</span></a>	
											<a title="EDITAR" class="jtable-command-button jtable-edit-command-button" href="<?php echo base_url().'Proveedor_c/editar_proveedor/?id='.$value->id_proveedor; ?>"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a>
											<?php if ($value->id_estado=='1') { ?>
												<a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo(<?php echo $value->id_proveedor; ?>)"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>
											<?php }else{ ?>
												<a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="activo(<?php echo $value->id_proveedor; ?>)"><span style="color: #7cb342;" class="material-icons">done</span></a>
											<?php } ?>
										</center>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent"  id="agregar"   >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>


		<div id="mostrar_proveedor"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog md-card-hover " >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">PROVEEDOR</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<div class="md-card md-card-hover" id="mostrar_datos_proveedor">
								
							</div>
						</div>
					</div>            
				</div>
				<div class="uk-grid">
					
				</div> 
			</div>
		</div>
	</div>
	<?php include('public/js.inc');?>

	<script type="text/javascript">

		$('#agregar').click(function(){
			location.href = "<?php echo base_url();?>Proveedor_c/pagina_agregar"; 
		});

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

	/*	function mostrar_eliminar(id) {
			$.ajax({
				url : "<?php echo base_url();?>Proveedor_c/eliminar_proveedor",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#eliminar_proveedor").show();
					$("#id_eliminar_proveedor").val(type.id_proveedor);
				}
			});
		}

		function eliminar() {
			var t = $('#dt_default').dataTable();
			var id = $("#id_eliminar_proveedor").val();
			var nRow = $ ('#dt_default tr#'+ id)[0]; 
			t.fnDeleteRow(nRow); 
			$.ajax({
				url : "<?php echo base_url();?>Proveedor_c/eliminar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
				}
			});
		}*/

		function mostrar_proveedor(id) {
			
			$.ajax({
				url : "<?php echo base_url();?>Proveedor_c/mostrar_proveedor",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					$('#mostrar_datos_proveedor').html(data);	
					UIkit.modal("#mostrar_proveedor").show();
					
				}
			});
		}

	</script>
</body>
</html>