<?php $hoy=  date("d")."-".date("m")."-".date("Y");?>
<?php include('public/css.inc');?>
<body>
	<?php include('public/menu.inc');?>
	<?php include('public/js.inc');?>
	<div class="container-12">
		<div class="md-card">
			<div class="md-card-content">
			
				<h2>Compras</h2>
			</div>	
		</div>
	</div>
	<div>
		<div class="container">

			<div class="row">
				<div class="col-md-12">
				</div>
				<div class="col-md-12"></div>
				<div class="col-md-12"></div>
				<div class="col-md-12"></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-white">
						<div class="row">
							<div class="col-md-9"></div>
							<div class="col-md-2"></div>
						</div>
						<!-- Inicio Container -->
						<form role="form" id="form" method="post" action="<?php echo base_url()?>compras_c/registrar">
							<input type="hidden" name="guardar" id="guardar" value="1" />
							<div class="container-12">
								<div class="panel-body">
									<div class="md-card grande" id="grande" >
										<div class="md-card-content">
											<div class="uk-grid" data-uk-grid-margin >	
												<div class="uk-width-medium-1-2">
													<div class="md-card">
														<div class="md-card-content">

															<div class="uk-form-row">
																<div class="uk-grid">
																	<div class="uk-width-medium-1-1">
																		<div class="form-group">
																			<label class="control-label">
																				Seleccionar Productos<span class="symbol required"></span>
																			</label>
																			<div class="input-group">
																				<input type="text" placeholder="" value="" name="producto" id="producto" class="form-control" disabled>
																				<input type="hidden" placeholder="" name="id_producto" id="id_producto" class="form-control">

																				


																				<span class="input-group-btn">
																					<span class="input-group-btn">
																						<button type="button" class="btn btn-social-icon btn-reddit"  id="buscar" onclick="Buscar_producto()" >
																							<i class="fa fa-search"></i>
																						</button>
																						<button type="button" class="btn btn-social-icon btn-reddit" id="agregar_producto"  >
																							<i class="fa fa-plus-square"></i>
																						</button>
																						<button type="button" class="btn btn-social-icon btn-reddit" disabled="" id="grafico_producto"  >
																							<i class="fa fa-signal"></i>
																						</button>
																					</span>
																				</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="uk-form-row">
																<div class="uk-grid">
																	<div class="uk-width-medium-1-1">
																		<div class="form-group">
																			<label class="control-label">
																				Seleccionar Almacen<span class="symbol required"></span>
																			</label>
																			<div class="input-group">
																			  <select class="form-control" id="almacen" name="almacen" onclick="stock_almacen()">
                 															  <option value="">Seleccione...</option>

               																    <?php foreach ($almacen_disponible as $value ) { ?>
                       															<option value="<?php echo $value->id_almacen;?>"><?php echo $value->descripcion;?></option>

                   																    <?php } ?>
             																      </select>
             																      <input type="hidden" name="stock1" id="stock1"/>
																			</div>
																		</div>
																	</div>
																</div>
															</div>

															<div class="uk-form-row">
																<div class="uk-grid">
																	<div class="uk-width-medium-1-3">
																		<div class="form-group">
																			<label class="control-label">
																				Tipo de Uni. <span class="symbol required"></span>
																			</label>

																			<select class="form-control" id="tipo_uni" name="tipo_uni">

																				<option value="1">Unida.</option>
																				<option value="2">Docen.</option>
																			</select>
																		</div>	
																	</div>
																	<div class="uk-width-medium-1-3">
																		<div class="form-group">
																			<label class="control-label">
																				Cantidad <span class="symbol required"></span>
																			</label>
																			<input type="text" maxlength="3"  style="text-align:right;" name="cantidad" id="cantidad" class="col-md-3 form-control"onkeypress="return soloNumeros(event)" disabled>
																		</div>
																	</div>
																	<div class="uk-width-medium-1-3">
																		<div class="form-group">
																			<label class="control-label">
																				Precio <span class="symbol required"></span>
																			</label>
																			<input type="text" maxlength="10"  style="text-align:right;" name="preciopro" id="preciopro" class=" form-control " onkeypress="return NumCheck(event, this);" disabled>
																		</div>
																	</div>	

																</div>
															</div>
															
															<div class="uk-form-row">
																<div class="uk-grid">
																															
																	<div class="uk-width-medium-1-4">
																		<div class="form-group">

																			
																		</div>
																	</div>
																</div>
															</div>

															
															<div class="uk-form-row">
																<div class="uk-grid">
																															
																	<div class="uk-width-medium-1-4">
																		<div class="form-group">

																			<div class="col-md-3">
																				<button type="button" title="Agregar al Detalle" id="AgregarDetalleProducto" name="AgregarDetalleProducto" class="btn btn-primary" disabled>
																					<i class="fa fa-plus"></i>Agregar
																				</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>	

														</div>
													</div>

													<!-- fin del columna Container -->	</div> <!-- fin del columna Container -->	
													<div class="uk-width-medium-1-2">
														<div class="md-card">
															<div class="md-card-content">
																<div class="uk-form-row">
																	<div class="uk-grid">
																		<div class="uk-width-medium-1-1">
																			<div class="form-group">
																				<label class="control-label">
																					Encargado <span class="symbol required"></span>
																				</label>
																				<input  type="text" maxlength="15" value="<?php echo $_SESSION['personal']?>" placeholder="Insertar Apellido Materno" class="form-control" id="empleado" name="empleado" disabled>
																				<input type="hidden" maxlength="15" value="<?php echo $_SESSION["id_empleado"] ?>" placeholder="Insertar Apellido Materno" class="form-control" id="id_empleado" name="id_empleado" disabled>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="uk-form-row">
																	<div class="uk-grid">
																		<div class="uk-width-medium-1-1">
																			<div class="form-group">
																				<label class="control-label">
																					Nombre Proveedor <span class="symbol required"></span>
																				</label>
																				<div class="input-group">
																					<input type="text" placeholder="" value="" name="nombre" id="nombre" class="form-control" disabled>
																					<input type="hidden" placeholder="" name="id_proveedor" id="id_proveedor" class="form-control">
																					<span class="input-group-btn">
																						<button type="button" class="btn btn-social-icon btn-reddit"  disabled="disabled" id="buscar_proveedor" onclick="Buscar()" >
																							<i class="fa fa-search"></i>
																						</button>
																						<button type="button" class="btn btn-social-icon btn-reddit"  disabled="disabled" id="agregar_proveedor"   >
																							<i class="fa fa-male"></i>
																						</button>
																					</span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>	
																<div class="uk-form-row">
																	<div class="uk-grid">
																		<div class="uk-width-medium-1-3">
																			<div class="form-group">
																				<label class="control-label">
																					Fecha <span class="symbol required"></span>
																				</label>
																				<input type="text" value="<?php echo $hoy ?>" data-date-format="dd-mm-yyyy" name="fechaventa" id="fechaventa" data-date-viewmode="years" class="col-md-3 form-control date-picker" disabled>
																			</div>
																		</div>
																		<div class="uk-width-medium-1-3">
																			<div class="form-group">
																				<label class="control-label">
																					Ruc <span class="symbol required"></span>
																				</label>
																				<input type="text" name="ruc" id="ruc"    class="col-md-3 form-control   " readonly="readonly">
																			</div>
																		</div>
																	</div>	
																</div>	
																<div class="uk-form-row">
																	<div class="uk-grid">
																		<div class="uk-width-medium-1-3">
																			<div class="form-group">
																				<label class="control-label">
																					Tipo Pago <span class="symbol required"></span>
																				</label>
																				<div class="input-group">
																					<select class="form-control" id="modalidadtrans" name="modalidadtrans">
																						<?php foreach ($transaccion as $value ) { ?>
																							<option value="<?php echo $value->id_modalidad_transaccion;?>"><?php echo $value->descripcion; ?></option>
																							<?php } ?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<input type="hidden" name="estado_cronograma"  id="estado_cronograma" value="0" >
																			<div id="celda_cronograma" style="display: none;"></div>
																			<div class="uk-width-medium-1-3" id="cuotascre" style="float:left;display: none;">
																				<div class="form-group">
																					<label class="control-label">
																						Cuotas <span class="symbol required"></span>
																					</label>
																					<input type="number" maxlength="5" placeholder="" value="" class="form-control" id="cuotas" name="cuotas" >
																				</div>
																			</div>
																			<div class="uk-width-medium-1-3" id="intervacredi" style="float:left;display: none;">
																				<div class="form-group">
																					<label class="control-label">
																						Intervalo Dias <span class="symbol required"></span>
																					</label>
																					<div class="input-group">
																						<input type="number" maxlength="5" placeholder="" value="" class="form-control" id="intervalo" name="intervalo" >
																						<span class="input-group-btn">
																							<button type="button" class="btn btn-social-icon btn-reddit" title="Ver Cronograma" name="cronograma" id="VtnCuotas">
																								<i class="fa fa-list-alt"	></i>
																							</button>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>	
																	</div>	
																</div>	
															</div>
															<!-- fin del columna Container -->		</div><!-- fin del columna Container -->

															<div class="uk-width-medium-1-1"><br>
																<div class="md-card">
																	<div class="md-card-content">
																		<div class="uk-form-row">
																			<div class="uk-grid">	

																				<div class="uk-width-medium-2-3" >
																					<div class="md-card">
																						<div class="md-card-content">
																							<table class="table table-striped table-hover" id="tblDetalle">
																								<th>Fecha</th>
																								<th>Descripcion</th>
																								<th>Cantidad</th>
																								<th>Precio</th>
																								<th>Importe(S/.)</th>
																								<th>x</th>

																							</table>
																						</div>
																					</div>
																				</div>
																				<div class="uk-width-medium-1-3" >
																					<div class="md-card">
																						<div class="md-card-content">
																							<div class="uk-form-row">
																								<div class="uk-grid">	
																									<div class="uk-width-medium-1-5">
																										<label class="control-label">
																											Subtotal
																										</label>
																									</div>
																									<div class="uk-width-medium-3-5">
																										<input type="text" id="subtotal" name="subtotal" value="0.00" readonly="readonly" class="form-control" />
																									</div>
																								</div>
																							</div>
																							<div class="uk-form-row">
																								<div class="uk-grid"> 
																									<input type="hidden" name="igv_hidden" id="igv_hidden" value="0">
																									<div class="uk-width-medium-1-5">
																										<input type="checkbox" id="chbx_igv" name="chbx_igv"/>

																										<label class="control-label">
																											IGV
																										</label>
																									</div>
																									<div class="uk-width-medium-3-5">
																										<input type="text" id="igv" name="igv" value="0.00" readonly="readonly" class="form-control"/>
																									</div>
																								</div>
																							</div>

																							<div class="uk-form-row">
																								<div class="uk-grid"> 

																									<div class="uk-width-medium-1-5">
																										<label class="control-label">
																											Total
																										</label>
																									</div>
																									<div class="uk-width-medium-3-5">
																										<input type="text" id="total" name="total" value="0.00" readonly="readonly" class="form-control" />
																									</div>
																								</div>
																							</div>

																							<div class="uk-form-row">
																								<div class="uk-grid"> 
																								<center>
																									<p>
																										<button type="button" class="btn btn-primary" id="save">Guardar</button>
																										<a href="<?php echo base_url() ?>Compras_c" class="btn btn-danger">Cancelar</a>
																									</p>
																								</center>	
																								</div>
																							</div>


																						</div>

																					</div>

																				</div>
																			</div>	
																		</div>	
																	</div>	
																</div>			  	
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="table-responsive">
				<div id="proveedor" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-target="#proveedor">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-content">
								<div class="modal-header">
									<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
										×
									</button>
									<h3><center id="myLargeModalLabel" class="modal-title">Lista de Proveedores</center></h3>
								</div>
								<div class="modal-body">
									<table id="tablabuscar_proveedor" class="table table-striped table-hover" cellspacing="0">
										<thead>
											<tr>

												<th>Razon Social</th>
												<th>Ruc</th>
												<th>Telefono</th>
												<th>Email</th>
												<th>Dirección</th>
												<th>Accion</th>
											</tr>
										</thead>
										<tbody id="bodypro">

										</tbody>
									</table><br><br>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default" type="button">
											Cerrar
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="table-responsive">
				<div id="producto_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-target="#producto_modal" aria-hidden="false">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-content">
								<div class="modal-header">
									<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
										×
									</button>
									<h3><center id="myLargeModalLabel" class="modal-title">Lista de Productos</center></h3>
								</div>
								<div class="modal-body">
									<table id="tablabuscar_producto" class="table table-striped table-hover" cellspacing="0">
										<thead>
											<tr>

												<th>ID</th>
												<th>Nombre Producto</th>
												<th>Accion</th>
											</tr>
										</thead>
										<tbody id="bodyproducto">

										</tbody>
									</table><br><br>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default" type="button">
											Cerrar
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="table-responsive">
				<div id="modalCuotas" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-target="#modalCuotas" aria-hidden="false">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-content">
								<div class="modal-header">
									<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
										×
									</button>
									<h3><center id="myLargeModalLabel" class="modal-title">Cronograma de Pagos</center></h3>
								</div>
								<div class="modal-body">
									<form class="VtnCuotas">
										<div class="cronograma">
											<div class="page-header" >

											</div>
										</div>
									</form>
									<div class="modal-footer">
										<button id="guardar_cuotas" name="guardar_cuotas" class="btn btn-success" data-dismiss="modal" aria-hidden="true" style="display:none;" >Guardar</button>
										<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- Estadistica del producto -->





	<div class="table-responsive">
		<div id="estadistica_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-target="#estadistica_modal" aria-hidden="false">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
								×
							</button>
							<h3><center id="myLargeModalLabel" class="modal-title">Estadistica del Productos</center></h3>
						</div>
						<div class="modal-body" id="container_producto" style="min-width: 800px; height: 500px; margin: 0 auto">


							<br><br>
							<div class="modal-footer">
								<button data-dismiss="modal" class="btn btn-default" type="button">
									Cerrar
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>







	<!-- fin Estadistica del producto -->
	<!-- extends -->


	<div id="nuevo_proveedor" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-target="#proveedor">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-content">
					<div class="modal-header">
						<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
							×
						</button>
						<h3><center id="myLargeModalLabel" class="modal-title">Nuevo Proveedor</center></h3>
					</div>
					<div class="modal-body">
						<form action="" id="form_proveedor">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Razon Social</label>
										<input type="text" name="razon" required class="form-control">
									</div>
									<div class="form-group">
										<label for="">Ruc</label>
										<input type="text" name="ruc" required class="form-control">
									</div>
									<div class="form-group">
										<label for="">Teléfono</label>
										<input type="text" name="tel" required class="form-control">
									</div>
									<div class="form-group">
										<label for="">Email</label>
										<input type="text" name="email" required class="form-control">
									</div>

								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Dirección</label>
										<input type="text" name="direccion" required class="form-control">
									</div>
									<div class="form-group">
										<label for="">Departamento</label>
										<?php echo form_dropdown('', $departamentos, '','class="form-control" id="departamento" required'); ?>
									</div>
									<div class="form-group">
										<label for="">Provincia</label>
										<div class="provincias">
											<select name="" id="" class="form-control">
												<option value="">Seleccione</option>
											</select>
										</div>

									</div>
									<div class="form-group">
										<label for="">Distrito</label>
										<div class="distritos">
											<select name="" id="" class="form-control">
												<option value="">Seleccione</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</form>
						<div class="modal-footer">
							<button class="btn btn-primary guardar_proveedor" type="button">
								Guardar
							</button>
							<button data-dismiss="modal" class="btn btn-default" type="button">
								Cerrar
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>




	<div id="nuevo_producto" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-target="#proveedor">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-content">
					<div class="modal-header">
						<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
							×
						</button>
						<h3><center id="myLargeModalLabel" class="modal-title">Nuevo Producto</center></h3>
					</div>
					<div class="modal-body">
						<form action="" id="form_producto">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Nombre</label>

										<input type="text" name="descripcion" required class="form-control">
									</div>
									<div class="form-group">
										<label for="">Precio</label>
										<div class="input-group">
											<span class="input-group-addon">S/.</span>
											<input type="text" name="precio" required onkeypress="return NumCheck(event, this);" class="form-control">
										</div>

									</div>

								</div>
								<div class="col-md-6">

									<div class="form-group">
										<label for="">Marca</label>
										<?php echo form_dropdown('marca', $marcas, '','class="form-control" required'); ?>
									</div>


									<div class="form-group">
										<label for="">Categoria Producto</label>
										<?php echo form_dropdown('categoria', $categorias, '','class="form-control" required'); ?>
									</div>

								</div>
								
								<div class="col-md-6">
									<label class="control-label">
										Stock Minimo <span class="symbol required"></span>
									</label>
									<input type="text" maxlength="4" value="" placeholder="Insertar el Stock Minimo" class="form-control" id="min" name="min" onkeypress="return soloNumeros(event)"  >
								</div>
								<div class="col-md-6">
									<label class="control-label">
										Stock Maximo <span class="symbol required"></span>
									</label>
									<input  type="text" maxlength="4"  placeholder="Insertar el Stock Maximo " class="form-control" id="max" name="max" onkeypress="return soloNumeros(event)"  >
								</div>
						
							</form>
							<div class="col-md-12"> </div><div class="col-md-6"> </div>
							<div class="modal-footer col-md-6">
								<button class="btn btn-primary guardar_producto" type="button">
									Guardar
								</button>
								<button data-dismiss="modal" class="btn btn-default" type="button">
									Cerrar
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>





	</body>
	<?php include('js.php');?>
	<?php include('public/pie.inc');?>
	</html>