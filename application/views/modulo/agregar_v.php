<!doctype html>
<html lang="es"> <!--<![endif]-->
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
        <form action="" class="uk-form-stacked" method="POST"  name="formulario_agregar" id="formulario_agregar">
            <h3 class="heading_b uk-margin-bottom">REGISTRAR MODULO</h3>
            <div class="uk-width-xLarge-4-10  uk-width-large-5-10"   >
                <div class="md-card">
                    <div class="md-card-content large-padding" >
                        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row">
                                    <label for="modulo">MODULO<span class="req">*</span></label>
                                    <input type="text" autocomplete="off" name="modulo" id="modulo" style="text-transform: uppercase;" required class="md-input" />
                                </div>
                            </div>            
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row">
                                    <label for="modulo_padre">MODULO PADRE<span class="req">*</span></label>
                                    <select id="modulo_padre" onchange="padre()" name="modulo_padre" class="md-input" data-md-selectize >
                                        <option value="0"></option>
                                        <?php foreach($modulo_padre as $value){ ?>
                                        <option value="<?php echo $value->id_modulo; ?>"><?php echo $value->nombre; ?></option>
                                        <?php   }  ?>
                                    </select>
                                </div>
                            </div>            
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row">
                                    <label for="url">URL<span class="req">*</span></label>
                                    <input type="text"   id="url" name="url" disabled="" autocomplete="off" required class="md-input" />
                                </div>
                            </div>    
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row">
                                    <label for="icono">ICONO<span class="req">*</span></label>
                                    <input type="text" id="icono" name="icono" autocomplete="off" required class="md-input" />
                                </div>
                            </div>          
                        </div>
                    </div>  
                </div>
            </div>   

            <div class="md-fab-wrapper" >
                <div class="md-fab-wrapper md-fab-in-card md-fab-speed-dial">
                    <a class="md-fab md-fab-primary" ><i class="material-icons">reorder</i></a>
                    <div class="md-fab-wrapper-small">
                        <button type="submit" class="md-fab md-fab-small md-fab-success"  ><i class="material-icons">save</i></button>
                        <a class="md-fab md-fab-small md-fab-danger" href="<?php echo base_url();?>Modulos_c"><i class="material-icons">&#xe5cd;</i></a>
                    </div>
                </div>
            </div>
        </form>
        <?php include('public/js.inc');?>
        <script> 
          $('#formulario_agregar').on("submit", function(e){
            e.preventDefault();
            var modulo = $("#modulo").val();
            var icono = $("#icono").val();
            if (icono!=''&&modulo!='') {
              var formData = new FormData(document.getElementById("formulario_agregar"));
              var url = "<?php echo base_url();?>Modulos_c/agregar";
              $.ajax({                        
                 type: "POST",                 
                 url: url,                     
                 data: formData,
                 cache: false,
                 contentType: false,
                 processData: false
             }).done(function(data){
                location.href = "<?php echo base_url();?>Modulos_c/"; 
            });
         }else{
            swal({
                title: "Error al Registrar Pack Colores",
                text: "¡Revise los campos del Pack Colores!",
                type: "error",
                showCancelButton: false,
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                confirmButtonText: 'Ok!'
            });  
        }
    });  

          function padre() {
            var padre = $('#modulo_padre').val();   
            if (padre=='0') {
                $("#url").attr("disabled","true");
            }else{
                $("#url").removeAttr("disabled");
            }   
            }   

    </script>