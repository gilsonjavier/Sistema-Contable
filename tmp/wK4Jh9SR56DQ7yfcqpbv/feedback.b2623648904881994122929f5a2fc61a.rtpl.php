<?php if(!class_exists('raintpl')){exit;}?><form name="f_feedback" action="https://www.facturascripts.com/feedback" method="post" target="_blank" class="form" role="form">
   <input type="hidden" name="feedback_info" value="<?php echo $fsc->system_info();?>"/>
   <input type="hidden" name="feedback_type" value="error"/>
   <div class="modal" id="modal_feedback">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <i class="fa fa-edit" aria-hidden="true"></i> Informar de error...
               </h4>
               <p class="help-block">
                  Usa este formulario para informarnos de cualquier error o duda que hayas encontrado.
                  Para facilitarnos el trabajo este formulario también nos informa de la versión de
                  FacturaScripts que usas, lista de plugins activos, versión de php, etc...
               </p>
            </div>
            <?php if( $fsc->check_for_updates() ){ ?>

            <div class="modal-body bg-info">
               <p class='help-block'>
                  Tienes <a href="updater.php" target="_blank">actualizaciones pendientes</a>.
                  Las actualizaciones corrigen errores y añaden nuevas características.
                  No recibirás soporte en la web a menos que actualices.
               </p>
            </div>
            <?php } ?>

            <div class="modal-body">
               <div class="form-group">
                  <textarea class="form-control" name="feedback_text" rows="6" placeholder="Detalla tu duda o problema..."></textarea>
               </div>
               <div class="form-group">
                  <div class="input-group">
                     <span class="input-group-addon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                     </span>
                     <?php if( $fsc->empresa && $fsc->user->logged_on ){ ?>

                     <input type="email" class="form-control" name="feedback_email" placeholder="Tu email" value="<?php echo $fsc->empresa->email;?>"/>
                     <?php }else{ ?>

                     <input type="email" class="form-control" name="feedback_email" placeholder="Tu email"/>
                     <?php } ?>

                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <a href="index.php?page=informe_errores" class="btn btn-sm btn-default pull-left">
                  <i class="fa fa-bug" aria-hidden="true"></i>&nbsp; detectar/reparar errores
               </a>
               <button type="submit" class="btn btn-sm btn-primary">
                  <i class="fa fa-send" aria-hidden="true"></i>&nbsp; Enviar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>

<?php if( $fsc->empresa && !FS_DEMO && mt_rand(0,49)==0 ){ ?>

<div style="display: none;">
   <?php if( mt_rand(0,2)>0 && $fsc->user->logged_on ){ ?>

   <iframe src="index.php?page=admin_home&check4updates=TRUE" height="0"></iframe>
   <?php }else{ ?>

   <!--<?php $plugin_list=$this->var['plugin_list']=join(',', $GLOBALS['plugins']);?>-->
    <iframe src="<?php  echo FS_COMMUNITY_URL;?>/index.php?page=community_stats&add=TRUE&version=<?php echo $fsc->version();?>&plugins=<?php echo $plugin_list;?>" height="0"></iframe>
   <?php } ?>

</div>
<?php } ?>

