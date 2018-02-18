<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <span class="glyphicon glyphicon-duplicate"></span>&nbsp;
               Facturas con el artículo
               <small>
                  <a href="<?php echo $fsc->articulo->url();?>"><?php echo $fsc->articulo->referencia;?></a>
               </small>
            </h1>
         </div>
      </div>
   </div>
</div>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Factura + Cliente</th>
            <th class="text-right">Cantidad</th>
            <th class="text-left">Artículo</th>
            <th class="text-right">Total+<?php  echo FS_IVA;?></th>
            <th class="text-right">Fecha</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow<?php if( $value1->cantidad<1 ){ ?> warning<?php } ?>" href="<?php echo $value1->url();?>">
         <td>
            <a href="<?php echo $value1->url();?>"><?php echo $value1->show_codigo();?></a>
            <?php echo $value1->show_nombrecliente();?>

         </td>
         <td class="text-right"><?php echo $value1->cantidad;?></td>
         <td>
            <a href="<?php echo $value1->articulo_url();?>" class="cancel_clickable"><?php echo $value1->referencia;?></a>
            <?php echo $value1->descripcion;?>

         </td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->total_iva());?></td>
         <td class="text-right"><?php echo $value1->show_fecha();?></td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td colspan="5">Sin resultados.</td>
      </tr>
      <?php } ?>

   </table>
</div>

<ul class="pager">
   <?php if( $fsc->offset>0 ){ ?>

   <li class="previous">
      <a href="<?php echo $fsc->url();?>&ref=<?php echo $fsc->articulo->referencia;?>&offset=<?php echo $fsc->offset-FS_ITEM_LIMIT;?>">
         <span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Anteriores
      </a>
   </li>
   <?php } ?>

   <?php if( count($fsc->resultados)==FS_ITEM_LIMIT ){ ?>

   <li class="next">
      <a href="<?php echo $fsc->url();?>&ref=<?php echo $fsc->articulo->referencia;?>&offset=<?php echo $fsc->offset+FS_ITEM_LIMIT;?>">
         Siguientes &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
      </a>
   </li>
   <?php } ?>

</ul>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>