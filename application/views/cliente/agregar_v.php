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
    <h3 class="heading_b uk-margin-bottom">AGREGAR CLIENTE</h3>
    <form action="" class="uk-form-stacked" id="formulario_agregar" name="formulario_agregar" enctype='multipart/form-data' >
      <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-large-7-10">
          <div class="md-card">
            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
              <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                  <img src="<?php echo base_url();?>public/assets/img/avatars/user.png" id="mostrar_imagen" alt="user avatar"/>
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div class="user_avatar_controls" >
                  <span class="btn-file" >
                    <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                    <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                    <input type="file" style="cursor: pointer;" accept=".jpg,.jpeg,.png"  name="imagen" id="imagen">
                  </span>
                  <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                </div>
              </div>
              <div class="user_heading_content">
                <h2 class="heading_b"><span class="uk-text-truncate" id="titulo_cliente"></span><span class="sub-heading" id="user_edit_position"></span></h2>
              </div>
              <div class="md-fab-wrapper">
                <div class="md-fab md-fab-toolbar md-fab-small md-fab-accent">
                  <i class="material-icons">&#xE8BE;</i>
                  <div class="md-fab-toolbar-actions">
                    <button type="submit" id="guardar" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Save"><i class="material-icons md-color-white">&#xE161;</i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="user_content">
             <div class="uk-margin-top">
              <h3 class="full_width_in_card heading_c">
                INFORMACIÓN GENERAL
              </h3>
              <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-3-4">
                  <div class="md-input-wrapper" id="cliente_caja">
                  <label for="cliente">NOMBRE CLIENTE</label>
                  <input class="md-input" type="text" id="cliente" autocomplete="off" style="text-transform: uppercase;" onkeyup="titulo_cliente()" name="cliente" required="required" />
                </div>
                </div>
                <div class="uk-width-medium-1-4">
                  <label for="dni">DNI</label>
                  <input class="md-input solo-numero" type="text" onkeyup="dni_validar()" maxlength="8" autocomplete="off" id="dni" name="dni" />
                </div>
                <div class="uk-width-medium-3-4">
                  <label for="direccion">DIRECCIÓN</label>
                  <input class="md-input" type="text" id="direccion" autocomplete="off" style="text-transform: uppercase;"  name="direccion"  />
                </div>
                <div class="uk-width-medium-1-4">
                  <label for="ruc">RUC</label>
                  <input class="md-input solo-numero" maxlength="11" onkeyup="ruc_validar()" type="text" id="ruc" autocomplete="off" name="ruc"  />
                </div>
              </div>
              <h3 class="full_width_in_card heading_c">
                UBIGEO
              </h3>
              <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-3">
                  <label class="uk-form-label" for="departamento">DEPARTAMENTO</label>
                  <select id="departamento" data-md-selectize onchange="listar_provincia()" name="departamento"  >
                   <option value=""></option>
                   <?php foreach($departamentos as $value){ ?>
                   <option value="<?php echo $value->id_departamentos; ?>"  ><?php echo $value->departamentos; ?></option>
                   <?php } ?>
                 </select>
               </div>
               <div class="uk-width-1-3">
                <label class="uk-form-label" for="provincia">PROVINCIA</label>     	
                <select id="provincia" data-md-selectize onchange="listar_distrito()" name="provincia"   >
                 <option value=""></option>
               </select>
             </div>
             <div class="uk-width-1-3">
              <label class="uk-form-label" for="distrito">DISTRITO</label>
              <select id="distrito" data-md-selectize name="distrito"  >
               <option value=""></option>
             </select>
           </div>
         </div> 
      </div>
    </div>
  </div>
</div>
</div>
<div class="md-fab-wrapper" >
 <a type="submit" class="md-fab md-fab-danger" href="<?php echo base_url();?>Cliente_c"  ><i class="material-icons">&#xe5cd;</i></a>
</div>
</form>


</div>
<?php include('public/js.inc');?>

<script type="text/javascript">

 $(window).load(function(){
   $(function() {
    $('#imagen').change(function(e) {
      addImage(e); 
    });

    function addImage(e){
      var file = e.target.files[0],
      imageType = /image.*/;

      if (!file.type.match(imageType))
       return;
     var reader = new FileReader();
     reader.onload = fileOnload;
     reader.readAsDataURL(file);
   }

   function fileOnload(e) {
    var result=e.target.result;
    $('#mostrar_imagen').attr("src",result);
  }
});
 });

 $('#formulario_agregar').on("submit", function(e){
  e.preventDefault();
  var formData = new FormData(document.getElementById("formulario_agregar"));
  var url= "<?php echo base_url();?>Cliente_c/agregar";
  $.ajax({                        
   type: "POST",                 
   url: url,                     
   data: formData,
   cache: false,
   contentType: false,
   processData: false
 }).done(function(data){
  location.href = "<?php echo base_url();?>Cliente_c/"; 
});
}); 

function titulo_cliente(){
  var cliente=$('#cliente').val().toUpperCase();
  $('#titulo_cliente').html(cliente);
}

function listar_provincia() {
 var id = $('#departamento').val();
 var $select = $('#provincia').selectize();
 var selectize = $select[0].selectize;
 selectize.clearOptions();
 var $select = $('#distrito').selectize();
 var selectize = $select[0].selectize;
 selectize.clearOptions();
 $.ajax({
  url : "<?php echo base_url();?>Cliente_c/provincias",
  data : {id : id},
  type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var $select = $(document.getElementById('provincia')).selectize();
					var selectize = $select[0].selectize;
					for (var i = 0; i < $object.length; i++) {
           selectize.addOption({value: $object[i].id_provincias, text: $object[i].provincias  });
         }
         selectize.refreshOptions();
       }
     });
}


function listar_distrito() {
 var id = $('#provincia').val();
 var $select = $('#distrito').selectize();
 var selectize = $select[0].selectize;
 selectize.clearOptions();
 $.ajax({
  url : "<?php echo base_url();?>Cliente_c/distritos",
  data : {id : id},
  type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var $select = $(document.getElementById('distrito')).selectize();
					var selectize = $select[0].selectize;
					for (var i = 0; i < $object.length; i++) {
           selectize.addOption({value: $object[i].id_distritos, text: $object[i].distritos  });
         }
         selectize.refreshOptions();
       }
     });
}

function dni_validar() {
 var dni = $('#dni').val();
 $('#cliente').val('');
 $('#cliente_caja').removeClass('md-input-filled');
 if(dni.length=='8'){
  $.ajax({
    url : "<?php echo base_url();?>Cliente_c/dni_validar",
    data : {id : dni},
    type : 'POST',
        //dataType : 'json',(arrays)
        success : function(data) {
          $object = jQuery.parseJSON(data);
          
          $('#cliente_caja').addClass('md-input-filled');
          $('#cliente').val($object.nombres+' '+$object.apellido_paterno+' '+$object.apellido_materno);
        
        }
      });
}
}

function ruc_validar() {
 var ruc = $('#ruc').val();
 if(ruc.length=='11'){
  $.ajax({
    url : "<?php echo base_url();?>Proveedor_c/ruc_validar",
    data : {id : ruc},
    type : 'POST',
        //dataType : 'json',(arrays)
        success : function(data) {
          $object = jQuery.parseJSON(data);
          if($object['success']!=true){
            swal({
                title: "Error al ingresar RUC",
                text: "¡El RUC no existe!",
                type: "error",
                showCancelButton: false,
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                confirmButtonText: 'Ok!'
            }); 
          }
        }
      });
}
}

$(document).ready(function (){
  $('.solo-numero').keyup(function (){
    this.value = (this.value + '').replace(/[^0-9]/g, '');
  });
});


</script>
</body>
</html>