<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function delete_impuesto(cod)
   {
      bootbox.confirm({
         message: '¿Realmente desea eliminar el impuesto '+cod+'?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = '<?php echo $fsc->url();?>&delete='+encodeURIComponent(cod);
            }
         }
      });
   }
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               Impuestos
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
               <span class="btn-group">
               <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->type=='button' ){ ?>

                  <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-xs btn-default"><?php echo $value1->text;?></a>
                  <?php } ?>

               <?php } ?>

               </span>
            </h1>
            <p class="help-block">
               El <b>% Recargo</b> de equivalencia es un impuesto que se aplica a las compras
               a proveedores si lo tenemos activado en las opciones de la empresa
               (sección facturación). Y se aplica a los clientes si está activado
               en los datos generales de ese cliente.
               <br/>
               La subcuenta predeterminada para compras es la marcada como
               <a href="index.php?page=cuentas_especiales">cuenta especial</a>
               IVASOP, y la de ventas la marcada como IVAREP.
               <br/>
               ¿Quieres ver <b>los artículos</b> que tienes con cada impuesto?
               Lo tienes muy fácil desde el informe de artículos,
               <a href="index.php?page=informe_articulos&tab=impuestos">
                  pestaña impuestos
               </a>.
            </p>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left" width="150">Código</th>
                     <th class="text-left">Descripción</th>
                     <th class="text-right" width="120">% <?php  echo FS_IVA;?></th>
                     <th class="text-right" width="120">% Recargo</th>
                     <th class="text-left">Subcuenta compras <?php echo $fsc->empresa->codejercicio;?></th>
                     <th class="text-left">Subcuenta ventas <?php echo $fsc->empresa->codejercicio;?></th>
                     <th class="text-right" width="180">Acciones</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->impuesto->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <form class="form" role="form" action ="<?php echo $fsc->url();?>" method="post">
                  <input type="hidden" name="codimpuesto" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $value1->codimpuesto;?>"/>
                  <tr>
                     <td><div class="form-control"><?php echo $value1->codimpuesto;?></div></td>
                     <td>
                        <input class="form-control" type="text" placeholder="Descripcion" onkeypress="teclear(event)" name="descripcion" value="<?php echo $value1->descripcion;?>" autocomplete="off"/>
                     </td>
                     <td>
                        <input class="form-control text-right" onkeypress="teclear(event);return numeros(event)" min="0" max="100" type="number" step="any" name="iva" value="<?php echo $value1->iva;?>" autocomplete="off"/>
                     </td>
                     <td>
                        <input class="form-control text-right" onkeypress="teclear(event);return numeros(event)" min="0" max="100" type="number" step="any" name="recargo" value="<?php echo $value1->recargo;?>" autocomplete="off"/>
                     </td>
                     <td>
                        <input class="form-control" type="text" onkeypress="teclear(event);return LetrasNumeros(event)" name="codsubcuentasop" value="<?php echo $value1->codsubcuentasop;?>" placeholder="<?php echo $fsc->codsubcuentasop;?>" autocomplete="off"/>
                     </td>
                     <td>
                        <input class="form-control" type="text" onkeypress="teclear(event);return LetrasNumeros(event)" name="codsubcuentarep" value="<?php echo $value1->codsubcuentarep;?>" placeholder="<?php echo $fsc->codsubcuentarep;?>" autocomplete="off"/>
                     </td>
                     <td class="text-right">
                        <div class="btn-group">
                           <?php if( $value1->is_default() ){ ?>

                           <a href="#" class="btn btn-sm btn-success" title="Impuesto predeterminado">
                              <span class="glyphicon glyphicon-flag"></span>
                           </a>
                           <?php }else{ ?>

                           <a href="<?php echo $fsc->url();?>&set_default=<?php echo $value1->codimpuesto;?>" class="btn btn-sm btn-default" title="Marcar como impuesto predeterminado">
                              <span class="glyphicon glyphicon-flag"></span>
                           </a>
                           <?php } ?>

                        </div>
                        <div class="btn-group">
                           <?php if( $fsc->allow_delete ){ ?>

                           <button class="btn btn-sm btn-danger" type="button" title="Eliminar" onclick="delete_impuesto('<?php echo $value1->codimpuesto;?>')">
                              <span class="glyphicon glyphicon-trash"></span>
                           </button>
                           <?php } ?>

                           <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Guardar">
                              <span class="glyphicon glyphicon-floppy-disk"></span>
                           </button>
                        </div>
                     </td>
                  </tr>
               </form>
               <?php } ?>

               <form class="form" name="f_nuevo_impuesto" action="<?php echo $fsc->url();?>" method="post">
                  <tr class="info">
                      <td><input class="form-control" type="text" onkeypress="teclear(event);return LetrasNumeros(event)" name="codimpuesto" maxlength="10" placeholder="Nuevo código" autocomplete="off" required=""/></td>
                      <td><input class="form-control" type="text" onkeypress="teclear(event)" name="descripcion" placeholder="Nuevo impuesto..." autocomplete="off" required=""/></td>
                     <td><input class="form-control text-right" onkeypress="teclear(event);return numeros(event)" type="number" min="0" max="100" step="any" name="iva" value="0" autocomplete="off"/></td>
                     <td><input class="form-control text-right" onkeypress="teclear(event);return numeros(event)" type="number" min="0" max="100" step="any" name="recargo" value="0" autocomplete="off"/></td>
                     <td><input class="form-control" type="text" onkeypress="teclear(event);return LetrasNumeros(event)" name="codsubcuentasop" placeholder="<?php echo $fsc->codsubcuentasop;?>" autocomplete="off"/></td>
                     <td><input class="form-control" type="text" onkeypress="teclear(event);return LetrasNumeros(event)" name="codsubcuentarep" placeholder="<?php echo $fsc->codsubcuentarep;?>" autocomplete="off"/></td>
                     <td class="text-right">
                        <button class="btn btn-sm btn-primary" type="submit" title="Nuevo">
                           <span class="glyphicon glyphicon-plus-sign"></span>
                           <span class="hidden-sm">&nbsp;Nuevo</span>
                        </button>
                     </td>
                  </tr>
               </form>
            </table>
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