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
        <form action="" class="uk-form-stacked" method="POST"  name="formulario_agregar" id="formulario_agregar">
            <h3 class="heading_b uk-margin-bottom">REGISTRAR PACK TALLAS</h3>
            <div class="uk-width-xLarge-4-10  uk-width-large-5-10"   >
                <div class="md-card">
                    <div class="md-card-content large-padding" >
                        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                            <div class="uk-width-large-1-1">
                                <div class="uk-form-row">
                                    <label for="pack_color">DESCRIPCIÓN PACK TALLAS</label>
                                    <input type="text" class="md-input" autocomplete="off" style="text-transform: uppercase;" id="pack_tallas"   name="pack_tallas" value="" />
                                </div>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="kUI_multiselect_basic">TALLAS</label>
                                    <select id="kUI_multiselect_basic" name="tallas[]" multiple="multiple" data-placeholder="SELECCIONA LOS COLORES">
                                        <?php foreach($tallas as $value){ ?>
                                        <option value="<?php echo $value->id_tallas; ?>" ><?php echo $value->descripcion; ?></option>
                                        <?php } ?>
                                    </select>
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
                        <a class="md-fab md-fab-small md-fab-danger" href="<?php echo base_url();?>Pack_tallas_c"><i class="material-icons">&#xe5cd;</i></a>
                    </div>
                </div>
            </div>
        </form>
        <?php include('public/js.inc');?>
        <script> 


          $('#formulario_agregar').on("submit", function(e){
            e.preventDefault();
            var pack_tallas = $("#pack_tallas").val();
            var tallas = $("#kUI_multiselect_basic").val();
            if (pack_tallas!=''&&tallas!=null) {
              var formData = new FormData(document.getElementById("formulario_agregar"));
              var url = "<?php echo base_url();?>Pack_tallas_c/agregar";
              $.ajax({                        
                 type: "POST",                 
                 url: url,                     
                 data: formData,
                 cache: false,
                 contentType: false,
                 processData: false
             }).done(function(data){
                location.href = "<?php echo base_url();?>Pack_tallas_c/"; 
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

      </script>