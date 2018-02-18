<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header" style="margin-bottom: 0px;">
            <h1>
               <i class="fa fa-server" aria-hidden="true"></i>
               Información del sistema
               <span class="btn-group">
                  <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                     <span class="glyphicon glyphicon-refresh"></span>
                  </a>
                  <?php if( $fsc->page->is_default() ){ ?>

                  <a class="btn btn-xs btn-default active" href="<?php echo $fsc->url();?>&amp;default_page=FALSE" title="Marcada como página de inicio (pulsa de nuevo para desmarcar)">
                     <i class="fa fa-bookmark" aria-hidden="true"></i>
                  </a>
                  <?php }else{ ?>

                  <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>&amp;default_page=TRUE" title="Marcar como página de inicio">
                     <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                  </a>
                  <?php } ?>

               </span>
            </h1>
            <p class='help-block'>
               Aquí tienes información básica sobre listado de tablas para facilitarte el trabajo a la hora de encontrar un fallo.
            </p>
         </div>
      </div>
   </div>
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left">Sistema_Contable</th>
               <th class="text-center">PHP</th>
               <th class="text-center">Base de datos</th>
               <th class="text-center">Motor de base de datos</th>
               <th class="text-right">Caché</th>
            </tr>
         </thead>
         <tr>
            <td class="text-left">1</td>
            <td class="text-center"><?php echo $fsc->php_version();?></td>
            <td class="text-center"><?php echo $fsc->fs_db_name();?></td>
            <td class="text-center"><?php echo $fsc->fs_db_version();?></td>
            <td class="text-right"><?php echo $fsc->cache_version();?></td>
         </tr>
      </table>
   </div>
   <div class="row">
      <div class="col-xs-8">
         <div class="btn-group">
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='button' ){ ?>

            <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-xs btn-default"><?php echo $value1->text;?></a>
            <?php } ?>

         <?php } ?>

         </div>
      </div>
      <div class="col-xs-4 text-right">
         <?php if( $fsc->allow_delete ){ ?>

         <a class="btn btn-xs btn-danger" href="<?php echo $fsc->url();?>&clean_cache=TRUE">
            <span class="glyphicon glyphicon-trash"></span>
            <span class="hidden-xs">&nbsp;Limpiar la cache</span>
         </a>
         <?php } ?>

      </div>
   </div>
   <?php if( $fsc->get_locks() ){ ?>

   <div class="row">
      <div class="col-sm-12">
         <br/>
         <div class="panel panel-warning">
            <div class="panel-heading">
               <h3 class="panel-title">Bloqueos en la base de datos</h3>
            </div>
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th class="text-left">Base de datos</th>
                        <th class="text-left">relname</th>
                        <th class="text-left">relation</th>
                        <th class="text-left">transaction ID</th>
                        <th class="text-left">PID</th>
                        <th class="text-left">modo</th>
                        <th class="text-left">granted</th>
                     </tr>
                  </thead>
                  <?php $loop_var1=$fsc->get_locks(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <tr>
                     <td><?php echo $value1["database"];?></td>
                     <td><?php echo $value1["relname"];?></td>
                     <td><?php echo $value1["relation"];?></td>
                     <td><?php echo $value1["transactionid"];?></td>
                     <td><?php echo $value1["pid"];?></td>
                     <td><?php echo $value1["mode"];?></td>
                     <td><?php echo $value1["granted"];?></td>
                  </tr>
                  <?php }else{ ?>

                  <tr class="warning">
                     <td colspan="7">Ningún bloqueo detectado.</td>
                  </tr>
                  <?php } ?>

               </table>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>

</div>

<ul class="nav nav-tabs" role="tablist">

   <li role="presentation">
      <a href="#tablas" aria-controls="tablas" role="tab" data-toggle="tab">
         <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
         <span class="hidden-xs">&nbsp;Tablas</span>
      </a>
   </li>
</ul>
<div class="tab-content">
   <div role="tabpanel" class="tab-pane" id="tablas">
      <br/>
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12 col-sm-12">
              
            </div>
         </div>
         <div class="row">
            <?php $loop_var1=$fsc->db_tables; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <div class="col-lg-3 col-sm-4"><?php echo $value1["name"];?></div>
            <?php } ?>

         </div>
      </div>
   </div>
   <?php if( $fsc->modulos_eneboo ){ ?>

   <div role="tabpanel" class="tab-pane" id="eneboo">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-6">
               <div class="table-responsive">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>Módulo</th>
                           <th>Descripción</th>
                           <th class="text-right">Versión</th>
                        </tr>
                     </thead>
                     <?php $loop_var1=$fsc->modulos_eneboo; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <tr>
                        <td><?php echo $value1['idmodulo'];?></td>
                        <td><?php echo $value1['descripcion'];?></td>
                        <td class="text-right"><?php echo $value1['version'];?></td>
                     </tr>
                     <?php } ?>

                  </table>
               </div>
            </div>
            <div class="col-sm-6">
               <br/>
               <div class="panel panel-warning">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>&nbsp; Importante
                     </h3>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>

</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->assign( "key", $key1 ); $tpl->assign( "value", $value1 );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>