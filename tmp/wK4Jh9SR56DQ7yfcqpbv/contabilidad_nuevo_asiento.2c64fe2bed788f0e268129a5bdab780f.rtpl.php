<?php if(!class_exists('raintpl')){exit;}?><!--<?php echo $fsc->query;?>-->

<?php if( $fsc->get_errors() ){ ?>

<div class="alert alert-danger">
   <ul><?php $loop_var1=$fsc->get_errors(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
</div>
<?php } ?>

<?php if( $fsc->get_messages() ){ ?>

<div class="alert alert-info">
   <ul><?php $loop_var1=$fsc->get_messages(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
</div>
<?php } ?>


<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th></th>
            <th class="text-left">Código</th>
            <th class="text-left">Descripción</th>
            <th class="text-right">Debe</th>
            <th class="text-right">Haber</th>
            <th class="text-right">Saldo</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr>
         <td>
            <a href="<?php echo $value1->url();?>" target="_blank" title="ver el detalle de la subcuenta">
               <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
            </a>
         </td>
         <td>
            <a href="#" onclick="select_subcuenta('<?php echo $value1->codsubcuenta;?>','<?php echo $value1->saldo;?>','<?php echo base64_encode($value1->descripcion); ?>')">
               <?php echo $value1->codsubcuenta;?>

            </a>
         </td>
         <td>
            <a href="#" onclick="select_subcuenta('<?php echo $value1->codsubcuenta;?>','<?php echo $value1->saldo;?>','<?php echo base64_encode($value1->descripcion); ?>')">
               <?php echo $value1->descripcion;?>

            </a>
         </td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->debe, $value1->coddivisa);?></td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->haber, $value1->coddivisa);?></td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->saldo, $value1->coddivisa);?></td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td colspan="6">Sin resultados en el ejercicio.</td>
      </tr>
      <?php } ?>

   </table>
</div>