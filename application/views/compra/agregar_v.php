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
        <h3 class="heading_b uk-margin-bottom"></h3>
        <div id="page_content_inner">
            <form action="" class="uk-form-stacked"  name="formulario_agregar" id="formulario_agregar">
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-9-10  uk-width-large-10-10">
                        <div class="md-card">
                            <div class="md-card-content large-padding" >
                                <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                   <div class="uk-width-large-3-6">
                                    <div class="uk-form-row">
                                        <select id="tipo_comprobante" required="required" onchange="traer_comprobante()"  name="tipo_comprobante" placeholder="TIPO COMPROBANTE"  data-md-selectize>
                                            <option value=""></option>
                                            <?php foreach($tipo_comprobante as $value){ ?>
                                            <option value="<?php echo $value->id_tipo_comprobante; ?>"><?php echo $value->descripcion; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>         
                    </div>
                </div>
                
                 <div  class="uk-width-xLarge-9-10  uk-width-large-10-10" id="mostrar_tipo_comprobante">
                     <?php include('public/js_compra.inc');?>
                 </div>


                
            </div> 

        </form>

    </div>



</div>



<script type="text/javascript">

    function traer_comprobante()
        {   
            var id = $('#tipo_comprobante').val();
            if(id != ""){
                $("#mostrar_tipo_comprobante").empty();
                $("#mostrar_tipo_comprobante").load("<?php echo site_url('Compra_c/mostrar_comprobante'); ?>"+"/"+id);
            }

        }


    $('#formulario_agregar').on("submit", function(e){
      e.preventDefault();
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

}); 

  

    function activo(){
        var monto_parcial = parseFloat($('#subtotal').val()); 
        if($('#igv_actual').val()!='0' ){
            $('#valida_igv').show();
            $('#estado_igv').val(1);
            var igv = parseFloat($('#igv_actual').val());
            var igv_nuevo =parseFloat(monto_parcial*igv).toFixed(2);
            $('#igv').val(igv_nuevo);
            var descuento = parseFloat($('#descuento').val());
            var monto_p=parseFloat(monto_parcial)+parseFloat(igv_nuevo);
            var monto_total =parseFloat(monto_p-descuento).toFixed(2);
            $('#monto_total').val(monto_total);     
        }else{
            $('#valida_igv').hide();
            $('#estado_igv').val(0);
            $('#subtotal').val(monto_parcial);
            $('#igv').val(0.00);
            var descuento = parseFloat($('#descuento').val());
            var monto_total =parseFloat(monto_parcial-descuento).toFixed(2);
            $('#monto_total').val(monto_total);    
        }
    }

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


/*          function cantidad_producto(){
                var id=$('#producto_escoger').val();
                $.post("<?php echo base_url();?>Compra_c/cantidad_producto",{"id" : id}, function(data) { 
                $object = jQuery.parseJSON(data);   
                $('#cantidad').prop('max',$object.stock);
                $('#cantidad_stock').val($object.stock);
                });
            }

            function validar_stock(){
                var stock = $('#cantidad_stock').val();
                var stock_nuevo =  $('#cantidad').val();
                if (stock_nuevo<=stock) {
                    $('#cantidad').val(stock_nuevo);
                }else{
                    $('#cantidad').val(stock);
                }
            }*/

    
     </script>
 </body>
 </html>