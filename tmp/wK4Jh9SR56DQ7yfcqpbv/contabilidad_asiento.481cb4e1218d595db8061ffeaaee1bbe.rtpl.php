<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->asiento ){ ?>

<script type="text/javascript" src="<?php echo $fsc->get_js_location('contabilidad_asiento.js');?>"></script>
<script type="text/javascript">
   numlineas = <?php echo count($fsc->lineas); ?>;
   fsc_url = '<?php echo $fsc->url();?>';
   fs_nf0 = <?php  echo FS_NF0;?>;
   
   function add_partida() {
      numlineas++;
      $("#partidas").append("<tr id='partida_"+numlineas+"'>\n\
         <td>\n\
            <input type='hidden' name='idpartida_"+numlineas+"' value='-1'/>\n\
            <input class='form-control' id='codsubcuenta_"+numlineas+"' name='codsubcuenta_"+numlineas+"' type='text'\n\
               onclick=\"show_buscar_subcuentas('"+numlineas+"','subcuenta')\" onkeyup='document.f_buscar_subcuentas.query.value=$(this).val();buscar_subcuentas()'\n\
               autocomplete='off' placeholder='Seleccionar'/>\n\
         </td>\n\
         <td></td>\n\
         <td>\n\
            <input class='form-control' type='text' id='desc_"+numlineas+"' name='desc_"+numlineas+"' disabled='disabled'/>\n\
         </td>\n\
         <td>\n\
            <input class='form-control text-right' type='text' id='saldo_"+numlineas+"' name='saldo_"+numlineas+"' value='0' disabled='disabled'/>\n\
         </td>\n\
         <td>\n\
            <input class='form-control text-right' type='text' id='debe_"+numlineas+"' name='debe_"+numlineas+"' value='0'\n\
               onclick='this-select()' onkeyup='recalcular()' autocomplete='off'/>\n\
         </td>\n\
         <td>\n\
            <input class='form-control text-right' type='text' id='haber_"+numlineas+"' name='haber_"+numlineas+"' value='0'\n\
               onclick='this-select()' onkeyup='recalcular()' autocomplete='off'/>\n\
         </td>\n\
         <td>\n\
            <input class='form-control' id='codcontrapartida_"+numlineas+"' name='codcontrapartida_"+numlineas+"' type='text'\n\
               onclick=\"show_buscar_subcuentas('"+numlineas+"','contrapartida')\" onkeyup='document.f_buscar_subcuentas.query.value=$(this).val();buscar_subcuentas()'\n\
               autocomplete='off' placeholder='Seleccionar'/>\n\
         </td>\n\
         <td class='contrapartida'>\n\
            <input class='form-control text-right' type='text' id='saldoc_"+numlineas+"' name='saldoc_"+numlineas+"' value='0' disabled='disabled'/>\n\
         </td>\n\
         <td class='contrapartida'>\n\
            <select id='iva_"+numlineas+"' name='iva_"+numlineas+"' onchange='recalcular()' class='form-control'>\n\
               <option value='0'>---</option>\n\
               <?php $loop_var1=$fsc->impuesto->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><option value='<?php echo $value1->iva;?>'><?php echo $value1->descripcion;?></option><?php } ?>\n\
            </select>\n\
         </td>\n\
         <td class='contrapartida'>\n\
            <input class='form-control text-right' type='text' id='baseimp_"+numlineas+"' name='baseimp_"+numlineas+"' value='0' autocomplete='off'/>\n\
         </td>\n\
         <td class='contrapartida'>\n\
            <input class='form-control text-right' type='text' id='cifnif_"+numlineas+"' name='cifnif_"+numlineas+"'/>\n\
         </td>\n\
         <td class='text-right'>\n\
            <a class='btn btn-sm btn-danger' onclick=\"clean_partida('"+numlineas+"')\">\n\
               <span class='glyphicon glyphicon-trash'></span>\n\
            </a>\n\
         </td>\n\
      </tr>");
      recalcular();
   }
   $(document).ready(function() {
      <?php if( $fsc->asiento->editable ){ ?>recalcular();<?php } ?>

      $("#b_eliminar_asiento").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Estas seguro de que deseas eliminar este asiento?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = "<?php echo $fsc->ppage->url();?>&delete=<?php echo $fsc->asiento->idasiento;?>";
               }
            }
         });
      });
      $("#f_buscar_subcuentas").submit(function(event) {
         event.preventDefault();
         buscar_subcuentas();
      });
   });
</script>

<?php if( $fsc->asiento->editable ){ ?>

<form id="f_asiento" name="f_asiento" action="<?php echo $fsc->url();?>" method="post">
    <input type="hidden" name="numlineas" value="0"/>
    <div class="container-fluid">
        <div class="row hidden-print" style="margin-bottom: 10px;">
            <div class="col-xs-6">
                <div class="btn-group">
                    <a class="btn btn-sm btn-default" href="index.php?page=contabilidad_asientos">
                        <span class="glyphicon glyphicon-arrow-left"></span>
                        <span class="hidden-xs">&nbsp;Asientos</span>
                    </a>
                    <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>
                </div>
                <div class="btn-group">
                    <a class="btn btn-sm btn-default" href="index.php?page=contabilidad_nuevo_asiento&copy=<?php echo $fsc->asiento->idasiento;?>">
                        <span class="glyphicon glyphicon-scissors"></span>
                        <span class="hidden-xs">&nbsp;Copiar</span>
                    </a>
                    <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                    <?php if( $value1->type=='button' ){ ?>

                    <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
                    <?php } ?>

                    <?php } ?>

                </div>
                <a class="btn btn-sm btn-default" onclick="window.print();">
                    <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                </a>
            </div>
            <div class="col-xs-6 text-right">
                <div class="btn-group">
                    <?php if( $fsc->allow_delete ){ ?>

                    <a href="#" id="b_eliminar_asiento" class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                        <span class="hidden-sm hidden-xs">&nbsp;Eliminar</span>
                    </a>
                    <?php } ?>

                    <a href="<?php echo $fsc->url();?>&bloquear=TRUE" class="btn btn-sm btn-default">
                        <span class="glyphicon glyphicon-lock"></span>
                        <span class="hidden-sm hidden-xs">&nbsp;Bloquear</span>
                    </a>
                    <button type="button" id="b_guardar_asiento" class="btn btn-sm btn-primary" onclick="guardar_asiento()">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                        <span class="hidden-xs">&nbsp;Guardar</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    Fecha:
                    <input class="form-control datepicker" readonly name="fecha" type="text" value="<?php echo $fsc->asiento->fecha;?>"/>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    Concepto:
                    <input class="form-control" name="concepto"onkeypress="teclear(event);return LetrasNumeros(event)" type="text" value="<?php echo $fsc->asiento->concepto;?>" autocomplete="off"/>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    Divisa:
                    <select id="divisa" class="form-control" name="divisa" disabled="">
                        <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->coddivisa==$fsc->asiento->coddivisa() ){ ?>

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
                    Importe:
                    <input class="form-control text-right" type="text" name="importe" value="<?php echo $fsc->asiento->importe;?>" disabled="disabled"/>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    Descuadre:
                    <input class="form-control text-right" type="text" name="descuadre" value="0" disabled="disabled"/>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-left" width="135">Subcuenta</th>
                    <th class="hidden-print" width="50"></th>
                    <th class="text-left hidden-print">Descripción</th>
                    <th class="text-right" width="110">Saldo</th>
                    <th class="text-right" width="110">Debe</th>
                    <th class="text-right" width="110">Haber</th>
                    <th class="text-left" width="135">Contrapartida</th>
                    <th class="text-right contrapartida" width="110">Saldo</th>
                    <th class="text-right contrapartida"><?php  echo FS_IVA;?></th>
                    <th class="text-right contrapartida" width="110">Base Imp.</th>
                    <th class="text-left contrapartida"><?php  echo FS_CIFNIF;?></th>
                    <th class="hidden-print" width="50"></th>
                </tr>
            </thead>
            <tbody id="partidas">
                <?php $loop_var1=$fsc->lineas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                <tr id="partida_<?php echo $counter1+1;?>">
                    <td>
                        <input type="hidden" name="idpartida_<?php echo $counter1+1;?>" value="<?php echo $value1->idpartida;?>"/>
                        <input class="form-control" id='codsubcuenta_<?php echo $counter1+1;?>' name='codsubcuenta_<?php echo $counter1+1;?>' type='text'
                               value="<?php echo $value1->codsubcuenta;?>" onclick="show_buscar_subcuentas('<?php echo $counter1+1;?>', 'subcuenta')"
                               onkeyup='document.f_buscar_subcuentas.query.value = $(this).val();buscar_subcuentas()'
                               autocomplete='off' placeholder='Seleccionar'/>
                    </td>
                    <td class="hidden-print">
                        <a href="<?php echo $value1->subcuenta_url();?>" target="_blank" class="btn btn-sm btn-default" title="ver la subcuenta">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>
                    </td>
                    <td class="hidden-print">
                        <input class='form-control' type='text' id='desc_<?php echo $counter1+1;?>' name='desc_<?php echo $counter1+1;?>' value='<?php echo $value1->desc_subcuenta;?>' disabled='disabled'/>
                    </td>
                    <td>
                        <input class='form-control text-right' type='text' id='saldo_<?php echo $counter1+1;?>' name='saldo_<?php echo $counter1+1;?>'
                               value='<?php echo round($value1->saldo, FS_NF0); ?>' disabled='disabled'/>
                    </td>
                    <td>
                        <input class='form-control text-right' type='text' placeholder="0.00" onkeypress="return decimales(event)" title="Ingrese un numero entero con 2 decimles. " autocomplete="off" pattern="[0-9_]{1,}[.]+[0-9_]{2}"  id='debe_<?php echo $counter1+1;?>' name='debe_<?php echo $counter1+1;?>' value='<?php echo $value1->debe;?>'
                               onclick='this - select()' onkeyup='recalcular()' autocomplete='off'/>
                    </td>
                    <td>
                        <input class='form-control text-right' type='text'  placeholder="0.00" onkeypress="return decimales(event)" title="Ingrese un numero entero con 2 decimles. " autocomplete="off" pattern="[0-9_]{1,}[.]+[0-9_]{2}"  id='haber_<?php echo $counter1+1;?>' name='haber_<?php echo $counter1+1;?>' value='<?php echo $value1->haber;?>'
                               onclick='this - select()' onkeyup='recalcular()' autocomplete='off'/>
                    </td>
                    <td>
                        <input class='form-control' id='codcontrapartida_<?php echo $counter1+1;?>' name='codcontrapartida_<?php echo $counter1+1;?>' type='text'
                               value='<?php echo $value1->codcontrapartida;?>' onclick="show_buscar_subcuentas('<?php echo $counter1+1;?>', 'contrapartida')"
                               onkeyup='document.f_buscar_subcuentas.query.value = $(this).val();buscar_subcuentas()'
                               autocomplete='off' placeholder='Seleccionar'/>
                    </td>
                    <td class="contrapartida">
                        <input class='form-control text-right' type='text' id='saldoc_<?php echo $counter1+1;?>' name='saldoc_<?php echo $counter1+1;?>' value='0' disabled='disabled'/>
                    </td>
                    <td class="contrapartida">
                        <select class='form-control' id='iva_<?php echo $counter1+1;?>' name='iva_<?php echo $counter1+1;?>' onchange='recalcular()'<?php if( !$value1->codcontrapartida ){ ?> disabled='disabled'<?php } ?>>
                            <option value='0'>---</option>
                            <?php $loop_var2=$fsc->impuesto->all(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                            <?php if( $value1->iva==$value2->iva ){ ?>

                            <option value='<?php echo $value2->iva;?>' selected=""><?php echo $value2->descripcion;?></option>
                            <?php }else{ ?>

                            <option value='<?php echo $value2->iva;?>'><?php echo $value2->descripcion;?></option>
                            <?php } ?>

                            <?php } ?>

                        </select>
                    </td>
                    <td class="contrapartida">
                        <input class='form-control text-right' type='text' id='baseimp_<?php echo $counter1+1;?>' name='baseimp_<?php echo $counter1+1;?>'
                               value='<?php echo $value1->baseimponible;?>' autocomplete='off'<?php if( !$value1->codcontrapartida ){ ?> disabled='disabled'<?php } ?>/>
                    </td>
                    <td class="contrapartida">
                        <input class='form-control' type='text' id='cifnif_<?php echo $counter1+1;?>' name='cifnif_<?php echo $counter1+1;?>' value='<?php echo $value1->cifnif;?>'<?php if( !$value1->codcontrapartida ){ ?> disabled='disabled'<?php } ?>/>
                    </td>
                    <td class="text-right hidden-print">
                        <button class="btn btn-sm btn-danger" type="button" onclick="clean_partida('<?php echo $counter1+1;?>')">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <div class="container-fluid hidden-print">
        <div class="row">
            <div class="col-xs-6">
                <a href="#" class="btn btn-sm btn-success" onclick="add_partida();return false;">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    <span class="hidden-xs">&nbsp; Añadir línea</span>
                </a>
            </div>
            <div class="col-xs-6 text-right">
                <button type="button" id="b_guardar_asiento_2" class="btn btn-sm btn-primary" onclick="guardar_asiento()">
                    <span class="glyphicon glyphicon-floppy-disk"></span>
                    <span class="hidden-xs">&nbsp; Guardar</span>
                </button>
            </div>
        </div>
    </div>
</form>
<?php }else{ ?>

<div class="container-fluid hidden-print" style="margin-bottom: 10px;">
    <div class="row">
        <div class="col-xs-8">
            <div class="btn-group">
                <a class="btn btn-sm btn-default" href="index.php?page=contabilidad_asientos">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                    <span class="hidden-xs">&nbsp;Asientos</span>
                </a>
                <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                    <span class="glyphicon glyphicon-refresh"></span>
                </a>
            </div>
            <div class="btn-group">
                <a class="btn btn-sm btn-default" href="index.php?page=contabilidad_nuevo_asiento&copy=<?php echo $fsc->asiento->idasiento;?>">
                    <span class="glyphicon glyphicon-scissors"></span>
                    <span class="hidden-xs">&nbsp;Copiar</span>
                </a>
                <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                <?php if( $value1->type=='button' ){ ?>

                <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
                <?php } ?>

                <?php } ?>

            </div>
            <a class="btn btn-sm btn-default" onclick="window.print();">
                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
            </a>
        </div>
        <div class="col-xs-4 text-right">
            <div class="btn-group">
                <a href="<?php echo $fsc->url();?>&desbloquear=TRUE" class="btn btn-sm btn-default">
                    <span class="glyphicon glyphicon-lock"></span>
                    <span class="hidden-xs">&nbsp;Desbloquear</span>
                </a>
                <?php if( $fsc->allow_delete ){ ?>

                <a href="#" id="b_eliminar_asiento" class="btn btn-sm btn-danger">
                    <span class="glyphicon glyphicon-trash"></span>
                    <span class="hidden-xs">&nbsp;Eliminar</span>
                </a>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-left">Asiento</th>
                <th>Ejercicio</th>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Documento</th>
                <th class="text-right">Importe</th>
            </tr>
        </thead>
        <tr>
            <td><?php echo $fsc->asiento->numero;?></td>
            <td>
                <a href="<?php echo $fsc->asiento->ejercicio_url();?>" class="hidden-print"><?php echo $fsc->asiento->codejercicio;?></a>
                <span class="visible-print"><?php echo $fsc->asiento->codejercicio;?></span>
            </td>
            <td><?php echo $fsc->asiento->fecha;?></td>
            <td><?php echo $fsc->asiento->concepto;?></td>
            <td>
                <?php if( $fsc->asiento->tipodocumento ){ ?><?php echo $fsc->asiento->tipodocumento;?>:<?php } ?>

                <?php if( $fsc->asiento->documento ){ ?>

                <a href='<?php echo $fsc->asiento->factura_url();?>' class="hidden-print"><?php echo $fsc->asiento->documento;?></a>
                <span class="visible-print"><?php echo $fsc->asiento->documento;?></span>
                <?php }else{ ?>

                -
                <?php } ?>

            </td>
            <td class="text-right"><?php echo $fsc->show_precio($fsc->asiento->importe);?></td>
        </tr>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Subcuenta + descripción</th>
                <th class="text-right">Debe</th>
                <th class="text-right">Haber</th>
                <th></th>
                <th class="text-right">Base imponible</th>
                <th class="text-center">Contrapartida</th>
                <th class="text-right"><?php  echo FS_CIFNIF;?></th>
            </tr>
        </thead>
        <tbody>
            <?php $loop_var1=$fsc->lineas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <tr>
                <td>
                    <a href="<?php echo $value1->subcuenta_url();?>" class="hidden-print"><?php echo $value1->codsubcuenta;?></a>
                    <span class="visible-print"><?php echo $value1->codsubcuenta;?></span>
                    <?php echo $value1->desc_subcuenta;?>

                </td>
                <td class="text-right"><span title="<?php echo $value1->debe;?>"><?php echo $fsc->show_precio($value1->debe, $value1->coddivisa);?></span></td>
                <td class="text-right"><span title="<?php echo $value1->haber;?>"><?php echo $fsc->show_precio($value1->haber, $value1->coddivisa);?></span></td>
                <td class="text-right">
                    <?php if( $value1->iva!=0 ){ ?>

                    <?php  echo FS_IVA;?>: <?php echo $value1->iva;?>%
                    <?php }elseif( $value1->recargo!=0 ){ ?>

                    RE: <?php echo $value1->recargo;?>%
                    <?php }else{ ?>

                    -
                    <?php } ?>

                </td>
                <td class="text-right">
                    <?php if( $value1->baseimponible!=0 ){ ?><?php echo $fsc->show_precio($value1->baseimponible, $value1->coddivisa);?><?php }else{ ?>-<?php } ?>

                </td>
                <td class="text-center">
                    <?php if( $value1->codcontrapartida ){ ?>

                    <a href="<?php echo $value1->contrapartida_url();?>" class="hidden-print"><?php echo $value1->codcontrapartida;?></a>
                    <span class="visible-print"><?php echo $value1->codcontrapartida;?></span>
                    <?php }else{ ?>

                    -
                    <?php } ?>

                </td>
                <td class="text-right"><?php if( $value1->cifnif ){ ?><?php echo $value1->cifnif;?><?php }else{ ?>-<?php } ?></td>
            </tr>
            <?php }else{ ?>

            <tr class="warning">
                <td colspan="7">Sin líneas.</td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>

<?php if( $fsc->asiento->documento ){ ?>

<br/><br/>
<div class="container-fluid hidden-print">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        ¿Quieres modificar el cómo se generan los asientos automáticos?
                    </h3>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>
                            Puedes cambiar la subcuenta para cada cliente/proveedor en su página,
                            en la <b>sección subcuentas</b>.
                        </li>
                        <!--<li>
                            Para las operaciones con una cuenta bancaria, puedes asociar una
                            subcuenta a esa <a href="index.php?page=admin_empresa#cuentasb">cuenta bancaria</a>.
                        </li>-->
                        <li>
                            Asocia subcuentas a cada <a href="index.php?page=contabilidad_impuestos">impuesto</a>
                            para que se desglosen en los asientos.
                        </li>
                        <li>
                            Incluso puedes modificar las subcuentas a utilizar para cada artículo,
                            en su <b>pestaña subcuentas</b>.
                        </li>
                        <li>
                            Y si con todo no tienes suficiente, puedes modificar las
                            <a href="index.php?page=cuentas_especiales">cuentas especiales</a>.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php } ?>


<form class="form" role="form" name="f_buscar_subcuentas">
    <input type="hidden" name="fecha"/>
    <input type="hidden" name="tipo"/>
    <input type="hidden" name="numlinea"/>
    <div class="modal" id="modal_subcuentas">
        <div class="modal-dialog" style="width: 99%; max-width: 1000px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Buscar subcuenta</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="query" onkeyup="buscar_subcuentas();" autocomplete="off" autofocus />
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <a href="#" class="btn btn-sm btn-block btn-danger" onclick="select_subcuenta('', '', '')">
                                    <span class="glyphicon glyphicon-remove"></span>
                                    <span class="hidden-xs">&nbsp; ninguna</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="subcuentas"></div>
            </div>
        </div>
    </div>
</form>

<?php }else{ ?>

<div class="thumbnail">
    <img src="<?php  echo FS_PATH;?>view/img/fuuu_face.png" alt="fuuuuu"/>
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

