<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="msapplication-tap-highlight" content="no"/>
	<title>COMERCIAL HILARIO</title>
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/foto/logo/logo_3.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/foto/logo/logo_3.png" sizes="32x32">
	<?php include('public/css.inc');?>
	<body class=" sidebar_main_open sidebar_main_swipe">
		<?php include('includes/menu.inc');?>  

		<h3 class="heading_b uk-margin-bottom">ALMACEN</h3>
		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<div >
					<table id="dt_default" class="uk-table "   cellspacing="0"  width="100%">
						<thead>

							<tr>
								<th>ID</th>
								<th>ALMACEN</th>
								<th width="50px">ELIMINAR</th>
							</tr>
						</thead>

						<tbody id="pagina">
							<?php foreach($almacen as $value){ ?>
							<tr id="<?php echo $value->id_almacen; ?>" ondblclick="editar(<?php echo $value->id_almacen; ?>)" >
								<td><?php echo $value->id_almacen; ?></td>
								<td><?php echo $value->almacen; ?></td>
								<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar(<?php echo $value->id_almacen; ?>)"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#agregar_almacen'}"  >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>

		<div id="agregar_almacen"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>

				<h2 class="heading_a">AGREGAR ALMACEN</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="almacen">ALMACEN<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="almacen" required class="md-input" />
						</div>
					</div>            
				</div>

				<div class="uk-grid">
					<div class="uk-width-1-1">
						<button type="submit" class="md-btn md-btn-primary" id="guardar" >GUARDAR</button>
					</div>
				</div> 
			</div>
		</div>

		<div id="editar_almacen"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>

				<h2 class="heading_a">EDITAR ALMACEN</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="modificar_almacen">ALMACEN<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="modificar_almacen" value=" " required class="md-input" />
							<input type="hidden" id="id_almacen" />
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

		<div id="eliminar_almacen"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog md-card md-card-danger" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">ELIMINAR ALMACEN</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<p>¿Está seguro que desea eliminar esta Almacen?
							</p>
							<input type="hidden" id="id_eliminar_almacen" />
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

	</div>
	<?php include('public/js.inc');?>

	<script type="text/javascript">

		$('#guardar').click(function(){

			var almacen = $('#almacen').val();
			if (almacen!='') {
			$.post("<?php echo base_url();?>Almacen_c/agregar", {"almacen": almacen}, function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var addData = []; 
				addData.push ('<td class="  ">'+$object.id_almacen+'</td>');
				addData.push ('<td class="  ">'+$object.almacen+'</td>');
				addData.push ('<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_almacen+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>');
				t.fnAddData(addData);
				t.fnSort([0,'desc']);
				$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_almacen+')');
				$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_almacen);
				$('#almacen').val('');
			});
			}
		});

		$('#modificar').click(function(){

			var almacen = $('#modificar_almacen').val();
			var id = $('#id_almacen').val();
			if (almacen!='') {
				$.ajax({
					url : "<?php echo base_url();?>Almacen_c/modificar",
					data : {almacen : almacen, id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						var datos =  [$object.id_almacen,$object.almacen,'<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_almacen+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_almacen)[0]);
						
						$('#almacen').val(''); 
					}
				});
			}
		});

		function editar(id) {
			$.ajax({
				url : "<?php echo base_url();?>Almacen_c/editar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#editar_almacen").show();
					$("#id_almacen").val(type.id_almacen);
					$("#modificar_almacen").val(type.almacen);
				}
			});
		}

		function mostrar_eliminar(id) {
			$.ajax({
				url : "<?php echo base_url();?>Almacen_c/eliminar_almacen",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#eliminar_almacen").show();
					$("#id_eliminar_almacen").val(type.id_almacen);
				}
			});
		}

		function eliminar() {
			var t = $('#dt_default').dataTable();
			var id = $("#id_eliminar_almacen").val();
			var nRow = $ ('#dt_default tr#'+ id)[0]; 
			t.fnDeleteRow(nRow); 
			$.ajax({
				url : "<?php echo base_url();?>Almacen_c/eliminar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
				}
			});
		}

	</script>
</body>
</html>