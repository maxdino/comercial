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

		<h3 class="heading_b uk-margin-bottom">MARCAS</h3>

		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<table id="dt_default"   class="uk-table "   cellspacing="0"  width="100%">
					<thead>
						<tr>
							<th width="50px">ID</th>
							<th width="200px">MARCAS</th>
							<th width="80px">ESTADO</th>
							<th width="50px">ELIMINAR</th>
						</tr>
					</thead>
					<tbody >
						<?php foreach($marcas as $value){ ?>
						<tr id="<?php echo $value->id_marcas; ?>" ondblclick="editar(<?php echo $value->id_marcas; ?>)"  >
							<td><?php echo $value->id_marcas; ?></td>
							<td><?php echo $value->descripcion; ?></td>
							<td><?php echo $value->estado; ?></td>
							<td class="jtable-command-column" ><center> <a title="ELIMINAR" data-uk-modal="{target:'#eliminar_marcas'}" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar(<?php echo $value->id_marcas; ?>)"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>	 
			</div>
		</div>

		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#agregar_marcas'}"  >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>

		<div id="agregar_marcas"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">AGREGAR MARCAS</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="marcas">MARCAS<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="marcas" required class="md-input" />
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

		<div id="editar_marcas"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">EDITAR MARCAS</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="modificar_marcas">MARCAS<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="modificar_marcas" value=" " required class="md-input" />
							<input type="hidden"   id="id_marcas" />
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

		<div id="eliminar_marcas"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog md-card md-card-danger" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">ELIMINAR MARCAS</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<p>¿Está seguro que desea eliminar esta Marca?
							</p>
							<input type="hidden" id="id_eliminar_marcas" />
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

			var marcas = $('#marcas').val();
			if (marcas!='') {
			$.post("<?php echo base_url();?>Marcas_c/agregar", {"marcas": marcas}, function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var addData = []; 
				addData.push ('<td class="  ">'+$object.id_marcas+'</td>');
				addData.push ('<td class="  ">'+$object.descripcion+'</td>');
				addData.push ('<td class="  ">'+$object.estado+'</td>');
				addData.push ('<td class="jtable-command-column" ><center> <a title="ELIMINAR"  class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_marcas+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>');
				t.fnAddData(addData);
				t.fnSort([0,'desc']);
				$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_marcas+')');
				
				$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_marcas);
				$('#marcas').val('');
			});
		}
		});

		$('#modificar').click(function(){
			var marcas = $('#modificar_marcas').val();
			var id = $('#id_marcas').val();
			if (marcas!='') {
				$.ajax({
					url : "<?php echo base_url();?>Marcas_c/modificar",
					data : {marcas : marcas, id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						var datos =  [$object.id_marcas,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_marcas+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_marcas)[0]);
						$('#marcas').val('');
					}
				});
			}
		});


		function editar(id) {
			$.ajax({
				url : "<?php echo base_url();?>Marcas_c/editar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#editar_marcas").show();
					$("#id_marcas").val(type.id_marcas);
					$("#modificar_marcas").val(type.descripcion);
				}
			});
		}

		function mostrar_eliminar(id) {
			$.ajax({
				url : "<?php echo base_url();?>Marcas_c/eliminar_marcas",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#eliminar_marcas").show();
					$("#id_eliminar_marcas").val(type.id_marcas);
				}
			});
		}

		function eliminar() {
			var t = $('#dt_default').dataTable();
			var id = $("#id_eliminar_marcas").val();
			var nRow = $ ('#dt_default tr#'+ id)[0]; 
			t.fnDeleteRow(nRow); 
			$.ajax({
				url : "<?php echo base_url();?>Marcas_c/eliminar",
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