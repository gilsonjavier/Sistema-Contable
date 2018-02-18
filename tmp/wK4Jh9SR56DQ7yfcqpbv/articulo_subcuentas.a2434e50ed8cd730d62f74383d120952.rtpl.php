<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header2") . ( substr("header2",-1,1) != "/" ? "/" : "" ) . basename("header2") );?>


<?php if( $fsc->articulo ){ ?>

<script type="text/javascript">
   $(document).ready(function() {
      $("#ac_subcuentacom").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_subcuenta',
         onSelect: function(suggestion) {
            if(suggestion)
            {
               document.f_subcuentas.descsubcuentacom.value = suggestion.data;
               document.f_subcuentas.saldosubcuentacom.value = suggestion.saldo;
               $("#linksubcuentacom").attr('href', suggestion.link);
            }
         }
      });
      $("#ac_subcuentairpfcom").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_subcuenta',
         onSelect: function(suggestion) {
            if(suggestion)
            {
               document.f_subcuentas.descsubcuentairpfcom.value = suggestion.data;
               document.f_subcuentas.saldosubcuentairpfcom.value = suggestion.saldo;
               $("#linksubcuentairpfcom").attr('href', suggestion.link);
            }
         }
      });
      $("#ac_subcuentaventa").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_subcuenta',
         onSelect: function(suggestion) {
            if(suggestion)
            {
               document.f_subcuentas.descsubcuentaventa.value = suggestion.data;
               document.f_subcuentas.saldosubcuentaventa.value = suggestion.saldo;
               $("#linksubcuentaventa").attr('href', suggestion.link);
            }
         }
      });
   });
</script>

<form name="f_subcuentas" action="<?php echo $fsc->url();?>" method="post" class="form">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="page-header">
               <h1>Contabilidad</h1>
               <p class="help-block">
                  <b>Si lo deseas</b>, puedes especificar las subcuentas contables
                  en las que quieres que se desglosen las compras o ventas de este
                  artículo. Al generar los asientos de las facturas donde se
                  compre o venda este artículo, su importe se desglosará en la
                  subcuenta que definas aquí.
               </p>
            </div>
         </div>
      </div>
   </div>
   <div class="table-responsive">
      <table class="table">
         <thead>
            <tr>
               <th width="190">Subcuenta</th>
               <th width="220">Código</th>
               <th width="50"></th>
               <th>Descripción</th>
               <th class="text-right" width="140">Saldo</th>
            </tr>
         </thead>
         <tr>
            <td><div class="form-control">Compras</div></td>
            <td>
               <input class="form-control" type="text" name="codsubcuentacom" value="<?php echo $fsc->subcuentacom->codsubcuenta;?>" id="ac_subcuentacom" placeholder="Buscar" autocomplete="off"/>
            </td>
            <td>
               <a href="<?php echo $fsc->subcuentacom->url();?>" target="_blank" id="linksubcuentacom" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
               </a>
            </td>
            <td>
               <input type="text" name="descsubcuentacom" value="<?php echo $fsc->subcuentacom->descripcion;?>" class="form-control" autocomplete="off" disabled="disabled"/>
            </td>
            <td>
               <input type="text" name="saldosubcuentacom" value="<?php echo $fsc->subcuentacom->saldo;?>" class="form-control text-right" autocomplete="off" disabled="disabled"/>
            </td>
         </tr>
         <tr>
            <td><div class="form-control">Compras con <?php  echo FS_IRPF;?></div></td>
            <td>
               <input class="form-control" type="text" name="codsubcuentairpfcom" value="<?php echo $fsc->subcuentairpfcom->codsubcuenta;?>" id="ac_subcuentairpfcom" placeholder="Buscar" autocomplete="off"/>
            </td>
            <td>
               <a href="<?php echo $fsc->subcuentairpfcom->url();?>" target="_blank" id="linksubcuentairpfcom" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
               </a>
            </td>
            <td>
               <input type="text" name="descsubcuentairpfcom" value="<?php echo $fsc->subcuentairpfcom->descripcion;?>" class="form-control" autocomplete="off" disabled="disabled"/>
            </td>
            <td>
               <input type="text" name="saldosubcuentairpfcom" value="<?php echo $fsc->subcuentairpfcom->saldo;?>" class="form-control text-right" autocomplete="off" disabled="disabled"/>
            </td>
         </tr>
         <tr>
            <td><div class="form-control">Ventas</div></td>
            <td>
               <input class="form-control" type="text" name="codsubcuentaventa" value="<?php echo $fsc->subcuentaventa->codsubcuenta;?>" id="ac_subcuentaventa" placeholder="Buscar" autocomplete="off"/>
            </td>
            <td>
               <a href="<?php echo $fsc->subcuentaventa->url();?>" target="_blank" id="linksubcuentaventa" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
               </a>
            </td>
            <td>
               <input type="text" name="descsubcuentaventa" value="<?php echo $fsc->subcuentaventa->descripcion;?>" class="form-control" autocomplete="off" disabled="disabled"/>
            </td>
            <td>
               <input type="text" name="saldosubcuentaventa" value="<?php echo $fsc->subcuentaventa->saldo;?>" class="form-control text-right" autocomplete="off" disabled="disabled"/>
            </td>
         </tr>
      </table>
   </div>
   <div class="text-right" style="padding-right: 10px;">
      <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
         <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
      </button>
   </div>
</form>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer2") . ( substr("footer2",-1,1) != "/" ? "/" : "" ) . basename("footer2") );?>