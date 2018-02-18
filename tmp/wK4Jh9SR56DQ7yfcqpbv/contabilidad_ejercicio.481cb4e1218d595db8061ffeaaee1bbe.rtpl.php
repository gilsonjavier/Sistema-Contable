<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->ejercicio ){ ?>

<script type="text/javascript">
   function cerrar_ejercicio()
   {
      location.href = '<?php echo $fsc->url();?>&cerrar=TRUE&petid=<?php echo $fsc->random_string();?>';
   }
   $(document).ready(function() {
      <?php if( $fsc->url_recarga ){ ?>

         setTimeout("location.href = '<?php echo $fsc->url_recarga;?>';", 2000);
      <?php }elseif( !$fsc->listado && $fsc->ejercicio->estado == 'ABIERTO' && $fsc->listar!='grupos' ){ ?>

         $("#modal_importar").modal('show');
      <?php } ?>

      
      $("#b_importar").click(function(event) {
         event.preventDefault();
         $("#modal_importar").modal('show');
      });
      $("#b_eliminar").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Realmente desea eliminar este ejercicio?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = 'index.php?page=contabilidad_ejercicios&delete=<?php echo $fsc->ejercicio->codejercicio;?>';
               }
            }
         });
      });
   });
</script>

<form action="<?php echo $fsc->url();?>" method="post" class="form">
   <input type="hidden" name="codejercicio" value="<?php echo $fsc->ejercicio->codejercicio;?>"/>
   <div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
      <div class="row">
         <div class="col-xs-7">
            <div class="btn-group">
               <a class="btn btn-sm btn-default" href="index.php?page=contabilidad_ejercicios">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs hidden-sm">&nbsp; Ejercicios</span>
               </a>
               <a class="btn btn-sm btn-default hidden-xs" href="<?php echo $fsc->url();?>" title="recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </div>
            <?php if( $fsc->asiento_apertura_url || $fsc->asiento_cierre_url || $fsc->asiento_pyg_url ){ ?>

            <div class="btn-group">
               <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  Asiento... <span class="caret"></span>
               </button>
               <ul class="dropdown-menu" role="menu">
                  <?php if( $fsc->asiento_apertura_url ){ ?>

                  <li><a href="<?php echo $fsc->asiento_apertura_url;?>">Asiento de apertura</a></li>
                  <?php } ?>

                  
                  <?php if( $fsc->asiento_cierre_url ){ ?>

                  <li><a href="<?php echo $fsc->asiento_cierre_url;?>">Asiento de cierre</a></li>
                  <?php } ?>

                  
                  <?php if( $fsc->asiento_pyg_url ){ ?>

                  <li><a href="<?php echo $fsc->asiento_pyg_url;?>">Asiento de pérdidas y ganancias</a></li>
                  <?php } ?>

               </ul>
            </div>
            <?php } ?>

            <div class="btn-group">
               <a id="b_importar" class="btn btn-sm btn-default" href="#">
                  <span class="glyphicon glyphicon-import"></span>
                  <span class="hidden-xs">&nbsp;Importar</span>
               </a>
               <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>&export=TRUE">
                  <span class="glyphicon glyphicon-export"></span>
                  <span class="hidden-xs">&nbsp;Exportar</span>
               </a>
               <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->type=='button' ){ ?>

                  <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
                  <?php } ?>

               <?php } ?>

            </div>
         </div>
         <div class="col-xs-5 text-right">
            <div class="btn-group">
               <?php if( $fsc->allow_delete ){ ?>

               <a href="#" id="b_eliminar" class="btn btn-sm btn-danger" title="Eliminar ejercicio">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs hidden-sm">&nbsp;Eliminar</span>
               </a>
               <?php } ?>

               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Guardar">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
                  <span class="hidden-xs">&nbsp;Guardar</span>
               </button>
            </div>
         </div>
      </div>
   </div>
   
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left">Nombre</th>
               <th class="text-left">Fecha inicio</th>
               <th class="text-left">Fecha fin</th>
               <th class="text-left">Longitud subcuenta</th>
               <th class="text-left">Estado</th>
            </tr>
         </thead>
         <tr>
            <td><input class="form-control" type="text" name="nombre" onkeypress="teclear(event);return LetrasNumeros(event)" placeholder="Nombre" value="<?php echo $fsc->ejercicio->nombre;?>" autocomplete="off"/></td>
            <td><input class="form-control datepicker" readonly type="text" name="fechainicio" value="<?php echo $fsc->ejercicio->fechainicio;?>"/></td>
            <td><input class="form-control datepicker" readonly type="text" name="fechafin" value="<?php echo $fsc->ejercicio->fechafin;?>"/></td>
            <td><input class="form-control" type="number" min="7" max="7" placeholder="7" onkeypress="teclear(event);return numeros(event)" name="longsubcuenta" value="<?php echo $fsc->ejercicio->longsubcuenta;?>"/></td>
            <td>
               <select name="estado" class="form-control">
                  <option value="ABIERTO"<?php if( $fsc->ejercicio->abierto() ){ ?> selected=""<?php } ?>>ABIERTO</option>
                  <option value="CERRADO"<?php if( !$fsc->ejercicio->abierto() ){ ?> selected=""<?php } ?>>CERRADO</option>
               </select>
               <?php if( $fsc->ejercicio->abierto() ){ ?>

               <button class="btn btn-xs btn-block btn-warning" type="button" onclick="cerrar_ejercicio()" title="Cerrar ejercicio">
                  <span class="glyphicon glyphicon-lock"></span>&nbsp;Cerrar
               </button>
               <?php } ?>

            </td>
         </tr>
      </table>
   </div>
</form>

<ul class="nav nav-tabs">
   <li<?php if( $fsc->listar=='grupos' ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->url();?>&listar=grupos">Grupos</a>
   </li>
   <li<?php if( $fsc->listar=='epigrafes' ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->url();?>&listar=epigrafes">Epígrafes</a>
   </li>
   <li<?php if( $fsc->listar=='cuentas' ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->url();?>&listar=cuentas">Cuentas</a>
   </li>
   <li<?php if( $fsc->listar=='subcuentas' ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->url();?>&listar=subcuentas">Subcuentas</a>
   </li>
</ul>

<?php if( $fsc->listar=='grupos' ){ ?>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Código + Descripción</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->listado; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow" href="<?php echo $value1->url();?>">
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codgrupo;?></a> <?php echo $value1->descripcion;?></td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td>Sin resultados.</td>
      </tr>
      <?php } ?>

   </table>
</div>
<?php }elseif( $fsc->listar=='epigrafes' ){ ?>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Grupo</th>
            <th class="text-left">Código + Descripción</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->listado; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow" href="<?php echo $value1->url();?>">
         <td><?php echo $value1->codgrupo;?></td>
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codepigrafe;?></a> <?php echo $value1->descripcion;?></td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td colspan="2">
            Sin resultados. Debes importar los datos del ejercicio, pulsa el botón <b>importar</b>
         </td>
      </tr>
      <?php } ?>

   </table>
</div>
<?php }elseif( $fsc->listar=='cuentas' ){ ?>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Epígrafe</th>
            <th class="text-left">Código + Descripción</th>
            <th class="text-right">Cuenta Especial</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->listado; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow" href="<?php echo $value1->url();?>">
         <td><?php echo $value1->codepigrafe;?></td>
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codcuenta;?></a> <?php echo $value1->descripcion;?></td>
         <td class="text-right"><?php echo $value1->idcuentaesp;?></td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td colspan="3">
            Sin resultados. Debes importar los datos del ejercicio, pulsa el botón <b>importar</b>
         </td>
      </tr>
      <?php } ?>

   </table>
</div>
<?php }elseif( $fsc->listar=='subcuentas' ){ ?>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Cuenta</th>
            <th class="text-left">Código + Descripción</th>
            <th class="text-right">Saldo</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->listado; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow" href="<?php echo $value1->url();?>">
         <td><?php echo $value1->codcuenta;?></td>
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codsubcuenta;?></a> <?php echo $value1->descripcion;?></td>
         <td class='text-right<?php if( $value1->saldo<0 ){ ?> danger<?php } ?>'><?php echo $fsc->show_precio($value1->saldo, $value1->coddivisa);?></td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td colspan="3">
            Sin resultados. Debes importar los datos del ejercicio, pulsa el botón <b>importar</b>
         </td>
      </tr>
      <?php } ?>

   </table>
</div>
<?php }else{ ?>

<h1>Algo has tocado o_O</h1>
<?php } ?>


<form enctype='multipart/form-data' action="<?php echo $fsc->url();?>" method="post" class="form">
   <input name='archivo' type='hidden' value='TRUE'/>
   <div class="modal fade" id="modal_importar">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-import"></span>
                  &nbsp; Importar datos del ejercicio
               </h4>
               <p class="help-block">
                  Se activaran o  importarán grupos, epígrafes, cuentas, subcuentas, etc.
                  <br/> 
               </p>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-sm-6">
                     <div class="radio">
                        <label>
                           <input type="radio" name="fuente" value="plugins/ecuador/extras/ecuador.xml" checked=""/>
                           <!--Plan General Contable de <b>Ecuador</b>-->
                            <b>Activar Plan contable</b>
                        </label>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="radio">
                        <label>
                           <input type="radio" id="rb_archivo" name="fuente" value="archivo" onclick="$('#div_externo').show();"/>
                           <i class="fa fa-file-code-o" aria-hidden="true"></i>&nbsp; Un archivo externo
                        </label>
                     </div>
                     <div id="div_externo" class="form-group" style="display: none;">
                        <input name='farchivo' type='file' onclick="$('#rb_archivo').prop('checked', true);"/>
                     </div>
                     <p class="help-block">
                        ¿Quieres usar las mismas cuentas y subcuentas que en el ejercicio anterior?
                        Pues simplemente ve al ejercicio anterior, pulsa exportar, y usa ese archivo
                        para importar con este formulario (opción un archivo externo).
                     </p>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <p class="help-block pull-left">
                  Es un proceso lento. Espera a que termine.
               </p>
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-import"></span>&nbsp; Aceptar
               </button>
            </div>
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
