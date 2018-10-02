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

	<?php include('public/css.inc');?>
	<body class=" sidebar_main_open sidebar_main_swipe">
		<?php include('includes/menu.inc');?>  

		<h3 class="heading_b uk-margin-bottom">COMPRAS </h3>
		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<div >
					<table id="dt_default" class="uk-table "   cellspacing="0"  width="100%">
						<thead>

							<tr>
								<th>ID</th>
								<th>TIPO DOCUMENTO</th>
								<th>NUMERO DOCUMENTO</th>
								<th>FECHA</th>
								<th>SUBTOTAL</th>
								<th>ESTADO</th>
								<th width="50px">OPCIONES</th>
							</tr>
						</thead>

						<tbody id="pagina">
							<?php foreach($compra as $value){ ?>
							<tr id="<?php echo $value->id_compra; ?>"  >
								<td><?php echo $value->id_compra; ?></td>
								<td><?php echo $value->tipo_comprobante; ?></td>
								<td><?php echo $value->nro_factura; ?></td>
								<td><?php echo $value->fecha; ?></td>
								<td><?php echo 'S/.'.$value->subtotal; ?></td>
								<td><?php echo $value->estados; ?></td>
								<td class="jtable-command-column">
									<center>
										<a title="VER" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_proveedor(<?php echo $value->id_compra; ?>)" ><span class="material-icons" style="color: #cccc00;" >visibility</span></a>	
										<a title="EDITAR" class="jtable-command-button jtable-edit-command-button" href="<?php echo base_url().'Proveedor_c/editar_proveedor/?id='.$value->id_compra; ?>"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a>
										<a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar(<?php echo $value->id_compra; ?>)"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a>
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
                                    <a class="md-fab md-fab-small md-fab-success" title="FACTURA" href="<?php echo base_url();?>Compra_c/factura"><i class="material-icons">&#xe242;</i></a>
                                    <a class="md-fab md-fab-small md-fab-success" title="BOLETA" href="<?php echo base_url();?>Compra_c/boleta"><i class="material-icons">&#xe241;</i></a>
                                    <a class="md-fab md-fab-small md-fab-success" title="GUIA DE REMISIÓN" href="<?php echo base_url();?>Compra_c/guia"><i class="material-icons">&#xe065;</i></a>
                                </div>
                            </div>
		<div id="eliminar_proveedor"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog md-card md-card-danger" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">ELIMINAR PROVEEDOR</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<p>¿Está seguro que desea eliminar esta proveedor?
							</p>
							<input type="hidden" id="id_eliminar_proveedor" />
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

		<div id="mostrar_proveedor"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog md-card-hover " >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">COMPRA</h2>
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
			location.href = "<?php echo base_url();?>Compra_c/formato"; 
		});

		$('#modificar').click(function(){

			var proveedor = $('#modificar_proveedor').val();
			var id = $('#id_compra').val();
			if (proveedor!='') {
				$.ajax({
					url : "<?php echo base_url();?>proveedor_c/modificar",
					data : {proveedor : proveedor, id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						var datos =  [$object.id_compra,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_compra+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_compra)[0]);
						
						$('#proveedor').val(''); 
					}
				});
			}
		});

		function mostrar_eliminar(id) {
			$.ajax({
				url : "<?php echo base_url();?>Proveedor_c/eliminar_proveedor",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#eliminar_proveedor").show();
					$("#id_eliminar_proveedor").val(type.id_compra);
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
		}

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