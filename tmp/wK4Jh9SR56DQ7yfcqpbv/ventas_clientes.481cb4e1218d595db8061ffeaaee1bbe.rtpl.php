<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript">
   function show_nuevo_cliente()
   {
      $("#modal_nuevo_cliente").modal('show');
      document.f_nuevo_cliente.nombre.focus();
   }
   function show_grupos()
   {
      $('#tab_clientes a[href="#grupos"]').tab('show');
   }
   $(document).ready(function() {
      if(window.location.hash.substring(1) == 'nuevo')
      {
         show_nuevo_cliente();
      }
      else if(window.location.hash.substring(1) == 'grupos')
      {
         show_grupos();
      }
      else
      {
         document.f_custom_search.query.focus();
      }

      $("#b_nuevo_cliente").click(function(event) {
         event.preventDefault();
         show_nuevo_cliente();
      });
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-7 col-xs-6">
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
            <a href="#" id="b_nuevo_cliente" class="btn btn-sm btn-success">
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
      <div class="col-sm-5 col-xs-6 text-right">
         <h2 style="margin-top: 0px;">
            <i class="fa fa-users hidden-xs" aria-hidden="true"></i> Clientes
         </h2>
      </div>
   </div>
</div>

<ul id="tab_clientes" class="nav nav-tabs" role="tablist">
   <li role="presentation" class="active">
      <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
         <span class="glyphicon glyphicon-search"></span>
         <span class="hidden-xs">&nbsp;Resultados</span>
         <span class="badge"><?php echo $fsc->total_resultados;?></span>
      </a>
   </li>
   <li role="presentation">
      <a href="#grupos" aria-controls="grupos" role="tab" data-toggle="tab">
         <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
         <span class="hidden-xs">&nbsp;Grupos</span>
         <span class="badge"><?php echo count($fsc->grupos); ?></span>
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
                  <select name="codpais" class="form-control" onchange="this.form.submit()">
                     <option value="">Cualquier pais</option>
                     <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->codpais==$fsc->codpais ){ ?>

                        <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                        <?php } ?>

                     <?php } ?>

                  </select>
               </div>
               <div class="col-sm-2">
                  <select name="provincia" class="form-control" onchange="this.form.submit()">
                     <option value="">Cualquier provincia</option>
                     <?php $loop_var1=$fsc->provincias(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $key1===$fsc->provincia ){ ?>

                        <option value="<?php echo $key1;?>" selected=""><?php echo $value1;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
                        <?php } ?>

                     <?php } ?>

                  </select>
               </div>
               <div class="col-sm-2">
                  <select name="ciudad" class="form-control" onchange="this.form.submit()">
                     <option value="">Cualquier ciudad</option>
                     <?php $loop_var1=$fsc->ciudades(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $key1===$fsc->ciudad ){ ?>

                        <option value="<?php echo $key1;?>" selected=""><?php echo $value1;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
                        <?php } ?>

                     <?php } ?>

                  </select>
               </div>
               <div class="col-sm-2">
                  <select name="bcodgrupo" class="form-control" onchange="this.form.submit()">
                     <option value="">Cualquier grupo</option>
                     <?php $loop_var1=$fsc->grupos; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->codgrupo==$fsc->codgrupo ){ ?>

                        <option value="<?php echo $value1->codgrupo;?>" selected=""><?php echo $value1->nombre;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->codgrupo;?>"><?php echo $value1->nombre;?></option>
                        <?php } ?>

                     <?php } ?>

                  </select>
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
            <div class="row">
               <div class="col-sm-12">
                  <div class="checkbox-inline">
                     <label>
                        <?php if( $fsc->nocifnif ){ ?>

                        <input type="checkbox" name="nocifnif" value="TRUE" checked="" onchange="this.form.submit()"/>
                        <?php }else{ ?>

                        <input type="checkbox" name="nocifnif" value="TRUE" onchange="this.form.submit()"/>
                        <?php } ?>

                        sin <?php  echo FS_CIFNIF;?>

                     </label>
                  </div>
                  <div class="checkbox-inline">
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
                  <th class="text-right">Grupo</th>
               </tr>
            </thead>
            <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class='clickableRow<?php if( $value1->debaja ){ ?> danger<?php }elseif( $value1->fechaalta==$fsc->today() ){ ?> success<?php } ?>' href='<?php echo $value1->url();?>'>
                  <td>
                     <a href="<?php echo $value1->url();?>"><?php echo $value1->codcliente;?></a> <?php echo $value1->nombre;?>

                     <?php if( $value1->nombre!=$value1->razonsocial ){ ?>

                     <span class="label label-default"><?php echo $value1->razonsocial;?></span>
                     <?php } ?>

                     <?php if( $value1->debaja ){ ?>

                     &nbsp; <span class="label label-danger hidden-sm" title="cliente dado de baja">Baja</span>
                     <?php }elseif( $value1->fechaalta==$fsc->today() ){ ?>

                     &nbsp; <span class="label label-success hidden-sm" title="Nuevo cliente">Nuevo</span>
                     <?php } ?>

                  </td>
                  <td><?php echo $value1->cifnif;?></td>
                  <td><?php echo $value1->email;?></td>
                  <td>
                     <?php if( $value1->telefono1 ){ ?><?php echo $value1->telefono1;?><?php }elseif( $value1->telefono2 ){ ?><?php echo $value1->telefono2;?><?php } ?>

                  </td>
                  <td><?php echo $value1->observaciones_resume();?></td>
                  <td class="text-right"><?php echo $fsc->nombre_grupo($value1->codgrupo);?></td>
               </tr>
            <?php }else{ ?>

               <tr class="warning">
                  <td colspan="6">Ningún cliente encontrado. Pulse el botón <b>Nuevo</b> para crear uno.</td>
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
   <div role="tabpanel" class="tab-pane" id="grupos">
      <div class="container-fluid" style="margin-top: 15px;">
         <div class="row">
            <div class="col-sm-8">
               <div class="table-responsive">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th class="text-left">Código + Nombre</th>
                           <th class="text-right">Tarifa</th>
                        </tr>
                     </thead>
                     <?php $loop_var1=$fsc->grupos; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <tr class="clickableRow" href="<?php echo $value1->url();?>">
                        <td>
                           <a href="<?php echo $value1->url();?>"><?php echo $value1->codgrupo;?></a> <?php echo $value1->nombre;?>

                        </td>
                        <td class="text-right">
                           <?php $loop_var2=$fsc->tarifas; $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                              <?php if( $value1->codtarifa==$value2->codtarifa ){ ?><?php echo $value2->nombre;?><?php } ?>

                           <?php } ?>

                        </td>
                     </tr>
                     <?php }else{ ?>

                     <tr class="warning">
                        <td colspan="2">Sin resultados.</td>
                     </tr>
                     <?php } ?>

                  </table>
               </div>
            </div>
            <div class="col-sm-4">
               <form name="f_new_grupo" action="<?php echo $fsc->url();?>#grupos" method="post" class="form">
                  <div class="panel panel-info">
                     <div class="panel-heading">
                        <h3 class="panel-title">
                           <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>&nbsp; Nuevo grupo
                        </h3>
                     </div>
                     <div class="panel-body">
                        <div class="form-group">
                           Código:
                           <input class="form-control" type="text" name="codgrupo" placeholder="Codigo" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->grupo->get_new_codigo();?>" maxlength="6" autocomplete="off"/>
                        </div>
                        <div class="form-group">
                           Nombre:
                           <input class="form-control" type="text" name="nombre" placeholder="Nombre" onkeypress="teclear(event);return LetrasNumeros(event)" maxlength="50" placeholder="Nuevo grupo..." autocomplete="off"/>
                        </div>
                        <div class="form-group">
                           <a href="<?php echo $fsc->tarifa->url();?>">Tarifa</a>:
                           <select name="codtarifa" class="form-control">
                              <option value="---">Ninguna tarifa</option>
                              <?php $loop_var1=$fsc->tarifas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo $value1->codtarifa;?>"><?php echo $value1->nombre;?></option>
                              <?php } ?>

                           </select>
                        </div>
                     </div>
                     <div class="panel-footer">
                        <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Nuevo">
                           <span class="glyphicon glyphicon-plus-sign"></span>
                           <span class="hidden-sm">&nbsp;Nuevo</span>
                        </button>
                     </div>
                  </div>
               </form>
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

<form class="form-horizontal" role="form" name="f_nuevo_cliente" action="<?php echo $fsc->url();?>" method="post">
   <div class="modal" id="modal_nuevo_cliente">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-user"></span>
                  &nbsp; Nuevo cliente
               </h4>
               <p class="help-block">
                  Si quieres, puedes modificar las
                  <a href="index.php?page=ventas_clientes_opciones">opciones para nuevos clientes</a>.
               </p>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-10">
                     <input type="text" name="nombre" class="form-control" placeholder="Nombre" onkeypress="teclear(event);return texto(event)" autocomplete="off" required=""/>
                  </div>
               </div>
               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_cifnif_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label"><?php  echo FS_CIFNIF;?></label>
                  <div class="col-sm-3">
                     <select name="tipoidfiscal" class="form-control">
                        <?php $tiposid=$this->var['tiposid']=fs_tipos_id_fiscal();?>

                        <?php $loop_var1=$tiposid; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1;?>"><?php echo $value1;?></option>
                        <?php } ?>

                     </select>
                  </div>
                  <div class="col-sm-7">
                     <input type="text" name="cifnif" placeholder="Identificacion" class="form-control" id="ced" minlength="10" maxlength="13" onblur="validarc()" onkeypress="teclear(event);return numeros(event)" autocomplete="off"<?php if( $fsc->nuevocli_setup['nuevocli_cifnif_req'] ){ ?> required=""<?php } ?>/>
                     <label class="checkbox-inline">
                        <input type="checkbox" name="personafisica" value="TRUE" checked=""/> persona física (no empresa)
                     </label>
                  </div>
               </div>
               <?php if( $fsc->grupos ){ ?>

               <div class="form-group">
                  <label class="col-sm-2 control-label">Grupo</label>
                  <div class="col-sm-10">
                     <select name="scodgrupo" class="form-control">
                        <option value="">Ninguno</option>
                        <?php $loop_var1=$fsc->grupos; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codgrupo==$fsc->nuevocli_setup['nuevocli_codgrupo'] ){ ?>

                           <option value="<?php echo $value1->codgrupo;?>" selected=""><?php echo $value1->nombre;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codgrupo;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                     </select>
                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_telefono1'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_telefono1_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">Teléfono 1</label>
                  <div class="col-sm-10">
                     <input type="text" name="telefono1" class="form-control" placeholder="XXXXXXXXXX" minlength="10" maxlength="10" onkeypress="teclear(event);return numeros(event)" autocomplete="off"<?php if( $fsc->nuevocli_setup['nuevocli_telefono1_req'] ){ ?> required=""<?php } ?>/>
                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_telefono2'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_telefono2_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">Teléfono 2</label>
                  <div class="col-sm-10">
                     <input type="text" name="telefono2" class="form-control" placeholder="XXXXXXXXXX" minlength="10" maxlength="10" onkeypress="teclear(event);return numeros(event)" autocomplete="off"<?php if( $fsc->nuevocli_setup['nuevocli_telefono2_req'] ){ ?> required=""<?php } ?>/>
                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_email'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_email_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">E-Mail</label>
                  <div class="col-sm-10">
                     <input type="text" name="email" class="form-control" placeholder="Ejemplo@gmail.com" title="ejemplo@gmail.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" autocomplete="off"<?php if( $fsc->nuevocli_setup['nuevocli_email_req'] ){ ?> required=""<?php } ?>/>
                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_pais'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_pais_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">
                     <a href="<?php echo $fsc->pais->url();?>">País</a>
                  </label>
                  <div class="col-sm-10">
                     <select class="form-control" name="pais">
                     <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1->codpais;?>"<?php if( $value1->is_default() ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                     <?php } ?>

                     </select>
                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_provincia'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_provincia_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label text-capitalize"><?php  echo FS_PROVINCIA;?></label>
                  <div class="col-sm-10">
                     <?php if( $fsc->nuevocli_setup['nuevocli_provincia_req'] ){ ?>

                     <input type="text" name="provincia" id="ac_provincia" placeholder="Manabi" onkeypress="teclear(event);return LetrasNumeros(event)" class="form-control" autocomplete="off" required=""/>
                     <?php }else{ ?>

                     <input type="text" name="provincia" value="<?php echo $fsc->empresa->provincia;?>" placeholder="Manabi" onkeypress="teclear(event);return LetrasNumeros(event)" id="ac_provincia" class="form-control" autocomplete="off"/>
                     <?php } ?>

                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_ciudad'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_ciudad_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">Ciudad</label>
                  <div class="col-sm-10">
                     <?php if( $fsc->nuevocli_setup['nuevocli_ciudad_req'] ){ ?>

                     <input type="text" name="ciudad" placeholder="Manta" onkeypress="teclear(event);return LetrasNumeros(event)" class="form-control" required=""/>
                     <?php }else{ ?>

                     <input type="text" name="ciudad" placeholder="Manta" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->empresa->ciudad;?>" class="form-control"/>
                     <?php } ?>

                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_codpostal'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_codpostal_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">Cód. Postal</label>
                  <div class="col-sm-10">
                     <?php if( $fsc->nuevocli_setup['nuevocli_codpostal_req'] ){ ?>

                     <input type="text" name="codpostal" class="form-control" maxlength="10" autocomplete="off" readonly/>
                     <?php }else{ ?>

                     <input type="text" name="codpostal" class="form-control" maxlength="10" autocomplete="off" readonly/>
                     <?php } ?>

                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_direccion'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_direccion_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">Dirección</label>
                  <div class="col-sm-10">
                     <?php if( $fsc->nuevocli_setup['nuevocli_direccion_req'] ){ ?>

                     <input type="text" name="direccion" placeholder="Centro de Manta" onkeypress="teclear(event);return LetrasNumeros(event)" class="form-control" autocomplete="off" required=""/>
                     <?php }else{ ?>

                     <input type="text" name="direccion" placeholder="Centro de Manta" onkeypress="teclear(event);return LetrasNumeros(event)" class="form-control" autocomplete="off"/>
                     <?php } ?>

                  </div>
               </div>
               <?php } ?>

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
