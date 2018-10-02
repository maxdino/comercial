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

		<h3 class="heading_b uk-margin-bottom">UNIDAD MEDIDA</h3>
		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<div >
					<table id="dt_default" class="uk-table "   cellspacing="0"  width="100%">
						<thead>

							<tr>
								<th>ID</th>
								<th>UNIDAD MEDIDA</th>
								<th>UNIDAD</th>
								<th>ESTADO</th>
								<th width="50px">ELIMINAR</th>
							</tr>
						</thead>

						<tbody id="pagina">
							<?php foreach($unidad as $value){ ?>
							<tr id="<?php echo $value->id_unidad_medida; ?>" ondblclick="editar(<?php echo $value->id_unidad_medida; ?>)" >
								<td><?php echo $value->id_unidad_medida; ?></td>
								<td><?php echo $value->unidad_medida; ?></td>
								<td><?php echo $value->unidad; ?></td>
								<td><?php echo $value->estado; ?></td>
								<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar(<?php echo $value->id_unidad_medida; ?>)"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#agregar_unidad_medida'}"  >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>

		<div id="agregar_unidad_medida"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>

				<h2 class="heading_a">AGREGAR UNIDAD MEDIDA</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="unidad_medida">UNIDAD MEDIDA<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="unidad_medida" required class="md-input" />
							<label for="modificar_unidad_medida">CANTIDAD EN UNIDADES<span class="req">*</span></label>
							<input type="text"  id="unidad"   required class="md-input solo-numero" />
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

		<div id="editar_unidad_medida"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>

				<h2 class="heading_a">EDITAR UNIDAD MEDIDA</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="modificar_unidad_medida">UNIDAD MEDIDA<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="modificar_unidad_medida" value=" " required class="md-input" />
							<input type="hidden"   id="id_unidad_medida" />
							<br>
							<label for="modificar_unidad_medida">CANTIDAD EN UNIDADES<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="modificar_unidad" value=" " required class="md-input solo-numero" />
						</div>
					</div>            
				</div>

				<div class="uk-grid">
					<div class="uk-width-1-1">
						<button type="submit" class="md-btn md-btn-primary uk-modal-close" style="cursor:" id="modificar" >GUARDAR</button>
					</div>
				</div> 
			</div>
		</div>

		<div id="eliminar_unidad_medida"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog md-card md-card-danger" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">ELIMINAR UNIDAD MEDIDA</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<p>¿Está seguro que desea eliminar esta unidad medida?
							</p>
							<input type="hidden" id="id_eliminar_unidad_medida" />
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

			var unidad_medida = $('#unidad_medida').val();
			var unidad = $('#unidad').val();
			if (unidad_medida!='' && unidad !='' ) {
			$.post("<?php echo base_url();?>unidad_medida_c/agregar", {"unidad_medida": unidad_medida,"unidad": unidad }, function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var addData = []; 
				addData.push ('<td class="  ">'+$object.id_unidad_medida+'</td>');
				addData.push ('<td class="  ">'+$object.unidad_medida+'</td>');
				addData.push ('<td class="  ">'+$object.unidad+'</td>');
				addData.push ('<td class="  ">'+$object.estado+'</td>');
				addData.push ('<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_unidad_medida+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>');
				t.fnAddData(addData);
				t.fnSort([0,'desc']);
				$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_unidad_medida+')');
				$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_unidad_medida);
				$('#unidad_medida').val('');
				$('#unidad').val('');
			});
		}
		});

		$('#modificar').click(function(){

			var unidad_medida = $('#modificar_unidad_medida').val();
			var unidad = $('#modificar_unidad').val();
			var id = $('#id_unidad_medida').val();
			if (unidad_medida!=''  && unidad !='' ) {
				$.ajax({
					url : "<?php echo base_url();?>unidad_medida_c/modificar",
					data : {unidad_medida : unidad_medida, unidad : unidad , id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						var datos =  [$object.id_unidad_medida,$object.unidad_medida,$object.unidad,$object.estado,'<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_unidad_medida+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_unidad_medida)[0]);
						$('#unidad').val(''); 
						$('#unidad_medida').val(''); 
					}
				});
			}
		});

		function editar(id) {
			$.ajax({
				url : "<?php echo base_url();?>unidad_medida_c/editar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#editar_unidad_medida").show();
					$("#id_unidad_medida").val(type.id_unidad_medida);
					$("#modificar_unidad_medida").val(type.unidad_medida);
					$("#modificar_unidad").val(type.unidad);
				}
			});
		}

		function mostrar_eliminar(id) {
			$.ajax({
				url : "<?php echo base_url();?>unidad_medida_c/eliminar_unidad_medida",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#eliminar_unidad_medida").show();
					$("#id_eliminar_unidad_medida").val(type.id_unidad_medida);
				}
			});
		}

		function eliminar() {
			var t = $('#dt_default').dataTable();
			var id = $("#id_eliminar_unidad_medida").val();
			var nRow = $ ('#dt_default tr#'+ id)[0]; 
			t.fnDeleteRow(nRow); 
			$.ajax({
				url : "<?php echo base_url();?>unidad_medida_c/eliminar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
				}
			});
		}

		$(document).ready(function (){
  $('.solo-numero').keyup(function (){
    this.value = (this.value + '').replace(/[^0-9]/g, '');
  });
});
	</script>
</body>
</html>