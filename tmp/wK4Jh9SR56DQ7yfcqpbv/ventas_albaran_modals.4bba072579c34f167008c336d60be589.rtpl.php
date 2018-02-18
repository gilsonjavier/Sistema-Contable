<?php if(!class_exists('raintpl')){exit;}?><div class="modal fade" id="modal_imprimir_albaran">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Imprimir <?php  echo FS_ALBARAN;?></h4>
            <?php if( mt_rand(0,1)==0 ){ ?>

            <p class="help-block">
               Más formatos disponibles <a href="https://www.facturascripts.com/buscar?query=imprimir" target="_blank">en la web</a>.
            </p>
            <?php }else{ ?>

            <p class="help-block">
               Más formatos disponibles en el plugin <a href="https://www.facturascripts.com/plugin/plantillas_pdf" target="_blank">Plantillas PDF</a>.
            </p>
            <?php } ?>

         </div>
         <div class="modal-body">
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='pdf' ){ ?>

            <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&id=<?php echo $fsc->albaran->idalbaran;?>" target="_blank" class="btn btn-block btn-default"><?php echo $value1->text;?></a>
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
   <input type="hidden" name="codcliente" value="<?php echo $fsc->albaran->codcliente;?>"/>
   <div class="modal" id="modal_enviar">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-envelope"></span>&nbsp;
                  Enviar <?php  echo FS_ALBARAN;?>

               </h4>
               <?php if( $fsc->albaran->femail ){ ?>

               <p class="help-block">
                  <span class="glyphicon glyphicon-send"></span> &nbsp;
                  Este <?php  echo FS_ALBARAN;?> fue enviado el <?php echo $fsc->albaran->femail;?>.
               </p>
               <?php }elseif( !in_array('CRM',$GLOBALS['plugins']) ){ ?>

               <p class="help-block">
                  Gestiona los contactos del cliente y comunícate con ellos con el
                  <a href="https://www.facturascripts.com/plugin/CRM" target="_blank">plugin CRM</a>.
               </p>
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
                     <?php if( $fsc->cliente_s ){ ?>

                     <input id="ac_email" class="form-control" type="text" name="email" value="<?php echo $fsc->cliente_s->email;?>" autocomplete="off"/>
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
                  <textarea class="form-control" name="mensaje" rows="6"><?php echo plantilla_email('albaran',$fsc->albaran->codigo,$fsc->empresa->email_config['mail_firma']); ?></textarea>
                  <p class="help-block">
                     <a href="index.php?page=admin_empresa#email">Editar la firma</a>
                  </p>
               </div>
               <div class="form-group">
                  <input name="adjunto" type="file"/>
                  <p class="help-block">
                     Se va a adjuntar el <?php  echo FS_ALBARAN;?>, pero si lo deseas
                     puedes añadir otro archivo de hasta <?php echo $fsc->get_max_file_upload();?> MB
                  </p>
               </div>
               <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <span class="glyphicon glyphicon-send"></span>&nbsp; Enviar <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                  <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->type=='email' ){ ?>

                     <li>
                        <a href="#" onclick="this.disabled=true;enviar_email('index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&id=<?php echo $fsc->albaran->idalbaran;?>');"><?php echo $value1->text;?></a>
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


<form class="form" role="form" action="<?php echo $fsc->url();?>" method="post">
   <input type="hidden" name="petid" value="<?php echo $fsc->random_string();?>"/>
   <div class="modal" id="modal_aprobar">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Aprobar <?php  echo FS_ALBARAN;?></h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Fecha de la factura:
                  <input class="form-control datepicker" type="text" name="facturar" value="<?php echo $fsc->today();?>" autocomplete="off"/>
                  <p class="help-block">
                     Se generará una factura. Si deseas aprobar de golpe todos
                     los <?php  echo FS_ALBARANES;?> pendientes, puedes usar el plugin <b>megafacturador</b>.
                  </p>
               </div>
               <div class="form-group">
                  <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
                  <select name="codpago" class="form-control">
                     <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->codpago==$fsc->albaran->codpago ){ ?>

                        <option value="<?php echo $value1->codpago;?>" selected=""><?php echo $value1->descripcion;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
                        <?php } ?>

                     <?php } ?>

                  </select>
               </div>
               <div class="text-right">
                  <button class="btn btn-sm btn-primary" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-paperclip"></span>&nbsp; Aprobar
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>

<form action="<?php echo $fsc->ppage->url();?>" method="post">
   <input type="hidden" name="delete" value="<?php echo $fsc->albaran->idalbaran;?>"/>
   <div class="modal fade" id="modal_eliminar">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">¿Realmente desea eliminar este <?php  echo FS_ALBARAN;?>?</h4>
            </div>
            <?php if( $fsc->albaran->idfactura ){ ?>

               <?php if( $fsc->allow_delete_fac ){ ?>

               <div class="modal-body bg-warning">
                  Hay <b>una factura asociada</b> que será eliminada junto con este <?php  echo FS_ALBARAN;?>.
               </div>
               <div class="modal-footer">
                  <div class="pull-left">
                     <label>
                        <input type="checkbox" name="stock" value="TRUE" checked=""/>
                        Actualizar el stock
                     </label>
                  </div>
                  <button class="btn btn-sm btn-danger" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-trash"></span>&nbsp; Eliminar
                  </button>
               </div>
               <?php }else{ ?>

               <div class="modal-body bg-danger">
                  Hay <b>una factura asociada</b> que será eliminada junto con este <?php  echo FS_ALBARAN;?>.
                  Pero no tienes permiso para eliminar facturas.
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
               </div>
               <?php } ?>

            <?php }else{ ?>

            <div class="modal-footer">
               <div class="pull-left">
                  <label>
                     <input type="checkbox" name="stock" value="TRUE" checked=""/>
                     Actualizar el stock
                  </label>
               </div>
               <button class="btn btn-sm btn-danger" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-trash"></span>&nbsp; Eliminar
               </button>
            </div>
            <?php } ?>

         </div>
      </div>
   </div>
</form>