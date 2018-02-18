<?php if(!class_exists('raintpl')){exit;}?><div role="tabpanel" class="tab-pane" id="precios">
    <form action="<?php echo $fsc->url();?>#precios" method="post" class="form">
        <input type="hidden" name="referencia" value="<?php echo $fsc->articulo->referencia;?>"/>
        <input type="hidden" id="iva" name="iva" value="<?php echo $fsc->articulo->get_iva();?>"/>
        <div class="container-fluid" style="margin-top: 10px;">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        Precio:
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo $fsc->simbolo_divisa();?></span>
                            <input type="text" class="form-control" id="pvp" name="pvp" value="<?php echo $fsc->articulo->pvp;?>" autocomplete="off" placeholder="0.00" min="0" onkeypress="return decimales(event)" title="Ingrese un numero entero con 2 decimles. " pattern="[0-9_]{1,}[.]+[0-9_]{2}" onkeyup="cambiar_pvp()" onclick="this.select()"/>
                        </div>
                        <p class="help-block">
                            El precio se guarda con <b><?php  echo FS_NF0_ART;?> decimales</b>.
                            Puedes cambiarlo desde el <a href="index.php?page=admin_home#avanzado">panel de control</a>.
                        </p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <a href="<?php echo $fsc->impuesto->url();?>"><?php  echo FS_IVA;?></a>:
                        <select class="form-control" name="codimpuesto" onchange="this.form.submit()">
                            <?php $loop_var1=$fsc->impuesto->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                            <?php if( $value1->codimpuesto==$fsc->articulo->codimpuesto ){ ?>

                            <option value="<?php echo $value1->codimpuesto;?>" selected=""><?php echo $value1->descripcion;?></option>
                            <?php }else{ ?>

                            <option value="<?php echo $value1->codimpuesto;?>"><?php echo $value1->descripcion;?></option>
                            <?php } ?>

                            <?php } ?>

                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        Precio+<?php  echo FS_IVA;?>:
                        <div class="input-group">
                            <input type="text" class="form-control" id="pvpi" name="pvpiva" value="<?php echo $fsc->articulo->pvp_iva();?>" autocomplete="off" onkeyup="cambiar_pvpi()" onclick="this.select()" readonly/>
                            <span class="input-group-addon" title="precio redondeado"><?php echo $fsc->show_precio($fsc->articulo->pvp_iva(), FALSE, TRUE, FS_NF0_ART);?></span>
                        </div>
                        <p class="help-block">Último cambio de precio: <?php echo $fsc->articulo->factualizado;?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        Precio de Coste:
                        <?php if( $fsc->articulo->secompra && FS_COST_IS_AVERAGE ){ ?>

                        <input type="text" name="coste" id="coste" class="form-control" value="<?php echo $fsc->articulo->preciocoste();?>" disabled="disabled"/>
                        <p class="help-block">
                            El precio de compra se calcula automáticamente. Si quieres editarlo puedes
                            desmarcar <b>se compra</b> en la primera pestaña, o bien cambiar la configuración
                            de precio de coste desde la configuración del <a href="index.php?page=admin_almacenes">almacén</a>.
                        </p>
                        <?php }else{ ?>

                        <input type="text" name="preciocoste" id="coste" class="form-control" value="<?php echo $fsc->articulo->preciocoste();?>" onkeyup="cambiar_margen()" onclick="this.select()" autocomplete="off"/>
                        <?php } ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        Margen sobre precio de coste
                        <div class="input-group">
                            <span class="input-group-addon">%</span>
                            <input type="text" class="form-control" id="margen" name="margen" value="0" autocomplete="off" onkeyup="cambiar_margen()" onclick="this.select()"/>
                        </div>
                        <p class="help-block">
                            Sirve para calcular el precio, pero no se almacena. Se aplica el
                            <a href="https://en.wikipedia.org/wiki/Gross_margin">gross margin</a>.
                        </p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="hidden-xs"><br/></div>
                    <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled = true;this.form.submit();">
                        <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                    </button>
                    <div class="visible-xs"><br/></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <br/>
                    <ul class="nav nav-pills" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tarifas" aria-controls="tarifas" role="tab" data-toggle="tab">
                                <i class="fa fa-usd" aria-hidden="true"></i> Tarifas
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#proveedores" aria-controls="proveedores" role="tab" data-toggle="tab">
                                <i class="fa fa-users" aria-hidden="true"></i> Proveedores
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tarifas">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-left">Tarifa</th>
                                            <th class="text-left">Aplicar</th>
                                            <th class="text-right">Nuevo Precio</th>
                                            <th class="text-right">Nuevo Precio+<?php  echo FS_IVA;?></th>
                                        </tr>
                                    </thead>
                                    <?php $loop_var1=$fsc->get_tarifas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <tr>
                                        <td width="120"><div class="form-control"><a href="<?php echo $value1->tarifa_url;?>"><?php echo $value1->codtarifa;?></a></div></td>
                                        <td><div class="form-control"><?php echo $value1->tarifa_nombre;?></div></td>
                                        <td><div class="form-control"><?php echo $value1->tarifa_diff;?></div></td>
                                        <td class="text-right">
                                            <div class="form-control"><?php echo $fsc->show_precio($value1->pvp*(100 - $value1->dtopor)/100, FALSE, TRUE, FS_NF0_ART);?></div>
                                        </td>
                                        <td class="text-right">
                                            <div class="form-control"><?php echo $fsc->show_precio($value1->pvp*(100 - $value1->dtopor)/100*(100 + $value1->get_iva())/100, FALSE, TRUE, FS_NF0_ART);?></div>
                                        </td>
                                    </tr>
                                    <?php }else{ ?>

                                    <tr class="warning">
                                        <td colspan="5">No hay tarifas definidas.</td>
                                    </tr>
                                    <?php } ?>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <a class="btn btn-sm btn-success" href="index.php?page=ventas_articulos#tarifas">
                                <span class="glyphicon glyphicon-plus-sign"></span>&nbsp; Nueva tarifa
                            </a>
                        </div>
                        <div class="col-sm-10">
                            <p class='help-block text-right'>
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                <b>Importante</b>: ten en cuenta que si la tarifa tiene marcado
                                <b>precio mínimo</b>, por mucho que cambies no podrás poner un precio
                                inferior al precio de coste. De la misma manera, si la tarifa tiene
                                marcado <b>precio máximo</b>, nunca podrás superar el precio de venta
                                del artículo.
                            </p>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="proveedores">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Proveedor</th>
                                            <th>Ref. Proveedor</th>
                                            <th class="text-right">Precio</th>
                                            <th class="text-right">Descuento</th>
                                            <th class="text-right">Total+<?php  echo FS_IVA;?></th>
                                            <th class="text-right">Stock</th>
                                        </tr>
                                    </thead>
                                    <?php $loop_var1=$fsc->get_articulo_proveedores(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <tr>
                                        <td><a href="<?php echo $value1->url_proveedor();?>"><?php echo $value1->nombre_proveedor();?></a></td>
                                        <td><?php echo $value1->refproveedor;?></td>
                                        <td class="text-right"><?php echo $fsc->show_precio($value1->precio);?></td>
                                        <td class="text-right"><?php echo $fsc->show_numero($value1->dto);?> %</td>
                                        <td class="text-right"><?php echo $fsc->show_precio($value1->total_iva());?></td>
                                        <td class="text-right">
                                            <?php if( $value1->nostock ){ ?>-<?php }else{ ?><?php echo $value1->stock;?><?php } ?>

                                        </td>
                                    </tr>
                                    <?php }else{ ?>

                                    <tr><td colspan="6" class="warning">Sin resultados.</td></tr>
                                    <?php } ?>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="help-block">
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                Estos son los proveedores a los que <b>has comprado</b> este producto,
                                sus referencias, su último precio, descuento y su stock, si lo ofrecen.
                                Si quieres que un proveedor aparezca aquí, crea un <?php  echo FS_PEDIDO;?>

                                o <?php  echo FS_ALBARAN;?> de compra con ese proveedor y este artículo.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
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
  