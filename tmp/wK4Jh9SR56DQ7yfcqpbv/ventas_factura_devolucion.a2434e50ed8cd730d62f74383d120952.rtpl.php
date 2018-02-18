<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header2") . ( substr("header2",-1,1) != "/" ? "/" : "" ) . basename("header2") );?>


<?php if( $fsc->factura ){ ?>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-capitalize"><?php  echo FS_FACTURA_RECTIFICATIVA;?></th>
            <th>Observaciones</th>
            <th class="text-right">Total</th>
            <th class="text-right">Fecha</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->factura->get_rectificativas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr>
         <td><a href="<?php echo $value1->url();?>" target="_parent"><?php echo $value1->codigo;?></a> <?php echo $value1->numero2;?></td>
         <td><?php echo $value1->observaciones_resume();?></td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->total, $value1->coddivisa);?></td>
         <td class="text-right" title="Hora <?php echo $value1->hora;?>">
            <?php if( $value1->fecha==$fsc->today() ){ ?><b><?php echo $value1->fecha;?></b><?php }else{ ?><?php echo $value1->fecha;?><?php } ?>

         </td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td colspan="4">Ninguna <?php  echo FS_FACTURA_RECTIFICATIVA;?> encontrada.</td>
      </tr>
      <?php } ?>

   </table>
</div>

<br/>

<?php if( $fsc->factura->anulada ){ ?>

<div class="alert alert-danger">
   <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp; Esta factura está anulada.
</div>
<?php }else{ ?>

<form action="<?php echo $fsc->url();?>" method="post" class="form">
   <input type="hidden" name="id" value="<?php echo $fsc->factura->idfactura;?>"/>
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-info">
               <div class="panel-heading">
                  <h3 class="panel-title">Nueva devolución</h3>
               </div>
               <div class="panel-body">
                  <p class="help-block">
                     Rellena la columna <b>Devolver</b> para indicar qué cantidades y de qué
                     artículos se quiere guardar la devolución. Se generará una <?php  echo FS_FACTURA_RECTIFICATIVA;?>.
                  </p>
               </div>
               <div class="table-responsive">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>Artículo</th>
                           <th width="150" class="text-right">Precio</th>
                           <th width="120" class="text-right">Descuento</th>
                           <th width="150" class="text-right">Cantidad</th>
                           <th width="150" class="text-right">Devolver</th>
                        </tr>
                     </thead>
                     <?php $loop_var1=$fsc->factura->get_lineas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <tr>
                        <td>
                           <div class="form-control"><?php echo $value1->referencia;?> <?php echo $value1->descripcion;?></div>
                        </td>
                        <td class="text-right">
                           <div class="form-control"><?php echo $fsc->show_precio($value1->pvpunitario, $fsc->factura->coddivisa);?></div>
                        </td>
                        <td class="text-right">
                           <div class="form-control"><?php echo $fsc->show_numero($value1->dtopor);?> %</div>
                        </td>
                        <td class="text-right">
                           <div class="form-control"><?php echo $value1->cantidad;?></div>
                        </td>
                        <td class="info">
                           <input type="number" name="devolver_<?php echo $value1->idlinea;?>" value="0" min="0" max="<?php echo $value1->cantidad;?>" step="any" class="form-control text-right"/>
                        </td>
                     </tr>
                     <?php } ?>

                  </table>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group">
                           <a href="<?php echo $fsc->serie->url();?>" target="_parent">Serie</a>:
                           <select name="codserie" class="form-control">
                           <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <?php if( $value1->codserie=='R' ){ ?>

                              <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                              <?php }else{ ?>

                              <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                              <?php } ?>

                           <?php } ?>

                           </select>
                           <?php if( $fsc->empresa->codpais=='ESP' ){ ?>

                           <p class="help-block">
                              En España la <?php  echo FS_FACTURA_RECTIFICATIVA;?> debe ir en una serie distinta.
                           </p>
                           <?php } ?>

                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           Fecha:
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                              </span>
                              <input type="text" name="fecha" value="<?php echo $fsc->today();?>" class="form-control datepicker" autocomplete="off"/>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-7 text-right">
                        <br/>
                        <button type="submit" class="btn btn-sm btn-primary">
                           <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp; Guardar
                        </button>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <textarea name="motivo" class="form-control" placeholder="Motivo de la devolución..." rows="4"></textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
<?php } ?>

<br/>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer2") . ( substr("footer2",-1,1) != "/" ? "/" : "" ) . basename("footer2") );?>