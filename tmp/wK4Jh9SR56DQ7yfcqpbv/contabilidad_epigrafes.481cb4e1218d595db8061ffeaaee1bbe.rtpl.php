<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   $(document).ready(function() {
      $("#b_nuevo_grupo").click(function(event) {
         event.preventDefault();
         $("#modal_nuevo_grupo").modal('show');
         document.f_nuevo_grupo.ngrupo.focus();
      });
      $("#b_nuevo_epigrafe").click(function(event) {
         event.preventDefault();
         $("#modal_nuevo_epigrafe").modal('show');
         document.f_nuevo_epigrafe.nepigrafe.focus();
      });
      $("#b_nueva_cuenta").click(function(event) {
         event.preventDefault();
         $("#modal_nueva_cuenta").modal('show');
         document.f_nueva_cuenta.ncuenta.focus();
      });
      <?php if( $fsc->grupo ){ ?>

      $("#b_eliminar").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Realmente desea eliminar este grupo?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = '<?php echo $fsc->page->url();?>&deleteg=<?php echo $fsc->grupo->idgrupo;?>';
               }
            }
         });
      });
      <?php } ?>

      <?php if( $fsc->epigrafe ){ ?>

      $("#b_eliminar").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Realmente desea eliminar este epígrafe?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = '<?php echo $fsc->page->url();?>&deletee=<?php echo $fsc->epigrafe->idepigrafe;?>';
               }
            }
         });
      });
      <?php } ?>

   });
</script>

<?php if( $fsc->grupo ){ ?>

<form action="<?php echo $fsc->grupo->url();?>" method="post" class="form" role="form">
   <div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
      <div class="row">
         <div class="col-sm-8">
            <div class="btn-group">
               <a href="<?php echo $fsc->ppage->url();?>" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp;<?php echo $fsc->ppage->title;?></span>
               </a>
               <a href="<?php echo $fsc->grupo->url();?>" class="btn btn-sm btn-default" title="Recargar la página">
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
         <div class="col-sm-4 text-right">
            <div class="btn-group">
               <?php if( $fsc->allow_delete ){ ?>

               <a href="#" id="b_eliminar" class="btn btn-sm btn-danger">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs">&nbsp;Eliminar</span>
               </a>
               <?php } ?>

               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
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
               <th class="text-left">Grupo</th>
               <th class="text-left">Descripción</th>
               <th class="text-left">Ejercicio</th>
            </tr>
         </thead>
         <tr>
            <td><div class="form-control"><?php echo $fsc->grupo->codgrupo;?></div></td>
            <td><input class="form-control" type="text" name="descripcion" value="<?php echo $fsc->grupo->descripcion;?>" autocomplete="off"/></td>
            <td>
               <div class="form-control">
                  <a href="index.php?page=contabilidad_ejercicio&cod=<?php echo $fsc->grupo->codejercicio;?>"><?php echo $fsc->grupo->codejercicio;?></a>
               </div>
            </td>
         </tr>
      </table>
   </div>
</form>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Código</th>
            <th class="text-left">Descripción</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow" href="<?php echo $value1->url();?>">
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codepigrafe;?></a></td>
         <td><?php echo $value1->descripcion;?></td>
      </tr>
      <?php } ?>

      <tr>
         <td colspan="2" class="text-center">
            <a id="b_nuevo_epigrafe" class="btn btn-sm btn-block btn-success" href="#nuevo_epigrafe">
               <span class="glyphicon glyphicon-plus"></span> Nuevo epigrafe...
            </a>
         </td>
      </tr>
   </table>
</div>
<?php }elseif( $fsc->epigrafe ){ ?>

<form action="<?php echo $fsc->epigrafe->url();?>" method="post" class="form">
   <div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
      <div class="row">
         <div class="col-sm-8">
            <div class="btn-group">
               <a href="<?php echo $fsc->ppage->url();?>" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp;<?php echo $fsc->ppage->title;?></span>
               </a>
               <a href="<?php echo $fsc->epigrafe->url();?>" class="btn btn-sm btn-default" title="Recargar la página">
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
         <div class="col-sm-4 text-right">
            <div class="btn-group">
               <?php if( $fsc->allow_delete ){ ?>

               <a href="#" id="b_eliminar" class="btn btn-sm btn-danger">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs">&nbsp;Eliminar</span>
               </a>
               <?php } ?>

               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
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
               <th class="text-left">Epígrafe</th>
               <th class="text-left">Descripción</th>
               <th class="text-left">Ejercicio</th>
            </tr>
         </thead>
         <tr>
            <td><div class="form-control"><?php echo $fsc->epigrafe->codepigrafe;?></div></td>
            <td><input class="form-control" type="text" onkeypress="teclear(event);return LetrasNumeros(event)" name="descripcion" value="<?php echo $fsc->epigrafe->descripcion;?>" autocomplete="off"/></td>
            <td>
               <div class="form-control">
                  <a href="index.php?page=contabilidad_ejercicio&cod=<?php echo $fsc->epigrafe->codejercicio;?>"><?php echo $fsc->epigrafe->codejercicio;?></a>
               </div>
            </td>
         </tr>
      </table>
   </div>
</form>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Código</th>
            <th class="text-left">Descripción</th>
            <th class="text-right">Cuenta especial</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->epigrafe->hijos(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow" href="<?php echo $value1->url();?>">
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codepigrafe;?></a></td>
         <td><?php echo $value1->descripcion;?></td>
         <td class="text-right">-</td>
      </tr>
      <?php } ?>

      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow" href="<?php echo $value1->url();?>">
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codcuenta;?></a></td>
         <td><?php echo $value1->descripcion;?></td>
         <td class="text-right"><?php echo $value1->idcuentaesp;?></td>
      </tr>
      <?php } ?>

   </table>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-6">
         <a id="b_nuevo_epigrafe" class="btn btn-sm btn-block btn-success" href="#">
            <span class="glyphicon glyphicon-plus"></span> Nuevo Epígrafe...
         </a>
      </div>
      <div class="col-sm-6">
         <a id="b_nueva_cuenta" class="btn btn-sm btn-block btn-success" href="#">
            <span class="glyphicon glyphicon-plus"></span> Nueva Cuenta...
         </a>
      </div>
   </div>
</div>
<?php }else{ ?>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               Grupos de epígrafes
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </h1>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-3 col-xs-12">
         <form name="f_filtro_cuentas" action="<?php echo $fsc->url();?>" method="post" class="post">
            <select name="ejercicio" class="form-control" onchange="document.f_filtro_cuentas.submit()">
            <?php $loop_var1=$fsc->ejercicio->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->codejercicio==$fsc->codejercicio ){ ?>

               <option value="<?php echo $value1->codejercicio;?>" selected=""><?php echo $value1->nombre;?> (<?php echo $value1->codejercicio;?>)</option>
               <?php }else{ ?>

               <option value="<?php echo $value1->codejercicio;?>"><?php echo $value1->nombre;?> (<?php echo $value1->codejercicio;?>)</option>
               <?php } ?>

            <?php } ?>

            </select>
         </form>
      </div>
      <div class="col-sm-4 col-xs-6">
         <a id="b_nuevo_grupo" class="btn btn-sm btn-success" href="#nuevo_grupo">
            <span class="glyphicon glyphicon-plus"></span>
            <span class="hidden-xs">Nuevo grupo</span>
         </a>
      </div>
      <div class="col-sm-5 col-xs-6 text-right">
         <a class="btn btn-sm btn-default" href="index.php?page=contabilidad_cuentas">
            Cuentas &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
         </a>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-12">
         <div class="visible-xs">
            <br/>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Código</th>
                     <th class="text-left">Descripción</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->super_epigrafes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class="clickableRow" href="<?php echo $value1->url();?>">
                  <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codepigrafe;?></a></td>
                  <td><?php echo $value1->descripcion;?></td>
               </tr>
               <?php } ?>

               <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class="clickableRow" href="<?php echo $value1->url();?>">
                  <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codgrupo;?></a></td>
                  <td><?php echo $value1->descripcion;?></td>
               </tr>
               <?php } ?>

               <?php if( !$fsc->super_epigrafes && !$fsc->resultados ){ ?>

               <tr class="warning">
                  <td colspan="2">
                     Sin resultados. ¿Has <b>importado</b> los datos de contabilidad del ejercicio?
                     Puedes hacerlo desde el menú contabilidad &gt; Ejercicios.
                  </td>
               </tr>
               <?php } ?>

            </table>
         </div>
      </div>
   </div>
</div>
<?php } ?>


<div class="modal" id="modal_nuevo_grupo">
   <div class="modal-dialog">
      <div class="modal-content">
         <form class="form" role="form" name="f_nuevo_grupo" action="<?php echo $fsc->url();?>" method="post">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nuevo grupo</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Ejercicio:
                  <select name="ejercicio" class="form-control">
                     <?php $loop_var1=$fsc->ejercicio->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->codejercicio==$fsc->codejercicio ){ ?>

                        <option value="<?php echo $value1->codejercicio;?>" selected=""><?php echo $value1->nombre;?> (<?php echo $value1->codejercicio;?>)</option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->codejercicio;?>"><?php echo $value1->nombre;?> (<?php echo $value1->codejercicio;?>)</option>
                        <?php } ?>

                     <?php } ?>

                  </select>
               </div>
               <div class="form-group">
                  Código:
                  <input class="form-control" type="text" placeholder="Codigo" onkeypress="teclear(event);return LetrasNumeros(event)" name="ngrupo" autocomplete="off" maxlength="6"/>
               </div>
               <div class="form-group">
                  Descripción:
                  <input class="form-control" type="text" placeholder="Descripcion" onkeypress="teclear(event)" name="descripcion" autocomplete="off"/>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
              </button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal" id="modal_nuevo_epigrafe">
   <div class="modal-dialog">
      <div class="modal-content">
         <form class="form" role="form" name="f_nuevo_epigrafe" action="<?php echo $fsc->url();?>" method="post">
            <input type="hidden" name="ejercicio" value="<?php echo $fsc->codejercicio;?>"/>
            <?php if( $fsc->epigrafe ){ ?>

            <input type="hidden" name="ejercicio" value="<?php echo $fsc->epigrafe->codejercicio;?>"/>
            <input type="hidden" name="idpadre" value="<?php echo $fsc->epigrafe->idepigrafe;?>"/>
            <?php }elseif( $fsc->grupo ){ ?>

            <input type="hidden" name="ejercicio" value="<?php echo $fsc->grupo->codejercicio;?>"/>
            <input type="hidden" name="idgrupo" value="<?php echo $fsc->grupo->idgrupo;?>"/>
            <input type="hidden" name="codgrupo" value="<?php echo $fsc->grupo->codgrupo;?>"/>
            <?php } ?>

            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nuevo epigrafe</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Código:
                  <?php if( $fsc->epigrafe ){ ?>

                  <input class="form-control" type="text" placeholder="Codigo" onkeypress="teclear(event);return LetrasNumeros(event)" name="nepigrafe" autocomplete="off" maxlength="6"/>
                  <?php }elseif( $fsc->grupo ){ ?>

                  <input class="form-control" type="text" placeholder="Codigo" onkeypress="teclear(event);return LetrasNumeros(event)" name="nepigrafe" value="<?php echo $fsc->grupo->codgrupo;?>0" autocomplete="off" maxlength="6"/>
                  <?php } ?>

               </div>
               <div class="form-group">
                  Descripción:
                  <input class="form-control" type="text" placeholder="Descripcion" onkeypress="teclear(event)" name="descripcion" autocomplete="off"/>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
              </button>
            </div>
         </form>
      </div>
   </div>
</div>

<?php if( $fsc->epigrafe ){ ?>

<div class="modal" id="modal_nueva_cuenta">
   <div class="modal-dialog">
      <div class="modal-content">
         <form class="form" role="form" name="f_nueva_cuenta" action="<?php echo $fsc->url();?>" method="post">
            <input type="hidden" name="ejercicio" value="<?php echo $fsc->epigrafe->codejercicio;?>"/>
            <input type="hidden" name="idepigrafe" value="<?php echo $fsc->epigrafe->idepigrafe;?>"/>
            <input type="hidden" name="codepigrafe" value="<?php echo $fsc->epigrafe->codepigrafe;?>"/>
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nueva cuenta</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Código:<input class="form-control" type="text" placeholder="Codigo" onkeypress="teclear(event);return LetrasNumeros(event)" name="ncuenta" value="<?php echo $fsc->epigrafe->codepigrafe;?>0" autocomplete="off"/>
               </div>
               <div class="form-group">
                  Descripción:
                  <input class="form-control" type="text" placeholder="Descripcion" onkeypress="teclear(event)" name="descripcion" autocomplete="off"/>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
              </button>
            </div>
         </form>
      </div>
   </div>
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