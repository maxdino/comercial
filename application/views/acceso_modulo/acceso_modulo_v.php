<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/assets/img/favicon-32x32.png" sizes="32x32">

    <title>COMERCIAL HILARIO</title>

<?php include('public/css.inc');?>
<body class=" sidebar_main_open sidebar_main_swipe">
	<?php include('includes/menu.inc');?>  

	<h3 class="heading_b uk-margin-bottom">ACCESO A MODULOS</h3>
	<div class="md-card uk-margin-medium-bottom">
		<div class="md-card-content">	
		 <div id="" class="uk-width-medium-1-3 uk-width-large-1-2">					
                            <select id="perfil" name="perfil"  class="md-input" onchange="perfil()">
                                <option value="">Seleccionar...</option>
                                <?php foreach ($perfil as $value) { ?> 
                                    <option value="<?php echo $value->id_perfil_usuario; ?>"><?php echo $value->descripcion; ?></option>
                                <?php } ?>     
                            </select>
           </div>	
           <div style="margin-top: 10px; margin-bottom: 10px;"></div>
           <div class="uk-width-medium-1-3 uk-width-large-1-2">
                            <select id="modulo"  name="modulo" class="md-input" disabled="" onchange="modulo()">
                                <option value="">Seleccionar...</option>
                                <?php foreach ($modulo as $value) { ?> 
                                    <option value="<?php echo $value->id_modulo; ?>"><?php echo $value->nombre; ?></option>
                                <?php } ?>     
                            </select>
           </div>
           <div style="margin-top: 30px; margin-bottom: 30px;"></div>
           <form  id="form_validation"   name="form_validation"  enctype='multipart/form-data'   >
           <div id="modulo_pagina" class="uk-width-medium-1-3 uk-width-large-1-5"></div>
           <input type="hidden"  name="id_perfil" id="id_perfil" />
           <input type="hidden"  name="id_modulo" id="id_modulo" />
           <div class="md-fab-wrapper">
		<button type="submit" class="md-fab md-fab-accent" ><i class="material-icons">&#xE145;</i></button>
		</div>
		</form>
		</div>
	</div>
  </div>
</div>
<?php include('public/js.inc');?>

<script type="text/javascript">

	$('#form_validation').on("submit", function(e){
        
        e.preventDefault();
        var formData = new FormData(document.getElementById("form_validation"));
        var url = "<?php echo base_url();?>Acceso_modulo_c/agregar";
        
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: formData,
          cache: false,
          contentType: false,
          processData: false

       }).done(function(data){
		
		 });
       	});

	function modulo() {
		var modulo = $('#modulo').val();
		var perfil = $('#perfil').val();
		$.ajax({
			url : "<?php echo base_url();?>Acceso_modulo_c/modulo",
			data : {modulo : modulo , perfil : perfil},
			type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					$('#modulo_pagina').html(data);
					$('#id_modulo').val(modulo);

				}
			});
	}

	function perfil() {
		var perfil = $('#perfil').val();	
		if (perfil=='') {
			$("#modulo").attr("disabled","true");
		}else{
			$("#modulo").removeAttr("disabled");
			$('#id_perfil').val(perfil);
			$("#modulo").val("");
			$("#modulo_pagina").html("");
		}	
	}	

</script>
</body>
</html>