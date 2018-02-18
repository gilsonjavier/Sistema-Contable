<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->albaran ){ ?>

<script type="text/javascript" src="<?php echo $fsc->get_js_location('ac_email_cliente.js');?>"></script>
<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript" src="<?php echo $fsc->get_js_location('nueva_venta.js');?>"></script>
<!--<?php $lineas=$this->var['lineas']=$fsc->albaran->get_lineas();?>-->
<?php if( $fsc->albaran->ptefactura ){ ?>

<script type="text/javascript">
   numlineas = <?php echo count($lineas); ?>;
   fs_nf0 = <?php  echo FS_NF0;?>;
   fs_nf0_art = <?php  echo FS_NF0_ART;?>;
   all_impuestos = <?php echo json_encode($fsc->impuesto->all()); ?>;
   default_impuesto = '<?php echo $fsc->default_items->codimpuesto();?>';
   all_series = <?php echo json_encode($fsc->serie->all()); ?>;
   cliente = <?php echo json_encode($fsc->cliente_s); ?>;
   nueva_venta_url = '<?php echo $fsc->nuevo_albaran_url;?>';
   
   <?php if( $fsc->cliente_s ){ ?>

   all_direcciones = <?php echo json_encode($fsc->cliente_s->get_direcciones()); ?>;
   <?php } ?>

   
   function cambiar_cliente() {
      $("#p_cambiar_cliente").removeClass('hidden');
      document.f_albaran.ac_cliente.readOnly = false;
      document.f_albaran.ac_cliente.value = '';
      document.f_albaran.ac_cliente.focus();
   }
   $(document).ready(function () {
      $("#numlineas").val(numlineas);
      usar_serie();
      usar_almacen();
      usar_divisa();
      recalcular();
      $("#ac_cliente").autocomplete({
         serviceUrl: nueva_venta_url,
         paramName: 'buscar_cliente',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if(document.f_albaran.cliente.value != suggestion.data && suggestion.data != '')
               {
                  document.f_albaran.cliente.value = suggestion.data;
                  usar_cliente(suggestion.data);
               }
            }
         }
      });
});
</script>
<?php }else{ ?>

<script type="text/javascript">
   $(document).ready(function() {
      <?php if( $fsc->albaran->netosindto==$fsc->albaran->neto ){ ?>

      $('.dtost').hide();
      <?php } ?>

      <?php if( $fsc->albaran->totalrecargo==0 ){ ?>

      $(".recargo").hide();
      <?php } ?>

      <?php if( $fsc->albaran->totalirpf==0 ){ ?>

      $(".irpf").hide();
      <?php } ?>

   });
</script>
<?php } ?>

<script type="text/javascript">
   function enviar_email(url)
   {
      document.f_enviar_email.action = url;
      document.f_enviar_email.submit();
   }
   $(document).ready(function () {
      $("#b_imprimir").click(function (event) {
         event.preventDefault();
         $("#modal_imprimir_albaran").modal('show');
      });
      $("#b_enviar").click(function (event) {
         event.preventDefault();
         $("#modal_enviar").modal('show');
         document.f_enviar_email.email.select();
      });
      $("#b_aprobar").click(function (event) {
         event.preventDefault();
         $("#modal_aprobar").modal('show');
      });
      $("#b_eliminar").click(function(event) {
         event.preventDefault();
         $("#modal_eliminar").modal('show');
      });
   });
</script>

<form name="f_albaran" action="<?php echo $fsc->albaran->url();?>" method="post" class="form">
   <input type="hidden" name="idalbaran" value="<?php echo $fsc->albaran->idalbaran;?>"/>
   <input type="hidden" name="cliente" value="<?php echo $fsc->albaran->codcliente;?>"/>
   <input type="hidden" name="almacen" id="codalmacen" value="<?php echo $fsc->albaran->codalmacen;?>"/>
   <input type="hidden" id="numlineas" name="numlineas" value="0"/>
   <div class="container-fluid">
      <div class="row">
         <div class="col-xs-8">
            <a class="btn btn-sm btn-default hidden-xs" href="<?php echo $fsc->url();?>" title="Recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
            <div class="btn-group">
               <a id="b_imprimir" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-print"></span>
                  <span class="hidden-xs">&nbsp;Imprimir</span>
               </a>
               <a id="b_enviar" class="btn btn-sm btn-default" href="#">
                  <span class="glyphicon glyphicon-envelope"></span>
                  <?php if( $fsc->albaran->femail ){ ?>

                  <span class="hidden-xs">&nbsp;Reenviar</span>
                  <?php }else{ ?>

                  <span class="hidden-xs">&nbsp;Enviar</span>
                  <?php } ?>

               </a>
               <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->type=='button' ){ ?>

                  <a href="index.php?page=<?php echo $value1->from;?>&id=<?php echo $fsc->albaran->idalbaran;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
                  <?php }elseif( $value1->type=='modal' ){ ?>

                  <!--<?php $txt=$this->var['txt']=base64_encode($value1->text);?>-->
                  <!--<?php echo $url='index.php?page='.$value1->from.'&id='.$fsc->albaran->idalbaran.$value1->params;?>-->
                  <a href="#" class="btn btn-sm btn-default" onclick="fs_modal('<?php echo $txt;?>','<?php echo $url;?>')"><?php echo $value1->text;?></a>
                  <?php }elseif( $value1->type=='btn_javascript' ){ ?>

                  <button class="btn btn-sm btn-default" type="button" onclick="<?php echo $value1->params;?>">
                     <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp; <?php echo $value1->text;?>

                  </button>
                  <?php } ?>

               <?php } ?>

            </div>
            <?php if( $fsc->albaran->idfactura ){ ?>

            <a class="btn btn-sm btn-info" href="<?php echo $fsc->albaran->factura_url();?>">
               <span class="glyphicon glyphicon-eye-open"></span>
               <span class="hidden-xs">&nbsp;Ver Factura</span>
            </a>
            <?php }elseif( $fsc->albaran->ptefactura ){ ?>

            <div class="btn-group">
               <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-time"></span>
                  <span class="hidden-xs">&nbsp; Pendiente</span>
                  <span class="caret"></span>
               </button>
               <ul class="dropdown-menu" role="menu">
                  <li>
                     <a id="b_aprobar" href="#">
                        <span class="glyphicon glyphicon-ok"></span>&nbsp; Aprobado
                     </a>
                  </li>
                  <?php if( $fsc->user->have_access_to('ventas_agrupar_albaranes') ){ ?>

                  <li>
                     <a href="index.php?page=ventas_agrupar_albaranes&codcliente=<?php echo $fsc->albaran->codcliente;?>&codserie=<?php echo $fsc->albaran->codserie;?>&desde=<?php echo $fsc->albaran->fecha;?>&coddivisa=<?php echo $fsc->albaran->coddivisa;?>">
                        <span class="glyphicon glyphicon-duplicate"></span>&nbsp; Agrupar...
                     </a>
                  </li>
                  <?php } ?>

               </ul>
            </div>
            <?php }else{ ?>

            <a class="btn btn-sm btn-warning" href="#">
               <span class="glyphicon glyphicon-lock"></span>
               <span class="hidden-xs">&nbsp;Bloqueado</span>
            </a>
            <?php } ?>

         </div>
         <div class="col-xs-4 text-right">
            <a class="btn btn-sm btn-success" href="index.php?page=nueva_venta&tipo=albaran" title="Nuevo <?php  echo FS_ALBARAN;?>">
               <span class="glyphicon glyphicon-plus"></span>
            </a>
            <div class="btn-group">
               <?php if( $fsc->allow_delete ){ ?>

               <a id="b_eliminar" class="btn btn-sm btn-danger" href="#">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-sm hidden-xs">&nbsp;Eliminar</span>
               </a>
               <?php } ?>

               <button class="btn btn-sm btn-primary" type="button" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
                  <span class="hidden-xs">&nbsp;Guardar</span>
               </button>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <br/>
            <ol class="breadcrumb" style="margin-bottom: 5px;">
               <li><a href="<?php echo $fsc->ppage->url();?>">Ventas</a></li>
               <li><a href="<?php echo $fsc->ppage->url();?>" class="text-capitalize"><?php  echo FS_ALBARANES;?></a></li>
               <li><a href="#" title="almacén: <?php echo $fsc->albaran->codalmacen;?>"><?php echo $fsc->albaran->codalmacen;?></a></li>
               <li title="<?php  echo FS_SERIE;?>: <?php echo $fsc->albaran->codserie;?>">
                  <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codserie==$fsc->albaran->codserie ){ ?>

                     <a href="<?php echo $fsc->ppage->url();?>&codserie=<?php echo $value1->codserie;?>" class="text-capitalize"><?php echo $value1->descripcion;?></a>
                     <?php } ?>

                  <?php } ?>

               </li>
               <li title="cliente: <?php echo $fsc->albaran->codcliente;?>">
                  <?php if( $fsc->cliente_s ){ ?>

                     <a href="<?php echo $fsc->cliente_s->url();?>"><?php echo $fsc->albaran->nombrecliente;?></a>
                  <?php }else{ ?>

                     ???
                  <?php } ?>

               </li>
               <?php if( $fsc->cliente_s ){ ?>

                  <?php if( $fsc->cliente_s->nombre!=$fsc->albaran->nombrecliente ){ ?>

                  <li>
                     <a href="#" onclick="bootbox.alert({message: 'Cliente conocido como: <?php echo $fsc->cliente_s->nombre;?>',title: '<b>Atención</b>'});">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                     </a>
                  </li>
                  <?php } ?>

               <?php } ?>

               <li class="active"><b><?php echo $fsc->albaran->codigo;?></b></li>
            </ol>
            <p class="help-block">
               <?php if( $fsc->agente ){ ?>

               <span class="text-capitalize"><?php  echo FS_ALBARAN;?></span> creado por
               <a href="<?php echo $fsc->agente->url();?>"><?php echo $fsc->agente->get_fullname();?></a>.
               <?php }else{ ?>

               Sin datos de qué empleado ha creado este <?php  echo FS_ALBARAN;?>.
               <?php } ?>

            </p>
         </div>
      </div>
      <div class="row">
         <?php if( $fsc->albaran->ptefactura ){ ?>

         <div class="col-md-3 col-sm-12">
            <div class='form-group<?php if( !$fsc->cliente_s ){ ?> has-warning<?php } ?>'>
               Cliente actual:
               <div class="input-group">
                  <input class="form-control" type="text" name="ac_cliente" id="ac_cliente" value="<?php echo $fsc->albaran->nombrecliente;?>" placeholder="Buscar" readonly="" autocomplete="off"/>
                  <span class="input-group-btn" title="Cambiar cliente">
                     <button class="btn btn-default" type="button" onclick="cambiar_cliente()">
                        <span class="glyphicon glyphicon-edit"></span>
                     </button>
                  </span>
               </div>
               <p id="p_cambiar_cliente" class="help-block hidden">
                  Para cambiar el nombre o el <?php  echo FS_CIFNIF;?>, pero no el cliente, ve a la pestaña detalles.
               </p>
            </div>
         </div>
         <?php } ?>

         <div class="col-md-3 col-sm-4">
            <div class="form-group">
               <span class='text-capitalize'><?php  echo FS_NUMERO2;?>:</span>
               <input class="form-control" type="text" name="numero2" value="<?php echo $fsc->albaran->numero2;?>"/>
            </div>
         </div>
         <div class="col-md-2 col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->serie->url();?>" class="text-capitalize"><?php  echo FS_SERIE;?></a>:
               <?php if( $fsc->albaran->ptefactura ){ ?>

               <select class="form-control" name="serie" id="codserie" onchange="usar_serie();recalcular();">
               <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->codserie==$fsc->albaran->codserie ){ ?>

                  <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                  <?php } ?>

               <?php } ?>

               </select>
               <?php }else{ ?>

               <select class="form-control" name="serie" disabled="">
               <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->codserie==$fsc->albaran->codserie ){ ?>

                  <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                  <?php } ?>

               <?php } ?>

               </select>
               <?php } ?>

            </div>
         </div>
         <div class="col-md-2 col-sm-3">
            <div class="form-group">
               Fecha:
               <?php if( $fsc->albaran->ptefactura ){ ?>

               <input class="form-control datepicker" type="text" name="fecha" value="<?php echo $fsc->albaran->fecha;?>" autocomplete="off"/>
               <?php }else{ ?>

               <div class="form-control"><?php echo $fsc->albaran->fecha;?></div>
               <?php } ?>

            </div>
         </div>
         <div class="col-md-2 col-sm-3">
            <div class="form-group">
               Hora:
               <?php if( $fsc->albaran->ptefactura ){ ?>

               <input class="form-control" type="text" name="hora" value="<?php echo $fsc->albaran->hora;?>" autocomplete="off"/>
               <?php }else{ ?>

               <div class="form-control"><?php echo $fsc->albaran->hora;?></div>
               <?php } ?>

            </div>
         </div>
      </div>
   </div>

   <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
         <li role="presentation" class="active">
            <a href="#lineas_a" aria-controls="lineas_a" role="tab" data-toggle="tab">
               <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
               <span class="hidden-xs">&nbsp;Líneas</span>
               <span class='badge'><?php echo count($lineas); ?></span>
            </a>
         </li>
         <li role="presentation">
            <a href="#detalles" aria-controls="detalles" role="tab" data-toggle="tab">
               <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
               <span class="hidden-xs">&nbsp;Detalles</span>
            </a>
         </li>
         <li role="presentation">
            <a href="#envio" aria-controls="envio" role="tab" data-toggle="tab">
               <span class="glyphicon glyphicon-road" aria-hidden="true"></span>
               <span class="hidden-xs">&nbsp;Envío</span>
            </a>
         </li>
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <li role="presentation">
               <a href="#ext_<?php echo $value1->name;?>" aria-controls="ext_<?php echo $value1->name;?>" role="tab" data-toggle="tab"><?php echo $value1->text;?></a>
            </li>
            <?php } ?>

         <?php } ?>

      </ul>
      <div class="tab-content">
         <div role="tabpanel" class="tab-pane active" id="lineas_a">
             <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/ventas_albaran_lineas") . ( substr("block/ventas_albaran_lineas",-1,1) != "/" ? "/" : "" ) . basename("block/ventas_albaran_lineas") );?>

         </div>
         <div role="tabpanel" class="tab-pane" id="detalles">
            <div class="container-fluid" style="margin-top: 10px;">
               <?php if( !$fsc->albaran->ptefactura ){ ?>

               <div class="row">
                  <div class="col-sm-12">
                     <div class="alert alert-warning">Estos datos ya no pueden ser modificados.</div>
                     <br/>
                  </div>
               </div>
               <?php } ?>

               <div class="row">
                  <div class="col-sm-2">
                     <div class="form-group">
                        Nombre del cliente:
                        <input class="form-control" type="text" name="nombrecliente" value="<?php echo $fsc->albaran->nombrecliente;?>" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        <?php  echo FS_CIFNIF;?>:
                        <input class="form-control" type="text" name="cifnif" value="<?php echo $fsc->albaran->cifnif;?>" maxlength="30" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
                        <select name="forma_pago" class="form-control">
                        <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codpago==$fsc->albaran->codpago ){ ?>

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
                        <a href="<?php echo $fsc->almacen->url();?>">Almacén</a>:
                        <select name="almacen" class="form-control" disabled="">
                        <?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codalmacen==$fsc->albaran->codalmacen ){ ?>

                           <option value="<?php echo $value1->codalmacen;?>" selected=""><?php echo $value1->nombre;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        <a href="<?php echo $fsc->divisa->url();?>">Divisa</a>:
                        <select name="divisa" id="coddivisa" class="form-control" onchange="usar_divisa()">
                        <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->coddivisa==$fsc->albaran->coddivisa ){ ?>

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
                        Tasa de conversión (1€ = X)
                        <input type="text" name="tasaconv" class="form-control" placeholder="<?php echo $fsc->albaran->tasaconv;?>" autocomplete="off"/>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <h3>
                        <span class="glyphicon glyphicon-road" aria-hidden="true"></span>
                        &nbsp;Dirección de facturación:
                     </h3>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        Direcciones del cliente:
                        <div class="input-group">
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                           </span>
                           <select name="coddir" class="form-control" onchange="usar_direccion();">
                           <?php if( $fsc->cliente_s ){ ?>

                              <?php $loop_var1=$fsc->cliente_s->get_direcciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <?php if( $value1->id==$fsc->albaran->coddir ){ ?>

                                 <option value="<?php echo $value1->id;?>" selected=""><?php echo $value1->descripcion;?></option>
                                 <?php }elseif( $value1->direccion==$fsc->albaran->direccion ){ ?>

                                 <option value="<?php echo $value1->id;?>" selected=""><?php echo $value1->descripcion;?></option>
                                 <?php }else{ ?>

                                 <option value="<?php echo $value1->id;?>"><?php echo $value1->descripcion;?></option>
                                 <?php } ?>

                              <?php } ?>

                           <?php } ?>

                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <a href="<?php echo $fsc->pais->url();?>">País</a>:
                        <select class="form-control" name="codpais">
                        <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codpais==$fsc->albaran->codpais ){ ?>

                           <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <span class="text-capitalize"><?php  echo FS_PROVINCIA;?></span>:
                        <input id="ac_provincia" class="form-control" type="text" name="provincia" value="<?php echo $fsc->albaran->provincia;?>"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Ciudad:
                        <input class="form-control" type="text" name="ciudad" value="<?php echo $fsc->albaran->ciudad;?>"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Código Postal:
                        <input class="form-control" type="text" name="codpostal" value="<?php echo $fsc->albaran->codpostal;?>" maxlength="10" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        Dirección:
                        <input class="form-control" type="text" name="direccion" value="<?php echo $fsc->albaran->direccion;?>" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <span class="text-capitalize"><?php  echo FS_APARTADO;?></span>:
                        <input class="form-control" type="text" name="apartado" value="<?php echo $fsc->albaran->apartado;?>" maxlength="10" autocomplete="off"/>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div role="tabpanel" class="tab-pane" id="envio">
            <div class="container-fluid" style="margin-top: 10px;">
               <?php if( !$fsc->albaran->ptefactura ){ ?>

               <div class="row">
                  <div class="col-sm-12">
                     <div class="alert alert-warning">Estos datos ya no pueden ser modificados.</div>
                     <br/>
                  </div>
               </div>
               <?php } ?>

               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        Nombre:
                        <input type="text" name="envio_nombre" value="<?php echo $fsc->albaran->envio_nombre;?>" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Apellidos:
                        <input type="text" name="envio_apellidos" value="<?php echo $fsc->albaran->envio_apellidos;?>" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        <a href="<?php echo $fsc->agencia->url();?>">Agencia</a>:
                        <select name="envio_codtrans" class="form-control">
                           <option value="">Ninguna</option>
                           <option value="">------</option>
                           <?php $loop_var1=$fsc->agencia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <?php if( $fsc->albaran->envio_codtrans==$value1->codtrans ){ ?>

                              <option value="<?php echo $value1->codtrans;?>" selected=""><?php echo $value1->nombre;?></option>
                              <?php }else{ ?>

                              <option value="<?php echo $value1->codtrans;?>"><?php echo $value1->nombre;?></option>
                              <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        Código de seguimiento:
                        <input type="text" name="envio_codigo" value="<?php echo $fsc->albaran->envio_codigo;?>" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        Direcciones del cliente:
                        <div class="input-group">
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                           </span>
                           <select name="envio_coddir" class="form-control" onchange="usar_direccion_envio();">
                              <option value="">Ninguna</option>
                              <option value="">------</option>
                              <?php if( $fsc->cliente_s ){ ?>

                                 <?php $loop_var1=$fsc->cliente_s->get_direcciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <?php if( $value1->direccion==$fsc->albaran->envio_direccion ){ ?>

                                    <option value="<?php echo $value1->id;?>" selected=""><?php echo $value1->descripcion;?></option>
                                    <?php }else{ ?>

                                    <option value="<?php echo $value1->id;?>"><?php echo $value1->descripcion;?></option>
                                    <?php } ?>

                                 <?php } ?>

                              <?php } ?>

                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <a href="<?php echo $fsc->pais->url();?>">País</a>:
                        <select class="form-control" name="envio_codpais">
                        <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codpais==$fsc->albaran->envio_codpais ){ ?>

                           <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <span class="text-capitalize"><?php  echo FS_PROVINCIA;?></span>:
                        <input type="text" name="envio_provincia" value="<?php echo $fsc->albaran->envio_provincia;?>" id="ac_provincia2" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Ciudad:
                        <input type="text" name="envio_ciudad" value="<?php echo $fsc->albaran->envio_ciudad;?>" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Código Postal:
                        <input type="text" name="envio_codpostal" value="<?php echo $fsc->albaran->envio_codpostal;?>" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        Dirección:
                        <input type="text" name="envio_direccion" value="<?php echo $fsc->albaran->envio_direccion;?>" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <span class="text-capitalize"><?php  echo FS_APARTADO;?></span>:
                        <input class="form-control" type="text" name="envio_apartado" value="<?php echo $fsc->albaran->envio_apartado;?>"/>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
               <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&id=<?php echo $fsc->albaran->idalbaran;?>" width="100%" height="2000" frameborder="0"></iframe>
            </div>
            <?php } ?>

         <?php } ?>

      </div>
   </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/modal_buscar_articulo") . ( substr("block/modal_buscar_articulo",-1,1) != "/" ? "/" : "" ) . basename("block/modal_buscar_articulo") );?>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/ventas_albaran_modals") . ( substr("block/ventas_albaran_modals",-1,1) != "/" ? "/" : "" ) . basename("block/ventas_albaran_modals") );?>


<?php }else{ ?>

<div class="text-center">
   <img src="<?php  echo FS_PATH;?>view/img/fuuu_face.png" alt="fuuuuu"/>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>