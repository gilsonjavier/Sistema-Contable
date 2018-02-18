<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Ecuador
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </h1>
            
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-6">
         <?php if( $fsc->empresa->coddivisa=='USD' ){ ?>

         <a href="<?php echo $fsc->url();?>&opcion=moneda" class="btn btn-block btn-success">
            <span class="glyphicon glyphicon-ok"></span> &nbsp; Establecer USD como moneda por defecto
         </a>
         <?php }else{ ?>

         <a href="<?php echo $fsc->url();?>&opcion=moneda" class="btn btn-block btn-default">
            <span class="badge">1</span> &nbsp; Establecer USD como moneda por defecto
         </a>
         <?php } ?>

         <br/>
      </div>
      <div class="col-sm-6">
         <?php if( $fsc->empresa->codpais=='ECU' ){ ?>

         <a href="<?php echo $fsc->url();?>&opcion=pais" class="btn btn-block btn-success">
            <span class="glyphicon glyphicon-ok"></span> &nbsp; Establecer Ecuador como pais por defecto
         </a>
         <?php }else{ ?>

         <a href="<?php echo $fsc->url();?>&opcion=pais" class="btn btn-block btn-default">
            <span class="badge">2</span> &nbsp; Establecer Ecuador como pais por defecto
         </a>
         <?php } ?>

         <br/>
      </div>
      <div class="col-sm-6">
         <?php if( $fsc->adap_conf ){ ?>

         <a href="<?php echo $fsc->url();?>&opcion=adap_conf" class="btn btn-block btn-success">
            <span class="glyphicon glyphicon-ok"></span> &nbsp; Establecer Hora y Traduciones
         </a>
         <?php }else{ ?>

         <a href="<?php echo $fsc->url();?>&opcion=adap_conf" class="btn btn-block btn-default">
            <span class="badge">3</span> &nbsp; Establecer Hora y Traducciones
         </a>
         <?php } ?>

         <br/>
      </div>
      <div class="col-sm-6">
         
         <?php if( $fsc->impuestos_ok() ){ ?>

         <a href="<?php echo $fsc->url();?>&opcion=impuestos" target="_blank" class="btn btn-block btn-success">
            <span class="glyphicon glyphicon-ok"></span> &nbsp; Agregar Impuestos
         </a>
         <?php }else{ ?>

         <a href="<?php echo $fsc->url();?>&opcion=impuestos" target="_blank" class="btn btn-block btn-default">
            <span class="badge">4</span> &nbsp; Agregar Impuestos
         </a>
         <?php } ?>

      </div>
   </div>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>