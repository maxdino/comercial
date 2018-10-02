<?php if(isset($compra)){
	foreach($compra as $valor){ ?>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
						×
					</button>
					<h4 id="myLargeModalLabel" class="modal-title">Ver Compra</h4>
				</div>
				<div class="modal-body">
					<div class="container-12">
						<p>
							<label for="form-field-23">Compra</label>
							<div class="md-card">
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
																		Nombre Proveedor
																	</label>
																	<div class="input-group">
																		<?php  echo $valor->razon_social; ?>



																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="uk-form-row">
														<div class="uk-grid">
															<div class="uk-width-medium-1-2">
																<div class="form-group">
																	<label class="control-label">
																		Fecha Registro
																	</label>
																	<div class="input-group">
																		<?php  echo $valor->fecha; ?>



																	</div>
																</div>
															</div>
															<div class="uk-width-medium-1-2">
																<div class="form-group">
																	<label class="control-label">
																		Ruc
																	</label>
																	<div class="input-group">
																		<?php  echo $valor->ruc; ?>



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
																				Monto Total
																			</label>
																			<div class="input-group">
																				<?php  echo $valor->monto; ?>


																				
																			</div>
																		</div>
																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>
												<div class="uk-width-medium-1-2">
													<div class="md-card">
														<div class="md-card-content">

															<div class="uk-form-row">
																<div class="uk-grid">
																	<div class="uk-width-medium-1-1">
																		<div class="form-group">
																			<label class="control-label">
																				Empleado
																			</label>
																			<div class="input-group">
																				<?php  echo $valor->nombre.' '.$valor->paterno.' '.$valor->materno; ?>


																				
																			</div>
																		</div>
																	</div>
																</div>
															</div>				
															<div class="uk-form-row">
														<div class="uk-grid">
															<div class="uk-width-medium-1-2">
																<div class="form-group">
																	<label class="control-label">
																		Productos Comprados
																	</label>
																	<?php  foreach($compra_producto as $value){  
																		if ($valor->id_compras==$value->id_compras) {

																			?>
																			<div class="input-group">
																				<?php  echo $value->nombre; ?>
																			</div>
																			<?php }} ?>
																		</div>
																	</div>
																</div>
															</div>	



														</div>
													</div>
												</div></div></div></div>							
											</p>
										</div></div>
										<div class="modal-footer">
											<button data-dismiss="modal" class="btn btn-default" type="button">
												Cerrar
											</button>

										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<?php }} ?>