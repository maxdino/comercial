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

		<h3 class="heading_b uk-margin-bottom">PACK COLORES</h3>

		<div class="md-card uk-margin-medium-bottom">
			<div class="md-card-content">
				<table id="dt_default"   class="uk-table"   cellspacing="0"  width="100%">
					<thead>
						<tr>
							<th width="50px">ID</th>
							<th width="200px">DESCRIPCIÓN</th>
							<th width="80px">ESTADO</th>
							<th width="50px"></th>
						</tr>
					</thead>
					<tbody >
						<?php foreach($pack as $value){ ?>
						<tr id="<?php echo $value->id_pack_colores; ?>" class="fila" >
							<td><?php echo $value->id_pack_colores; ?></td>
							<td><?php echo $value->pack_colores; ?></td>
							<td><?php echo $value->estado; ?></td>
							<td class="jtable-command-column" ><center>
								<a title="EDITAR" class="jtable-command-button jtable-edit-command-button" href="<?php echo base_url().'Pack_colores_c/editar/?id='.$value->id_pack_colores; ?>"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a>
								<?php if ($value->id_estado=='1') { ?>
								<a title="INACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="inactivo(<?php echo $value->id_pack_colores; ?>)"><span style="color: #ff4d4d;" class="material-icons">delete</span></a>
								<?php }else { ?>
								<a title="ACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="activo(<?php echo $value->id_pack_colores; ?>)"><span style="color: #7cb342;" class="material-icons">done</span></a>
								<?php } ?>
							</center>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>	 
			</div>
		</div>
		
		<div class="md-fab-wrapper">
			<a class="md-fab md-fab-accent" href="<?php echo base_url();?>Pack_colores_c/nuevo" id="recordAdd"   >
				<i class="material-icons">&#xE145;</i>
			</a>
		</div>
	</div>
	<?php include('public/js.inc');?>

	<script type="text/javascript">
		function inactivo(id) {
			$.ajax({
				url : "<?php echo base_url();?>Pack_colores_c/inactivo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_pack_colores,$object.pack_colores,$object.estado,'<td class="jtable-command-column"><center> <a title="EDITAR" class="jtable-command-button jtable-edit-command-button" href="'+$object.url+$object.id_pack_colores+'"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a> <a title="ACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="activo('+$object.id_pack_colores+')"><span style="color: #7cb342;" class="material-icons">done</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_pack_colores)[0]);
				}
			});
		}

		function activo(id) {
			$.ajax({
				url : "<?php echo base_url();?>Pack_colores_c/activo",
				data : { id : id},
				type : 'POST',
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var t = $('#dt_default').dataTable();
					var datos =  [$object.id_pack_colores,$object.pack_colores,$object.estado,'<td class="jtable-command-column"><center> <a title="EDITAR" class="jtable-command-button jtable-edit-command-button" href="'+$object.url+$object.id_pack_colores+'"><span style="color: #3399fff5;" class="uk-icon-pencil"></span></a> <a title="INACTIVO" class="jtable-command-button jtable-edit-command-button" onclick="inactivo('+$object.id_pack_colores+')"><span style="color: #ff4d4d;" class="material-icons">delete</span></a></center></td>'];
					t.fnUpdate(datos,$('#dt_default tr#'+$object.id_pack_colores)[0]);
				}
			});
		}

	</script>
</body>
</html>