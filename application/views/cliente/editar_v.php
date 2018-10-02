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
    <h3 class="heading_b uk-margin-bottom">MODIFICAR CLIENTE</h3>
    <form action="" class="uk-form-stacked" id="formulario_modificar" name="formulario_modificar" enctype='multipart/form-data' >
      <?php foreach($cliente as $values){ ?>
      <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-large-7-10">
          <div class="md-card">
            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
              <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                  <?php if($values->foto==''){ ?>
                    <img src="<?php echo base_url();?>public/assets/img/avatars/user.png" id="mostrar_imagen" alt="user avatar"/>
                    <input type="hidden" name="valida_imagen" id="valida_imagen" value="">
                  <?php }else{ ?>
                    <img src="<?php echo base_url().$values->foto; ?>" id="mostrar_imagen_modificar" alt="user avatar"/>
                    <input type="hidden" name="src_imagen"  id="src_imagen" value="<?php echo $values->foto; ?>" >
                    <input type="hidden" name="valida_imagen" id="valida_imagen" value="1">
                  <?php } ?>
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div class="user_avatar_controls" >
                  <span class="btn-file" >
                    <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                    <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                    <input type="file"  onchange="ver_imagen()" style="cursor: pointer;" accept=".jpg,.jpeg,.png"  name="imagen" id="imagen">
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
                  <div class="" id="cliente_caja">
                  <label for="cliente">NOMBRE CLIENTE</label>
                  <input class="md-input" type="text" id="cliente" autocomplete="off" style="text-transform: uppercase;" onkeyup="titulo_cliente()" name="cliente" value="<?php echo $values->nombre; ?>" />
                  <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $values->id_cliente; ?>">
                </div>
                </div>
                <div class="uk-width-medium-1-4">
                  <label for="dni">DNI</label>
                  <input class="md-input solo-numero" type="text"  maxlength="8" autocomplete="off" id="dni" name="dni" value="<?php echo $values->dni; ?>" />
                </div>
                <div class="uk-width-medium-3-4">
                  <label for="direccion">DIRECCIÓN</label>
                  <input class="md-input" type="text" id="direccion" autocomplete="off" style="text-transform: uppercase;"  name="direccion" value="<?php echo $values->direccion; ?>" />
                </div>
                <div class="uk-width-medium-1-4">
                  <label for="ruc">RUC</label>
                  <input class="md-input solo-numero" maxlength="11" onkeyup="ruc_validar()" type="text" id="ruc" autocomplete="off" name="ruc" value="<?php echo $values->ruc; ?>"  />
                </div>
              </div>
              <h3 class="full_width_in_card heading_c">
                UBIGEO
              </h3>
              <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-3">
                  <label class="uk-form-label" for="departamento">DEPARTAMENTO</label>
                  <select id="departamento" data-md-selectize onchange="listar_provincia()" name="departamento"  >
                   <?php foreach($departamentos as $value){   ?>
                   <?php  if($value->id_departamentos==$depa){   ?>      
                   <option value="<?php echo $value->id_departamentos; ?>"  ><?php echo $value->departamentos; ?></option>
                   <?php } }  ?>
                   <?php foreach($departamentos as $value){ ?>
                   <?php  if($value->id_departamentos!=$depa){   ?>  
                   <option value="<?php echo $value->id_departamentos; ?>"  ><?php echo $value->departamentos; ?></option>
                   <?php } } ?>
                 </select>
               </div>
               <div class="uk-width-1-3">
                <label class="uk-form-label" for="provincia">PROVINCIA</label>     	
                <select id="provincia" data-md-selectize onchange="listar_distrito()" name="provincia"   >
                  <?php foreach($provincias as $value){   ?>
                   <?php  if($value->id_provincias==$provi){   ?>      
                   <option value="<?php echo $value->id_provincias; ?>"  ><?php echo $value->provincias; ?></option>
                   <?php } }  ?>
                   <?php foreach($provi1 as $value){   ?>
                   <?php  if($value->id_provincias!=$provi){   ?>      
                   <option value="<?php echo $value->id_provincias; ?>"  ><?php echo $value->provincias; ?></option>
                   <?php } }  ?>
               </select>
             </div>
             <div class="uk-width-1-3">
              <label class="uk-form-label" for="distrito">DISTRITO</label>
              <select id="distrito" data-md-selectize name="distrito"  >
               <?php foreach($distritos as $value){   ?>
                   <?php  if($value->id_distritos==$dis){   ?>      
                   <option value="<?php echo $value->id_distritos; ?>"  ><?php echo $value->distritos; ?></option>
                   <?php } }  ?>
                   <?php foreach($dis1 as $value){   ?>
                   <?php  if($value->id_distritos!=$dis){   ?>      
                   <option value="<?php echo $value->id_distritos; ?>"  ><?php echo $value->distritos; ?></option>
                   <?php }  }  ?>
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
<?php } ?>
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

 $('#formulario_modificar').on("submit", function(e){
  e.preventDefault();
  var formData = new FormData(document.getElementById("formulario_modificar"));
  var url= "<?php echo base_url();?>Cliente_c/modificar";
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
          
          $('#cliente_caja').addClass('md-input-wrapper md-input-filled');
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

function ver_imagen(){
  var ima = $("#mostrar_imagen_modificar").attr('src');
  var s_i  = $("#src_imagen").val();
  if(s_i==ima){
    $("#valida_imagen").val('1');
  }else{
    $("#valida_imagen").val('0');
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