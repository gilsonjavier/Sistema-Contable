<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->subcuenta ){ ?>

<script type="text/javascript">
   function fs_marcar_todo()
   {
      $('#f_subcuenta input:checkbox').prop('checked', true);
   }
   function fs_marcar_nada()
   {
      $('#f_subcuenta input:checkbox').prop('checked', false);
   }
   function guardar_subcuenta()
   {
      $("#divisa").prop('disabled', false);
      document.f_subcuenta.submit();
   }
   $(document).ready(function() {
      $("#b_eliminar").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Realmente desea eliminar esta subcuenta?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = '<?php echo $fsc->ppage->url();?>&deletes=<?php echo $fsc->subcuenta->idsubcuenta;?>';
               }
            }
         });
      });
   });
</script>

<form name="f_subcuenta" id="f_subcuenta" class="form" action="<?php echo $fsc->url();?>&offset=<?php echo $fsc->offset;?>" method="post">
   <input type="hidden" name="puntear" value="TRUE"/>
   <div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
      <div class="row">
         <div class="col-xs-7">
            <div class="btn-group">
               <a href="<?php echo $fsc->ppage->url();?>" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp; <?php echo $fsc->ppage->title;?></span>
               </a>
               <a href="<?php echo $fsc->url();?>" class="btn btn-sm btn-default hidden-xs" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </div>
            <div class="btn-group">
               <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_librom">
                  <span class="glyphicon glyphicon-book"></span>
                  <span class="hidden-xs">&nbsp; Libro mayor</span>
               </a>
               <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->type=='button' ){ ?>

                  <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
                  <?php } ?>

               <?php } ?>

            </div>
         </div>
         <div class="col-xs-5 text-right">
            <div class="btn-group">
               <?php if( $fsc->allow_delete ){ ?>

               <a href="#" id="b_eliminar" class="btn btn-sm btn-danger">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-sm hidden-xs">&nbsp; Eliminar</span>
               </a>
               <?php } ?>

               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;guardar_subcuenta();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
                  <span class="hidden-xs">&nbsp; Guardar</span>
               </button>
            </div>
         </div>
      </div>
   </div>
   
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left">Subcuenta</th>
               <th class="text-left">Descripción</th>
               <th>Ejercicio</th>
               <th>Divisa</th>
               <th class="text-right">Debe</th>
               <th class="text-right">Haber</th>
               <th class="text-right">Saldo</th>
            </tr>
         </thead>
         <tr>
            <td>
               <div class="form-control"><?php echo $fsc->subcuenta->codsubcuenta;?></div>
            </td>
            <td>
               <input class="form-control" type="text" onkeypress="teclear(event)" name="descripcion" value="<?php echo $fsc->subcuenta->descripcion;?>" autocomplete="off"/>
            </td>
            <td>
               <div class="form-control">
                  <a href="<?php echo $fsc->ejercicio->url();?>"><?php echo $fsc->ejercicio->nombre;?> <!--(<?php echo $fsc->ejercicio->codejercicio;?>)--></a>
               </div>
            </td>
            <td>
               <select name="coddivisa" id="divisa" class="form-control" disabled="">
               <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $fsc->subcuenta->coddivisa==$value1->coddivisa ){ ?>

                  <option value="<?php echo $value1->coddivisa;?>" selected=""><?php echo $value1->descripcion;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $value1->coddivisa;?>"><?php echo $value1->descripcion;?></option>
                  <?php } ?>

               <?php } ?>

               </select>
            </td>
            <td>
               <input type="text" name="debe" value="<?php echo $fsc->show_precio($fsc->subcuenta->debe, $fsc->subcuenta->coddivisa);?>" class="form-control text-right" disabled=""/>
            </td>
            <td>
               <input type="text" name="haber" value="<?php echo $fsc->show_precio($fsc->subcuenta->haber, $fsc->subcuenta->coddivisa);?>" class="form-control text-right" disabled=""/>
            </td>
            <td>
               <input type="text" name="saldo" value="<?php echo $fsc->show_precio($fsc->subcuenta->saldo, $fsc->subcuenta->coddivisa);?>" class="form-control text-right" disabled=""/>
            </td>
         </tr>
      </table>
   </div>
   
   <div class="container-fluid" style="margin-bottom: 10px;">
      <div class="row">
         <div class="col-xs-3">
            <div class="btn-group">
               <button class="btn btn-sm btn-default" type="button" onclick="fs_marcar_todo()">
                  <span class="glyphicon glyphicon-check"></span>
               </button>
               <button class="btn btn-sm btn-default" type="button" onclick="fs_marcar_nada()">
                  <span class="glyphicon glyphicon-unchecked"></span>
               </button>
            </div>
         </div>
         <div class="col-xs-9 text-right">
            <div class="btn-group">
            <?php $loop_var1=$fsc->paginas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <a class="btn btn-sm btn-default<?php if( $value1["actual"] ){ ?> active<?php } ?>" href="<?php echo $value1["url"];?>"><?php echo $value1["num"];?></a>
            <?php } ?>

            </div>
         </div>
      </div>
   </div>
   
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-center" title="puntear">P</th>
               <th class="text-left">Asiento</th>
               <th>Fecha</th>
               <th class="text-left">Concepto</th>
               <th class="text-right">Debe</th>
               <th class="text-right">Haber</th>
               <th class="text-right">Saldo</th>
               <th class="text-right"><?php  echo FS_IVA;?></th>
               <th class="text-right">Base imp.</th>
               <th class="text-center">Contrapartida</th>
               <th class="text-right"><?php  echo FS_CIFNIF;?></th>
            </tr>
         </thead>
         <?php $total=$this->var['total']=-1+count($fsc->resultados);?>

         <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <tr>
            <td class="text-center">
               <input type="checkbox" name="punteada[]" value="<?php echo $value1->idpartida;?>"<?php if( $value1->punteada ){ ?> checked="checked"<?php } ?>/>
            </td>
            <td><a href="<?php echo $value1->url();?>"><?php echo $value1->numero;?></a></td>
            <td><?php echo $value1->fecha;?></td>
            <td><a href="<?php echo $value1->url();?>"><?php echo $value1->concepto;?></a></td>
            <td class="text-right"><?php echo $fsc->show_precio($value1->debe, $fsc->subcuenta->coddivisa);?></td>
            <td class="text-right"><?php echo $fsc->show_precio($value1->haber, $fsc->subcuenta->coddivisa);?></td>
            <td class='text-right<?php if( $value1->saldo<0 ){ ?> danger<?php } ?>'><?php echo $fsc->show_precio($value1->saldo, $fsc->subcuenta->coddivisa);?></td>
            <td class="text-right">
               <?php if( $value1->iva!=0 ){ ?><?php echo $value1->iva;?> %<?php }else{ ?>-<?php } ?>

            </td>
            <td class="text-right">
               <?php if( $value1->baseimponible!=0 ){ ?><?php echo $fsc->show_precio($value1->baseimponible, $fsc->subcuenta->coddivisa);?><?php }else{ ?>-<?php } ?>

            </td>
            <td class="text-center">
               <?php if( $value1->codcontrapartida ){ ?>

               <a href="<?php echo $value1->contrapartida_url();?>"><?php echo $value1->codcontrapartida;?></a>
               <?php }else{ ?>

               -
               <?php } ?>

            </td>
            <td class="text-right">
               <?php if( $value1->cifnif ){ ?><?php echo $value1->cifnif;?><?php }else{ ?>-<?php } ?>

            </td>
         </tr>
         <?php if( $counter1==$total ){ ?>

         <tr>
            <td colspan="4" class="text-right"><b>Sumas</b>:</td>
            <td class="text-right"><b><?php echo $fsc->show_precio($value1->sum_debe, $fsc->subcuenta->coddivisa);?></b></td>
            <td class="text-right"><b><?php echo $fsc->show_precio($value1->sum_haber, $fsc->subcuenta->coddivisa);?></b></td>
            <td colspan="5"></td>
         </tr>
         <?php } ?>

         <?php } ?>

         <tr>
            <td colspan="11" class="text-center">
               <a class="btn btn-sm btn-block btn-success" href="index.php?page=contabilidad_nuevo_asiento">Nuevo Asiento...</a>
            </td>
         </tr>
      </table>
   </div>
   
   <?php if( $total>10 ){ ?>

   <div class="container-fluid">
      <div class="row">
         <div class="col-xs-10">
            <div class="btn-group">
            <?php $loop_var1=$fsc->paginas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <a class="btn btn-sm btn-default<?php if( $value1['actual'] ){ ?> active<?php } ?>" href="<?php echo $value1['url'];?>"><?php echo $value1['num'];?></a>
            <?php } ?>

            </div>
         </div>
         <div class="col-xs-2 text-right">
            <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
               <span class="glyphicon glyphicon-floppy-disk"></span>
               <span class="hidden-xs">&nbsp; Guardar</span>
            </button>
         </div>
      </div>
   </div>
   <?php } ?>

</form>

<div class="modal fade" id="modal_librom" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Libro mayor</h4>
         </div>
         <div class="modal-body">
            <p class='help-block'>
               Puedes descargar el libro mayor de esta subcuenta en formato PDF
               pulsando el botón. Pero si lo que buscas es filtrar por fecha
               o incluso sacar el libro mayor de varias subcuentas a la vez,
               entonces debes ir a <b>Informes &gt; Contabilidad</b>.
            </p>
         </div>
         <div class="modal-footer">
            <?php if( $fsc->pdf_libromayor ){ ?>

            <a href="<?php  echo FS_PATH;?><?php echo $fsc->pdf_libromayor;?>" target="_blank" class="btn btn-sm btn-default">
               <span class="glyphicon glyphicon-book"></span> &nbsp; Libro mayor
            </a>
            <?php }else{ ?>

            <a href="<?php echo $fsc->url();?>&genlm=TRUE" target="_blank" class="btn btn-sm btn-default">
               <span class="glyphicon glyphicon-book"></span> &nbsp; Libro mayor
            </a>
            <?php } ?>

         </div>
      </div>
   </div>
</div>
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