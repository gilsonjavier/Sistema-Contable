<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   $(document).ready(function() {
      document.f_custom_search.query.focus();
      $("#b_nueva_cuenta").click(function(event) {
         event.preventDefault();
         $("#modal_nueva_cuenta").modal('show');
      });
      $("#b_show_cuentas").click(function() {
         $("#li_subcuentas").removeClass('active');
         $("#resultados_subcuentas").hide();
         $("#li_cuentas").addClass('active');
         $("#resultados_cuentas").show();
      });
      $("#b_show_subcuentas").click(function() {
         $("#li_cuentas").removeClass('active');
         $("#resultados_cuentas").hide();
         $("#li_subcuentas").addClass('active');
         $("#resultados_subcuentas").show();
      });
      <?php if( $fsc->resultados ){ ?>

      $("#resultados_subcuentas").hide();
      <?php }else{ ?>

      $("#resultados_cuentas").hide();
      <?php } ?>

   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-5 col-xs-6">
         <div class="btn-group hidden-xs">
            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
            <?php if( $fsc->page->is_default() ){ ?>

            <a class="btn btn-sm btn-default active" href="<?php echo $fsc->url();?>&amp;default_page=FALSE" title="Marcada como página de inicio (pulsa de nuevo para desmarcar)">
               <i class="fa fa-bookmark" aria-hidden="true"></i>
            </a>
            <?php }else{ ?>

            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>&amp;default_page=TRUE" title="Marcar como página de inicio">
               <i class="fa fa-bookmark-o" aria-hidden="true"></i>
            </a>
            <?php } ?>

         </div>
         <div class="btn-group">
            <a id="b_nueva_cuenta" class="btn btn-sm btn-success" href="#">
               <span class="glyphicon glyphicon-plus"></span>
               <span class="hidden-xs">&nbsp;Nueva</span>
            </a>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
      <div class="col-sm-5 col-xs-6 text-right">
         <h2 style="margin-top: 0px;">Cuentas</h2>
      </div>
      <div class="col-sm-2 col-xs-12">
         <form name="f_custom_search" action="<?php echo $fsc->url();?>" method="post" class="form">
            <div class="input-group">
               <input class="form-control" type="text" name="query" value="<?php echo $fsc->query;?>" autocomplete="off" placeholder="Buscar">
               <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">
                     <span class="glyphicon glyphicon-search"></span>
                  </button>
               </span>
            </div>
         </form>
         <div class="visible-xs">
            <br/>
         </div>
      </div>
   </div>
</div>

<?php if( $fsc->query=='' ){ ?>

<div class="container-fluid" style="margin-bottom: 10px;">
   <div class="row">
      <div class="col-sm-9 col-xs-6">
         <a class="btn btn-sm btn-default" href="index.php?page=contabilidad_epigrafes">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="hidden-xs">&nbsp;Grupos y epígrafes</span>
         </a>
         <a class="btn btn-sm btn-default" href="index.php?page=cuentas_especiales">
            <span class="glyphicon glyphicon-wrench"></span>
            <span class="hidden-xs">&nbsp;Cuentas especiales</span>
         </a>
      </div>
      <div class=" col-sm-3 col-xs-6 text-right">
         <form name="f_filtro_cuentas" action="<?php echo $fsc->url();?>" method="post" class="form">
            <select name="ejercicio" class="form-control" onchange="document.f_filtro_cuentas.submit()">
            <?php $loop_var1=$fsc->ejercicio->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->is_default() ){ ?>

               <option value="<?php echo $value1->codejercicio;?>" selected=""><?php echo $value1->nombre;?> (<?php echo $value1->codejercicio;?>)</option>
               <?php }else{ ?>

               <option value="<?php echo $value1->codejercicio;?>"><?php echo $value1->nombre;?> (<?php echo $value1->codejercicio;?>)</option>
               <?php } ?>

            <?php } ?>

            </select>
         </form>
      </div>
   </div>
</div>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Ejercicio</th>
            <th class="text-left">Código + Descripción</th>
            <th class="text-right">Cuenta Especial</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow" href="<?php echo $value1->url();?>">
         <td><?php echo $value1->codejercicio;?></td>
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codcuenta;?></a> <?php echo $value1->descripcion;?></td>
         <td class="text-right"><?php echo $value1->idcuentaesp;?></td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td colspan="3">
            Sin resultados. ¿Has <b>importado</b> los datos de contabilidad del ejercicio?
            Puedes hacerlo desde el menú contabilidad &gt; Ejercicios.
         </td>
      </tr>
      <?php } ?>

   </table>
</div>

<ul class="pager">
   <?php if( $fsc->anterior_url()!='' ){ ?>

   <li class="previous">
      <a href="<?php echo $fsc->anterior_url();?>">
         <span class="glyphicon glyphicon-chevron-left"></span> &nbsp; Anterior
      </a>
   </li>
   <?php } ?>

   
   <?php if( $fsc->siguiente_url()!='' ){ ?>

   <li class="next">
      <a href="<?php echo $fsc->siguiente_url();?>">
         Siguiente &nbsp; <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
   </li>
   <?php } ?>

</ul>
<?php }else{ ?>

<ul class="nav nav-tabs">
  <li<?php if( $fsc->resultados ){ ?> class="active"<?php } ?> id="li_cuentas">
     <a id="b_show_cuentas" href="#">
        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp; Cuentas
     </a>
  </li>
  <li<?php if( !$fsc->resultados ){ ?> class="active"<?php } ?> id="li_subcuentas">
     <a id="b_show_subcuentas" href="#">
        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp; Subcuentas
     </a>
  </li>
</ul>

<div id="resultados_cuentas">
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left">Ejercicio</th>
               <th class="text-left">Código + Descripción</th>
               <th class="text-right">Cuenta Especial</th>
            </tr>
         </thead>
         <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <tr class="clickableRow" href="<?php echo $value1->url();?>">
            <td><?php echo $value1->codejercicio;?></td>
            <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codcuenta;?></a> <?php echo $value1->descripcion;?></td>
            <td class="text-right"><?php echo $value1->idcuentaesp;?></td>
         </tr>
         <?php }else{ ?>

         <tr class="warning">
            <td colspan="3">Sin resultados.</td>
         </tr>
         <?php } ?>

      </table>
   </div>
   <ul class="pager">
      <?php if( $fsc->anterior_url()!='' ){ ?>

      <li class="previous">
         <a href="<?php echo $fsc->anterior_url();?>">
            <span class="glyphicon glyphicon-chevron-left"></span> &nbsp; Anterior
         </a>
      </li>
      <?php } ?>

      
      <?php if( $fsc->siguiente_url()!='' ){ ?>

      <li class="next">
         <a href="<?php echo $fsc->siguiente_url();?>">
            Siguiente &nbsp; <span class="glyphicon glyphicon-chevron-right"></span>
         </a>
      </li>
      <?php } ?>

   </ul>
</div>

<div id="resultados_subcuentas">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Ejercicio</th>
            <th class="text-left">Código + Descripción</th>
            <th class="text-right">Debe</th>
            <th class="text-right">Haber</th>
            <th class="text-right">Saldo</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados2; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow" href="<?php echo $value1->url();?>">
         <td><?php echo $value1->codejercicio;?></td>
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codsubcuenta;?></a> <?php echo $value1->descripcion;?></td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->debe, $value1->coddivisa);?></td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->haber, $value1->coddivisa);?></td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->saldo, $value1->coddivisa);?></td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td colspan="5">Sin resultados.</td>
      </tr>
      <?php } ?>

   </table>
</div>
<?php } ?>


<div class="modal fade" id="modal_nueva_cuenta">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Nueva Cuenta</h4>
         </div>
         <div class="media-body">
            <p style="padding: 10px;">
               Las cuentas contables pertenecen a un epígrafe, que pertenece a su vez a un grupo.
               Para crear una nueva cuenta tienes que ir a grupos y navegar hasta el epígrafe
               donde quieras crearla.
            </p>
         </div>
         <div class="modal-footer">
            <a class="btn btn-sm btn-primary" href="index.php?page=contabilidad_epigrafes">Grupos y epigrafe</a>
         </div>
      </div>
   </div>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>