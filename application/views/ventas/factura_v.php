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
            <div class="uk-width-xLarge-9-10  uk-width-large-10-10"   >
                <div class="md-card">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                            FACTURA
                        </h3>
                    </div>

                    <div class="md-card-content large-padding" >
                        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                            <div class="uk-width-large-3-6">
                                <div class="uk-form-row">
                                   <input id="cliente_escoger" name="cliente_escoger" onchange="cliente()"  placeholder="SELECCIONAR CLIENTE..."   style="width: 480px;text-transform: uppercase;" />
                               </div>
                           </div>
                           <div class="uk-width-large-1-6">
                            <div class="uk-form-row" style="width: 145px;">
                             <a class="md-btn md-btn-primary" onclick="agregar_cliente()" title="AGREGAR CLIENTE" id="agregar_cliente"  ><i class="material-icons" style="color:#fff">person_add</i></a>
                         </div>
                     </div>
                     <div class="uk-width-large-2-6">
                        <div class="uk-form-row">
                         <select id="almacen" placeholder="ALMACEN" autocomplete="off" required="required"  name="almacen"  data-md-selectize>
                            <option value=""></option>
                            <?php foreach($almacen as $value){ ?>
                                <option value="<?php echo $value->id_almacen; ?>"><?php echo $value->almacen; ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="tipo_comprobante" id="tipo_comprobante" value="1"  />
                    </div>
                </div>
            </div>
        </div>  
        <div class="md-card-content large-padding" style="padding-top: 0px;">
            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-3-6">
                    <div class="uk-form-row">
                       <div class="md-input-wrapper " id="caja_direccion">
                        <label for="direccion">DIRECCIÓN</label>
                        <input type="text" class="md-input" autocomplete="off" style="text-transform: uppercase;" id="direccion"  name="direccion" disabled="disabled" required="required" />
                    </div>
                </div>
            </div>
            <div class="uk-width-large-1-6">
                <div class="uk-form-row">
                    <div class="md-input-wrapper " id="caja_ruc">
                        <label>RUC</label>
                        <input type="text" class="md-input solo-ruc" autocomplete="off" maxlength="11" style="text-transform: uppercase;" id="ruc" required="required"  name="ruc" disabled="disabled" />
                    </div>
                </div>    
            </div>    
            <div class="uk-width-large-2-6">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    <label for="uk_dp_1">FECHA</label>
                    <input class="md-input" type="text" required="required" autocomplete="off" id="uk_dp_1" name="fecha_compra" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                </div>
            </div>
        </div>
    </div>  
    <div class="md-card-content large-padding" style="padding-top: 0px;" >
        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
            <div class="uk-width-large-3-6">
                <div class="uk-form-row">
                    <input id="producto_escoger" name="producto_escoger" placeholder="SELECCIONAR PRODUCTO..."   style="width: 480px;text-transform: uppercase;" />
                </div>
            </div>
            <div class="uk-width-large-1-6">
                <div class="uk-form-row">
                    <label for="nombre_producto">CANTIDAD</label>
                    <input type="number" class="md-input"   id="cantidad" autocomplete="off" name="cantidad" min="1" />
                </div>
            </div>
            <div class="uk-width-large-1-6">
                <div class="uk-form-row">
                    <div class="md-input-wrapper" id="caja_precio">
                        <label for="nombre_producto">PRECIO</label>                  
                        <input type="text" class="md-input" onclick="precio_escoger()" readonly="readonly" id="precio" autocomplete="off" name="precio" min="1" />
                        <input type="hidden" name="id_uni" id="id_uni">
                    </div>
                </div>
            </div>
            <div class="uk-width-large-1-6">
                <div class="uk-form-row">
                    <a class="md-btn md-btn-primary" onclick="subtotal()" id="agregar_producto"  ><i class="material-icons" style="color:#fff">&#xE8CC;</i></a>
                </div>
            </div>
        </div>   
    </div>
</div>
</div>   
<div class="uk-width-xLarge-9-10  uk-width-large-10-10" style="margin-top: 20px;margin-bottom: 20px;"></div>
<div class="uk-width-xLarge-9-10  uk-width-large-10-10"  >
    <div class="md-card">
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                DETALLES
            </h3>
        </div>
        <div class="md-card-content large-padding">
            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-8-10">
                    <div class="uk-form-row">
                        <div class="uk-overflow-container">
                            <table class="uk-table uk-text-nowrap" id="tabla_venta">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PRODUCTO</th>
                                        <th>CANTIDAD</th>
                                        <th>UNIDAD MEDIDA</th>
                                        <th>PRECIO</th>
                                        <th>MONTO</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-2-10">
                    <div class="md-card-toolbar" style="margin-left: -35px;">
                        <label class="uk-display-block uk-margin-small-top" for="product_edit_active_control">IGV</label>
                        <input type="text"  id="igv_actual" name="igv_actual" autocomplete="off" onchange="modificar_total()"  value="0.18" class=" md-input solo-igv" max="1" />
                    </div>
                    <div class="md-card-toolbar" style="margin-left: -35px;">
                        <h3 class="md-card-toolbar-heading-text">
                            TOTALES
                        </h3>
                    </div>
                    <div class="md-card-content" style="margin-left:  -50px;">
                        <div class="uk-form-row">
                            <div class="uk-input-group">
                                <span class="uk-input-group-addon">
                                    <i class="uk-icon-money"></i>
                                </span>
                                <label for="subtotal">SUBTOTAL</label><br>
                                <input id="subtotal" type="text" name="subtotal"  required="required" readonly="readonly" class=" md-input" value="0.00" min="0" />
                            </div>
                        </div>
                        <div class="uk-input-group" style="margin-top: 5px;">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-money"></i>
                            </span>
                            <label for="product_edit_price_control">IGV</label><br>
                            <input id="igv" type="number" name="igv" required="required" readonly="readonly" class="md-input" value="0.00"  />
                        </div>
                        <div class="uk-form-row" style="margin-top: 5px;">
                            <div class="uk-input-group">
                                <span class="uk-input-group-addon">
                                    <i class="uk-icon-money"></i>
                                </span>
                                <label for="">DESCUENTO</label><br>
                                <input id="descuento" type="number" onchange="modificar_total()" name="descuento"  class="md-input" value="0"  />
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <div class="uk-input-group">
                                <span class="uk-input-group-addon">
                                    <i class="uk-icon-money"></i>
                                </span>
                                <label for="monto_total"> TOTAL </label><br>
                                <input type="text" class="md-input" name="monto_total" style="width: 90px;" readonly="readonly" id="monto_total" value="0.00" />
                                <input type="hidden" name="mon" id="mon" value="0.00" />
                            </div>
                        </div>            
                    </div> 
                </div>     
            </div>
        </div>
    </div>
</div>
<div class="uk-width-xLarge-1-10 uk-width-large-2-10" ></div>
<div class="md-fab-wrapper" >
    <div class="md-fab-wrapper md-fab-in-card md-fab-speed-dial">
        <a class="md-fab md-fab-primary" ><i class="material-icons">menu</i></a>
        <div class="md-fab-wrapper-small">
            <button type="submit" class="md-fab md-fab-small md-fab-success"  ><i class="material-icons">save</i></button>
            <a class="md-fab md-fab-small md-fab-danger" href="<?php echo base_url();?>Compra_c"><i class="material-icons">&#xe5cd;</i></a>
        </div>
    </div>
</div>
</form>
<div id="modal_precio"  class="uk-modal" role="dialog">
    <div class="uk-modal-dialog md-card md-card-primary" >
        <button type="button" class="uk-modal-close uk-close"></button>
        <h2 class="heading_a">SELECCIONAR PRECIOS</h2>
        <div id="form_validation" class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                <div class="parsley-row">
                    <p><table class="uk-table uk-text-nowrap" id="tabla_precios">
                        <thead>
                            <tr>
                                <th>UNIDAD MEDIDA</th>
                                <th>PRECIOS</th>
                                <th>ACEPTAR</th>
                            </tr>
                        </thead>
                        <tbody id="lista_precios">
                        </tbody>
                    </table> 
                </p>
            </div>
        </div>            
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
        </div>
    </div> 
</div>
</div>
<link rel="stylesheet" href="<?php echo base_url();?>public/assets/css/bootstrap.min.css">

<div id="modal_cliente"  class="uk-modal" role="dialog">
    <div class="uk-modal-dialog md-card md-card-primary" >
        <button type="button" class="uk-modal-close uk-close"></button>
        <div id="" class="uk-grid uk-grid-divider  " data-uk-grid-margin>
            <h2 class="heading_a">AGREGAR CLIENTE</h2>
        </div> 
        <br>  
        <form class="uk-form-stacked" method="POST" name="formulario_agregar_cliente"  id="formulario_agregar_cliente">
            <div id="" class="uk-grid " data-uk-grid-margin>
                <div class="uk-width-medium-1-1">       
                    <div id="" class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                        <div class="uk-width-medium-4-6">
                            <div class="uk-form-row">
                                <label for="add_nombre">NOMBRE CLIENTE</label>
                                <input type="text" class="md-input" autocomplete="off" style="text-transform: uppercase;" id="add_nombre"  name="add_nombre" value="" required="required" />
                            </div>
                        </div> 
                        <div class="uk-width-medium-2-6">
                           <div class="uk-form-row">     
                            <label for="add_dni">DNI</label>
                            <input type="text" class="md-input solo-ruc" autocomplete="off" id="add_dni"  name="add_dni" maxlength="8" required="required" />
                        </div>
                    </div>
                </div>
                <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-medium-4-6">
                       <div class="uk-form-row">     
                        <label for="add_direccion">DIRECCIÓN</label>
                        <input type="text" class="md-input" autocomplete="off" style="text-transform: uppercase;" id="add_direccion"  name="add_direccion" value="" required="required" />
                    </div>
                </div> 
                <div class="uk-width-medium-2-6">
                   <div class="uk-form-row">     
                    <label for="add_ruc">RUC</label>
                    <input type="text" class="md-input solo-ruc" maxlength="11" autocomplete="off" id="add_ruc"  name="add_ruc" value="" required="required" />
                </div>
            </div>  
        </div> 
        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin> 
            <div class="uk-width-medium-2-6">
                <div class="uk-form-row" >     
                  <label for="sel1">DEPARTAMENTOS</label>
                  <select id="departamentos"   placeholder="DEPARTAMENTOS" onchange="listar_provincia()" autocomplete="off" required="required"  name="departamentos" class="form-control" >
                     <option value=""></option>
                     <?php foreach($departamentos as $value){ ?>
                         <option value="<?php echo $value->id_departamentos; ?>"><?php echo $value->departamentos; ?></option>
                     <?php } ?>
                 </select>
             </div>
         </div>
         <div class="uk-width-medium-2-6">
            <div class="uk-form-row" >     
              <label for="sel1">PROVINCIAS</label>
              <select id="provincias" onchange="listar_distrito()"  placeholder="PROVINCIAS" autocomplete="off" required="required"  name="provincias" class="form-control" >

              </select>
          </div>
      </div>
      <div class="uk-width-medium-2-6">
        <div class="uk-form-row" >     
          <label for="sel1">DISTRITOS</label>
          <select id="distritos" placeholder="DISTRITOS" autocomplete="off" required="required"  name="distritos" class="form-control" >

          </select>
      </div>
  </div>
</div>
</div>            
</div>
<div id="" class="uk-grid " data-uk-grid-margin>
    <div class="uk-width-medium-4-6">
        <button type="submit" class="md-btn md-btn-primary  " ><i class="material-icons" style="color: #fff;">&#xE145;</i></button>
    </div>
</div>
</form>
<div class="uk-grid">
    <div class="uk-width-1-1">
    </div>
</div> 
</div>
</div>
<?php include('public/js.inc');?>
<script> 
  $('#formulario_agregar').on("submit", function(e){
    e.preventDefault();
    var fila = $("#tabla_venta tr").length;
    var cliente_escoger = $("#cliente_escoger").val();
    if (fila-1!=0&&direccion!=''&&nombre_comprador!=''&&nro_comprobante!=''&&fecha_compra!=''&&ruc!=''&&proveedor!='') {
      var formData = new FormData(document.getElementById("formulario_agregar"));
      var url = "<?php echo base_url();?>Ventas_c/agregar";
      $.ajax({                        
         type: "POST",                 
         url: url,                     
         data: formData,
         cache: false,
         contentType: false,
         processData: false
     }).done(function(data){
        location.href = "<?php echo base_url();?>Compra_c/"; 
    });
 }else{
    swal({
        title: "Error al Registrar la Compra",
        text: "¡Revise los campos y el detalle de compras!",
        type: "error",
        showCancelButton: false,
        confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
        confirmButtonText: 'Ok!'
    });  
}
}); 

  $('#agregar_producto').click(function(){
    var id=$('#producto_escoger').val();
    var uni=$('#id_uni').val();
    var cantidad=$('#cantidad').val();
    var precio=$('#precio').val();
    if (id!=''&&uni!='' &&cantidad!=''&&precio!='' ) {
        $.post("<?php echo base_url();?>Ventas_c/agregar_tabla", {"id": id,"uni": uni}, function(data) {
            $object = jQuery.parseJSON(data);   

            $('#tabla_venta tr:last').after('<tr id="fila'+$object.id_productos+'"><td>'+ $object.id_productos+'<input type="hidden" name="id_productos[]" id="id_productos[]" value="'+$object.id_productos+'"> </td><td>'+$object.descripcion+'</td><td>'+cantidad+'<input type="hidden" name="cantidad_comprada[]" id="cantidad_comprada[]" value="'+cantidad+'"></td><td>'+$object.unidad_medida+'<input type="hidden" name="unidad_medida[]" id="unidad_medida[]" value="'+$object.id_unidad_medida+'"></td><td>'+parseFloat(precio).toFixed(2)+'<input type="hidden" name="precio_producto[]" id="precio_producto[]" value="'+parseFloat(precio).toFixed(2)+'"></td><td>'+parseFloat(precio*cantidad).toFixed(2)+'</td><td><a class="md-btn md-btn-small  md-btn-danger" onclick="eliminar_producto('+$object.id_productos+')" ><i class="material-icons" style="color:#fff;">&#xE15B;</i></a></td></tr>');
            $('#cantidad').val('');
            $('#precio').val('');
            $("#producto_escoger").data("kendoComboBox").value("");
        });
    }else{
        alert('llenar datos');
    }
});

  $(document).ready(function (){
      $('.solo-numero').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9-]/g, '');
    });
  });

  $(document).ready(function (){
      $('.solo-ruc').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
    });
  });
  $(document).ready(function (){
      $('.solo-igv').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9.]/g, '');
    });
  }); 

  $(document).ready(function (){
     $.post("<?php echo base_url();?>Ventas_c/productos_escoger", function(data) {  
        $object = jQuery.parseJSON(data);
        var datos = [];
        for (var i = 0; i < $object.length; i++) {
            datos.push($object[i]);
        }
        $('#producto_escoger').kendoComboBox({
          dataTextField: "text",
          dataValueField: "value",
          dataSource: datos,
          filter: "contains",
          suggest: true,
      });
    });      
 }); 

  $(document).ready(function (){
     $.post("<?php echo base_url();?>Ventas_c/cliente_escoger", function(data) {  
        $object = jQuery.parseJSON(data);
        var datos = [];
        for (var i = 0; i < $object.length; i++) {
            datos.push($object[i]);
        }
        $('#cliente_escoger').kendoComboBox({
          dataTextField: "text",
          dataValueField: "value",
          dataSource: datos,
          filter: "contains",
          suggest: true,
      });
    });      
 });

  function precio_escoger(){
    var id = $('#producto_escoger').val();
    $("#tabla_precios").empty();
    if (id!='') {
        $.ajax({
            url : "<?php echo base_url();?>Ventas_c/precios",
            data : {id : id},
            type : 'POST',
                //dataType : 'json',(arrays)
                success : function(data) {
                    var type =  jQuery.parseJSON(data);
                    UIkit.modal("#modal_precio").show();
                    $('#tabla_precios').append('<thead><tr><th>UNIDAD MEDIDA</th><th>PRECIOS</th><th>SELECCIONAR</th></tr></thead>')
                    for (var i = 0; type.length > i; i++) {
                      $('#tabla_precios tr:last').after('<tr id="fila'+type[i].id_unidad_medida+'"><td>'+ type[i].unidad_medida+'<input type="hidden" name="unidad_m" id="unidad_m" value="'+type[i].unidad_medida+'"></td><td>'+ type[i].precio+'</td><td><a class="md-btn md-btn-small md-btn-primary uk-modal-close" onclick="seleccionar_precio('+type[i].id_unidad_medida+','+type[i].precio+')" ><i class="material-icons" style="color:#fff;">done_outline</i></a></td></tr>');
                  }
              }
          });
    }else{
     swal({
        title: "Error en el Precio",
        text: "¡No selecciono un producto!",
        type: "error",
        showCancelButton: false,
        confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
        confirmButtonText: 'Ok!'
    });  
 }
}

function seleccionar_precio($unidad_medida,$precio){
    var id = $unidad_medida;
    var pre =$precio.toFixed(2);
    $('#caja_precio').addClass('md-input-filled');
    $('#precio').val(pre);
    $('#id_uni').val(id);
}

function listar_provincia() {
 var id = $('#departamentos').val();
 $('#provincias').empty();
 $('#distritos').empty();
 $.ajax({
  url : "<?php echo base_url();?>Ventas_c/provincias",
  data : {id : id},
  type : 'POST',
                //dataType : 'json',(arrays)
                success : function(data) {
                    $object = jQuery.parseJSON(data);
                    $('#provincias').append('<option value=""></option>');
                    for (var i = 0; i < $object.length; i++) {
                       $('#provincias').append('<option value="'+$object[i].id_provincias+'">'+$object[i].provincias+'</option>');
                   }
               }
           });
}

function listar_distrito() {
 var id = $('#provincias').val();
 $('#distritos').empty();
 $.ajax({
  url : "<?php echo base_url();?>Ventas_c/distritos",
  data : {id : id},
  type : 'POST',
                //dataType : 'json',(arrays)
                success : function(data) {
                    $object = jQuery.parseJSON(data);
                    $('#distritos').append('<option value=""></option>');
                    for (var i = 0; i < $object.length; i++) {
                       $('#distritos').append('<option value="'+$object[i].id_distritos+'">'+$object[i].distritos+'</option>');
                   }
               }
           });
}

function cliente(){
 var id = $("#cliente_escoger").val();
 $.ajax({
  url : "<?php echo base_url();?>Ventas_c/cliente",
  data : {id : id},
  type : 'POST',
                //dataType : 'json',(arrays)
                success : function(data) {
                    $object = jQuery.parseJSON(data);
                    $("#caja_ruc").addClass('md-input-filled');
                    $("#caja_direccion").addClass('md-input-filled');
                    $("#direccion").val($object.direccion);
                    $("#ruc").val($object.ruc);
                }    
            });
}

function agregar_cliente(){
    UIkit.modal("#modal_cliente").show();
}

$('#formulario_agregar_cliente').on("submit", function(e){
    e.preventDefault();
    var nombre = $("#add_nombre").val();
    var dni = $("#add_dni").val();
    var ruc = $("#add_ruc").val();
    var direccion = $("#add_direccion").val();
    var distritos = $("#distritos").val();
    if (nombre!=''&&dni!=''&&ruc!=''&&direccion!=''&&distritos!='') {
      var formData = new FormData(document.getElementById("formulario_agregar_cliente"));
      var url = "<?php echo base_url();?>Ventas_c/agregar_cliente";
      $.ajax({                        
       type: "POST",                 
       url: url,                     
       data: formData,
       cache: false,
       contentType: false,
       processData: false
   }).done(function(data){
    var type =  jQuery.parseJSON(data);
    var ds = $('#cliente_escoger').data().kendoComboBox.dataSource;
    ds.add(type);
    $("input[name='cliente_escoger_input']").val(type['text']);
    $("#cliente_escoger").val(type['value']);
    $("#caja_ruc").addClass('md-input-filled');
    $("#caja_direccion").addClass('md-input-filled');
    $("#direccion").val(type['direccion']);
    $("#ruc").val(type['ruc']);
    UIkit.modal("#modal_cliente").hide();
    $("#add_nombre").val('');
    $("#add_dni").val('');
    $("#add_ruc").val('');
    $("#add_direccion").val('');
});
}else{
    swal({
        title: "Error al Registrar Cliente",
        text: "¡Llene todos los campos vacios!",
        type: "error",
        showCancelButton: false,
        confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
        confirmButtonText: 'Ok!'
    });  
}
}); 

function subtotal(){
    var precio   = parseFloat($('#precio').val());
    var cantidad = parseInt($('#cantidad').val());
    var monto_total = parseFloat($('#monto_total').val());
    var monto_parcial =  parseFloat(monto_total+(precio*cantidad)).toFixed(2);
    $('#monto_total').val(monto_parcial);
    $('#mon').val(monto_parcial);
    igv_sub(monto_parcial);
}

function modificar_total(){
    var descuento =  parseFloat($('#descuento').val());
    var mon =  parseFloat($('#mon').val());  
    monto_total =parseFloat(mon-descuento).toFixed(2);
    $('#monto_total').val(monto_total);
    igv_sub(monto_total);
}

function eliminar_producto(id){
   var monto_eliminado =  $('#tabla_venta tr#fila'+id).find('td').eq(5).html();
   var monto_total = parseFloat($('#mon').val());
   var nuevo_total = parseFloat(monto_total)-parseFloat(monto_eliminado);
   $('#monto_total').val(nuevo_total.toFixed(2));
   $('#mon').val(nuevo_total.toFixed(2));
   igv_sub(nuevo_total);
   $("#fila" + id ).remove();
}

function igv_sub(m){
    var monto_total = m;
    if (monto_total>'0.00') {
     if($('#igv_actual').val()!='0' ){
         var igv_actual = parseFloat($('#igv_actual').val()); 
         var sub =igv_actual+1;  
         var subtotal =parseFloat(monto_total/sub);
         subtotal = Math.round(subtotal*100)/100;
         var igv =parseFloat(igv_actual*subtotal);
         igv = Math.round(igv*100)/100;
         $('#igv').val(igv.toFixed(2));
         $('#subtotal').val(subtotal.toFixed(2))
     }else{ 
        $('#igv').val('0.00');
        $('#subtotal').val('0.00');    
    }
}else{
    $('#descuento').val('0'); 
    $('#igv').val('0.00');
    $('#subtotal').val('0.00');
}
}

</script>