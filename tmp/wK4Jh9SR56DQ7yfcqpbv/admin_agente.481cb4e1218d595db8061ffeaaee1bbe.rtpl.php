<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->agente ){ ?>

<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript">
   $(document).ready(function () {
      $("#b_delete_agente").click(function (event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Realmente desea eliminar el agente?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = '<?php echo $fsc->ppage->url();?>&delete=<?php echo $fsc->agente->codagente;?>';
               }
            }
         });
      });
   });
</script>

<div class="container-fluid">
   <div class="row" style="margin-bottom: 10px;">
      <div class="col-xs-3">
         <div class="btn-group">
            <a class="btn btn-sm btn-default" href="index.php?page=admin_agentes">
               <span class="glyphicon glyphicon-arrow-left"></span>
               <span class="hidden-xs hidden-sm">&nbsp; Empleados</span>
            </a>
            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
         </div>
      </div>
      <div class="col-xs-6 text-center">
         <h2 style="margin-top: 0px;">
            Editar empleado <small><?php echo $fsc->agente->codagente;?></small>
         </h2>
      </div>
      <div class="col-xs-3 text-right">
         <a class="btn btn-sm btn-success" href="index.php?page=admin_agentes#nuevo" title="Nuevo empleado">
            <span class="glyphicon glyphicon-plus"></span>
         </a>
         <?php if( $fsc->allow_delete ){ ?>

         <a href="#" id="b_delete_agente" class="btn btn-sm btn-danger">
            <span class="glyphicon glyphicon-trash"></span>
            <span class="hidden-xs hidden-sm">&nbsp;Eliminar</span>
         </a>
         <?php } ?>

      </div>
   </div>
   <div class="row">
      <div class="col-sm-3 col-lg-2">
         <ul class="nav nav-pills nav-stacked" role="tablist">
            <li role="presentation" class="active">
               <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                  <span class="glyphicon glyphicon-dashboard"></span> &nbsp; Datos generales
               </a>
            </li>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <li>
                  <a id="b_<?php echo $value1->from;?>" href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&codagente=<?php echo $fsc->agente->codagente;?>">
                     <?php echo $value1->text;?>

                  </a>
               </li>
               <?php }elseif( $value1->type=='tab' ){ ?>

               <li role="presentation">
                  <a href="#ext_<?php echo $key1;?>" aria-controls="ext_<?php echo $key1;?>" role="tab" data-toggle="tab">
                     <?php echo $value1->text;?>

                  </a>
               </li>
               <?php } ?>

            <?php } ?>

         </ul>
      </div>
      <div class="col-sm-9 col-lg-10">
         <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="general">
               <form class="form" role="form" action="<?php echo $fsc->url();?>" method="post">
                  <div class='panel <?php if( $fsc->agente->f_baja ){ ?>panel-danger<?php }else{ ?>panel-primary<?php } ?>' id='panel_generales'>
                     <div class="panel-heading">
                        <h3 class="panel-title">
                           <?php echo $fsc->agente->get_fullname();?>

                           <?php if( $fsc->agente->f_baja ){ ?>

                           &nbsp; <span class="label label-default" title="El empleado ha sido dado de baja">Baja</span>
                           <?php } ?>

                        </h3>
                     </div>
                     <div class="panel-body">
                        <div class="col-sm-3">
                           <div class="form-group">
                              Nombre:
                              <input class="form-control" type="text" name="nombre" placeholder="Nombres" onkeypress="teclear(event);return numeros(event)" value="<?php echo $fsc->agente->nombre;?>" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-5">
                           <div class="form-group">
                              Apellidos:
                              <input class="form-control" type="text" name="apellidos" placeholder="Apellidos" onkeypress="teclear(event);return numeros(event)" value="<?php echo $fsc->agente->apellidos;?>" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group">
                              <?php  echo FS_CIFNIF;?>:
                              <input class="form-control" type="text" name="dnicif" placeholder="XXXXXXXXXX" onkeypress="teclear(event);return numeros(event)" value="<?php echo $fsc->agente->dnicif;?>" autocomplete="off" readonly/>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group">
                              Teléfono:
                              <input class="form-control" type="text" name="telefono" placeholder="XXXXXXXXXX" value="<?php echo $fsc->agente->telefono;?>" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              Email:
                              <?php if( FS_DEMO ){ ?>

                              <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off"/>
                              <?php }else{ ?>

                              <input class="form-control" type="text" placeholder="Email" name="email" value="<?php echo $fsc->agente->email;?>" autocomplete="off"/>
                              <?php } ?>

                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              Cargo ocupado:
                              <input class="form-control" type="text" name="cargo" placeholder="Cargo..." value="<?php echo $fsc->agente->cargo;?>" onkeypress="teclear(event);return LetrasNumeros(event)" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              Provincia:
                              <input id="ac_provincia" class="form-control" type="text" placeholder="Manabi" onkeypress="teclear(event);return LetrasNumeros(event)" name="provincia" value="<?php echo $fsc->agente->provincia;?>" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              Ciudad:
                              <input class="form-control" type="text" name="ciudad" placeholder="Manta" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->agente->ciudad;?>"/>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              Dirección:
                              <input class="form-control" type="text" name="direccion" placeholder="Centro de manta" onkeypress="teclear(event)" value="<?php echo $fsc->agente->direccion;?>" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              Cod. Postal:
                              <input class="form-control" type="text" name="codpostal" value="<?php echo $fsc->agente->codpostal;?>" maxlength="10" autocomplete="off" readonly/>
                           </div>
                        </div>
                        
                        <div class="col-sm-4">
                           <div class="form-group">
                              Fecha Nacimiento:
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                                 <input class="form-control datepicker" type="text" name="f_nacimiento" value="<?php echo $fsc->agente->f_nacimiento;?>" autocomplete="off"/>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              Fecha Alta:
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                                 <input class="form-control datepicker" type="text" name="f_alta" value="<?php echo $fsc->agente->f_alta;?>" autocomplete="off"/>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-4 bg-warning">
                           <div class="form-group">
                              Fecha Baja:
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                                 <input class="form-control datepicker" type="text" name="f_baja" value="<?php echo $fsc->agente->f_baja;?>" autocomplete="off"/>
                              </div>
                           </div>
                        </div>
                        <!--
                        <div class="col-sm-5">
                           <div class="form-group">
                              Nº Seguridad Social:
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                 </span>
                                 <input class="form-control" type="text" name="seg_social" value="<?php echo $fsc->agente->seg_social;?>" autocomplete="off" readonly/>
                              </div>
                           </div>
                        </div>-->
                        <div class="col-sm-5">
                           <div class="form-group">
                              Cuenta Bancaria:
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-credit-card"></span>
                                 </span>
                                 <input class="form-control" type="text" name="banco" value="<?php echo $fsc->agente->banco;?>" autocomplete="off" readonly/>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group">
                              Comisión:
                              <div class="input-group">
                                 <span class="input-group-addon">%</span>
                                 <input class="form-control" type="text" name="porcomision" value="<?php echo $fsc->agente->porcomision;?>" autocomplete="off" readonly/>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="panel-footer" style="text-align: right;">
                        <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled = true; this.form.submit();">
                           <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                        </button>
                     </div>
                  </div>
               </form>
            </div>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='tab' ){ ?>

               <div role="tabpanel" class="tab-pane" id="ext_<?php echo $key1;?>">
                  <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&cod=<?php echo $fsc->agente->codagente;?>" width="100%" height="2000" frameborder="0"></iframe>
               </div>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
   </div>
</div>
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