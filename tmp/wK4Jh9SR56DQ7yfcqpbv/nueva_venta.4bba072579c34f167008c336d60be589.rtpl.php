<?php if(!class_exists('raintpl')){exit;}?><script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript" src="<?php echo $fsc->get_js_location('nueva_venta.js');?>"></script>
<script type="text/javascript">
    fs_nf0 = <?php  echo FS_NF0;?>;
    fs_nf0_art = <?php  echo FS_NF0_ART;?>;
    all_impuestos = <?php echo json_encode($fsc->impuesto->all()); ?>;
    default_impuesto = '<?php echo $fsc->default_items->codimpuesto();?>';
    all_series = <?php echo json_encode($fsc->serie->all()); ?>;
    all_direcciones = <?php echo json_encode($fsc->cliente_s->get_direcciones()); ?>;
    cliente = <?php echo json_encode($fsc->cliente_s); ?>;
    nueva_venta_url = '<?php echo $fsc->url();?>';
    
    $(document).ready(function() {
        usar_serie();
        usar_almacen();
        usar_divisa();
        recalcular();
    });
</script>

<form id="f_new_albaran" class="form" name="f_new_albaran" action="<?php echo $fsc->url();?>" method="post">
    <input type="hidden" name="petition_id" value="<?php echo $fsc->random_string();?>"/>
    <input type="hidden" id="numlineas" name="numlineas" value="0"/>
    <input type="hidden" name="cliente" value="<?php echo $fsc->cliente_s->codcliente;?>"/>
    <input type="hidden" name="redir"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 style="margin-top: 5px; margin-bottom: 0px;">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <a href="<?php echo $fsc->cliente_s->url();?>"><?php echo $fsc->cliente_s->razonsocial;?></a>
                    <?php if( $fsc->cliente_s->razonsocial!=$fsc->cliente_s->nombre ){ ?>

                    <small>
                        <a href="#" onclick="bootbox.alert({message: 'Cliente conocido como: <?php echo $fsc->cliente_s->nombre;?>', title: '<b>Atención</b>'});">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        </a>
                    </small>
                    <?php } ?>

                </h1>
                <?php $loop_var1=$fsc->grupo->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                <?php if( $value1->codgrupo==$fsc->cliente_s->codgrupo ){ ?>

                <p class="help-block">
                    <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>&nbsp;
                    <a href="<?php echo $value1->url();?>"><?php echo $value1->nombre;?></a> &nbsp;
                    <?php if( $value1->codtarifa ){ ?>

                    <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                    tarifa <?php echo $value1->codtarifa;?>

                    <?php }elseif( $fsc->cliente_s->codtarifa ){ ?>

                    <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                    tarifa <?php echo $fsc->cliente_s->codtarifa;?>

                    <?php }else{ ?>

                    <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                    ninguna tarifa asignada.
                    <?php } ?>

                </p>
                <?php } ?>

                <?php } ?>

            </div>
            <?php if( $fsc->multi_almacen ){ ?>

            <div class="col-sm-2">
                <div class="form-group">
                    <a href="<?php echo $fsc->almacen->url();?>">Almacén</a>:
                    <select name="almacen" class="form-control" id="codalmacen" onchange="usar_almacen()">
                        <?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->is_default() ){ ?>

                        <option value="<?php echo $value1->codalmacen;?>" selected=""><?php echo $value1->nombre;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                        <?php } ?>

                        <?php } ?>

                    </select>
                </div>
            </div>
            <?php }else{ ?>

            <div class="col-sm-2">
                <input type="hidden" name="almacen" value="<?php echo $fsc->empresa->codalmacen;?>" id="codalmacen"/>
            </div>
            <?php } ?>

            <div class="col-sm-2">
                <div class="form-group">
                    <a href="<?php echo $fsc->serie->url();?>" class="text-capitalize"><?php  echo FS_SERIE;?></a>:
                    <select name="serie" class="form-control" id="codserie" onchange="usar_serie();recalcular();">
                        <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->codserie==$fsc->cliente_s->codserie ){ ?>

                        <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                        <?php }elseif( $value1->is_default() && is_null($fsc->cliente_s->codserie) ){ ?>

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
                    <select name="divisa" class="form-control" id="coddivisa" onchange="usar_divisa()">
                        <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->is_default() ){ ?>

                        <option value="<?php echo $value1->coddivisa;?>" selected=""><?php echo $value1->descripcion;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->coddivisa;?>"><?php echo $value1->descripcion;?></option>
                        <?php } ?>

                        <?php } ?>

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-right">
                <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                <?php if( $value1->type=='btn_javascript' ){ ?>

                <button class="btn btn-sm btn-default" type="button" onclick="<?php echo $value1->params;?>"><?php echo $value1->text;?></button>
                <?php } ?>

                <?php } ?>

            </div>
        </div>
    </div>

    <div role="tabpanel">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#lineas" aria-controls="lineas" role="tab" data-toggle="tab">
                    <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                    <span class="hidden-xs">&nbsp;Líneas</span>
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
            <div role="tabpanel" class="tab-pane active" id="lineas">
                <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/nueva_venta_lineas") . ( substr("block/nueva_venta_lineas",-1,1) != "/" ? "/" : "" ) . basename("block/nueva_venta_lineas") );?>

            </div>
            <div role="tabpanel" class="tab-pane" id="detalles">
                <div class="container-fluid" style="margin-top: 10px;">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                Nombre del cliente:
                                <input class="form-control" type="text" name="nombrecliente" value="<?php echo $fsc->cliente_s->razonsocial;?>" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <?php echo $fsc->cliente_s->tipoidfiscal;?>:
                                <input class="form-control" type="text" name="cifnif" value="<?php echo $fsc->cliente_s->cifnif;?>" maxlength="30" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <a href="<?php echo $fsc->agente->url();?>">Empleado</a>:
                                <select name="codagente" class="form-control">
                                    <option value="<?php echo $fsc->agente->codagente;?>"><?php echo $fsc->agente->get_fullname();?></option>
                                    <?php if( $fsc->user->admin ){ ?>

                                    <option value="<?php echo $fsc->agente->codagente;?>">-----</option>
                                    <?php $loop_var1=$fsc->agente->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <option value="<?php echo $value1->codagente;?>"><?php echo $value1->get_fullname();?></option>
                                    <?php } ?>

                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                Tasa de conversión (1€ = X)
                                <input type="text" name="tasaconv" class="form-control" placeholder="(predeterminada)" autocomplete="off"/>
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
                                        <?php $loop_var1=$fsc->cliente_s->get_direcciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                        <?php if( $value1->id==$fsc->direccion->id ){ ?>

                                        <option value="<?php echo $value1->id;?>" selected=""><?php echo $value1->descripcion;?></option>
                                        <?php }else{ ?>

                                        <option value="<?php echo $value1->id;?>"><?php echo $value1->descripcion;?></option>
                                        <?php } ?>

                                        <?php } ?>

                                        <?php if( $fsc->direccion ){ ?>

                                        <option value="">------</option>
                                        <option value="nueva">Guardar como nueva</option>
                                        <?php }else{ ?>

                                        <option value="nueva" selected="">Guardar como nueva</option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <a href="<?php echo $fsc->pais->url();?>">País</a>:
                                <select class="form-control" name="codpais">
                                    <?php if( $fsc->direccion ){ ?>

                                    <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <?php if( $value1->codpais==$fsc->direccion->codpais ){ ?>

                                    <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                                    <?php }else{ ?>

                                    <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                                    <?php } ?>

                                    <?php } ?>

                                    <?php }else{ ?>

                                    <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <?php if( $value1->is_default() ){ ?>

                                    <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                                    <?php }else{ ?>

                                    <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                                    <?php } ?>

                                    <?php } ?>

                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <span class="text-capitalize"><?php  echo FS_PROVINCIA;?></span>:
                                <?php if( $fsc->direccion ){ ?>

                                <input id="ac_provincia" class="form-control" type="text" name="provincia" value="<?php echo $fsc->direccion->provincia;?>"/>
                                <?php }else{ ?>

                                <input id="ac_provincia" class="form-control" type="text" name="provincia"/>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                Ciudad:
                                <?php if( $fsc->direccion ){ ?>

                                <input class="form-control" type="text" name="ciudad" value="<?php echo $fsc->direccion->ciudad;?>"/>
                                <?php }else{ ?>

                                <input class="form-control" type="text" name="ciudad"/>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                Código Postal:
                                <?php if( $fsc->direccion ){ ?>

                                <input class="form-control" type="text" name="codpostal" value="<?php echo $fsc->direccion->codpostal;?>" maxlength="10" autocomplete="off"/>
                                <?php }else{ ?>

                                <input class="form-control" type="text" name="codpostal" maxlength="10" autocomplete="off"/>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                Dirección:
                                <?php if( $fsc->direccion ){ ?>

                                <input class="form-control" type="text" name="direccion" value="<?php echo $fsc->direccion->direccion;?>" autocomplete="off"/>
                                <?php }else{ ?>

                                <input class="form-control" type="text" name="direccion" placeholder="Calle ..." autocomplete="off"/>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <span class="text-capitalize"><?php  echo FS_APARTADO;?></span>:
                                <?php if( $fsc->direccion ){ ?>

                                <input class="form-control" type="text" name="apartado" value="<?php echo $fsc->direccion->apartado;?>" maxlength="10" autocomplete="off"/>
                                <?php }else{ ?>

                                <input class="form-control" type="text" name="apartado" maxlength="10" autocomplete="off"/>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="envio">
                <div class="container-fluid" style="margin-top: 10px;">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                Nombre:
                                <input type="text" name="envio_nombre" class="form-control" placeholder="(opcional)" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                Apellidos:
                                <input type="text" name="envio_apellidos" class="form-control" placeholder="(opcional)" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <a href="<?php echo $fsc->agencia->url();?>">Agencia de transporte</a>:
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-plane" aria-hidden="true"></span>
                                    </span>
                                    <select name="envio_codtrans" class="form-control">
                                        <option value="">Ninguna</option>
                                        <option value="">------</option>
                                        <?php $loop_var1=$fsc->agencia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                        <option value="<?php echo $value1->codtrans;?>"><?php echo $value1->nombre;?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                Código de seguimiento:
                                <input type="text" name="envio_codigo" class="form-control" autocomplete="off"/>
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
                                        <?php $loop_var1=$fsc->cliente_s->get_direcciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                        <?php if( $value1->domenvio ){ ?>

                                        <option value="<?php echo $value1->id;?>"><?php echo $value1->descripcion;?></option>
                                        <option value="">------</option>
                                        <?php } ?>

                                        <?php } ?>

                                        <?php $loop_var1=$fsc->cliente_s->get_direcciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                        <?php if( !$value1->domenvio ){ ?>

                                        <option value="<?php echo $value1->id;?>"><?php echo $value1->descripcion;?></option>
                                        <?php } ?>

                                        <?php } ?>

                                        <option value="">------</option>
                                        <option value="nueva">Guardar como nueva</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <a href="<?php echo $fsc->pais->url();?>">País</a>:
                                <select class="form-control" name="envio_codpais">
                                    <?php if( $fsc->direccion ){ ?>

                                    <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <?php if( $value1->codpais==$fsc->direccion->codpais ){ ?>

                                    <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                                    <?php }else{ ?>

                                    <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                                    <?php } ?>

                                    <?php } ?>

                                    <?php }else{ ?>

                                    <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <?php if( $value1->is_default() ){ ?>

                                    <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                                    <?php }else{ ?>

                                    <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                                    <?php } ?>

                                    <?php } ?>

                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <span class="text-capitalize"><?php  echo FS_PROVINCIA;?></span>:
                                <input type="text" name="envio_provincia" id="ac_provincia2" class="form-control" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                Ciudad:
                                <input type="text" name="envio_ciudad" class="form-control" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                Código Postal:
                                <input type="text" name="envio_codpostal" class="form-control" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                Dirección:
                                <input type="text" name="envio_direccion" class="form-control" placeholder="Calle ..." autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <span class="text-capitalize"><?php  echo FS_APARTADO;?></span>:
                                <input type="text" name="envio_apartado" class="form-control" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
                <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&cod=<?php echo $fsc->cliente_s->codcliente;?>" width="100%" height="2000" frameborder="0"></iframe>
            </div>
            <?php } ?>

            <?php } ?>

        </div>
    </div>
    <div class="container-fluid" style="margin-top: 10px;">
        <div class="row">
            <div class="col-sm-6">
                <button class="btn btn-sm btn-default" type="button" onclick="window.location.href = '<?php echo $fsc->url();?>';">
                    <span class="glyphicon glyphicon-refresh"></span>&nbsp; Reiniciar
                </button>
            </div>
            <div class="col-sm-6 text-right">
                <button class="btn btn-sm btn-primary" type="button" onclick="$('#modal_guardar').modal('show');">
                    <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar...
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <br/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    Observaciones:
                    <textarea class="form-control" name="observaciones" rows="6"></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <p class="help-block">
                    Ajusta los precios fácilmente introduciendo primero la cantidad
                    y luego el total, se calculará el precio automaticamente.
                    También puedes ajustar el total de cada línea en cualquier momento,
                    se recalcula el descuento para ajustarse al precio final de la línea.
                </p>
                <p class="help-block">
                    <a href="#" class="label label-default" onclick="dtosl = !dtosl; recalcular();" title="Mostrar descuentos líneas adicionales">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; Dtos líneas
                    </a>&nbsp;
                    pulsa este botón para añadir descuentos adicionales a las líneas del documento.
                </p>
                <p class="help-block">
                    <a href="#" class="label label-default" onclick="dtost = !dtost; recalcular();" title="Mostrar descuentos totales adicionales">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; Dtos Totales
                    </a>&nbsp;
                    pulsa este botón para añadir descuentos adicionales al total del documento.
                </p>
                <p class="help-block">
                    <a href="#" class="label label-default" onclick="irpf = 21;recalcular();" title="Mostrar <?php  echo FS_IRPF;?>">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; <?php  echo FS_IRPF;?>

                    </a>&nbsp;
                    pulsa este botón para añadir <?php  echo FS_IRPF;?> al documento, o bien usa una serie que tenga <?php  echo FS_IRPF;?>.
                </p>
                <p class="help-block">
                    <a href="#" class="label label-default" onclick="cliente.recargo = true;recalcular();" title="Mostrar Recargo de Equivalencia">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; RE
                    </a>&nbsp;
                    pulsa este botón para añadir recargo de equivalencia al documento, o bien activa el recargo de
                    equivalencia en el cliente.
                </p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_guardar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Guardar como...</h4>
                </div>
                <div class="modal-body">
                    <?php $loop_var1=$fsc->tipos_a_guardar(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                    <div class="radio">
                        <label>
                            <?php if( $value1['tipo']==$fsc->tipo ){ ?>

                            <input type="radio" name="tipo" value="<?php echo $value1['tipo'];?>" checked=""/>
                            <?php }else{ ?>

                            <input type="radio" name="tipo" value="<?php echo $value1['tipo'];?>"/>
                            <?php } ?>

                            <?php echo $value1['nombre'];?>

                        </label>
                    </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    <input type="text" name="fecha" class="form-control datepicker" value="<?php echo $fsc->today();?>" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" name="hora" class="form-control" value="<?php echo $fsc->hour();?>" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class='text-capitalize'><?php  echo FS_NUMERO2;?>:</span>
                        <input class="form-control" type="text" name="numero2" autocomplete="off"/>
                        <p class="help-block">
                            Puedes usar este campo como desées. Incluso puedes cambiarle el nombre
                            desde Admin &gt; Panel de control &gt; Avanzado.
                        </p>
                    </div>
                    <div class="form-group">
                        <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
                        <select name="forma_pago" class="form-control">
                            <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                            <?php if( $fsc->cliente_s->codpago==$value1->codpago ){ ?>

                            <option value="<?php echo $value1->codpago;?>" selected=""><?php echo $value1->descripcion;?></option>
                            <?php }else{ ?>

                            <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
                            <?php } ?>

                            <?php } ?>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="stock" value="TRUE" checked="checked"/>
                                Descontar de stock
                            </label>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button id="btn_guardar1" class="btn btn-sm btn-primary" type="button" onclick="this.disabled = true;this.form.submit();" title="Guardar y volver a empezar">
                            <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                        </button>
                        <button id="btn_guardar2" class="btn btn-sm btn-info" type="button" onclick="this.disabled = true;document.f_new_albaran.redir.value = 'TRUE';this.form.submit();" title="Guardar y ver documento">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/modal_buscar_articulo") . ( substr("block/modal_buscar_articulo",-1,1) != "/" ? "/" : "" ) . basename("block/modal_buscar_articulo") );?>


<script type = "text/javascript">
    //alert('Este script valida el RUC del usuario y mostrará \n por pantalla si es una persona natural, jurídica o sociedad.\n');
    function validarc()
   {
    var i;
    var cedula;
    var acumulado;
    cedula=document.getElementById('ced').value;
    var instancia;
    acumulado=0;
    for (i=1;i<=9;i++)
    {
     if (i%2!=0)
     {
      instancia=cedula.substring(i-1,i)*2;
      if (instancia>9) instancia-=9;
     }
     else instancia=cedula.substring(i-1,i);
     acumulado+=parseInt(instancia);
    }
    while (acumulado>0)
     acumulado-=10;
    if (cedula.substring(9,10)!=(acumulado*-1))
    {
     alert("Documento no valido!!");
     document.getElementById('ced').value.setfocus();
    }
    alert("Documento valido !!");
   }
   
   
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
