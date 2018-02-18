<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->url_recarga ){ ?>

<script type="text/javascript">
   function recargar()
   {
      window.location.href = '<?php echo $fsc->url_recarga;?>';
   }
   $(document).ready(function()
   {
      setTimeout(recargar, 1000);
   });
</script>
<?php } ?>


<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <i class="fa fa-area-chart" aria-hidden="true"></i> Informe de artículos
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
               <span class="btn-group">
               <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->type=='button' ){ ?>

                  <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-xs btn-default"><?php echo $value1->text;?></a>
                  <?php } ?>

               <?php } ?>

               </span>
            </h1>
         </div>
         <ul class="nav nav-tabs">
            <li role="presentation"<?php if( $fsc->pestanya=='stats' ){ ?> class="active"<?php } ?>>
               <a href="<?php echo $fsc->url();?>">
                  <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
                  <span class="hidden-xs">&nbsp;Estadísticas</span>
               </a>
            </li>
            <li role="presentation"<?php if( $fsc->pestanya=='stock' ){ ?> class="active"<?php } ?>>
               <a href="<?php echo $fsc->url();?>&tab=stock">
                  <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                  <span class="hidden-xs">&nbsp;Stock</span>
               </a>
            </li>
            <li role="presentation"<?php if( $fsc->pestanya=='impuestos' ){ ?> class="active"<?php } ?>>
               <a href="<?php echo $fsc->url();?>&tab=impuestos">
                  <span class="glyphicon glyphicon-magnet" aria-hidden="true"></span>
                  <span class="hidden-xs">&nbsp;Impuestos</span>
               </a>
            </li>
            <li role="presentation"<?php if( $fsc->pestanya=='varios' ){ ?> class="active"<?php } ?>>
               <a href="<?php echo $fsc->url();?>&tab=varios">
                  <span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>
                  <span class="hidden-xs">&nbsp;Varios</span>
               </a>
            </li>
         </ul>
      </div>
   </div>
</div>

<?php if( $fsc->pestanya=='stats' ){ ?>

<br/>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <p class="help-block">
            Hay un total de <b><?php echo $fsc->show_numero($fsc->stats['total'], 0);?></b> artículos,
            <b><?php echo $fsc->show_numero($fsc->stats['con_stock'], 0);?></b> de ellos tienen stock,
            <b><?php echo $fsc->show_numero($fsc->stats['publicos'], 0);?></b> son públicos
            y <b><?php echo $fsc->show_numero($fsc->stats['bloqueados'], 0);?></b> están bloqueados.
            La última actualización de precio de un artículo es del <b><?php echo $fsc->stats['factualizado'];?></b>.
         </p>
         <div class="panel panel-info">
            <div class="panel-heading">
               <h3 class="panel-title">Top ventas</h3>
            </div>
            <form action="<?php echo $fsc->url();?>" method="post" class="form">
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-2">
                        <div class="input-group">
                           <span class="input-group-addon">Desde</span>
                           <input type="text" name="desde" value="<?php echo $fsc->desde;?>" class="form-control datepicker" autocomplete="off" onchange="this.form.submit()"/>
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="input-group">
                           <span class="input-group-addon">Hasta</span>
                           <input type="text" name="hasta" value="<?php echo $fsc->hasta;?>" class="form-control datepicker" autocomplete="off" onchange="this.form.submit()"/>
                        </div>
                     </div>
                     <div class="col-sm-8 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">
                           <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                           <span class="hidden-xs">&nbsp; Buscar</span>
                        </button>
                     </div>
                  </div>
               </div>
            </form>
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>Referencia + Descripción</th>
                        <th class="text-right">Vendido</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Beneficio</th>
                     </tr>
                  </thead>
                  <?php $loop_var1=$fsc->top_ventas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <tr class='clickableRow<?php if( $value1['articulo']->bloqueado ){ ?> danger<?php } ?>' href="<?php echo $value1['articulo']->url();?>">
                     <td>
                        <a href="<?php echo $value1['articulo']->url();?>"><?php echo $value1['articulo']->referencia;?></a>
                        <?php echo $value1['articulo']->descripcion();?>

                     </td>
                     <td class="text-right"><?php echo $fsc->show_numero($value1['unidades']);?></td>
                     <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                     <?php if( $value1['beneficio']>0 ){ ?>

                     <td class='text-right success'><?php echo $fsc->show_precio($value1['beneficio']);?></td>
                     <?php }else{ ?>

                     <td class='text-right danger'><?php echo $fsc->show_precio($value1['beneficio']);?></td>
                     <?php } ?>

                  </tr>
                  <?php }else{ ?>

                  <tr class="warning">
                     <td colspan="4">Sin resultados.</td>
                  </tr>
                  <?php } ?>

               </table>
            </div>
         </div>
         <div class="panel panel-warning">
            <div class="panel-heading">
               <h3 class="panel-title">Top artículos con stock aun no vendidos este año</h3>
            </div>
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>Referencia + descripción</th>
                        <th class="text-right">Stock</th>
                        <th></th>
                        <th>Referencia + descripción</th>
                        <th class="text-right">Stock</th>
                        <th></th>
                        <th>Referencia + descripción</th>
                        <th class="text-right">Stock</th>
                     </tr>
                  </thead>
                  <!--<?php $num=$this->var['num']=1;?>-->
                  <?php $loop_var1=$fsc->sin_vender; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $num==1 ){ ?><tr><?php } ?>

                        <td>
                           <a href="<?php echo $value1->url();?>"><?php echo $value1->referencia;?></a>
                           <?php echo $value1->descripcion();?>

                        </td>
                        <td class="text-right"><?php echo $value1->stockfis;?></td>
                     <?php if( $num==3 ){ ?>

                        </tr><!--<?php $num=$this->var['num']=1;?>-->
                     <?php }else{ ?>

                        <td class="warning"></td><!--<?php $num=$this->var['num']=$num+1;?>-->
                     <?php } ?>

                  <?php }else{ ?>

                  <tr class="warning">
                     <td colspan="8">Sin resultados.</td>
                  </tr>
                  <?php } ?>

                  <?php if( $num==2 ){ ?>

                  <td colspan="5" class="warning"></td></tr>
                  <?php }elseif( $num==3 ){ ?>

                  <td colspan="2"></td></tr>
                  <?php } ?>

               </table>
            </div>
         </div>
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">Top compras del <?php echo $fsc->desde;?> al <?php echo $fsc->hasta;?></h3>
            </div>
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>Referencia + descripción</th>
                        <th class="text-right">Unidades</th>
                        <th></th>
                        <th>Referencia + descripción</th>
                        <th class="text-right">Unidades</th>
                        <th></th>
                        <th>Referencia + descripción</th>
                        <th class="text-right">Unidades</th>
                     </tr>
                  </thead>
                  <!--<?php $num=$this->var['num']=1;?>-->
                  <?php $loop_var1=$fsc->top_compras; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $num==1 ){ ?><tr><?php } ?>

                        <td>
                           <a href="<?php echo $value1["0"]->url();?>"><?php echo $value1["0"]->referencia;?></a>
                           <?php echo $value1["0"]->descripcion();?>

                        </td>
                        <td class="text-right"><?php echo $value1["1"];?></td>
                     <?php if( $num==3 ){ ?>

                        </tr><!--<?php $num=$this->var['num']=1;?>-->
                     <?php }else{ ?>

                        <td class="warning"></td><!--<?php $num=$this->var['num']=$num+1;?>-->
                     <?php } ?>

                  <?php }else{ ?>

                  <tr class="warning">
                     <td colspan="8">Sin resultados.</td>
                  </tr>
                  <?php } ?>

                  <?php if( $num==2 ){ ?>

                  <td colspan="5" class="warning"></td></tr>
                  <?php }elseif( $num==3 ){ ?>

                  <td colspan="2"></td></tr>
                  <?php } ?>

               </table>
            </div>
         </div>
         <?php if( $fsc->user->admin ){ ?>

         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">Búsquedas de artículos</h3>
            </div>
            <div class="panel-body">
               <div class="container-fluid">
                  <div class="row">
                     <?php $loop_var1=$fsc->articulo->get_search_tags(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <div class="col-sm-3"><?php echo $value1['tag'];?> (<?php echo $value1['count'];?>)</div>
                     <?php }else{ ?>

                     <div class="col-sm-12">Ninguna búsqueda realizada.</div>
                     <?php } ?>

                  </div>
               </div>
            </div>
         </div>
         <?php } ?>

      </div>
   </div>
</div>
<?php }elseif( $fsc->pestanya=='stock' ){ ?>

<br/>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-6">
         <div class="btn-group">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <?php if( $fsc->codalmacen ){ ?>

                  <?php $loop_var1=$fsc->almacenes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codalmacen==$fsc->codalmacen ){ ?>

                        <?php echo $value1->nombre;?>&nbsp;<span class="caret"></span>
                     <?php } ?>

                  <?php } ?>

               <?php }else{ ?>

                  Todos los almacenes&nbsp; <span class="caret"></span>               
               <?php } ?>

            </button>
            <ul class="dropdown-menu">
               <li><a href="<?php echo $fsc->url();?>&tipo=<?php echo $fsc->tipo_stock;?>&tab=stock">Todos</a></li>
               <li role="separator" class="divider"></li>
               <?php $loop_var1=$fsc->almacenes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <li><a href="<?php echo $fsc->url();?>&tipo=<?php echo $fsc->tipo_stock;?>&tab=stock&codalmacen=<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></a></li>
               <?php } ?>

            </ul>
         </div>
         <div class="btn-group">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <?php if( $fsc->tipo_stock=='todo' ){ ?>

                  Todo <span class="caret"></span>
               <?php }elseif( $fsc->tipo_stock=='min' ){ ?>

                  Bajo mínimos <span class="caret"></span>
               <?php }elseif( $fsc->tipo_stock=='max' ){ ?>

                  Excesos <span class="caret"></span>
               <?php }else{ ?>

                  Regularizaciones <span class="caret"></span>
               <?php } ?>

            </button>
            <ul class="dropdown-menu">
               <?php if( $fsc->tipo_stock!='todo' ){ ?>

               <li><a href="<?php echo $fsc->url();?>&codalmacen=<?php echo $fsc->codalmacen;?>&tab=stock">Todo</a></li>
               <?php } ?>

               <?php if( $fsc->tipo_stock!='min' ){ ?>

               <li><a href="<?php echo $fsc->url();?>&codalmacen=<?php echo $fsc->codalmacen;?>&tab=stock&tipo=min">Bajo mínimos</a></li>
               <?php } ?>

               <?php if( $fsc->tipo_stock!='max' ){ ?>

               <li><a href="<?php echo $fsc->url();?>&codalmacen=<?php echo $fsc->codalmacen;?>&tab=stock&tipo=max">Excesos</a></li>
               <?php } ?>

               <?php if( $fsc->tipo_stock!='reg' ){ ?>

               <li><a href="<?php echo $fsc->url();?>&codalmacen=<?php echo $fsc->codalmacen;?>&tab=stock&tipo=reg">Regularizaciones</a></li>
               <?php } ?>

            </ul>
         </div>
      </div>
      <div class="col-sm-6 text-right">
         <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal_recal_stock">
            <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp;Recalcular stock</span>
         </a>
         <?php if( $fsc->tipo_stock!='reg' ){ ?>

            <div class="btn-group">
               <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                  <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                  <span class="hidden-xs">&nbsp;Descargar</span>
               </button>
               <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                     <a href="<?php echo $fsc->url();?>&codalmacen=<?php echo $fsc->codalmacen;?>&tab=stock&tipo=<?php echo $fsc->tipo_stock;?>&download=csv">
                        <i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp; Descargar en CSV
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo $fsc->url();?>&codalmacen=<?php echo $fsc->codalmacen;?>&tab=stock&tipo=<?php echo $fsc->tipo_stock;?>&download=xls">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp; Descargar en Excel
                     </a>
                  </li>
               </ul>
            </div>
         <?php } ?>

      </div>
   </div>
</div>
<br/>
<div class="table-responsive">
   <?php if( $fsc->tipo_stock=='reg' ){ ?>

   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Almacén</th>
            <th class="text-left">Artículo</th>
            <th class="text-right">Cant. inicial</th>
            <th class="text-right">Cant. final</th>
            <th class="text-left">Usuario</th>
            <th class="text-left">Motivo</th>
            <th class="text-right">Fecha</th>
            <th class="text-right">Hora</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <tr class="clickableRow<?php if( intval($value1['cantidadfin'])<intval($value1['cantidadini']) ){ ?> danger<?php } ?>" href="index.php?page=ventas_articulo&ref=<?php echo $value1['referencia'];?>">
            <td><?php echo $value1['codalmacen'];?></td>
            <td>
               <a href="index.php?page=ventas_articulo&ref=<?php echo $value1['referencia'];?>"><?php echo $value1['referencia'];?></a>
               <?php echo mb_substr($value1['descripcion'], 0, 100); ?>

            </td>
            <td class="text-right"><?php echo $value1['cantidadini'];?></td>
            <td class="text-right"><?php echo $value1['cantidadfin'];?></td>
            <td><?php echo $value1['nick'];?></td>
            <td><?php echo $value1['motivo'];?></td>
            <td class="text-right"><?php echo $value1['fecha'];?></td>
            <td class="text-right"><?php echo $value1['hora'];?></td>
         </tr>
      <?php }else{ ?>

         <tr class="warning">
            <td colspan="8">Sin resultados.</td>
         </tr>
      <?php } ?>

   </table>
   <?php }else{ ?>

   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Almacén</th>
            <th class="text-left">Artículo</th>
            <th class="text-right">Stock</th>
            <th class="text-right">Mínimo</th>
            <th class="text-right">Máximo</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <tr class="clickableRow<?php if( intval($value1['cantidad'])<intval($value1['stockmin']) ){ ?> danger<?php } ?>" href="index.php?page=ventas_articulo&ref=<?php echo $value1['referencia'];?>">
            <td><?php echo $value1['codalmacen'];?></td>
            <td>
               <a href="index.php?page=ventas_articulo&ref=<?php echo $value1['referencia'];?>"><?php echo $value1['referencia'];?></a>
               <?php echo mb_substr($value1['descripcion'], 0, 100); ?>

            </td>
            <td class="text-right"><?php echo $value1['cantidad'];?></td>
            <td class="text-right"><?php echo $value1['stockmin'];?></td>
            <td class="text-right"><?php echo $value1['stockmax'];?></td>
            </tr>
      <?php }else{ ?>

         <tr class="warning">
            <td colspan="5">Sin resultados.</td>
         </tr>
      <?php } ?>

   </table>
   <?php } ?>

</div>
<ul class="pager" id="ul_paginador">
   <?php if( $fsc->anterior_url()!='' ){ ?>

      <li class="previous">
         <a href="<?php echo $fsc->anterior_url();?>">
            <span class="glyphicon glyphicon-chevron-left"></span> &nbsp; Anteriores
         </a>
      </li>
   <?php } ?>

   <?php if( $fsc->siguiente_url()!='' ){ ?>

      <li class="next">
         <a href="<?php echo $fsc->siguiente_url();?>">
            Siguientes &nbsp; <span class="glyphicon glyphicon-chevron-right"></span>
         </a>
      </li>
   <?php } ?>

</ul>

<div class="modal fade" id="modal_recal_stock" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Recalcular stock</h4>
         </div>
         <div class="modal-body">
            <p class='help-block'>
               Se recalculará el stock de todos los artículos a partir de las
               regularizaciones (de stock) y los albaranes y facturas de compra
               y venta.
            </p>
            <p class='help-block'>
               <b>Advertencia</b>: si el artículo no tiene ningún movimiento,
               ni regularización, el stock resultante <b>será 0</b>.
            </p>
         </div>
         <div class="modal-footer">
             <a href="<?php echo $fsc->url();?>&tab=stock&recalcular=TRUE" class="btn btn-sm btn-warning">
               <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
               <span class="hidden-xs">&nbsp;Recalcular stock</span>
            </a>
         </div>
      </div>
   </div>
</div>
<?php }elseif( $fsc->pestanya=='impuestos' ){ ?>

<br/>
<form action="<?php echo $fsc->url();?>&tab=impuestos" method="post" class="form">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-3">
            <div class="form-group">
               <a href="<?php echo $fsc->impuesto->url();?>">Impuesto</a>
               <select name="codimpuesto" class="form-control" onchange="this.form.submit()">
                  <?php $loop_var1=$fsc->impuesto->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codimpuesto==$fsc->codimpuesto ){ ?>

                     <option value="<?php echo $value1->codimpuesto;?>" selected=""><?php echo $value1->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codimpuesto;?>"><?php echo $value1->descripcion;?></option>
                     <?php } ?>

                  <?php } ?>

                  <option value="">------</option>
                  <?php if( $fsc->codimpuesto=='' ){ ?>

                  <option value="" selected="">Sin impuesto</option>
                  <?php }else{ ?>

                  <option value="">Sin impuesto</option>
                  <?php } ?>

               </select>
            </div>
         </div>
         <div class="col-sm-2">
            <br/>
            <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
               <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Mostrar
            </button>
         </div>
         <div class="col-sm-4"></div>
         <div class="col-sm-3">
            <div class="form-group">
               Cambiar a
               <select name="new_codimpuesto" class="form-control" onchange="this.form.submit()">
                  <option value="">(Sin cambios)</option>
                  <option value="">------</option>
                  <?php $loop_var1=$fsc->impuesto->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <option value="<?php echo $value1->codimpuesto;?>"><?php echo $value1->descripcion;?></option>
                  <?php } ?>

               </select>
            </div>
         </div>
      </div>
   </div>
</form>
<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Familia</th>
            <th class="text-left">Fabricante</th>
            <th class="text-left">Referencia + Descripción</th>
            <th class="text-right">Precio</th>
            <th class="text-right">Impuesto</th>
            <th class="text-right">Precio+<?php  echo FS_IVA;?></th>
            <th class="text-right">Stock</th>
            <th class="text-right"></th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class='clickableRow<?php if( $value1->bloqueado ){ ?> danger<?php }elseif( $value1->stockfis<=$value1->stockmin ){ ?> warning<?php } ?>' href='<?php echo $value1->url();?>'>
         <td>
            <?php if( is_null($value1->codfamilia) ){ ?>

               <span>-</span>
            <?php }else{ ?>

               <?php echo $value1->codfamilia;?>

               <a href="index.php?page=ventas_familia&cod=<?php echo $value1->codfamilia;?>" class="cancel_clickable" title="Ver más artículos de esta familia">[+]</a>
            <?php } ?>

         </td>
         <td>
            <?php if( is_null($value1->codfabricante) ){ ?>

               <span>-</span>
            <?php }else{ ?>

               <?php echo $value1->codfabricante;?>

               <a href="index.php?page=ventas_fabricante&cod=<?php echo $value1->codfabricante;?>" class="cancel_clickable" title="Ver más artículos de este fabricante">[+]</a>
            <?php } ?>

         </td>
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->referencia;?></a> <?php echo $value1->descripcion;?></td>
         <td class="text-right"><span title="actualizado el <?php echo $value1->factualizado;?>"><?php echo $fsc->show_precio($value1->pvp);?></span></td>
         <td class="text-right info"><?php echo $value1->codimpuesto;?></td>
         <td class="text-right"><span title="actualizado el <?php echo $value1->factualizado;?>"><?php echo $fsc->show_precio($value1->pvp_iva());?></span></td>
         <td class="text-right">
            <?php if( $value1->nostock ){ ?>-<?php }else{ ?><?php echo $value1->stockfis;?><?php } ?>

         </td>
         <td class="text-right">
            <?php if( $value1->publico ){ ?>

            <span class="glyphicon glyphicon-globe" aria-hidden="true" title="Artículo público"></span>
            <?php } ?>

         </td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td colspan="8">Ningun artículo encontrado.</td>
      </tr>
      <?php } ?>

   </table>
</div>
<?php }elseif( $fsc->pestanya=='varios' ){ ?>

<script type="text/javascript">
   $(document).ready(function () {
      $("#ac_referencia").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_referencia',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if( $("#ac_referencia").val() != suggestion.data)
               {
                  $("#ac_referencia").val(suggestion.data);
               }
            }
         }
      });
      $("#ac_referencia2").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_referencia',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if( $("#ac_referencia2").val() != suggestion.data)
               {
                  $("#ac_referencia2").val(suggestion.data);
               }
            }
         }
      });
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <?php if( $fsc->resultados ){ ?>

         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th>Referencia</th>
                     <th>Almacén</th>
                     <th>Documento</th>
                     <th>Cliente/Proveedor</th>
                     <th class="text-right">Movimiento</th>
                     <th class="text-right">Precio</th>
                     <th class="text-right">%Dto.</th>
                     <th class="text-right">Cantidad final</th>
                     <th class="text-right">Fecha</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class="clickableRow" href="<?php echo $value1['url'];?>">
                  <td><?php echo $value1['referencia'];?></td>
                  <td><?php echo $value1['codalmacen'];?></td>
                  <td><a href="<?php echo $value1['url'];?>"><?php echo $value1['origen'];?></a></td>
                  <td><?php echo $value1['clipro'];?></td>
                  <td class="text-right"><?php echo $fsc->show_numero($value1['movimiento']);?></td>
                  <td class="text-right"><?php echo $fsc->show_precio($value1['precio']);?></td>
                  <td class="text-right"><?php echo $fsc->show_numero($value1['dto']);?></td>
                  <td class='text-right<?php if( $value1['final']<0 ){ ?> danger<?php } ?>'><?php echo $fsc->show_numero($value1['final']);?></td>
                  <td class="text-right"><?php echo $value1['fecha'];?></td>
               </tr>
               <?php } ?>

            </table>
         </div>
         <?php } ?>

         <br/>
         <p class="help-block">
            Aquí dispones de varios informes para consultar el listado de movimientos
            de un artículo, las compras o ventas de artículos en un determinado periodo
            o el desglose de ventas a clientes por artículo. Elige el que necesites
            y ajusta los filtros a tus necesidades.
         </p>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-4">
         <form name="f_listado_mov" action="<?php echo $fsc->url();?>&tab=varios" method="post" class="form">
            <input type="hidden" name="informe" value="listadomov"/>
            <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="glyphicon glyphicon-transfer"></span>
                        &nbsp; Listado de movimientos
                     </h3>
                  </div>
                  <div class="panel-body">
                     <p class="help-block">
                        Genera un listado de movimientos de stock del artículo seleccionado
                        a partir de las regularizaciones de stock, los <?php  echo FS_ALBARANES;?>

                        y las facturas de compra y de venta.
                     </p>
                     <p class="help-block">
                        También dispones del <b>plugin kardex</b> para obtener un listado
                        de inventario valorado.
                     </p>
                     <div class="form-group">
                        Referencia:
                        <input class="form-control" type="text" name="referencia" value="<?php echo $fsc->referencia;?>" id="ac_referencia" maxlength="18" placeholder="referencia" autocomplete="off"/>
                        <p class="help-block">
                           Dejar en blanco para filtrar por familia.
                        </p>
                     </div>
                     <div class="form-group">
                        Familia:
                        <select class="form-control" name="codfamilia">
                           <option value="">Todas las familias</option>
                           <option value="">-----</option>
                           <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codfamilia==$fsc->codfamilia ){ ?>

                           <option value="<?php echo $value1->codfamilia;?>" selected=""><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                     <div class="form-group">
                        Desde:
                        <input class="form-control datepicker" type="text" name="desde" value="<?php echo $fsc->desde;?>"/>
                     </div>
                     <div class="form-group">
                        Hasta:
                        <input class="form-control datepicker" type="text" name="hasta" value="<?php echo $fsc->hasta;?>"/>
                     </div>
                     <div class="form-group">
                        <a href="<?php echo $fsc->agente->url();?>">Empleado</a>:
                        <select name="codagente" class="form-control">
                           <option value="">Todos</option>
                           <option value="">---</option>
                           <?php $loop_var1=$fsc->agente->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codagente==$fsc->codagente ){ ?>

                           <option value="<?php echo $value1->codagente;?>" selected=""><?php echo $value1->get_fullname();?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codagente;?>"><?php echo $value1->get_fullname();?></option>
                           <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                     <div class="form-group">
                        Almacén:
                        <select name="codalmacen" class="form-control">
                           <option value="">Todos</option>
                           <option value="">---</option>
                           <?php $loop_var1=$fsc->almacenes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codalmacen==$fsc->codalmacen ){ ?>

                           <option value="<?php echo $value1->codalmacen;?>" selected=""><?php echo $value1->nombre;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                     <div class="form-group">
                        Salida:
                        <select name="generar" class="form-control">
                           <option value="">Pantalla</option>
                           <option value="csv">CSV</option>
                           <option value="xls">Excel</option>
                        </select>
                     </div>
                  </div>
                  <div class="panel-footer">
                     <button class="btn btn-sm btn-primary" type="submit">
                        <span class="glyphicon glyphicon-eye-open"></span>&nbsp; Mostrar
                     </button>
                  </div>
            </div>
         </form>
      </div>
      <div class="col-sm-4">
         <form action="<?php echo $fsc->url();?>&tab=varios" method="post" class="form">
               <input type="hidden" name="informe" value="facturacion"/>
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="glyphicon glyphicon-duplicate"></span>
                        &nbsp; Informe de facturación
                     </h3>
                  </div>
                  <div class="panel-body">
                     <p class="help-block">
                        Genera un informe de compras o ventas desglosado por artículo, año y mes.
                     </p>
                     <div class="form-group">
                        Analizar:
                        <select name="documento" class="form-control" onchange="this.form.submit();">
                           <option value="facturasprov"<?php if( $fsc->documento=='facturasprov' ){ ?> selected=""<?php } ?>>Compras</option>
                           <option value="facturascli"<?php if( $fsc->documento=='facturascli' ){ ?> selected=""<?php } ?>>Ventas</option>
                        </select>
                     </div>
                     <div class="radio">
                        <label>
                           <input type="radio" name="cantidades" value="FALSE"<?php if( !$fsc->cantidades ){ ?> checked=""<?php } ?>/>
                           Importes
                        </label>
                     </div>
                     <div class="radio">
                        <label>
                           <input type="radio" name="cantidades" value="TRUE"<?php if( $fsc->cantidades ){ ?> checked=""<?php } ?>/>
                           Unidades
                        </label>
                     </div>
                     <div class="form-group">
                        Desde:
                        <input class="form-control datepicker" type="text" name="desde" value="<?php echo $fsc->desde;?>"/>
                     </div>
                     <div class="form-group">
                        Hasta:
                        <input class="form-control datepicker" type="text" name="hasta" value="<?php echo $fsc->hasta;?>"/>
                     </div>
                     <div class="form-group">
                        Familia:
                        <select class="form-control" name="codfamilia">
                           <option value="">Todas las familias</option>
                           <option value="">-----</option>
                           <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codfamilia==$fsc->codfamilia ){ ?>

                           <option value="<?php echo $value1->codfamilia;?>" selected=""><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                     <div class="form-group">
                        Mínimo:
                        <input class="form-control" type="text" name="minimo" value="<?php echo $fsc->minimo;?>" autocomplete="off" placeholder="importe o unidades (opcional)"/>
                     </div>
                  </div>
                  <div class="panel-footer">
                     <button class="btn btn-sm btn-primary" type="submit">
                        <span class="glyphicon glyphicon-eye-open"></span>&nbsp; Mostrar
                     </button>
                  </div>
               </div>
         </form>
      </div>
      <div class="col-sm-4">
         <form name="f_informe_ventas" action="<?php echo $fsc->url();?>&tab=varios" method="post" class="form">
               <input type="hidden" name="informe" value="ventascli"/>
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="glyphicon glyphicon-search"></span>
                        &nbsp; Desglose de ventas por artículo
                     </h3>
                  </div>
                  <div class="panel-body">
                     <p class="help-block">
                        Genera un listado con los clientes que han comprado un determinado
                        artículo en un periodo y lo desglosa por cliente, año y mes.
                     </p>
                     <div class="form-group">
                        Referencia:
                        <input class="form-control" type="text" name="referencia" value="<?php echo $fsc->referencia;?>" id="ac_referencia2" maxlength="18" placeholder="referencia" autocomplete="off"/>
                        <p class="help-block">
                           Dejar en blanco para filtrar por familia.
                        </p>
                     </div>
                     <div class="form-group">
                        Familia:
                        <select class="form-control" name="codfamilia">
                           <option value="">Todas las familias</option>
                           <option value="">-----</option>
                           <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codfamilia==$fsc->codfamilia ){ ?>

                           <option value="<?php echo $value1->codfamilia;?>" selected=""><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                     <div class="form-group">
                        Desde:
                        <input class="form-control datepicker" type="text" name="desde" value="<?php echo $fsc->desde;?>"/>
                     </div>
                     <div class="form-group">
                        Hasta:
                        <input class="form-control datepicker" type="text" name="hasta" value="<?php echo $fsc->hasta;?>"/>
                     </div>
                     <div class="form-group">
                        Mínimo:
                        <input class="form-control" type="text" name="minimo" value="<?php echo $fsc->minimo;?>" autocomplete="off" placeholder="unidades (opcional)"/>
                     </div>
                  </div>
                  <div class="panel-footer">
                     <button class="btn btn-sm btn-primary" type="submit">
                        <span class="glyphicon glyphicon-eye-open"></span>&nbsp; Mostrar
                     </button>
                  </div>
               </div>
         </form>
      </div>
   </div>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>