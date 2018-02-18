<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript" src="<?php echo $fsc->get_js_location('contabilidad_asiento.js');?>"></script>
<script type="text/javascript">
   numlineas = <?php echo count($fsc->lineas); ?>;
   fsc_url = '<?php echo $fsc->url();?>';
   fs_nf0 = <?php  echo FS_NF0;?>;
   
   function add_partida()
   {
      numlineas++;
      $("#partidas").append("<tr id='partida_"+numlineas+"'>\n\
         <td>\n\
            <input class='form-control' id='codsubcuenta_"+numlineas+"' name='codsubcuenta_"+numlineas+"' type='text'\n\
               onclick=\"show_buscar_subcuentas('"+numlineas+"','subcuenta')\" onkeyup='document.f_buscar_subcuentas.query.value=$(this).val();buscar_subcuentas()'\n\
               autocomplete='off' placeholder='Seleccionar'/>\n\
         </td>\n\
         <td>\n\
            <input class='form-control' type='text' id='desc_"+numlineas+"' name='desc_"+numlineas+"' disabled='disabled'/>\n\
         </td>\n\
         <td>\n\
            <input class='form-control text-right' type='text' id='saldo_"+numlineas+"' name='saldo_"+numlineas+"' value='0' disabled='disabled'/>\n\
         </td>\n\
         <td>\n\
            <input class='form-control text-right' type='text' onkeypress='teclear(event);return LetrasNumeros(event)' id='debe_"+numlineas+"' name='debe_"+numlineas+"' value='0'\n\
               onclick='this-select()' onkeyup='recalcular()' autocomplete='off'/>\n\
         </td>\n\
         <td>\n\
            <input class='form-control text-right' type='text' onkeypress='teclear(event);return LetrasNumeros(event)' id='haber_"+numlineas+"' name='haber_"+numlineas+"' value='0'\n\
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
      document.f_asiento.numlineas.value = numlineas;
      recalcular();
   }
   function guardar_asiento(redir)
   {
      $("#b_guardar_asiento").prop('disabled', true);
      $("#b_guardar_asiento_r").prop('disabled', true);
      $("#divisa").prop('disabled', false);
      
      var continuar = true;
      for(var i=1; i<=numlineas; i++)
      {
         if( $("#partida_"+i).length > 0 )
         {
            if( $("#codsubcuenta_"+i).val() == '' )
            {
               bootbox.alert({
                  message: 'No has seleccionado ninguna subcuenta en la línea '+i,
                  title: "<b>Atención</b>"
               });
               continuar = false;
               break;
            }
         }
      }
      
      if( !continuar )
      {
         $("#b_guardar_asiento").prop('disabled', false);
         $("#b_guardar_asiento_r").prop('disabled', false);
      }
      else if(numlineas == 0)
      {
         bootbox.alert({
            message: 'No has añadido ninguna línea.',
            title: "<b>Atención</b>"
         });
         $("#b_guardar_asiento").prop('disabled', false);
         $("#b_guardar_asiento_r").prop('disabled', false);
      }
      else if(document.f_asiento.descuadre.value == 0)
      {
         if(redir)
         {
            document.f_asiento.redir.value = 'TRUE';
         }
         
         document.f_asiento.numlineas.value = numlineas;
         document.f_asiento.submit();
      }
      else
      {
         bootbox.alert({
            message: '¡Asiento descuadrado!',
            title: "<b>Atención</b>"
         });
         $("#b_guardar_asiento").prop('disabled', false);
         $("#b_guardar_asiento_r").prop('disabled', false);
      }
   }
   function guardar_asistente()
   {
      $("#divisa").prop('disabled', false);
      document.f_asiento.submit();
   }
   $(document).ready(function() {
      recalcular();
      
      if(window.location.hash.substring(1) == 'asistente')
      {
         $('#tab_nuevo_asiento a[href="#asistente"]').tab('show');
      }
      else
      {
         document.f_asiento.concepto.focus();
      }
      
      $("#f_buscar_subcuentas").submit(function(event) {
         event.preventDefault();
         buscar_subcuentas();
      });
   });
</script>

<form id="f_asiento" name="f_asiento" action="<?php echo $fsc->url();?>" method="post" class="form">
    <input type="hidden" name="petition_id" value="<?php echo $fsc->random_string();?>"/>
    <input type="hidden" name="numlineas" value="0"/>
    <input type="hidden" name="redir"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6">
                <div class="btn-group">
                    <a id="b_nuevo_almacen" class="btn btn-sm btn-default" href="index.php?page=contabilidad_asientos">
                        <span class="glyphicon glyphicon-arrow-left"></span>
                        <span class="hidden-xs">&nbsp; Asientos</span>
                    </a>
                    <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>
                </div>
                <div class="btn-group">
                    <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                    <?php if( $value1->type=='button' ){ ?>

                    <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
                    <?php } ?>

                    <?php } ?>

                </div>
            </div>
            <div class="col-xs-6 text-right">
                <h2 style="margin-top: 0px;">Nuevo Asiento</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="form-group">
                    Fecha:
                    <input class="form-control datepicker" readonly name="fecha" type="text" value="<?php echo $fsc->asiento->fecha;?>"/>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="form-group">
                    Predefinido:
                    <select id="s_idconceptopar" name="idconceptopar" onchange="asigna_concepto()" class="form-control">
                        <option value="">---</option>
                        <?php $loop_var1=$fsc->concepto->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1->idconceptopar;?>"><?php echo $value1->concepto;?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-2">
                <div class="form-group">
                    Concepto:
                    <input class="form-control" name="concepto" onkeypress="teclear(event);return LetrasNumeros(event)" type="text" value="<?php echo $fsc->asiento->concepto;?>" autocomplete="off"/>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="form-group">
                    Divisa:
                    <select name='divisa' id="divisa" class='form-control' disabled="">
                        <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->is_default() ){ ?>

                        <option value='<?php echo $value1->coddivisa;?>' selected=""><?php echo $value1->descripcion;?></option>
                        <?php }else{ ?>

                        <option value='<?php echo $value1->coddivisa;?>'><?php echo $value1->descripcion;?></option>
                        <?php } ?>

                        <?php } ?>

                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="form-group">
                    Importe:
                    <input class="form-control" type="text" name="importe" value="0" readonly=""/>
                </div>
            </div>
            <div class="col-lg-1 col-md-2 col-sm-2">
                <div class="form-group">
                    Descuadre:
                    <input class="form-control" type="text" name="descuadre" value="0" readonly=""/>
                </div>
            </div>
        </div>
    </div>

    <ul id='tab_nuevo_asiento' class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#lineas" aria-controls="lineas" role="tab" data-toggle="tab">
                <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                <span class="hidden-xs">&nbsp;Líneas</span>
            </a>
        </li>
        <li role="presentation">
            <a href="#asistente" aria-controls="asistente" role="tab" data-toggle="tab">
                <i class="fa fa-magic"></i>
                <span class="hidden-xs">&nbsp;Asistente</span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="lineas">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-left" width="135">Subcuenta</th>
                            <th class="text-left">Descripción</th>
                            <th class="text-right" width="110">Saldo</th>
                            <th class="text-right" width="110">Debe</th>
                            <th class="text-right" width="110">Haber</th>
                            <th class="text-left" width="135">Contrapartida</th>
                            <th class="text-right contrapartida" width="110">Saldo</th>
                            <th class="text-right contrapartida"><?php  echo FS_IVA;?></th>
                            <th class="text-right contrapartida" width="110">Base Imp.</th>
                            <th class="text-left contrapartida"><?php  echo FS_CIFNIF;?></th>
                            <th width="50"></th>
                        </tr>
                    </thead>
                    <tbody id="partidas">
                        <?php $loop_var1=$fsc->lineas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr id="partida_<?php echo $counter1+1;?>">
                            <td>
                                <input class="form-control" id='codsubcuenta_<?php echo $counter1+1;?>' name='codsubcuenta_<?php echo $counter1+1;?>' type='text'
                                       value="<?php echo $value1->codsubcuenta;?>" onclick="show_buscar_subcuentas('<?php echo $counter1+1;?>', 'subcuenta')"
                                       onkeyup='document.f_buscar_subcuentas.query.value = $(this).val();buscar_subcuentas()'
                                       autocomplete='off' placeholder='Seleccionar'/>
                            </td>
                            <td><input class='form-control' type='text' id='desc_<?php echo $counter1+1;?>' name='desc_<?php echo $counter1+1;?>' value='<?php echo $value1->desc_subcuenta;?>' disabled='disabled'/></td>
                            <td>
                                <input class='form-control text-right' type='text' id='saldo_<?php echo $counter1+1;?>' name='saldo_<?php echo $counter1+1;?>'
                                       value='<?php echo round($value1->saldo, FS_NF0); ?>' disabled='disabled'/>
                            </td>
                            <td>
                                <input class='form-control text-right' type='text' onkeypress="return decimales(event)" title="Ingrese un numero entero con 2 decimles. " autocomplete="off" pattern="[0-9_]{1,}[.]+[0-9_]{2}"  id='debe_<?php echo $counter1+1;?>' name='debe_<?php echo $counter1+1;?>' value='<?php echo $value1->debe;?>'
                                       onclick='this - select()' onkeyup='recalcular()' autocomplete='off'/>
                            </td>
                            <td>
                                <input class='form-control text-right' type='text' onkeypress="return decimales(event)" title="Ingrese un numero entero con 2 decimles. " autocomplete="off" pattern="[0-9_]{1,}[.]+[0-9_]{2}"  id='haber_<?php echo $counter1+1;?>' name='haber_<?php echo $counter1+1;?>' value='<?php echo $value1->haber;?>'
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
                            <td class="text-right">
                                <button class="btn btn-sm btn-danger" type="button" onclick="clean_partida('<?php echo $counter1+1;?>')">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-sm btn-success" onclick="add_partida();return false;">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            <span class="hidden-xs">&nbsp; Añadir línea</span>
                        </a>
                    </div>
                    <div class="col-xs-6 text-right">
                        <div class="btn-group">
                            <button id="b_guardar_asiento" class="btn btn-sm btn-primary" type="button" onclick="guardar_asiento(false)" title="Guardar y volver a empezar">
                                <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                            </button>
                            <button id="b_guardar_asiento_r" class="btn btn-sm btn-info" type="button" onclick="guardar_asiento(true)" title="Guardar y ver asiento">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="asistente">
            <br/>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <p class='help-block'>
                            Aquí dispones de un par de asistentes para generar asientos comunes.
                            Recuerda que la <b>fecha</b> utilizada es la que tienes más arriba.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Cuota de autónomos</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    Importe:
                                    <input type="text" name="autonomo" value="0" class="form-control" autocomplete="off" onclick="document.f_asiento.modelo130.value = '0';"/>
                                </div>
                                <div class="form-group">
                                    Pagar desde:
                                    <select name="banco" class="form-control">
                                        <option value="">Caja</option>
                                        <?php $loop_var1=$fsc->cuenta_banco->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                        <option value="<?php echo $value1->codsubcuenta;?>"><?php echo $value1->descripcion;?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <button class="btn btn-sm btn-primary" type="button" onclick="guardar_asistente()">
                                    <i class="fa fa-magic"></i>&nbsp; Generar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Pago modelo 130</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    Importe:
                                    <input type="text" name="modelo130" value="0" class="form-control" autocomplete="off" onclick="document.f_asiento.autonomo.value = '0';"/>
                                </div>
                                <div class="form-group">
                                    Pagar desde:
                                    <select name="banco130" class="form-control">
                                        <option value="">Caja</option>
                                        <?php $loop_var1=$fsc->cuenta_banco->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                        <option value="<?php echo $value1->codsubcuenta;?>"><?php echo $value1->descripcion;?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <button class="btn btn-sm btn-primary" type="button" onclick="guardar_asistente()">
                                    <i class="fa fa-magic"></i>&nbsp; Generar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="f_buscar_subcuentas" name="f_buscar_subcuentas" class="form">
    <input type="hidden" name="fecha"/>
    <input type="hidden" name="tipo"/>
    <input type="hidden" name="numlinea"/>
    <div class="modal" id="modal_subcuentas">
        <div class="modal-dialog" style="width: 99%; max-width: 1000px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Buscar subcuentas</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="query" onkeyup="buscar_subcuentas();" autocomplete="off" autofocus="" />
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