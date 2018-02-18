<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   $(document).ready(function() {
      if(window.location.hash.substring(1) == 'nuevo')
      {
         $("#modal_nuevo_usuario").modal('show');
         document.f_nuevo_usuario.nnick.focus();
      }
      else if(window.location.hash.substring(1) == 'roles')
      {
         $('#tab_usuarios a[href="#roles"]').tab('show');
      }
      else if(window.location.hash.substring(1) == 'nuevorol')
      {
         $('#tab_usuarios a[href="#roles"]').tab('show');
         $("#modal_nuevo_rol").modal('show');
         document.f_nuevo_rol.descripcion.focus();
      }
      $("#b_nuevo_usuario").click(function(event) {
         event.preventDefault();
         $("#modal_nuevo_usuario").modal('show');
         document.f_nuevo_usuario.nnick.focus();
      });
      $("#b_nuevo_rol").click(function(event) {
         event.preventDefault();
         $("#modal_nuevo_rol").modal('show');
         document.f_nuevo_rol.nrol.focus();
      });
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-6 col-xs-7">
         <div class="btn-group">
            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
            <?php if( $fsc->page->is_default() ){ ?>

            <a class="btn btn-sm btn-default active" href="<?php echo $fsc->url();?>&amp;default_page=FALSE" title="Marcada como página de inicio (pulsa de nuevo para desmarcar)">
               <i class="fa fa-bookmark" aria-hidden="true"></i>
            </a>
            <?php }else{ ?>

            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>&amp;default_page=TRUE" title="Marcar como página de inicio">
               <i class="fa fa-bookmark-o" aria-hidden="true"></i>
            </a>
            <?php } ?>

         </div>
         <div class="btn-group">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
      <div class="col-sm-6 col-xs-5 text-right">
         <h2 style="margin-top: 0px;">Usuarios</h2>
      </div>
   </div>
</div>

<div role="tabpanel">
   <ul id="tab_usuarios" class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
         <a href="#usuarios" aria-controls="usuarios" role="tab" data-toggle="tab">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="hidden-xs">&nbsp;Usuarios</span>
            <span class="badge"><?php echo count($fsc->user->all()); ?></span>
         </a>
      </li>
      <?php if( !FS_DEMO ){ ?>

      <li role="presentation">
         <a href="#permisos" aria-controls="permisos" role="tab" data-toggle="tab">
            <i class="fa fa-check-square" aria-hidden="true"></i>
            <span class="hidden-xs">&nbsp;Permisos</span>
         </a>
      </li>
      <li role="presentation">
         <a href="#roles" aria-controls="roles" role="tab" data-toggle="tab">
            <i class="fa fa-address-card-o" aria-hidden="true"></i>
            <span class="hidden-xs">&nbsp;Roles</span>
         </a>
      </li>
      <?php } ?>

      <li role="presentation">
         <a href="#historial" aria-controls="historial" role="tab" data-toggle="tab">
            <i class="fa fa-history" aria-hidden="true"></i>
            <span class="hidden-xs">&nbsp;Historial</span>
         </a>
      </li>
   </ul>
   
   <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="usuarios">
         <div class="container-fluid" style="margin-top: 15px; margin-bottom: 10px;">
            <div class="row">
               <div class="col-sm-6">
                  <a id="b_nuevo_usuario" class="btn btn-xs btn-success" href="#">
                     <span class="glyphicon glyphicon-plus"></span>
                     <span class="hidden-xs">&nbsp;Nuevo</span>
                  </a>
               </div>
               
            </div>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Nick</th>
                     <th class="text-left">Email</th>
                     <th class="text-left">Empleado</th>
                     <th class="text-center">Activado</th>                     
                     <th class="text-center">Administrador</th>
                     <th class="text-left">IP</th>
                     <th class="text-left">Página de inicio</th>
                     <th class="text-right">Último login</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->user->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class='clickableRow<?php if( $value1->show_last_login()=='-' ){ ?> warning<?php } ?>' href='<?php echo $value1->url();?>'>
                  <td><a href="<?php echo $value1->url();?>"><?php echo $value1->nick;?></a></td>
                  <td><?php if( FS_DEMO ){ ?>XXX@XXX.com<?php }else{ ?><?php echo $value1->email;?><?php } ?></td>
                  <td><?php echo $value1->get_agente_fullname();?></td>
                  <td class="text-center">
                     <?php if( $value1->enabled ){ ?><span class="glyphicon glyphicon-ok"></span><?php }else{ ?><span class="glyphicon glyphicon-lock"></span><?php } ?>

                  </td>                  
                  <td class="text-center">
                     <?php if( $value1->admin ){ ?><span class="glyphicon glyphicon-ok"></span><?php } ?>

                  </td>
                  <td><?php if( FS_DEMO ){ ?>XX.XX.XX.XX<?php }else{ ?><?php echo $value1->last_ip;?><?php } ?></td>
                  <td><?php echo $value1->fs_page;?></td>
                  <td class="text-right"><?php echo $value1->show_last_login();?></td>
               </tr>
               <?php } ?>

            </table>
         </div>
      </div>
      <?php if( !FS_DEMO ){ ?>

      <div role="tabpanel" class="tab-pane" id="permisos">
         <div class="container-fluid" style="margin-top: 15px; margin-bottom: 10px;">
            <div class="row">
               <div class="col-sm-12">
                  <p class="help-block">
                     <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;
                     Aquí puedes ver rápidamente qué usuarios tienen permiso para acceder
                     a cada página. En <span class="label label-warning">destacado</span>
                     los que tienen permisos para ver, modificar y eliminar, el resto
                     solamente tienen permisos para ver y modificar.
                  </p>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Página</th>
                     <th class="text-left">Usuarios con permiso</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->all_pages(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <tr>
                     <td><?php echo $value1->name;?></td>
                     <td>
                        <?php $loop_var2=$value1->users; $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                           <?php if( $value2['delete'] ){ ?>

                           <a href="index.php?page=admin_user&snick=<?php echo $key2;?>" class="label label-warning" title="<?php echo $key2;?> puede ver, modificar y eliminar en <?php echo $value1->name;?>">
                              <?php echo $key2;?>

                           </a>&nbsp;
                           <?php }elseif( $value2['modify'] ){ ?>

                           <a href="index.php?page=admin_user&snick=<?php echo $key2;?>" class="label label-default" title="<?php echo $key2;?> puede ver y modificar en <?php echo $value1->name;?>, pero no eliminar">
                              <?php echo $key2;?>

                           </a>&nbsp;
                           <?php } ?>

                        <?php } ?>

                     </td>
                  </tr>
               <?php } ?>

            </table>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="roles">
         <div class="container-fluid" style="margin-top: 15px; margin-bottom: 10px;">
            <div class="row">
               <div class="col-sm-6">
                  <a id="b_nuevo_rol" class="btn btn-xs btn-success" href="#">
                     <span class="glyphicon glyphicon-plus"></span>
                     <span class="hidden-xs">&nbsp;Nuevo</span>
                  </a>
               </div>
               <div class="col-sm-6 text-right">
                  <p class="help-block">
                     <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;
                     Los roles permiten definir paquetes de permisos para aplicar rápidamente
                     a usuarios, en lugar de ir uno por uno.
                  </p>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th>Código</th>
                     <th>Descripción</th>
                  </tr>
               </thead>
               <?php $loop_var2=$fsc->rol->all(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

               <tr class="clickableRow" href="<?php echo $value2->url();?>">
                  <td>
                     <a href="<?php echo $value2->url();?>"><?php echo $value2->codrol;?></a>
                  </td>
                  <td><?php echo $value2->descripcion;?></td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="2">Sin resultados.</td>
               </tr>
               <?php } ?>

            </table>
         </div>
      </div>
      <?php } ?>

      <div role="tabpanel" class="tab-pane" id="historial">
         <div class="container-fluid" style="margin-top: 15px; margin-bottom: 10px;">
            <div class="row">
               <div class="col-sm-8">
                  <p class="help-block">
                     <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;
                     Puedes ver más detalles desde  &gt; Información del Sistema. Donde se mostrara las tablas con las que se cuenta.
                  </p>
               </div>
               
            </div>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Usuario</th>
                     <th></th>
                     <th class="text-left">Detalle</th>
                     <th class="text-left">IP</th>
                     <th class="text-right">Fecha</th>
                  </tr>
               </thead>
               <?php $loop_var2=$fsc->historial; $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

               <tr<?php if( $value2->alerta ){ ?> class="danger"<?php } ?>>
                  <td><a href="index.php?page=admin_user&snick=<?php echo $value2->usuario;?>"><?php echo $value2->usuario;?></a></td>
                  <td class="text-right">
                     <?php if( $value2->alerta ){ ?>

                     <span class="glyphicon glyphicon-warning-sign" aria-hidden="true" title="Podría ser importante"></span>
                     <?php } ?>

                  </td>
                  <td><?php echo $value2->detalle;?></td>
                  <td><?php echo $value2->ip;?></td>
                  <td class="text-right"><?php echo $value2->fecha;?></td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="5">Sin resultados.</td>
               </tr>
               <?php } ?>

            </table>
         </div>
      </div>
   </div>
</div>

<div class="modal" id="modal_nuevo_usuario">
   <div class="modal-dialog">
      <div class="modal-content">
         <form name="f_nuevo_usuario" class="form" role="form" action="<?php echo $fsc->url();?>" method="post">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <i class="fa fa-user" aria-hidden="true"></i>&nbsp; Nuevo usuario
               </h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Nick:
                  <input class="form-control" type="text" name="nnick"placeholder="Nick" maxlength="12" pattern="[A-Za-z0-9_]{1,}" onkeypress="teclear(event);return LetrasNumeros(event)" autocomplete="off" required=""/>
                  <label class="checkbox-inline">
                     <input type="checkbox" name="nadmin" value="TRUE"/>
                     Administrador
                  </label>
                  <?php $loop_var2=$fsc->rol->all(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                  <label class="checkbox-inline">
                     <input type="checkbox" name="roles[]" value="<?php echo $value2->codrol;?>"/>
                     <?php echo $value2->codrol;?>

                  </label>
                  <?php } ?>

               </div>
               <div class="form-group">
                  Contraseña:
                  <input class="form-control" type="password" placeholder="***********" name="npassword" maxlength="32"/>
               </div>
               <div class="form-group">
                  Email:
                  <div class="input-group">
                     <span class="input-group-addon">
                        <span class="glyphicon glyphicon-envelope"></span>
                     </span>
                     <input class="form-control" type="text" name="nemail" placeholder="Ejemplo@gmail.com" title="ejemplo@gmail.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <a target="_blank" href="<?php echo $fsc->agente->url();?>">Empleado</a>:
                  <select name="ncodagente" class="form-control">
                     <option value="">Ninguno</option>
                     <?php $loop_var2=$fsc->agente->all(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                     <option value="<?php echo $value2->codagente;?>"><?php echo $value2->get_fullname();?></option>
                     <?php } ?>

                  </select>
                  <p class="help-block">
                     Puedes tener empleados que no tengan acceso a este programa,
                     o bien usuarios que no sean empleados, por eso está separado.
                  </p>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal" id="modal_nuevo_rol">
   <div class="modal-dialog">
      <div class="modal-content">
         <form name="f_nuevo_rol" class="form" role="form" action="<?php echo $fsc->url();?>" method="post">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp; Nuevo rol
               </h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Código:
                  <input type="text" name="nrol" class="form-control" pattern="[A-Za-z0-9_]{1,}" onkeypress="teclear(event);return LetrasNumeros(event)" maxlength="20" autocomplete="off" required=""/>
               </div>
               <div class="form-group">
                  Descripcion:
                  <input type="text" name="descripcion" class="form-control" onkeypress="teclear(event);return LetrasNumeros(event)"  autocomplete="off" required=""/>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
            </div>
         </form>
      </div>
   </div>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->assign( "key", $key1 ); $tpl->assign( "value", $value1 );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>

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
