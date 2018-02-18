<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   $(document).ready(function() {
      document.f_custom_search.query.focus();
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-xs-6">
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
            <a class="btn btn-sm btn-success" href="index.php?page=contabilidad_nuevo_asiento">
               <span class="glyphicon glyphicon-plus"></span>
               <span class="hidden-xs">&nbsp;Nuevo</span>
            </a>
            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>&renumerar=TRUE">
               <span class="glyphicon glyphicon-sort-by-attributes"></span>
               <span class="hidden-xs">&nbsp; Renumerar</span>
            </a>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
      <div class="col-xs-6 text-right">
         <h2 style="margin-top: 0px;">Asientos</h2>
      </div>
   </div>
</div>

<ul class="nav nav-tabs" role="tablist">
   <li<?php if( $fsc->mostrar=='todo' ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->url();?>&mostrar=todo">
         <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
         &nbsp;Resultados <span class="badge"><?php echo $fsc->num_resultados;?></span>
      </a>
   </li>
   <li<?php if( $fsc->mostrar=='descuadrados' ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->url();?>&mostrar=descuadrados">
         <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
         <span class="hidden-xs">&nbsp;Descuadrados</span>
      </a>
   </li>
</ul>

<?php if( $fsc->mostrar=='todo' ){ ?>

<br/>
<form name="f_custom_search" action="<?php echo $fsc->url();?>" method="post" class="form">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-2">
            <div class="input-group">
               <input class="form-control" type="text" name="query" value="<?php echo $fsc->query;?>" autocomplete="off" placeholder="Buscar">
               <span class="input-group-btn">
                  <button class="btn btn-primary hidden-sm" type="submit">
                     <span class="glyphicon glyphicon-search"></span>
                  </button>
               </span>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <input type="text" name="desde" readonly value="<?php echo $fsc->desde;?>" class="form-control datepicker" placeholder="Desde" autocomplete="off" onchange="this.form.submit()"/>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <input type="text" name="hasta" readonly value="<?php echo $fsc->hasta;?>" class="form-control datepicker" placeholder="Hasta" autocomplete="off" onchange="this.form.submit()"/>
            </div>
         </div>
         <div class="col-sm-4"></div>
         <div class="col-sm-2">
            <div class="input-group">
               <div class="input-group-addon">
                  <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
               </div>
               <select name="orden" class="form-control" onchange="this.form.submit()">
                  <option value="fecha DESC, numero DESC">Orden: fecha descendente</option>
                  <option value="fecha ASC, numero ASC"<?php if( $fsc->orden=='fecha ASC, numero ASC' ){ ?> selected=""<?php } ?>>Orden: fecha</option>
                  <option value="importe ASC"<?php if( $fsc->orden=='importe ASC' ){ ?> selected=""<?php } ?>>Orden: importe</option>
                  <option value="importe DESC"<?php if( $fsc->orden=='importe DESC' ){ ?> selected=""<?php } ?>>Orden: importe descendente</option>
               </select>
            </div>
         </div>
      </div>
   </div>
</form>
<?php } ?>


<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th></th>
            <th class="text-left">Ejercicio + Número</th>
            <th class="text-left">Concepto</th>
            <th class="text-right">Importe</th>
            <th class="text-right">Fecha</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow<?php if( $value1->importe<=0 ){ ?> danger<?php }elseif( $value1->editable ){ ?> warning<?php } ?>" href="<?php echo $value1->url();?>">
         <td class="text-center">
            <?php if( $value1->editable ){ ?>

            <span class="glyphicon glyphicon-pencil" title="editable"></span>
            <?php } ?>

            <?php if( $value1->tipodocumento ){ ?>

            <span class="glyphicon glyphicon-paperclip" title="<?php echo $value1->tipodocumento;?> <?php echo $value1->documento;?>"></span>
            <?php } ?>

         </td>
         <td><?php echo $value1->codejercicio;?> <a href="<?php echo $value1->url();?>"><?php echo $value1->numero;?></a></td>
         <td><?php echo $value1->concepto;?></td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->importe);?></td>
         <td class="text-right"><?php echo $value1->fecha;?></td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td></td>
         <td colspan="5">
            Ningún asiento encontrado.
            <?php if( !isset($_GET['descuadrados']) ){ ?> Pulsa <b>Nuevo</b> para crear uno.<?php } ?>

         </td>
      </tr>
      <?php } ?>

   </table>
</div>

<div class="text-center">
   <ul class="pagination">
      <?php $loop_var1=$fsc->paginas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <li<?php if( $value1['actual'] ){ ?> class="active"<?php } ?>>
         <a href="<?php echo $value1['url'];?>"><?php echo $value1['num'];?></a>
      </li>
      <?php } ?>

   </ul>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>