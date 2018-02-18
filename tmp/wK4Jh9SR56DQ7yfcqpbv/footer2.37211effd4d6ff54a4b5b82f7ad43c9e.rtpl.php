<?php if(!class_exists('raintpl')){exit;}?>   <div class="container-fluid hidden-print" style="margin-bottom: 10px;">
      <?php if( FS_DB_HISTORY ){ ?>

      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-default hidden-print">
               <div class="panel-heading">
                  <h3 class="panel-title">Consultas SQL:</h3>
               </div>
               <div class="panel-body">
                  <ol style="font-size: 11px; margin: 0px; padding: 0px 0px 0px 20px;">
                     <?php $loop_var1=$fsc->get_db_history(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?>

                  </ol>
               </div>
            </div>
         </div>
      </div>
      <?php } ?>

   </div>
</body>
</html>