<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function clean_cliente()
   {
      document.listado_general.codcliente.value = '';
      document.listado_general.submit();
   }
   function clean_proveedor()
   {
      document.listado_general.codproveedor.value = '';
      document.listado_general.submit();
   }
   /**
    * Redimensiona un iframe
    */
   function resizeIframe(obj) {
      obj.style.height = (obj.contentWindow.document.body.scrollHeight + 100) + 'px';
   }
   /**
    *  Workarround para Firefox (siempre dice que el height es 0)
    */
   function resize(frame) {
      var b = frame.contentWindow.document.body || frame.contentDocument.body,
              cHeight = $(b).height();

      if (frame.oHeight !== cHeight) {
         $(frame).height(0);
         frame.style.height = 0;

         $(frame).height(cHeight + 100);
         frame.style.height = (cHeight + 100) + "px";

         frame.oHeight = cHeight;
      }

      // Call again to check whether the content height has changed.
      setTimeout(function () {
         resize(frame);
      }, 250);
   }
   $(document).ready(function() {
      /**
       * El resize para Firefox lo llamamos cuando se ha cargado la página completamente
       */
      window.onload = function () {
         var frame,
                 frames = document.getElementsByTagName('iframe'),
                 i = frames.length - 1;

         while (i >= 0) {
            frame = frames[i];
            frame.onload = resize(frame);

            i -= 1;
         }
      };

      $("#ac_cliente").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_cliente',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if(document.listado_general.codcliente.value != suggestion.data && suggestion.data != '')
               {
                  document.listado_general.codcliente.value = suggestion.data;
                  document.listado_general.submit();
               }
            }
         }
      });
      $("#ac_proveedor").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_proveedor',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if(document.listado_general.codproveedor.value != suggestion.data && suggestion.data != '')
               {
                  document.listado_general.codproveedor.value = suggestion.data;
                  document.listado_general.submit();
               }
            }
         }
      });
   });
</script>

<div class="container-fluid">
   <form name="listado_general" action="<?php echo $fsc->url();?>" method="post" class="form">
      <?php if( $fsc->cliente ){ ?>

      <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
      <?php }else{ ?>

      <input type="hidden" name="codcliente"/>
      <?php } ?>

      <?php if( $fsc->proveedor ){ ?>

      <input type="hidden" name="codproveedor" value="<?php echo $fsc->proveedor->codproveedor;?>"/>
      <?php }else{ ?>

      <input type="hidden" name="codproveedor"/>
      <?php } ?>

      <div class="row">
         <div class="col-sm-12">
            <div class="page-header">
               <h1>
                  <i class="fa fa-area-chart" aria-hidden="true"></i> Informe de <?php  echo FS_FACTURAS;?>

                  <span class="btn-group">
                     <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                        <span class="glyphicon glyphicon-refresh"></span>
                     </a>
                  </span>
                  <span class="btn-group">
                     <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->type=='button' ){ ?>

                     <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-xs btn-default"><?php echo $value1->text;?></a>
                     <?php }elseif( $value1->type=='modal' ){ ?>

                     <a href="#" class="btn btn-xs btn-default" onclick="fs_modal('<?php echo $txt;?>', '<?php echo $url;?>')"><?php echo $value1->text;?></a>
                     <?php } ?>

                     <?php } ?>

                  </span>
               </h1>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-2">
            <div class="form-group">
               Desde:
               <input class="form-control datepicker" type="text" name="desde" value="<?php echo $fsc->desde;?>" autocomplete="off" onchange="this.form.submit()"/>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Hasta:
               <input class="form-control datepicker" type="text" name="hasta" value="<?php echo $fsc->hasta;?>" autocomplete="off" onchange="this.form.submit()"/>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->agente->url();?>">Empleado</a>:
               <select name="codagente" class="form-control" onchange="this.form.submit()">
                  <option value="">Todos</option>
                  <option value="">------</option>
                  <?php $loop_var1=$fsc->agente->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->codagente==$value1->codagente ){ ?>

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
               <a href="<?php echo $fsc->serie->url();?>" class="text-capitalize"><?php  echo FS_SERIE;?></a>:
               <select class="form-control" name="codserie" onchange="this.form.submit()">
                  <option value="">Todas</option>
                  <option value="">-----</option>
                  <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->codserie==$value1->codserie ){ ?>

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
               <a href="<?php echo $fsc->divisa->url();?>">Divisa</a>:
               <select name="coddivisa" class="form-control" onchange="this.form.submit()">
                  <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->coddivisa==$value1->coddivisa ){ ?>

                     <option value="<?php echo $value1->coddivisa;?>" selected=""><?php echo $value1->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->coddivisa;?>"><?php echo $value1->descripcion;?></option>
                     <?php } ?>

                     <?php } ?>

               </select>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
               <select name="codpago" class="form-control" onchange="this.form.submit()">
                  <option value="">Todas</option>
                  <option value="">------</option>
                  <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->codpago==$value1->codpago ){ ?>

                     <option value="<?php echo $value1->codpago;?>" selected=""><?php echo $value1->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </div>
         </div>
      </div>
      <div class="row">
         <?php if( $fsc->multi_almacen ){ ?>

         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->almacen->url();?>">Almacén</a>:
               <select name="codalmacen" class="form-control" onchange="this.form.submit()">
                  <option value="">Todos</option>
                  <option value="">------</option>
                  <?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->codalmacen==$value1->codalmacen ){ ?>

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

         <div class="col-sm-2">
            <div class="form-group">
               Estado:
               <select class="form-control" name="estado" onchange="this.form.submit()">
                  <option value="">Todos</option>
                  <option value="pagada"<?php if( $fsc->estado=='pagada' ){ ?> selected=""<?php } ?>>Pagada</option>
                  <option value="sinpagar"<?php if( $fsc->estado=='sinpagar' ){ ?> selected=""<?php } ?>>Sin pagar</option>
               </select>
            </div>
         </div>
         <div class="col-sm-3">
            Proveedor:
            <div class="input-group">
               <?php if( $fsc->proveedor ){ ?>

               <input class="form-control" type="text" name="ac_proveedor" value="<?php echo $fsc->proveedor->nombre;?>" id="ac_proveedor" placeholder="Cualquier Proveedor" autocomplete="off"/>
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
         <div class="col-sm-3">
            Cliente:
            <div class="input-group">
               <?php if( $fsc->cliente ){ ?>

               <input class="form-control" type="text" name="ac_cliente" value="<?php echo $fsc->cliente->nombre;?>" id="ac_cliente" placeholder="Cualquier cliente" autocomplete="off"/>
               <?php }else{ ?>

               <input class="form-control" type="text" name="ac_cliente" id="ac_cliente" placeholder="Cualquier cliente" autocomplete="off"/>
               <?php } ?>

               <span class="input-group-btn">
                  <button class="btn btn-default" type="button" onclick="clean_cliente()">
                     <span class="glyphicon glyphicon-remove"></span>
                  </button>
               </span>
            </div>
         </div>
         <?php if( !$fsc->multi_almacen ){ ?>

         <div class="col-sm-2"></div>
         <?php } ?>

         <div class="col-sm-2">
            <div class="form-group">
               Descargar:
               <div class="input-group">
                  <span class="input-group-addon">
                     <span class="glyphicon glyphicon-download-alt"></span>
                  </span>
                  <select class="form-control" name="generar" onchange="this.form.submit()">
                     <option value="">-----</option>
                     <option value="pdf_cli">PDF &gt; Clientes</option>
                     <option value="xls_cli">XLS &gt; Clientes</option>
                     <option value="csv_cli">CSV &gt; Clientes</option>
                     <option value="pdf_prov">PDF &gt; Proveedores</option>
                     <option value="xls_prov">XLS &gt; Proveedores</option>
                     <option value="csv_prov">CSV &gt; Proveedores</option>  
                  </select>
               </div>
            </div>
         </div>
      </div>
   </form>
   <div class="row">
      <div class="col-sm-12">
         <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
               <a href="#mensual" aria-controls="mensual" role="tab" data-toggle="tab">Mensual</a>
            </li>
            <li role="presentation">
               <a href="#desgloses" aria-controls="desgloses" role="tab" data-toggle="tab">Desgloses</a>
            </li>
            <li role="presentation">
               <a href="#empleados" aria-controls="empleados" role="tab" data-toggle="tab">Empleados</a>
            </li>
            <li role="presentation">
               <a href="#mas_inf" aria-controls="mas_inf" role="tab" data-toggle="tab">Más...</a>
            </li>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <li role="presentation">
               <a href="#ext_<?php echo $value1->name;?>" aria-controls="ext_<?php echo $value1->name;?>" role="tab" data-toggle="tab"><?php echo $value1->text;?></a>
            </li>
            <?php } ?>

            <?php } ?>

         </ul>
         <br/>
      </div>
   </div>
   <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="mensual">
         <div class="row">
            <div class="col-sm-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title"><span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> últimos 30 días</h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_facturas_mes_actual" style="height: 350px;"></canvas>
                     <p class="help-block">Se muestran valores <b>netos</b>, es decir, sin impuestos. Se aplican los mismos filtros, excepto el de fecha.</p>
                  </div>
               </div>
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title"><span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> por mes</h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_facturas_mes" style="height: 350px;"></canvas>
                     <p class="help-block">Se muestran valores <b>netos</b>, es decir, sin impuestos.</p>
                  </div>
               </div>
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title"><span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> por año</h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_facturas_anyo" style="height: 350px;"></canvas>
                     <p class="help-block">Se muestran valores <b>netos</b>, es decir, sin impuestos.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="desgloses">
         <div class="row">
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> de compras por estado
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_compras_estados"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_estados(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> de ventas por estado
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_ventas_estados"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_estados('facturascli'); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
         </div>
         <?php if( $fsc->multi_almacen ){ ?>

         <div class="row">
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> de compras por almacén
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_compras_almacenes"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_almacenes(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> de ventas por almacén
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_ventas_almacenes"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_almacenes('facturascli'); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
         </div>
         <?php } ?>

         <div class="row">
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> de compras por <?php  echo FS_SERIE;?>

                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_compras_series"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_series(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> de ventas por <?php  echo FS_SERIE;?>

                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_ventas_series"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_series('facturascli'); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> de compras por formas de pago
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_compras_formas_pago"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_formas_pago(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> de ventas por formas de pago
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_ventas_formas_pago"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_formas_pago('facturascli'); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="empleados">
         <div class="row">
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> de compras por Empleado
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_compras_agentes"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_agentes(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <?php if( $value1['txt']=='Ninguno' ){ ?>

                              <td class="warning">Ninguno</td>
                              <td class="warning text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                           <?php }else{ ?>

                              <td><?php echo $value1['txt'];?></td>
                              <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                           <?php } ?>

                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_FACTURAS;?></span> de ventas por Empleado
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_ventas_agentes"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_agentes('facturascli'); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <?php if( $value1['txt']=='Ninguno' ){ ?>

                              <td class="warning">Ninguno</td>
                              <td class="warning text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                           <?php }else{ ?>

                              <td><?php echo $value1['txt'];?></td>
                              <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                           <?php } ?>

                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="mas_inf">
         <div class="row">
            <div class="col-sm-4">
               <form name="informe_proveedor" action="<?php echo $fsc->url();?>" method="post" target="_blank" class="form">
                  <input type="hidden" name="generar" value="informe_compras"/>
                  <input type="hidden" name="desde" value="<?php echo $fsc->desde;?>"/>
                  <input type="hidden" name="hasta" value="<?php echo $fsc->hasta;?>"/>
                  <input type="hidden" name="codalmacen" value="<?php echo $fsc->codalmacen;?>"/>
                  <input type="hidden" name="codserie" value="<?php echo $fsc->codserie;?>"/>
                  <input type="hidden" name="codagente" value="<?php echo $fsc->codagente;?>"/>
                  <?php if( $fsc->cliente ){ ?>

                  <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
                  <?php }else{ ?>

                  <input type="hidden" name="codcliente"/>
                  <?php } ?>

                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title">
                           <span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
                           &nbsp; Informe de compras
                        </h3>
                     </div>
                     <div class="panel-body">
                        <p class="help-block">
                           Obtén un informe de compras desglosado por proveedor, año y mes.
                        </p>
                        <div class="radio">
                           <label>
                              <input type="radio" name="unidades" value="FALSE" checked=""/>
                              Importes
                           </label>
                        </div>
                        <div class="radio">
                           <label>
                              <input type="radio" name="unidades" value="TRUE"/>
                              Unidades
                           </label>
                        </div>
                        <div class="form-group">
                           Mínimo:
                           <input type="text" name="minimo" class="form-control" autocomplete="off" placeholder="importe o unidades (opcional)"/>
                        </div>
                     </div>
                     <div class="panel-footer">
                        <button class="btn btn-sm btn-primary" type="submit">
                           <span class="glyphicon glyphicon-eye-open"></span>&nbsp; Mostrar
                        </button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-sm-4">
               <form name="informe_facturas" action="<?php echo $fsc->url();?>" method="post" target="_blank" class="form">
                  <input type="hidden" name="generar" value="informe_ventas"/>
                  <input type="hidden" name="desde" value="<?php echo $fsc->desde;?>"/>
                  <input type="hidden" name="hasta" value="<?php echo $fsc->hasta;?>"/>
                  <input type="hidden" name="codalmacen" value="<?php echo $fsc->codalmacen;?>"/>
                  <input type="hidden" name="codserie" value="<?php echo $fsc->codserie;?>"/>
                  <input type="hidden" name="codagente" value="<?php echo $fsc->codagente;?>"/>
                  <?php if( $fsc->proveedor ){ ?>

                  <input type="hidden" name="codproveedor" value="<?php echo $fsc->proveedor->codproveedor;?>"/>
                  <?php }else{ ?>

                  <input type="hidden" name="codproveedor"/>
                  <?php } ?>

                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title">
                           <span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
                           &nbsp; Informe de ventas
                        </h3>
                     </div>
                     <div class="panel-body">
                        <p class="help-block">
                           Obtén un informe de ventas desglosado por cliente, año y mes.
                        </p>
                        <div class="form-group">
                           <a href="<?php echo $fsc->pais->url();?>">Pais</a>:
                           <select class="form-control" name="codpais">
                              <option value="">Todos</option>
                              <option value="">-----</option>
                              <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                              <?php } ?>

                           </select>
                        </div>
                        <div class="form-group">
                           <span class="text-capitalize"><?php  echo FS_PROVINCIA;?>:</span>
                           <select name="provincia" class="form-control">
                              <option value="">Todas</option>
                              <option value="">------</option>
                              <?php $loop_var1=$fsc->provincias(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
                              <?php } ?>

                           </select>
                        </div>
                        <div class="radio">
                           <label>
                              <input type="radio" name="unidades" value="FALSE" checked=""/>
                              Importes
                           </label>
                        </div>
                        <div class="radio">
                           <label>
                              <input type="radio" name="unidades" value="TRUE"/>
                              Unidades
                           </label>
                        </div>
                        <div class="form-group">
                           Importe mínimo:
                           <input type="text" name="minimo" class="form-control" autocomplete="off" placeholder="opcional"/>
                        </div>
                     </div>
                     <div class="panel-footer">
                        <button class="btn btn-sm btn-primary" type="submit">
                           <span class="glyphicon glyphicon-eye-open"></span>&nbsp; Mostrar
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <?php if( $value1->type=='tab' ){ ?>

      <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
         <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" width="100%" scrolling="no" frameborder="0" onload="resizeIframe(this);" allowfullscreen ></iframe>
      </div>
      <?php } ?>

      <?php } ?>

   </div>
</div>

<script src="<?php  echo FS_PATH;?>view/js/chart.bundle.min.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
      
      /// definimos unos colores para usar
      var default_colors = [
         "rgba(255, 99, 132,0.8)","rgba(54, 162, 235,0.8)",'#3366CC','#DC3912','#FF9900',
         '#109618','#990099','#3B3EAC','#0099C6','#DD4477','#66AA00','#B82E2E','#316395',
         '#994499','#22AA99','#AAAA11','#6633CC','#E67300','#8B0707','#329262','#5574A6',
         '#3B3EAC'
      ];
      
      /// cargamos los datos de las facturas del mes actual
      var facturas_mes_actual_labels = [];
      var facturas_mes_actual_data = [
         [],[]
      ];
      
      <?php $loop_var1=$fsc->stats_last_30_days(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      facturas_mes_actual_labels.push("<?php echo $value1['day'];?>");
      facturas_mes_actual_data[0].push("<?php echo $value1['total_pro'];?>");
      facturas_mes_actual_data[1].push("<?php echo $value1['total_cli'];?>");
      <?php } ?>

      
      /// esto es un apaño para evitar los problemas de charts.js con tabs en bootstrap
      var ctx1 = document.getElementById('chart_facturas_mes_actual').getContext('2d');
      ctx1.canvas.height = 150;
      
      var chart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
               labels: facturas_mes_actual_labels,
               datasets: [
                  {
                     label: 'compras',
                     backgroundColor: "rgba(255, 99, 132,0.8)",
                     data: facturas_mes_actual_data[0]
                  },
                  {
                     label: 'ventas',
                     backgroundColor: "rgba(54, 162, 235,0.8)",
                     data: facturas_mes_actual_data[1]
                  }
               ]
            }
         }
      );
      
      /// cargamos los datos de las facturas por mes
      var facturas_mes_labels = [];
      var facturas_mes_data = [
         [],[]
      ];
      <?php $loop_var1=$fsc->stats_months(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      facturas_mes_labels.push("<?php echo $value1['month'];?>");
      facturas_mes_data[0].push("<?php echo $value1['total_pro'];?>");
      facturas_mes_data[1].push("<?php echo $value1['total_cli'];?>");
      <?php } ?>

      
      /// esto es un apaño para evitar los problemas de charts.js con tabs en bootstrap
      var ctx2 = document.getElementById('chart_facturas_mes').getContext('2d');
      ctx2.canvas.height = 150;
      
      var chart2 = new Chart(ctx2, {
            type: 'line',
            data: {
               labels: facturas_mes_labels,
               datasets: [
                  {
                     label: 'compras',
                     backgroundColor: "rgba(255, 99, 132,0.8)",
                     data: facturas_mes_data[0]
                  },
                  {
                     label: 'ventas',
                     backgroundColor: "rgba(54, 162, 235,0.8)",
                     data: facturas_mes_data[1]
                  }
               ]
            }
         }
      );
      
      /// cargamos los datos de los pedios por mes
      var facturas_anyo_labels = [];
      var facturas_anyo_data = [
         [],[]
      ];
      <?php $loop_var1=$fsc->stats_years(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      facturas_anyo_labels.push("<?php echo $value1['year'];?>");
      facturas_anyo_data[0].push("<?php echo $value1['total_pro'];?>");
      facturas_anyo_data[1].push("<?php echo $value1['total_cli'];?>");
      <?php } ?>

      
      /// esto es un apaño para evitar los problemas de charts.js con tabs en bootstrap
      var ctx3 = document.getElementById('chart_facturas_anyo').getContext('2d');
      ctx3.canvas.height = 150;
      
      var chart3 = new Chart(ctx3, {
            type: 'line',
            data: {
               labels: facturas_anyo_labels,
               datasets: [
                  {
                     label: 'compras',
                     backgroundColor: "rgba(255, 99, 132,0.8)",
                     data: facturas_anyo_data[0]
                  },
                  {
                     label: 'ventas',
                     backgroundColor: "rgba(54, 162, 235,0.8)",
                     data: facturas_anyo_data[1]
                  }
               ]
            }
         }
      );
      
      /// cargamos el queso del desglose por serie de las compras
      <!--<?php $data=$this->var['data']=$fsc->stats_series();?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_compras_series');?>

      
      /// cargamos el queso del desglose por serie de las ventas
      <!--<?php $data=$this->var['data']=$fsc->stats_series('facturascli');?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_ventas_series');?>

      
      <?php if( $fsc->multi_almacen ){ ?>

      /// cargamos el queso del desglose por almacén de las compras
      <!--<?php $data=$this->var['data']=$fsc->stats_almacenes();?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_compras_almacenes');?>

      
      /// cargamos el queso del desglose por almacén de las ventas
      <!--<?php $data=$this->var['data']=$fsc->stats_almacenes('facturascli');?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_ventas_almacenes');?>

      <?php } ?>

      
      /// cargamos el queso del desglose por forma de pago de las compras
      <!--<?php $data=$this->var['data']=$fsc->stats_formas_pago();?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_compras_formas_pago');?>

      
      /// cargamos el queso del desglose por forma de pago de las ventas
      <!--<?php $data=$this->var['data']=$fsc->stats_formas_pago('facturascli');?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_ventas_formas_pago');?>

      
      /// cargamos el queso del desglose por estado de las compras
      <!--<?php $data=$this->var['data']=$fsc->stats_estados();?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_compras_estados');?>

      
      /// cargamos el queso del desglose por estado de las ventas
      <!--<?php $data=$this->var['data']=$fsc->stats_estados('facturascli');?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_ventas_estados');?>

      
      /// cargamos el queso del desglose por empleado de las compras
      <!--<?php $data=$this->var['data']=$fsc->stats_agentes();?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_compras_agentes');?>

      
      /// cargamos el queso del desglose por empleado de las ventas
      <!--<?php $data=$this->var['data']=$fsc->stats_agentes('facturascli');?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_ventas_agentes');?>

   });
</script>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>