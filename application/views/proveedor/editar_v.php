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
		<h3 class="heading_b uk-margin-bottom">EDITAR PROVEEDOR</h3>
   <form action="" class="uk-form-stacked" id="formulario_modificar" name="formulario_modificar" enctype='multipart/form-data' >
    <div class="uk-grid" data-uk-grid-margin>
      <div class="uk-width-large-7-10">
        <div class="md-card">
          <?php foreach($proveedor as $value){ ?>
            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
              <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                  <?php if($value->foto==''){ ?>
                    <img src="<?php echo base_url();?>public/assets/img/avatars/user.png" id="mostrar_imagen" alt="user avatar"/>
                    <input type="hidden" name="valida_imagen" id="valida_imagen" value="">
                  <?php }else{ ?>
                    <img src="<?php echo base_url().$value->foto; ?>" id="mostrar_imagen_modificar" alt="user avatar"/>
                    <input type="hidden" name="src_imagen"  id="src_imagen" value="<?php echo $value->foto; ?>" >
                    <input type="hidden" name="valida_imagen" id="valida_imagen" value="1">
                  <?php } ?>
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div class="user_avatar_controls" >
                  <span class="btn-file" >
                    <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                    <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                    <input type="file" style="cursor: pointer;"  onchange="ver_imagen()" accept="image/*"  name="imagen" id="imagen">
                  </span>
                  <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                </div>
              </div>
              <div class="user_heading_content">
                <h2 class="heading_b"><span class="uk-text-truncate" id="titulo_proveedor"><?php echo $value->descripcion; ?></span><span class="sub-heading" id="user_edit_position"></span></h2>
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
                <div class="uk-width-medium-1-1">
                  <label for=" ">NOMBRE PROVEEDOR</label>
                  <input class="md-input" type="text" id="proveedor" style="text-transform: uppercase;" onkeyup="titulo_proveedor()" name="proveedor" autocomplete="off" value="<?php echo $value->descripcion; ?>" required="required" />
                  <input type="hidden" name="id_proveedor" id="id_proveedor" value="<?php echo $value->id_proveedor; ?>">   
                </div>
                <div class="uk-width-medium-1-1">
                  <label for=" ">NOMBRE EMPRESA</label>
                  <input class="md-input" type="text" autocomplete="off" id="empresa" style="text-transform: uppercase;" value="<?php echo $value->empresa; ?>"  name="empresa" required="required" />
                </div>
                <div class="uk-width-medium-1-1">
                  <label for=" ">RUC EMPRESA</label>
                  <input class="md-input solo-numero" autocomplete="off" type="text" maxlength="11" id="ruc" style="text-transform: uppercase;"  name="ruc" value="<?php echo $value->ruc; ?>" required="required" />
                </div>
              </div>
              <h3 class="full_width_in_card heading_c">
                UBIGEO
              </h3>
              <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-3">
                  <label class="uk-form-label" for="departamento">DEPARTAMENTO</label>
                  <select id="departamento" data-md-selectize onchange="listar_provincia()" name="departamento" required="required" >
                    <?php foreach($departamentos as $values){  ?>
                     <?php  if($value->id_departamentos==$values->id_departamentos){   ?>        
                       <option value="<?php echo $values->id_departamentos; ?>"><?php echo $values->departamentos; ?></option>
                     <?php } } ?>
                     <?php foreach($departamentos as $values){  ?>
                       <option value="<?php echo $values->id_departamentos; ?>"><?php echo $values->departamentos; ?></option>
                     <?php }  ?>
                   </select>
                 </div>
                 <div class="uk-width-1-3">
                  <label class="uk-form-label" for="provincia">PROVINCIA</label>     	
                  <select id="provincia" data-md-selectize onchange="listar_distrito()" name="provincia" required="required" >
                    <?php foreach($provincias as $values){  ?>
                      <?php  if($value->id_provincias==$values->id_provincias){   ?>     
                       <option value="<?php echo $values->id_provincias; ?>"><?php echo $values->provincias; ?></option>
                     <?php } } ?>
                   </select>
                 </div>
                 <div class="uk-width-1-3">
                  <label class="uk-form-label" for="distrito">DISTRITO</label>
                  <select id="distrito" data-md-selectize name="distrito" required="required"  >
                    <?php foreach($distritos as $values){  ?>
                      <?php  if($value->id_distritos==$values->id_distritos){   ?>     
                       <option value="<?php echo $values->id_distritos; ?>"><?php echo $values->distritos; ?></option>
                     <?php } } ?>
                   </select>
                 </div>
               </div>
               <h3 class="full_width_in_card heading_c">
                NUMERO DEL CONTACTO <a class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light" onclick="add_telefono()" ><i class="material-icons" style="color: #fff;">&#xE145;</i>TELEFONO</a> <a class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light" onclick="add_celular()" ><i class="material-icons" style="color: #fff;">&#xE145;</i>CELULAR</a>
              </h3>
              <div class="uk-grid">
                <div class="uk-width-1-1">
                  <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin id="add_telefono">
                    <?php foreach($telefono as $values){ 
                      if($values->tipo_telefono=="2"){ ?>
                    <div>
                      <div class="uk-input-group">
                        <span class="uk-input-group-addon">
                          <i class="md-list-addon-icon material-icons">&#xe324;</i>
                        </span>
                        <label>CELULAR</label>
                        <input type="text" class="md-input solo-numero" autocomplete="off" maxlength="9" id="celular[]" name="celular[]" value="<?php echo $values->telefono; ?>" />
                      </div>
                    </div>
                    <?php } } ?>
                    <?php foreach($telefono as $values){ 
                      if($values->tipo_telefono=="1"){ ?>
                    <div>
                      <div class="uk-input-group">
                        <span class="uk-input-group-addon">
                          <i class="md-list-addon-icon material-icons  ">&#xE0CD;</i>
                        </span>
                        <label>TELEFONO</label>
                        <input type="text" class="md-input solo-numero" autocomplete="off" maxlength="9" id="telefono[]" name="telefono[]" value="<?php echo $values->telefono; ?>" />
                      </div>
                    </div>
                  <?php } } ?>
                  </div> 
                </div>
              </div>
              <h3 class="full_width_in_card heading_c">
                INFORMACIÓN DEL CONTACTO
              </h3>
              <div class="uk-grid">
                <div class="uk-width-1-1">
                  <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                    <div class="uk-width-1-1">
                      <div class="uk-input-group">
                        <span class="uk-input-group-addon">
                          <i class="md-list-addon-icon material-icons">&#xE8B4;</i>
                        </span>
                        <label>DIRECCIÓN</label>
                        <input type="text" class="md-input" autocomplete="off" name="direccion" style="text-transform: uppercase;" id="direccion" value="<?php echo $value->direccion; ?>"   />
                      </div>
                    </div>
                    <div class="uk-width-1-1">
                      <div class="uk-input-group">
                        <span class="uk-input-group-addon">
                          <i class="md-list-addon-icon material-icons">&#xE158;</i>
                        </span>
                        <label>CORREO ELECTRONICO</label>
                        <input type="text" class="md-input" autocomplete="off" id="correo" name="correo" value="<?php echo $value->correo; ?>" />
                      </div>
                    </div>
                    <div>
                      <div class="uk-input-group">
                        <span class="uk-input-group-addon">
                          <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                        </span>
                        <label>FACEBOOK</label>
                        <input type="text" class="md-input" id="facebook" name="facebook" autocomplete="off" value="<?php echo $value->facebook; ?>" />
                      </div>
                    </div>
                    <div>
                      <div class="uk-input-group">
                        <span class="uk-input-group-addon">
                          <i class="md-list-addon-icon uk-icon-twitter"></i>
                        </span>
                        <label>TWITTER</label>
                        <input type="text" class="md-input" name="twitter" autocomplete="off" value="<?php echo $value->twitter; ?>" />
                      </div>
                    </div>
                    <div>
                      <div class="uk-input-group">
                        <span class="uk-input-group-addon">
                          <i class="md-list-addon-icon uk-icon-linkedin"></i>
                        </span>
                        <label>LINKDIN</label>
                        <input type="text" class="md-input" name="linkdin" autocomplete="off" value="<?php echo $value->linkdin; ?>" />
                      </div>
                    </div>
                    <div>
                      <div class="uk-input-group">
                        <span class="uk-input-group-addon">
                          <i class="md-list-addon-icon uk-icon-google-plus"></i>
                        </span>
                        <label>GOOGLE+</label>
                        <input type="text" class="md-input" name="google" autocomplete="off" value="<?php echo $value->google; ?>" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php }?>
      </div>
    </div>
    <div class="uk-width-large-3-10">
      <div class="md-card">
        <div class="md-card-content">
          <h3 class="heading_c uk-margin-medium-bottom">OTROS AJUSTES</h3>
          <div class="uk-form-row">
            <input type="checkbox" checked data-switchery id="activar" name="activar" onchange="activo()" value="1" />
            <label for="user_edit_active" class="inline-label">ACTIVAR</label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="md-fab-wrapper" >
     <a type="submit" class="md-fab md-fab-danger" href="<?php echo base_url();?>Proveedor_c"  ><i class="material-icons">&#xe5cd;</i></a>
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

 $('#formulario_modificar').on("submit", function(e){
  e.preventDefault();
  var formData = new FormData(document.getElementById("formulario_modificar"));
  var url= "<?php echo base_url();?>Proveedor_c/modificar";
  $.ajax({                        
   type: "POST",                 
   url: url,                     
   data: formData,
   cache: false,
   contentType: false,
   processData: false
 }).done(function(data){
 location.href = "<?php echo base_url();?>Proveedor_c/"; 
});
}); 

function add_telefono(){
  $('#add_telefono').append('<div class="uk-grid-margin uk-row-first"><div class="uk-input-group"> <span class="uk-input-group-addon"> <i class="md-list-addon-icon material-icons  ">&#xE0CD;</i></span><div class="md-input-wrapper"><label>TELEFONO</label><input type="text" autocomplete="off" class="md-input solo-numero" maxlength="9" id="telefono[]" name="telefono[]" value=""><span class="md-input-bar"></span></div> </div> </div></div>');
}

function add_celular(){
  $('#add_telefono').append('<div class="uk-grid-margin uk-row-first"><div class="uk-input-group"> <span class="uk-input-group-addon"> <i class="md-list-addon-icon material-icons  ">&#xe324;</i></span><div class="md-input-wrapper"><label>CELULAR</label><input type="text" autocomplete="off" class="md-input solo-numero" maxlength="9" id="celular[]" name="celular[]" value=""><span class="md-input-bar"></span></div> </div> </div>');
}

 function titulo_proveedor(){
  var proveedor=$('#proveedor').val().toUpperCase();
  $('#titulo_proveedor').html(proveedor);
}

function activo(){
  if($('#activar').prop('checked') ){
    $('#activar').val(1);
  }else{
    $('#activar').val(0);
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

function listar_provincia() {
 var id = $('#departamento').val();
 var $select = $('#provincia').selectize();
 var selectize = $select[0].selectize;
 selectize.clearOptions();
 var $select = $('#distrito').selectize();
 var selectize = $select[0].selectize;
 selectize.clearOptions();
 $.ajax({
  url : "<?php echo base_url();?>Proveedor_c/provincias",
  data : {id : id},
  type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var $select = $(document.getElementById('provincia')).selectize();
					var selectize = $select[0].selectize;
					for (var i = 0; i < $object.length; i++) {
           $('#primera_provincia').val($object[0].id_provincias);
           selectize.addOption({value: $object[i].id_provincias, text: $object[i].provincias  });
           $('#ultima_provincia').val($object[$object.length-1].id_provincias);
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
  url : "<?php echo base_url();?>Proveedor_c/distritos",
  data : {id : id},
  type : 'POST',
				//dataType : 'json',(arrays)
				success : function(data) {
					$object = jQuery.parseJSON(data);
					var $select = $(document.getElementById('distrito')).selectize();
					var selectize = $select[0].selectize;
					for (var i = 0; i < $object.length; i++) {
           $('#primer_distrito').val($object[0].id_distritos);
           selectize.addOption({value: $object[i].id_distritos, text: $object[i].distritos  });
           $('#ultimo_distrito').val($object[$object.length-1].id_distritos);
         }
         selectize.refreshOptions();
       }
     });
}

$(document).ready(function (){
  $('.solo-numero').keyup(function (){
    this.value = (this.value + '').replace(/[^0-9]/g, '');
  });
});
</script>
</body>
</html>