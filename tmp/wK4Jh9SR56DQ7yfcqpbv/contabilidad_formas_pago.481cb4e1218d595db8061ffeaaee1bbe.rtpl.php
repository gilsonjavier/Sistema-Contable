<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function eliminar_fp(cod)
   {
      bootbox.confirm({
         message: '¿Realmente desea eliminar la forma de pago '+cod+'?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = '<?php echo $fsc->url();?>&delete='+encodeURIComponent(cod);
            }
         }
      });
   }
   function cannot_delete()
   {
      bootbox.alert({
         message: 'No puedes eliminar la forma de pago predeterminada.',
         title: "<b>Atención</b>"
      });
   }
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               Formas de pago
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
         </div>
      </div>
   </div>
</div>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th width="150" class="text-left">Código</th>
            <th class="text-left">Descripción</th>
            <th class="text-left">Generar facturas</th>
            <th class="text-left">Vencimiento</th>
            <th class="text-left">
               <a href="index.php?page=admin_empresa#cuentasb" title="Editar las cuentas bancarias de la empresa">
                  Cuenta bancaria &nbsp;<span class="glyphicon glyphicon-share"></span>
               </a>
            </th>
            <th class="text-center">Domiciliado</th>
            <th class="text-center">Imprimir</th>
            <th class="text-right" width="120">Acciones</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <form action="<?php echo $fsc->url();?>#<?php echo $value1->codpago;?>" method="post" class="form" role="form">
         <tr<?php if( $value1->genrecibos=='Pagados' ){ ?> class="success"<?php } ?>>
            <td>
               <a name="<?php echo $value1->codpago;?>"></a>
               <input type="hidden" placeholder="Codigo" onkeypress="teclear(event);return LetrasNumeros(event)" name="codpago" value="<?php echo $value1->codpago;?>"/>
               <div class="form-control"><?php echo $value1->codpago;?></div>
            </td>
            <td><input class="form-control" type="text" name="descripcion" placeholder="Descripcion" onkeypress="teclear(event)" value="<?php echo $value1->descripcion;?>" autocomplete="off"/></td>
            <td>
               <select name="genrecibos" class="form-control" onchange="this.form.submit()">
                  <option value="Emitidos"<?php if( $value1->genrecibos=='Emitidos' ){ ?> selected=""<?php } ?>>Sin pagar</option>
                  <option value="Pagados"<?php if( $value1->genrecibos=='Pagados' ){ ?> selected=""<?php } ?>>Pagadas</option>
               </select>
            </td>
            <td>
               <?php if( $fsc->button_plazos && $value1->genrecibos=='Emitidos' ){ ?>

                  <input type="hidden" name="vencimiento" value="<?php echo $value1->vencimiento;?>"/>
                  <a href="index.php?page=<?php echo $fsc->button_plazos;?>&cod=<?php echo $value1->codpago;?>" class="btn btn-sm btn-block btn-default">
                     <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp; Plazos de pago
                  </a>
               <?php }else{ ?>

                  <select name="vencimiento" class="form-control" onchange="this.form.submit()">
                  <?php $loop_var2=$fsc->vencimientos(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                     <?php if( $value1->vencimiento==$key2 ){ ?>

                     <option value="<?php echo $key2;?>" selected=""><?php echo $value2;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $key2;?>"><?php echo $value2;?></option>
                     <?php } ?>

                  <?php } ?>

                  </select>
               <?php } ?>

            </td>
            <td>
               <select name="codcuenta" class="form-control">
                  <option value="">Ninguna</option>
                  <option value="">------</option>
                  <?php $loop_var2=$fsc->cuentas_banco; $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                     <?php if( $value1->codcuenta==$value2->codcuenta ){ ?>

                     <option value="<?php echo $value2->codcuenta;?>" selected=""><?php echo $value2->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value2->codcuenta;?>"><?php echo $value2->descripcion;?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </td>
            <td class="text-center">
               <div class="checkbox">
                  <label title="¿Domiciliado?">
                     <input type="checkbox" name="domiciliado" value="TRUE"<?php if( $value1->domiciliado ){ ?> checked=""<?php } ?>/>
                  </label>
               </div>
            </td>
            <td class="text-center">
               <div class="checkbox">
                  <label title="¿Mostrar desglose al imprimir documentos de venta?">
                     <input type="checkbox" name="imprimir" value="TRUE"<?php if( $value1->imprimir ){ ?> checked=""<?php } ?>/>
                  </label>
               </div>
            </td>
            <td class="text-right">
               <div class="btn-group">
                  <?php if( $fsc->allow_delete ){ ?>

                     <?php if( $value1->codpago==$fsc->empresa->codpago ){ ?>

                     <a href="#" class="btn btn-sm btn-warning" title="Bloqueado" onclick="bootbox.alert({message: 'No puedes eliminar la forma de pago predeterminada.',title: '<b>Atención</b>'});">
                        <span class="glyphicon glyphicon-lock"></span>
                     </a>
                     <?php }else{ ?>

                     <a href="#" class="btn btn-sm btn-danger" onclick="eliminar_fp('<?php echo $value1->codpago;?>')" title="Eliminar">
                        <span class="glyphicon glyphicon-trash"></span>
                     </a>
                     <?php } ?>

                  <?php } ?>

                  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Guardar">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                  </button>
               </div>
            </td>
         </tr>
      </form>
      <?php } ?>

      <form action="<?php echo $fsc->url();?>" method="post" class="form" role="form">
         <tr class="info">
            <td>
                <input class="form-control" type="text" onkeypress="teclear(event);return LetrasNumeros(event)" name="codpago" maxlength="10" autocomplete="off" placeholder="Nuevo código" required=""/>
            </td>
            <td>
                <input class="form-control" type="text" onkeypress="teclear(event)" name="descripcion" autocomplete="off" placeholder="Nueva forma de pago..." required=""/>
            </td>
            <td>
               <select name="genrecibos" class="form-control">
                  <option value="Emitidos">Sin pagar</option>
                  <option value="Pagados">Pagadas</option>
               </select>
            </td>
            <td class="text-center">
               <?php if( $fsc->button_plazos ){ ?>

               <input type="hidden" name="vencimiento" value="+1day"/>
               <?php }else{ ?>

               <select name="vencimiento" class="form-control">
                  <?php $loop_var1=$fsc->vencimientos(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
                  <?php } ?>

               </select>
               <?php } ?>

            </td>
            <td>
               <select name="codcuenta" class="form-control">
                  <option value="">Ninguna</option>
                  <option value="">------</option>
                  <?php $loop_var1=$fsc->cuentas_banco; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <option value="<?php echo $value1->codcuenta;?>"><?php echo $value1->descripcion;?></option>
                  <?php } ?>

               </select>
            </td>
            <td class="text-center">
               <div class="checkbox">
                  <label title="¿Domiciliado?">
                     <input type="checkbox" name="domiciliado" value="TRUE"/>
                  </label>
               </div>
            </td>
            <td class="text-center">
               <div class="checkbox">
                  <label title="¿Mostrar desglose al imprimir documentos de venta?">
                     <input type="checkbox" name="imprimir" value="TRUE" checked=""/>
                  </label>
               </div>
            </td>
            <td class="text-right">
               <div class="btn-group">
                  <button class="btn btn-sm btn-primary" type="submit" title="Nueva">
                     <span class="glyphicon glyphicon-plus-sign"></span>
                     <span class="hidden-sm">&nbsp;Nueva</span>
                  </button>
               </div>
            </td>
         </tr>
      </form>
   </table>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-4">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">Forma de pago predeterminada</h3>
            </div>
            <div class="panel-body">
               Puedes seleccionar la forma de pago predeterminada de FacturaScripts desde Admin &gt; Empresa.
               <br/><br/>
               <a href="index.php?page=admin_empresa#facturacion" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp;
                  Elegir forma de pago
               </a>
            </div>
         </div>
      </div>
      <div class="col-sm-4">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">¿Quieres enlazar una forma de pago con una cuenta bancaria?</h3>
            </div>
            <div class="panel-body">
               <ul>
                  <li>
                     Selecciona
                     <a href="index.php?page=admin_empresa#cuentasb" title="Editar las cuentas bancarias de la empresa">tu cuenta bancaria</a>.
                  </li>
                  <li>
                     Si quieres que los asientos de las facturas con esa forma de pago se asignen a una subcuenta,
                     <a href="index.php?page=admin_empresa#cuentasb">edita esa cuenta bancaria</a>
                     y vinculala con una subcuenta.
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <div class="col-sm-4">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">¿Quieres enlazar con una cuenta bancaria del cliente?</h3>
            </div>
            <div class="panel-body">
               <ul>
                  <li>
                     Selecciona
                     <a href="index.php?page=admin_empresa#cuentasb" title="Editar las cuentas bancarias de la empresa">tu cuenta bancaria</a>.
                  </li>
                  <li>Marca la opción <b>domiciliado</b>.</li>
                  <li>Añade la cuenta bancaria del cliente en la ficha de ese cliente.</li>
               </ul>
            </div>
         </div>
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
