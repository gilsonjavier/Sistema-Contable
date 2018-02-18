<?php if(!class_exists('raintpl')){exit;}?><div role="tabpanel" class="tab-pane" id="atributos">
   <br/>
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-9">
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>Referencia</th>
                        <th>Cod. Barras</th>
                        <th>Combinación</th>
                        <th width="140" class="text-right">Impacto precio</th>
                        <th width="100" class="text-right">Stock</th>
                        <th width="80"></th>
                     </tr>
                  </thead>
                  <?php $loop_var1=$fsc->combinaciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <form action="<?php echo $fsc->url();?>#atributos" method="post" class="form">
                     <input type="hidden" name="editar_combi" value="<?php echo $value1->codigo;?>"/>
                     <tr>
                        <td title="ID: <?php echo $value1->id;?>, Código: <?php echo $value1->codigo;?>, Código2: <?php echo $value1->codigo2;?>">
                           <input type="text" name="refcombinacion" value="<?php echo $value1->refcombinacion;?>" onkeypress="teclear(event);return LetrasNumeros(event)" class="form-control" maxlength="18" placeholder="(opcional)" autocomplete="off"/>
                        </td>
                        <td>
                           <input type="text" name="codbarras" value="<?php echo $value1->codbarras;?>" onkeypress="teclear(event);return LetrasNumeros(event)" class="form-control" maxlength="18" placeholder="(opcional)" autocomplete="off"/>
                        </td>
                        <td><div class="form-control"><?php echo $value1->valor;?></div></td>
                        <td>
                           <div class="input-group">
                              <input type="number" step="any" name="impactoprecio" value="<?php echo $value1->impactoprecio;?>" placeholder="0.00" min="0" onkeypress="return decimales(event)" title="Ingrese un numero entero con 2 decimles. " pattern="[0-9_]{1,}[.]+[0-9_]{2}" class="form-control text-right" autocomplete="off" required=""/>
                              <span class="input-group-addon"><?php echo $fsc->simbolo_divisa();?></span>
                           </div>
                        </td>
                        <td>
                           <input type="text" name="stockcombinacion" value="<?php echo $value1->stockfis;?>" onkeypress="teclear(event);return numeros(event)" class="form-control text-right" autocomplete="off"/>
                        </td>
                        <td class="text-right">
                           <div class="btn-group">
                              <?php if( $fsc->allow_delete ){ ?>

                              <a href="#" class="btn btn-sm btn-danger" onclick="delete_combinacion('<?php echo $value1->codigo;?>')">
                                 <span class="glyphicon glyphicon-trash"></span>
                              </a>
                              <?php } ?>

                              <button class="btn btn-sm btn-primary" type="submit" title="Guardar">
                                 <span class="glyphicon glyphicon-floppy-disk"></span>
                              </button>
                           </div>
                        </td>
                     </tr>
                  </form>
                  <?php }else{ ?>

                  <tr class="warning">
                     <td colspan="6">Sin resultados.</td>
                  </tr>
                  <?php } ?>

               </table>
            </div>
         </div>
         <div class="col-sm-3">
            <form action="<?php echo $fsc->url();?>#atributos" method="post" class="form">
               <input type="hidden" name="nueva_combi" value="TRUE"/>
               <div class="panel panel-info">
                  <div class="panel-heading">
                     <h3 class="panel-title">Nueva combinación</h3>
                  </div>
                  <div class="panel-body">
                     <?php $loop_var1=$fsc->atributos(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <div class="form-group">
                        <a href="<?php echo $value1->url();?>"><?php echo $value1->nombre;?></a>
                        <select name="idvalor_<?php echo $counter1;?>" class="form-control">
                           <option value="">Ninguno</option>
                           <?php $loop_var2=$value1->valores(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                           <option value="<?php echo $value2->id;?>"><?php echo $value2->valor;?></option>
                           <?php } ?>

                        </select>
                     </div>
                     <?php } ?>

                     <div class="form-group">
                        Referencia:
                        <input type="text" class="form-control" name="refcombinacion" maxlength="18" onkeypress="teclear(event);return LetrasNumeros(event)" placeholder="(opcional)" autocomplete="off"/>
                     </div>
                     <div class="form-group">
                        <div class="input-group">
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
                           </span>
                           <input type="text" class="form-control" name="codbarras" maxlength="18" onkeypress="teclear(event);return LetrasNumeros(event)"  placeholder="cod. barras (opcional)" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="form-group">
                        Impacto en el precio:
                        <div class="input-group">
                           <span class="input-group-addon"><?php echo $fsc->simbolo_divisa();?></span>
                           <input type="number" step="any" class="form-control" name="impactoprecio" placeholder="0.00" min="0" onkeypress="return decimales(event)" title="Ingrese un numero entero con 2 decimles. " pattern="[0-9_]{1,}[.]+[0-9_]{2}" autocomplete="off" required=""/>
                        </div>
                        <p class="help-block">
                           Se le sumará al precio del artículo. Si quieres que reste pon un menos delante del número.
                        </p>
                     </div>
                  </div>
                  <div class="panel-footer">
                     <button class="btn btn-sm btn-primary" type="submit">
                        <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                     </button>
                  </div>
               </div>
            </form>
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
  