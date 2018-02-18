<?php if(!class_exists('raintpl')){exit;}?><div class="modal fade" id="modal_imprimir">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Imprimir factura</h4>
         </div>
         <div class="modal-body">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='pdf' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&id=<?php echo $fsc->factura->idfactura;?>" target="_blank" class="btn btn-block btn-default">
                  <span class="glyphicon glyphicon-print"></span> &nbsp; <?php echo $value1->text;?>

               </a>
               <?php } ?>

            <?php } ?>

         </div>
         <div class="modal-footer">
            <a href="index.php?page=admin_empresa#impresion" target="_blank">
               <span class="glyphicon glyphicon-wrench"></span>&nbsp; Opciones de impresión
            </a>
         </div>
      </div>
   </div>
</div>

<form action="<?php echo $fsc->url();?>&pagada=TRUE" method="post" class="form">
   <div class="modal fade" id="modal_pagar">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Marcar factura como pagada</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Fecha del pago:
                  <div class="input-group">
                     <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                     <input type="text" name="fpagada" value="<?php echo $fsc->today();?>" class="form-control datepicker" required="" autocomplete="off"/>
                  </div>
                  <?php if( $fsc->empresa->contintegrada ){ ?>

                  <p class="help-block">Se generará un asiento de pago.</p>
                  <?php } ?>

               </div>
               <div class="text-right">
                  <button type="submit" class="btn btn-sm btn-primary">
                     <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>

<form action="<?php echo $fsc->url();?>" method="post" class="form">
   <input type="hidden" name="anular" value="TRUE"/>
   <div class="modal fade" id="modal_eliminar">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">¿Quiere eliminar o anular esta factura?</h4>
               <?php if( !in_array('editar_facturas', $GLOBALS['plugins']) ){ ?>

               <p class="help-block">
                  Puedes editar facturas usando el plugin
                  <a href="https://www.facturascripts.com/plugin/editar_facturas" target="_blank">editar facturas</a>.
               </p>
               <?php } ?>

            </div>
            <div class="modal-body bg-warning">
               <?php if( $fsc->factura->idasiento ){ ?>

                  Si decide <b>eliminar</b>, hay asociado un asiento contable que será eliminado
                  junto con la factura. Además, si no hay asociado un <?php  echo FS_ALBARAN;?> o <?php  echo FS_ALBARANES;?>,
                  se restaurará el stock de los artículos.
               <?php }else{ ?>

                  Si decide <b>eliminar</b>, se restaurará el stock de los artículos si no hay asociado un
                  <?php  echo FS_ALBARAN;?> o <?php  echo FS_ALBARANES;?>.
               <?php } ?>

               <?php if( !$fsc->factura->anulada ){ ?>

                  <br/><br/>
                  <?php if( $fsc->empresa->codpais!='ESP' ){ ?>

                  Si decide <b>anular</b> la factura se restaurará el stock, a menos que haya asociado
                  un <?php  echo FS_ALBARAN;?> o <?php  echo FS_ALBARANES;?>.
                  <br/><br/>
                  <?php } ?>

                  Y si decide generarar una <b><?php  echo FS_FACTURA_RECTIFICATIVA;?></b>, se anulará esta
                  y se restaurará el stock de los artículos, aunque primero debe elegir la serie
                  para la nueva <?php  echo FS_FACTURA_RECTIFICATIVA;?>:
                  <div class="form-group">
                     <select name="codserie" class="form-control">
                     <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->codserie=='R' ){ ?>

                        <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                        <?php } ?>

                     <?php } ?>

                     </select>
                  </div>
                  <div class="form-group">
                     <textarea name="motivo" class="form-control" placeholder="Motivo de la anulación"></textarea>
                  </div>
               <?php } ?>

            </div>
            <div class="modal-footer">
               <a class="btn btn-sm btn-danger pull-left" href="<?php echo $fsc->ppage->url();?>&delete=<?php echo $fsc->factura->idfactura;?>">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class='hidden-xs'>&nbsp;Eliminar</span>
               </a>
               <?php if( !$fsc->factura->anulada ){ ?>

               <div class="btn-group">
                  <?php if( $fsc->empresa->codpais!='ESP' ){ ?>

                  <button type="submit" name="rectificativa" value="FALSE" class="btn btn-sm btn-warning">
                     Anular
                  </button>
                  <?php } ?>

                  <button type="submit" name="rectificativa" value="TRUE" class="btn btn-sm btn-warning text-capitalize">
                     <?php  echo FS_FACTURA_RECTIFICATIVA;?>

                  </button>
               </div>
               <?php } ?>

            </div>
         </div>
      </div>
   </div>
</form>