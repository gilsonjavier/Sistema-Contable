<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function check(id) {
      if($("#"+id).is(":checked"))
      {
         $("#checked_"+id).prop("disabled",false);
         $("#checked_"+id).prop("checked",true);
      }
      else
      {
         $("#checked_"+id).prop("checked",false);
         $("#checked_"+id).prop("disabled",true);
      }
   };
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="btn-group">
            <a href="index.php?page=ventas_clientes" class="btn btn-sm btn-default">
               <span class="glyphicon glyphicon-arrow-left"></span>
               <span class="hidden-xs">&nbsp; Clientes</span>
            </a>
            <a href="<?php echo $fsc->url();?>" class="btn btn-sm btn-default" title="Recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
         </div>
         <div class="btn-group">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

         </div>
         <div class="page-header">
            <h1>
               <span class="glyphicon glyphicon-wrench"></span> Opciones para nuevos clientes
            </h1>
            <p class="help-block">
               Selecciona qué casillas quieres utilizar <b>en los formularios para nuevo cliente</b>
               y cuales de ellas quieres que sean imprescindibles para guardar.
            </p>
         </div>
      </div>
   </div>
   <form action="<?php echo $fsc->url();?>" method="post" class="form">
      <input type="hidden" name="setup" value="TRUE"/>
      <div class="row">
         <div class="col-sm-3">
            <div class="panel panel-default">
               <div class="panel-heading text-center"><?php  echo FS_CIFNIF;?></div>
               <div class="panel-body">
                  <div class="checkbox">
                     <label>
                        <input id="checked_cifnif" type="checkbox" name="nuevocli_cifnif_req" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_cifnif_req'] ){ ?> checked="checked"<?php } ?>/>
                        <?php  echo FS_CIFNIF;?> imprescindible
                     </label>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="panel panel-default">
               <div class="panel-heading text-center">Dirección</div>
               <div class="panel-body">
                  <div class="checkbox">
                     <label>
                        <input id="direccion" onclick="check(this.id)" type="checkbox" name="nuevocli_direccion" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_direccion'] ){ ?> checked="checked"<?php } ?>/>
                        Mostrar dirección
                     </label>
                  </div>
                  <div class="checkbox">
                     <label>
                        <input id="checked_direccion" type="checkbox" name="nuevocli_direccion_req" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_direccion_req'] ){ ?> checked="checked"<?php } ?><?php if( !$fsc->nuevocli_setup['nuevocli_direccion'] ){ ?> disabled<?php } ?>/>
                        Dirección imprescindible
                     </label>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="panel panel-default">
               <div class="panel-heading text-center">Código Postal</div>
               <div class="panel-body">
                  <div class="checkbox">
                     <label>
                        <input id="codpostal" onclick="check(this.id)" type="checkbox" name="nuevocli_codpostal" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_codpostal'] ){ ?> checked="checked"<?php } ?>/>
                        Mostrar código postal
                     </label>
                  </div>
                  <div class="checkbox">
                     <label>
                        <input id="checked_codpostal" type="checkbox" name="nuevocli_codpostal_req" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_codpostal_req'] ){ ?> checked="checked"<?php } ?><?php if( !$fsc->nuevocli_setup['nuevocli_codpostal'] ){ ?> disabled<?php } ?>/>
                        Código postal imprescindible
                     </label>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="panel panel-default">
               <div class="panel-heading text-center">País</div>
               <div class="panel-body">
                  <div class="checkbox">
                     <label>
                        <input id="pais" onclick="check(this.id)" type="checkbox" name="nuevocli_pais" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_pais'] ){ ?> checked="checked"<?php } ?>/>
                        Mostrar país
                     </label>
                  </div>
                  <div class="checkbox">
                     <label>
                        <input id="checked_pais" type="checkbox" name="nuevocli_pais_req" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_pais_req'] ){ ?> checked="checked"<?php } ?><?php if( !$fsc->nuevocli_setup['nuevocli_pais'] ){ ?> disabled<?php } ?>/>
                        País imprescindible
                     </label>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-3">
            <div class="panel panel-default">
               <div class="panel-heading text-center">Ciudad</div>
               <div class="panel-body">
                  <div class="checkbox">
                     <label>
                        <input id="ciudad" onclick="check(this.id)" type="checkbox" name="nuevocli_ciudad" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_ciudad'] ){ ?> checked="checked"<?php } ?>/>
                        Mostrar ciudad
                     </label>
                  </div>
                  <div class="checkbox">
                     <label>
                        <input id="checked_ciudad" type="checkbox" name="nuevocli_ciudad_req" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_ciudad_req'] ){ ?> checked="checked"<?php } ?><?php if( !$fsc->nuevocli_setup['nuevocli_ciudad'] ){ ?> disabled<?php } ?>/>
                        Ciudad imprescindible
                     </label>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="panel panel-default">
               <div class="panel-heading text-center text-capitalize"><?php  echo FS_PROVINCIA;?></div>
               <div class="panel-body">
                  <div class="checkbox">
                     <label>
                        <input id="provincia" onclick="check(this.id)" type="checkbox" name="nuevocli_provincia" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_provincia'] ){ ?> checked="checked"<?php } ?>/>
                        Mostrar <?php  echo FS_PROVINCIA;?>

                     </label>
                  </div>
                  <div class="checkbox">
                     <label>
                        <input id="checked_provincia" type="checkbox" name="nuevocli_provincia_req" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_provincia_req'] ){ ?> checked="checked"<?php } ?><?php if( !$fsc->nuevocli_setup['nuevocli_provincia'] ){ ?> disabled<?php } ?>/>
                        <?php  echo FS_PROVINCIA;?> imprescindible
                     </label>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="panel panel-default">
               <div class="panel-heading text-center">Teléfono 1</div>
               <div class="panel-body">
                  <div class="checkbox">
                     <label>
                        <input id="telefono1" onclick="check(this.id)" type="checkbox" name="nuevocli_telefono1" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_telefono1'] ){ ?> checked="checked"<?php } ?>/>
                        Mostra teléfono 1
                     </label>
                  </div>
                  <div class="checkbox">
                     <label>
                        <input id="checked_telefono1" type="checkbox" name="nuevocli_telefono1_req" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_telefono1_req'] ){ ?> checked="checked"<?php } ?><?php if( !$fsc->nuevocli_setup['nuevocli_telefono1'] ){ ?> disabled<?php } ?>/>
                        Teléfono 1 imprescindible
                     </label>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="panel panel-default">
               <div class="panel-heading text-center">Teléfono 2</div>
               <div class="panel-body">
                  <div class="checkbox">
                     <label>
                        <input id="telefono2" onclick="check(this.id)" type="checkbox" name="nuevocli_telefono2" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_telefono2'] ){ ?> checked="checked"<?php } ?>/>
                        Mostrar teléfono 2
                     </label>
                  </div>
                  <div class="checkbox">
                     <label>
                        <input id="checked_telefono2" type="checkbox" name="nuevocli_telefono2_req" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_telefono2_req'] ){ ?> checked="checked"<?php } ?><?php if( !$fsc->nuevocli_setup['nuevocli_telefono2'] ){ ?> disabled<?php } ?>/>
                        Teléfono 2 imprescindible
                     </label>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-3">
            <div class="panel panel-default">
               <div class="panel-heading text-center">Grupo</div>
               <div class="panel-body">
                  <p class="help-block">Elige el grupo predeterminado.</p>
                  <select name="nuevocli_codgrupo" class="form-control">
                     <option value="">Ninguno</option>
                     <option value="">------</option>
                     <?php $loop_var1=$fsc->grupo->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->codgrupo==$fsc->nuevocli_setup['nuevocli_codgrupo'] ){ ?>

                        <option value="<?php echo $value1->codgrupo;?>" selected=""><?php echo $value1->nombre;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->codgrupo;?>"><?php echo $value1->nombre;?></option>
                        <?php } ?>

                     <?php } ?>

                  </select>
               </div>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="panel panel-default">
               <div class="panel-heading text-center">E-mail</div>
               <div class="panel-body">
                  <div class="checkbox">
                     <label>
                        <input id="email" onclick="check(this.id)" type="checkbox" name="nuevocli_email" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_email'] ){ ?> checked="checked"<?php } ?>/>
                        Mostrar E-mail
                     </label>
                  </div>
                  <div class="checkbox">
                     <label>
                        <input id="checked_email" type="checkbox" name="nuevocli_email_req" value="TRUE"<?php if( $fsc->nuevocli_setup['nuevocli_email_req'] ){ ?> checked="checked"<?php } ?><?php if( !$fsc->nuevocli_setup['nuevocli_email'] ){ ?> disabled<?php } ?>/>
                        Email imprescindible
                     </label>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-9 text-right">
            <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true; this.form.submit();">
               <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
            </button>
         </div>
      </div>
   </form>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>