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
   function clean_cliente()
   {
      document.f_custom_search.ac_cliente.value = '';
      document.f_custom_search.codcliente.value = '';
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
      $("#ac_cliente").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_cliente',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if(document.f_custom_search.codcliente.value != suggestion.data && suggestion.data != '')
               {
                  document.f_custom_search.codcliente.value = suggestion.data;
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
            <a class="btn btn-sm btn-success" href="index.php?page=nueva_venta&tipo=albaran">
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
   <?php if( $fsc->cliente ){ ?>

   <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
   <?php }else{ ?>

   <input type="hidden" name="codcliente"/>
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
            <?php if( $fsc->multi_almacen ){ ?>

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
            <?php }else{ ?>

            <input type="hidden" name="codalmacen" value=""/>
            <?php } ?>

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
            <div class="form-group">
               <select class="form-control" name="codpago" onchange="this.form.submit()">
                  <option value="">Cualquier forma de pago</option>
                  <option value="">-----</option>
                  <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codpago==$fsc->codpago ){ ?>

                     <option value="<?php echo $value1->codpago;?>" selected=""><?php echo $value1->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
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
            <div class="form-group">
               <select class="form-control" name="codgrupo" onchange="this.form.submit()">
                  <option value="">Cualquier grupo</option>
                  <option value="">-----</option>
                  <?php $loop_var1=$fsc->grupo->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codgrupo==$fsc->codgrupo ){ ?>

                     <option value="<?php echo $value1->codgrupo;?>" selected=""><?php echo $value1->nombre;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codgrupo;?>"><?php echo $value1->nombre;?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
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
            <th class="text-left">Código + <?php  echo FS_NUMERO2;?></th>
            <th class="text-left">Cliente</th>
            <th class="hidden-sm"></th>
            <th class="text-left">Observaciones</th>
            <th class="text-right">Total</th>
            <th class="text-right">Fecha</th>
            <th class="text-right visible-lg">Hora</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class='clickableRow<?php if( !$value1->ptefactura ){ ?> success<?php }elseif( $value1->total<=0 ){ ?> warning<?php } ?>' href="<?php echo $value1->url();?>" data-codigo="<?php echo $value1->codigo;?>" >
         <td class="text-center">
            <?php if( !$value1->ptefactura ){ ?>

            <span class="glyphicon glyphicon-paperclip" title="El <?php  echo FS_ALBARAN;?> tiene vinculado una factura"></span>
            <?php } ?>

            <?php if( $value1->femail ){ ?>

            <span class="glyphicon glyphicon-send" title="El <?php  echo FS_ALBARAN;?> fue enviado por email el <?php echo $value1->femail;?>"></span>
            <?php } ?>

            <?php if( $value1->envio_codtrans && $value1->envio_codigo ){ ?>

            <span class="glyphicon glyphicon-plane" title="Mercancía enviada"></span>
            <?php } ?>

         </td>
         <td>
            <a href="<?php echo $value1->url();?>"><?php echo $value1->codigo;?></a> <?php echo $value1->numero2;?>

            <?php if( $value1->totaliva==0 ){ ?><span class="label label-warning">Sin <?php  echo FS_IVA;?></span><?php } ?>

            <?php if( $value1->totalrecargo!=0 ){ ?><span class="label label-default">RE</span><?php } ?>

            <?php if( $value1->totalirpf!=0 ){ ?><span class="label label-default"><?php  echo FS_IRPF;?></span><?php } ?>

         </td>
         <td>
            <?php echo $value1->nombrecliente;?>

            <?php if( $value1->codcliente ){ ?>

            <a href="<?php echo $fsc->url();?>&codcliente=<?php echo $value1->codcliente;?>" class="cancel_clickable" title="Ver más <?php  echo FS_ALBARANES;?> de <?php echo $value1->nombrecliente;?>">[+]</a>
            <?php }else{ ?>

            <span class="label label-danger" title="Cliente desconocido">???</span>
            <?php } ?>

            <?php if( !$value1->cifnif ){ ?><span class="label label-warning" title="Sin <?php  echo FS_CIFNIF;?>"><s><?php  echo FS_CIFNIF;?></s></span><?php } ?>

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
         <td class="text-right visible-lg"><?php echo $value1->hora;?></td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td></td>
         <td colspan="7">Ningún <?php  echo FS_ALBARAN;?> encontrado. Pulsa el botón <b>Nuevo</b> para crear uno.</td>
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
         <td colspan="2"></td>
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
               <?php if( $fsc->cliente ){ ?>

               <p class="help-block">
                  Estas buscando en las líneas de los <?php  echo FS_ALBARANES;?> de <?php echo $fsc->cliente->nombre;?>.
               </p>
               <?php }else{ ?>

               <p class="help-block">Si quieres, puede <a href="<?php echo $fsc->url();?>&mostrar=buscar">filtrar por cliente</a>.</p>
               <?php } ?>

            </div>
            <div class="modal-body">
               <?php if( $fsc->cliente ){ ?>

               <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="input-group">
                           <input class="form-control" type="text" name="buscar_lineas" placeholder="Referencia" autocomplete="off"/>
                           <span class="input-group-btn">
                              <button class="btn btn-primary" type="submit">
                                 <span class="glyphicon glyphicon-search"></span>
                              </button>
                           </span>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <input class="form-control" type="text" name="buscar_lineas_o" placeholder="Observaciones" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
               </div>
               <?php }else{ ?>

               <div class="input-group">
                  <input class="form-control" type="text" name="buscar_lineas" placeholder="Referencia" autocomplete="off"/>
                  <span class="input-group-btn">
                     <button class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                     </button>
                  </span>
               </div>
               <?php } ?>

            </div>
            <div id="search_results" class="table-responsive"></div>
         </div>
      </div>
   </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>