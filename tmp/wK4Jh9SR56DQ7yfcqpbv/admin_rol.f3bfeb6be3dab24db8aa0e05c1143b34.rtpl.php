<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->rol ){ ?>

<script type="text/javascript">
   function check_allow_delete(counter)
   {
      if( $("#enabled_"+counter).is(':checked') )
      {
         $("#allow_delete_"+counter).prop('checked', true);
      }
      else
      {
         $("#allow_delete_"+counter).prop('checked', false);
      }
   }
   $(document).ready(function() {
      $("#b_eliminar_rol").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Realmente desea eliminar el rol <?php echo $fsc->rol->codrol;?>?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = "index.php?page=admin_users&delete_rol="+encodeURIComponent("<?php echo $fsc->rol->codrol;?>")+"#roles";
               }
            }                
         });
      });
      $('#marcar_todo_ver').click(function() {
         var checked = $(this).prop('checked');
         $("#f_rol_pages input[name='enabled[]']").prop('checked', checked);
      });
      $('#marcar_todo_eliminar').click(function() {
         var checked = $(this).prop('checked');
         $("#f_rol_pages input[name='allow_delete[]']").prop('checked', checked);
      });
   });
</script>

<form action="<?php echo $fsc->rol->url();?>" method="post" class="form" id="f_rol_pages">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-6">
            <div class="btn-group">
               <a class="btn btn-sm btn-default" href="index.php?page=admin_users#roles">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp; Roles</span>
               </a>
               <a class="btn btn-sm btn-default" href="<?php echo $fsc->rol->url();?>" title="recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </div>
            <div class="btn-group">
               <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->type=='button' ){ ?>

                  <a href="index.php?page=<?php echo $value1->from;?>&codrol=<?php echo $fsc->rol->codrol;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
                  <?php } ?>

               <?php } ?>

            </div>
            <a class="btn btn-sm btn-success" href="index.php?page=admin_users#nuevorol" title="Nuevo rol">
               <span class="glyphicon glyphicon-plus"></span>
            </a>
         </div>
         <div class="col-sm-6 text-right">
            <div class="btn-group">
               <?php if( $fsc->allow_delete ){ ?>

               <a href="#" id="b_eliminar_rol" class="btn btn-sm btn-danger">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs hidden-sm">&nbsp;Eliminar</span>
               </a>
               <?php } ?>

               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
                  <span class="hidden-xs">&nbsp;Guardar</span>
               </button>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <div class="page-header">
               <h1>
                  <i class="fa fa-address-card-o" aria-hidden="true"></i>
                  Rol <small><?php echo $fsc->rol->codrol;?></small>
               </h1>
               <a href="<?php echo $fsc->rol->url();?>&aplicar=TRUE" class="label label-success">
                  <i class="fa fa-check" aria-hidden="true"></i> Aplicar
               </a>
               &nbsp; pulsa aplicar para regenerar los permisos de los usuarios.
            </div>
            <div class="form-group">
               <input type="text" name="descripcion" value="<?php echo $fsc->rol->descripcion;?>" class="form-control" autocomplete="off"/>
            </div>
         </div>
      </div>
   </div>
   <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
         <a href="#autorizar" aria-controls="usuarios" role="tab" data-toggle="tab">
            <i class="fa fa-check-square" aria-hidden="true"></i>
            <span class="hidden-xs">&nbsp;Autorizar</span>
         </a>
      </li>
      <li role="presentation">
         <a href="#usuarios" aria-controls="usuarios" role="tab" data-toggle="tab">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="hidden-xs">&nbsp;Usuarios</span>
         </a>
      </li>
   </ul>
   <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="autorizar">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Página</th>
                     <th class="text-left">Menú</th>
                     <th class="text-center">Ver / Modificar</th>
                     <th class="text-center">Permiso de eliminación</th>
                  </tr>
               </thead>
               <tr class="warning">
                  <td colspan="2"></td>
                  <td class="text-center" title="Marcar/desmarcar todos">
                     <input id="marcar_todo_ver" type="checkbox" name="p_ver_modificar" value=""/>
                  </td>
                  <td class="text-center" title="Marcar/desmarcar todos">
                     <input id="marcar_todo_eliminar" type="checkbox" name="p_eliminar" value=""/>
                  </td>
               </tr>
               <?php $loop_var1=$fsc->all_pages(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <tr>
                     <td><?php echo $value1->name;?></td>
                     <td>
                        <?php if( $value1->important ){ ?>

                        <span class="glyphicon glyphicon-star"></span> » <?php echo $value1->title;?>

                        <?php }elseif( $value1->show_on_menu ){ ?>

                        <span class="text-capitalize"><?php echo $value1->folder;?></span> » <?php echo $value1->title;?>

                        <?php }else{ ?>

                        -
                        <?php } ?>

                     </td>
                     <td class="text-center">
                        <input type="checkbox" id="enabled_<?php echo $counter1;?>" name="enabled[]" value="<?php echo $value1->name;?>" onclick="check_allow_delete('<?php echo $counter1;?>')"<?php if( $value1->enabled ){ ?> checked=""<?php } ?>/>
                     </td>
                     <td class="text-center">
                        <input type="checkbox" id="allow_delete_<?php echo $counter1;?>" name="allow_delete[]" value="<?php echo $value1->name;?>"<?php if( $value1->allow_delete ){ ?> checked=""<?php } ?> title="el usuario tiene permisos para eliminar en esta página"/>
                     </td>
                  </tr>
               <?php } ?>

            </table>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="usuarios">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th width="40"></th>
                     <th class="text-left">Nick</th>
                     <th class="text-left">Email</th>
                     <th class="text-right">Último login</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->all_users(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <tr<?php if( $value1->included ){ ?> class="success"<?php } ?>>
                     <td class="text-center">
                        <?php if( $value1->admin ){ ?>

                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <?php }else{ ?>

                        <input type="checkbox" id="enabled_<?php echo $counter1;?>" name="iuser[]" value="<?php echo $value1->nick;?>" <?php if( $value1->included ){ ?> checked=""<?php } ?>/>
                        <?php } ?>

                     </td>
                     <td>
                        <a href="<?php echo $value1->url();?>"><?php echo $value1->nick;?></a>
                        <?php if( $value1->admin ){ ?>

                        &nbsp; <span class="label label-warning">administrador</span>
                        <?php } ?>

                     </td>
                     <td><?php echo $value1->email;?></td>
                     <td class="text-right"><?php echo $value1->show_last_login();?></td>
                  </tr>
               <?php } ?>

            </table>
         </div>
      </div>
   </div>
</form>
<?php }else{ ?>

<div class="thumbnail">
   <img src="<?php  echo FS_PATH;?>view/img/fuuu_face.png" alt="fuuuuu"/>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>