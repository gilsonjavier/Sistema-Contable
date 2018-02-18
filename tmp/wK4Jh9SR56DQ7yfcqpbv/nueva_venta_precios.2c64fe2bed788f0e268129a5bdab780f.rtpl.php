<?php if(!class_exists('raintpl')){exit;}?><?php if( $fsc->get_errors() ){ ?>

<div class="alert alert-danger">
   <ul><?php $loop_var1=$fsc->get_errors(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
</div>
<?php } ?>

<?php if( $fsc->get_messages() ){ ?>

<div class="alert alert-success">
   <ul><?php $loop_var1=$fsc->get_messages(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
</div>
<?php } ?>


<?php if( $fsc->articulo ){ ?>


<?php $equivalentes=$this->var['equivalentes']=$fsc->articulo->get_equivalentes();?>

<?php $compras=$this->var['compras']=$fsc->articulo->get_lineas_albaran_prov();?>

<?php $ventas=$this->var['ventas']=$fsc->articulo->get_lineas_albaran_cli();?>


<?php $function=$this->var['function']='add_articulo';?>

<?php if( $fsc->articulo->stockfis <= 0 && !$fsc->articulo->controlstock ){ ?>

<?php $function=$this->var['function']='sin_stock';?>

<?php }elseif( $fsc->articulo->tipo ){ ?>

<?php $function=$this->var['function']='add_articulo_'.$fsc->articulo->tipo;?>

<?php } ?>


<div role="tabpanel">
   <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
         <a href="#detalle_gen" aria-controls="detalle_gen" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp; Detalle</span>
         </a>
      </li>
      <?php if( $equivalentes ){ ?>

      <li role="presentation">
         <a href="#detalle_equivalentes" aria-controls="detalle_equivalentes" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-random" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp; Equivalentes</span>
         </a>
      </li>
      <?php } ?>

      <?php if( $compras ){ ?>

      <li role="presentation">
         <a href="#detalle_compras" aria-controls="detalle_compras" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-import" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp; Últimas compras</span>
         </a>
      </li>
      <?php } ?>

      <?php if( $ventas ){ ?>

      <li role="presentation">
         <a href="#detalle_ventas" aria-controls="detalle_ventas" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-export" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp; Últimas ventas</span>
         </a>
      </li>
      <?php } ?>

   </ul>
   <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="detalle_gen">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Referencia</th>
                     <th class="text-left">Familia</th>
                     <th class="text-left">Fabricante</th>
                     <th class="text-right">Stock</th>
                  </tr>
               </thead>
               <tr>
                  <td><a target="_blank" href="<?php echo $fsc->articulo->url();?>"><?php echo $fsc->articulo->referencia;?></a></td>
                  <td>
                     <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->codfamilia==$fsc->articulo->codfamilia ){ ?>

                        <a href="<?php echo $value1->url();?>" target="_blank"><?php echo $value1->descripcion;?></a>
                        <?php } ?>

                     <?php }else{ ?>

                     -
                     <?php } ?>

                  </td>
                  <td>
                     <?php $loop_var1=$fsc->fabricante->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->codfabricante==$fsc->articulo->codfabricante ){ ?>

                        <a href="<?php echo $value1->url();?>" target="_blank"><?php echo $value1->nombre;?></a>
                        <?php } ?>

                     <?php }else{ ?>

                     -
                     <?php } ?>

                  </td>
                  <?php if( $fsc->articulo->stockfis<$fsc->articulo->stockmin ){ ?>

                  <td class="text-right danger"><?php echo $fsc->articulo->stockfis;?></td>
                  <?php }else{ ?>

                  <td class="text-right"><?php echo $fsc->articulo->stockfis;?></td>
                  <?php } ?>

               </tr>
            </table>
         </div>
         <?php if( $fsc->articulo->bloqueado ){ ?>

         <div class="alert alert-danger">Artículo bloqueado</div>
         <?php } ?>

         <p class="help-block" style="margin: 5px;"><?php echo $fsc->articulo->descripcion;?></p>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Precios</th>
                     <th class="text-left">Diferencia</th>
                     <th class="text-right">Precio</th>
                     <th class="text-right">Precio+<?php  echo FS_IVA;?></th>
                     <th></th>
                  </tr>
               </thead>
               <?php if( $fsc->articulo->preciocoste()!=0 ){ ?>

               <tr>
                  <td>Coste</td>
                  <td>-</td>
                  <td class="text-right"><?php echo $fsc->show_precio($fsc->articulo->preciocoste());?></td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $fsc->articulo->preciocoste();?>','0','<?php echo $fsc->articulo->codimpuesto;?>','1')">
                        <?php echo $fsc->show_precio($fsc->articulo->preciocoste_iva());?>

                     </a>
                  </td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $fsc->articulo->preciocoste();?>','0','<?php echo $fsc->articulo->codimpuesto;?>','1')">
                        <span class="glyphicon glyphicon-shopping-cart" title="añadir"></span>
                     </a>
                  </td>
               </tr>
               <?php } ?>

               <tr>
                  <td>General</td>
                  <td>-</td>
                  <td class="text-right"><?php echo $fsc->show_precio($fsc->articulo->pvp);?></td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $fsc->articulo->pvp;?>','0','<?php echo $fsc->articulo->codimpuesto;?>','1')" title="actualizado el <?php echo $fsc->articulo->factualizado;?>">
                        <?php echo $fsc->show_precio($fsc->articulo->pvp_iva());?>

                     </a>
                  </td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $fsc->articulo->pvp;?>','0','<?php echo $fsc->articulo->codimpuesto;?>','1')">
                        <span class="glyphicon glyphicon-shopping-cart" title="añadir"></span>
                     </a>
                  </td>
               </tr>
               <?php $loop_var1=$fsc->get_tarifas_articulo($fsc->articulo->referencia); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr>
                  <td><?php echo $value1->tarifa_nombre;?></td>
                  <td><?php echo $value1->tarifa_diff;?></td>
                  <td class="text-right"><?php echo $fsc->show_precio($value1->pvp*(100 - $value1->dtopor)/100);?></td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $value1->pvp;?>','<?php echo $value1->dtopor;?>','<?php echo $fsc->articulo->codimpuesto;?>','1')">
                        <?php echo $fsc->show_precio($value1->pvp*(100 - $value1->dtopor)/100*(100 + $value1->get_iva())/100);?>

                     </a>
                  </td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $value1->pvp;?>','<?php echo $value1->dtopor;?>','<?php echo $fsc->articulo->codimpuesto;?>','1')">
                        <span class="glyphicon glyphicon-shopping-cart" title="añadir"></span>
                     </a>
                  </td>
               </tr>
               <?php } ?>

            </table>
         </div>
         <?php if( $fsc->articulo->imagen_url() ){ ?>

         <div class="thumbnail">
            <img src="<?php echo $fsc->articulo->imagen_url();?>" alt="<?php echo $fsc->articulo->referencia;?>"/>
         </div>
         <?php } ?>

         <p class="help-block" style="margin: 5px;"><?php echo $fsc->articulo->observaciones;?></p>
      </div>
      <?php if( $equivalentes ){ ?>

      <div role="tabpanel" class="tab-pane" id="detalle_equivalentes">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Artículo</th>
                     <th class="text-right">Precio</th>
                     <th class="text-right">Precio+<?php  echo FS_IVA;?></th>
                     <th class="text-right">Stock</th>
                  </tr>
               </thead>
               <?php $loop_var1=$equivalentes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr<?php if( $value1->bloqueado ){ ?> class="danger"<?php }elseif( $value1->stockfis<=$value1->stockmin ){ ?> class="warning"<?php } ?>>
                  <td>
                     <a href="#" onclick="get_precios('<?php echo $value1->referencia;?>')" title="más detalles"><span class="glyphicon glyphicon-eye-open"></span></a>
                     &nbsp;
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $value1->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $value1->pvp;?>','0','<?php echo $value1->codimpuesto;?>','1')">
                        <?php echo $value1->referencia;?>

                     </a>
                     <?php echo $value1->descripcion;?>

                  </td>
                  <td class="text-right"><?php echo $fsc->show_precio($value1->pvp);?></td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $value1->pvp;?>','0','<?php echo $fsc->articulo->codimpuesto;?>','1')" title="actualizado el <?php echo $value1->factualizado;?>">
                        <?php echo $fsc->show_precio($value1->pvp_iva());?>

                     </a>
                  </td>
                  <td class="text-right"><?php echo $value1->stockfis;?></td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="4">No hay artículos equivalentes.</td>
               </tr>
               <?php } ?>

            </table>
         </div>
      </div>
      <?php } ?>

      <div role="tabpanel" class="tab-pane" id="detalle_compras">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Fecha</th>
                     <th class="text-left text-capitalize"><?php  echo FS_ALBARAN;?></th>
                     <th class="text-right">Cantidad</th>
                     <th class="text-right">Precio</th>
                     <th class="text-right">Dto</th>
                     <th class="text-right">Total+<?php  echo FS_IVA;?></th>
                  </tr>
               </thead>
               <?php $loop_var1=$compras; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr>
                  <td><?php echo $value1->show_fecha();?></td>
                  <td><a target="_blank" href="<?php echo $value1->url();?>"><?php echo $value1->show_codigo();?></a></td>
                  <td class="text-right"><?php echo $value1->cantidad;?></td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $value1->pvpunitario;?>','<?php echo $value1->dtopor;?>','<?php echo $fsc->articulo->codimpuesto;?>','1')">
                        <?php echo $fsc->show_precio($value1->pvpunitario);?>

                     </a>
                  </td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $value1->pvpunitario;?>','<?php echo $value1->dtopor;?>','<?php echo $fsc->articulo->codimpuesto;?>','1')">
                        <?php echo $fsc->show_numero($value1->dtopor);?> %
                     </a>
                  </td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $value1->pvpunitario;?>','<?php echo $value1->dtopor;?>','<?php echo $fsc->articulo->codimpuesto;?>','1')">
                        <?php echo $fsc->show_precio($value1->total_iva2());?>

                     </a>
                  </td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="6">Nunca se ha comprado este artículo.</td>
               </tr>
               <?php } ?>

            </table>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="detalle_ventas">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Fecha</th>
                     <th class="text-left text-capitalize"><?php  echo FS_ALBARAN;?></th>
                     <th class="text-right">Cantidad</th>
                     <th class="text-right">Precio</th>
                     <th class="text-right">Dto</th>
                     <th class="text-right">Total+<?php  echo FS_IVA;?></th>
                  </tr>
               </thead>
               <?php $loop_var1=$ventas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr>
                  <td><?php echo $value1->show_fecha();?></td>
                  <td><a target="_blank" href="<?php echo $value1->url();?>"><?php echo $value1->show_codigo();?></a></td>
                  <td class="text-right"><?php echo $value1->cantidad;?></td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $value1->pvpunitario;?>','<?php echo $value1->dtopor;?>','<?php echo $fsc->articulo->codimpuesto;?>','1')">
                        <?php echo $fsc->show_precio($value1->pvpunitario);?>

                     </a>
                  </td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $value1->pvpunitario;?>','<?php echo $value1->dtopor;?>','<?php echo $fsc->articulo->codimpuesto;?>','1')">
                        <?php echo $fsc->show_numero($value1->dtopor, 2);?> %
                     </a>
                  </td>
                  <td class="text-right">
                     <a href="#" onclick="<?php echo $function;?>('<?php echo $fsc->articulo->referencia;?>','<?php echo base64_encode($fsc->articulo->descripcion); ?>','<?php echo $value1->pvpunitario;?>','<?php echo $value1->dtopor;?>','<?php echo $fsc->articulo->codimpuesto;?>','1')">
                        <?php echo $fsc->show_precio($value1->total_iva2());?>

                     </a>
                  </td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="6">Nunca se va vendido este artículo.</td>
               </tr>
               <?php } ?>

            </table>
         </div>
      </div>
   </div>
</div>
<?php } ?>