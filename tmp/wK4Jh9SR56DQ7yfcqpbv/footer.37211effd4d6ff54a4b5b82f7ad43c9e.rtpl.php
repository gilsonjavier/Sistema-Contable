<?php if(!class_exists('raintpl')){exit;}?>   <?php if( FS_DEMO ){ ?>


   <?php }else{ ?>

   <hr style="margin-top: 50px;" class="hidden-print"/>
   
   <div class="container-fluid hidden-print" style="margin-bottom: 10px;">
      <div class="row">
         <div class="col-sm-12">
            <?php if( FS_DB_HISTORY ){ ?>

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
               <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->type=='hidden_iframe' ){ ?>

                  <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" width="100%"></iframe>
                  <?php } ?>

               <?php } ?>

            <?php }else{ ?>

               <div class="hidden">
               <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->type=='hidden_iframe' ){ ?>

                  <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>"></iframe>
                  <?php } ?>

               <?php } ?>

               </div>
            <?php } ?>

         </div>
      </div>
      
   </div>
   <?php } ?>

</body>
</html>