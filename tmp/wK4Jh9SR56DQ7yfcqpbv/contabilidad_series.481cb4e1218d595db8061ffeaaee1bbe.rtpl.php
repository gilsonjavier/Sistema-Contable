<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function delete_serie(cod)
   {
      bootbox.confirm({
         message: '¿Realmente desea eliminar <?php  echo FS_SERIE;?> '+cod+'?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = '<?php echo $fsc->url();?>&delete='+cod;
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
               <span class="text-capitalize"><?php  echo FS_SERIES;?></span>
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
               <!--El <b>% <?php  echo FS_IRPF;?></b> es una retención que se aplica tanto en las compras como en las ventas.
               <br/>-->
               <?php if( $fsc->num_personalizada ){ ?>

               <mark>Numeración personalizada</mark>: selecciona un ejercicio y el número
               de factura inicial, las facturas de venta de ese ejercicio empezarán en ese número. </br>
               <b>Aviso</b>: no juegues con la numeración si no sabes lo que haces.
               <?php }else{ ?>

               ¿Quieres modificar el <b>nº de factura inicial</b>? Activa la
               <a href="<?php echo $fsc->url();?>&num_personalizada=TRUE">numeración personalizada</a>.
               <?php } ?>

            </p>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left" width="150">Código</th>
                     <th class="text-left">Descripción</th>
                     <?php if( $fsc->num_personalizada ){ ?>

                     <th colspan="2" class="warning">
                        Numeración personalizada
                        <a href="<?php echo $fsc->url();?>&num_personalizada=FALSE" title="ocultar">
                           <span class="glyphicon glyphicon-eye-close"></span>
                        </a>
                     </th>
                     <?php } ?>

                     <th class="text-center">Sin <?php  echo FS_IVA;?></th>
                     <th class="text-right" width="100">% <?php  echo FS_IRPF;?></th>
                     <th class="text-right" width="110">Acciones</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <form action ="<?php echo $fsc->url();?>" method="post">
                  <input type="hidden" name="codserie" placeholder="Codigo" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $value1->codserie;?>"/>
                  <tr>
                     <td><div class="form-control"><?php echo $value1->codserie;?></div></td>
                     <td><input class="form-control" type="text" name="descripcion" placeholder="Descripcion" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $value1->descripcion;?>" autocomplete="off"/></td>
                     <?php if( $fsc->num_personalizada ){ ?>

                     <td class="warning">
                        <select name="codejercicio" class="form-control">
                           <option value="">Desactivado</option>
                           <?php $loop_var2=$fsc->ejercicios; $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                              <?php if( $value1->codejercicio==$value2->codejercicio ){ ?>

                              <option value="<?php echo $value2->codejercicio;?>" selected=""><?php echo $value2->nombre;?></option>
                              <?php }else{ ?>

                              <option value="<?php echo $value2->codejercicio;?>"><?php echo $value2->nombre;?></option>
                              <?php } ?>

                           <?php } ?>

                        </select>
                     </td>
                     <td width="110" class="warning">
                        <input class="form-control" type="number" min="0" onkeypress="teclear(event);return numeros(event)" name="numfactura" value="<?php echo $value1->numfactura;?>" autocomplete="off"/>
                     </td>
                     <?php } ?>

                     <td class="text-center">
                        <div class="checkbox-inline">
                           <?php if( $value1->siniva ){ ?>

                           <input type="checkbox" name="siniva" value="TRUE" checked=""/>
                           <?php }else{ ?>

                           <input type="checkbox" name="siniva" value="TRUE"/>
                           <?php } ?>

                        </div>
                     </td>
                     <td><input class="form-control text-right" min="0" onkeypress="teclear(event);return numeros(event)" type="text" name="irpf" value="<?php echo $value1->irpf;?>" autocomplete="off"/></td>
                     <td class="text-right">
                        <div class="btn-group">
                           <?php if( $fsc->allow_delete ){ ?>

                              <?php if( $value1->codserie==$fsc->empresa->codserie ){ ?>

                              <a href="#" class="btn btn-sm btn-warning" title="Bloqueado" onclick="bootbox.alert({message: 'No puedes eliminar la <?php  echo FS_SERIE;?> predeterminada.',title: '<b>Atención</b>'});">
                                 <span class="glyphicon glyphicon-lock"></span>
                              </a>
                              <?php }else{ ?>

                              <a class="btn btn-sm btn-danger" title="Eliminar" onclick="delete_serie('<?php echo $value1->codserie;?>')">
                                 <span class="glyphicon glyphicon-trash"></span>
                              </a>
                              <?php } ?>

                           <?php } ?>

                           <button class="btn btn-sm btn-primary" type="submit" title="Guardar" onclick="this.disabled=true;this.form.submit();">
                              <span class="glyphicon glyphicon-floppy-disk"></span>
                           </button>
                        </div>
                     </td>
                  </tr>
               </form>
               <?php } ?>

               <form class="form" name="f_nueva_serie" action ="<?php echo $fsc->url();?>" method="post">
                  <tr class="info">
                      <td><input class="form-control" type="text" onkeypress="teclear(event);return LetrasNumeros(event)" name="codserie" maxlength="2" placeholder="Nuevo código" autocomplete="off" required=""/></td>
                      <td><input class="form-control" type="text" onkeypress="teclear(event)" name="descripcion" placeholder="Nueva serie..." autocomplete="off" required=""/></td>
                     <?php if( $fsc->num_personalizada ){ ?>

                     <td>
                        <select name="codejercicio" class="form-control">
                           <option value="">Desactivado</option>
                           <option value="">---</option>
                           <?php $loop_var1=$fsc->ejercicios; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codejercicio;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        </select>
                     </td>
                     <td width="90">
                        <input class="form-control" type="number" min="0" onkeypress="teclear(event);return numeros(event)" name="numfactura" value="1" autocomplete="off"/>
                     </td>
                     <?php } ?>

                     <td class="text-center">
                        <div class="checkbox-inline">
                           <input type="checkbox" name="siniva" value="TRUE"/>
                        </div>
                     </td>
                     <td><input class="form-control text-right" min="0" onkeypress="teclear(event);return numeros(event)" type="text" name="irpf" value="0" autocomplete="off"/></td>
                     <td class="text-right">
                        <button class="btn btn-sm btn-primary" type="submit" title="Nueva">
                           <span class="glyphicon glyphicon-plus-sign"></span>
                           <span class="hidden-sm">&nbsp;Nueva</span>
                        </button>
                     </td>
                  </tr>
               </form>
            </table>
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