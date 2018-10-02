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
	<h3 class="heading_b uk-margin-bottom">CIERRE CAJA</h3>
	<div class="md-card uk-margin-medium-bottom">
		<div class="md-card-content">
			<table id="dt_default"   class="uk-table"   cellspacing="0"  width="100%">
				<thead>
					<tr>
						
						<th width="200px">USUARIO</th>
						<th width="50px">CAJA</th>
						<th width="80px">FECHA INICIO</th>
						<th width="50px">MONTO INICIAL</th>
						<th width="80px">FECHA CIERRE</th>
						<th width="50px">MONTO CIERRE</th>
						<th width="50px">ESTADO CAJA</th>
						<th width="50px"></th>
					</tr>
				</thead>
				<tbody >
					<?php foreach($cierre as $value){ ?>
					<tr id="<?php echo $value->id_sesion_caja; ?>"  class="fila"  >
						<td><?php echo $value->nombre.' '.$value->apellido; ?></td>
						<td><?php echo $value->descripcion; ?></td>
						<td><?php echo $value->fecha_entrada; ?></td>
						<td><?php echo number_format($value->monto_inicial, 2, '.', ''); ?></td>
						<td><?php echo $value->fecha_salida; ?></td>
						<td><?php echo number_format($value->monto_cierre, 2, '.', ''); ?></td>
						<?php if($value->fecha_salida!=''&&$value->fecha_salida!=null&&$value->fecha_salida!='0000-00-00 00:00:00'){ ?>
						<td><?php echo 'CERRADO'; ?></td>
						<?php }else{ ?>
						<td><?php echo 'ABIERTO'; ?></td>
						<?php } ?>
						<td><center>
							<?php if($value->fecha_salida!=''&&$value->fecha_salida!=null&&$value->fecha_salida!='0000-00-00 00:00:00'){ ?>
							<a title="CAJA CERRADA" class="jtable-command-button jtable-edit-command-button" >[Re-imprimir]</a>
							<?php }else{ ?>
							<a title="CERRAR CAJA" class="jtable-command-button jtable-edit-command-button" onclick="cerrar(<?php echo $value->id_sesion_caja; ?>)" >[Cierre Caja]</a>
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
<?php include('public/js.inc');?>

<script type="text/javascript">
	function cerrar(id){
		$.post("<?php echo base_url();?>Cierre_caja_c/agregar", {"id": id}, function(data) {
			$object = jQuery.parseJSON(data);
			var t = $('#dt_default').dataTable();
			var datos =  [$object.usuario,$object.caja,$object.fecha,parseFloat($object.monto).toFixed(2),$object.fecha_salida,parseFloat($object.monto_cierre).toFixed(2),'CERRADO','<td class="jtable-command-column"><center><a title="CAJA CERRADA" class="jtable-command-button jtable-edit-command-button" >[Re-imprimir]</a></center></td>'];
			t.fnUpdate(datos,$('#dt_default tr#'+$object.id_sesion_caja)[0]);
		});
	}

</script>
</body>
</html>