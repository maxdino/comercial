<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="es"> <!--<![endif]-->
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

		<h3 class="heading_b uk-margin-bottom">CATEGORIA</h3>
		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<div >
					<table id="dt_default" class="uk-table "   cellspacing="0"  width="100%">
						<thead>

							<tr>
								<th>ID</th>
								<th>CATEGORIA</th>
								<th>ESTADO</th>
								<th width="50px">ELIMINAR</th>
							</tr>
						</thead>

						<tbody id="pagina">
							<?php foreach($categoria as $value){ ?>
							<tr id="<?php echo $value->id_categoria; ?>" ondblclick="editar(<?php echo $value->id_categoria; ?>)" >
								<td><?php echo $value->id_categoria; ?></td>
								<td><?php echo $value->descripcion; ?></td>
								<td><?php echo $value->estado; ?></td>
								<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar(<?php echo $value->id_categoria; ?>)"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#agregar_categoria'}"  >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>

		<div id="agregar_categoria"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>

				<h2 class="heading_a">AGREGAR CATEGORIA</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="categoria">CATEGORIA<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="categoria" required class="md-input" />
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

		<div id="editar_categoria"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>

				<h2 class="heading_a">EDITAR CATEGORIA</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="modificar_categoria">CATEGORIA<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="modificar_categoria" value=" " required class="md-input" />
							<input type="hidden"   id="id_categoria" />
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

		<div id="eliminar_categoria"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog md-card md-card-danger" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">ELIMINAR CATEGORIA</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<p>¿Está seguro que desea eliminar esta Categoria?
							</p>
							<input type="hidden" id="id_eliminar_categoria" />
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

			var categoria = $('#categoria').val();
			if (categoria!='') {
			$.post("<?php echo base_url();?>Categoria_c/agregar", {"categoria": categoria}, function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var addData = []; 
				addData.push ('<td class="  ">'+$object.id_categoria+'</td>');
				addData.push ('<td class="  ">'+$object.descripcion+'</td>');
				addData.push ('<td class="  ">'+$object.estado+'</td>');
				addData.push ('<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_categoria+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>');
				t.fnAddData(addData);
				t.fnSort([0,'desc']);
				$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_categoria+')');
				$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_categoria);
				$('#categoria').val('');
			});
			}
		});

		$('#modificar').click(function(){

			var categoria = $('#modificar_categoria').val();
			var id = $('#id_categoria').val();
			if (categoria!='') {
				$.ajax({
					url : "<?php echo base_url();?>Categoria_c/modificar",
					data : {categoria : categoria, id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						var datos =  [$object.id_categoria,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_categoria+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_categoria)[0]);
						
						$('#categoria').val(''); 
					}
				});
			}
		});

		function editar(id) {
			$.ajax({
				url : "<?php echo base_url();?>Categoria_c/editar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#editar_categoria").show();
					$("#id_categoria").val(type.id_categoria);
					$("#modificar_categoria").val(type.descripcion);
				}
			});
		}

		function mostrar_eliminar(id) {
			$.ajax({
				url : "<?php echo base_url();?>Categoria_c/eliminar_categoria",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#eliminar_categoria").show();
					$("#id_eliminar_categoria").val(type.id_categoria);
				}
			});
		}

		function eliminar() {
			var t = $('#dt_default').dataTable();
			var id = $("#id_eliminar_categoria").val();
			var nRow = $ ('#dt_default tr#'+ id)[0]; 
			t.fnDeleteRow(nRow); 
			$.ajax({
				url : "<?php echo base_url();?>Categoria_c/eliminar",
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