<?php if(!class_exists('raintpl')){exit;}?><div class="table-responsive">
   <table class="table table-hover">
      <caption class="text-center">Elige una combinación de atributos:</caption>
      <thead>
         <tr>
            <th>Combinación</th>
            <th class="text-right">Precio</th>
            <th class="text-right">Precio+<?php  echo FS_IVA;?></th>
            <th class="text-right">Stock</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->results; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr<?php if( $value1['stockfis']>0 ){ ?> class="success"<?php } ?>>
         <td>
            <a href="#" onclick="add_articulo('<?php echo $value1['ref'];?>','<?php echo base64_encode($value1['desc']); ?>','<?php echo $value1['pvp'];?>','<?php echo $value1['dto'];?>','<?php echo $value1['codimpuesto'];?>','<?php echo $value1['cantidad'];?>','<?php echo $value1['codigo'];?>')"><?php echo $value1['txt'];?></a>
         </td>
         <td class="text-right"><?php echo $fsc->show_precio($value1['pvp']);?></td>
         <td class="text-right"><?php echo $fsc->show_precio($value1['pvp']*(100+$value1['iva'])/100);?></td>
         <td class="text-right"><?php echo $value1['stockfis'];?></td>
      </tr>
      <?php }else{ ?>

      <tr class="danger">
         <td colspan="4">No hay combinaciones definidas.</td>
      </tr>
      <?php } ?>

   </table>
</div>