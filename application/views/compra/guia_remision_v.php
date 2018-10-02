 
<div class="uk-width-xLarge-9-10  uk-width-large-10-10"   >
    <div class="md-card">
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                GUIA DE REMISIÓN
            </h3>
        </div>
        <div class="md-card-content large-padding" style="margin-bottom: -20px;" >
            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-2-6">
                    <div class="uk-width-medium-1-1">
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                            <label for="uk_dp_1">FECHA DE EMISIÓN</label>
                            <input class="md-input" type="text" required="required" id="fecha_emision" name="fecha_emision" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-2-6">
                    <div class="uk-width-medium-1-1">
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                            <label for="uk_dp_1">FECHA DE TRASLADO</label>
                            <input class="md-input" type="text" required="required" id="fecha_traslado" name="fecha_traslado" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-2-6">
                    <div class="uk-form-row">
                        <label for="nro_comprobante">NRO GUIA DE REMISIÓN</label>
                        <input type="text" class="md-input solo-numero"  id="nro_comprobante"   name="nro_comprobante" value="" required="required" />
                    </div>
                </div>
            </div>
        </div>
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                DOMICILIO DE PARTIDA
            </h3>
        </div>
        <div class="md-card-content large-padding" style="margin-bottom: -20px;" >
            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-3-6">
                    <div class="uk-form-row">
                        <label for="direccion">DIRECCIÓN</label>
                        <input type="text" class="md-input" style="text-transform: uppercase;" id="direccion_"  name="direccion" value="" required="required" />
                    </div>
                </div>
                <div class="uk-width-large-1-6">
                    <div class="uk-form-row">
                        <label for="nro_comprobante">DEPARTAMENTO</label>
                        <input type="text" class="md-input solo-numero"  id="departamento_partida"   name="departamento_partida" value="" required="required" />
                    </div>
                </div>
                <div class="uk-width-large-1-6">
                    <div class="uk-form-row">
                        <label for="nro_comprobante">PROVINCIA</label>
                        <input type="text" class="md-input solo-numero"  id="provincia_partida"   name="provincia_partida" value="" required="required" />
                    </div>
                </div>
                <div class="uk-width-large-1-6">
                    <div class="uk-form-row">
                        <label for="nro_comprobante">DISTRITO</label>
                        <input type="text" class="md-input solo-numero"  id="distrito_partida"   name="distrito_partida" value="" required="required" />
                    </div>
                </div>
            </div>
        </div>
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                DOMICILIO DE LLEGADA
            </h3>
        </div>
        <div class="md-card-content large-padding" style="margin-bottom: -20px;" >
            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-3-6">
                    <div class="uk-form-row">
                        <label for="direccion">DIRECCIÓN</label>
                        <input type="text" class="md-input" style="text-transform: uppercase;" id="direccion"  name="direccion" value="" required="required" />
                    </div>
                </div>
                <div class="uk-width-large-1-6">
                    <div class="uk-form-row">
                        <label for="nro_comprobante">DEPARTAMENTO</label>
                        <input type="text" class="md-input solo-numero"  id="nro_comprobante"   name="nro_comprobante" value="" required="required" />
                    </div>
                </div>
                <div class="uk-width-large-1-6">
                    <div class="uk-form-row">
                        <label for="nro_comprobante">PROVINCIA</label>
                        <input type="text" class="md-input solo-numero"  id="nro_comprobante"   name="nro_comprobante" value="" required="required" />
                    </div>
                </div>
                <div class="uk-width-large-1-6">
                    <div class="uk-form-row">
                        <label for="nro_comprobante">DISTRITO</label>
                        <input type="text" class="md-input solo-numero"  id="nro_comprobante"   name="nro_comprobante" value="" required="required" />
                    </div>
                </div>
            </div>
        </div>
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                DESTINATARIO
            </h3>
        </div>
        <div class="md-card-content large-padding" style="margin-bottom: -60px;" >
            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-4-6">
                    <div class="uk-form-row">
                        <label for="nombre_producto">NOMBRE DEL COMPRADOR</label>
                        <input type="text" class="md-input" style="text-transform: uppercase;" id="nombre_producto"   name="nombre_comprador" value="" required="required"/>
                    </div>
                </div>
                <div class="uk-width-large-2-6" >
                    <div class="uk-form-row">
                        <label    >RUC</label>
                        <input type="text" class="md-input solo-ruc" maxlength="11" style="text-transform: uppercase;" id="ruc" required="required"  name="ruc" value=""/>
                    </div>
                </div>
            </div>
        </div> 
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
               
            </h3>
        </div>  
        <div class="md-card-content large-padding"  >
            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-2-6">
                    <div class="uk-form-row">
                        <input id="producto_escoger" name="producto_escoger"  placeholder="SELECCIONAR PRODUCTO..."   style="width: 300px;text-transform: uppercase;" />
                    </div>
                </div>
                <div class="uk-width-large-1-6">
                    <div class="uk-form-row">
                        <label for="nombre_producto">CANTIDAD</label>
                        <input type="number" class="md-input"   id="cantidad" name="cantidad" min="1" />
                    </div>
                </div>
                <div class="uk-width-large-1-6">
                    <div class="uk-form-row">
                        <label for="nombre_producto">PRECIO</label>
                        <input type="number" class="md-input"  id="precio" name="precio" min="1" />
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
                    <div class="uk-form-row">
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
    <button type="submit" class="md-fab md-fab-accent" id="guardar" ><i class="material-icons">&#xE145;</i></button>
</div>
<?php include('public/js.inc');?>

<script> 

   $('#agregar_producto').click(function(){
    var id=$('#producto_escoger').val();
    var uni=$('#unidad').val();
    var cantidad=$('#cantidad').val();
    var precio=$('#precio').val();
    if (id!=''&&uni!='' &&cantidad!=''&&precio!='' ) {
        $.post("<?php echo base_url();?>Compra_c/agregar_tabla", {"id": id,"uni": uni}, function(data) {
            $object = jQuery.parseJSON(data);   

            $('#tabla_compra tr:last').after('<tr id="fila'+$object.id_productos+'"><td>'+ $object.id_productos+'<input type="hidden" name="id_productos[]" id="id_productos[]" value="'+$object.id_productos+'"> </td><td>'+$object.descripcion+'</td><td>'+cantidad+'<input type="hidden" name="cantidad_comprada[]" id="cantidad_comprada[] value="'+cantidad+'""></td><td>'+$object.unidad_medida+'<input type="hidden" name="unidad_medida[]" id="unidad_medida[] value="'+$object.id_unidad_medida+'""></td><td>'+parseFloat(precio).toFixed(2)+'<input type="hidden" name="precio_producto[]" id="precio_producto[]" value="'+parseFloat(precio).toFixed(2)+'"></td><td>'+parseFloat(precio*cantidad).toFixed(2)+'</td><td><a class="md-btn md-btn-small  md-btn-danger" onclick="eliminar_producto('+$object.id_productos+')" ><i class="material-icons" style="color:#fff;">&#xE15B;</i></a></td></tr>');
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

    function modificar_total(){
        var monto_parcial = parseFloat($('#subtotal').val());
        var descuento =  parseFloat($('#descuento').val());
        if($('#igv_actual').val()!='0' ){
            var igv =  parseFloat($('#igv').val());  
            var monto_total =parseFloat((monto_parcial+igv)-descuento).toFixed(2);
            $('#monto_total').val(monto_total);
        }else{
            var monto_total =parseFloat(monto_parcial-descuento).toFixed(2);
            $('#monto_total').val(monto_total);    
        }
    }

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


</script>