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
	<body class=" sidebar_main_open sidebar_main_swipe">
		<?php include('includes/menu.inc');?>  

		<h3 class="heading_b uk-margin-bottom">COLORES</h3>

		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<table id="dt_default"   class="uk-table"   cellspacing="0"  width="100%">
					<thead>
						<tr>
							<th width="50px">ID</th>
							<th width="200px">COLOR</th>
							<th width="80px">ESTADO</th>
							<th width="50px">ELIMINAR</th>
						</tr>
					</thead>
					<tbody >
						<?php foreach($colores as $value){ ?>
						<tr id="<?php echo $value->id_colores; ?>" ondblclick="editar(<?php echo $value->id_colores; ?>)"  >
							<td><?php echo $value->id_colores; ?></td>
							<td><?php echo $value->descripcion; ?></td>
							<td><?php echo $value->estado; ?></td>
							<td class="jtable-command-column" ><center> <a title="ELIMINAR" data-uk-modal="{target:'#eliminar_colores'}" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar(<?php echo $value->id_colores; ?>)"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>	 
			</div>
		</div>
 
		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#agregar_colores'}"  >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>

		<div id="agregar_colores"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">AGREGAR COLOR</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="colores">COLOR<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="colores" required class="md-input" />
						</div>
					</div>   
					<br><br><br>
					 <div class="uk-width-medium-1-1">
						<div class="parsley-row"> 
							<label for="colores">CODIGO<span class="req">*</span></label>
							<input type="color"  id="codigo" required   />	  
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

		<div id="editar_colores"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">EDITAR COLOR</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<label for="modificar_colores">COLOR<span class="req">*</span></label>
							<input type="text" style="text-transform: uppercase;"  id="modificar_colores" value=" " required class="md-input" />
							<input type="hidden"   id="id_colores" />
						</div>
						<br>
					 <div class="uk-width-medium-1-1">
						<div class="parsley-row"> 
							<label for="colores">CODIGO<span class="req">*</span></label>
							<input type="color"  id="modificar_codigo" required   />	  
						</div>
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

		<div id="eliminar_colores"  class="uk-modal" role="dialog">
			<div class="uk-modal-dialog md-card md-card-danger" >
				<button type="button" class="uk-modal-close uk-close"></button>
				<h2 class="heading_a">ELIMINAR COLOR</h2>
				<div id="form_validation" class="uk-grid" data-uk-grid-margin>
					<div class="uk-width-medium-1-1">
						<div class="parsley-row">
							<p>¿Está seguro que desea eliminar esta Color?
							</p>
							<input type="hidden" id="id_eliminar_colores" />
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
			var codigo = $('#codigo').val();
			var colores = $('#colores').val();
			if (colores!=''&&codigo!='') {
			$.post("<?php echo base_url();?>colores_c/agregar", {"colores": colores,"codigo": codigo}, function(data) {
				$object = jQuery.parseJSON(data);
				var t = $('#dt_default').dataTable();
				var addData = []; 
				addData.push ('<td class="  ">'+$object.id_colores+'</td>');
				addData.push ('<td class="  ">'+$object.descripcion+'</td>');
				addData.push ('<td class="  ">'+$object.estado+'</td>');
				addData.push ('<td class="jtable-command-column" ><center> <a title="ELIMINAR"  class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_colores+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>');
				t.fnAddData(addData);
				t.fnSort([0,'desc']);
				$('#dt_default tr:gt(0):lt(1)').attr('ondblclick','editar('+$object.id_colores+')');
				
				$('#dt_default tr:gt(0):lt(1)').prop('id',$object.id_colores);
				$('#colores').val('');
			});
		}
		});

		$('#modificar').click(function(){
			var colores = $('#modificar_colores').val();
			var codigo = $('#modificar_codigo').val();
			var id = $('#id_colores').val();
			if (colores!='') {
				$.ajax({
					url : "<?php echo base_url();?>colores_c/modificar",
					data : {colores : colores,codigo : codigo, id : id},
					type : 'POST',
					success : function(data) {
						$object = jQuery.parseJSON(data);
						var t = $('#dt_default').dataTable();
						var datos =  [$object.id_colores,$object.descripcion,$object.estado,'<td class="jtable-command-column"><center><a title="ELIMINAR" class="jtable-command-button jtable-edit-command-button" onclick="mostrar_eliminar('+$object.id_colores+')"><span style="color: #ff4d4d;" class="uk-icon-trash"></span></a></center></td>'];
						t.fnUpdate(datos,$('#dt_default tr#'+$object.id_colores)[0]);
						$('#colores').val('');
					}
				});
			}
		});

		function editar(id) {
			$.ajax({
				url : "<?php echo base_url();?>colores_c/editar",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#editar_colores").show();
					$("#id_colores").val(type.id_colores);
					$("#modificar_colores").val(type.descripcion);
					$("#modificar_codigo").val(type.codigo);
				}
			});
		}

		function mostrar_eliminar(id) {
			$.ajax({
				url : "<?php echo base_url();?>colores_c/eliminar_colores",
				data : {id : id},
				type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					UIkit.modal("#eliminar_colores").show();
					$("#id_eliminar_colores").val(type.id_colores);
				}
			});
		}

		function eliminar() {
			var t = $('#dt_default').dataTable();
			var id = $("#id_eliminar_colores").val();
			var nRow = $ ('#dt_default tr#'+ id)[0]; 
			t.fnDeleteRow(nRow); 
			$.ajax({
				url : "<?php echo base_url();?>colores_c/eliminar",
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