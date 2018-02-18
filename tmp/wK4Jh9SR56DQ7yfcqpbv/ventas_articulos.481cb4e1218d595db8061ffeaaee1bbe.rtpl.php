<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function show_nuevo_articulo()
   {
      $("#modal_nuevo_articulo").modal('show');
      document.f_nuevo_articulo.referencia.focus();
   }
   function show_tarifas()
   {
      $('#ul_tabs a[href="#tarifas"]').tab('show');
      document.f_nueva_tarifa.nombre.focus();
   }
   function eliminar_tarifa(cod)
   {
      bootbox.confirm({
         message: '¿Realmente desea eliminar la tarifa '+cod+'?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = '<?php echo $fsc->url();?>&delete_tarifa='+encodeURIComponent(cod)+'#tarifas';
            }
         }
      });
   }
   $(document).ready(function() {
      document.f_custom_search.query.focus();
      
      if(window.location.hash.substring(1) == 'nuevo')
      {
         show_nuevo_articulo();
      }
      else if(window.location.hash.substring(1) == 'transferencias')
      {
         $('#ul_tabs a[href="#transferencias"]').tab('show');
      }
      else if(window.location.hash.substring(1) == 'tarifas')
      {
         show_tarifas();
      }
      else
      {
         $('[data-toggle="popover"]').popover({
            placement : 'bottom',
            trigger : 'hover',
            content: function() {
               return '<div class="thumbnail" style="margin: 0px;"><img src="'+$(this).data('img') + '" /></a>';
            }
         });
      }
      
      $("#b_nuevo_articulo").click(function(event) {
         event.preventDefault();
         show_nuevo_articulo();
      });
      $("#b_tarifas").click(function(event) {
         event.preventDefault();
         show_tarifas();
      });
   });
</script>

<div class="container-fluid" style="margin-bottom: 10px;">
   <div class="row">
      <div class="col-xs-12">
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
            <a id="b_nuevo_articulo" class="btn btn-sm btn-success" href="#">
               <span class="glyphicon glyphicon-plus"></span>
               <span class="hidden-xs">&nbsp;Nuevo</span>
            </a>
            <?php if( count($fsc->almacenes)>1 ){ ?>

            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
               <span class="caret"></span>
               <span class="sr-only">+</span>
            </button>
            <ul class="dropdown-menu">
               <li><a href="#" data-toggle="modal" data-target="#modal_nueva_transferencia">Nueva transferencia de stock</a></li>
            </ul>
            <?php } ?>

         </div>
         <div class="btn-group">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
   </div>
</div>

<div role="tabpanel">
   <ul id="ul_tabs" class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
         <a href="#articulos" aria-controls="articulos" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp;Artículos</span>
            <span class="badge"><?php echo $fsc->total_resultados;?></span>
         </a>
      </li>
      <?php if( count($fsc->almacenes)>1 ){ ?>

      <li role="presentation">
         <a href="#transferencias" aria-controls="transferencias" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp;Transferencias</span>
         </a>
      </li>
      <?php } ?>

      <?php if( $fsc->mostrar_tab_tarifas ){ ?>

      <li role="presentation">
         <a href="#tarifas" aria-controls="tarifas" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp;Tarifas</span>
         </a>
      </li>
      <?php } ?>

      <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <?php if( $value1->type=='tab' ){ ?>

         <li role="presentation">
            <a href="#ext_<?php echo $value1->name;?>" aria-controls="ext_<?php echo $value1->name;?>" role="tab" data-toggle="tab"><?php echo $value1->text;?></a>
         </li>
         <?php } ?>

      <?php } ?>

   </ul>
   <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="articulos">
         <form name="f_custom_search" action="<?php echo $fsc->url();?>" method="post" class="form">
            <div class="container-fluid" style="margin-top: 15px;">
               <div class="row">
                  <div class="col-sm-2">
                     <div class='form-group<?php if( $fsc->query ){ ?> has-success<?php } ?>'>
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
                  <?php if( count($fsc->almacenes)>1 ){ ?>

                  <div class="col-sm-2">
                     <div class='form-group<?php if( $fsc->b_codalmacen ){ ?> has-success<?php } ?>'>
                        <select class="form-control" name="b_codalmacen" onchange="this.form.submit()">
                           <option value="">Almacenes...</option>
                           <?php $loop_var1=$fsc->almacenes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <?php if( $value1->codalmacen==$fsc->b_codalmacen ){ ?>

                              <option value="<?php echo $value1->codalmacen;?>" selected=""><?php echo $value1->nombre;?></option>
                              <?php }else{ ?>

                              <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                              <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                  </div>
                  <?php }else{ ?>

                  <input type="hidden" name="b_codalmacen" value=""/>
                  <?php } ?>

                  <div class="col-sm-3">
                     <div class='form-group<?php if( $fsc->b_codfamilia ){ ?> has-success<?php } ?>'>
                        <div class="input-group">
                           <select class="form-control" name="b_codfamilia" onchange="this.form.submit()">
                              <option value="">Todas las familias</option>
                              <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <?php if( $value1->codfamilia==$fsc->b_codfamilia ){ ?>

                                 <option value="<?php echo $value1->codfamilia;?>" selected=""><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                                 <?php }else{ ?>

                                 <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                                 <?php } ?>

                              <?php } ?>

                           </select>
                           <span class="input-group-addon" title="incluir subfamilias">
                              <?php if( $fsc->b_subfamilias ){ ?>

                              <input type="checkbox" name="b_subfamilias" value="TRUE" checked="" onchange="this.form.submit()">
                              <?php }else{ ?>

                              <input type="checkbox" name="b_subfamilias" value="TRUE" onchange="this.form.submit()">
                              <?php } ?>

                              <i class="fa fa-sitemap" aria-hidden="true"></i>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class='form-group<?php if( $fsc->b_codfabricante ){ ?> has-success<?php } ?>'>
                        <select class="form-control" name="b_codfabricante" onchange="this.form.submit()">
                           <option value="">Fabricantes</option>
                           <?php $loop_var1=$fsc->fabricante->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <?php if( $value1->codfabricante==$fsc->b_codfabricante ){ ?>

                              <option value="<?php echo $value1->codfabricante;?>" selected=""><?php echo $value1->codfabricante;?></option>
                              <?php }else{ ?>

                              <option value="<?php echo $value1->codfabricante;?>"><?php echo $value1->codfabricante;?></option>
                              <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class='form-group<?php if( $fsc->b_codtarifa ){ ?> has-success<?php } ?>'>
                        <div class="input-group">
                           <select name="b_codtarifa" class="form-control" onchange="this.form.submit()">
                              <option value="">Ninguna tarifa</option>
                              <?php $loop_var1=$fsc->tarifa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <?php if( $value1->codtarifa==$fsc->b_codtarifa ){ ?>

                                 <option value="<?php echo $value1->codtarifa;?>" selected=""><?php echo $value1->nombre;?></option>
                                 <?php }else{ ?>

                                 <option value="<?php echo $value1->codtarifa;?>"><?php echo $value1->nombre;?></option>
                                 <?php } ?>

                              <?php } ?>

                           </select>
                           <span class="input-group-btn" title="Descargar">
                              <a class="btn btn-info" href="<?php echo $fsc->b_url;?>&download=csv" title="Descargar en formato CSV">
                                 <span class="glyphicon glyphicon-download-alt"></span>
                              </a>
                           </span>
                        </div>
                     </div>
                  </div>
                  <?php if( count($fsc->almacenes)<=1 ){ ?>

                  <div class="col-sm-2"></div>
                  <?php } ?>

                  <div class="col-sm-1 text-right">
                     <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                           <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                           <li>
                              <a href="<?php echo $fsc->b_url;?>&b_orden=refmin&offset=<?php echo $fsc->offset;?>">
                                 <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                                 &nbsp; Referencia &nbsp;
                                 <?php if( $fsc->b_orden=='refmin' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                              </a>
                           </li>
                           <li>
                              <a href="<?php echo $fsc->b_url;?>&b_orden=refmax&offset=<?php echo $fsc->offset;?>">
                                 <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                                 &nbsp; Referencia &nbsp;
                                 <?php if( $fsc->b_orden=='refmax' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                              </a>
                           </li>
                           <li>
                              <a href="<?php echo $fsc->b_url;?>&b_orden=descmin&offset=<?php echo $fsc->offset;?>">
                                 <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                                 &nbsp; Descripción &nbsp;
                                 <?php if( $fsc->b_orden=='descmin' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                              </a>
                           </li>
                           <li>
                              <a href="<?php echo $fsc->b_url;?>&b_orden=descmax&offset=<?php echo $fsc->offset;?>">
                                 <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                                 &nbsp; Descripción &nbsp;
                                 <?php if( $fsc->b_orden=='descmax' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                              </a>
                           </li>
                           <li>
                              <a href="<?php echo $fsc->b_url;?>&b_orden=preciomin&offset=<?php echo $fsc->offset;?>">
                                 <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                                 &nbsp; Precio &nbsp;
                                 <?php if( $fsc->b_orden=='preciomin' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                              </a>
                           </li>
                           <li>
                              <a href="<?php echo $fsc->b_url;?>&b_orden=preciomax&offset=<?php echo $fsc->offset;?>">
                                 <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                                 &nbsp; Precio &nbsp;
                                 <?php if( $fsc->b_orden=='preciomax' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                              </a>
                           </li>
                           <li>
                              <a href="<?php echo $fsc->b_url;?>&b_orden=stockmin&offset=<?php echo $fsc->offset;?>">
                                 <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                                 &nbsp; Stock &nbsp;
                                 <?php if( $fsc->b_orden=='stockmin' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                              </a>
                           </li>
                           <li>
                              <a href="<?php echo $fsc->b_url;?>&b_orden=stockmax&offset=<?php echo $fsc->offset;?>">
                                 <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                                 &nbsp; Stock &nbsp;
                                 <?php if( $fsc->b_orden=='stockmax' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <label class="checkbox-inline">
                           <?php if( $fsc->b_constock ){ ?>

                           <input type="checkbox" name="b_constock" checked="" value="TRUE" onchange="this.form.submit()"/>
                           <?php }else{ ?>

                           <input type="checkbox" name="b_constock" value="TRUE" onchange="this.form.submit()"/>
                           <?php } ?>

                           Con stock
                        </label>
                        <label class="checkbox-inline">
                           <?php if( $fsc->b_bloqueados ){ ?>

                           <input type="checkbox" name="b_bloqueados" checked="" value="TRUE" onchange="this.form.submit()"/>
                           <?php }else{ ?>

                           <input type="checkbox" name="b_bloqueados" value="TRUE" onchange="this.form.submit()"/>
                           <?php } ?>

                           Bloqueados
                        </label>
                        <label class="checkbox-inline">
                           <?php if( $fsc->b_publicos ){ ?>

                           <input type="checkbox" name="b_publicos" checked="" value="TRUE" onchange="this.form.submit()"/>
                           <?php }else{ ?>

                           <input type="checkbox" name="b_publicos" value="TRUE" onchange="this.form.submit()"/>
                           <?php } ?>

                           Públicos
                        </label>
                     </div>
                  </div>
               </div>
            </div>
         </form>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Referencia + Descripción</th>
                     <th class="text-left">Familia</th>
                     <th class="text-left">Fabricante</th>
                     <th class="text-right">Precio</th>
                     <th class="text-right">Precio+<?php  echo FS_IVA;?></th>
                     <th class="text-right">Stock</th>
                     <th class="text-right"></th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class='clickableRow<?php if( $value1->bloqueado ){ ?> danger<?php }elseif( $value1->stockfis<=$value1->stockmin ){ ?> warning<?php } ?>' href='<?php echo $value1->url();?>'>
                  <td>
                     <?php $img=$this->var['img']=$value1->imagen_url();?>

                     <?php if( $img ){ ?>

                     <a href="<?php echo $value1->url();?>" data-toggle="popover" data-html="true" data-img="<?php echo $img;?>"><?php echo $value1->referencia;?></a>
                     <span class="glyphicon glyphicon-picture" aria-hidden="true" data-toggle="popover" data-html="true" data-img="<?php echo $img;?>"></span>
                     <?php }else{ ?>

                     <a href="<?php echo $value1->url();?>"><?php echo $value1->referencia;?></a>
                     <?php } ?>

                     <?php echo $value1->descripcion();?>

                  </td>
                  <td>
                     <?php if( is_null($value1->codfamilia) ){ ?>

                        <span>-</span>
                     <?php }else{ ?>

                        <?php echo $value1->codfamilia;?>

                        <a href="<?php echo $fsc->url();?>&b_codfamilia=<?php echo $value1->codfamilia;?>" class="cancel_clickable" title="Ver más artículos de esta familia">[+]</a>
                     <?php } ?>

                  </td>
                  <td>
                     <?php if( is_null($value1->codfabricante) ){ ?>

                        <span>-</span>
                     <?php }else{ ?>

                        <?php echo $value1->codfabricante;?>

                        <a href="<?php echo $fsc->url();?>&b_codfabricante=<?php echo $value1->codfabricante;?>" class="cancel_clickable" title="Ver más artículos de este fabricante">[+]</a>
                     <?php } ?>

                  </td>
                  <td class="text-right">
                     <span title="actualizado el <?php echo $value1->factualizado;?>"><?php echo $fsc->show_precio($value1->pvp, FALSE, TRUE, FS_NF0_ART);?></span>
                  </td>
                  <td class="text-right">
                     <span title="actualizado el <?php echo $value1->factualizado;?>"><?php echo $fsc->show_precio($value1->pvp_iva(), FALSE, TRUE, FS_NF0_ART);?></span>
                  </td>
                  <td class="text-right">
                     <?php if( $value1->nostock ){ ?>-<?php }else{ ?><?php echo $value1->stockfis;?><?php } ?>

                  </td>
                  <td class="text-right">
                     <?php if( $value1->tipo ){ ?>

                     <span class="glyphicon glyphicon-list-alt" aria-hidden="true" title="Artículo tipo: <?php echo $value1->tipo;?>"></span>
                     <?php } ?>

                     <?php if( $value1->trazabilidad ){ ?>

                     <i class="fa fa-code-fork" aria-hidden="true" title="Trazabilidad activada"></i>
                     <?php } ?>

                     <?php if( $value1->publico ){ ?>

                     <span class="glyphicon glyphicon-globe" aria-hidden="true" title="Artículo público"></span>
                     <?php } ?>

                  </td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="7">Ningun artículo encontrado. Pulsa el botón <b>Nuevo</b> para crear uno.</td>
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
      </div>
      <?php if( count($fsc->almacenes)>1 ){ ?>

      <div role="tabpanel" class="tab-pane" id="transferencias">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th>Usuario</th>
                     <th>Origen</th>
                     <th>Destino</th>
                     <th class="text-right">Fecha</th>
                     <th class="text-right">Hora</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->transferencia_stock->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class="clickableRow" href="<?php echo $value1->url();?>">
                  <td><?php echo $value1->usuario;?></td>
                  <td><?php echo $value1->codalmaorigen;?></td>
                  <td><?php echo $value1->codalmadestino;?></td>
                  <td class="text-right"><?php echo $value1->fecha;?></td>
                  <td class="text-right"><?php echo $value1->hora;?></td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="5">Sin resultados.</td>
               </tr>
               <?php } ?>

            </table>
         </div>
      </div>
      <?php } ?>

      <?php if( $fsc->mostrar_tab_tarifas ){ ?>

      <div role="tabpanel" class="tab-pane" id="tarifas">
         <br/>
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <p class="help-block">
                     Desde aquí puedes configurar las tarifas de venta a clientes.
                     Crea todas las tarifas que necesites, después puedes asignarlas a clientes o
                     a <a href="index.php?page=ventas_clientes#grupos">grupos de clientes</a>.
                     <br/>
                     Las tarifas son básicamente fórmulas a aplicar al precio de venta o de coste
                     del artículo.
                  </p>
                  <?php $loop_var1=$fsc->tarifa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <form action="<?php echo $fsc->url();?>#tarifas" method="post" class="form">
                     <input type="hidden" name="codtarifa" value="<?php echo $value1->codtarifa;?>"/>
                     <div class="panel panel-warning">
                        <div class="panel-heading">
                           <h3 class="panel-title">Tarifa <?php echo $value1->codtarifa;?></h3>
                        </div>
                        <div class="panel-body">
                           <div class="container-fluid">
                              <div class="row">
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                       Nombre
                                       <input class="form-control" type="text" name="nombre" value="<?php echo $value1->nombre;?>" maxlength="50" autocomplete="off"/>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                       Aplicar
                                       <select name="aplicar_a" class="form-control">
                                          <option value="pvp" <?php if( $value1->aplicar_a=='pvp' ){ ?> selected=""<?php } ?>>Precio de venta - X% - Y</option>
                                          <option value="coste" <?php if( $value1->aplicar_a=='coste' ){ ?> selected<?php } ?>>Precio de coste + X% + Y</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <div class="hidden-xs"><br/></div>
                                       <div class="input-group">
                                          <span class="input-group-addon">X%</span>
                                          <input class="form-control" type="number" step="any" name="dtopor" value="<?php echo $value1->x();?>" autocomplete="off"/>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <div class="hidden-xs"><br/></div>
                                       <div class="input-group">
                                          <span class="input-group-addon">Y</span>
                                          <input class="form-control" type="number" step="any" name="inclineal" value="<?php echo $value1->y();?>" autocomplete="off"/>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    Resultado:
                                    <div class="form-control"><?php echo $value1->diff();?></div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                       <label class="checkbox-inline">
                                          <?php if( $value1->mincoste ){ ?>

                                          <input type="checkbox" name="mincoste" value="TRUE" checked=""/>
                                          <?php }else{ ?>

                                          <input type="checkbox" name="mincoste" value="TRUE"/>
                                          <?php } ?>

                                          mínimo = precio de coste
                                       </label>
                                       <label class="checkbox-inline">
                                          <?php if( $value1->maxpvp ){ ?>

                                          <input type="checkbox" name="maxpvp" value="TRUE" checked=""/>
                                          <?php }else{ ?>

                                          <input type="checkbox" name="maxpvp" value="TRUE"/>
                                          <?php } ?>

                                          máximo = precio de venta
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-sm-7"></div>
                                 <div class="col-sm-2 text-right">
                                    <div class="btn-group">
                                       <?php if( $fsc->allow_delete ){ ?>

                                       <a href="#" class="btn btn-sm btn-danger" title="Eliminar" onclick="eliminar_tarifa('<?php echo $value1->codtarifa;?>')">
                                          <span class="glyphicon glyphicon-trash"></span>
                                       </a>
                                       <?php } ?>

                                       <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Guardar">
                                          <span class="glyphicon glyphicon-floppy-disk"></span>
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
                  <?php } ?>

                  <form name="f_nueva_tarifa" action="<?php echo $fsc->url();?>#tarifas" method="post" class="form">
                     <div class="panel panel-info">
                        <div class="panel-heading">
                           <h3 class="panel-title">Nueva tarifa</h3>
                        </div>
                        <div class="panel-body">
                           <div class="container-fluid">
                              <div class="row">
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       Código
                                       <input class="form-control" type="text" name="codtarifa" value="<?php echo $fsc->tarifa->get_new_codigo();?>" maxlength="6" autocomplete="off"/>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                       Nombre
                                       <input class="form-control" type="text" name="nombre" maxlength="50" placeholder="Nueva Tarifa" autocomplete="off"/>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                       Aplicar
                                       <select name="aplicar_a" class="form-control">
                                          <option value="pvp">Precio de venta - X% - Y</option>
                                          <option value="coste">Precio de coste + X% + Y</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <div class="hidden-xs"><br/></div>
                                       <div class="input-group">
                                          <span class="input-group-addon">X%</span>
                                          <input class="form-control" type="number" step="any" name="dtopor" value="0" autocomplete="off"/>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <div class="hidden-xs"><br/></div>
                                       <div class="input-group">
                                          <span class="input-group-addon">Y</span>
                                          <input class="form-control" type="number" step="any" name="inclineal" value="0" autocomplete="off"/>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-sm-5">
                                    <div class="form-group">
                                       <label class="checkbox-inline">
                                          <input type="checkbox" name="mincoste" value="TRUE" checked=""/>
                                          mínimo = precio de coste
                                       </label>
                                       <label class="checkbox-inline">
                                          <input type="checkbox" name="maxpvp" value="TRUE" checked=""/>
                                          máximo = precio de venta
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-sm-5">
                                    <p class="help-block">
                                       ¿Buscas <b>Precio de venta + X% + Y</b>? ¿O <b>Precio de coste - X% - Y</b>?
                                       Puedes usar números negativos, simplemente pon un <b>-</b> delante.<br/>
                                       <mark>1 - -1 = 1 + 1</mark>
                                    </p>
                                 </div>
                                 <div class="col-sm-2 text-right">
                                    <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Guardar">
                                       <span class="glyphicon glyphicon-plus-sign"></span>
                                       <span class="hidden-xs">&nbsp;Nueva</span>
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <?php } ?>

      <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <?php if( $value1->type=='tab' ){ ?>

         <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
            <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" width="100%" height="2000" frameborder="0"></iframe>
         </div>
         <?php } ?>

      <?php } ?>

   </div>
</div>

<form class="form-horizontal" role="form" name="f_nuevo_articulo" action="<?php echo $fsc->url();?>" method="post">
   <div class="modal" id="modal_nuevo_articulo">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nuevo artículo</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label class="col-sm-2 control-label">Referencia</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="referencia" placeholder="Referencia" maxlength="18" autocomplete="off"/>
                     <p class="help-block">
                        Dejar en blanco para asignar una referencia automática.
                     </p>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Descripcion</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="descripcion" placeholder="Descripcion..." onkeypress="teclear(event);return LetrasNumeros(event)" autocomplete="off" required/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label"><a href="<?php echo $fsc->familia->url();?>">Familia</a></label>
                  <div class="col-sm-10">
                     <select class="form-control" name="codfamilia">
                        <option value="">Seleccione una familia</option>
                        <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codfamilia==$fsc->b_codfamilia ){ ?>

                           <option value="<?php echo $value1->codfamilia;?>" selected=""><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        <?php } ?>

                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label"><a href="<?php echo $fsc->fabricante->url();?>">Fabricante</a></label>
                  <div class="col-sm-10">
                     <select class="form-control" name="codfabricante">
                        <option value="">Seleccione un fabricante</option>
                        <?php $loop_var1=$fsc->fabricante->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codfabricante==$fsc->b_codfabricante ){ ?>

                           <option value="<?php echo $value1->codfabricante;?>" selected=""><?php echo $value1->nombre;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codfabricante;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label"><a href="<?php echo $fsc->impuesto->url();?>"><?php  echo FS_IVA;?></a></label>
                  <div class="col-sm-10">
                     <select class="form-control" name="codimpuesto">
                     <?php $loop_var1=$fsc->impuesto->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->is_default() ){ ?>

                        <option value="<?php echo $value1->codimpuesto;?>" selected=""><?php echo $value1->descripcion;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->codimpuesto;?>"><?php echo $value1->descripcion;?></option>
                        <?php } ?>

                     <?php } ?>

                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Precio</label>
                  <div class="col-sm-10">
                     <div class="input-group">
                        <input class="form-control" type="text" name="pvp" value="0.00" placeholder="0.00" onkeypress="return decimales(event)" title="Ingrese un numero entero con 2 decimles. " pattern="[0-9_]{1,}[.]+[0-9_]{2}" autocomplete="off"/>
                        <div class="input-group-addon"><?php echo $fsc->simbolo_divisa();?></div>
                     </div>
                     <label class="checkbox-inline">
                        <input type="checkbox" name="coniva" value="TRUE"/>
                        Precio con <?php  echo FS_IVA;?>

                     </label>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <div class="checkbox pull-left">
                  <label>
                     <input type="checkbox" name="nostock" value="TRUE"/> No controlar stock
                  </label>
               </div>
               <button class="btn btn-sm btn-primary" type="submit">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>

<form class="form" role="form" name="f_nueva_transferencia" action="<?php echo $fsc->url();?>#transferencias" method="post">
   <div class="modal" id="modal_nueva_transferencia">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>
                  &nbsp;Nueva transferencia de stock
               </h4>
            </div>
            <div class="modal-body">
               <div class='form-group'>
                  Almacén orígen:
                  <div class="input-group">
                     <span class="input-group-addon">
                        <span class="glyphicon glyphicon-export"></span>
                     </span>
                     <select class="form-control" name="origen">
                     <?php $loop_var1=$fsc->almacenes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->is_default() ){ ?>

                        <option value="<?php echo $value1->codalmacen;?>" selected=""><?php echo $value1->nombre;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                        <?php } ?>

                     <?php } ?>

                     </select>
                  </div>
               </div>
               <div class='form-group'>
                  Almacén destino:
                  <div class="input-group">
                     <span class="input-group-addon">
                        <span class="glyphicon glyphicon-import"></span>
                     </span>
                     <select class="form-control" name="destino">
                        <?php $loop_var1=$fsc->almacenes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                        <?php } ?>

                     </select>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>

<script type = "text/javascript">
   
    var flag = false;
     var teclaAnterior = "";
     
     function teclear(event) {
       teclaAnterior = teclaAnterior + " " + event.keyCode;
       var arregloTA = teclaAnterior.split(" ");
       if (event.keyCode == 32 && arregloTA[arregloTA.length - 2] == 32) {
         event.preventDefault();
       }
     }
  </script>
  