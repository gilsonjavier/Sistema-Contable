<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function buscar_lineas()
   {
      if(document.f_buscar_lineas.buscar_lineas.value == '')
      {
         $('#search_results').html('');
      }
      else
      {
         $.ajax({
            type: 'POST',
            url: '<?php echo $fsc->url();?>',
            dataType: 'html',
            data: $('form[name=f_buscar_lineas]').serialize(),
            success: function(datos) {
               var re = /<!--(.*?)-->/g;
               var m = re.exec( datos );
               if( m[1] == document.f_buscar_lineas.buscar_lineas.value )
               {
                  $('#search_results').html(datos);
               }
            }
         });
      }
   }
   function mas_resultados(num)
   {
      document.f_buscar_lineas.offset.value = parseInt(document.f_buscar_lineas.offset.value) + parseInt(num);
      
      if(document.f_buscar_lineas.offset.value < 0)
      {
         document.f_buscar_lineas.offset.value = 0;
      }
      
      buscar_lineas();
   }
   function clean_proveedor()
   {
      document.f_custom_search.ac_proveedor.value = '';
      document.f_custom_search.codproveedor.value = '';
      document.f_custom_search.submit();
   }
   $(document).ready(function() {
      
      <?php if( $fsc->mostrar=='buscar' ){ ?>

      document.f_custom_search.query.focus();
      <?php } ?>

      
      $('#b_buscar_lineas').click(function(event) {
         event.preventDefault();
         $('#modal_buscar_lineas').modal('show');
         document.f_buscar_lineas.buscar_lineas.focus();
      });
      $('#f_buscar_lineas').keyup(function() {
         buscar_lineas();
      });
      $('#f_buscar_lineas').submit(function(event) {
         event.preventDefault();
         buscar_lineas();
      });
      $("#ac_proveedor").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_proveedor',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if(document.f_custom_search.codproveedor.value != suggestion.data && suggestion.data != '')
               {
                  document.f_custom_search.codproveedor.value = suggestion.data;
                  document.f_custom_search.submit();
               }
            }
         }
      });
   });
</script>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
   <div class="row">
      <div class="col-sm-8 col-xs-6">
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
            <a class="btn btn-sm btn-success" href="index.php?page=nueva_compra&tipo=albaran">
               <span class="glyphicon glyphicon-plus"></span>
               <span class="hidden-xs">&nbsp;Nuevo</span>
            </a>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
      <div class="col-sm-4 col-xs-6 text-right">
         <a id="b_buscar_lineas" class="btn btn-sm btn-info" title="Buscar en las líneas">
            <span class="glyphicon glyphicon-search"></span>&nbsp; Líneas
         </a>
         <div class="btn-group">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
               <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
               <?php $loop_var1=$fsc->orden(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <li>
                  <a href="<?php echo $fsc->url(TRUE);?>&order=<?php echo $key1;?>">
                     <?php echo $value1["icono"];?> &nbsp; <?php echo $value1["texto"];?> &nbsp;
                     <?php if( $fsc->order==$value1["orden"] ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                  </a>
               </li>
               <?php } ?>

            </ul>
         </div>
      </div>
   </div>
</div>

<ul class="nav nav-tabs" role="tablist">
   <li<?php if( $fsc->mostrar=='todo' ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->url();?>&mostrar=todo">
         <span class="text-capitalize hidden-xs"><?php  echo FS_ALBARANES;?> (todo)</span>
         <span class="visible-xs">Todo</span>
      </a>
   </li>
   <li<?php if( $fsc->mostrar=='pendientes' ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->url();?>&mostrar=pendientes">
         <span class="glyphicon glyphicon-time"></span>
         <span class="hidden-xs">&nbsp;Pendientes</span>
         <span class="hidden-xs badge"><?php echo $fsc->total_pendientes();?></span>
      </a>
   </li>
   <li<?php if( $fsc->mostrar=='buscar' ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->url();?>&mostrar=buscar" title="Buscar">
         <span class="glyphicon glyphicon-search"></span>
         <?php if( $fsc->num_resultados!=='' ){ ?>

         <span class="hidden-xs badge"><?php echo $fsc->num_resultados;?></span>
         <?php } ?>

      </a>
   </li>
   <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <?php if( $value1->type=='tab' ){ ?>

      <li<?php if( $fsc->mostrar=='ext_'.$value1->name ){ ?> class="active"<?php } ?>>
         <a href="<?php echo $fsc->url();?>&mostrar=ext_<?php echo $value1->name;?>"><?php echo $value1->text;?></a>
      </li>
      <?php } ?>

   <?php } ?>

</ul>

<?php if( $fsc->mostrar=='buscar' ){ ?>

<br/>
<form name="f_custom_search" action="<?php echo $fsc->url();?>" method="post" class="form">
   <?php if( $fsc->proveedor ){ ?>

   <input type="hidden" name="codproveedor" value="<?php echo $fsc->proveedor->codproveedor;?>"/>
   <?php }else{ ?>

   <input type="hidden" name="codproveedor"/>
   <?php } ?>

   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-2">
            <div class="form-group">
               <div class="input-group">
                  <input class="form-control" type="text" name="query" value="<?php echo $fsc->query;?>" autocomplete="off" placeholder="Buscar">
                  <span class="input-group-btn">
                     <button class="btn btn-primary hidden-sm" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                     </button>
                  </span>
               </div>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <select class="form-control" name="codserie" onchange="this.form.submit()">
                  <option value="">Cualquier <?php  echo FS_SERIE;?></option>
                  <option value="">-----</option>
                  <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codserie==$fsc->codserie ){ ?>

                     <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <select name="codagente" class="form-control" onchange="this.form.submit()">
                  <option value="">Cualquier empleado</option>
                  <option value="">------</option>
                  <?php $loop_var1=$fsc->agente->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codagente==$fsc->codagente ){ ?>

                     <option value="<?php echo $value1->codagente;?>" selected=""><?php echo $value1->get_fullname();?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codagente;?>"><?php echo $value1->get_fullname();?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <div class="input-group">
                  <?php if( $fsc->proveedor ){ ?>

                  <input class="form-control" type="text" name="ac_proveedor" value="<?php echo $fsc->proveedor->nombre;?>" id="ac_proveedor" placeholder="Cualquier proveedor" autocomplete="off"/>
                  <?php }else{ ?>

                  <input class="form-control" type="text" name="ac_proveedor" id="ac_proveedor" placeholder="Cualquier proveedor" autocomplete="off"/>
                  <?php } ?>

                  <span class="input-group-btn">
                     <button class="btn btn-default" type="button" onclick="clean_proveedor()">
                        <span class="glyphicon glyphicon-remove"></span>
                     </button>
                  </span>
               </div>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <input type="text" name="desde" value="<?php echo $fsc->desde;?>" class="form-control datepicker" placeholder="Desde" autocomplete="off" onchange="this.form.submit()"/>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <input type="text" name="hasta" value="<?php echo $fsc->hasta;?>" class="form-control datepicker" placeholder="Hasta" autocomplete="off" onchange="this.form.submit()"/>
            </div>
         </div>
         <?php if( $fsc->multi_almacen ){ ?>

         <div class="col-sm-2">
            <div class="form-group">
               <select name="codalmacen" class="form-control" onchange="this.form.submit()">
                  <option value="">Cualquier almacén</option>
                  <option value="">------</option>
                  <?php $loop_var1=$fsc->almacenes->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codalmacen==$fsc->codalmacen ){ ?>

                     <option value="<?php echo $value1->codalmacen;?>" selected=""><?php echo $value1->nombre;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </div>
         </div>
         <?php }else{ ?>

         <input type="hidden" name="codalmacen" value=""/>
         <?php } ?>

      </div>
   </div>
</form>
<?php } ?>


<?php if( in_array($fsc->mostrar, array('todo','pendientes','buscar')) ){ ?>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th></th>
            <th class="text-left">Código + Núm. Proveedor</th>
            <th class="text-left">Proveedor</th>
            <th class="hidden-sm"></th>
            <th class="text-left">Observaciones</th>
            <th class="text-right">Total</th>
            <th class="text-right">Fecha</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow<?php if( !$value1->ptefactura ){ ?> success<?php }elseif( $value1->total<=0 ){ ?> warning<?php } ?>" href="<?php echo $value1->url();?>">
         <td class="text-center">
            <?php if( !$value1->ptefactura ){ ?>

            <span class="glyphicon glyphicon-paperclip" title="facturado"></span>
            <?php } ?>

         </td>
         <td>
            <a href="<?php echo $value1->url();?>"><?php echo $value1->codigo;?></a> <?php echo $value1->numproveedor;?>

            <?php if( $value1->totaliva==0 ){ ?><span class="label label-warning">Sin <?php  echo FS_IVA;?></span><?php } ?>

            <?php if( $value1->totalrecargo!=0 ){ ?><span class="label label-default">RE</span><?php } ?>

            <?php if( $value1->totalirpf!=0 ){ ?><span class="label label-default"><?php  echo FS_IRPF;?></span><?php } ?>

         </td>
         <td>
            <?php echo $value1->nombre;?>

            <?php if( $value1->codproveedor ){ ?>

            <a href="<?php echo $fsc->url();?>&codproveedor=<?php echo $value1->codproveedor;?>" class="cancel_clickable" title="Ver más <?php  echo FS_ALBARANES;?> de <?php echo $value1->nombre;?>">[+]</a>
            <?php }else{ ?>

            <span class="label label-danger" title="Proveedor desconocido">???</span>
            <?php } ?>

         </td>
         <td class="text-right hidden-sm">
            <span title="<?php echo $value1->numdocs;?> documentos adjuntos">
               <?php if( $value1->numdocs==1 ){ ?>

               <i class="fa fa-file" aria-hidden="true"></i>
               <?php }elseif( $value1->numdocs>1 ){ ?>

               <?php echo $value1->numdocs;?> <i class="fa fa-file" aria-hidden="true"></i>
               <?php } ?>

            </span>
         </td>
         <td><?php echo $value1->observaciones_resume();?></td>
         <td class="text-right" title="<?php echo $fsc->show_precio($fsc->euro_convert($value1->totaleuros, $value1->coddivisa, $value1->tasaconv));?>">
            <?php echo $fsc->show_precio($value1->total, $value1->coddivisa);?>

         </td>
         <td class="text-right" title="Hora <?php echo $value1->hora;?>">
            <?php if( $value1->fecha==$fsc->today() ){ ?><b><?php echo $value1->fecha;?></b><?php }else{ ?><?php echo $value1->fecha;?><?php } ?>

         </td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td></td>
         <td colspan="6">Ningún <?php  echo FS_ALBARAN;?> encontrado. Pulsa el botón <b>Nuevo</b> para crear uno.</td>
      </tr>
      <?php } ?>

      <?php if( $fsc->total_resultados ){ ?>

      <tr>
         <th class="hidden-sm"></th>
         <td colspan="5" class="text-right">
            <?php echo $fsc->total_resultados_txt;?>

            <?php $loop_var1=$fsc->total_resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <br/><b><?php echo $fsc->show_precio($value1['total'],$value1['coddivisa'],FALSE);?></b>
            <?php } ?>

         </td>
         <td></td>
      </tr>
      <?php } ?>

   </table>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12 text-center">
         <ul class="pagination">
            <?php $loop_var1=$fsc->paginas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <li<?php if( $value1['actual'] ){ ?> class="active"<?php } ?>>
               <a href="<?php echo $value1['url'];?>"><?php echo $value1['num'];?></a>
            </li>
            <?php } ?>

         </ul>
      </div>
   </div>
</div>
<?php }else{ ?>

   <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <?php if( $value1->type=='tab' && $fsc->mostrar=='ext_'.$value1->name ){ ?>

      <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" width="100%" height="2000" frameborder="0"></iframe>
      <?php } ?>

   <?php } ?>

<?php } ?>


<form class="form" role="form" id="f_buscar_lineas" name="f_buscar_lineas" action="<?php echo $fsc->url();?>" method="post">
   <input type="hidden" name="offset" value="0"/>
   <div class="modal" id="modal_buscar_lineas">
      <div class="modal-dialog" style="width: 99%; max-width: 950px;">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Buscar en las líneas</h4>
            </div>
            <div class="modal-body">
               <div class="input-group">
                  <input class="form-control" type="text" name="buscar_lineas" placeholder="Referencia" autocomplete="off"/>
                  <span class="input-group-btn">
                     <button class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                     </button>
                  </span>
               </div>
            </div>
            <div id="search_results" class="table-responsive"></div>
         </div>
      </div>
   </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>