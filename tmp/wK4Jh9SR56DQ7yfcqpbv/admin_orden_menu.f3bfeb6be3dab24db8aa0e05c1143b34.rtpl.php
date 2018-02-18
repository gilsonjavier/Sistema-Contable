<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   $(document).ready(function () {
      $(".sortable").sortable();
      $(".sortable").disableSelection();
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <i class="fa fa-sort-amount-asc" aria-hidden="true"></i> Ordenar menú
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </h1>
            <p class="help-block">
               Ordena libremente las entradas de cada menú. Al terminar pulsa <b>guardar</b>.
            </p>
         </div>
      </div>
   </div>
   <form action="<?php echo $fsc->url();?>" method="post" class="form">
      <input type="hidden" name="guardar" value="TRUE"/>
      <div class="row">
      <?php $loop_var1=$fsc->folders(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <?php if( $counter1%4==0 ){ ?></div><div class="row"><?php } ?>

         <div class="col-sm-3">
            <h3>
               <i class="fa fa-folder-open-o" aria-hidden="true"></i> <?php echo $value1;?>

            </h3>
            <p class="help-block">
               Haz clic y mantén pulsado para mover las entradas del menú.
            </p>
            <ul class="list-group sortable">
               <?php $loop_var2=$fsc->pages($value1); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

               <li class="list-group-item clickable">
                  <i class="fa fa-arrows-v" aria-hidden="true"></i> &nbsp; <?php echo $value2->title;?>

                  <input type="hidden" name="<?php echo $value1;?>_<?php echo $counter2;?>" value="<?php echo $value2->name;?>"/>
               </li>
               <?php } ?>

            </ul>
         </div>
      <?php } ?>

      </div>
      <div class="row">
         <div class="col-sm-12">
            <button class="btn btn-sm btn-primary" type="submit">
               <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
            </button>
         </div>
      </div>
   </form>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>