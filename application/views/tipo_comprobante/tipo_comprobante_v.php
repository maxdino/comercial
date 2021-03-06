<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="es"> <!--<![endif]-->
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" >
	<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Remove Tap Highlight on Windows Phone IE -->
	<meta name="msapplication-tap-highlight" content="no"/>

	<title>COMERCIAL HILARIO</title>

	<?php include('public/css.inc');?>
	<body class=" sidebar_main_open sidebar_main_swipe">
		<?php include('includes/menu.inc');?>  

		<h3 class="heading_b uk-margin-bottom">TIPO COMPROBANTE</h3>

		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<table id="dt_default"   class="uk-table "   cellspacing="0"  width="100%">
					<thead>
						<tr>
							<th width="50px">ID</th>
							<th width="200px">TIPO COMPROBANTE</th>
							<th width="80px">ESTADO</th>
							<th width="50px">ELIMINAR</th>
						</tr>
					</thead>
					<tbody >
						<?php foreach($tipo_comprobante as $value){ ?>
						<tr id="<?php echo $value->id_tipo_comprobante; ?>" ondblclick="editar(<?php echo $value->id_tipo_comprobante; ?>)"  >
							<td><?php echo $value->id_tipo_comprobante; ?></td>
							<td><?php echo $value->descripcion; ?></td>
							<td><?php echo $value->estado; ?></td>
							<td class="jtable-command-column" ><center> <a title="ELIMINAR" data-uk-modal="{target:'#eliminar_tipo_comprobante'}" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar(<?php echo $value->id_tipo_comprobante; ?>)"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>	 
			</div>
		</div>

		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#agregar_tipo_comprobante'}"  >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>

		<div id="agregar_tipo_comprobante"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">AGREGAR TIPO COMPROBCANTE</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="tipo_comprobante">TIPO COMPROBANTE<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="tipo_comprobante" required class="md-input" />
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

		<div id="editar_tipo_comprobante"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">EDITAR TIPO COMPROBANTE</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="modificar_tipo_comprobante">TIPO COMPROBANTE<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="modificar_tipo_comprobante" value=" " required class="md-input" />
							<input type="hidden"   id="id_tipo_comprobante" />
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

		<div id="eliminar_tipo_comprobante"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog md-card md-card-danger" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">ELIMINAR TIPO COMPROBANTE</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<p>¿Está seguro que desea eliminar este Tipo comprobante?
							</p>
							<input type="hidden" id="id_eliminar_tipo_comprobante" />
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

			var tipo_comprobante = $('#tipo_comprobante').val();
			if (tipo_comprobante!='') {
			$.post("<?php echo base_url();?>tipo_comprobante_c/agregar", {"tipo_comprobante": tipo_comprobante}, function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var addData = []; 
				addData.push ('<td class="  ">'+$object.id_tipo_comprobante+'</td>');
				addData.push ('<td class="  ">'+$object.descripcion+'</td>');
				addData.push ('<td class="  ">'+$object.estado+'</td>');
				addData.push ('<td class="jtable-command-column" ><center> <a title="ELIMINAR"  class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_tipo_comprobante+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>');
				t.fnAddData(addData);
				t.fnSort([0,'desc']);
				$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_tipo_comprobante+')');
				
				$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_tipo_comprobante);
				$('#tipo_comprobante').val('');

			});
		}
		});

		$('#modificar').click(function(){
			var tipo_comprobante = $('#modificar_tipo_comprobante').val();
			var id = $('#id_tipo_comprobante').val();
			if (tipo_comprobante!='') {
				$.ajax({
					url : "<?php echo base_url();?>tipo_comprobante_c/modificar",
					data : {tipo_comprobante : tipo_comprobante, id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						var datos =  [$object.id_tipo_comprobante,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_tipo_comprobante+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_tipo_comprobante)[0]);
						$('#tipo_comprobante').val('');
					}
				});
			}
		});


		function editar(id) {
			$.ajax({
				url : "<?php echo base_url();?>tipo_comprobante_c/editar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#editar_tipo_comprobante").show();
					$("#id_tipo_comprobante").val(type.id_tipo_comprobante);
					$("#modificar_tipo_comprobante").val(type.descripcion);
				}
			});
		}

		function mostrar_eliminar(id) {
			$.ajax({
				url : "<?php echo base_url();?>tipo_comprobante_c/eliminar_tipo_comprobante",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#eliminar_tipo_comprobante").show();
					$("#id_eliminar_tipo_comprobante").val(type.id_tipo_comprobante);
				}
			});
		}

		function eliminar() {
			var t = $('#dt_default').dataTable();
			var id = $("#id_eliminar_tipo_comprobante").val();
			var nRow = $ ('#dt_default tr#'+ id)[0]; 
			t.fnDeleteRow(nRow); 
			$.ajax({
				url : "<?php echo base_url();?>tipo_comprobante_c/eliminar",
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