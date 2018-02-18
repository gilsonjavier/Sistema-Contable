<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   $(document).ready(function() {   
      document.f_custom_search.query.focus();
      
      if(window.location.hash.substring(1) == 'nuevo')
      {
         $("#modal_nuevo_fabricante").modal('show');
         document.f_nuevo_fabricante.ncodfabricante.focus();
      }
      
      $("#b_nuevo_fabricante").click(function(event) {
         event.preventDefault();
         $("#modal_nuevo_fabricante").modal('show');
         document.f_nuevo_fabricante.ncodfabricante.focus();
      });
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-md-10 col-sm-9">
         <div class="btn-group">
            <a class="btn btn-sm btn-default" href="index.php?page=ventas_articulos">
               <span class="glyphicon glyphicon-arrow-left"></span>
               <span class="hidden-xs">&nbsp;Artículos</span>
            </a>
            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
         </div>
         <a id="b_nuevo_fabricante" class="btn btn-sm btn-success" href="#">
            <span class="glyphicon glyphicon-plus"></span>
            <span class="hidden-xs">&nbsp;Nuevo</span>
         </a>
         <div class="btn-group">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
      <div class="col-md-2 col-sm-3">
         <div class="visible-xs">
            <br/>
         </div>
         <form name="f_custom_search" action="<?php echo $fsc->url();?>" method="post" class="form">
            <div class="input-group">
               <input class="form-control" type="text" name="query" value="<?php echo $fsc->query;?>" autocomplete="off" placeholder="Buscar">
               <span class="input-group-btn">
                  <button class="btn btn-primary hidden-sm" type="submit">
                     <span class="glyphicon glyphicon-search"></span>
                  </button>
               </span>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <?php if( $fsc->query=='' ){ ?>

               <span class="glyphicon glyphicon-folder-open"></span>
               &nbsp;Fabricantes
               <small><?php echo $fsc->total_fabricantes();?></small>
               <?php }else{ ?>

               <span class="glyphicon glyphicon-search"></span>
               &nbsp;Resultados de '<?php echo $fsc->query;?>'
               <?php } ?>

            </h1>
            <p class="help-block">
               Introduce aquí todos los fabricantes de los artículos que vendes o compras.
            </p>
         </div>
      </div>
   </div>
   <div class="row">
           <!--<?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

        &nbsp; <?php echo $value1->nombre();?>

      <?php } ?>-->
      <?php $loop_var1=$fsc->fabricante->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <div class="col-sm-3 col-lg-2" style="margin-bottom: 5px;">
         <a class="btn btn-block btn-default" href="<?php echo $value1->url();?>">
            <span class="glyphicon glyphicon-folder-open"></span>
            &nbsp; <?php echo $value1->codfabricante;?>

         </a>
      </div>
      <?php }else{ ?>

      <div class="col-sm-12 col-lg-12">
         <div class="alert alert-warning">Ningún fabricante encontrado. Pulsa el botón <b>Nuevo</b> para crear uno.</div>
      </div>
      <?php } ?>

   </div>
</div>

<form class="form" name="f_nuevo_fabricante" action="<?php echo $fsc->url();?>" method="post">
   <div class="modal" id="modal_nuevo_fabricante">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nuevo fabricante</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Código:
                  <input class="form-control" type="text" placeholder="XXXXXXX" name="ncodfabricante" onkeypress="teclear(event);return LetrasNumeros(event)" maxlength="8" autocomplete="off" required=""/>
               </div>
               <div class="form-group">
                  Descripción:
                  <input class="form-control" type="text" placeholder="Fabricante" onkeypress="teclear(event);return LetrasNumeros(event)" name="nnombre" autocomplete="off" required=""/>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>

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
  