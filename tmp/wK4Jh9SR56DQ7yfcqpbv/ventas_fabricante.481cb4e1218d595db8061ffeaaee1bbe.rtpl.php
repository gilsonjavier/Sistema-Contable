<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->fabricante ){ ?>

<script type="text/javascript">
   $(document).ready(function() {
      $('[data-toggle="popover"]').popover({
         placement : 'bottom',
         trigger : 'hover',
         content: function() {
            return '<div class="thumbnail" style="margin: 0px;"><img src="'+$(this).data('img') + '" /></a>';
         }
      });
      $("#b_eliminar_fabricante").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Estas seguro de que deseas eliminar este fabricante?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = 'index.php?page=ventas_fabricantes&delete=<?php echo urlencode($fsc->fabricante->codfabricante); ?>';
               }
            }
         });
      });
   });
</script>

<form action="<?php echo $fsc->url();?>" method="post" class="form">
   <input type="hidden" name="cod" value="<?php echo $fsc->fabricante->codfabricante;?>"/>
   <div class="container-fluid">
      <div class="row" style="margin-bottom: 10px;">
         <div class="col-sm-7">
            <div class="btn-group">
               <a class="btn btn-sm btn-default" href="index.php?page=ventas_fabricantes">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs hidden-sm">&nbsp; Fabricantes</span>
               </a>
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
                  <li><a href="index.php?page=ventas_fabricantes#nuevo">Nuevo fabricante</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="index.php?page=ventas_articulos&b_codfabricante=<?php echo $fsc->fabricante->codfabricante;?>#nuevo">Nuevo artículo</a></li>
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

               <a href="#" id="b_eliminar_fabricante" class="btn btn-sm btn-danger">
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
               Nombre:
               <input class="form-control" type="text" name="nombre" placeholder="Nombre de la familia" value="<?php echo $fsc->fabricante->nombre;?>" onkeypress="teclear(event);return LetrasNumeros(event)" autocomplete="off"/>
            </div>
         </div>
      </div>
   </div>
</form>

<div role="tabpanel">
   <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
         <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
            Artículos
            <span class="hidden-xs badge"><?php echo $fsc->total_fabricante();?></span>
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
      <div role="tabpanel" class="tab-pane active" id="home">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Referencia + Descripción</th>
                     <th class="text-left">Familia</th>
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
                     <?php if( is_null($value1->codfamilia) ){ ?><span>-</span><?php }else{ ?><?php echo $value1->codfamilia;?><?php } ?>

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
                  <span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Anteriores
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
      <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <?php if( $value1->type=='tab' ){ ?>

         <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
            <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&cod=<?php echo $fsc->fabricante->codfabricante;?>" width="100%" height="2000" frameborder="0"></iframe>
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
  
