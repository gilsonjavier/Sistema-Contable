<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->documento ){ ?>

<script type="text/javascript">
   var fixHelper = function(e, ui) {
      ui.children().each(function() {
         $(this).width($(this).width());
      });
      return ui;
   };
   
   $(document).ready(function () {
      $("#sortable tbody").sortable({
         helper: fixHelper
      }).disableSelection();
   });
</script>

<div class="container-fluid">
   <form action="<?php echo $fsc->url();?>" method="post" class="form">
      <div class="row">
         <div class="col-xs-6">
            <div class="btn-group">
               <a class="btn btn-sm btn-default" href="<?php echo $fsc->documento->url();?>">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp; Volver</span>
               </a>
               <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </div>
         </div>
         <div class="col-xs-6 text-right">
            <button class="btn btn-sm btn-primary" type="button" onclick="this.disabled = true;this.form.submit();">
               <span class="glyphicon glyphicon-floppy-disk"></span>
               <span class="hidden-xs">&nbsp; Guardar</span>
            </button>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <div class="page-header">
               <h1>
                  <i class="fa fa-magic"></i>
                  Maquetar
                  <small class="text-capitalize"><?php echo $fsc->titulo;?></small>
                  <?php if( !$fsc->editable ){ ?>

                  <span class="btn btn-xs btn-danger">no editable</span>
                  <?php } ?>

               </h1>
               <p class="help-block">
                  Mueve libremente las líneas del documento y desactiva las columnas que quieras.
                  Cuando esté a tu gusto, pulsa guardar.
               </p>
            </div>
            <div class="table-responsive">
               <table id="sortable" class="table table-hover">
                  <thead>
                     <tr>
                        <th></th>
                        <th>Referencia + descripción</th>
                        <th class="text-center">Mostrar cantidad</th>
                        <th class="text-center">Mostrar precio y total</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $loop_var1=$fsc->lineas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <tr<?php if( !$value1->mostrar_precio ){ ?> class="warning"<?php } ?> style="cursor: pointer;">
                        <td><span class="glyphicon glyphicon-resize-vertical"></span></td>
                        <td>
                           <input type="hidden" name="idlinea[]" value="<?php echo $value1->idlinea;?>"/>
                           <b><?php echo $value1->referencia;?></b> <?php echo $value1->descripcion();?>

                        </td>
                        <td class="text-center" title="mostrar cantidad">
                           <?php if( $value1->mostrar_cantidad ){ ?>

                           <input type="checkbox" name="mostrar_cantidad_<?php echo $value1->idlinea;?>" value="TRUE" checked=""/>
                           <?php }else{ ?>

                           <input type="checkbox" name="mostrar_cantidad_<?php echo $value1->idlinea;?>" value="TRUE"/>
                           <?php } ?>

                        </td>
                        <td class="text-center" title="mostrar precio y total">
                           <?php if( $value1->mostrar_precio ){ ?>

                           <input type="checkbox" name="mostrar_precio_<?php echo $value1->idlinea;?>" value="TRUE" checked=""/>
                           <?php }else{ ?>

                           <input type="checkbox" name="mostrar_precio_<?php echo $value1->idlinea;?>" value="TRUE"/>
                           <?php } ?>

                        </td>
                     </tr>
                     <?php } ?>

                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xs-6">
            <a href="<?php echo $fsc->url();?>" class="btn btn-sm btn-default">
               <span class="glyphicon glyphicon-refresh"></span>&nbsp; Deshacer
            </a>
         </div>
         <div class="col-xs-6 text-right">
            <button class="btn btn-sm btn-primary" type="button" onclick="this.disabled = true;this.form.submit();">
               <span class="glyphicon glyphicon-floppy-disk"></span>
               <span class="hidden-xs">&nbsp; Guardar</span>
            </button>
         </div>
      </div>
   </form>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>