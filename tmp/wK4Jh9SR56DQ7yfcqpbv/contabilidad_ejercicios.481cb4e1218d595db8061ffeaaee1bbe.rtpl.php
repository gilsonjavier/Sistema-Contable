<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   $(document).ready(function() {
      $("#b_nuevo_ejercicio").click(function(event) {
         event.preventDefault();
         $("#modal_nuevo_ejercicio").modal('show');
         document.f_nuevo_ejercicio.codejercicio.focus();
      });
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <i class="fa fa-calendar" aria-hidden="true"></i>
               Ejercicios
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
               <span class="btn-group">
                  <a id="b_nuevo_ejercicio" class="btn btn-xs btn-success" href="#">
                     <span class="glyphicon glyphicon-plus"></span>
                     <span class="hidden-xs">&nbsp;Nuevo</span>
                  </a>
                  <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->type=='button' ){ ?>

                     <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-xs btn-default"><?php echo $value1->text;?></a>
                     <?php } ?>

                  <?php } ?>

               </span>
            </h1>
            <p class="help-block">
               Los ejercicios contables se crean conforme se necesitan. Si por ejemplo
               creas una factura para el 01-05-2017, se buscará el ejercicio que corresponda
               a esa fecha. Si no se encuentra se creará automáticamente.
            </p>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Código + Nombre</th>
                     <th class="text-center">Fecha de inicio</th>
                     <th class="text-center">Fecha fin</th>
                     <th class="text-right">Estado</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->ejercicio->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class="clickableRow<?php if( !$value1->abierto() ){ ?> warning<?php } ?>" href="<?php echo $value1->url();?>">
                  <td>
                     <a href="<?php echo $value1->url();?>"><?php echo $value1->codejercicio;?></a> <?php echo $value1->nombre;?>

                     <?php if( $value1->is_default() ){ ?>

                     &nbsp; <span class="label label-info">Predeterminado</span>
                     <?php } ?>

                  </td>
                  <td class="text-center"><?php echo $value1->fechainicio;?></td>
                  <td class="text-center"><?php echo $value1->fechafin;?></td>
                  <td class="text-right"><?php echo $value1->estado;?></td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="4">Sin resultados.</td>
               </tr>
               <?php } ?>

            </table>
         </div>
         <br/>
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">
                  <span class="glyphicon glyphicon-wrench"></span>&nbsp; Ejercicio predeterminado
               </h3>
            </div>
            <div class="panel-body">
               <form action="<?php echo $fsc->url();?>" method="post" class="form">
                  <div class="row">
                     <div class="col-sm-8">
                        <p class="help-block">
                           El ejercicio predeterminado solamente sirve para inicializar algunos datos,
                           apenas tiene uso. Las facturas, <?php  echo FS_ALBARANES;?>, etc determinan sus ejercicio
                           en función de la fecha. Pero de todas formas, si aun así quieres cambiar el
                           ejercicio predeterminado, usa este formulario:
                        </p>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <select name="predeterminado" class="form-control">
                           <?php $loop_var1=$fsc->ejercicio->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <?php if( $value1->is_default() ){ ?>

                              <option value="<?php echo $value1->codejercicio;?>" selected=""><?php echo $value1->nombre;?></option>
                              <?php }else{ ?>

                              <option value="<?php echo $value1->codejercicio;?>"><?php echo $value1->nombre;?></option>
                              <?php } ?>

                           <?php } ?>

                           </select>
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <button class="btn btn-sm btn-primary" type="submit">
                           <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<form class="form-horizontal" role="form" name="f_nuevo_ejercicio" action="<?php echo $fsc->url();?>" method="POST">
   <div class="modal" id="modal_nuevo_ejercicio">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nuevo ejercicio</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label class="col-sm-2 control-label">Código</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="codejercicio" value="<?php echo $fsc->ejercicio->get_new_codigo();?>" required="" maxlength="4" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="nombre" required="" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Fecha de inicio</label>
                  <div class="col-sm-10">
                     <input class="form-control datepicker" type="text" name="fechainicio" value="<?php echo $fsc->ejercicio->fechainicio;?>" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Fecha fin</label>
                  <div class="col-sm-10">
                     <input class="form-control datepicker" type="text" name="fechafin" value="<?php echo $fsc->ejercicio->fechafin;?>" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Estado</label>
                  <div class="col-sm-10">
                     <select name="estado" class="form-control">
                        <option value="ABIERTO">ABIERTO</option>
                        <option value="CERRADO">CERRADO</option>
                     </select>
                   </div>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
            </div>         
         </div>
      </div>
   </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>