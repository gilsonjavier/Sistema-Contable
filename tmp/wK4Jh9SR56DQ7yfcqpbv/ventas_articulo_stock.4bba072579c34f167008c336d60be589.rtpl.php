<?php if(!class_exists('raintpl')){exit;}?><div role="tabpanel" class="tab-pane" id="stock">
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left">Almacén</th>
               <th class="text-left">Ubicación</th>
               <th class="text-right" width="120">Cantidad actual</th>
               <th class="text-right" width="120">Nueva cantidad</th>
               <th class="text-left">Motivo</th>
               <th class="text-right">Acción</th>
            </tr>
         </thead>
         <?php $loop_var1=$fsc->stocks; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <tr>
            <form action="<?php echo $fsc->url();?>#stock" method="post" class="form">
               <input type="hidden" name="idstock" value="<?php echo $value1->idstock;?>"/>
               <input type="hidden" name="almacen" value="<?php echo $value1->codalmacen;?>"/>
               <input type="hidden" name="referencia" value="<?php echo $fsc->articulo->referencia;?>"/>
               <input type="hidden" name="cantidadini" value="<?php echo $value1->cantidad;?>"/>
               <td><div class="form-control"><?php echo $value1->nombre();?></div></td>
               <td>
                  <input type="text" class="form-control" name="ubicacion" value="<?php echo $value1->ubicacion;?>" onkeypress="teclear(event)" placeholder="dentro del almacén..." autocomplete="off"/>
               </td>
               <td><div class="form-control text-right" readonly><?php echo $value1->cantidad;?></div></td>
               <td><input type="number" step="any" class="form-control text-right" name="cantidad" min="0" onkeypress="teclear(event);return numeros(event)" value="<?php echo $value1->cantidad;?>" autocomplete="off"/></td>
               <td><input type="text" class="form-control" name="motivo" onkeypress="teclear(event);return texto(event)" placeholder="Escribe el motivo del cambio"/></td>
               <td class="text-right">
                  <button class="btn btn-sm btn-primary" type="submit" title="Guardar" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                  </button>
               </td>
            </form>
         </tr>
         <?php } ?>

         <?php if( $fsc->nuevos_almacenes ){ ?>

         <tr class="info">
            <form action="<?php echo $fsc->url();?>#stock" method="post" class="form">
               <input type="hidden" name="referencia" value="<?php echo $fsc->articulo->referencia;?>"/>
               <input type="hidden" name="cantidadini" value="0"/>
               <td>
                  <select class="form-control" name="almacen">
                     <?php $loop_var1=$fsc->nuevos_almacenes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                     <?php } ?>

                  </select>
               </td>
               <td>
                  <input type="text" class="form-control" name="ubicacion" placeholder="dentro del almacén..." autocomplete="off"/>
               </td>
               <td><div class="form-control text-right">0</div></td>
               <td><input class="form-control text-right" type="number" step="any" name="cantidad" value="0" autocomplete="off"/></td>
               <td><input type="text" class="form-control" name="motivo" placeholder="Escribe el motivo del cambio"/></td>
               <td class="text-right">
                  <button class="btn btn-sm btn-primary" type="submit" title="Guardar" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                  </button>
               </td>
            </form>
         </tr>
         <?php } ?>

         <tr>
            <td colspan="2"></td>
            <td colspan="2">
               <a href="#" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal_recal_stock">
                  <span class="glyphicon glyphicon-wrench"></span>&nbsp; Recalcular stock
               </a>
            </td>
            <td colspan="2"></td>
         </tr>
      </table>
   </div>
   
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <ul class="nav nav-pills" role="tablist">
               <?php $loop_var1=$fsc->stocks; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $counter1==0 ){ ?>

                  <li role="presentation" class="active" title="Movimientos del almacén">
                     <a href="#<?php echo $value1->codalmacen;?>" aria-controls="<?php echo $value1->codalmacen;?>" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-transfer"></span> <?php echo $value1->nombre;?>

                     </a>
                  </li>
                  <?php }else{ ?>

                  <li role="presentation" title="Movimientos del almacén">
                     <a href="#<?php echo $value1->codalmacen;?>" aria-controls="<?php echo $value1->codalmacen;?>" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-transfer"></span> <?php echo $value1->nombre;?>

                     </a>
                  </li>
                  <?php } ?>

               <?php }else{ ?>

               <li role="presentation" class="active" title="Movimientos del almacén">
                  <a href="#<?php echo $fsc->empresa->codalmacen;?>" aria-controls="<?php echo $fsc->empresa->codalmacen;?>" role="tab" data-toggle="tab">
                     <span class="glyphicon glyphicon-transfer"></span> <?php echo $fsc->empresa->codalmacen;?>

                  </a>
               </li>
               <?php } ?>

               <li role="presentation">
                  <a href="#table_regularizaciones" aria-controls="table_regularizaciones" role="tab" data-toggle="tab">
                     <span class="glyphicon glyphicon-wrench"></span> Regularizaciones
                  </a>
               </li>
            </ul>
            <div class="tab-content">
               <?php $loop_var1=$fsc->stocks; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <div role="tabpanel" class='tab-pane <?php if( $counter1==0 ){ ?>active<?php } ?>' id="<?php echo $value1->codalmacen;?>">
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th colspan="3" class="text-left"><b>Movimientos del Almacén: <?php echo $value1->nombre;?></b></th>
                              <th>&nbsp;</th>
                              <th colspan="2" class="text-right">
                                 <div class="btn-group">
                                    <?php if( $fsc->agrupar_stock_fecha ){ ?>

                                    <a href="<?php echo $fsc->url();?>#stock" class="btn btn-xs btn-default">
                                       <span class="fa fa-calendar-minus-o"></span>&nbsp;Desagrupar fecha
                                    </a>
                                    <a href="<?php echo $fsc->url();?>&agrupar_stock_fecha=TRUE#stock" class='btn btn-xs btn-default active'>
                                       <span class="fa fa-calendar"></span>&nbsp;Agrupar por fecha
                                    </a>
                                    <?php }else{ ?>

                                    <a href="<?php echo $fsc->url();?>&agrupar_stock_fecha=TRUE#stock" class='btn btn-xs btn-default'>
                                       <span class="fa fa-calendar"></span>&nbsp;Agrupar por fecha
                                    </a>
                                    <?php } ?>

                                 </div>
                              </th>
                           </tr>
                           <tr>
                              <th>Documento</th>
                              <th class="text-right">Ingreso</th>
                              <th class="text-right">Salida</th>
                              <th class="text-right">Cantidad final</th>
                              <th class="text-right">
                                 Fecha
                                 <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                              </th>
                              <th class="text-right">Hora</th>
                           </tr>
                        </thead>
                        <!-- <?php $total_ingreso=$this->var['total_ingreso']=0;?> !-->
                        <!-- <?php $total_salida=$this->var['total_salida']=0;?> !-->
                        <!-- <?php $stock_final=$this->var['stock_final']=0;?> !-->
                        <!-- <?php $ultima_fecha=$this->var['ultima_fecha']=NULL;?> !-->
                        <?php $loop_var2=$fsc->get_movimientos($value1->codalmacen); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                           <?php if( $counter2==0 ){ ?>

                           <!-- <?php $ultima_fecha=$this->var['ultima_fecha']=$value2['fecha'];?> !-->
                           <?php } ?>

                           <?php if( $fsc->agrupar_stock_fecha ){ ?>

                              <?php if( $ultima_fecha!=$value2['fecha'] ){ ?>

                              <tr>
                                 <th>Movimientos del <?php echo $ultima_fecha;?></th>
                                 <th class='text-right'><?php echo $fsc->show_numero($fsc->mgrupo["$ultima_fecha"]['ingreso']);?></th>
                                 <th class='text-right'><?php echo $fsc->show_numero($fsc->mgrupo["$ultima_fecha"]['salida']);?></th>
                                 <th class='text-right'><?php echo $fsc->show_numero($fsc->mgrupo["$ultima_fecha"]['ingreso']+$fsc->mgrupo["$ultima_fecha"]['salida']);?></th>
                                 <th colspan='2'></th>
                              </tr>
                              <?php } ?>

                              <!-- <?php $ultima_fecha=$this->var['ultima_fecha']=$value2['fecha'];?> !-->
                           <?php } ?>

                           <!--
                           <?php if( $value2['origen']=='Regularización' ){ ?><?php $class_tr=$this->var['class_tr']='warning';?><?php }elseif( $value2['movimiento']>0 ){ ?><?php $class_tr=$this->var['class_tr']='success';?><?php }else{ ?><?php $class_tr=$this->var['class_tr']='danger';?><?php } ?>

                           -->
                           <tr class="clickableRow <?php echo $class_tr;?>" href="<?php echo $value2['url'];?>">
                              <td>
                                 <?php echo $value2['codalmacen'];?> - <a href="<?php echo $value2['url'];?>"><?php echo $value2['origen'];?></a>
                              </td>
                              <td class="text-right">
                                 <?php if( $value2['movimiento']>0 ){ ?>

                                 <?php echo $fsc->show_numero($value2['movimiento']);?> <!-- <?php echo $total_ingreso+=$value2['movimiento'];?> !-->
                                 <?php } ?>

                              </td>
                              <td class="text-right">
                                 <?php if( $value2['movimiento']<0 ){ ?>

                                    <?php echo $fsc->show_numero($value2['movimiento']);?> <!-- <?php echo $total_salida+=$value2['movimiento'];?> !-->
                                 <?php } ?>

                              </td>
                              <td class="text-right">
                                 <?php echo $fsc->show_numero($value2['final']);?> <!-- <?php $stock_final=$this->var['stock_final']=$value2['final'];?> !-->
                              </td>
                              <td class="text-right"><?php echo $value2['fecha'];?></td>
                              <td class="text-right"><?php echo $value2['hora'];?></td>
                           </tr>
                        <?php } ?>

                        <?php if( $fsc->agrupar_stock_fecha ){ ?>

                        <tr>
                           <th>Movimientos del <?php echo $ultima_fecha;?></th>
                           <th class='text-right'><?php echo $fsc->show_numero($fsc->mgrupo["$ultima_fecha"]['ingreso']);?></th>
                           <th class='text-right'><?php echo $fsc->show_numero($fsc->mgrupo["$ultima_fecha"]['salida']);?></th>
                           <th class='text-right'><?php echo $fsc->show_numero($fsc->mgrupo["$ultima_fecha"]['ingreso']+$fsc->mgrupo["$ultima_fecha"]['salida']);?></th>
                           <th colspan='2'></th>
                        </tr>
                        <?php } ?>

                        <tr class="warning">
                           <td>
                              Ten en cuenta que las cantidades finales de este listado de movimientos
                              están calculadas desde abajo y son una aproximación.
                           </td>
                           <td class="text-right"><b><?php echo $total_ingreso;?></b></td>
                           <td class="text-right"><b><?php echo $total_salida;?></b></td>
                           <td class="text-right"><b><?php echo $stock_final;?></b></td>
                           <td colspan="2"></td>
                        </tr>
                     </table>
                  </div>
               </div>
               <?php }else{ ?>

               <div role="tabpanel" class='tab-pane active' id="<?php echo $fsc->empresa->codalmacen;?>">
                  <div class="table-responsive" style="margin-top: 10px;">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Documento</th>
                              <th class="text-right">Ingreso</th>
                              <th class="text-right">Salida</th>
                              <th class="text-right">Cantidad final</th>
                              <th class="text-right">
                                 Fecha
                                 <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                              </th>
                              <th class="text-right">Hora</th>
                           </tr>
                        </thead>
                        <tr class="warning">
                           <td colspan="6">Sin resultados.</td>
                        </tr>
                     </table>
                  </div>
               </div>
               <?php } ?>

               <div role="tabpanel" class="tab-pane" id="table_regularizaciones">
                  <div class="table-responsive" style="margin-top: 10px;">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th class="text-left">Almacén</th>
                              <th class="text-right">Usuario</th>
                              <th class="text-left">Motivo</th>
                              <th class="text-right">Cantidad inicial</th>
                              <th class="text-right">Cantidad final</th>
                              <th class="text-right">Fecha</th>
                              <th class="text-right">Hora</th>
                              <th></th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->regularizaciones; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr<?php if( $value1->cantidadfin<$value1->cantidadini ){ ?> class="danger"<?php } ?>>
                           <td class="text-left"><?php echo $value1->codalmacendest;?></td>
                           <td class="text-right"><?php echo $value1->nick;?></td>
                           <td class="text-left">
                              <?php if( $value1->motivo ){ ?><?php echo $value1->motivo;?><?php }else{ ?>-<?php } ?>

                           </td>
                           <td class="text-right"><?php echo $value1->cantidadini;?></td>
                           <td class="text-right"><?php echo $value1->cantidadfin;?></td>
                           <td class="text-right"><?php echo $value1->fecha;?></td>
                           <td class="text-right"><?php echo $value1->hora;?></td>
                           <td>
                              <?php if( $fsc->allow_delete ){ ?>

                              <a href="<?php echo $fsc->url();?>&deletereg=<?php echo $value1->id;?>#stock" title="Eliminar la regularización">
                                 <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                              </a>
                              <?php } ?>

                           </td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="8">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal_recal_stock" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Recalcular stock</h4>
         </div>
         <div class="modal-body">
            <p class='help-block'>
               Se recalculará el stock del artículo a partir de las
               regularizaciones (de stock) y los albaranes y facturas de compra
               y venta.
            </p>
            <p class='help-block'>
               <b>Advertencia</b>: si el artículo no tiene ningún movimiento,
               ni regularización, el stock resultante <b>será 0</b>.
            </p>
         </div>
         <div class="modal-footer">
            <a href="<?php echo $fsc->url();?>&caca=<?php echo $fsc->random_string(4);?>&recalcular_stock=TRUE#stock" class="btn btn-sm btn-warning">
               <span class="glyphicon glyphicon-wrench"></span>&nbsp; Recalcular stock
            </a>
         </div>
      </div>
   </div>
</div>
<script type = "text/javascript">
   
    var flag = false;
     var teclaAnterior = "";
     
     function teclear(event) {
       teclaAnterior = teclaAnterior + " " + event.keyCode;
       var arregloTA = teclaAnterior.split(" ");
       if (event.keyCode == 32 && arregloTA[arregloTA.length - 2] == 32) {
         event.preventDefault();
       }
     }
  </script>
  