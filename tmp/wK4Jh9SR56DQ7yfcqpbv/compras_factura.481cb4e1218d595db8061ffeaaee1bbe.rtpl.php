<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->factura ){ ?>

<script type="text/javascript">
   $(document).ready(function() {
      $("#b_imprimir").click(function(event) {
         event.preventDefault();
         $("#modal_imprimir").modal('show');
      });
      $("#b_eliminar").click(function(event) {
         event.preventDefault();
         $("#modal_eliminar").modal('show');
      });
      <?php if( $fsc->factura->totalrecargo==0 ){ ?>

      $(".recargo").hide();
      <?php } ?>

      <?php if( $fsc->factura->totalirpf==0 ){ ?>

      $(".irpf").hide();
      <?php } ?>

   });
</script>

<form action="<?php echo $fsc->factura->url();?>" method="post" class="form">
   <input type="hidden" name="idfactura" value="<?php echo $fsc->factura->idfactura;?>"/>
   <div class="container-fluid">
      <div class="row">
         <div class="col-xs-8">
            <a class="btn btn-sm btn-default hidden-xs" href="<?php echo $fsc->url();?>" title="recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
            <div class="btn-group">
               <a id="b_imprimir" class="btn btn-sm btn-default" href="#">
                  <span class="glyphicon glyphicon-print"></span>
                  <span class="hidden-xs">&nbsp;Imprimir</span>
               </a>
               <?php if( $fsc->factura->idasiento ){ ?>

               <div class="btn-group">
                  <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true">
                     <span class="glyphicon glyphicon-eye-open"></span>
                     <span class="hidden-xs">&nbsp;Asientos</span>
                  </button>
                  <ul class="dropdown-menu">
                     <li><a href="<?php echo $fsc->factura->asiento_url();?>">Asiento principal</a></li>
                     <?php if( $fsc->factura->idasientop ){ ?>

                     <li><a href="<?php echo $fsc->factura->asiento_pago_url();?>">Asiento de pago</a></li>
                     <?php } ?>

                  </ul>
               </div>
               <?php }else{ ?>

               <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>&gen_asiento=TRUE&petid=<?php echo $fsc->random_string();?>">
                  <span class="glyphicon glyphicon-paperclip"></span>
                  <span class="hidden-xs">&nbsp; Generar asiento</span>
               </a>
               <?php } ?>

            </div>
            
            <?php if( $fsc->mostrar_boton_pagada ){ ?>

            <div class="btn-group">
               <?php if( $fsc->factura->pagada ){ ?>

               <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-ok"></span> &nbsp; Pagada <span class="caret"></span>
               </button>
               <?php }else{ ?>

               <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-remove"></span> &nbsp; Sin pagar <span class="caret"></span>
               </button>
               <?php } ?>

               <ul class="dropdown-menu" role="menu">
                  <?php if( !$fsc->factura->pagada ){ ?>

                  <li>
                     <a href="#" data-toggle="modal" data-target="#modal_pagar">
                        <span class="glyphicon glyphicon-ok"></span> &nbsp; Pagada
                     </a>
                  </li>
                  <?php }else{ ?>

                  <li><a href="<?php echo $fsc->url();?>&pagada=FALSE"><span class="glyphicon glyphicon-remove"></span> &nbsp; Sin pagar</a></li>
                  <?php } ?>

                  <li role="separator" class="divider"></li>
                  <li>
                     <a href="<?php echo $fsc->forma_pago->url();?>" target="_blank">
                        <span class="glyphicon glyphicon-wrench"></span> &nbsp; Configurar
                     </a>
                  </li>
               </ul>
            </div>
            <?php }elseif( $fsc->factura->pagada ){ ?>

            <a class="btn btn-sm btn-info" href="#">
               <span class="glyphicon glyphicon-ok"></span>
               <span class="hidden-xs">&nbsp; Pagada</span>
            </a>
            <?php } ?>

            
            <div class="btn-group">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?>&id=<?php echo $fsc->factura->idfactura;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php }elseif( $value1->type=='modal' ){ ?>

               <!--<?php $txt=$this->var['txt']=base64_encode($value1->text);?>-->
               <!--<?php echo $url='index.php?page='.$value1->from.'&id='.$fsc->factura->idfactura.$value1->params;?>-->
               <a href="#" class="btn btn-sm btn-default" onclick="fs_modal('<?php echo $txt;?>','<?php echo $url;?>')"><?php echo $value1->text;?></a>
               <?php }elseif( $value1->type=='btn_javascript' ){ ?>

               <button class="btn btn-sm btn-default" type="button" onclick="<?php echo $value1->params;?>">
                   <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp; <?php echo $value1->text;?>

               </button>
               <?php } ?>               
            <?php } ?>

            </div>
         </div>
         <div class="col-xs-4 text-right">
            <a class="btn btn-sm btn-success" href="index.php?page=nueva_compra&tipo=factura" title="Nueva factura">
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
         <div class="col-md-12">
            <br/>
            <ol class="breadcrumb" style="margin-bottom: 5px;">
               <li><a href="<?php echo $fsc->ppage->url();?>">Compras</a></li>
               <li><a href="<?php echo $fsc->ppage->url();?>">Factura</a></li>
               <li><a href="#" title="almacén: <?php echo $fsc->factura->codalmacen;?>"><?php echo $fsc->factura->codalmacen;?></a></li>
               <li title="<?php  echo FS_SERIE;?>: <?php echo $fsc->factura->codserie;?>">
                  <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codserie==$fsc->factura->codserie ){ ?>

                     <a href="<?php echo $fsc->ppage->url();?>&codserie=<?php echo $value1->codserie;?>" class="text-capitalize"><?php echo $value1->descripcion;?></a>
                     <?php } ?>

                  <?php } ?>

               </li>
               <li title="proveedor: <?php echo $fsc->factura->codproveedor;?>">
                  <?php if( $fsc->proveedor ){ ?>

                     <a href="<?php echo $fsc->proveedor->url();?>"><?php echo $fsc->factura->nombre;?></a>
                  <?php }else{ ?>

                     ???
                  <?php } ?>

               </li>
               <?php if( $fsc->proveedor ){ ?>

                  <?php if( $fsc->proveedor->nombre!=$fsc->factura->nombre ){ ?>

                  <li>
                     <a href="#" onclick="bootbox.alert({message: 'Proveedor conocido como: <?php echo $fsc->proveedor->nombre;?>',title: '<b>Atención</b>'});">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                     </a>
                  </li>
                  <?php } ?>

               <?php } ?>

               <li class="active"><b><?php echo $fsc->factura->codigo;?></b></li>
            </ol>
            <p>
               <?php if( $fsc->agente ){ ?>

               Factura creada por <a href="<?php echo $fsc->agente->url();?>"><?php echo $fsc->agente->get_fullname();?></a>.
               <?php }else{ ?>

               Sin datos de qué empleado ha creado esta factura.
               <?php } ?>

               &nbsp;
               <?php if( $fsc->rectificada ){ ?>

               <a href="<?php echo $fsc->rectificada->url();?>" class="label label-danger">
                  <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
                  &nbsp; <?php  echo FS_FACTURA_RECTIFICATIVA;?> de <?php echo $fsc->factura->codigorect;?>

               </a>
               <?php }elseif( $fsc->rectificativa ){ ?>

               <a href="<?php echo $fsc->rectificativa->url();?>" class="label label-warning">
                  Hay una <?php  echo FS_FACTURA_RECTIFICATIVA;?> asociada
               </a>
               <?php }elseif( $fsc->factura->anulada ){ ?>

               <span class="label label-danger">Anulada</span>
               <?php } ?>

            </p>
         </div>
      </div>
      
      <div class="row">
         <div class="col-sm-3">
            <div class="form-group">
               Núm. Proveedor:
               <input class="form-control" type="text" name="numproveedor" value="<?php echo $fsc->factura->numproveedor;?>"/>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->serie->url();?>" class="text-capitalize"><?php  echo FS_SERIE;?></a>:
               <select name="serie" class="form-control" disabled="">
               <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->codserie==$fsc->factura->codserie ){ ?>

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
               Fecha:
               <input class="form-control datepicker" readonly type="text" name="fecha" value="<?php echo $fsc->factura->fecha;?>" autocomplete="off"/>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Hora:
               <input class="form-control" readonly type="text" name="hora" value="<?php echo $fsc->factura->hora;?>" autocomplete="off"/>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
               <select name="forma_pago" class="form-control">
               <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $fsc->factura->codpago==$value1->codpago ){ ?>

                  <option value="<?php echo $value1->codpago;?>" selected=""><?php echo $value1->descripcion;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
                  <?php } ?>

               <?php } ?>

               </select>
            </div>
         </div>
      </div>
   </div>
   
   <!--<?php $lineas=$this->var['lineas']=$fsc->factura->get_lineas();?>-->
   <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
         <li role="presentation" class="active">
            <a href="#lineas_f" aria-controls="lineas_f" role="tab" data-toggle="tab">
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
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <li role="presentation">
               <a href="#ext_<?php echo $value1->name;?>" aria-controls="ext_<?php echo $value1->name;?>" role="tab" data-toggle="tab"><?php echo $value1->text;?></a>
            </li>
            <?php } ?>

         <?php } ?>

      </ul>
      <div class="tab-content">
         <div role="tabpanel" class="tab-pane active" id="lineas_f">
            <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/compras_factura_lineas") . ( substr("block/compras_factura_lineas",-1,1) != "/" ? "/" : "" ) . basename("block/compras_factura_lineas") );?>

         </div>
         <div role="tabpanel" class="tab-pane" id="detalles">
            <div class="container-fluid" style="margin-top: 10px;">
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        Nombre del proveedor:
                        <input class="form-control" type="text" name="nombre" value="<?php echo $fsc->factura->nombre;?>" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        <?php  echo FS_CIFNIF;?>:
                        <input class="form-control" type="text" readonly name="cifnif" value="<?php echo $fsc->factura->cifnif;?>" maxlength="30" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        <a href="<?php echo $fsc->almacen->url();?>">Almacén</a>:
                        <select name="almacen" class="form-control" disabled="">
                        <?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codalmacen==$fsc->factura->codalmacen ){ ?>

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
                        <select name="divisa" class="form-control" disabled="">
                        <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->coddivisa==$fsc->factura->coddivisa ){ ?>

                           <option value="<?php echo $value1->coddivisa;?>" selected=""><?php echo $value1->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->coddivisa;?>"><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Tasa de conversión (1€ = X)
                        <input type="text" name="tasaconv" value="<?php echo $fsc->factura->tasaconv;?>" class="form-control" readonly=""/>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <h3>
                        <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                        &nbsp; Cuentas bancarias del proveedor:
                     </h3>
                     <div class="table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th width="30"></th>
                                 <th>Codcuenta + Descripción</th>
                                 <th>IBAN</th>
                                 <th>SWIFT/BIC</th>
                              </tr>
                           </thead>
                           <?php $loop_var1=$fsc->get_cuentas_bancarias(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <tr class="clickableRow" href="<?php echo $value1->url();?>">
                              <td class="text-right">
                                 <?php if( $value1->principal ){ ?>

                                 <span class="glyphicon glyphicon-flag" aria-hidden="true" title="Cuenta principal"></span>
                                 <?php } ?>

                              </td>
                              <td>
                                 <a href="<?php echo $value1->url();?>"><?php echo $value1->codcuenta;?></a>
                                 <?php echo $value1->descripcion;?>

                              </td>
                              <td><?php echo $value1->iban;?></td>
                              <td><?php echo $value1->swift;?></td>
                           </tr>
                           <?php }else{ ?>

                           <tr class="warning">
                              <td></td>
                              <td colspan="3">
                                 Este proveedor no tiene ninguna cuenta bancaria asignada.
                                 <?php if( $fsc->proveedor ){ ?>

                                 <a href="<?php echo $fsc->proveedor->url();?>#cuentasb">Nueva cuenta bancaria</a>.
                                 <?php } ?>

                              </td>
                           </tr>
                           <?php } ?>

                        </table>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <h3>
                        <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                        &nbsp; Desglose de impuestos:
                     </h3>
                     <div class="table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th class="text-left">Impuesto</th>
                                 <th class="text-right">Neto</th>
                                 <th class="text-right"><?php  echo FS_IVA;?></th>
                                 <th class="text-right">Total <?php  echo FS_IVA;?></th>
                                 <th class="text-right">RE</th>
                                 <th class="text-right">Total RE</th>
                                 <th class="text-right">Total</th>
                              </tr>
                           </thead>
                           <?php $loop_var1=$fsc->factura->get_lineas_iva(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <tr>
                              <td><?php echo $value1->codimpuesto;?></td>
                              <td class="text-right"><?php echo $fsc->show_precio($value1->neto, $fsc->factura->coddivisa);?></td>
                              <td class="text-right"><?php echo $fsc->show_numero($value1->iva, 2);?> %</td>
                              <td class="text-right"><?php echo $fsc->show_precio($value1->totaliva, $fsc->factura->coddivisa);?></td>
                              <td class="text-right"><?php echo $fsc->show_numero($value1->recargo, 2);?> %</td>
                              <td class="text-right"><?php echo $fsc->show_precio($value1->totalrecargo, $fsc->factura->coddivisa);?></td>
                              <td class="text-right"><?php echo $fsc->show_precio($value1->totallinea, $fsc->factura->coddivisa);?></td>
                           </tr>
                           <?php } ?>

                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
               <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&id=<?php echo $fsc->factura->idfactura;?>" width="100%" height="2000" frameborder="0"></iframe>
            </div>
            <?php } ?>

         <?php } ?>

      </div>
   </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/compras_factura_modals") . ( substr("block/compras_factura_modals",-1,1) != "/" ? "/" : "" ) . basename("block/compras_factura_modals") );?>


<?php }else{ ?>

<div class="thumbnail">
   <img src="<?php  echo FS_PATH;?>view/img/fuuu_face.png" alt="fuuuuu"/>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>