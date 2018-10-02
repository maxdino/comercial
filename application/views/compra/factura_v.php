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
                            <div class="uk-width-large-4-6">
                                <div class="uk-form-row">
                                    <label for="nombre_comprador">NOMBRE DEL COMPRADOR</label>
                                    <input type="text" class="md-input" autocomplete="off" style="text-transform: uppercase;" id="nombre_comprador"   name="nombre_comprador" value="" required="required"/>
                                </div>
                            </div>
                            <div class="uk-width-large-2-6">
                                <div class="uk-form-row">
                                    <label for="nro_comprobante">NRO COMPROBANTE</label>
                                    <input type="text" class="md-input solo-numero" autocomplete="off"  id="nro_comprobante"   name="nro_comprobante" value="" required="required" />
                                    <input type="hidden" name="tipo_comprobante" id="tipo_comprobante" value="1"  />
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="md-card-content large-padding" style="padding-top: 0px;">
                        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                            <div class="uk-width-large-4-6">
                                <div class="uk-form-row">
                                    <label for="direccion">DIRECCIÓN</label>
                                    <input type="text" class="md-input" autocomplete="off" style="text-transform: uppercase;" id="direccion"  name="direccion" value="" required="required" />
                                </div>
                            </div>
                            <div class="uk-width-large-2-6">
                                <div class="uk-form-row">
                                    <select id="proveedor" placeholder="PROVEEDOR" autocomplete="off" required="required"  name="proveedor"  data-md-selectize>
                                        <option value=""></option>
                                        <?php foreach($proveedor as $value){ ?>
                                            <option value="<?php echo $value->id_proveedor; ?>"><?php echo $value->empresa; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="md-card-content large-padding" style="padding-top: 0px;" >
                        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin id="dni_mostrar"   >
                            <div class="uk-width-large-2-6" >
                                <div class="uk-form-row">
                                    <label>RUC</label>
                                    <input type="text" class="md-input solo-ruc" autocomplete="off" maxlength="11" style="text-transform: uppercase;" id="ruc" required="required"  name="ruc" value=""/>
                                </div>
                            </div>
                            <div class="uk-width-large-2-6">
                                <div class="uk-width-medium-1-1">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_1">FECHA</label>
                                        <input class="md-input" type="text" required="required" autocomplete="off" id="uk_dp_1" name="fecha_compra" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                    </div>
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
                                </div>
                            </div>
                        </div> 
                    </div>  
                    <div class="md-card-content large-padding" style="padding-top: 0px;" >
                        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                            <div class="uk-width-large-2-6">
                                <div class="uk-form-row">
                                    <input id="producto_escoger" name="producto_escoger"    placeholder="SELECCIONAR PRODUCTO..."   style="width: 300px;text-transform: uppercase;" />
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
                                    <label for="nombre_producto">PRECIO</label>
                                    <input type="number" class="md-input"  id="precio" autocomplete="off" name="precio" min="1" />
                                </div>
                            </div>
                            <div class="uk-width-large-1-6">
                                <div class="uk-form-row">
                                    <select id="unidad"  name="unidad" placeholder="UNIDAD."  data-md-selectize>
                                        <option value=""></option>
                                        <?php foreach($unidad as $value){ ?>
                                            <option value="<?php echo $value->id_unidad_medida; ?>"><?php echo $value->unidad_medida; ?></option>
                                        <?php } ?>
                                    </select>
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
                                        <table class="uk-table uk-text-nowrap" id="tabla_compra">
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
                                    <input type="text"  id="igv_actual" name="igv_actual" autocomplete="off" onchange="igv_nuevo()"  value="0.18" class=" md-input solo-igv" max="1" />
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
                                        </div>
                                    </div>            
                                </div> 
                            </div>     
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-width-xLarge-1-10 uk-width-large-2-10"   >


            </div>

                

            <div class="md-fab-wrapper" >
            <div class="md-fab-wrapper md-fab-in-card md-fab-speed-dial">
                                <a class="md-fab md-fab-primary" ><i class="material-icons">menu</i></a>
                                <div class="md-fab-wrapper-small">
                                    <button type="submit" class="md-fab md-fab-small md-fab-success"  ><i class="material-icons">&#xE145;</i></button>
                                    <a class="md-fab md-fab-small md-fab-danger" href="<?php echo base_url();?>Compra_c"><i class="material-icons">&#xe5cd;</i></a>
                                </div>
                            </div>
                             </div>
        </form>
        <?php include('public/js.inc');?>
        <script> 


          $('#formulario_agregar').on("submit", function(e){
            e.preventDefault();
            var fila = $("#tabla_compra tr").length;
            var nombre_comprador = $("#nombre_comprador").val();
            var nro_comprobante = $("#nro_comprobante").val();
            var direccion = $("#direccion").val();
            var proveedor = $("#proveedor").val();
            var ruc = $("#ruc").val();
            var fecha_compra = $("#uk_dp_1").val();
            if (fila-1!=0&&direccion!=''&&nombre_comprador!=''&&nro_comprobante!=''&&fecha_compra!=''&&ruc!=''&&proveedor!='') {
              var formData = new FormData(document.getElementById("formulario_agregar"));
              var url = "<?php echo base_url();?>Compra_c/agregar";
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
            var uni=$('#unidad').val();
            var cantidad=$('#cantidad').val();
            var precio=$('#precio').val();
            if (id!=''&&uni!='' &&cantidad!=''&&precio!='' ) {
                $.post("<?php echo base_url();?>Compra_c/agregar_tabla", {"id": id,"uni": uni}, function(data) {
                    $object = jQuery.parseJSON(data);   

                    $('#tabla_compra tr:last').after('<tr id="fila'+$object.id_productos+'"><td>'+ $object.id_productos+'<input type="hidden" name="id_productos[]" id="id_productos[]" value="'+$object.id_productos+'"> </td><td>'+$object.descripcion+'</td><td>'+cantidad+'<input type="hidden" name="cantidad_comprada[]" id="cantidad_comprada[]" value="'+cantidad+'"></td><td>'+$object.unidad_medida+'<input type="hidden" name="unidad_medida[]" id="unidad_medida[]" value="'+$object.id_unidad_medida+'"></td><td>'+parseFloat(precio).toFixed(2)+'<input type="hidden" name="precio_producto[]" id="precio_producto[]" value="'+parseFloat(precio).toFixed(2)+'"></td><td>'+parseFloat(precio*cantidad).toFixed(2)+'</td><td><a class="md-btn md-btn-small  md-btn-danger" onclick="eliminar_producto('+$object.id_productos+')" ><i class="material-icons" style="color:#fff;">&#xE15B;</i></a></td></tr>');
                    $('#cantidad').val('');
                    $('#precio').val('');
                    var selectize = $("#unidad")[0].selectize;
                    selectize.clear();
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
             $.post("<?php echo base_url();?>Compra_c/productos_escoger", function(data) {  
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

          function subtotal(){
            var precio   = parseFloat($('#precio').val());
            var cantidad = parseInt($('#cantidad').val());
            var subtotal = parseFloat($('#subtotal').val());
            var monto_parcial =  parseFloat(subtotal+(precio*cantidad)).toFixed(2);
            if($('#igv_actual').val()!='0' ){
                var igv_actual = parseFloat($('#igv_actual').val());    
                $('#subtotal').val(monto_parcial);
                var igv =parseFloat(monto_parcial*igv_actual).toFixed(2);
                $('#igv').val(igv);
                var descuento = parseFloat($('#descuento').val());
                var monto_p=parseFloat(monto_parcial)+parseFloat(igv);
                var monto_total =parseFloat(monto_p-descuento).toFixed(2);
                $('#monto_total').val(monto_total);
            }else{ 
                $('#igv').val(0.00);
                $('#subtotal').val(monto_parcial);
                var descuento = parseFloat($('#descuento').val());
                var monto_total =parseFloat(monto_parcial-descuento).toFixed(2);
                $('#monto_total').val(monto_total);     
            }
        }

        function igv_nuevo(){
            var monto_parcial = parseFloat($('#subtotal').val()); 
            if($('#igv_actual').val()!='0' ){
                var igv = parseFloat($('#igv_actual').val());
                var igv_nuevo =parseFloat(monto_parcial*igv).toFixed(2);
                $('#igv').val(igv_nuevo);
                var descuento = parseFloat($('#descuento').val());
                var monto_p=parseFloat(monto_parcial)+parseFloat(igv_nuevo);
                var monto_total =parseFloat(monto_p-descuento).toFixed(2);
                $('#monto_total').val(monto_total);     
            }else{
                $('#igv').val(0.00);
                var descuento = parseFloat($('#descuento').val());
                var monto_total =parseFloat(monto_parcial-descuento).toFixed(2);
                $('#monto_total').val(monto_total);    
            }
        }

        function modificar_total(){
            var monto_parcial = parseFloat($('#subtotal').val());
            var descuento =  parseFloat($('#descuento').val());
            var igv =  parseFloat($('#igv').val());  
            var monto_total =parseFloat((monto_parcial+igv)-descuento).toFixed(2);
            $('#monto_total').val(monto_total);
        }

        function eliminar_producto(id){
           var monto_eliminado =  $('#tabla_compra tr#fila'+id).find('td').eq(5).html();
           var subtotal = parseFloat($('#subtotal').val());
           var nuevo_subtotal = parseFloat(subtotal)-parseFloat(monto_eliminado);
           $('#subtotal').val(nuevo_subtotal);
           if($('#igv_actual').val()!='0' ){
            var igv_actual = parseFloat($('#igv_actual').val());    
            var igv =parseFloat(nuevo_subtotal*igv_actual).toFixed(2);
            $('#igv').val(igv);
            var descuento = parseFloat($('#descuento').val());
            var monto_p=parseFloat(nuevo_subtotal)+parseFloat(igv);
            var monto_total =parseFloat(monto_p-descuento).toFixed(2);
            $('#monto_total').val(monto_total);
        }else{ 
            $('#igv').val(0.00);
            var descuento = parseFloat($('#descuento').val());
            var monto_total =parseFloat(nuevo_subtotal-descuento).toFixed(2);
            $('#monto_total').val(monto_total);     
        }
        $("#fila" + id ).remove();
    }


</script>