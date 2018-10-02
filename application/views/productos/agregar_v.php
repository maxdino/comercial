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
        <h3 class="heading_b uk-margin-bottom">AGREGAR PRODUCTOS</h3>
        <div id="page_heading">
            <h1 id="titulo_producto"> </h1> 
            <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn"></span>
        </div>
        <div id="page_content_inner">
            <form action="" method="POST" class="uk-form-stacked" enctype="multipart/form-data"  name="formulario_agregar" id="formulario_agregar">
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-2-10 uk-width-large-3-10">
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <div class="md-card-toolbar-actions"> 
                                </div>
                                <h3 class="md-card-toolbar-heading-text">
                                    IMAGEN
                                </h3>
                            </div>
                            <div class="md-card-content">
                                <input type="file" id="foto" name="foto" class="dropify" />
                                <!-- input-file-a-->
                            </div>
                        </div>
                        <div class="md-card" id="caja_codigo" style="display: none;">
                            <center>
                                <div class="md-card-content">
                                    <img src="" id="barra">
                                    <!-- input-file-a-->
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="uk-width-xLarge-8-10  uk-width-large-7-10">
                        <div class="md-card">
                            <ul class="uk-tab" data-uk-tab="{connect:'#tabs_2'}">
                                <li class="uk-active"><a href="#">GENERAL</a></li>
                                <li><a href="#">PRECIOS Y CANTIDAD</a></li>
                            </ul>
                            <ul id="tabs_2" class="uk-switcher uk-margin">
                                <li>
                                    <div class="md-card-content large-padding">
                                        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                            <div class="uk-width-large-1-2">
                                                <div class="uk-form-row">
                                                    <label for="nombre_producto">NOMBRE DEL PRODUCTO</label>
                                                    <input type="text" class="md-input" autocomplete="off" style="text-transform: uppercase;" id="nombre_producto" onkeyup="titulo_producto()" name="nombre_producto" value=""/>
                                                </div>
                                                <div class="uk-form-row"  >
                                                    <label for="categoria" class="uk-form-label">CATEGORIA</label>
                                                    <select id="categoria" placeholder="CATEGORIA" name="categoria" onchange="titulo_categoria()" data-md-selectize>
                                                        <option value=""></option>
                                                        <?php foreach($categoria as $value){ ?>
                                                            <option value="<?php echo $value->id_categoria; ?>"><?php echo $value->descripcion; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden" name="" id="categoria_descripcion">
                                                </div>
                                                <div class="uk-form-row"  >
                                                    <label for="marca" class="uk-form-label">MARCAS</label>
                                                    <select id="marca" name="marca" placeholder="MARCAS"  onchange="titulo_marcas()" data-md-selectize>
                                                        <option value=""></option>
                                                        <?php foreach($marcas as $value){ ?>
                                                            <option value="<?php echo $value->id_marcas; ?>"><?php echo $value->descripcion; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden" name="" id="marcas_descripcion">
                                                </div>
                                                <div class="uk-form-row"  >
                                                    <label for="material" class="uk-form-label">MATERIAL</label>
                                                    <select id="material" name="material" onchange="titulo_material()" placeholder="MATERIAL"  data-md-selectize>
                                                        <option value=""></option>
                                                        <?php foreach($material as $value){ ?>
                                                            <option value="<?php echo $value->id_material; ?>"><?php echo $value->material; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden"   id="material_descripcion">
                                                </div>
                                            </div>
                                            <div class="uk-width-large-1-2" >
                                                <div class="uk-form-row">
                                                    <label class="uk-form-label" for="tallas">TALLAS</label>
                                                    <select id="tallas" name="tallas" placeholder="PACK TALLAS"   data-md-selectize>
                                                        <option value=""></option>
                                                        <?php foreach($pack_tallas as $value){ ?>
                                                            <option value="<?php echo $value->id_pack_tallas; ?>"><?php echo $value->pack_tallas; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>                                                
                                                <div class="uk-form-row"  >
                                                    <label for="colores" class="uk-form-label">PACK DE COLORES</label>
                                                    <select id="colores" name="colores" placeholder="PACK COLORES"   data-md-selectize>
                                                        <option value=""></option>
                                                        <?php foreach($pack_colores as $value){ ?>
                                                            <option value="<?php echo $value->id_pack_colores; ?>"><?php echo $value->pack_colores; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-card-content large-padding">
                                        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                            <div class="uk-width-large-1-2">
                                               <div class="uk-form-row"> 
                                                <label for="unidad">UNIDAD MEDIDA</label>
                                                <?php foreach($precio_unidad as $value){ ?>
                                                    <div class="md-card-content" style="margin-bottom: -25px;"> 
                                                     <div class="uk-float-right" style="margin-top: -5px;">
                                                        <input type="checkbox" data-switchery id="<?php echo $value->id_unidad_medida; ?>" name="activar" onchange="activar_pre(<?php echo $value->id_unidad_medida; ?> )"  />
                                                        <input type="hidden" id="<?php echo 'name'.$value->id_unidad_medida; ?>" value="<?php echo $value->unidad_medida; ?>"  />
                                                    </div>
                                                    <label class="uk-display-block  " for="<?php echo $value->id_unidad_medida; ?>"><?php echo $value->unidad_medida; ?></label> 
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="uk-form-row">
                                            <label for="unidad">PRECIOS</label>
                                        </div>                                       
                                        <div class="uk-form-row" id="precios_productos">                           
                                        </div>
                                    </div>
                                    <div class="uk-width-large-1-2">
                                        <div class="uk-form-row"> 
                                            <label for="almacenes">ALMACENES</label>
                                            <?php foreach($almacen as $value){ ?>
                                                <div class="md-card-content" style="margin-bottom: -25px;"> 
                                                 <div class="uk-float-right" style="margin-top: -5px;">
                                                    <input type="checkbox" data-switchery id="<?php echo 'a'.$value->id_almacen; ?>"         onchange="activar_can(<?php echo $value->id_almacen; ?> )"  />
                                                    <input type="hidden" id="<?php echo 'namea'.$value->id_almacen; ?>" value="<?php echo $value->almacen; ?>"  />
                                                </div>
                                                <label class="uk-display-block  " for="<?php echo 'a'.$value->id_almacen; ?>"><?php echo $value->almacen; ?></label> 
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="uk-form-row">
                                        <label for="cantidad_minima">CANTIDAD MINIMA</label>
                                        <input type="text" autocomplete="off" class="md-input solo-precio" min="1" name="cantidad_minima" id="cantidad_minima" value="" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label for="unidad">CANTIDADES</label>
                                    </div>  
                                    <div class="uk-form-row" id="add_cantidad"></div>
                                </div> 
                            </div>
                        </div>
                    </li>
                </div>
            </div>
        </div>
        <div class="md-fab-wrapper" >
            <div class="md-fab-wrapper md-fab-in-card md-fab-speed-dial">
                <a class="md-fab md-fab-primary" ><i class="material-icons">&#xe5d2;</i></a>
                <div class="md-fab-wrapper-small">
                    <button type="submit" class="md-fab md-fab-small md-fab-success" id="guardar" ><i class="material-icons">&#xE145;</i></button>
                    <a class="md-fab md-fab-small md-fab-danger" href="<?php echo base_url();?>Productos_c"><i class="material-icons">&#xe5cd;</i></a>
                </div>
            </div>
        </div>
    </form>

</div>


</div>
<?php include('public/js.inc');?>

<script type="text/javascript">

    $('#formulario_agregar').on("submit", function(e){
        e.preventDefault();
        var unidad = $("#unidad").val();
        var precio = $("#precio").val();
        var categoria = $("#categoria").val();
        var marca = $("#marca").val();
        var almacen = $("#almacen").val();
        var cantidad_minima = $("#cantidad_minima").val();
        var cantidad = $("#cantidad").val();
        var material = $("#material").val();
        var nombre_producto = $("#nombre_producto").val();
        var colores = $("#colores").val();
        var tallas = $("#tallas").val();
        var foto = $("#foto").val();
        if (precio!=null&&categoria!=''&&marca!=''&&cantidad_minima!=''&&cantidad!=null&&nombre_producto!=''&&colores!=''&&material!=''&&tallas!='') {
            var formData = new FormData(document.getElementById("formulario_agregar"));
            var url = "<?php echo base_url();?>Productos_c/agregar";
            $.ajax({                        
               type: "POST",                 
               url: url,                     
               data: formData,
               cache: false,
               contentType: false,
               processData: false

           }).done(function(data){
             location.href = "<?php echo base_url();?>productos_c/"; 
         });
       }else{
        swal({
            title: "Error al Registrar el producto",
            text: "¡Llene los campos vacios!",
            type: "error",
            showCancelButton: false,
            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
            confirmButtonText: 'Ok!'
        });  
    }
}); 

    function activar_pre(id){ 
        var c = document.getElementById(id);
        var name = $("#name"+id).val();
        if (c.checked==true) {
            $('#precios_productos').append('<div class="uk-grid-margin uk-row-first" id="precio_'+id+'"><div class="uk-input-group"> <span class="uk-input-group-addon"> S/.</span><div class="md-input-wrapper md-input-filled"><label>PRECIO '+name+'</label><input type="text" autocomplete="off" onkeyup="llenar_precios('+id+')" class="md-input solo-numero pre'+id+'" maxlength="9" min="1" id="precio" name="precio[]" value="00.00"><input type="hidden"  id="unidad[]" name="unidad[]" value="'+id+'"><span class="md-input-bar"></span></div> </div> </div>');
        }else{
            $('#precio_'+id).remove();
        }
    }

    function activar_can(id){ 
        var a = document.getElementById('a'+id);
        var name = $("#namea"+id).val();
        if (a.checked==true) {
            $('#add_cantidad').append('<div class="uk-grid-margin uk-form-row" id="cantidad_'+id+'"><div class="md-input-wrapper md-input-filled"><label>CANTIDAD '+name+'</label><input type="number" autocomplete="off" class="md-input solo-numero can'+id+'" maxlength="9" onkeyup="llenar_cantidad('+id+')" id="cantidad" name="cantidad[]" value="0" ><input type="hidden"  id="almacen" name="almacen[]" value="'+id+'"><span class="md-input-bar"></span></div> </div>');
        }else{
            $('#cantidad_'+id).remove();
        }
    }

    function llenar_precios(id){ 
        var precio = $(".pre"+id).val();
        if (precio=='') {
            $(".pre"+id).val('00.00');
        }
    }

    function llenar_cantidad(id){ 
        var cantidad = $(".can"+id).val();
        if (cantidad=='') {
            $(".can"+id).val('0');
        }
    }

    function codigo_barras(){
        $.ajax({
            url : "<?php echo base_url();?>productos_c/max_producto",
            type : 'POST',
            success : function(data) {
                var type =  jQuery.parseJSON(data);  
                var codigo_barras='';
                var f = new Date();
                var mes= String(f.getMonth()+1);
                var dia= String(f.getDate());
                if (mes.length=='1') {
                    mes='0'+mes;
                }
                if (dia.length=='1') {
                    dia='0'+dia;
                }
                var categoria=$('#categoria').val();
                var marcas=$('#marca').val();
                var material=$('#material').val();
                codigo_barras='<?php echo base_url();?>productos_c/codigo_barras?text='+type.id_productos+marcas+categoria+material+f.getFullYear()+mes+dia;
                $('#barra').attr('src',codigo_barras);
                $('#caja_codigo').css('display','block');
            }
        });
    }

    function titulo_producto(){
        var descripcion_general='';
        var producto=$('#nombre_producto').val().toUpperCase();
        var categoria=$('#categoria_descripcion').val();
        var marcas=$('#marcas_descripcion').val();
        var material=$('#material_descripcion').val();
        codigo_barras();
        descripcion_general=producto+' '+categoria+' '+marcas+' '+material;
        $('#titulo_producto').html(descripcion_general);
    }

    function titulo_marcas(){
     id_marca=$('#marca').val();
     if (id_marca!='') {
        $.ajax({
            url : "<?php echo base_url();?>productos_c/marcas",
            data : {id : id_marca},
            type : 'POST',
                //dataType : 'json',(arrays)
                success : function(data) {
                    var type =  jQuery.parseJSON(data); 
                    $('#marcas_descripcion').val(type.marcas);
                    titulo_producto();
                }
            });
    }
}

function titulo_material(){
 id_material=$('#material').val();
 if (id_material!='') {
    $.ajax({
        url : "<?php echo base_url();?>productos_c/material",
        data : {id : id_material},
        type : 'POST',
                //dataType : 'json',(arrays)
                success : function(data) {
                    var type =  jQuery.parseJSON(data); 
                    $('#material_descripcion').val(type.material);
                    titulo_producto();
                }
            });
}
}

function titulo_categoria(){
  id_categoria=$('#categoria').val();   
  if (id_categoria!='') {
    $.ajax({
        url : "<?php echo base_url();?>productos_c/categoria",
        data : {id : id_categoria},
        type : 'POST',
                //dataType : 'json',(arrays)
                success : function(data) {
                    var type =  jQuery.parseJSON(data);  
                    $('#categoria_descripcion').val(type.categoria);
                    titulo_producto();
                }
            });
}
}

$(document).ready(function (){
  $('.solo-precio').keyup(function (){
    this.value = (this.value + '').replace(/[^0-9.]/g, '');
});
}); 
</script>
</body>
</html>