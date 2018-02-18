<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->articulo ){ ?>

<script type="text/javascript">
   function delete_traza(id)
   {
      bootbox.confirm({
         message: '¿Realmente desea eliminarlo?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = '<?php echo $fsc->url();?>&delete='+id;
            }
         }
      });
   }
   $(document).ready(function() {   
      $("#b_nueva_traza").click(function(event) {
         event.preventDefault();
         $("#modal_nueva_traza").modal('show');
         document.f_nueva_traza.numserie.focus();
      });
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <i class="fa fa-code-fork" aria-hidden="true"></i>
               Trazabilidad del artículo
               <small>
                  <a href="<?php echo $fsc->articulo->url();?>"><?php echo $fsc->articulo->referencia;?></a>
               </small>
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
               <a id="b_nueva_traza" class="btn btn-xs btn-success" href="#">
                  <span class="glyphicon glyphicon-plus"></span>
                  <span class="hidden-xs">&nbsp;Nuevo</span>
               </a>
            </h1>
            <p class="help-block"><?php echo $fsc->articulo->descripcion;?></p>
         </div>
      </div>
   </div>
</div>

<form class="form" name="f_nueva_traza" action="<?php echo $fsc->url();?>" method="post">
   <div class="modal" id="modal_nueva_traza">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nuevo...</h4>
               <p class="help-block">
                  Puedes dar de alta un número de serie y/o un lote. Puedes rellenar uno,
                  otro o ambos. Lo que necesites.
               </p>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Número de serie:
                  <input class="form-control" type="text" name="numserie" placeholder="opcional" maxlength="50" autocomplete="off"/>
               </div>
               <div class="form-group">
                  Lote:
                  <input class="form-control" type="text" name="lote" placeholder="opcional" maxlength="50" autocomplete="off"/>
               </div>
               <div class="form-group">
                  Fecha de entrada:
                  <div class="input-group">
                     <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                     <input class="form-control datepicker" type="text" name="fecha_entrada" value="<?php echo $fsc->today();?>" autocomplete="off"/>
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

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th>Número de serie</th>
            <th>Lote</th>
            <th></th>
            <th>Entrada</th>
            <th></th>
            <th>Salida</th>
            <th width="120" class="text-right">Acciones</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->trazas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <form action="<?php echo $fsc->url();?>" method="post" class="form">
         <tr<?php if( $value1->fecha_entrada && $value1->fecha_salida ){ ?> class="success"<?php } ?>>
            <td>
               <input type="hidden" name="id" value="<?php echo $value1->id;?>"/>
               <input class="form-control" type="text" name="numserie" value="<?php echo $value1->numserie;?>" maxlength="50" autocomplete="off"/>
            </td>
            <td>
               <input class="form-control" type="text" name="lote" value="<?php echo $value1->lote;?>" maxlength="50" autocomplete="off"/>
            </td>
            <td class="text-right">
               <?php if( $value1->idlalbcompra || $value1->idlfaccompra ){ ?>

               <a href="<?php echo $value1->documento_compra_url();?>" target="_blank" class="btn btn-sm btn-default" title="Ver documento de entrada">
                  <span class="glyphicon glyphicon-eye-open"></span>
               </a>
               <?php } ?>

            </td>
            <td>
               <?php if( $value1->idlalbcompra || $value1->idlfaccompra ){ ?>

               <div class="form-control"><?php echo $value1->fecha_entrada;?></div>
               <?php }else{ ?>

               <input type="text" name="fecha_entrada" value="<?php echo $value1->fecha_entrada;?>" class="form-control datepicker" autocomplete="off"/>
               <?php } ?>

            </td>
            <td class="text-right">
               <?php if( $value1->idlalbventa || $value1->idlfacventa ){ ?>

               <a href="<?php echo $value1->documento_venta_url();?>" target="_blank" class="btn btn-sm btn-default" title="Ver documento de salida">
                  <span class="glyphicon glyphicon-eye-open"></span>
               </a>
               <?php } ?>

            </td>
            <td>
               <div class="form-control"><?php echo $value1->fecha_salida;?></div>
            </td>
            <td class="text-right">
               <div class="btn-group">
                  <?php if( $fsc->allow_delete ){ ?>

                  <a class="btn btn-sm btn-danger" title="Eliminar" onclick="delete_traza('<?php echo $value1->id;?>')">
                     <span class="glyphicon glyphicon-trash"></span>
                  </a>
                  <?php } ?>

                  <button class="btn btn-sm btn-primary" type="submit" title="Guardar" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                  </button>
               </div>
            </td>
         </tr>
      </form>
      <?php }else{ ?>

      <tr class="warning">
         <td colspan="7">Sin resultados.</td>
      </tr>
      <?php } ?>

   </table>
</div>
<?php }else{ ?>

<div class="thumbnail">
   <img src="<?php  echo FS_PATH;?>view/img/fuuu_face.png" alt="fuuuuu"/>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>

