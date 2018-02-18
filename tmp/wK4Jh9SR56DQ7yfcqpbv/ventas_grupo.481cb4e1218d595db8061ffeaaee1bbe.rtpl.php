<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->grupo ){ ?>

<script type="text/javascript">
   function eliminar_grupo(cod)
   {
      bootbox.confirm({
         message: '¿Realmente desea eliminar este grupo?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = 'index.php?page=ventas_clientes&delete_grupo=<?php echo urlencode($fsc->grupo->codgrupo); ?>#grupos';
            }
         }
      });
   }
   $(document).ready(function() {
      /**
       * Con esta opcion marcamos y desmarcamos el grupo de clientes que se visualizan actualmente
       */
      $('#marcartodo').click(function() {
         var checked = $(this).prop('checked');
         $('#agregar_clientes').find('input:checkbox').prop('checked', checked);
      });
   });
</script>

<div class="container-fluid">
   <form action="<?php echo $fsc->url();?>" method="post" class="form">
      <div class="row">
         <div class="col-xs-6">
            <div class="btn-group">
               <a class="btn btn-sm btn-default" href="index.php?page=ventas_clientes#grupos">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp;Todos</span>
               </a>
               <a class="btn btn-sm btn-default" href="<?php echo $fsc->grupo->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </div>
            <div class="btn-group">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

            </div>
         </div>
         <div class="col-xs-6 text-right">
            <div class="btn-group">
               <?php if( $fsc->allow_delete ){ ?>

               <a href="#" class="btn btn-sm btn-danger" onclick="eliminar_grupo()">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs">&nbsp;Eliminar</span>
               </a>
               <?php } ?>

               <button type="submit" class="btn btn-sm btn-primary">
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
                  <span class="glyphicon glyphicon-folder-open"></span>&nbsp;
                  Grupo <small><?php echo $fsc->grupo->codgrupo;?></small>
               </h1>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-8">
            <div class="form-group">
               <input type="text" name="nombre" value="<?php echo $fsc->grupo->nombre;?>" class="form-control" autocomplete="off"/>
            </div>
         </div>
         <div class="col-sm-4">
            <div class="form-group">
               <select name="codtarifa" class="form-control">
                  <option value="---">Ninguna tarifa</option>
                  <option value="---">---</option>
                  <?php $loop_var1=$fsc->tarifa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codtarifa==$fsc->grupo->codtarifa ){ ?>

                     <option value="<?php echo $value1->codtarifa;?>" selected=""><?php echo $value1->nombre;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codtarifa;?>"><?php echo $value1->nombre;?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </div>
         </div>
      </div>
   </form>
</div>

<br/>

<ul class="nav nav-tabs">
   <li role="presentation"<?php if( $fsc->mostrar=='clientes' ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->grupo->url();?>">
         <span class="fa fa-users" aria-hidden="true"></span>
         <span class="hidden-xs">&nbsp;Clientes</span>
         <span class="badge"><?php echo $fsc->total_clientes;?></span>
      </a>
   </li>
   <li role="presentation" <?php if( $fsc->mostrar=='agregar_clientes' ){ ?> class="active"<?php } ?>">
      <a href="<?php echo $fsc->grupo->url();?>&mostrar=agregar_clientes">
         <span class="fa fa-user-plus" aria-hidden="true"></span>
         <span class="hidden-xs">&nbsp;Añadir Clientes</span>
      </a>
   </li>
</ul>

<?php if( $fsc->mostrar=='clientes' ){ ?>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th></th>
            <th class="text-left">Código + Nombre</th>
            <th class="text-left"><?php  echo FS_CIFNIF;?></th>
            <th class="text-left">email</th>
            <th class="text-left">Teléfono</th>
            <th class="text-left">Observaciones</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->clientes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class='clickableRow<?php if( $value1->debaja ){ ?> danger<?php }elseif( $value1->fechaalta==$fsc->today() ){ ?> success<?php } ?>' href='<?php echo $value1->url();?>'>
         <td class="text-center danger" title="quitar cliente <?php echo $value1->codcliente;?> del grupo">
            <?php if( $fsc->allow_delete ){ ?>

            <a href="<?php echo $fsc->url();?>&quitar=<?php echo $value1->codcliente;?>" class="cancel_clickable">
               <span class="glyphicon glyphicon-trash"></span>
            </a>
            <?php } ?>

         </td>
         <td>
            <a href="<?php echo $value1->url();?>"><?php echo $value1->codcliente;?></a> <?php echo $value1->nombre;?>

            <?php if( $value1->debaja ){ ?>

            &nbsp; <span class="label label-danger" title="cliente dado de baja">Baja</span>
            <?php }elseif( $value1->fechaalta==$fsc->today() ){ ?>

            &nbsp; <span class="label label-success" title="Nuevo cliente">Nuevo</span>
            <?php } ?>

         </td>
         <td><?php echo $value1->cifnif;?></td>
         <td><?php echo $value1->email;?></td>
         <td><?php echo $value1->telefono1;?></td>
         <td><?php echo $value1->observaciones_resume();?></td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td colspan="6">Ningún cliente encontrado. Pulse el botón <b>Nuevo</b> para crear uno.</td>
      </tr>
      <?php } ?>

   </table>
</div>
<?php }elseif( $fsc->mostrar=='agregar_clientes' ){ ?>

<div class="container-fluid" style="margin-top: 15px; margin-bottom: 15px;">
   <form class='form' role='form' method='post' action='<?php echo $fsc->url();?>&mostrar=agregar_clientes'>
      <div class="row">
         <div class="col-sm-2">
            <div class="input-group">
               <input class="form-control" type="text" name="query" value="<?php echo $fsc->query;?>" autocomplete="off" placeholder="Buscar">
               <span class="input-group-btn hidden-sm">
                  <button class="btn btn-primary" type="submit">
                     <span class="glyphicon glyphicon-search"></span>
                  </button>
               </span>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="input-group">
               <input class="form-control" type="text" name="direccion" value="<?php echo $fsc->direccion;?>" autocomplete="off" placeholder="Dirección">
               <span class="input-group-btn hidden-sm">
                  <button class="btn btn-default" type="submit">
                     <span class="glyphicon glyphicon-search"></span>
                  </button>
               </span>
            </div>
         </div>
         <div class="col-sm-2">
            <select name="codpais" class="form-control" onchange="this.form.submit()">
               <option value="">Cualquier pais</option>
               <option value="">------</option>
               <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->codpais==$fsc->codpais ){ ?>

                  <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                  <?php } ?>

               <?php } ?>

            </select>
         </div>
         <div class="col-sm-2">
            <select name="provincia" class="form-control" onchange="this.form.submit()">
               <option value="">Cualquier provincia</option>
               <option value="">------</option>
               <?php $loop_var1=$fsc->provincias(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $key1===$fsc->provincia ){ ?>

                  <option value="<?php echo $key1;?>" selected=""><?php echo $value1;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
                  <?php } ?>

               <?php } ?>

            </select>
         </div>
         <div class="col-sm-2">
            <select name="ciudad" class="form-control" onchange="this.form.submit()">
               <option value="">Cualquier ciudad</option>
               <option value="">------</option>
               <?php $loop_var1=$fsc->ciudades(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $key1===$fsc->ciudad ){ ?>

                  <option value="<?php echo $key1;?>" selected=""><?php echo $value1;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
                  <?php } ?>

               <?php } ?>

            </select>
         </div>
         <div class="col-sm-2">
            <div class="input-group">
               <div class="input-group-addon">
                  <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
               </div>
               <select name="orden" class="form-control" onchange="this.form.submit()">
                  <?php $loop_var1=$fsc->orden(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->orden==$key1 ){ ?>

                     <option value="<?php echo $key1;?>" selected=""><?php echo $value1;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </div>
         </div>
      </div>
   </form>
</div>
<form class='form' role='form' method='post' action='<?php echo $fsc->url();?>&mostrar=agregar_clientes'>
   <div class="container-fluid" style="margin-bottom: 10px;">
      <div class="row">
         <div class="col-sm-12">
            <button type="submit" class="btn btn-xs btn-success">
               <span class="glyphicon glyphicon-plus"></span> Añadir clientes seleccionados
            </button>
         </div>
      </div>
   </div>
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-center">
                  <input id="marcartodo" type="checkbox" name="check">
               </th>
               <th class="text-left">Código + Nombre</th>
               <th class="text-left"><?php  echo FS_CIFNIF;?></th>
               <th class="text-left">email</th>
               <th class="text-left">Teléfono</th>
               <th class="text-left">Observaciones</th>
            </tr>
         </thead>
         <tbody id="agregar_clientes">
            <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <tr class='<?php if( $value1->debaja ){ ?>danger<?php }elseif( $value1->fechaalta==$fsc->today() ){ ?>success<?php } ?>'>
               <td class="text-center">
                  <?php if( $value1->codgrupo==$fsc->grupo->codgrupo ){ ?>

                  <span class="glyphicon glyphicon-check" title="ya pertenece al grupo"></span>
                  <?php }else{ ?>

                  <input type="checkbox" name="anyadir[]" value="<?php echo $value1->codcliente;?>">
                  <?php } ?>

               </td>
               <td>
                  <a href="<?php echo $value1->url();?>"><?php echo $value1->codcliente;?></a> <?php echo $value1->nombre;?>

                  <?php if( $value1->debaja ){ ?>

                  &nbsp; <span class="label label-danger" title="cliente dado de baja">Baja</span>
                  <?php }elseif( $value1->fechaalta==$fsc->today() ){ ?>

                  &nbsp; <span class="label label-success" title="Nuevo cliente">Nuevo</span>
                  <?php } ?>

               </td>
               <td><?php echo $value1->cifnif;?></td>
               <td><?php echo $value1->email;?></td>
               <td><?php echo $value1->telefono1;?></td>
               <td><?php echo $value1->observaciones_resume();?></td>
            </tr>
            <?php }else{ ?>

            <tr class="warning">
               <td colspan="7">Ningún cliente encontrado. Utilice la barra de busqueda superior para encontrar uno.</td>
            </tr>
            <?php } ?>

         </tbody>
      </table>
   </div>
</form>
<?php } ?>


<?php }else{ ?>

<div class="thumbnail">
   <img src="<?php  echo FS_PATH;?>view/img/fuuu_face.png" alt="fuuuuu"/>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>