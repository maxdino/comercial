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

		<h3 class="heading_b uk-margin-bottom">PRODUCTOS</h3>
		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<div > 
					<table id="dt_default" class="uk-table "   cellspacing="0"  width="100%">
						<thead>

							<tr>
								<th>ID</th>
								<th>CODIGO</th>
								<th>PRODUCTOS</th>
								<th>FECHA</th>
								<th>MARCAS</th>
								<th>CATEGORIA</th>
								<th>ESTADO</th>
								<th width="50px">OPCIONES</th>
							</tr>
						</thead>
						<tbody id="pagina">
							<?php foreach($productos as $value){
								$f=$value->fecha;
								$anio=$f[0].$f[1].$f[2].$f[3];
								$mes=$f[5].$f[6];
								$dia=$f[8].$f[9]; ?>
								<tr id="<?php echo $value->id_productos; ?>" class="fila" >
									<td><?php echo $value->id_productos; ?></td>
									<td><?php echo $value->id_productos.$value->id_marcas.$value->id_categoria.$value->id_material.$anio.$mes.$dia; ?></td>
									<td><?php echo $value->descripcion; ?></td>
									<td><?php echo $value->fecha; ?></td>
									<td><?php echo $value->marcas; ?></td>
									<td><?php echo $value->categoria; ?></td>
									<td><?php echo $value->estado; ?></td>
									<td class="jtable-command-column">
										<center>
											<a title="VER" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_producto(<?php echo $value->id_productos; ?>)" ><span class="material-icons" style="color: #eae902;" >visibility</span></a>
											<a title="EDITAR" class="jtable-command-button jtable-edit-command-button" href="<?php echo base_url().'Productos_c/editar_productos/?id='.$value->id_productos; ?>"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a>
											<?php if ($value->id_estado=='1') { ?>
											<a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo(<?php echo $value->id_productos; ?>)"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>
											<?php }else{ ?>
											<a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="activo(<?php echo $value->id_productos; ?>)"><span style="color: #7cb342;" class="material-icons">done</span></a>
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
		<div id="eliminar_productos"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog md-card md-card-danger" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">ELIMINAR PRODUCTOS</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<p>¿Está seguro que desea eliminar esta productos?
							</p>
							<input type="hidden" id="id_eliminar_productos" />
						</div>
					</div>            
				</div>
				<div class="uk-grid">
					<div class="uk-width-1-1">
						<button type="submit" class="md-btn md-btn-danger uk-modal-close" onclick="eliminar()" >ELIMINAR</button>
					</div>
				</div> 
			</div>
		</div>
		<div id="mostrar_producto"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog  md-card-hover" style="width: 350px;"  >
			<div   style="margin-left: -24px;margin-top: -24px; width: 350px;" >
					<div class="uk-width-medium-1-1"  > 
						<div class="parsley-row"   id="mostrar_datos_productos">
							 
						</div>
					</div>            
				</div>
				
			</div>
		</div>
	</div>
	<?php include('public/js.inc');?>

	<script type="text/javascript">

		$('#agregar').click(function(){
			location.href = "<?php echo base_url();?>productos_c/pagina_agregar"; 
		});
 
		function inactivo(id) {
			$.ajax({
					url : "<?php echo base_url();?>Productos_c/inactivo",
					data : { id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						var datos =  [$object.id_productos,$object.codigo,$object.productos,$object.fecha,$object.marcas,$object.categoria,$object.estado,'<td class="jtable-command-column"><center><a title="VER" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_producto('+$object.id_productos+')" ><span class="material-icons" style="color: #eae902;" >visibility</span></a> <a title="EDITAR" class="jtable-command-button jtable-edit-command-button" href="'+$object.url+$object.id_productos+'"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a> <a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_productos+')"><span style="color: #7cb342;" class="material-icons">done</span></a></center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_productos)[0]);
						
						$('#almacen').val(''); 
					}
				});
		}

		function activo(id) {
			$.ajax({
					url : "<?php echo base_url();?>Productos_c/activo",
					data : { id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						var datos =  [$object.id_productos,$object.codigo,$object.productos,$object.fecha,$object.marcas,$object.categoria,$object.estado,'<td class="jtable-command-column"><center><a title="VER" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_producto('+$object.id_productos+')" ><span class="material-icons" style="color: #eae902;" >visibility</span></a> <a title="EDITAR" class="jtable-command-button jtable-edit-command-button" href="'+$object.url+$object.id_productos+'"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a> <a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_productos+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_productos)[0]);
						
						$('#almacen').val(''); 
					}
				});
		}

		function mostrar_producto(id) {
			$.ajax({
				url : "<?php echo base_url();?>Productos_c/mostrar_producto",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					$('#mostrar_datos_productos').html(data);	
					UIkit.modal("#mostrar_producto").show();
					
				}
			});
		}

	</script>
</body>
</html>