<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header2") . ( substr("header2",-1,1) != "/" ? "/" : "" ) . basename("header2") );?>


<!--
Copyright (C) 2016-2017 Carlos García Gómez  <neorazorx at gmail.com>
Copyright (C) 2016      Joe Nilson           <joenilson at gmail.com>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<?php if( $fsc->cliente ){ ?>

<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title">Artículos en facturas de este cliente</h3>
   </div>
   <form class="form" role="form" action="<?php echo $fsc->url();?>" method="post">
      <div class="panel-body">
         <div class="row">
            <div class="col-sm-3">
               <div class="input-group">
                  <input class="form-control" type="text" name="query" value="<?php echo $fsc->query;?>" placeholder="Referencia" autocomplete="off"/>
                  <span class="input-group-btn">
                     <button class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                     </button>
                  </span>
               </div>
            </div>
            <div class="col-sm-2">
               <div class="form-group">
                  <input class="form-control" type="text" name="observaciones" value="<?php echo $fsc->observaciones;?>" placeholder="Observaciones" autocomplete="off"/>
               </div>
            </div>
            <div class="col-sm-7 text-right">
               <a class="btn btn-sm btn-default" onclick="window.print();">
                  <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
               </a>
            </div>
         </div>
      </div>
   </form>
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left text-capitalize">Factura</th>
               <th class="text-right">Cantidad</th>
               <th class="text-left">Artículo</th>
               <th class="text-right">Total+<?php  echo FS_IVA;?></th>
               <th class="text-right" width="90">Fecha</th>
            </tr>
         </thead>
         <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <tr<?php if( $value1->cantidad<=0 ){ ?> class="warning"<?php } ?>>
            <td>
               <a href="<?php echo $value1->url();?>" target="_blank" class="hidden-print"><?php echo $value1->show_codigo();?></a>
               <span class="visible-print"><?php echo $value1->show_codigo();?></span>
            </td>
            <td class="text-right"><?php echo $value1->cantidad;?></td>
            <td>
               <a href="<?php echo $value1->articulo_url();?>" target="_blank" class="hidden-print"><?php echo $value1->referencia;?></a>
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
</div>

<ul class="pager hidden-print">
   <?php if( $fsc->offset>0 ){ ?>

   <li class="previous">
      <a href="<?php echo $fsc->url();?>&query=<?php echo $fsc->query;?>&observaciones=<?php echo $fsc->observaciones;?>&offset=<?php echo $fsc->offset-FS_ITEM_LIMIT;?>">
         <span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Anteriores
      </a>
   </li>
   <?php } ?>

   <?php if( count($fsc->resultados)==FS_ITEM_LIMIT ){ ?>

   <li class="next">
      <a href="<?php echo $fsc->url();?>&query=<?php echo $fsc->query;?>&observaciones=<?php echo $fsc->observaciones;?>&offset=<?php echo $fsc->offset+FS_ITEM_LIMIT;?>">
         Siguientes &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
      </a>
   </li>
   <?php } ?>

</ul>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer2") . ( substr("footer2",-1,1) != "/" ? "/" : "" ) . basename("footer2") );?>