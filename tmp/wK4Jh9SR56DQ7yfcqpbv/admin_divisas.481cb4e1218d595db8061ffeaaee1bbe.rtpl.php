<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function eliminar_divisa(cod)
   {
      bootbox.confirm({
         message: '¿Realmente desea eliminar la divisa '+cod+'?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = '<?php echo $fsc->url();?>&delete='+cod;
            }
         }
      });
   }
</script>

<div class="container-fluid" style="margin-bottom: 10px;">
   <div class="row">
      <div class="col-xs-12">
         <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
            <span class="glyphicon glyphicon-refresh"></span>
         </a>
         <div class="btn-group">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-xs btn-default"><?php echo $value1->text;?></a>
               <?php }elseif( $value1->type=='modal' ){ ?>

               <!--<?php $txt=$this->var['txt']=base64_encode($value1->text);?>-->
               <!--<?php echo $url='index.php?page='.$value1->from.$value1->params;?>-->
               <a href="#" class="btn btn-xs btn-default" onclick="fs_modal('<?php echo $txt;?>','<?php echo $url;?>')"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
   </div>
</div>

<ul class="nav nav-tabs" role="tablist">
   <li role="presentation" class="active">
      <a href="#divisas" aria-controls="divisas" role="tab" data-toggle="tab">
         <i class="fa fa-money" aria-hidden="true"></i>&nbsp; Divisas
      </a>
   </li>
   <li role="presentation">
      <a href="#configuracion" aria-controls="configuracion" role="tab" data-toggle="tab">
         <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp; Configuración
      </a>
   </li>
   <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <?php if( $value1->type=='tab' ){ ?>

      <li role="presentation">
         <a href="#ext_<?php echo $value1->name;?>" aria-controls="ext_<?php echo $value1->name;?>" role="tab" data-toggle="tab"><?php echo $value1->text;?></a>
      </li>
      <?php } ?>

   <?php } ?>

</ul>
<div class="tab-content">
   <div role="tabpanel" class="tab-pane active" id="divisas">
      <div class="table-responsive">
         <table class="table table-hover">
            <thead>
               <tr>
                  <th class="text-left" width="120">Código</th>
                  <th class="text-left" width="120">Símbolo</th>
                  <th class="text-left">Descripción</th>
                  <th class="text-left" width="120">
                     <a href="https://es.wikipedia.org/wiki/ISO_4217" target="_blank">Código ISO</a>
                  </th>
                  <th class="text-left">Tasa de conversión (1€ = X)</th>
                  <th class="text-left">Tasa de conversión (1€ = X) (compras)</th>
                  <th class="text-right" width="120">Acciones</th>
               </tr>
            </thead>
            <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <form action="<?php echo $fsc->url();?>" method="post" class="form">
               <tr<?php if( $value1->coddivisa==$fsc->empresa->coddivisa ){ ?> class="warning"<?php } ?>>
                  <td>
                     <input type="hidden" name="coddivisa" value="<?php echo $value1->coddivisa;?>"/>
                     <div class="form-control"><?php echo $value1->coddivisa;?></div>
                  </td>
                  <td><input class="form-control" type="text" name="simbolo" value="<?php echo $value1->simbolo;?>" autocomplete="off"/></td>
                  <td><input class="form-control" type="text" name="descripcion" value="<?php echo $value1->descripcion;?>" autocomplete="off"/></td>
                  <td><input class="form-control" type="text" name="codiso" value="<?php echo $value1->codiso;?>" autocomplete="off"/></td>
                  <td><input class="form-control" type="text" name="tasaconv" value="<?php echo $value1->tasaconv;?>" autocomplete="off"/></td>
                  <td><input class="form-control" type="text" name="tasaconv_compra" value="<?php echo $value1->tasaconv_compra;?>" autocomplete="off"/></td>
                  <td class="text-right">
                     <div class="btn-group">
                        <?php if( $fsc->allow_delete ){ ?>

                           <?php if( $value1->coddivisa==$fsc->empresa->coddivisa ){ ?>

                           <a href="#" class="btn btn-sm btn-warning" title="Bloqueado" onclick="bootbox.alert({message: 'No puedes eliminar la divisa predeterminada.',title: '<b>Atención</b>'});">
                              <span class="glyphicon glyphicon-lock"></span>
                           </a>
                           <?php }else{ ?>

                           <a href="#" class="btn btn-sm btn-danger" title="Eliminar" onclick="eliminar_divisa('<?php echo $value1->coddivisa;?>')">
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

            <form action="<?php echo $fsc->url();?>" method="post" class="form">
               <tr class="info">
                  <td><input class="form-control" type="text" name="coddivisa" maxlength="3" autocomplete="off" placeholder="Nuevo"/></td>
                  <td><input class="form-control" type="text" name="simbolo" autocomplete="off" placeholder="$"/></td>
                  <td><input class="form-control" type="text" name="descripcion" autocomplete="off" placeholder="Nueva divisa..."/></td>
                  <td><input class="form-control" type="text" name="codiso" autocomplete="off"/></td>
                  <td><input class="form-control" type="text" name="tasaconv" value="1" autocomplete="off"/></td>
                  <td><input class="form-control" type="text" name="tasaconv_compra" value="1" autocomplete="off"/></td>
                  <td class="text-right">
                     <div class="btn-group">
                        <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Nueva">
                           <span class="glyphicon glyphicon-plus-sign"></span>
                           <span class="hidden-sm">&nbsp;Nueva</span>
                        </button>
                     </div>
                  </td>
               </tr>
            </form>
         </table>
      </div>
   </div>
   <div role="tabpanel" class="tab-pane" id="configuracion">
      <br/>
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">Divisa predeterminada</h3>
                  </div>
                  <div class="panel-body">
                     Puedes seleccionar la divisa predeterminada de FacturaScripts desde Admin &gt; Empresa.
                     <br/><br/>
                     <a href="index.php?page=admin_empresa#facturacion" class="btn btn-sm btn-default">
                        <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp; Elegir divisa
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">Opciones de divisa</h3>
                  </div>
                  <div class="panel-body">
                     Puedes cambiar el número de decimales, el separador, etc... desde el panel de control.
                     <br/><br/>
                     <a href="index.php?page=admin_home#avanzado" class="btn btn-sm btn-default">
                        <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp; Panel de control
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <?php if( $value1->type=='tab' ){ ?>

      <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
         <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" width="100%" height="2000" frameborder="0"></iframe>
      </div>
      <?php } ?>

   <?php } ?>

</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>