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

	<h3 class="heading_b uk-margin-bottom">PERSONAL</h3>
	<div id="alertas" style="display: none;" class="uk-alert uk-alert-danger" data-uk-alert>
		<a href="#" onclick="alertas()" style="color: #ffffff; ">X  </a>
		LAS CONTRASEÑAS NO COINCIDEN.
	</div>
	<div class="md-card uk-margin-medium-bottom">
		<div class="md-card-content">
			<div >
				<table class="uk-table"  id="dt_default"  cellspacing="0"  width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>NOMBRE USUARIO</th>
							<th>DNI</th>
							<th>PERFIL USUARIO</th>
							<th></th>
						</tr>
					</thead>
					<tbody id="pagina">
						<?php foreach($personal as $value){ ?>
						<tr>
							<td><?php echo $value->id_usuario; ?></td>
							<td><?php echo $value->nombre.' '.$value->apellido; ?></td>
							<td><?php echo $value->dni; ?></td>
							<?php foreach($perfil as $values){
								if ($value->id_perfil_usuario==$values->id_perfil_usuario) {
									?>
									<td><?php echo $values->descripcion; ?></td>
									<?php }} ?>
									<td class="jtable-command-column"> <a title="EDITAR" data-uk-modal="{target:'#editar_personal'}" class="jtable-command-button jtable-edit-command-button" onclick="editar(<?php echo $value->id_usuario; ?>)"><span class="uk-icon-pencil"></span></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>	
				</div>
			</div>
			<div class="md-fab-wrapper">
				<a class="md-fab md-fab-accent" href="#" id="recordAdd" data-uk-modal="{target:'#agregar_personal'}"  >
					<i class="material-icons">&#xE145;</i>
				</a>
			</div>

			<div id="agregar_personal"  class="uk-modal" role="dialog">
				<div class="uk-modal-dialog" >
					<button type="button" class="uk-modal-close uk-close"></button>

					<h2 class="heading_a">AGREGAR PERSONAL</h2>
					<div id="form_validation" class="uk-grid" data-uk-grid-margin>
						<div class="uk-width-medium-1-1">
							<div class="parsley-row">
								<label for="nombre">NOMBRE USUARIO<span class="req">*</span></label>
								<input type="text" style="text-transform: uppercase;"  id="nombre" required class="md-input" />
							</div>
						</div>            
					</div>
					<div id="form_validation" class="uk-grid" data-uk-grid-margin>
						<div class="uk-width-medium-1-1">
							<label for="perfil">PERFIL<span class="req">*</span></label>
							<select id="perfil"  name="perfil" class="md-input" >
								<option value=""></option>
								<?php foreach ($perfil as $value) { ?> 
								<option value="<?php echo $value->id_perfil_usuario; ?>"><?php echo $value->descripcion; ?></option>
								<?php } ?>     
							</select>
						</div>
					</div>
					<div id="form_validation" class="uk-grid" data-uk-grid-margin>
						<div class="uk-width-medium-1-1">
							<div class="parsley-row">
								<label for="nick">NICK<span class="req">*</span></label>
								<input type="text"   id="nick" required class="md-input" />
							</div>
						</div>            
					</div>
					<div id="form_validation" class="uk-grid" data-uk-grid-margin>
						<div class="uk-width-medium-1-1">
							<div class="parsley-row">
								<label for="clave">CONTRASEÑA<span class="req">*</span></label>
								<input type="password"   id="clave" required class="md-input" />
							</div>
						</div>            
					</div>
					<div id="form_validation" class="uk-grid" data-uk-grid-margin>
						<div class="uk-width-medium-1-1">
							<div class="parsley-row">
								<label for="clave_re">REPETIR CONTRASEÑA<span class="req">*</span></label>
								<input type="password"   id="clave_re" required class="md-input" />
							</div>
						</div>            
					</div>
					<div style="margin-top: 10px; margin-bottom: 10px;"></div>
					<div class="uk-grid">
						<div class="uk-width-1-1">
							<button type="submit" class="md-btn md-btn-primary uk-modal-close" id="guardar" >GUARDAR</button>
						</div>
					</div> 
				</div>
			</div>

			<div id="editar_personal"  class="uk-modal" role="dialog">
				<div class="uk-modal-dialog" >
					<button type="button" class="uk-modal-close uk-close"></button>

					<h2 class="heading_a">EDITAR PERSONAL</h2>
					<div id="form_validation" class="uk-grid" data-uk-grid-margin>
						<div class="uk-width-medium-1-1">
							<div class="parsley-row">
								<label for="nombre_editar">NOMBRE USUARIO<span class="req">*</span></label>
								<input type="hidden" id="id_usuario_editar"   />
								<input type="text" style="text-transform: uppercase;" value=" " id="nombre_editar" required class="md-input" />
							</div>
						</div>            
					</div>
					<div id="form_validation" class="uk-grid" data-uk-grid-margin>
						<div class="uk-width-medium-1-1">
							<label for="perfil_editar">PERFIL<span class="req">*</span></label>
							<select id="perfil_editar"  name="perfil_editar" class="md-input" >
								<option value=" "></option>
								<?php foreach ($perfil as $value) { ?> 
								<option value="<?php echo $value->id_perfil_usuario; ?>"><?php echo $value->descripcion; ?></option>
								<?php } ?>     
							</select>
						</div>
					</div>
					<div id="form_validation" class="uk-grid" data-uk-grid-margin>
						<div class="uk-width-medium-1-1">
							<div class="parsley-row">
								<label for="nick_editar">NICK<span class="req">*</span></label>
								<input type="text"  value=" " id="nick_editar" required class="md-input" />
							</div>
						</div>            
					</div>
					<div id="form_validation" class="uk-grid" data-uk-grid-margin>
						<div class="uk-width-medium-1-1">
							<div class="parsley-row">
								<label for="clave_editar">CONTRASEÑA<span class="req">*</span></label>
								<input type="password" value=" "  id="clave_editar" required class="md-input" />
							</div>
						</div>            
					</div>
					<div id="form_validation" class="uk-grid" data-uk-grid-margin>
						<div class="uk-width-medium-1-1">
							<div class="parsley-row">
								<label for="clave_re_editar">REPETIR CONTRASEÑA<span class="req">*</span></label>
								<input type="password"  value=" " id="clave_re_editar" required class="md-input" />
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
		</div>
		<?php include('public/js.inc');?>

		<script type="text/javascript">

			$('#guardar').click(function(){

				var nombre = $('#nombre').val();
				var perfil = $('#perfil').val();
				var nick = $('#nick').val();
				var clave = $('#clave').val();
				var clave_re = $('#clave_re').val();
				if (perfil!='' && nombre!='' && nick!='' && clave!= '' && clave_re!= '') {
					if (clave==clave_re) {	
						$.ajax({
							url : "<?php echo base_url();?>Personal_c/agregar",
							data : {perfil : perfil,nombre : nombre , nick : nick , clave:clave},
							type : 'POST',
							success : function(data) {
								$('#pagina').html(data);
								$('#perfil').val('');
								$('#nombre').val('');
								$('#nick').val('');
								$('#clave').val('');
								$('#clave_re').val('');
							}
						});
					}else{
						$('#alertas').css("display", "block");
						$('#perfil').val('');
						$('#nombre').val('');
						$('#nick').val('');
						$('#clave').val('');
						$('#clave_re').val('');	
					}
				}
			});

			$('#modificar').click(function(){

				var perfil = $('#perfil_editar').val();
				var nombre = $('#nombre_editar').val();
				var nick = $('#nick_editar').val();
				var clave = $('#clave_editar').val();
				var clave_re = $('#clave_re_editar').val();
				var id_usuario = $('#id_usuario_editar').val();

				if (perfil!='' && nombre!='' && nick!='' && clave!= '' && clave_re!= '') {
					if (clave==clave_re) {	
					$.ajax({
						url : "<?php echo base_url();?>Personal_c/modificar",
						data : {perfil : perfil , nombre : nombre , nick : nick , clave : clave, id_usuario : id_usuario},
						type : 'POST',
						success : function(data) {
							$('#pagina').html(data);
							$('#perfil_editar').val('');
							$('#nombre_editar').val('');
							$('#nick_editar').val('');
							$('#clave_editar').val('');
							$('#clave_re_editar').val('');
						}
					});
					}else{
						$('#alertas').css("display", "block");
						$('#perfil_editar').val('');
						$('#nombre_editar').val('');
						$('#nick_editar').val('');
						$('#clave_editar').val('');
						$('#clave_re_editar').val('');
					}
				}
			});

			function buscar() {
				var textoBusqueda = $("input#busqueda").val();   
				$.post("Personal_c/listar", {"valorBusqueda": textoBusqueda}, function(mensaje) {
					$("#pagina").html(mensaje);
				});  
			}

			function editar(id) {

				$.ajax({
					url : "<?php echo base_url();?>Personal_c/editar",
					data : {id : id},
					type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					var type =	jQuery.parseJSON(data);
					$("#id_usuario_editar").val(type.id_usuario)
					$("#nombre_editar").val(type.nombre);
					$("#perfil_editar").val(type.id_perfil_usuario);
					$("#nick_editar").val(type.nick);
					$("#clave_editar").val(type.clave);
					$("#clave_re_editar").val(type.clave);
				}
			});		
			}

			function alertas(id) {
				$('#alertas').css("display", "none");	
			}
		</script>
	</body>
	</html>