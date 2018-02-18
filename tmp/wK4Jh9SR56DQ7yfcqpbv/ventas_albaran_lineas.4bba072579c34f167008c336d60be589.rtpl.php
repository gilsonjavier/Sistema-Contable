<?php if(!class_exists('raintpl')){exit;}?><?php $dto1=$this->var['dto1']=$fsc->fbase_calc_due(array($fsc->albaran->dtopor1));?>

<?php $dto2=$this->var['dto2']=$fsc->fbase_calc_due(array($fsc->albaran->dtopor1,$fsc->albaran->dtopor2));?>

<?php $dto3=$this->var['dto3']=$fsc->fbase_calc_due(array($fsc->albaran->dtopor1,$fsc->albaran->dtopor2,$fsc->albaran->dtopor3));?>

<?php $dto4=$this->var['dto4']=$fsc->fbase_calc_due(array($fsc->albaran->dtopor1,$fsc->albaran->dtopor2,$fsc->albaran->dtopor3,$fsc->albaran->dtopor4));?>

<?php $dto5=$this->var['dto5']=$fsc->fbase_calc_due(array($fsc->albaran->dtopor1,$fsc->albaran->dtopor2,$fsc->albaran->dtopor3,$fsc->albaran->dtopor4,$fsc->albaran->dtopor5));?>

<div class="table-responsive">
    <?php if( $fsc->albaran->ptefactura ){ ?>

    <table class="table table-condensed" style="margin-bottom: 0px;">
        <thead>
            <tr>
                <th class="text-left" width="180">Referencia</th>
                <th class="text-left">Descripción</th>
                <th class="text-right" width="90">Cantidad</th>
                <th width="50"></th>
                <th class="text-right" width="110">Precio</th>
                <th class="text-right" width="90">Dto. %</th>
                <th class="text-right dtosl" width="90">Dto. 2 %</th>
                <th class="text-right dtosl" width="90">Dto. 3 %</th>
                <th class="text-right dtosl" width="90">Dto. 4 %</th>
                <th class="text-right" width="130">Neto</th>
                <th class="text-right" width="115"><?php  echo FS_IVA;?></th>
                <th class="text-right recargo" width="115">RE %</th>
                <th class="text-right irpf" width="115"><?php  echo FS_IRPF;?> %</th>
                <th class="text-right" width="140">Total</th>
            </tr>
        </thead>
        <tbody id="lineas_doc" data-codigo="<?php echo $fsc->albaran->codigo;?>">
            <?php $loop_var1=$lineas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <tr id="linea_<?php echo $counter1;?>" data-ref="<?php echo $value1->referencia;?>" data-line="<?php echo $value1->idlinea;?>">
                <td>
                    <input type="hidden" name="idlinea_<?php echo $counter1;?>" value="<?php echo $value1->idlinea;?>"/>
                    <?php if( $value1->idlineapedido ){ ?>

                    <div class="input-group">
                        <a target="_blank" href="index.php?page=ventas_pedido&id=<?php echo $value1->idpedido;?>" class="input-group-addon" title="ver <?php  echo FS_PEDIDO;?>">P</a>
                        <div class="form-control">
                            <small><a target="_blank" href="<?php echo $value1->articulo_url();?>"><?php echo $value1->referencia;?></a></small>
                        </div>
                    </div>
                    <?php }else{ ?>

                    <div class="form-control">
                        <small><a target="_blank" href="<?php echo $value1->articulo_url();?>"><?php echo $value1->referencia;?></a></small>
                    </div>
                    <?php } ?>

                </td>
                <td><textarea class="form-control" name="desc_<?php echo $counter1;?>" onkeypress="teclear(event);return LetrasNumeros(event)" rows="1"><?php echo $value1->descripcion;?></textarea></td>
                <td>
                    <input type="number" step="any" min="0" onkeypress="teclear(event);return numeros(event)" id="cantidad_<?php echo $counter1;?>" class="form-control text-right" name="cantidad_<?php echo $counter1;?>"
                           value="<?php echo $value1->cantidad;?>" onchange="recalcular()" onkeyup="recalcular()" autocomplete="off" value="1"/>
                </td>
                <td>
                    <?php if( $fsc->allow_delete ){ ?>

                    <button class="btn btn-sm btn-danger" type="button" onclick="$('#linea_<?php echo $counter1;?>').remove();recalcular();">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    <?php } ?>

                </td>
                <td>
                    <input type="text" class="form-control text-right" id="pvp_<?php echo $counter1;?>" onkeypress="teclear(event);return numeros(event)" name="pvp_<?php echo $counter1;?>" value="<?php echo $value1->pvpunitario;?>"
                           onkeyup="recalcular()" onclick="this.select()" autocomplete="off"/>
                </td>
                <td>
                    <input type="text" id="dto_<?php echo $counter1;?>" name="dto_<?php echo $counter1;?>" onkeypress="teclear(event);return numeros(event)" value="<?php echo $value1->dtopor;?>" class="form-control text-right"
                           onkeyup="recalcular()" onclick="this.select()" autocomplete="off"/>
                </td>
                <td class="dtosl">
                    <input type="text" id="dto2_<?php echo $counter1;?>" name="dto2_<?php echo $counter1;?>" value="<?php echo $value1->dtopor2;?>" class="form-control text-right"
                           onkeyup="recalcular()" onclick="this.select()" autocomplete="off"/>
                </td>
                <td class="dtosl">
                    <input type="text" id="dto3_<?php echo $counter1;?>" name="dto3_<?php echo $counter1;?>" value="<?php echo $value1->dtopor3;?>" class="form-control text-right"
                           onkeyup="recalcular()" onclick="this.select()" autocomplete="off"/>
                </td>
                <td class="dtosl">
                    <input type="text" id="dto4_<?php echo $counter1;?>" name="dto4_<?php echo $counter1;?>" value="<?php echo $value1->dtopor4;?>" class="form-control text-right"
                           onkeyup="recalcular()" onclick="this.select()" autocomplete="off"/>
                </td>
                <td>
                    <input type="text" class="form-control text-right" onkeypress="teclear(event);return decimales(event)" id="neto_<?php echo $counter1;?>" onchange="ajustar_neto('<?php echo $counter1;?>')" onclick="this.select()" autocomplete="off"/>
                </td>
                <td>
                    <select class="form-control" id="iva_<?php echo $counter1;?>" name="iva_<?php echo $counter1;?>" onchange="ajustar_iva('<?php echo $counter1;?>')">
                        <?php $loop_var2=$fsc->impuesto->all(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                        <?php if( $value1->codimpuesto==$value2->codimpuesto OR $value1->iva==$value2->iva ){ ?>

                        <option value="<?php echo $value2->iva;?>" selected=""><?php echo $value2->descripcion;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value2->iva;?>"><?php echo $value2->descripcion;?></option>
                        <?php } ?>

                        <?php } ?>

                    </select>
                </td>
                <td class="recargo">
                    <input type="text" class="form-control text-right" id="recargo_<?php echo $counter1;?>" name="recargo_<?php echo $counter1;?>" value="<?php echo $value1->recargo;?>"
                           onchange="recalcular()" onclick="this.select()" autocomplete="off"/>
                </td>
                <td class="irpf">
                    <input type="text" class="form-control text-right" id="irpf_<?php echo $counter1;?>" name="irpf_<?php echo $counter1;?>" value="<?php echo $value1->irpf;?>"
                           onchange="recalcular()" onclick="this.select()" autocomplete="off"/>
                </td>
                <td class="warning" title="Cálculo aproximado del total de la linea">
                    <input type="text" class="form-control text-right" id="total_<?php echo $counter1;?>" readonly onchange="ajustar_total('<?php echo $counter1;?>')" onclick="this.select()" autocomplete="off"/>
                </td>
            </tr>
            <?php } ?>

        </tbody>
        <tfoot>
            <tr class="info">
                <td><input id="i_new_line" class="form-control" type="text" placeholder="Buscar para añadir..." autocomplete="off"/></td>
                <td>
                    <a href="#" class="btn btn-sm btn-default" title="Añadir sin buscar" onclick="return add_linea_libre()">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </a>
                </td>
                <td colspan="12" class="text-right">
                    <a href="#" class="label label-info" onclick="dtosl = !dtosl; recalcular();" title="Mostrar descuentos líneas adicionales">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; Dtos líneas
                    </a>
                    &nbsp;
                    <a href="#" class="label label-info" onclick="dtost = !dtost; recalcular();" title="Mostrar descuentos totales adicionales">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; Dtos Totales
                    </a>
                    &nbsp;
                    <a href="#" class="label label-info" onclick="cliente.recargo = true;recalcular();" title="Mostrar Recargo de Equivalencia">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; RE
                    </a>
                    &nbsp;
                    <a href="#" class="label label-info" onclick="irpf = 21;recalcular();" title="Mostrar <?php  echo FS_IRPF;?>">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; <?php  echo FS_IRPF;?>

                    </a>
                </td>
            </tr>
        </tfoot>
    </table>
    <table class="table table-condensed">
        <tfoot>
            <tr class="info">
                <?php if( $fsc->albaran->coddivisa!=$fsc->empresa->coddivisa ){ ?><th></th><?php } ?>

                <th class="text-right">Subtotal</th>
                <th class="text-right">Dto. %</th>
                <th class="dtost text-right">Dto. 2 %</th>
                <th class="dtost text-right">Dto. 3 %</th>
                <th class="dtost text-right">Dto. 4 %</th>
                <th class="dtost text-right">Dto. 5 %</th>
                <th class="text-right">Neto</th>
                <th class="text-right"><?php  echo FS_IVA;?></th>
                <th class="recargo text-right">Recargo</th>
                <th class="irpf text-right"><?php  echo FS_IRPF;?></th>
                <th class="text-right">Total</th>
            </tr>
            <tr class="info">
                <?php if( $fsc->albaran->coddivisa!=$fsc->empresa->coddivisa ){ ?>

                <td><div class="form-control text-right">(<?php echo $fsc->albaran->coddivisa;?>)</div></td>
                <?php } ?>

                <td>
                    <div id="anetosindto" readonly class="form-control text-right" onkeyup="recalcular()" onclick="this.select()"><?php echo $fsc->show_numero(0);?></div>
                </td>
                <td>
                    <input id="adtopor1" readonly name="adtopor1" class="form-control text-right" onkeyup="recalcular()" onclick="this.select()" value="<?php echo $fsc->albaran->dtopor1;?>"></input>
                </td>
                <td class="dtost">
                    <input id="adtopor2" name="adtopor2" class="form-control text-right" onkeyup="recalcular()" onclick="this.select()" value="<?php echo $fsc->albaran->dtopor2;?>"></input>
                </td>
                <td class="dtost">
                    <input id="adtopor3" name="adtopor3" class="form-control text-right" onkeyup="recalcular()" onclick="this.select()" value="<?php echo $fsc->albaran->dtopor3;?>"></input>
                </td>
                <td class="dtost">
                    <input id="adtopor4" name="adtopor4" class="form-control text-right" onkeyup="recalcular()" onclick="this.select()" value="<?php echo $fsc->albaran->dtopor4;?>"></input>
                </td>
                <td class="dtost">
                    <input id="adtopor5" name="adtopor5" class="form-control text-right" onkeyup="recalcular()" onclick="this.select()" value="<?php echo $fsc->albaran->dtopor5;?>"></input>
                </td>
                <td><div id="aneto" readonly class="form-control text-right"><?php echo $fsc->show_numero(0);?></div></td>
                <td><div id="aiva" readonly class="form-control text-right"><?php echo $fsc->show_numero(0);?></div></td>
                <td class="recargo"><div id="are" class="form-control text-right"><?php echo $fsc->show_numero(0);?></div></td>
                <td class="irpf"><div id="airpf" class="form-control text-right"><?php echo $fsc->show_numero(0);?></div></td>
                <td>
                    <input type="text" name="atotal" readonly id="atotal" class="form-control text-right" value="0" onchange="recalcular()" autocomplete="off"/>
                </td>
            </tr>
            <?php if( $fsc->user->admin && FS_DB_HISTORY ){ ?>

            <tr class="info">
                <?php if( $fsc->albaran->coddivisa!=$fsc->empresa->coddivisa ){ ?><td></td><?php } ?>

                <td class="text-right">
                    <?php echo $fsc->show_precio($fsc->albaran->netosindto, $fsc->albaran->coddivisa);?>

                </td>
                <td class="text-right">
                    <?php echo $fsc->show_precio($fsc->albaran->dtopor1, $fsc->albaran->coddivisa);?>

                </td>
                <td class="dtost text-right">
                    <?php echo $fsc->show_precio($fsc->albaran->dtopor2, $fsc->albaran->coddivisa);?>

                </td>
                <td class="dtost text-right">
                    <?php echo $fsc->show_precio($fsc->albaran->dtopor3, $fsc->albaran->coddivisa);?>

                </td>
                <td class="dtost text-right">
                    <?php echo $fsc->show_precio($fsc->albaran->dtopor4, $fsc->albaran->coddivisa);?>

                </td>
                <td class="dtost text-right">
                    <?php echo $fsc->show_precio($fsc->albaran->dtopor5, $fsc->albaran->coddivisa);?>

                </td>
                <td class="text-right">
                    <?php echo $fsc->show_precio($fsc->albaran->neto, $fsc->albaran->coddivisa);?>

                </td>
                <td class="text-right">
                    <?php echo $fsc->show_precio($fsc->albaran->totaliva, $fsc->albaran->coddivisa);?>

                </td>
                <td class="recargo text-right">
                    <?php echo $fsc->show_precio($fsc->albaran->totalrecargo, $fsc->albaran->coddivisa);?>

                </td>
                <td class="irpf text-right">
                    <?php echo $fsc->show_precio($fsc->albaran->totalirpf, $fsc->albaran->coddivisa);?>

                </td>
                <td class="text-right">
                    <?php echo $fsc->show_precio($fsc->albaran->total, $fsc->albaran->coddivisa);?>

                </td>
            </tr>
            <?php } ?>

        </tfoot>
    </table>
    <?php }else{ ?>

    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-left"><span class="text-capitalize"><?php  echo FS_ALBARAN;?></span></th>
                <th class="text-left">Artículo</th>
                <th class="text-right" width="70">Cantidad</th>
                <th class="text-right" width="80">Precio</th>
                <th class="text-right" width="70">Dto %</th>
                <th class="text-right dtosl" width="70">Dto 2 %</th>
                <th class="text-right dtosl" width="70">Dto 3 %</th>
                <th class="text-right dtosl" width="70">Dto 4 %</th>
                <th class="text-right" width="80">Neto</th>
                <th class="text-right" width="70"><?php  echo FS_IVA;?></th>
                <th class="text-right recargo" width="70">RE</th>
                <th class="text-right irpf" width="70"><?php  echo FS_IRPF;?></th>
                <th class="text-right" width="90">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $loop_var1=$lineas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <tr<?php if( $value1->cantidad<=0 ){ ?> class="warning"<?php } ?>>
                <td>
                    <?php if( $value1->idlineapedido ){ ?>

                    <a target="_blank" href="index.php?page=ventas_pedido&id=<?php echo $value1->idpedido;?>" class="btn btn-xs btn-default">
                        <span class="glyphicon glyphicon-paperclip" aria-hidden="true" title="ver <?php  echo FS_PEDIDO;?>"></span>
                    </a>
                    <?php } ?>

                </td>
                <td>
                    <a href="<?php echo $value1->articulo_url();?>"><?php echo $value1->referencia;?></a> <?php echo $value1->descripcion();?>

                </td>
                <td class="text-right"><?php echo $value1->cantidad;?></td>
                <td class="text-right"><?php echo $fsc->show_precio($value1->pvpunitario, $fsc->albaran->coddivisa, TRUE, FS_NF0_ART);?></td>
                <td class="text-right"><?php echo $fsc->show_numero($value1->dtopor, 2);?> %</td>
                <td class="text-right dtosl"><?php echo $fsc->show_numero($value1->dtopor2, 2);?> %</td>
                <td class="text-right dtosl"><?php echo $fsc->show_numero($value1->dtopor3, 2);?> %</td>
                <td class="text-right dtosl"><?php echo $fsc->show_numero($value1->dtopor4, 2);?> %</td>
                <td class="text-right"><?php echo $fsc->show_precio($value1->pvptotal, $fsc->albaran->coddivisa);?></td>
                <td class="text-right"><?php echo $fsc->show_numero($value1->iva, 2);?> %</td>
                <td class="text-right recargo"><?php echo $fsc->show_numero($value1->recargo, 2);?> %</td>
                <td class="text-right irpf"><?php echo $fsc->show_numero($value1->irpf, 2);?> %</td>
                <td class="text-right"><?php echo $fsc->show_precio($value1->total_iva(), $fsc->albaran->coddivisa);?></td>
            </tr>
            <?php }else{ ?>

            <tr class="warning">
                <td colspan="13">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    &nbsp; No hay líneas.
                </td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
    <table class="table table-hover">
        <thead>
            <tr>
                <?php if( $fsc->albaran->coddivisa!=$fsc->empresa->coddivisa ){ ?>

                <th>Divisa</th>
                <?php } ?>

                <th class="text-right">Subtotal</th>
                <th class="text-right">Dto.</th>
                <th class="text-right dtost">Dto. 2</th>
                <th class="text-right dtost">Dto. 3</th>
                <th class="text-right dtost">Dto. 4</th>
                <th class="text-right dtost">Dto. 5</th>
                <th class="text-right">Neto</th>
                <th class="text-right"><?php  echo FS_IVA;?></th>
                <th class="text-right recargo">Recargo</th>
                <th class="text-right irpf"><?php  echo FS_IRPF;?></th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php if( $fsc->albaran->coddivisa!=$fsc->empresa->coddivisa ){ ?>

                <td><?php echo $fsc->albaran->coddivisa;?></td>
                <?php } ?>

                <td class="text-right"><?php echo $fsc->show_precio($fsc->albaran->netosindto, $fsc->albaran->coddivisa);?></td>
                <td class="text-right">
                    (<?php echo $fsc->albaran->dtopor1;?>%)
                    <?php echo $fsc->show_precio($fsc->albaran->netosindto*(1-$dto1), $fsc->albaran->coddivisa);?>

                </td>
                <td class="text-right dtost">
                    (<?php echo $fsc->albaran->dtopor2;?>%)
                    <?php echo $fsc->show_precio($fsc->albaran->netosindto*($dto1-$dto2), $fsc->albaran->coddivisa);?>

                </td>
                <td class="text-right dtost">
                    (<?php echo $fsc->albaran->dtopor3;?>%)
                    <?php echo $fsc->show_precio($fsc->albaran->netosindto*($dto2-$dto3), $fsc->albaran->coddivisa);?>

                </td>
                <td class="text-right dtost">
                    (<?php echo $fsc->albaran->dtopor4;?>%)
                    <?php echo $fsc->show_precio($fsc->albaran->netosindto*($dto3-$dto4), $fsc->albaran->coddivisa);?>

                </td>
                <td class="text-right dtost">
                    (<?php echo $fsc->albaran->dtopor5;?>%)
                    <?php echo $fsc->show_precio($fsc->albaran->netosindto*($dto4-$dto5), $fsc->albaran->coddivisa);?>

                </td>
                <td class="text-right"><?php echo $fsc->show_precio($fsc->albaran->neto, $fsc->albaran->coddivisa);?></td>
                <td class="text-right"><?php echo $fsc->show_precio($fsc->albaran->totaliva, $fsc->albaran->coddivisa);?></td>
                <td class="text-right recargo"><?php echo $fsc->show_precio($fsc->albaran->totalrecargo, $fsc->albaran->coddivisa);?></td>
                <td class="text-right irpf">-<?php echo $fsc->show_precio($fsc->albaran->totalirpf, $fsc->albaran->coddivisa);?></td>
                <td class="text-right"><?php echo $fsc->show_precio($fsc->albaran->total, $fsc->albaran->coddivisa);?></td>
            </tr>
            <?php if( $fsc->albaran->coddivisa!=$fsc->empresa->coddivisa ){ ?>

            <tr class="warning">
                <td><?php echo $fsc->empresa->coddivisa;?></td>
                <td></td>
                <td></td>
                <td class="dtost"></td>
                <td class="dtost"></td>
                <td class="dtost"></td>
                <td class="dtost"></td>
                <td></td>
                <td></td>
                <td class="recargo"></td>
                <td class="irpf"></td>
                <td class="text-right">
                    <b><?php echo $fsc->show_precio($fsc->euro_convert($fsc->albaran->totaleuros, $fsc->albaran->coddivisa, $fsc->albaran->tasaconv));?></b>
                </td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
    <?php } ?>

</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                Observaciones:
                <textarea class="form-control" name="observaciones" rows="6"><?php echo $fsc->albaran->observaciones;?></textarea>
            </div>
        </div>
    </div>
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
