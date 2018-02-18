<?php if(!class_exists('raintpl')){exit;}?><div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-left text-capitalize"><?php  echo FS_ALBARAN;?></th>
                <th class="text-left">Artículo</th>
                <th class="text-right" width="70">Cantidad</th>
                <th class="text-right" width="80">Precio</th>
                <th class="text-right" width="70">Dto</th>
                <th class="text-right" width="85">Neto</th>
                <th class="text-right" width="75"><?php  echo FS_IVA;?></th>
                <th class="recargo text-right" width="70">RE</th>
                <th class="irpf text-right" width="70"><?php  echo FS_IRPF;?></th>
                <th class="text-right" width="90">Total</th>
            </tr>
        </thead>
        <?php $loop_var1=$lineas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

        <tr<?php if( $value1->cantidad<=0 ){ ?> class="warning"<?php } ?>>
            <td>
                <?php if( $value1->idalbaran ){ ?>

                <a href="<?php echo $value1->albaran_url();?>"><?php echo $value1->albaran_codigo();?></a>
                <?php echo $value1->albaran_numero();?>

                <?php }else{ ?>

                -
                <?php } ?>

            </td>
            <td>
                <a href="<?php echo $value1->articulo_url();?>"><?php echo $value1->referencia;?></a> <?php echo $value1->descripcion();?>

            </td>
            <td class="text-right" min="0" ><?php echo $value1->cantidad;?></td>
            <td class="text-right"><?php echo $fsc->show_precio($value1->pvpunitario, $fsc->factura->coddivisa, TRUE, FS_NF0_ART);?></td>
            <td class="text-right"><?php echo $fsc->show_numero($value1->dtopor, 2);?> %</td>
            <td class="text-right"><?php echo $fsc->show_precio($value1->pvptotal, $fsc->factura->coddivisa);?></td>
            <td class="text-right"><?php echo $fsc->show_numero($value1->iva, 2);?> %</td>
            <td class="recargo text-right"><?php echo $fsc->show_numero($value1->recargo, 2);?> %</td>
            <td class="irpf text-right"><?php echo $fsc->show_numero($value1->irpf, 2);?> %</td>
            <td class="text-right"><?php echo $fsc->show_precio($value1->total_iva(), $fsc->factura->coddivisa);?></td>
        </tr>
        <?php }else{ ?>

        <tr class="warning">
            <td colspan="10">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                &nbsp; No hay líneas.
            </td>
        </tr>
        <?php } ?>

        <tr>
            <?php if( $fsc->factura->coddivisa!=$fsc->empresa->coddivisa ){ ?>

            <td colspan="5" class="text-right warning"><b><?php echo $fsc->factura->coddivisa;?>:</b></td>
            <?php }else{ ?>

            <td colspan="5"></td>
            <?php } ?>

            <td class="text-right"><b><?php echo $fsc->show_precio($fsc->factura->neto, $fsc->factura->coddivisa);?></b></td>
            <td class="text-right"><b><?php echo $fsc->show_precio($fsc->factura->totaliva, $fsc->factura->coddivisa);?></b></td>
            <td class="recargo text-right"><b><?php echo $fsc->show_precio($fsc->factura->totalrecargo, $fsc->factura->coddivisa);?></b></td>
            <td class="irpf text-right"><b>-<?php echo $fsc->show_precio($fsc->factura->totalirpf, $fsc->factura->coddivisa);?></b></td>
            <td class="text-right"><b><?php echo $fsc->show_precio($fsc->factura->total, $fsc->factura->coddivisa);?></b></td>
        </tr>
        <?php if( $fsc->factura->coddivisa!=$fsc->empresa->coddivisa ){ ?>

        <tr class="warning">
            <td colspan="5" class="text-right"><b><?php echo $fsc->empresa->coddivisa;?>:</b></td>
            <td></td>
            <td></td>
            <td class="recargo"></td>
            <td class="irpf"></td>
            <td class="text-right"><b><?php echo $fsc->show_precio($fsc->euro_convert($fsc->factura->totaleuros, $fsc->factura->coddivisa, $fsc->factura->tasaconv));?></b></td>
        </tr>
        <?php } ?>

    </table>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php if( !in_array('editar_facturas', $GLOBALS['plugins']) ){ ?>

            <p class="help-block text-right">
                Puedes editar las líneas de las facturas usando el plugin
                <a href="https://www.facturascripts.com/plugin/editar_facturas" target="_blank">editar facturas</a>.
            </p>
            <?php } ?>

            <div class="form-group">
                Observaciones:
                <textarea class="form-control" name="observaciones" rows="6"><?php echo $fsc->factura->observaciones;?></textarea>
            </div>
        </div>
    </div>
</div>