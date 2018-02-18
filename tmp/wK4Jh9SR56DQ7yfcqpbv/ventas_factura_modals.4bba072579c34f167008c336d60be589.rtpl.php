<?php if(!class_exists('raintpl')){exit;}?><div class="modal fade" id="modal_imprimir">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Imprimir <?php  echo FS_FACTURA;?></h4>
         </div>
         <div class="modal-body">
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='pdf' ){ ?>

            <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&id=<?php echo $fsc->factura->idfactura;?>" target="_blank" class="btn btn-block btn-default">
               <?php echo $value1->text;?>

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

<?php if( $fsc->empresa->can_send_mail() ){ ?>

<form class="form" role="form" name="f_enviar_email" action="<?php echo $fsc->url();?>" method="post" enctype="multipart/form-data">
   <input type="hidden" name="codcliente" value="<?php echo $fsc->factura->codcliente;?>"/>
   <div class="modal" id="modal_enviar">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-envelope"></span>&nbsp;
                  Enviar <?php  echo FS_FACTURA;?>

               </h4>
               <?php if( $fsc->factura->femail ){ ?>

               <p class="help-block">
                  <span class="glyphicon glyphicon-send"></span> &nbsp;
                  Esta <?php  echo FS_FACTURA;?> fue enviada el <?php echo $fsc->factura->femail;?>.
               </p>
               <?php }elseif( !in_array('CRM',$GLOBALS['plugins']) ){ ?>

               <?php } ?>

            </div>
            <div class="modal-body">
               <div class="form-group">
                  <div class="input-group">
                     <span class="input-group-addon">De</span>
                     <select name="de" class="form-control">
                        <?php if( $fsc->user->email ){ ?>

                        <option><?php echo $fsc->user->email;?></option>
                        <?php } ?>

                        <option><?php echo $fsc->empresa->email;?></option>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group">
                     <span class="input-group-addon">Para</span>
                     <?php if( $fsc->cliente ){ ?>

                     <input id="ac_email" class="form-control" type="text" name="email" value="<?php echo $fsc->cliente->email;?>" autocomplete="off"/>
                     <span class="input-group-addon" title="Asignar email al cliente">
                        <input type="checkbox" name="guardar" value="TRUE"/>
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                     </span>
                     <?php }else{ ?>

                     <input id="ac_email" class="form-control" type="text" name="email" autocomplete="off"/>
                     <?php } ?>

                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group">
                     <span class="input-group-addon">Copia</span>
                     <input id="ac_email2" class="form-control" type="text" name="email_copia" autocomplete="off"/>
                     <span class="input-group-addon" title="Copia de carbón oculta">
                        <input type="checkbox" name="cco" value="TRUE"/>
                        <span class="glyphicon glyphicon-eye-close"></span>
                     </span>
                  </div>
               </div>
               <div class="form-group">
                  <textarea class="form-control" name="mensaje" rows="6"><?php echo plantilla_email('factura',$fsc->factura->codigo,$fsc->empresa->email_config['mail_firma']); ?></textarea>
                  <p class="help-block">
                     <a href="index.php?page=admin_empresa#email">Editar la firma</a>
                  </p>
               </div>
               <div class="form-group">
                  <input name="adjunto" type="file"/>
                  <p class="help-block">
                     Se va a adjuntar la factura, pero si lo deseas
                     puedes añadir otro archivo de hasta <?php echo $fsc->get_max_file_upload();?> MB
                  </p>
               </div>
               <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <span class="glyphicon glyphicon-send"></span>
                     &nbsp; Enviar <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                  <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->type=='email' ){ ?>

                     <li>
                        <a href="#" onclick="this.disabled=true;enviar_email('index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&id=<?php echo $fsc->factura->idfactura;?>');"><?php echo $value1->text;?></a>
                     </li>
                     <?php } ?>

                  <?php } ?>

                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
<?php }else{ ?>

<div class="modal" id="modal_enviar">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
               <span class="glyphicon glyphicon-envelope"></span>&nbsp; Enviar por email
            </h4>
         </div>
         <div class="modal-body">
            <a href='index.php?page=admin_empresa#email' class="btn btn-sm btn-warning">
               <span class="glyphicon glyphicon-wrench"></span>&nbsp; Configurar
            </a>
         </div>
      </div>
   </div>
</div>
<?php } ?>


<form action="<?php echo $fsc->url();?>&pagada=TRUE" method="post" class="form">
   <div class="modal fade" id="modal_pagar">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Marcar <?php  echo FS_FACTURA;?> como pagada</h4>
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
               <h4 class="modal-title">¿Quiere eliminar o anular esta <?php  echo FS_FACTURA;?>?</h4>
               <?php if( !in_array('editar_facturas', $GLOBALS['plugins']) ){ ?>

               <p class="help-block">
                  Puedes editar <?php  echo FS_FACTURAS;?> usando el plugin
                  <a href="https://www.facturascripts.com/plugin/editar_facturas" target="_blank">editar facturas</a>.
               </p>
               <?php } ?>

            </div>
            <div class="modal-body bg-warning">
               <?php if( $fsc->factura->idasiento ){ ?>

                  Si decide <b>eliminar</b>, hay asociado un asiento contable que será eliminado
                  junto con la <?php  echo FS_FACTURA;?>. Además, si no hay asociado un <?php  echo FS_ALBARAN;?> o <?php  echo FS_ALBARANES;?>,
                  se restaurará el stock de los artículos.
               <?php }else{ ?>

                  Si decide <b>eliminar</b>, se restaurará el stock de los artículos si no hay asociado un
                  <?php  echo FS_ALBARAN;?> o <?php  echo FS_ALBARANES;?>.
               <?php } ?>

               <?php if( !$fsc->factura->anulada ){ ?>

                  <br/><br/>
                  <?php if( $fsc->empresa->codpais!='ESP' ){ ?>

                  Si decide <b>anular</b> la <?php  echo FS_FACTURA;?> se restaurará el stock, a menos que haya asociado
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