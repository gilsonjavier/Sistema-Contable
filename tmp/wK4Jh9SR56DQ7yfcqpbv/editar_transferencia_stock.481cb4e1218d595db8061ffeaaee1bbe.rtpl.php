<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->transferencia ){ ?>

<script type="text/javascript" src="<?php echo $fsc->get_js_location('transferencia_stock.js');?>"></script>

<form action="<?php echo $fsc->transferencia->url();?>" method="post" class="form">
   <input type="hidden" id="numlineas" name="numlineas" value='<?php echo count($fsc->lineas); ?>'/>
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-6">
            <div class="btn-group">
               <a class="btn btn-sm btn-default" href="index.php?page=ventas_articulos#transferencias">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp;Todas</span>
               </a>
               <a class="btn btn-sm btn-default" href="<?php echo $fsc->transferencia->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </div>
            <div class="btn-group">
               <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->type=='button' ){ ?>

                  <a href="index.php?page=<?php echo $value1->from;?>&id=<?php echo $fsc->transferencia->idtrans;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
                  <?php } ?>

               <?php } ?>

            </div>
         </div>
         <div class="col-sm-6 text-right">
            <div class="btn-group">
               <?php if( $fsc->allow_delete ){ ?>

               <a href="#" class="btn btn-sm btn-danger" onclick="eliminar_transferencia('<?php echo $fsc->transferencia->idtrans;?>')">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-sm hidden-xs">&nbsp;Eliminar</span>
               </a>
               <?php } ?>

               <button type="submit" class="btn btn-sm btn-primary">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
                  <span class="hidden-xs">&nbsp;Guardar</span>
               </button>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <div class="page-header">
               <h1>
                  <span class="glyphicon glyphicon-transfer"></span> Transferencia de stock
                  <small><?php echo $fsc->transferencia->idtrans;?></small>
               </h1>
               <p class="help-block">
                  Creato por <b><?php echo $fsc->transferencia->usuario;?></b> el
                  <?php echo $fsc->transferencia->fecha;?> a las <?php echo $fsc->transferencia->hora;?>

               </p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-3">
            <div class="form-group">
               Almacén orígen:
               <div class="input-group">
                  <span class="input-group-addon">
                     <span class="glyphicon glyphicon-export"></span>
                  </span>
                  <select name="codalmaorigen" class="form-control">
                  <?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codalmacen==$fsc->transferencia->codalmaorigen ){ ?>

                     <option value="<?php echo $value1->codalmacen;?>" selected=""><?php echo $value1->nombre;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                     <?php } ?>

                  <?php } ?>

                  </select>
               </div>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               Almacén destino:
               <div class="input-group">
                  <span class="input-group-addon">
                     <span class="glyphicon glyphicon-import"></span>
                  </span>
                  <select name="codalmadestino" class="form-control">
                  <?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codalmacen==$fsc->transferencia->codalmadestino ){ ?>

                     <option value="<?php echo $value1->codalmacen;?>" selected=""><?php echo $value1->nombre;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                     <?php } ?>

                  <?php } ?>

                  </select>
               </div>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Fecha:
               <div class="input-group">
                  <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                  <input type="text" name="fecha" value="<?php echo $fsc->transferencia->fecha;?>" class="form-control datepicker" autocomplete="off"/>
               </div>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Hora:
               <div class="input-group">
                  <span class="input-group-addon">
                     <span class="glyphicon glyphicon-time"></span>
                  </span>
                  <input type="text" name="hora" value="<?php echo $fsc->transferencia->hora;?>" class="form-control" autocomplete="off"/>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th width="200">Referencia</th>
               <th>Descripción</th>
               <th class="text-right" width="130">Cantidad</th>
               <th width="70"></th>
            </tr>
         </thead>
         <tbody id="lineas_transferencia">
         <?php $loop_var1=$fsc->lineas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <tr id="linea_<?php echo $counter1;?>">
            <td>
               <input type="hidden" name="idlinea_<?php echo $counter1;?>" value="<?php echo $value1->idlinea;?>"/>
               <input type="hidden" name="referencia_<?php echo $counter1;?>" value="<?php echo $value1->referencia;?>"/>
               <div class="form-control">
                  <small><a target="_blank" href="index.php?page=ventas_articulo&ref=<?php echo $value1->referencia;?>"><?php echo $value1->referencia;?></a></small>
               </div>
            </td>
            <td><textarea class="form-control" id="desc_<?php echo $counter1;?>" name="desc_<?php echo $counter1;?>" rows="1"><?php echo $value1->descripcion;?></textarea></td>
            <td><input type="number" step="any" name="cantidad_<?php echo $counter1;?>" value="<?php echo $value1->cantidad;?>" id="cantidad_<?php echo $counter1;?>" class="form-control text-right" autocomplete="off"/></td>
            <td>
               <button class="btn btn-sm btn-danger" type="button" onclick="$('#linea_<?php echo $counter1;?>').remove();">
                  <span class="glyphicon glyphicon-trash"></span>
               </button>
            </td>
         </tr>
         <?php } ?>

         </tbody>
         <tr class="info">
            <td>
               <input type="text" id="ac_referencia" class="form-control" placeholder="buscar..."/>
            </td>
            <td colspan="3"></td>
         </tr>
      </table>
   </div>
</form>

<div class="modal" id="modal_articulos">
   <div class="modal-dialog" style="width: 99%; max-width: 1000px;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Buscar artículos</h4>
            <p class="help-block">
               <span class="glyphicon glyphicon-info-sign"></span>
               Coloca el puntero sobre un precio para ver la fecha en la que fue actualizado.
            </p>
         </div>
         <div class="modal-body">
            <form id="f_buscar_articulos" name="f_buscar_articulos" action="<?php echo $fsc->url();?>" method="post" class="form">
               <input type="hidden" name="origen" value="<?php echo $fsc->transferencia->codalmaorigen;?>"/>
               <input type="hidden" name="destino" value="<?php echo $fsc->transferencia->codalmadestino;?>"/>
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="input-group">
                           <input class="form-control" type="text" name="query" autocomplete="off"/>
                           <span class="input-group-btn">
                              <button class="btn btn-primary" type="submit">
                                 <span class="glyphicon glyphicon-search"></span>
                              </button>
                           </span>
                        </div>
                        <label class="checkbox-inline">
                           <input type="checkbox" name="con_stock" value="TRUE" onchange="buscar_articulos()"/>
                           sólo con stock
                        </label>
                     </div>
                     <div class="col-sm-4">
                        <select class="form-control" name="codfamilia" onchange="buscar_articulos()">
                           <option value="">Cualquier familia</option>
                           <option value="">------</option>
                           <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        </select>
                     </div>
                     <div class="col-sm-4">
                        <select class="form-control" name="codfabricante" onchange="buscar_articulos()">
                           <option value="">Cualquier fabricante</option>
                           <option value="">------</option>
                           <?php $loop_var1=$fsc->fabricante->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codfabricante;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        </select>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <ul class="nav nav-tabs" id="nav_articulos" style="display: none;">
            <li id="li_mis_articulos" class="active">
               <a href="#" id="b_mis_articulos">Mi catálogo</a>
            </li>
         </ul>
         <div id="search_results"></div>
      </div>
   </div>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>