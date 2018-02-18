<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->articulo ){ ?>

<script type="text/javascript" src="<?php echo $fsc->get_js_location('ventas_articulo.js');?>"></script>
<script type="text/javascript">
    function delete_combinacion(cod)
    {
        bootbox.confirm({
            message: '¿Realmente desea eliminar la combinacion ' + cod + '?',
            title: '<b>Atención</b>',
            callback: function (result) {
                if (result) {
                    window.location.href = '<?php echo $fsc->url();?>&delete_combi=' + cod + '#atributos';
                }
            }
        });
    }
   $(document).ready(function() {
      $("#b_eliminar_articulo").click(function(event) {
         event.preventDefault();
         <?php if( $fsc->articulo->publico ){ ?>

         bootbox.alert({
            message: 'Este artículo <b>es público</b>. Si estas seguro de que quieres eliminarlo, desmarcalo como público, guarda y pulsa eliminar.',
            title: "<b>Atención</b>"
         });
         <?php }else{ ?>

         bootbox.confirm({
            message: '¿Estas seguro de que deseas eliminar este articulo?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = "index.php?page=ventas_articulos&delete=<?php echo urlencode($fsc->articulo->referencia); ?>";
               }
            }
         });
         <?php } ?>

      });
   });
</script>

<div class="container-fluid" style="margin-bottom: 10px;">
   <div class="row">
      <div class="col-xs-7">
         <div class="btn-group">
            <a href="index.php?page=ventas_articulos" class="btn btn-sm btn-default">
               <span class="glyphicon glyphicon-arrow-left"></span>
               <span class="hidden-xs">&nbsp;Todos</span>
            </a>
            <a href="<?php echo $fsc->url();?>" class="btn btn-sm btn-default hidden-xs" title="Recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
         </div>
         <div class="btn-group">
            <a href="#" id="b_imagen" class="btn btn-sm btn-default">
               <span class="glyphicon glyphicon-picture"></span>
               <span class="hidden-xs">&nbsp;Imagen</span>
            </a>
            <?php if( $fsc->articulo->trazabilidad ){ ?>

            <a href='index.php?page=articulo_trazabilidad&ref=<?php echo urlencode($fsc->articulo->referencia); ?>' class="btn btn-sm btn-default">
               <i class="fa fa-code-fork" aria-hidden="true"></i>
               <span class="hidden-xs">&nbsp;Trazabilidad</span>
            </a>
            <?php } ?>

         </div>
         <div class="btn-group">
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='button' ){ ?>

            <a href='index.php?page=<?php echo $value1->from;?>&ref=<?php echo urlencode($fsc->articulo->referencia); ?><?php echo $value1->params;?>' class="btn btn-sm btn-default">
               <?php echo $value1->text;?>

            </a>
            <?php }elseif( $value1->type=='modal' ){ ?>

            <!--<?php $txt=$this->var['txt']=base64_encode($value1->text);?>-->
            <!--<?php echo $url='index.php?page='.$value1->from.'&ref='.urlencode($fsc->articulo->referencia).$value1->params;?>-->
            <a href="#" class="btn btn-sm btn-default" onclick="fs_modal('<?php echo $txt;?>','<?php echo $url;?>')"><?php echo $value1->text;?></a>
            <?php } ?>

         <?php } ?>

         </div>
      </div>
      <div class="col-xs-5 text-right">
         <a class="btn btn-sm btn-success" href="index.php?page=ventas_articulos&b_codfamilia=<?php echo $fsc->articulo->codfamilia;?>&b_codfabricante=<?php echo $fsc->articulo->codfabricante;?>#nuevo" title="Nuevo artículo">
            <span class="glyphicon glyphicon-plus"></span>
         </a>
         <?php if( $fsc->allow_delete ){ ?>

         <a href="#" id="b_eliminar_articulo" class="btn btn-sm btn-danger">
            <span class="glyphicon glyphicon-trash"></span>
            <span class="hidden-xs">&nbsp;Eliminar</span>
         </a>
         <?php } ?>

      </div>
   </div>
</div>

<div id="tab_articulo" role="tabpanel">
   <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
         <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp;<?php echo $fsc->articulo->referencia;?></span>
         </a>
      </li>
      <?php if( $fsc->mostrar_tab_atributos ){ ?>

      <li role="presentation">
         <a href="#atributos" aria-controls="atributos" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp;Atributos</span>
         </a>
      </li>
      <?php } ?>

      <?php if( $fsc->mostrar_tab_precios ){ ?>

      <li role="presentation">
         <a href="#precios" aria-controls="precios" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp;Precios</span>
         </a>
      </li>
      <?php } ?>

      <?php if( $fsc->mostrar_tab_stock ){ ?>

      <li role="presentation">
         <a href="#stock" aria-controls="stock" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp;Stock</span>
         </a>
      </li>
      <?php } ?>

      <?php if( $fsc->equivalentes ){ ?>

      <li role="presentation">
         <a href="#equivalentes" aria-controls="equivalentes" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-random" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp;Equivalentes</span>
         </a>
      </li>
      <?php } ?>

      <!--
      <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <?php if( $value1->type=='tab' ){ ?>

         <li role="presentation">
            <a href="#ext_<?php echo $value1->name;?>" aria-controls="ext_<?php echo $value1->name;?>" role="tab" data-toggle="tab"><?php echo $value1->text;?></a>
         </li>
         <?php } ?>

      <?php } ?>

        -->
      <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp;Buscar en...</span>
            <span class="caret"></span>
         </a>
         <ul class="dropdown-menu" role="menu">
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab_button' ){ ?>

            <li>
               <a href="index.php?page=<?php echo $value1->from;?>&ref=<?php echo urlencode($fsc->articulo->referencia); ?><?php echo $value1->params;?>">
                  <?php echo $value1->text;?>

               </a>
            </li>
            <?php } ?>

         <?php } ?>

         </ul>
      </li>
   </ul>
   <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="home">
         <form action="<?php echo $fsc->url();?>" method="post" class="post">
            <input type="hidden" name="referencia" value="<?php echo $fsc->articulo->referencia;?>"/>
            <div class="container-fluid">
               <div class="row" style="padding-top: 10px;">
                  <div class="col-sm-3">
                     <div class="form-group">
                        Referencia:
                        <input class="form-control" type="text" name="nreferencia" placeholder="Referencia (#)" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->articulo->referencia;?>" maxlength="18" autocomplete="off"/>
                     </div>
                     <div class="form-group">
                        Tipo:
                        <select name="tipo" class="form-control" onchange="this.form.submit()">
                           <option value="">Producto simple</option>
                           <?php if( $fsc->hay_atributos ){ ?>

                              <?php if( $fsc->articulo->tipo=='atributos' ){ ?>

                              <option value="atributos" selected="">Producto con atributos</option>
                              <?php }else{ ?>

                              <option value="atributos">Producto con atributos</option>
                              <?php } ?>

                           <?php } ?>

                           <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <?php if( $value1->type=='tipo_art' ){ ?>

                                 <?php if( $fsc->articulo->tipo==$value1->params ){ ?>

                                 <option value="<?php echo $value1->params;?>" selected=""><?php echo $value1->text;?></option>
                                 <?php }else{ ?>

                                 <option value="<?php echo $value1->params;?>"><?php echo $value1->text;?></option>
                                 <?php } ?>

                              <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                  </div>
                  <div class="col-sm-9">
                     <div class="form-group">
                        Descripción:
                        <textarea name="descripcion" class="form-control" onkeypress="teclear(event)" rows="4"><?php echo $fsc->articulo->descripcion;?></textarea>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        <a href="<?php echo $fsc->familia->url();?>">Familia</a>:
                        <select class="form-control" name="codfamilia">
                           <option value="">Seleccione una familia</option>
                           <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <?php if( $value1->codfamilia===$fsc->articulo->codfamilia ){ ?>

                              <option value="<?php echo $value1->codfamilia;?>" selected=""><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                              <?php }else{ ?>

                              <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                              <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                  </div>
                   <div class="col-sm-2">
                     <div class="form-group">
                        <a href="<?php echo $fsc->fabricante->url();?>">Fabricante</a>:
                        <select class="form-control" name="codfabricante">
                           <option value="">Seleccione fabricante</option>
                           <?php $loop_var1=$fsc->fabricante->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <?php if( $value1->codfabricante===$fsc->articulo->codfabricante ){ ?>

                              <option value="<?php echo $value1->codfabricante;?>" selected=""><?php echo $value1->codfabricante;?></option>
                              <?php }else{ ?>

                              <option value="<?php echo $value1->codfabricante;?>"><?php echo $value1->codfabricante;?></option>
                              <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        Código de barras:
                        <div class="input-group">
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
                           </span>
                           <input class="form-control" type="text" name="codbarras" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->articulo->codbarras;?>" autocomplete="off" placeholder="Opcional" />
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        PartNumber:
                        <div class="input-group">
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                           </span>
                           <input class="form-control" type="text" name="partnumber" value="<?php echo $fsc->articulo->partnumber;?>" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Código de equivalencia:
                        <input class="form-control" type="text" name="equivalencia" value="<?php echo $fsc->articulo->equivalencia;?>" autocomplete="off"/>
                        <p class="help-block">Dos o más artículos son equivalentes si tienen el mismo código de equivalencia.</p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        Stock:
                        <input class="form-control" type="text" name="stockfis" onkeypress="teclear(event);return numeros(event)" value="<?php echo $fsc->articulo->stockfis;?>" disabled="disabled"/>
                        <label>
                           <input type="checkbox" name="nostock" value="TRUE"<?php if( $fsc->articulo->nostock ){ ?> checked=""<?php } ?>/>
                           No controlar stock
                        </label>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        Stock mínimo:
                        <input class="form-control" type="number" min="0" name="stockmin" onkeypress="teclear(event);return numeros(event)" value="<?php echo $fsc->articulo->stockmin;?>" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        Stock máximo:
                        <input class="form-control" type="number" min="0" name="stockmax" onkeypress="teclear(event);return numeros(event)" value="<?php echo $fsc->articulo->stockmax;?>" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="secompra" value="TRUE"<?php if( $fsc->articulo->secompra ){ ?> checked=""<?php } ?>/>
                           Se compra
                        </label>
                     </div>
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="sevende" value="TRUE"<?php if( $fsc->articulo->sevende ){ ?> checked=""<?php } ?>/>
                           Se vende
                        </label>
                     </div>
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="controlstock" value="TRUE"<?php if( $fsc->articulo->controlstock ){ ?> checked=""<?php } ?>/>
                           Permitir ventas sin stock
                        </label>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="trazabilidad" value="TRUE"<?php if( $fsc->articulo->trazabilidad ){ ?> checked=""<?php } ?>/>
                           <i class="fa fa-code-fork" aria-hidden="true"></i> Trazabilidad / números de serie
                        </label>
                     </div>
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="bloqueado" value="TRUE"<?php if( $fsc->articulo->bloqueado ){ ?> checked=""<?php } ?>/>
                           <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Bloqueado / Obsoleto
                        </label>
                     </div>
                     <?php if( $fsc->mostrar_boton_publicar ){ ?>

                     <div class="checkbox">
                        <label title="Sincronizar con tienda online (si está disponible)">
                           <input type="checkbox" name="publico" value="TRUE"<?php if( $fsc->articulo->publico ){ ?> checked=""<?php } ?>/>
                           <span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Público
                        </label>
                     </div>
                     <?php }elseif( $fsc->articulo->publico ){ ?>

                     <input type="hidden" name="publico" value="TRUE"/>
                     <?php } ?>

                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-10">
                     <div class="form-group">
                        Observaciones:
                        <textarea class="form-control" name="observaciones" onkeypress="teclear(event)" rows="3"><?php echo $fsc->articulo->observaciones;?></textarea>
                     </div>
                  </div>
                  <div class="col-sm-2 text-right">
                     <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                        <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                     </button>
                  </div>
               </div>

            </div>
         </form>
      </div>
      <?php if( $fsc->mostrar_tab_atributos ){ ?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/ventas_articulo_atributos") . ( substr("block/ventas_articulo_atributos",-1,1) != "/" ? "/" : "" ) . basename("block/ventas_articulo_atributos") );?><?php } ?>

      <?php if( $fsc->mostrar_tab_precios ){ ?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/ventas_articulo_precios") . ( substr("block/ventas_articulo_precios",-1,1) != "/" ? "/" : "" ) . basename("block/ventas_articulo_precios") );?><?php } ?>

      <?php if( $fsc->mostrar_tab_stock ){ ?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/ventas_articulo_stock") . ( substr("block/ventas_articulo_stock",-1,1) != "/" ? "/" : "" ) . basename("block/ventas_articulo_stock") );?><?php } ?>

      <?php if( $fsc->equivalentes ){ ?>

      <div role="tabpanel" class="tab-pane" id="equivalentes">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Artículo</th>
                     <th class="text-right">Precio</th>
                     <th class="text-right">Precio+<?php  echo FS_IVA;?></th>
                     <th class="text-right">Stock</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->equivalentes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class="clickableRow" href="<?php echo $value1->url();?>">
                  <td>
                     <a href="<?php echo $value1->url();?>"><?php echo $value1->referencia;?></a>
                     <?php echo $value1->descripcion;?>

                  </td>
                  <td class="text-right"><?php echo $fsc->show_precio($value1->pvp);?></td>
                  <td class="text-right"><?php echo $fsc->show_precio($value1->pvp_iva());?></td>
                  <td class="text-right"><?php echo $value1->stockfis;?></td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="3">Sin resultados.</td>
               </tr>
               <?php } ?>

            </table>
         </div>
      </div>
      <?php } ?>

      <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <?php if( $value1->type=='tab' ){ ?>

         <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
            <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&ref=<?php echo urlencode($fsc->articulo->referencia); ?>" width="100%" height="2000" frameborder="0">
            </iframe>
         </div>
         <?php } ?>

      <?php } ?>

   </div>
</div>

<form action="<?php echo $fsc->url();?>" enctype="multipart/form-data" method="post" class="form">
   <input type="hidden" name="referencia" value="<?php echo $fsc->articulo->referencia;?>"/>
   <input type="hidden" name="imagen" value="TRUE"/>
   <div class="modal fade" id="modal_articulo_imagen">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-picture"></span>&nbsp; Imagen
               </h4>
            </div>
            <div class="modal-body">
               <?php if( $fsc->articulo->imagen_url() ){ ?>

               <div class="thumbnail">
                  <img src="<?php echo $fsc->articulo->imagen_url();?>" alt="<?php echo $fsc->articulo->referencia;?>"/>
                  <div class="caption">
                     <p>Esta imagen está guardada en <?php echo $fsc->articulo->imagen_url();?></p>
                  </div>
               </div>
               <?php }else{ ?>

               <div class="form-group">
                  <input type="file" name="fimagen" accept="image/jpeg, image/png"/>
               </div>
               <?php } ?>

            </div>
            <div class="modal-footer">
               <?php if( $fsc->articulo->imagen_url() ){ ?>

               <a class="btn btn-sm btn-danger" href="<?php echo $fsc->url();?>&delete_img=TRUE">
                  <span class="glyphicon glyphicon-trash"></span>&nbsp; Eliminar
               </a>
               <?php }else{ ?>

               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
               <?php } ?>

            </div>
         </div>
      </div>
   </div>
</form>
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