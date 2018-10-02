<script>

	function soloNumeros(e){
		var key = window.Event ? e.which : e.keyCode
		return (key >= 48 && key <= 57)
	}

	function NumCheck(e, field) {
		key = e.keyCode ? e.keyCode : e.which
		if (key == 8) return true
			if (key > 47 && key < 58) {
				if (field.value == "") return true
					regexp = /.[0-9]{5}$/
				return !(regexp.test(field.value))
			}
			if (key == 46) {
				if (field.value == "") return false
					regexp = /^[0-9]+$/
				return regexp.test(field.value)
			}
			return false
		}


		$("#comprobante").focus();
		$("#comprobante").change(function(){
			$.post('ventas_c/correlativo','id_tipo_documento='+$("#comprobante").val(),function(datos){
				$("#nro_documento").val(datos);
			});	});

		$("#guardar_cuotas").click(function() {
			$("#estado_cronograma").val('1');
		});


		$("#modalidadtrans").change(function(){

			if($(this).val()==2){
				$("#cuotascre").show();
				$("#intervacredi").show();
				$("#adelantocre").show();

			}else{
				$("#cuotascre").hide();
				$("#intervacredi").hide();
				$("#adelantocre").hide();
			//limpiar_tipo_pago();
		}
	});
		$("#chbx_igv").click(function(){
			if($("#chbx_igv").is(':checked')){
				$subtotal = $("#subtotal").val();
				$.post("<?php echo site_url('compras_c/parm');?>",'id_param=IGV',function(datos){

					$valor_igv =parseFloat($subtotal)*parseFloat(datos);
					$valor_igv = $valor_igv.toFixed(2);
					$("#igv_hidden").val(datos);
					$("#igv").val($valor_igv);
					setTotal(0, 1,datos);
				},'json');
			}else{
				$("#igv").val('0.00');
				setTotal(0, 1,0);
			}


		});
		$("input:text[readonly=readonly]").css('cursor','pointer');


		$("#adelanto").change(function(){
			adelanto = $("#adelanto").val();
			adelanto = parseFloat(adelanto).toFixed(2);
			if(parseFloat($("#adelanto").val()) > parseFloat($("#total").val())){
				$("#adelanto").val($("#total").val());
			}else{
				parseFloat($("#adelanto").val(adelanto));
			}
		});

		$("#save").click(function(){
			bval = true;


			if(bval && $("#modalidadtrans").val()=='2'){
				bval = true;
			}
			if (bval) {
				if( $(".row_tmp").length ) {

					if($("#modalidadtrans").val()=='2'){
						if ($("#estado_cronograma").val()=='0') {
							crearCuotas();
						}
						if ($("#restante_cuota").val()!='0' && $("#restante_cuota").val()!='0.00') {
							CrearCronograma();
						}
					}

					bootbox.confirm("¿Está seguro que desea guardar la compra? ", function(result) {
						if (result) {

							$("#celda_cronograma").html($("div.cronograma").html());
							$("#form").submit();
						}
					});

				}else{
					bootbox.alert("Agregue los servicios al detalle");
				}
			}
			return false;
		});


		$("#cantidad").click(function() {
			if(parseInt($("#cantidad").val()) > parseInt($("#stockactual").val()) ){
				$("#cantidad").val($("#stockactual").val());
				return false;
			}
			else if($("#cantidad").val() < 1){
				$("#cantidad").val('');
				return false;
			}else{
				setImporte();
			}

		});
		$("#VtnCuotas").click(function() {
			CrearCronograma();
		});
		$("#AbrirVtnBuscarProducto").click(function() {
			Productos();
		});

		function ver(id){
			$.post("<?php echo base_url();?>Compras_c/ver",{"id_compras":id},
				function(data){
					var $modal = $('#compras_ver_modal');
					$('#compras_ver_modal').empty();
					$('#compras_ver_modal').append(data);
					$modal.modal();
				});
		}

	

		function Buscar(){
			$.post("<?php echo site_url('proveedor_c/proveedor_lista');?>" , function(data){
				var tabla1= $("#tablabuscar_proveedor").DataTable();
				tabla1.destroy();
				$('#bodypro').empty();
				$('#bodypro').append(data);
				$('#proveedor').modal('show');
				$('#tablabuscar_proveedor').DataTable({
					'sPaginationType': 'full_numbers',
					'oLanguage':{
						'sProcessing':     'Cargando...',
						'sLengthMenu':     'Mostrar _MENU_ registros',
						'sZeroRecords':    'No se encontraron resultados',
						'sEmptyTable':     'Ningún dato disponible en esta tabla',
						'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
						'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
						'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
						'sInfoPostFix':    '',
						'sSearch':         'Buscar:',
						'sUrl':            '',
						'sInfoThousands':  '',
						'sLoadingRecords': 'Cargando...',
						'oPaginate': {
							'sFirst':    'Primero',
							'sLast':     'Último',
							'sNext':     'Siguiente',
							'sPrevious': 'Anterior'
						},
						'oAria': {
							'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
							'sSortDescending': ': Activar para ordenar la columna de manera descendente'
						}
					},
                    'aaSorting': [[ 0, 'asc' ]],//ordenar
                    'iDisplayLength': 10,
                    'aLengthMenu': [[5, 10, 20, -1], [5, 10, 20, 'All']]


                });
			});
		};


		function Buscar_producto(){
			$.post("<?php echo site_url('Producto_c/producto_lista');?>" , function(data){
				var tabla1= $("#tablabuscar_producto").DataTable();
				tabla1.destroy();
				$('#bodyproducto').empty();
				$('#bodyproducto').append(data);
				$('#producto_modal').modal('show');
				$('#tablabuscar_producto').DataTable({
					'sPaginationType': 'full_numbers',
					'oLanguage':{
						'sProcessing':     'Cargando...',
						'sLengthMenu':     'Mostrar _MENU_ registros',
						'sZeroRecords':    'No se encontraron resultados',
						'sEmptyTable':     'Ningún dato disponible en esta tabla',
						'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
						'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
						'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
						'sInfoPostFix':    '',
						'sSearch':         'Buscar:',
						'sUrl':            '',
						'sInfoThousands':  '',
						'sLoadingRecords': 'Cargando...',
						'oPaginate': {
							'sFirst':    'Primero',
							'sLast':     'Último',
							'sNext':     'Siguiente',
							'sPrevious': 'Anterior'
						},
						'oAria': {
							'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
							'sSortDescending': ': Activar para ordenar la columna de manera descendente'
						}
					},
                    'aaSorting': [[ 0, 'asc' ]],//ordenar
                    'iDisplayLength': 10,
                    'aLengthMenu': [[5, 10, 20, -1], [5, 10, 20, 'All']]


                });
			});
			$("#buscar_proveedor").removeAttr("disabled","disabled");
			$("#buscar_proveedor").attr("enabled","enabled");
			$("#agregar_proveedor").removeAttr("disabled","disabled");
			$("#agregar_proveedor").attr("enabled","enabled");
			$("#grafico_producto").removeAttr("disabled","disabled");
			$("#grafico_producto").attr("enabled","enabled");
		};





		function crearCuotas(){
			var HTML = '<table id="table_cronograma" class="table table-bordered"  width="100%">' +
			'<thead>' +
			'<tr>' +
			'<th>Nro</th>' +
			'<th>Fecha Vencimiento</th>' +
			'<th>Monto</th>'
			'</tr>' +
			'</thead>' +
			'<tbody>';

			var letras = $("#cuotas").val();
			var c=parseInt(letras);

			if($("#estado_cronograma").val()==0){

				/*		var monto = parseInt($("#total").val()) - parseInt($("#adelanto").val());*/
				var monto = parseFloat($("#total").val());
				var intervalo_dias = parseInt($("#intervalo").val());
				var valor = parseFloat(monto/c).toFixed(2)

				var nueva_fecha = new Date();
				month = nueva_fecha.getMonth()+1;
				day = nueva_fecha.getDate();
				year = nueva_fecha.getFullYear();

				month = (month < 10) ? ("0" + month) : month;
				day = (day < 10) ? ("0" + day) : day;
				var fecha_actual=  year + '-' + month + '-' +day  ;

				var fecha_temp = new Date();
		/*	var monto_pagado = 0;
			var cuota = [];
			var pago_mensual = parseInt(monto / c);
			for(var i=1;i<=c;i++){
				cuota[i]=pago_mensual;
				monto_pagado = monto_pagado + pago_mensual;
			}
			if(monto_pagado !== monto){
				cuota[c]=(cuota[c] + monto).toFixed(2);
			}*/
			fecha_temp.setDate (fecha_temp.getDate() + parseInt(intervalo_dias));
			var month ;
			var day ;
			var year;

			for (var i = 1; i<=c; i++) {

				month = fecha_temp.getMonth()+1;
				day = fecha_temp.getDate();
				year = fecha_temp.getFullYear();

				month = (month < 10) ? ("0" + month) : month;
				day = (day < 10) ? ("0" + day) : day;



				HTML = HTML + '<tr>';
				HTML = HTML + '<td>' + i + '</td>';
				HTML = HTML + '<td>';
				HTML = HTML + '   <input type="date" name="fecha_cuota[]" id="fecha_cuota'+i+'" readonly class="fecha_cuota" value="'+year + '-' + month + '-' +day+'"  min="'+fecha_actual+'"  max="3500-12-31" />';
				HTML = HTML + '</td>';
				HTML = HTML + '<td>';
				HTML = HTML + '   <input type="text" value="'+valor+'" maxlength="10" readonly  name="monto_cuota[]" id="monto_cuota'+i+'" class="monto_cuotas" onkeypress="return dosDecimales(event,this)" onblur="montoCuota('+i+')" />';
				HTML = HTML + '</td>';
				HTML = HTML + '</tr>';

				fecha_temp.setDate (fecha_temp.getDate() + parseInt(intervalo_dias));

			}
			HTML = HTML + '</tbody></table>';
			/*HTML = HTML+'<div class="form-group col-md-6 style="float:left;" >'+
			'<label class="control-label col-md-4">Restante:</label>'+
			'<div class="col-md-7">'+
			'<input id="restante_cuota" name="restante_cuota" readonly class="form-control" value="'+parseFloat(monto).toFixed(2)+'" >'+
			'</div>'+
			'</div>' ;*/
			HTML = HTML+'<div class="form-group col-md-6 " style="float:left;" >'+
			'<label class="control-label col-md-3">Total:</label>'+
			'<div class="col-md-8">'+
			'<input id="total_en_cuotas" name="total_en_cuotas" readonly class="form-control" value="'+$("#total").val()+'" >'+
			'</div>'+
			'</div>'+
			'<br><br>'
			;

			$('div.cronograma').html(HTML);

			$("#guardar_cuotas").show();
			$('#table_cronograma').DataTable({
				'sPaginationType': 'full_numbers',
				'oLanguage':{
					'sProcessing':     'Cargando...',
					'sLengthMenu':     'Mostrar _MENU_ registros',
					'sZeroRecords':    'No se encontraron resultados',
					'sEmptyTable':     'Ningún dato disponible en esta tabla',
					'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
					'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
					'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
					'sInfoPostFix':    '',
					'sSearch':         'Buscar:',
					'sUrl':            '',
					'sInfoThousands':  '',
					'sLoadingRecords': 'Cargando...',
					'oPaginate': {
						'sFirst':    'Primero',
						'sLast':     'Último',
						'sNext':     'Siguiente',
						'sPrevious': 'Anterior'
					},
					'oAria': {
						'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
						'sSortDescending': ': Activar para ordenar la columna de manera descendente'
					}
				},
                    'aaSorting': [[ 0, 'asc' ]],//ordenar
                    'iDisplayLength': 10,
                    'aLengthMenu': [[5, 10, 20, -1], [5, 10, 20, 'All']]


                });
		}
	}

	function montoCuota(num) {
		var restante,
		suma_monto_cuotas=0,
		total=($("#cantidad").val())*($("#preciopro").val());

		if (parseInt($("#monto_cuota"+num).val())==0 || $("#monto_cuota"+num).val()=='') {
			$("#monto_cuota"+num).val('0.00');
		}else{
			var valor=(parseFloat($("#monto_cuota"+num).val()).toFixed(2));
			$("#monto_cuota"+num).val(valor);
		}

		for(var i=1;i<=$("#cuotas").val();i++){
			suma_monto_cuotas=(parseFloat(suma_monto_cuotas)+parseFloat($("#monto_cuota"+i).val())).toFixed(2);
		}
		restante=(parseFloat(total)-parseFloat(suma_monto_cuotas)).toFixed(2);

		if(restante<0){
			var exceso= (parseFloat($("#monto_cuota"+num).val())+parseFloat(restante)).toFixed(2);
			$("#monto_cuota"+num).val(exceso)
			$("#restante_cuota").val('0.00');
			$("#guardar_cuotas").show();
		}else{
			$("#restante_cuota").val(restante);
			if(restante==0){
				$("#guardar_cuotas").show();
			}else{
				$("#guardar_cuotas").hide();
			}

		}

	}

	

	function Productos(){
		if($("#idalmacen").val() == ''){
			alert("INgrese el almacen");
			return false;
		}else{
			idalmacen = $("#idalmacen").val();
			$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i>Consultando los Productos',
				responseTime : 1000,
			});
			$.ajax({
				url : "<?php echo site_url('ventas_c/productos'); ?>",
				data : {idalmacen : idalmacen},
				type : 'POST',
				dataType : 'json',
				success : function(json,datos) {
					var HTML = '<table class="table table-striped table-hover" id="table3">' +
					'<thead>' +
					'<tr>' +
					'<th>Item</th>'+
					'<th>Producto</th>'+
					'<th>Presentacion</th>'+
					'<th>Categoria</th>'+
					'<th>Marca</th>'+
					'<th>Stock</th>'+
					'<th>Precio</th>'+
					'<th>Acciones</th>'+
					'</tr>' +
					'</thead>' +
					'<tbody>';

					for (var i = 0; i < json.length; i++) {
						HTML = HTML + '<tr>';
						HTML = HTML + '<td>'+(i+1)+'</td>';
						HTML = HTML + '<td>'+json[i].nombre+'</td>';
						HTML = HTML + '<td>'+json[i].presentacion+'</td>';
						HTML = HTML + '<td>'+json[i].categoria+'</td>';
						HTML = HTML + '<td>'+json[i].marca+'</td>';
						HTML = HTML + '<td>'+json[i].stock+'</td>';
						HTML = HTML + '<td>'+json[i].precio+'</td>';
						var id_producto = json[i].id_producto;
						var id_almacen =$("#idalmacen").val();
						var nombre = json[i].nombre;
						var almacen = $( "#idalmacen option:selected" ).text();
						var stock = json[i].stock;
						var precioc = json[i].precio;
						HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_producto(\'' + id_producto + '\',\'' + id_almacen + '\',\'' + almacen + '\',\'' + nombre + '\',\'' + stock + '\',\'' + precioc + '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
						HTML = HTML + '</td>';
						HTML = HTML + '</tr>';
					}
					HTML = HTML + '</tbody></table>'	;
					$('div.productosmodal').html(HTML);
					tablabuscar1();
					$("#modalProductos").modal('show');

					$.unblockUI({});
				},
				error : function(xhr, status) {
					$.unblockUI({});
					swal({
						title: "Disculpe ocurrio un problema!",
                // text: "Here's a custom image.",
                imageUrl: "<?php echo base_url().'public/images/dislike.png';?>"
            });
				},
			});

		}

	}

	function CrearCronograma(){
		if($("#modalidadtrans").val()=='2' && $("#nombre").val() != '' && $("#subtotal")!=''){
			bval = true;
			bval = bval && $("#cuotas").attr("required","true");
			bval = bval && $("#intervalo").attr("required","true");
			if ($("#cuotas").val() != '' && $("#intervalo").val() != '') {
				if($("#cuotas").val()<=0 || $("#intervalo").val()<=0){
					bootbox.alert("Por favor ingrese datos correcto, en los campos de credito!", function() {
					});
					return false;
				}
				var total=$("#total").val();
				if(parseInt($("#cuotas").val())>= parseInt(total)){
					bootbox.alert("Numero de cuotas invalido, por ser Mayor al total ");
					$("#cuotas").focus();
					return false;
				}
				crearCuotas();
				$("#modalCuotas").modal('show');
				$("#VtnCuotas").show();
				return true
			}
			return false;
		}else{
			bootbox.alert("Seleccione cliente y el producto!", function() {
			});
		}
	}

	function tablabuscar(){
		$(document).ready(function() {
			$('#table2').dataTable({
				'sPaginationType': 'full_numbers',
				'oLanguage':{
					'sProcessing':     'Cargando...',
					'sLengthMenu':     'Mostrar _MENU_ registros',
					'sZeroRecords':    'No se encontraron resultados',
					'sEmptyTable':     'Ningún dato disponible en esta tabla',
					'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
					'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
					'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
					'sInfoPostFix':    '',
					'sSearch':         'Buscar:',
					'sUrl':            '',
					'sInfoThousands':  '',
					'sLoadingRecords': 'Cargando...',
					'oPaginate': {
						'sFirst':    'Primero',
						'sLast':     'Último',
						'sNext':     'Siguiente',
						'sPrevious': 'Anterior'
					},
					'oAria': {
						'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
						'sSortDescending': ': Activar para ordenar la columna de manera descendente'
					}
				},
                    'aaSorting': [[ 0, 'asc' ]],//ordenar
                    'iDisplayLength': 10,
                    'aLengthMenu': [[5, 10, 20, -1], [5, 10, 20, 'All']]


                });

		});

	}

	function tablabuscar1(){
		$(document).ready(function() {
			$('#table3').dataTable({
				'sPaginationType': 'full_numbers',
				'oLanguage':{
					'sProcessing':     'Cargando...',
					'sLengthMenu':     'Mostrar _MENU_ registros',
					'sZeroRecords':    'No se encontraron resultados',
					'sEmptyTable':     'Ningún dato disponible en esta tabla',
					'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
					'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
					'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
					'sInfoPostFix':    '',
					'sSearch':         'Buscar:',
					'sUrl':            '',
					'sInfoThousands':  '',
					'sLoadingRecords': 'Cargando...',
					'oPaginate': {
						'sFirst':    'Primero',
						'sLast':     'Último',
						'sNext':     'Siguiente',
						'sPrevious': 'Anterior'
					},
					'oAria': {
						'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
						'sSortDescending': ': Activar para ordenar la columna de manera descendente'
					}
				},
                    'aaSorting': [[ 0, 'asc' ]],//ordenar
                    'iDisplayLength': 10,
                    'aLengthMenu': [[5, 10, 20, -1], [5, 10, 20, 'All']]


                });

		});

	}
	
	function sel_producto(id_p,id_a,a, p, s, pc) {
		$("#cantidad,#preciopro").attr('disabled', false);
		$("#id_almacense").val(id_a);
		$("#almacense").val(a);
		$("#idproducto").val(id_p);
		$("#nombreproducto").val(p);
		$("#stockactual").val(s);
		$("#preciopro").val(parseFloat(pc).toFixed(2));
		$('#modalProductos').modal('hide');
		$("#cantidad").val('1').focus();
		var HTMLL;
		for(var i=1; i<=parseInt($("#stockactual").val());i++){
			HTMLL = HTMLL + '<option value="'+i+'">'+i+'</option>';
		}
		$('#cantidad').empty();
		$('#cantidad').append(HTMLL);
		setImporte();

	}

	function setImporte(){
		var cantidad = $("#cantidad").val();
		cantidad = parseInt(cantidad);
		if (cantidad == '') {
			cantidad = 0;
		}
		var precio = $("#preciopro").val();
		precio = parseFloat(precio);
		if (precio == '') {
			precio = 0;
		}
		var importe;
		importe = cantidad * precio;
		$("#importe").val(parseFloat(importe).toFixed(2));

	}

	function Proveedor(id,nombre,ruc){
		$('#nombre').val(nombre).focus();
		$('#id_proveedor').val(id);
		$('#ruc').val(ruc);
		$('#proveedor').modal('hide');
	}

	function Producto(id,producto){
		$('#producto').val(producto).focus();
		$('#id_producto').val(id);
		
		$("#cantidad,#preciopro,#importe,#AgregarDetalleProducto").attr('disabled',false);
		$('#producto_modal').modal('hide');
	}



	function limpiar_producto(){
		$("#id_producto,#producto,#id_almacen,#stockactual,#nombreproducto,#cantidad").val('');
		$("#importe").val('0.00');
		$("#preciopro").val('');
		$("#cantidad,#preciopro,#importe").attr('disabled',true);
	}


	function setTotal(importe,aumenta,igv){
		var subtotal = $("#subtotal").val();
		subtotal = parseFloat(subtotal);
		if (subtotal <=0) {
			subtotal = 0;
		}


		igv = parseFloat(igv);
		if (igv<=0) {
			igv = 0;
		}

		if(aumenta){
			subtotal = subtotal + parseFloat(importe);
		}else{
			subtotal = subtotal - parseFloat(importe);
		}
		$("#subtotal").val(subtotal.toFixed(2));
		var total = subtotal + subtotal * igv;
		$("#total").val(total.toFixed(2));
	}

	function subTotal(importe,aumenta){
		var subtotal = parseInt($("#subtotal").val());
		if (subtotal <= 0) {
			subtotal = 0;
		}
		var igv = $("#igv").val();

		if (parseInt(igv.toFixed(2)) <=0) {
			igv = 0;
		}



		if(aumenta==1){
			subtotal = subtotal + parseFloat(importe);
		}else{
			subtotal = subtotal - parseFloat(importe);
		}
		$("#subtotal").val(parseFloat(subtotal).toFixed(2));
		var total = subtotal + subtotal * igv;
		$("#total").val(parseFloat(total).toFixed(2));
	}


		//agregar stock 
function stock_almacen(){
		$("#stock1").val('0');
		$idalmacen = $("#almacen").val();
			$idproducto = $("#id_producto").val();
			$.post("<?php echo site_url('compras_c/traer_stock'); ?>",{idproducto:$idproducto,idalmacen:$idalmacen},function(json){
				$object = jQuery.parseJSON(json);
				$("#stock1").val($object.stok);
				
			})

}



	$("#AgregarDetalleProducto").click(function(){
		



		if ($("#producto").val() != '' && $("#cantidad").val() != ''  && $("#preciopro").val() != ''  && $("#preciopro").val() != '0.00' && $("#nombre").val() != '' && $("#almacen").val() != '' ) {

			var num = $(".id_producto").length;
			if(($(".id_prod[value=" + $("#id_producto").val() + "]").length) >0){
				alert("YA SE REGISTRO");
				return false;
			}
			var tr = 'tr';
			var html = '<tr class="row_tmp">';
			html += '   <input type="hidden" name="tipo_uni[]" value="' + $("#tipo_uni").val() + '" /><input type="hidden" name="stock[]" value="' + $("#stock1").val() + '" /><input type="hidden" name="almacen[]" value="' + $("#almacen").val() + '" />';
			
			html += '<td>';
			html += '  <input type="hidden" name="fechaventa[]" value="' + $("#fechaventa").val() + '" />' + $("#fechaventa").val();
			html += '</td>';
			html += '<td>';
			html += '   <input type="hidden" name="id_vendido[]" class="id_prod" value="' + $("#id_producto").val() + '" />' + $("#producto").val();
			html += '</td>';
			html += '<td>';
			html += '   <input type="hidden" name="numero[]" value="' + $("#cantidad").val() + '" />' + $("#cantidad").val();
			html += '</td>';
			html += '<td>';
			html += '   <input type="hidden" name="precio[]" value="' + $("#preciopro").val() + '" />' + $("#preciopro").val();
			html += '</td>';
			html += '<td>';
			html += '   <input type="hidden" name="importe[]" class="importe" value="' + $("#importe").val() + '" />' + (($("#cantidad").val())*($("#preciopro").val())).toFixed(2);
			html += '</td>';
			html += '<td>';
			html += '   <a class="btn btn-danger delete" onclick="$(this).closest('+"'tr'"+').remove();setTotal('+($("#cantidad").val())*($("#preciopro").val())+','+0+')"><i class="icon-trash icon-white"></i></a>';
			html += '</td>';
			html += '</tr>';
			setTotal(($("#cantidad").val())*($("#preciopro").val()), 1,0);

			$("#tblDetalle").append(html);
			limpiar_producto();
			$("#stock1").val('0');
		}else{
			alert("los datos están vacios llenelos");
		}
	});

	/*extends*/

	$(document).on("click","#agregar_proveedor",function(e){
		e.preventDefault();
		$("#nuevo_proveedor").modal("show");
	})

	$(document).on("change","#departamento",function(e){
		e.preventDefault();
		var departamento = $(this).val();
		if(departamento != "") {
			$.post("<?php echo base_url().'compras_c/traer_provincias' ?>",{departamento:departamento},function(data){

				$(".provincias").empty();
				$(".provincias").html(data);
			})
		}

	})

	$(document).on("change","#provincia",function(e){
		e.preventDefault();
		var provincia = $(this).val();
		if(provincia != "") {
			$.post("<?php echo base_url().'compras_c/traer_distritos' ?>",{provincia:provincia},function(data){
				$(".distritos").empty();
				$(".distritos").html(data);
			})
		}

	})

	$(document).on("click",".guardar_proveedor",function(){
		$.ajax({
			url: '<?php echo base_url()."proveedor_c/registrar_proveedor2"; ?>',
			type: 'post',
			data: $("#form_proveedor").serialize(),
			success: function (data) {

				$json = JSON.parse(data);
				if($json.error == 1) {
					alert("Error al insertar proveedor");
				}

				if($json.error == 0) {
					$("input[name=nombre]").val($json.razon_social);
					$("input[name=id_proveedor]").val($json.id_proveedor);
					$("input[name=ruc]").val($json.ruc);
					$("#nuevo_proveedor").modal("hide");
				}
			}
		});
	})

	$(document).on("click","#agregar_producto",function(e){
		e.preventDefault();
		$("#nuevo_producto").modal("show");
	})

	$(document).on("click",".guardar_producto",function(){
		$.ajax({
			url: '<?php echo base_url()."producto_c/registrar_productos2"; ?>',
			type: 'post',
			data: $("#form_producto").serialize(),
			success: function (data) {

				$json = JSON.parse(data);
				if($json.error == 1) {
					alert("Error al insertar producto");
				}

				if($json.error == 0) {
					$("#buscar_proveedor").removeAttr("disabled","disabled");
					$("#buscar_proveedor").attr("enabled","enabled");
					$("#agregar_proveedor").removeAttr("disabled","disabled");
					$("#agregar_proveedor").attr("enabled","enabled");
					$("#grafico_producto").removeAttr("disabled","disabled");
					$("#grafico_producto").attr("enabled","enabled");
					$('#stock1').val($json.stock);
					$("input[name=producto]").val($json.nombre);
					$("input[name=id_producto]").val($json.id_producto);
					$("#cantidad").removeAttr("disabled","disabled");
					$("#cantidad").attr("enabled","enabled");
					$("#preciopro").removeAttr("disabled","disabled");
					$("#preciopro").attr("enabled","enabled");

					$("#AgregarDetalleProducto").removeAttr("disabled","disabled");
					$("#AgregarDetalleProducto").attr("enabled","enabled");
					$("#nuevo_producto").modal("hide");
				}
			}
		});
	});

	$(document).on("click","#grafico_producto",function(e){
		e.preventDefault();
		$idproducto = $("input[name=id_producto]").val();
		$producto = $("input[name=producto]").val();
		if($idproducto != "") {
			$.post('<?php echo site_url("compras_c/traer_proveedores"); ?>',{idproducto:$idproducto},function(data){
				$json = jQuery.parseJSON(data);
				if($json.ok == 0){
					alert("El producto no tiene Proveedores");
				}else{
				
				var array = [];
				var arr = [];

				for(var x in $json){

					for(var i in $json[x]) {
						if(i=="precio_unitario") {
							arr.push(parseFloat($json[x][i]));
						}else{
							arr.push($json[x][i]);
						}


					}
					array.push(arr);
					arr = [];
				}

				$('#container_producto').highcharts({
					chart: {
						type: 'column'
						},
						title: {
							text: 'Listado de Proveedores y precios para el producto ==>> '+$producto
						},
						subtitle: {
							text: ''
						},
						xAxis: {
							type: 'category',
							labels: {
								rotation: -45,
								style: {
									fontSize: '13px',
									fontFamily: 'Verdana, sans-serif'
								}
							}
						},
						yAxis: {
							min: 0,
							title: {
								text: 'Precios (Soles)'
							}
						},
						legend: {
							enabled: false
						},
						tooltip: {
							pointFormat: '<b>{point.y:.1f} Soles</b>'
						},
						series: [{
							name: 'Population',
							data: array,
							dataLabels: {
								enabled: true,
								rotation: -90,
								color: '#FFFFFF',
								align: 'right',
	                format: '{point.y:.1f}', // one decimal
	                y: 10, // 10 pixels down from the top
	                style: {
	                	fontSize: '13px',
	                	fontFamily: 'Verdana, sans-serif'
	                }
	            }
	        }]
	    }); 
				$("#estadistica_modal").modal("show");
			}
				
			});
		}
	});

</script>