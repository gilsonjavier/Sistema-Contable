<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <span class="glyphicon glyphicon-wrench"></span> Cuentas especiales
               <a href="<?php echo $fsc->url();?>" class='btn btn-xs btn-default'>
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </h1>
            <!--
            <p class="help-block">
               Cada país tiene su plan contable, pero ¿Cómo puede saber
               FacturaScripts cuál es la cuenta de clientes? ¿O la de <?php  echo FS_IVA;?>?
               Para solucionar este problema, cuando FacturaScripts necesita la
               cuenta de clientes, lo que busca es <b>la primera cuenta asociada</b>
               a la cuenta especial <b>CLIENT</b>. Así tú puedes elegir qué cuenta
               usar.
               <br/>
               En cambio, cuando FacturaScripts tiene que generar un asiento a partir
               de una factura y necesita añadir la línea de <?php  echo FS_IVA;?>, lo que hace
               es buscar la primera subcuenta de la primera cuenta marcada como
               <b>IVASOP</b> (en el caso de compras) o <b>IVAREP</b> (en el caso de ventas).
            </p>-->
         </div>
         <div class="table-responsive">
            <table class="table table-condensed">
               <thead>
                  <tr>
                     <th class="text-left" width="150">Identificador</th>
                     <th class="text-left">Descripción</th>
                     <th class="text-left">Cuenta de <?php echo $fsc->empresa->codejercicio;?></th>
                     <th class="text-right" width="120">Acciones</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $loop_var1=$fsc->cuenta_especial->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <form action="<?php echo $fsc->url();?>" method="post" class="form">
                     <input type="hidden" name="idcuentaesp" value="<?php echo $value1->idcuentaesp;?>"/>
                     <tr>
                        <td><div class="form-control"><?php echo $value1->idcuentaesp;?></div></td>
                        <td>
                           <input class="form-control" type="text" placeholder="Descripcion..." onkeypress="teclear(event);return LetrasNumeros(event)" name="descripcion" value="<?php echo $value1->descripcion;?>" autocomplete="off"/>
                        </td>
                        <td class="info" data-toggle="modal" data-target="#modal_ayuda_cuenta">
                           <textarea rows="1" class="form-control"><?php echo $fsc->get_codcuenta_cuentaesp($value1->idcuentaesp);?></textarea>
                        </td>
                        <td class="text-right">
                           <div class="btn-group">
                              <a class="btn btn-sm btn-danger" href="<?php echo $fsc->url();?>&delete=<?php echo $value1->idcuentaesp;?>" title="Eliminar">
                                 <span class="glyphicon glyphicon-trash"></span>
                              </a>
                              <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true; this.form.submit();" title="Guardar">
                                 <span class="glyphicon glyphicon-floppy-disk"></span>
                              </button>
                           </div>
                        </td>
                     </tr>
                  </form>  
                  <?php } ?>

                  <form action="<?php echo $fsc->url();?>" method="post" class="form">
                     <tr class="info">
                        <td>
                           <input class="form-control" type="text" name="idcuentaesp" onkeypress="teclear(event);return LetrasNumeros(event)" placeholder="Nuevo código" maxlength="6" required="" autocomplete="off"/>
                        </td>
                        <td>
                           <input class="form-control" type="text" onkeypress="teclear(event);return LetrasNumeros(event)" name="descripcion" placeholder="Nueva cuenta especial..." required="" autocomplete="off"/>
                        </td>
                        <td></td>
                        <td class="text-right">
                           <button class="btn btn-sm btn-primary" type="submit" title="Nueva">
                              <span class="glyphicon glyphicon-plus-sign"></span>
                              <span class="hidden-sm">&nbsp; Nueva</span>
                           </button>
                        </td>
                     </tr>
                  </form>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal_ayuda_cuenta" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
               <span class="glyphicon glyphicon-question-sign"></span>
               Seleccionar una cuenta
            </h4>
         </div>
         <div class="modal-body">
            <p>
               Este campo es simplemente para que veas qué cuenta o cuentas están
               marcadas como cuentas especiales. Si quieres cambiar alguna,
               <b>debes hacerlo desde la propia cuenta</b>.
            </p>
            <p>
               Busca la cuenta que quieras marcar/desmarcar desde Contabilidad &gt; Cuentas,
               haz clic en ella y al lado de la descripción tienes el campo para
               seleccionar la cuenta especial que representa.
            </p>
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