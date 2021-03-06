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

		<h3 class="heading_b uk-margin-bottom">TALLAS</h3>
		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<div >
					<table id="dt_default" class="uk-table "   cellspacing="0"  width="100%">
						<thead>

							<tr>
								<th>ID</th>
								<th>TALLAS</th>
								<th>ESTADO</th>
								<th width="50px">ELIMINAR</th>
							</tr>
						</thead>

						<tbody id="pagina">
							<?php foreach($tallas as $value){ ?>
							<tr id="<?php echo $value->id_tallas; ?>" ondblclick="editar(<?php echo $value->id_tallas; ?>)" >
								<td><?php echo $value->id_tallas; ?></td>
								<td><?php echo $value->descripcion; ?></td>
								<td><?php echo $value->estado; ?></td>
								<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar(<?php echo $value->id_tallas; ?>)"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#agregar_tallas'}"  >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>

		<div id="agregar_tallas"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>

				<h2 class="heading_a">AGREGAR TALLAS</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="tallas">TALLAS<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="tallas" required class="md-input" />
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

		<div id="editar_tallas"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>

				<h2 class="heading_a">EDITAR TALLAS</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="modificar_tallas">TALLAS<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="modificar_tallas" value=" " required class="md-input" />
							<input type="hidden"   id="id_tallas" />
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

		<div id="eliminar_tallas"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog md-card md-card-danger" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">ELIMINAR TALLAS</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<p>¿Está seguro que desea eliminar esta tallas?
							</p>
							<input type="hidden" id="id_eliminar_tallas" />
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

			var tallas = $('#tallas').val();
			if (tallas!='') {
			$.post("<?php echo base_url();?>Tallas_c/agregar", {"tallas": tallas}, function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var addData = []; 
				addData.push ('<td class="  ">'+$object.id_tallas+'</td>');
				addData.push ('<td class="  ">'+$object.descripcion+'</td>');
				addData.push ('<td class="  ">'+$object.estado+'</td>');
				addData.push ('<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_tallas+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>');
				t.fnAddData(addData);
				t.fnSort([0,'desc']);
				$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_tallas+')');
				$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_tallas);
				$('#tallas').val('');
			});
		}
		});

		$('#modificar').click(function(){

			var tallas = $('#modificar_tallas').val();
			var id = $('#id_tallas').val();
			if (tallas!='') {
				$.ajax({
					url : "<?php echo base_url();?>Tallas_c/modificar",
					data : {tallas : tallas, id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						var datos =  [$object.id_tallas,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_tallas+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_tallas)[0]);
						
						$('#tallas').val(''); 
					}
				});
			}
		});

		function editar(id) {
			$.ajax({
				url : "<?php echo base_url();?>Tallas_c/editar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#editar_tallas").show();
					$("#id_tallas").val(type.id_tallas);
					$("#modificar_tallas").val(type.descripcion);
				}
			});
		}

		function mostrar_eliminar(id) {
			$.ajax({
				url : "<?php echo base_url();?>Tallas_c/eliminar_tallas",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#eliminar_tallas").show();
					$("#id_eliminar_tallas").val(type.id_tallas);
				}
			});
		}

		function eliminar() {
			var t = $('#dt_default').dataTable();
			var id = $("#id_eliminar_tallas").val();
			var nRow = $ ('#dt_default tr#'+ id)[0]; 
			t.fnDeleteRow(nRow); 
			$.ajax({
				url : "<?php echo base_url();?>Tallas_c/eliminar",
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