<html>
<head>
	<title>Ecstasy Gym</title>
	<!-- start: META -->
	<meta charset="utf-8" />
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta content="" name="description" />
	<meta content="" name="author" />
	<?php include('public/css.inc');?>
</head>
<body>
	<?php include('includes/menu.inc');?>
		

				<div class="container">
					<div class="toolbar row">
						<div class="col-sm-6 hidden-xs">
							<div class="page-header">
								<h1>Compras <small>Se guardarán los datos de las compras</small></h1>
							</div>
						</div>

					</div>
					<br>
					<div class="row">
							<div class="col-sm-12">
								<!-- start: TEXT FIELDS PANEL -->
								<div class="panel panel-white">

									<div class="panel-body">
										<div class="row">
											<div class="col-md-12 space20">
												<button class="btn btn-green add-row" id="boton">
													Nueva Compra <i class="fa fa-plus"></i>
												</button>
											</div>
										</div>
										<?php if(count($compras)>0){ ?>
											<div class="table-responsive">
												<table class="table table-striped table-hover" id="tabla_default">
													<thead>
														<tr>
														<th>ID</th>
														<th>FECHA</th>
														<th>PROVEEDOR</th>
														<th>EMPLEADO </th>
														<th>MODALIDAD TRANSACCION</th>
														<th>MONTO</th>
														<th>ACCIONES</th>
														
														</tr>
													</thead>
													<tbody id="tabla_perfil">
														<?php  $i = 0 ;foreach ($compras as $value) { ?>
									<tr>
										<td><?php echo $value->id_compras; ?></td>
										<td ><?php echo $value->fecha; ?></td>
										<td><?php  foreach ($proveedor as $values) {
											if ($value->id_proveedor==$values->id_proveedor) {
												echo $values->razon_social;
											}

										}?> </td>
										<td><?php foreach ($empleado as $values) {
											if ($value->id_empleado==$values->id_empleado) {
												echo $values->nombre.' '.$values->apellido_paterno;
											}

										} ?></td>
											<td class="hidden-xs"><?php foreach ($transaccion as $values) {
											if ($value->id_modalidad_transaccion==$values->id_modalidad_transaccion) {
												echo $values->descripcion;
											}

										}  ?></td>
										<td ><?php echo $value->monto; ?></td>
															
															<td class="center">
																<div class="visible-md visible-lg hidden-sm hidden-xs">
																	<a  href="#myModal"  role="button" data-toggle="modal" onclick="ver('<?php echo $value->id_compras; ?>')" 
																	 class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Ver"><i class="fa fa-edit"></i></a>
																	<?php if($value->estado == 1) {  ?>
																	<a onclick='Eliminar(<?php echo $value->id_compras;?>)' class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-times fa fa-white"></i></a>
																	<?php }  ?>
																</div>
																<div class="visible-xs visible-sm hidden-md hidden-lg">
																	<div class="btn-group">
																		<a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																		<i class="fa fa-cog"></i> <span class="caret"></span></a>
																		<ul role="menu" class="dropdown-menu pull-right dropdown-dark">
																			<li>
																				
																			</li>
																			<li>
				<a role="menuitem" tabindex="-1" onclick='Eliminar(<?php echo $value->id_compras;?>)'>
																					<i class="fa fa-times"></i> Remove
																				</a>
																			</li>
																		</ul>
																	</div>
																</div>
															</td>
														</tr>

														<?php } ?>
													</tbody>
												</table>
											</div>
										<?php }else{ ?>
											<h3><span>No hay Datos que Mostrar</span></h3>
										<?php } ?>

									</div>
								</div>
								<!-- end: TEXT FIELDS PANEL -->
							</div>
						</div>
				</div>
				<div id="compras_ver_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
								<?php include('compras_ver_v.php'); ?>
							</div>
	<?php include('includes/js_principal.inc');?>

	<script>


		function ver(id){
		$.post("<?php echo base_url();?>Compras_c/ver",{"id_compras":id},
			function(data){
				var $modal = $('#compras_ver_modal');
				$('#compras_ver_modal').empty();
            	$('#compras_ver_modal').append(data);
			    $modal.modal();

			});

}

		$("#boton").click(function(){
			window.location = "<?php echo site_url('Compras_c/nuevo'); ?>";
		})
		// function Modificar(id){
			
		// $.post("<?php echo base_url();?>Personal_c/modificar",{"nro_documento":id}),function(data){
		// 	alert(data);
		// })

		function alerta_message(msg,title,method)
		{
			var shortCutFunction = method;
            var msg = msg;
            var title = title || '';
            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
            $toastlast = $toast;
		}

		function message_nothing()
		{
          swal({
                title: "No deje vacio el campo!",
                // text: "Here's a custom image.",
                imageUrl: "<?php echo base_url().'public/images/dedo.png';?>"
            });
        }

        function message_nothing2()
		{
          swal({
                title: "No puede insertar un campo vacio, Por Favor llenelo!",
                // text: "Here's a custom image.",
                imageUrl: "<?php echo base_url().'public/images/dedo.png';?>"
            });
        }

        function eliminar_perfil(idperfil)
        {
        	$.post("<?php echo site_url('Perfiles_c/delete_perfil'); ?>",{idperfil:idperfil},respuesta_de_la_eliminacion);
        }

        function respuesta_de_la_eliminacion(rpta)
        {
        	var respta = rpta.split("-");
        	if(respta[0] == 1)
			{
				alerta_message("Se Eliminó Correctamente","Mensaje","success");
				$("#tabla_perfil").empty();
				$("#tabla_perfil").append(respta[1]);
			}
			else
			{
				alerta_message("Error al eliminar","Mensaje","error");
				$("#tabla_perfil").empty();
				$("#tabla_perfil").append(respta[1]);
			}
        }


function Eliminar(codigo){
		modal();
		bootbox.confirm("Está seguro que desea eliminar este Compras?", function(result) {
			if(result==true){
			$.post("<?php echo base_url();?>Compras_c/eliminar",{"id_compras":codigo},
					function(data){
						var table1 = $('#tabla_default').DataTable();
						table1.destroy();
                       $('#tabla_perfil').empty();
                       $('#tabla_perfil').append(data);
                       $('#tabla_default').DataTable( {
							language: {
							search: "Buscar ... ",
							sLengthMenu:"",
							sZeroRecords: "No se encontraron resultados",
							sInfo:"",
							sInfoEmpty:"",
							sInfoFiltered:"",
								oPaginate: {
								"sNext":"Siguiente",
								"sPrevious":"Anterior"
								}
							}
                        });
					}
				);

				toastr.warning('Se elimino Correctamente ');
			}
		});
	}


        function alerta()
		{
          swal({
                title: "No primero termine de realizar la operacion!",
                // text: "Here's a custom image.",
                imageUrl: "<?php echo base_url().'public/images/dedo.png';?>"
            });
        }

		 $('#tabla_default').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],

			"oLanguage" : {
				"sInfo": "Mostrando Página _PAGE_",
				"sLengthMenu" : "Mostrar _MENU_ Registros",

				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[0, 'desc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : 10,
		});

		$('#tabla_default_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Buscar Paquetes");
		// modify table search input
		$('#tabla_default_wrapper .dataTables_length select').addClass("m-wrap small");
		// modify table per page dropdown
/*		$('#tabla_default_wrapper .dataTables_length select').select2();*/
		// initialzie select2 dropdown
		$('#tabla_default_column_toggler input[type="checkbox"]').change(function() {
			/* Get the DataTables object again - this is not a recreation, just a get of the object */
			var iCol = parseInt($(this).attr("data-column"));
			var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
			oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
		});
	</script>
</body>

</html>

