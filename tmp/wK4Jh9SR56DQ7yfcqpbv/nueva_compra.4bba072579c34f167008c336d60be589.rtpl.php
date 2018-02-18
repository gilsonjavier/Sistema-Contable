<?php if(!class_exists('raintpl')){exit;}?><script type="text/javascript" src="<?php echo $fsc->get_js_location('nueva_compra.js');?>"></script>
<script type="text/javascript">
    fs_nf0 = <?php  echo FS_NF0;?>;
    fs_nf0_art = <?php  echo FS_NF0_ART;?>;
    all_impuestos = <?php echo json_encode($fsc->impuesto->all()); ?>;
    default_impuesto = '<?php echo $fsc->default_items->codimpuesto();?>';
    all_series = <?php echo json_encode($fsc->serie->all()); ?>;
    proveedor = <?php echo json_encode($fsc->proveedor_s); ?>;
    nueva_compra_url = '<?php echo $fsc->url();?>';
    precio_compra = '<?php  echo FS_PRECIO_COMPRA;?>';
    
    <?php if( $fsc->empresa->recequivalencia ){ ?>

    tiene_recargo = true;
    <?php } ?>

    
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
    <input type="hidden" name="proveedor" value="<?php echo $fsc->proveedor_s->codproveedor;?>"/>
    <input type="hidden" name="redir"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 style="margin-top: 5px;">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <a href="<?php echo $fsc->proveedor_s->url();?>"><?php echo $fsc->proveedor_s->razonsocial;?></a>
                    <?php if( $fsc->proveedor_s->razonsocial!=$fsc->proveedor_s->nombre ){ ?>

                    <small>
                        <a href="#" onclick="bootbox.alert({message: 'Proveedor conocido como: <?php echo $fsc->proveedor_s->nombre;?>', title: '<b>Atención</b>'});">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        </a>
                    </small>
                    <?php } ?>

                </h1>
                <?php if( $fsc->proveedor_s->acreedor ){ ?>

                <p class="help-block"><?php echo $fsc->proveedor_s->razonsocial;?> es un acreedor.</p>
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
                    <select name="serie" class="form-control" id="codserie" onchange="usar_serie(); recalcular();">
                        <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->codserie==$fsc->proveedor_s->codserie ){ ?>

                        <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                        <?php }elseif( $value1->is_default() && is_null($fsc->proveedor_s->codserie) ){ ?>

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
                <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/nueva_compra_lineas") . ( substr("block/nueva_compra_lineas",-1,1) != "/" ? "/" : "" ) . basename("block/nueva_compra_lineas") );?>

            </div>
            <div role="tabpanel" class="tab-pane" id="detalles">
                <div class="container-fluid" style="margin-top: 10px;">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                Nombre del proveedor:
                                <input class="form-control" type="text" name="nombre" value="<?php echo $fsc->proveedor_s->razonsocial;?>" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <?php  echo FS_CIFNIF;?>:
                                <input class="form-control" type="text" name="cifnif" value="<?php echo $fsc->proveedor_s->cifnif;?>" maxlength="30" autocomplete="off"/>
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
                </div>
            </div>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
                <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&cod=<?php echo $fsc->proveedor_s->codproveedor;?>" width="100%" height="2000" frameborder="0"></iframe>
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
                <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                <?php if( $value1->type=='btn_javascript' ){ ?>

                <button class="btn btn-sm btn-default" type="button" onclick="<?php echo $value1->params;?>">
                    <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp; <?php echo $value1->text;?>

                </button>
                <?php } ?>

                <?php } ?>

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
                    <a href="#" class="label label-default" onclick="irpf = 21; recalcular();" title="Mostrar <?php  echo FS_IRPF;?>">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; <?php  echo FS_IRPF;?>

                    </a>&nbsp;
                    pulsa este botón para añadir <?php  echo FS_IRPF;?> al documento, o bien usa una serie que tenga <?php  echo FS_IRPF;?>.
                </p>
                <p class="help-block">
                    <a href="#" class="label label-default" onclick="tiene_recargo = true; recalcular();" title="Mostrar Recargo de Equivalencia">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; RE
                    </a>&nbsp;
                    pulsa este botón para añadir recargo de equivalencia al documento, o bien actívalo en la configuración de la empresa.
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
                    <p class="help-block">
                        Puedes programar compras usando el plugin
                        <a href="https://www.facturascripts.com/plugin/albaranes_programados" target="_blank">albaranes programados</a>.
                    </p>
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
                        Núm. proveedor:
                        <input class="form-control" type="text" name="numproveedor" autocomplete="off"/>
                        <p class="help-block">
                            Si quieres, puedes guardar el número de documento del proveedor
                        </p>
                    </div>
                    <div class="form-group">
                        <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
                        <select name="forma_pago" class="form-control">
                            <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                            <?php if( $fsc->proveedor_s->codpago==$value1->codpago ){ ?>

                            <option value="<?php echo $value1->codpago;?>" selected=""><?php echo $value1->descripcion;?></option>
                            <?php }else{ ?>

                            <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
                            <?php } ?>

                            <?php } ?>

                        </select>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="stock" value="TRUE" checked=""/>
                            Añadir al stock
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <?php if( FS_COST_IS_AVERAGE ){ ?>

                            <input type="checkbox" name="costemedio" value="TRUE" checked=""/>
                            <?php }else{ ?>

                            <input type="checkbox" name="costemedio" value="TRUE"/>
                            <?php } ?>

                            Actualizar precio de coste de los artículos
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button class="btn btn-sm btn-primary" type="button" onclick="this.disabled = true; this.form.submit();" title="Guardar y volver a empezar">
                            <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                        </button>
                        <button class="btn btn-sm btn-info" type="button" onclick="this.disabled = true; document.f_new_albaran.redir.value = 'TRUE'; this.form.submit();" title="Guardar y ver documento">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/modal_buscar_articulo_compras") . ( substr("block/modal_buscar_articulo_compras",-1,1) != "/" ? "/" : "" ) . basename("block/modal_buscar_articulo_compras") );?>