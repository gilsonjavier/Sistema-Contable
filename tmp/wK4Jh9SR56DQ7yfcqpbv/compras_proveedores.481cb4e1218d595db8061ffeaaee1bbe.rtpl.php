<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript">
   $(document).ready(function() {
      document.f_custom_search.query.focus();
      if(window.location.hash.substring(1) == 'nuevo')
      {
         $("#modal_nuevo_proveedor").modal('show');
         document.f_nuevo_proveedor.nombre.focus();
      }
      $("#b_nuevo_proveedor").click(function(event) {
         event.preventDefault();
         $("#modal_nuevo_proveedor").modal('show');
         document.f_nuevo_proveedor.nombre.focus();
      });
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-7 col-xs-12">
         <div class="btn-group hidden-xs">
            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
            <?php if( $fsc->page->is_default() ){ ?>

            <a class="btn btn-sm btn-default active" href="<?php echo $fsc->url();?>&amp;default_page=FALSE" title="Marcada como página de inicio (pulsa de nuevo para desmarcar)">
               <i class="fa fa-bookmark" aria-hidden="true"></i>
            </a>
            <?php }else{ ?>

            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>&amp;default_page=TRUE" title="Marcar como página de inicio">
               <i class="fa fa-bookmark-o" aria-hidden="true"></i>
            </a>
            <?php } ?>

         </div>
         <div class="btn-group">
            <a href="#" id="b_nuevo_proveedor" class="btn btn-sm btn-success">
               <span class="glyphicon glyphicon-plus"></span>
               <span class="hidden-xs">&nbsp;Nuevo</span>
            </a>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
      <div class="col-sm-5 col-xs-12 text-right">
         <h2 style="margin-top: 0px;">
            <i class="fa fa-users hidden-xs" aria-hidden="true"></i> Proveedores
            <span class="hidden-xs hidden-sm">/ Acreedores</span>
         </h2>
      </div>
   </div>
</div>

<div id="tab_proveedores" role="tabpanel">
   <ul class="nav nav-tabs">
      <li role="presentation" class="active">
         <a href="<?php echo $fsc->url();?>">
            <span class="glyphicon glyphicon-search"></span>
            <span class="hidden-xs">&nbsp;Resultados</span>
            <span class="badge"><?php echo $fsc->num_resultados;?></span>
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
         <form name="f_custom_search" action="<?php echo $fsc->url();?>" method="post" class="form">
            <div class="container-fluid" style="margin-top: 15px; margin-bottom: 10px;">
               <div class="row">
                  <div class="col-sm-2">
                     <div class="input-group">
                        <input class="form-control" type="text" name="query" value="<?php echo $fsc->query;?>" autocomplete="off" placeholder="Buscar">
                        <span class="input-group-btn hidden-sm">
                           <button class="btn btn-primary" type="submit">
                              <span class="glyphicon glyphicon-search"></span>
                           </button>
                        </span>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <select name="tipo" class="form-control" onchange="this.form.submit()">
                        <option value="">Todos</option>
                        <option value="acreedores"<?php if( $fsc->tipo=='acreedores' ){ ?> selected=""<?php } ?>>Acreedores</option>
                        <option value="noacreedores"<?php if( $fsc->tipo=='noacreedores' ){ ?> selected=""<?php } ?>>No acreedores</option>
                     </select>
                  </div>
                  <div class="col-sm-6">
                     <div class="checkbox">
                        <label>
                           <?php if( $fsc->debaja ){ ?>

                           <input type="checkbox" name="debaja" value="TRUE" checked="" onchange="this.form.submit()"/>
                           <?php }else{ ?>

                           <input type="checkbox" name="debaja" value="TRUE" onchange="this.form.submit()"/>
                           <?php } ?>

                           de baja
                        </label>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="input-group">
                        <div class="input-group-addon">
                           <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                        </div>
                        <select name="orden" class="form-control" onchange="this.form.submit()">
                           <?php $loop_var1=$fsc->orden(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <?php if( $fsc->orden==$key1 ){ ?>

                              <option value="<?php echo $key1;?>" selected=""><?php echo $value1;?></option>
                              <?php }else{ ?>

                              <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
                              <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                  </div>
               </div>
            </div>
         </form>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Código + Nombre</th>
                     <th class="text-left"><?php  echo FS_CIFNIF;?></th>
                     <th class="text-left">email</th>
                     <th class="text-left">Teléfono</th>
                     <th class="text-left">Observaciones</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class='clickableRow<?php if( $value1->debaja ){ ?> danger<?php } ?>' href='<?php echo $value1->url();?>'>
                  <td>
                     <a href="<?php echo $value1->url();?>"><?php echo $value1->codproveedor;?></a> <?php echo $value1->nombre;?>

                     <?php if( $value1->nombre!=$value1->razonsocial ){ ?>

                     <span class="label label-default"><?php echo $value1->razonsocial;?></span>
                     <?php } ?>

                     <?php if( $value1->acreedor ){ ?>

                     &nbsp; <span class="glyphicon glyphicon-briefcase" title="Es un acreedor"></span>
                     <?php } ?>

                     <?php if( $value1->debaja ){ ?>

                     &nbsp; <span class="label label-danger hidden-sm" title="proveedor dado de baja">Baja</span>
                     <?php } ?>

                  </td>
                  <td><?php echo $value1->cifnif;?></td>
                  <td><?php echo $value1->email;?></td>
                  <td>
                     <?php if( $value1->telefono1 ){ ?><?php echo $value1->telefono1;?><?php }elseif( $value1->telefono2 ){ ?><?php echo $value1->telefono2;?><?php } ?>

                  </td>
                  <td><?php echo $value1->observaciones_resume();?></td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="5">
                     Ningún proveedor encontrado. Pulsa el botón <b>Nuevo</b> para crear uno.
                  </td>
               </tr>
               <?php } ?>

            </table>
         </div>
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12 text-center">
                  <ul class="pagination">
                     <?php $loop_var1=$fsc->paginas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <li<?php if( $value1['actual'] ){ ?> class="active"<?php } ?>>
                        <a href="<?php echo $value1['url'];?>"><?php echo $value1['num'];?></a>
                     </li>
                     <?php } ?>

                  </ul>
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
</div>

<form class="form-horizontal" role="form" name="f_nuevo_proveedor" action="<?php echo $fsc->url();?>" method="post">
   <div class="modal" id="modal_nuevo_proveedor">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nuevo proveedor / acreedor</h4>
               <p class="help-block">
                  Los acreedores son todos aquellos proveedores a los que no les compramos mercancias.
                  Por ejemplo: proveedor de internet, teléfono, bancos...
               </p>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <div class="col-sm-12">
                     <input type="text" name="nombre" placeholder="Nombre" class="form-control" onkeypress="teclear(event);return texto(event)" autocomplete="off" required=""/>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-4">
                     <select name="tipoidfiscal" class="form-control">
                        <?php $tiposid=$this->var['tiposid']=fs_tipos_id_fiscal();?>

                        <?php $loop_var1=$tiposid; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1;?>"><?php echo $value1;?></option>
                        <?php } ?>

                     </select>
                  </div>
                  <div class="col-sm-8">
                     <input type="text" name="cifnif" class="form-control" id="ced" placeholder="Identificacion" onkeypress="return numeros(event)"  onblur="validarc()" minlength="10" maxlength="13" autocomplete="off"/>
                     <label class="checkbox-inline">
                        <input type="checkbox" name="personafisica" value="TRUE"/> persona física (no empresa)
                     </label>
                     <label class="checkbox-inline">
                        <input type="checkbox" name="acreedor" value="TRUE"/> acreedor
                     </label>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">
                     <a href="<?php echo $fsc->pais->url();?>">País</a>
                  </label>
                  <div class="col-sm-10">
                     <select name="pais" class="form-control">
                        <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1->codpais;?>"<?php if( $value1->is_default() ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                        <?php } ?>

                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label text-capitalize"><?php  echo FS_PROVINCIA;?></label>
                  <div class="col-sm-10">
                     <input type="text" name="provincia" id="ac_provincia" placeholder="Manabi" onkeypress="teclear(event)" class="form-control" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Ciudad</label>
                  <div class="col-sm-10">
                     <input type="text" name="ciudad" placeholder="Manta" onkeypress="teclear(event)" class="form-control"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Cód. Postal</label>
                  <div class="col-sm-10">
                     <input type="text" name="codpostal" maxlength="10" class="form-control" autocomplete="off" readonly/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Dirección</label>
                  <div class="col-sm-10">
                     <input type="text" name="direccion" class="form-control" placeholder="Centro de Manta" onkeypress="teclear(event)" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label text-capitalize"><?php  echo FS_APARTADO;?></label>
                  <div class="col-sm-10">
                     <input type="text" name="apartado" maxlength="10" class="form-control" autocomplete="off"/>
                  </div>
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
    //alert('Este script valida el RUC del usuario y mostrará \n por pantalla si es una persona natural, jurídica o sociedad.\n');
    function validarc()
   {
    var i;
    var cedula;
    var acumulado;
    cedula=document.getElementById('ced').value;
    var instancia;
    acumulado=0;
    for (i=1;i<=9;i++)
    {
     if (i%2!=0)
     {
      instancia=cedula.substring(i-1,i)*2;
      if (instancia>9) instancia-=9;
     }
     else instancia=cedula.substring(i-1,i);
     acumulado+=parseInt(instancia);
    }
    while (acumulado>0)
     acumulado-=10;
    if (cedula.substring(9,10)!=(acumulado*-1))
    {
     alert("Documento no valido!!");
     document.getElementById('ced').value.setfocus();
    }
    alert("Documento valido !!");
   }
   
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