<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   $(document).ready(function() {
      $("#b_nueva_subcuenta").click(function(event) {
         event.preventDefault();
         $("#modal_nueva_subcuenta").modal('show');
      });
      $("#b_eliminar").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Realmente desea eliminar esta cuenta?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = 'index.php?page=contabilidad_epigrafes&deletec=<?php echo $fsc->cuenta->idcuenta;?>';
               }
            }
         });
      });
   });
</script>

<?php if( $fsc->cuenta ){ ?>

<form action="<?php echo $fsc->url();?>" method="post" class="form">
   <div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
      <div class="row">
         <div class="col-sm-8">
            <div class="btn-group">
               <a href="<?php echo $fsc->ppage->url();?>" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp;<?php echo $fsc->ppage->title;?></span>
               </a>
               <a href="<?php echo $fsc->url();?>" class="btn btn-sm btn-default" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </div>
            <div class="btn-group">
               <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_librom">
                  <span class="glyphicon glyphicon-book"></span>
                  <span class="hidden-xs">&nbsp;Libro mayor</span>
               </a>
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
               <th class="text-left">Cuenta</th>
               <th class="text-left">Descripción</th>
               <th class="text-left">
                  <a href="index.php?page=cuentas_especiales">Cuenta especial</a>
               </th>
               <th class="text-left">Ejercicio</th>
            </tr>
         </thead>
         <tr>
            <td><div class="form-control"><?php echo $fsc->cuenta->codcuenta;?></div></td>
            <td><input class="form-control" type="text" placeholder="Descripcion" onkeypress="teclear(event);return LetrasNumeros(event)" name="descripcion" value="<?php echo $fsc->cuenta->descripcion;?>" autocomplete="off"/></td>
            <td>
               <select name="idcuentaesp" class="form-control">
                  <option value="---">Ninguna</option>
                  <?php $loop_var1=$fsc->cuentas_especiales(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <option value="<?php echo $value1->idcuentaesp;?>"<?php if( $value1->idcuentaesp==$fsc->cuenta->idcuentaesp ){ ?> selected=""<?php } ?>>
                     <?php echo $value1->descripcion;?>

                  </option>
                  <?php } ?>

               </select>
            </td>
            <td>
               <div class="form-control">
                  <a href="<?php echo $fsc->ejercicio->url();?>"><?php echo $fsc->ejercicio->nombre;?></a>
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
            <th class="text-left">Código + Descripción</th>
            <th class="text-right">Debe</th>
            <th class="text-right">Haber</th>
            <th class="text-right">Saldo</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->cuenta->get_subcuentas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow" href="<?php echo $value1->url();?>">
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codsubcuenta;?></a> <?php echo $value1->descripcion;?></td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->debe, $value1->coddivisa);?></td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->haber, $value1->coddivisa);?></td>
         <td class='text-right<?php if( $value1->saldo<0 ){ ?> danger<?php } ?>'><?php echo $fsc->show_precio($value1->saldo, $value1->coddivisa);?></td>
      </tr>
      <?php } ?>

      <tr>
         <td colspan="4" class="text-center">
            <a id="b_nueva_subcuenta" class="btn btn-sm btn-block btn-success" href="#">
               <span class="glyphicon glyphicon-plus"></span> Nueva Subcuenta...
            </a>
         </td>
      </tr>
   </table>
</div>

<form class="form-horizontal" role="form" name="f_nueva_subcuenta" action ="<?php echo $fsc->url();?>" method="POST">
   <input type="hidden" name="ejercicio" value="<?php echo $fsc->cuenta->codejercicio;?>"/>
   <input type="hidden" name="idcuenta" value="<?php echo $fsc->cuenta->idcuenta;?>"/>
   <input type="hidden" name="codcuenta" value="<?php echo $fsc->cuenta->codcuenta;?>"/>
   <div class="modal fade" id="modal_nueva_subcuenta">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nueva subcuenta</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="codcuenta" class="col-lg-2 col-md-2 col-sm-2 control-label">Cuenta</label>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                     <div class="form-control"><?php echo $fsc->cuenta->codcuenta;?></div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="nsubcuenta" class="col-lg-2 col-md-2 col-sm-2 control-label">Código</label>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                     <input class="form-control" type="text" placeholder="Codigo" onkeypress="teclear(event);return numeros(event)" name="nsubcuenta" value="<?php echo $fsc->nuevo_codsubcuenta;?>" autocomplete="off" autofocus />
                  </div>
               </div>
               <div class="form-group">
                  <label for="descripcion" class="col-lg-2 col-md-2 col-sm-2 control-label">Descripción</label>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                     <input class="form-control" type="text" placeholder="Descripcion" onkeypress="teclear(event)" name="descripcion" autocomplete="off"/>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Guardar">
                   <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                </button>
            </div>
         </div>
      </div>
   </div>
</form>

<div class="modal fade" id="modal_librom" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Libro mayor</h4>
         </div>
         <div class="modal-body">
            <p class='help-block'>
               Puedes filtrar por fecha y sacar el libro mayor de varias subcuentas a la vez
               desde <b>Informes &gt; Contabilidad</b>.
            </p>
         </div>
         <div class="modal-footer">
            <a href="index.php?page=informe_contabilidad#<?php echo $fsc->cuenta->codejercicio;?>" class="btn btn-sm btn-default">
               <span class="glyphicon glyphicon-book"></span>&nbsp; Libro mayor
            </a>
         </div>
      </div>
   </div>
</div>
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