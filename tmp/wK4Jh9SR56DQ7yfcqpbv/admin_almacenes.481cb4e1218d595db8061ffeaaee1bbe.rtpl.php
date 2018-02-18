<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript">
   function delete_almacen(url)
   {
      bootbox.confirm({
         message: '¿Realmente desea eliminar este almacén?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = url;
            }
         }
      });
   }
   $(document).ready(function() {
      $("#b_nuevo_almacen").click(function(event) {
         event.preventDefault();
         $("#modal_nuevo_almacen").modal('show');
         document.f_nuevo_almacen.scodalmacen.focus();
      });
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="btn-group">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-xs btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

         </div>
         <div class="page-header">
            <h1>
               <i class="fa fa-building" aria-hidden="true"></i>&nbsp; Almacenes
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
               <a id="b_nuevo_almacen" class="btn btn-xs btn-success" href="#">
                  <span class="glyphicon glyphicon-plus"></span>
                  <span class="hidden-xs">&nbsp;Nuevo</span>
               </a>
            </h1>
            <p class="help-block">
               Esta es la lista de almacenes de la empresa. Puedes cambiar el
               almacén predeterminado desde la
               <a href="index.php?page=admin_empresa#facturacion">configuración de la empresa</a>.
            </p>
         </div>
      </div>
   </div>
   <?php $loop_var1=$fsc->almacenes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

   <div class="row">
      <div class="col-sm-12">
         <form class="form" role="form" action="<?php echo $fsc->url();?>" method="post">
            <input type="hidden" name="scodalmacen" value="<?php echo $value1->codalmacen;?>"/>
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title">Código: <?php echo $value1->codalmacen;?></h3>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-2">
                        <div class="form-group">
                           Nombre:
                           <input class="form-control" type="text" name="snombre" placeholder="Nombre" value="<?php echo $value1->nombre;?>" onkeypress="teclear(event);return LetrasNumeros(event)" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <a href="<?php echo $fsc->pais->url();?>">País</a>
                           <select name="scodpais" class="form-control">
                           <?php $loop_var2=$fsc->pais->all(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                              <?php if( $value1->codpais==$value2->codpais || $value2->codpais==$fsc->empresa->codpais ){ ?>

                              <option value="<?php echo $value2->codpais;?>" selected=""><?php echo $value2->nombre;?></option>
                              <?php }else{ ?>

                              <option value="<?php echo $value2->codpais;?>"><?php echo $value2->nombre;?></option>
                              <?php } ?>

                           <?php } ?>

                           </select>
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <span class="text-capitalize"><?php  echo FS_PROVINCIA;?></span>:
                           <input class="form-control" type="text" name="sprovincia" placeholder="Manabi" onkeypress="teclear(event);return LetrasNumeros(event)"  value="<?php echo $value1->provincia;?>" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           Ciudad:
                           <input class="form-control" type="text" name="spoblacion" placeholder="Manta" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $value1->poblacion;?>" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           Dirección:
                           <input class="form-control" type="text" name="sdireccion" placeholder="Centro de manta" onkeypress="teclear(event)" value="<?php echo $value1->direccion;?>" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group">
                           Código Postal:
                           <input class="form-control" type="text" name="scodpostal" value="<?php echo $value1->codpostal;?>" autocomplete="off" readonly/>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           Teléfono:
                           <input class="form-control" type="text" name="stelefono" placeholder="XXXXXXXXXX" value="<?php echo $value1->telefono;?>" minlength="10" maxlength="10" onkeypress="teclear(event);return numeros(event)" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           Fax:
                           <input class="form-control" type="text" name="sfax" value="<?php echo $value1->fax;?>" onkeypress="teclear(event)" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           Contacto:
                           <input class="form-control" type="text" name="scontacto" value="<?php echo $value1->contacto;?>" onkeypress="teclear(event)" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="panel-footer text-right">
                  <?php if( $fsc->allow_delete ){ ?>

                     <?php if( $value1->codalmacen==$fsc->empresa->codalmacen ){ ?>

                     <a class="btn btn-sm btn-warning pull-left" onclick="bootbox.alert({message: 'No puedes eliminar el almacén predeterminado de la empresa.',title: '<b>Atención</b>'});">
                        <span class="glyphicon glyphicon-lock"></span>&nbsp; Eliminar
                     </a>
                     <?php }else{ ?>

                     <a class="btn btn-sm btn-danger pull-left" onclick="delete_almacen('<?php echo $fsc->url();?>&delete=<?php echo $value1->codalmacen;?>')">
                        <span class="glyphicon glyphicon-trash"></span>&nbsp; Eliminar
                     </a>
                     <?php } ?>

                  <?php } ?>

                  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                  </button>
               </div>
            </div>
         </form>
      </div>
   </div>
   <?php }else{ ?>

   <div class="row">
      <div class="col-sm-12">
         <div class="alert alert-danger">Ningún almacén encontrado.</div>
      </div>
   </div>
   <?php } ?>

   <div class="row">
      <div class="col-sm-12">
         <form class="form" role="form" action="<?php echo $fsc->url();?>" method="post">
            <div class="panel panel-warning">
               <div class="panel-heading">
                  <h3 class="panel-title">
                     <span class="glyphicon glyphicon-wrench"></span>&nbsp; Configuración avanzada
                  </h3>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group">
                           Permitir stock negativo:
                           <select name="stock_negativo" class="form-control">
                              <option value="1"<?php if( $GLOBALS['config2']['stock_negativo']==1 ){ ?> selected=''<?php } ?>>Si</option>
                              <option value="0"<?php if( $GLOBALS['config2']['stock_negativo']==0 ){ ?> selected=''<?php } ?>>No</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           Permitir ventas sin stock:
                           <select name="ventas_sin_stock" class="form-control">
                              <option value="1"<?php if( $GLOBALS['config2']['ventas_sin_stock']==1 ){ ?> selected=''<?php } ?>>Si</option>
                              <option value="0"<?php if( $GLOBALS['config2']['ventas_sin_stock']==0 ){ ?> selected=''<?php } ?>>No</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           Precio de coste:
                           <select name="cost_is_average" class="form-control">
                              <option value="1"<?php if( $GLOBALS['config2']['cost_is_average']==1 ){ ?> selected=''<?php } ?>>Calculado</option>
                              <option value="0"<?php if( $GLOBALS['config2']['cost_is_average']==0 ){ ?> selected=''<?php } ?>>Manual</option>
                           </select>
                           <p class="help-block">
                              <b>Calculado:</b> se calculará automáticamente el precio de coste de los
                              artículos como la media de precio de las últimas compras.
                              <br/>
                              <b>Manual:</b> el precio de coste será el que indiques manualmente.
                              Y no se actualizará con cada compra.
                           </p>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           Al comprar, añadir con:
                           <select name="precio_compra" class="form-control">
                              <option value="coste"<?php if( $GLOBALS['config2']['precio_compra']=='coste' ){ ?> selected=''<?php } ?>>Precio de compra</option>
                              <option value="pvp"<?php if( $GLOBALS['config2']['precio_compra']=='pvp' ){ ?> selected=''<?php } ?>>Precio de venta</option>
                           </select>
                           <p class="help-block">
                              El precio de compra es el último precio al que hayas comprado al proveedor.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="panel-footer text-right">
                  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                  </button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal" id="modal_nuevo_almacen">
   <div class="modal-dialog">
      <div class="modal-content">
         <form name="f_nuevo_almacen" action="<?php echo $fsc->url();?>" method="post" class="form-horizontal" role="form">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <i class="fa fa-building" aria-hidden="true"></i>&nbsp; Nuevo almacén
               </h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label class="col-sm-2 control-label">Código:</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="scodalmacen" minlength="3" placeholder="XXXX" onkeypress="teclear(event);return LetrasNumeros(event)" required="" maxlength="4" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Nombre:</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="snombre" placeholder="Almacen " onkeypress="teclear(event);return LetrasNumeros(event)" autocomplete="off" required/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">
                     <a href="<?php echo $fsc->pais->url();?>">País</a>:
                  </label>
                  <div class="col-sm-10">
                     <select name="scodpais" class="form-control">
                     <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->is_default() ){ ?>

                        <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                        <?php } ?>

                     <?php } ?>

                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label text-capitalize"><?php  echo FS_PROVINCIA;?>:</label>
                  <div class="col-sm-10">
                     <input id="ac_provincia" class="form-control" type="text" placeholder="Manabi" onkeypress="teclear(event);return LetrasNumeros(event)" name="sprovincia" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Ciudad:</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="spoblacion" placeholder="Manta" onkeypress="teclear(event);return LetrasNumeros(event)" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Dirección:</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="sdireccion" placeholder="Centro de Manta" onkeypress="teclear(event)" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Código Postal:</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="scodpostal" autocomplete="off" readonly/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Teléfono:</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="stelefono" placeholder="Referecia(#)" minlength="10" maxlength="10" onkeypress="teclear(event);return numeros(event)" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Fax:</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="sfax" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Contacto:</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="scontacto" autocomplete="off"/>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
              </button>
            </div>
         </form>
      </div>
   </div>
</div>

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
