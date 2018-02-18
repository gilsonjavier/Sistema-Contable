<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   $(document).ready(function() {
      document.f_agrupar_alb.ac_cliente.focus();
      $("#ac_cliente").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_cliente',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if(document.f_agrupar_alb.codcliente.value != suggestion.data && suggestion.data != '')
               {
                  document.f_agrupar_alb.codcliente.value = suggestion.data;
                  document.f_agrupar_alb.submit();
               }
            }
         }
      });
      $('#marcartodo').click(function() {
         var checked = $(this).prop('checked');
         $('#f_agrupar_cli').find('input:checkbox').prop('checked', checked);
      });
   });
</script>

<form name="f_agrupar_alb" action="<?php echo $fsc->url();?>" method="post" class="form">
   <?php if( $fsc->cliente ){ ?>

   <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
   <?php }else{ ?>

   <input type="hidden" name="codcliente"/>
   <?php } ?>

   <div class="container-fluid">
      <div class="row">
         <div class="col-xs-12">
            <div class="btn-group">
               <a class="btn btn-sm btn-default" href="index.php?page=ventas_albaranes">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp; Todos</span>
               </a>
               <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </div>
            <div class="btn-group">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

            </div>
            <div class="page-header">
               <h1>
                  <span class="glyphicon glyphicon-duplicate"></span> Agrupar <?php  echo FS_ALBARANES;?>

                  <?php if( $fsc->resultados ){ ?>

                  <span class="badge"><?php echo count($fsc->resultados); ?></span>
                  <?php } ?>

               </h1>
               <p class='help-block'>
                  Con esta herramienta puedes buscar y agrupar varias <?php  echo FS_ALBARANES;?>

                  pendientes <b>de un mismo cliente</b> y generar una factura (o una para cada uno).
               </p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-3">
            <div class="form-group">
               Cliente:
               <div class="input-group">
                  <?php if( $fsc->cliente ){ ?>

                  <input class="form-control" type="text" name="ac_cliente" onkeypress="teclear(event);return texto(event)" value="<?php echo $fsc->cliente->razonsocial;?>" id="ac_cliente" placeholder="Buscar" autocomplete="off"/>
                  <?php }else{ ?>

                  <input class="form-control" type="text" name="ac_cliente" onkeypress="teclear(event);return texto(event)" id="ac_cliente" placeholder="Buscar" autocomplete="off"/>
                  <?php } ?>

                  <span class="input-group-btn">
                     <button class="btn btn-default" type="button" onclick="document.f_agrupar_alb.ac_cliente.value='';document.f_agrupar_alb.ac_cliente.focus();">
                        <span class="glyphicon glyphicon-edit"></span>
                     </button>
                  </span>
               </div>
            </div>
         </div>
         <div class="col-sm-2">
            Serie:
            <select name="codserie" class="form-control" onchange="this.form.submit()">
            <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

				   <?php if( $value1->codserie==$fsc->codserie ){ ?>

				   <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
				   <?php }else{ ?>

				   <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
				   <?php } ?>

				<?php } ?>

            </select>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Desde:
               <input type="text" name="desde" readonly class="form-control datepicker" value="<?php echo $fsc->desde;?>" onchange="this.form.submit()"/>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Hasta:
               <input type="text" name="hasta" readonly class="form-control datepicker" value="<?php echo $fsc->hasta;?>" onchange="this.form.submit()"/>
            </div>
         </div>
         <div class="col-sm-2">
            Divisa:
            <select name="coddivisa" class="form-control" onchange="this.form.submit()">
            <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

				   <?php if( $value1->coddivisa==$fsc->coddivisa ){ ?>

				   <option value="<?php echo $value1->coddivisa;?>" selected=""><?php echo $value1->descripcion;?></option>
				   <?php }else{ ?>

				   <option value="<?php echo $value1->coddivisa;?>"><?php echo $value1->descripcion;?></option>
				   <?php } ?>

				<?php } ?>

            </select>
         </div>
         <div class="col-sm-1">
            <br/>
            <?php if( $fsc->resultados ){ ?>

            <button type="submit" class="btn btn-sm btn-default" onclick="this.disabled=true;this.form.submit();">
               <span class="glyphicon glyphicon-search"></span>
            </button>
            <?php }else{ ?>

            <button type="submit" class="btn btn-sm btn-primary" onclick="this.disabled=true;this.form.submit();">
               <span class="glyphicon glyphicon-search"></span>
            </button>
            <?php } ?>

         </div>
      </div>
      <div class="row">
         <div class="col-sm-3">
            <div class="form-group">
               <input type="text" name="observaciones" onkeypress="teclear(event)" class="form-control" value="<?php echo $fsc->observaciones;?>" placeholder="observaciones"/>
            </div>
         </div>
      </div>
   </div>
</form>

<?php if( $fsc->resultados ){ ?>

<form id="f_agrupar_cli" action="<?php echo $fsc->url();?>" method="post" class="form">
   <input type="hidden" name="petition_id" value="<?php echo $fsc->random_string();?>"/>
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th class="text-center" width="40">
                           <input id="marcartodo" type="checkbox" name="c_idalbaran">
                        </th>
                        <th class="text-left">Código + <?php  echo FS_NUMERO2;?></th>
                        <th class="text-left">Observaciones</th>
                        <th class="text-right">Neto</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Fecha</th>
                     </tr>
                  </thead>
                  <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <tr<?php if( $value1->total<0 ){ ?> class="warning"<?php } ?>>
                     <td class="text-center">
                        <input type="checkbox" name="idalbaran[]" value="<?php echo $value1->idalbaran;?>" checked=""/>
                     </td>
                     <td>
                        <a href="<?php echo $value1->url();?>"><?php echo $value1->codigo;?></a> <?php echo $value1->numero2;?>

                     </td>
                     <td><?php echo $value1->observaciones_resume();?></td>
                     <td class="text-right" title="<?php echo $fsc->show_precio($fsc->euro_convert($value1->neto/$value1->tasaconv, $value1->coddivisa, $value1->tasaconv));?>">
                        <?php echo $fsc->show_precio($value1->neto, $value1->coddivisa);?>

                     </td>
                     <td class="text-right" title="<?php echo $fsc->show_precio($fsc->euro_convert($value1->totaleuros, $value1->coddivisa, $value1->tasaconv));?>">
                        <?php echo $fsc->show_precio($value1->total, $value1->coddivisa);?>

                     </td>
                     <td class="text-right" title="Hora <?php echo $value1->hora;?>">
                        <?php if( $value1->fecha==$fsc->today() ){ ?><b><?php echo $value1->fecha;?></b><?php }else{ ?><?php echo $value1->fecha;?><?php } ?>

                     </td>
                  </tr>
                  <?php } ?>

                  <tr>
                     <td colspan="3"></td>
                     <td class="text-right"><b><?php echo $fsc->show_precio($fsc->neto, $fsc->coddivisa);?></b></td>
                     <td class="text-right"><b><?php echo $fsc->show_precio($fsc->total, $fsc->coddivisa);?></b></td>
                     <td></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12 text-right">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_agrupar">
               <span class="glyphicon glyphicon-file"></span>&nbsp; Generar Factura...
            </button>
         </div>
      </div>
   </div>
   <div class="modal" id="modal_agrupar" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title">Generar factura</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Fecha de la factura:
                  <input class="form-control datepicker" type="text" name="fecha" value="<?php echo $fsc->today();?>" autocomplete="off"/>
               </div>
               <div class="form-group">
                  <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
                  <select name="codpago" class="form-control">
                     <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->codpago==$fsc->cliente->codpago ){ ?>

                        <option value="<?php echo $value1->codpago;?>" selected=""><?php echo $value1->descripcion;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
                        <?php } ?>

                     <?php } ?>

                  </select>
               </div>
               <div class="checkbox">
                  <label>
                     <input type="checkbox" name="individuales" value="TRUE"/>
                     Generar facturas individuales
                  </label>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-file"></span>&nbsp; Generar Factura
               </button>
            </div>
         </div>
      </div>
   </div>
</form>
<?php }elseif( $fsc->cliente ){ ?>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="panel panel-info">
            <div class="panel-heading">
               <h3 class="panel-title">Ayuda</h3>
            </div>
            <div class="panel-body">
               No se han encontrado resultados para esta búsqueda. Prueba a cambiar los filtros.
            </div>
         </div>
      </div>
   </div>
</div>
<?php }else{ ?>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <hr/>
         <p class='help-block text-center'>
            Si hay <?php  echo FS_ALBARANES;?> pendientes aparecerán los clientes aquí debajo
            para ahorrarte clics ;-)
         </p>
      </div>
   </div>
   <div class="row">
      <?php $loop_var1=$fsc->pendientes(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <div class="col-sm-4 col-md-3">
         <a href="<?php echo $fsc->url();?>&codcliente=<?php echo $value1['codcliente'];?>&codserie=<?php echo $value1['codserie'];?>&desde=<?php echo $value1['desde'];?>&hasta=<?php echo $value1['hasta'];?>&coddivisa=<?php echo $value1['coddivisa'];?>" class="btn btn-sm btn-block <?php if( $value1['num']>1 ){ ?>btn-info<?php }else{ ?>btn-default<?php } ?>">
            <span class="glyphicon glyphicon-user"></span>
            &nbsp; <?php echo $value1['nombre'];?>

            <?php if( $value1['num']>1 ){ ?>&nbsp; (<?php echo $value1['num'];?>)<?php } ?>

         </a>
         <p class="help-block">
            <span class="text-capitalize"><?php  echo FS_SERIE;?>:</span> <?php echo $value1['codserie'];?>,
            divisa: <?php echo $value1['coddivisa'];?>

         </p>
      </div>
      <?php } ?>

   </div>
</div>
<?php } ?>


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

