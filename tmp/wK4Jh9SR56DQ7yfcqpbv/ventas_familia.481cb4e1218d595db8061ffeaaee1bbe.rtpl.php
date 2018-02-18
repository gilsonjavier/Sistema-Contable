<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->familia ){ ?>

<script type="text/javascript">
   $(document).ready(function() {
      $('[data-toggle="popover"]').popover({
         placement : 'bottom',
         trigger : 'hover',
         content: function() {
            return '<div class="thumbnail" style="margin: 0px;"><img src="'+$(this).data('img') + '" /></a>';
         }
      });
      $("#b_eliminar_familia").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Estas seguro de que deseas eliminar esta familia?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = 'index.php?page=ventas_familias&delete=<?php echo urlencode($fsc->familia->codfamilia); ?>';
               }
            }
         });
      });
   });
</script>

<form action="<?php echo $fsc->url();?>" method="post" class="form">
   <input type="hidden" name="cod" value="<?php echo $fsc->familia->codfamilia;?>"/>
   <div class="container-fluid">
      <div class="row" style="margin-bottom: 10px;">
         <div class="col-sm-7">
            <div class="btn-group">
               <?php if( $fsc->madre ){ ?>

               <a class="btn btn-sm btn-default" href="<?php echo $fsc->madre->url();?>" title="<?php echo $fsc->madre->descripcion;?>">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp; Madre</span>
               </a>
               <?php }else{ ?>

               <a class="btn btn-sm btn-default" href="index.php?page=ventas_familias">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp; Familias</span>
               </a>
               <?php } ?>

               <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </div>
            <div class="btn-group">
               <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-plus"></span>
                  <span class="caret"></span>
               </button>
               <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="index.php?page=ventas_familias#nueva">Nueva familia</a></li>
                  <li><a href="index.php?page=ventas_familias&madre=<?php echo $fsc->familia->codfamilia;?>">Nueva subfamilia</a></li>
                  <?php if( $fsc->familia->madre ){ ?>

                  <li><a href="index.php?page=ventas_familias&madre=<?php echo $fsc->familia->madre;?>">Nueva familia hermana</a></li>
                  <?php } ?>

                  <li role="separator" class="divider"></li>
                  <li><a href="index.php?page=ventas_articulos&b_codfamilia=<?php echo $fsc->familia->codfamilia;?>#nuevo">Nuevo artículo</a></li>
               </ul>
            </div>
            <div class="btn-group">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

            </div>
         </div>
         <div class="col-sm-5 text-right">
            <div class="btn-group">
               <?php if( $fsc->allow_delete ){ ?>

               <a href="#" id="b_eliminar_familia" class="btn btn-sm btn-danger">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs hidden-sm">&nbsp;Eliminar</span>
               </a>
               <?php } ?>

               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-8">
            <div class="form-group">
               Descripción:
               <input class="form-control" type="text" name="descripcion" placeholder="Descripcion..." onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->familia->descripcion;?>" autocomplete="off"/>
            </div>
         </div>
         <div class="col-sm-4">
            <div class="form-group">
               Familia madre:
               <select name="madre" class="form-control">
                  <option value="---">Ninguna</option>
                  <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codfamilia==$fsc->familia->codfamilia ){ ?>

                     <?php }elseif( $value1->madre==$fsc->familia->codfamilia ){ ?>

                     <?php }elseif( $fsc->familia->madre==$value1->codfamilia ){ ?>

                     <option value="<?php echo $value1->codfamilia;?>" selected=""><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </div>
         </div>
      </div>
   </div>
</form>

<div role="tabpanel">
   <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
         <a href="#articulos" aria-controls="articulos" role="tab" data-toggle="tab">
            Artículos
            <span class="hidden-xs badge"><?php echo $fsc->total_familia();?></span>
         </a>
      </li>
      <li role="presentation">
         <a href="#subfamilias" aria-controls="subfamilias" role="tab" data-toggle="tab">
            Subfamilias
            <span class="hidden-xs badge"><?php echo count($fsc->subfamilias); ?></span>
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
      <div role="tabpanel" class="tab-pane active" id="articulos">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Referencia + Descripción</th>
                     <th class="text-left">Fabricante</th>
                     <th class="text-right">Coste</th>
                     <th class="text-right">Precio</th>
                     <th class="text-right">Stock</th>
                     <th class="text-right"></th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->articulos; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class='clickableRow<?php if( $value1->bloqueado ){ ?> danger<?php }elseif( $value1->stockfis<=$value1->stockmin ){ ?> warning<?php } ?>' href='<?php echo $value1->url();?>'>
                  <td>
                     <?php $img=$this->var['img']=$value1->imagen_url();?>

                     <?php if( $img ){ ?>

                     <a href="<?php echo $value1->url();?>" data-toggle="popover" data-html="true" data-img="<?php echo $img;?>"><?php echo $value1->referencia;?></a>
                     <span class="glyphicon glyphicon-picture" aria-hidden="true" data-toggle="popover" data-html="true" data-img="<?php echo $img;?>"></span>
                     <?php }else{ ?>

                     <a href="<?php echo $value1->url();?>"><?php echo $value1->referencia;?></a>
                     <?php } ?>

                     <?php echo $value1->descripcion();?>

                  </td>
                  <td>
                     <?php if( is_null($value1->codfabricante) ){ ?><span>-</span><?php }else{ ?><?php echo $value1->codfabricante;?><?php } ?>

                  </td>
                  <td class="text-right"><?php echo $fsc->show_precio($value1->preciocoste(), FALSE, TRUE, FS_NF0_ART);?></td>
                  <td class="text-right">
                     <span title="actualizado el <?php echo $value1->factualizado;?>"><?php echo $fsc->show_precio($value1->pvp, FALSE, TRUE, FS_NF0_ART);?></span>
                  </td>
                  <td class="text-right"><?php echo $value1->stockfis;?></td>
                  <td class="text-right">
                     <?php if( $value1->tipo ){ ?>

                     <span class="glyphicon glyphicon-list-alt" aria-hidden="true" title="Artículo tipo: <?php echo $value1->tipo;?>"></span>
                     <?php } ?>

                     <?php if( $value1->trazabilidad ){ ?>

                     <i class="fa fa-code-fork" aria-hidden="true" title="Trazabilidad activada"></i>
                     <?php } ?>

                     <?php if( $value1->publico ){ ?>

                     <span class="glyphicon glyphicon-globe" aria-hidden="true" title="Artículo público"></span>
                     <?php } ?>

                  </td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="6">Ningún artículo encontrado.</td>
               </tr>
               <?php } ?>

            </table>
         </div>
         <ul class="pager">
            <?php if( $fsc->anterior_url()!='' ){ ?>

            <li class="previous">
               <a href="<?php echo $fsc->anterior_url();?>">
                  <span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Anteriors
               </a>
            </li>
            <?php } ?>

            
            <?php if( $fsc->siguiente_url()!='' ){ ?>

            <li class="next">
               <a href="<?php echo $fsc->siguiente_url();?>">
                  Siguientes &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
               </a>
            </li>
            <?php } ?>

         </ul>
      </div>
      <div role="tabpanel" class="tab-pane" id="subfamilias">
         <br/>
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-3 col-lg-2" style="margin-bottom: 5px;">
                  <a class="btn btn-block btn-success" href="index.php?page=ventas_familias&madre=<?php echo $fsc->familia->codfamilia;?>">
                     <span class="glyphicon glyphicon-plus-sign"></span>
                     &nbsp;Nueva...
                  </a>
               </div>
               <?php $loop_var1=$fsc->subfamilias; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <div class="col-sm-3 col-lg-2" style="margin-bottom: 5px;">
                  <a class="btn btn-block btn-default" href="<?php echo $value1->url();?>">
                     <span class="glyphicon glyphicon-folder-open"></span>
                     &nbsp; <?php echo $value1->descripcion();?>

                  </a>
               </div>
               <?php } ?>

            </div>
         </div>
      </div>
      <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <?php if( $value1->type=='tab' ){ ?>

         <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
            <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&cod=<?php echo $fsc->familia->codfamilia;?>" width="100%" height="2000" frameborder="0"></iframe>
         </div>
         <?php } ?>

      <?php } ?>

   </div>
</div>

<?php }else{ ?>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
         <div class="thumbnail">
            <img src="<?php  echo FS_PATH;?>view/img/fuuu_face.png" alt="fuuuuu"/>
         </div>
      </div>
   </div>
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
  