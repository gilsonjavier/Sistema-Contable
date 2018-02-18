<?php if(!class_exists('raintpl')){exit;}?><?php $dto1=$this->var['dto1']=$fsc->fbase_calc_due(array($fsc->factura->dtopor1));?>

<?php $dto2=$this->var['dto2']=$fsc->fbase_calc_due(array($fsc->factura->dtopor1,$fsc->factura->dtopor2));?>

<?php $dto3=$this->var['dto3']=$fsc->fbase_calc_due(array($fsc->factura->dtopor1,$fsc->factura->dtopor2,$fsc->factura->dtopor3));?>

<?php $dto4=$this->var['dto4']=$fsc->fbase_calc_due(array($fsc->factura->dtopor1,$fsc->factura->dtopor2,$fsc->factura->dtopor3,$fsc->factura->dtopor4));?>

<?php $dto5=$this->var['dto5']=$fsc->fbase_calc_due(array($fsc->factura->dtopor1,$fsc->factura->dtopor2,$fsc->factura->dtopor3,$fsc->factura->dtopor4,$fsc->factura->dtopor5));?>

<div class="table-responsive">
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
        <tbody id="lineas_documento" data-codigo="<?php echo $fsc->factura->codigo;?>">
            <?php $loop_var1=$lineas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <tr<?php if( $value1->cantidad<=0 ){ ?> class="warning"<?php } ?> id="linea_<?php echo $counter1;?>" data-ref="<?php echo $value1->referencia;?>" data-line="<?php echo $value1->idlinea;?>">
                <td>
                    <?php if( $value1->idalbaran ){ ?>

                    <a href="<?php echo $value1->albaran_url();?>"><?php echo $value1->albaran_codigo();?></a>
                    <?php echo $value1->albaran_numero();?>

                    <?php }else{ ?>

                    -
                    <?php } ?>

                </td>
                <td>
                    <a target="_blank" href="<?php echo $value1->articulo_url();?>"><?php echo $value1->referencia;?></a> <?php echo $value1->descripcion();?>

                </td>
                <td class="text-right"><?php echo $value1->cantidad;?></td>
                <td class="text-right"><?php echo $fsc->show_precio($value1->pvpunitario, $fsc->factura->coddivisa, TRUE, FS_NF0_ART);?></td>
                <td class="text-right"><?php echo $fsc->show_numero($value1->dtopor, 2);?> %</td>
                <td class="text-right dtosl"><?php echo $fsc->show_numero($value1->dtopor2, 2);?> %</td>
                <td class="text-right dtosl"><?php echo $fsc->show_numero($value1->dtopor3, 2);?> %</td>
                <td class="text-right dtosl"><?php echo $fsc->show_numero($value1->dtopor4, 2);?> %</td>
                <td class="text-right"><?php echo $fsc->show_precio($value1->pvptotal, $fsc->factura->coddivisa);?></td>
                <td class="text-right"><?php echo $fsc->show_numero($value1->iva, 2);?> %</td>
                <td class="text-right recargo"><?php echo $fsc->show_numero($value1->recargo, 2);?> %</td>
                <td class="text-right irpf"><?php echo $fsc->show_numero($value1->irpf, 2);?> %</td>
                <td class="text-right" readonly><?php echo $fsc->show_precio($value1->total_iva(), $fsc->factura->coddivisa);?></td>
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
                <?php if( $fsc->factura->coddivisa!=$fsc->empresa->coddivisa ){ ?>

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
                <?php if( $fsc->factura->coddivisa!=$fsc->empresa->coddivisa ){ ?>

                <td><?php echo $fsc->factura->coddivisa;?></td>
                <?php } ?>

                <td class="text-right"><?php echo $fsc->show_precio($fsc->factura->netosindto, $fsc->factura->coddivisa);?></td>
                <td class="text-right">
                    (<?php echo $fsc->factura->dtopor1;?>%)
                    <?php echo $fsc->show_precio($fsc->factura->netosindto*(1-$dto1), $fsc->factura->coddivisa);?>

                </td>
                <td class="text-right dtost">
                    (<?php echo $fsc->factura->dtopor2;?>%)
                    <?php echo $fsc->show_precio($fsc->factura->netosindto*($dto1-$dto2), $fsc->factura->coddivisa);?>

                </td>
                <td class="text-right dtost">
                    (<?php echo $fsc->factura->dtopor3;?>%)
                    <?php echo $fsc->show_precio($fsc->factura->netosindto*($dto2-$dto3), $fsc->factura->coddivisa);?>

                </td>
                <td class="text-right dtost">
                    (<?php echo $fsc->factura->dtopor4;?>%)
                    <?php echo $fsc->show_precio($fsc->factura->netosindto*($dto3-$dto4), $fsc->factura->coddivisa);?>

                </td>
                <td class="text-right dtost">
                    (<?php echo $fsc->factura->dtopor5;?>%)
                    <?php echo $fsc->show_precio($fsc->factura->netosindto*($dto4-$dto5), $fsc->factura->coddivisa);?>

                </td>
                <td class="text-right"><?php echo $fsc->show_precio($fsc->factura->neto, $fsc->factura->coddivisa);?></td>
                <td class="text-right"><?php echo $fsc->show_precio($fsc->factura->totaliva, $fsc->factura->coddivisa);?></td>
                <td class="text-right recargo"><?php echo $fsc->show_precio($fsc->factura->totalrecargo, $fsc->factura->coddivisa);?></td>
                <td class="text-right irpf">-<?php echo $fsc->show_precio($fsc->factura->totalirpf, $fsc->factura->coddivisa);?></td>
                <td class="text-right"><?php echo $fsc->show_precio($fsc->factura->total, $fsc->factura->coddivisa);?></td>
            </tr>
            <?php if( $fsc->factura->coddivisa!=$fsc->empresa->coddivisa ){ ?>

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
                    <b><?php echo $fsc->show_precio($fsc->euro_convert($fsc->factura->totaleuros, $fsc->factura->coddivisa, $fsc->factura->tasaconv));?></b>
                </td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php if( !in_array('editar_facturas', $GLOBALS['plugins']) ){ ?>

            <?php } ?>

            <div class="form-group">
                Observaciones:
                <textarea class="form-control" name="observaciones" rows="6"><?php echo $fsc->factura->observaciones;?></textarea>
            </div>
        </div>
    </div>
</div>
