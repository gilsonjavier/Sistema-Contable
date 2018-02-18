<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->proveedor ){ ?>

<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript">
   function comprobar_url()
   {
      if(window.location.hash.substring(1) == 'cuentasb')
      {
         $('#tabs_proveedor a[href="#cuentasb"]').tab('show');
      }
      else if(window.location.hash.substring(1) == 'direcciones')
      {
         $('#tabs_proveedor a[href="#direcciones"]').tab('show');
      }
      else if(window.location.hash.substring(1) == 'subcuentas')
      {
         $('#tabs_proveedor a[href="#subcuentas"]').tab('show');
      }
      else if(window.location.hash.substring(1) == 'stats')
      {
         $('#tabs_proveedor a[href="#stats"]').tab('show');
      }
   }
   function delete_cuenta(id)
   {
      bootbox.confirm({
         message: '¿Realmente desea eliminar la cuenta bancaria #'+id+'?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = '<?php echo $fsc->url();?>&delete_cuenta='+id+'#cuentasb';
            }
         }
      });
   }
   function acreedores_help()
   {
      bootbox.alert({
         message: 'Los acreedores son todos aquellos proveedores a los que no les compramos mercancias. Por ejemplo: proveedor de internet, teléfono, bancos...',
         title: "<b>Atención</b>"
      });
      return false;
   }
   $(document).ready(function() {
      comprobar_url();
      $("#b_eliminar").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Realmente desea eliminar este proveedor?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = '<?php echo $fsc->ppage->url();?>&delete=<?php echo $fsc->proveedor->codproveedor;?>';
               }
            }
         });
      });
      $("#b_nueva_cuenta").click(function(event) {
         event.preventDefault();
         $("#modal_nueva_cuenta").modal('show');
         document.f_nueva_cuenta.descripcion.focus();
      });
      $("#b_nueva_direccion").click(function(event) {
         event.preventDefault();
         $("#modal_nueva_direccion").modal('show');
         document.f_nueva_direccion.provincia.focus();
      });
   });
</script>

<div class="container-fluid">
   <div class="row" style="margin-bottom: 10px;">
      <div class="col-xs-3">
         <div class="btn-group">
            <a href="<?php echo $fsc->ppage->url();?>" class="btn btn-sm btn-default">
               <span class="glyphicon glyphicon-arrow-left"></span>
               <span class="hidden-xs hidden-sm">&nbsp; Proveedores</span>
            </a>
            <a href="<?php echo $fsc->url();?>" class="btn btn-sm btn-default" title="Recarga la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
         </div>
      </div>
      <div class="col-xs-6 text-center">
         <h2 style="margin-top: 0px;">
            Editar proveedor <small><?php echo $fsc->proveedor->codproveedor;?></small>
         </h2>
      </div>
      <div class="col-xs-3 text-right">
         <a class="btn btn-sm btn-success" href="index.php?page=compras_proveedores#nuevo" title="Nuevo proveedor">
            <span class="glyphicon glyphicon-plus"></span>
         </a>
         <?php if( $fsc->allow_delete ){ ?>

         <div class="btn-group">
            <?php if( $fsc->proveedor->debaja ){ ?>

            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_debaja">
               <span class="glyphicon glyphicon-lock"></span>
               <span class="hidden-xs">&nbsp;De baja</span>
            </a>
            <?php }elseif( $fsc->tiene_facturas() ){ ?>

            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal_debaja">
               <span class="glyphicon glyphicon-lock"></span>
               <span class="hidden-xs">&nbsp;Dar de baja</span>
            </a>
            <?php }else{ ?>

            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal_debaja">
                <span class="glyphicon glyphicon-lock"></span>
                <span class="hidden-xs">&nbsp;Dar de baja</span>
            </a>
            <a href="#" id="b_eliminar" class="btn btn-sm btn-danger">
               <span class="glyphicon glyphicon-trash"></span>
               <span class="hidden-xs hidden-sm">&nbsp;Eliminar</span>
            </a>
            <?php } ?>

         </div>
         <?php } ?>

      </div>
   </div>
   <div class="row">
      <div class="col-sm-3 col-lg-2">
         <ul id="tabs_proveedor" class="nav nav-pills nav-stacked" role="tablist">
            <li role="presentation" class="active">
               <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                  <span class="glyphicon glyphicon-dashboard"></span> &nbsp; Datos generales
               </a>
            </li>
            <!--<li role="presentation">
               <a href="#cuentasb" aria-controls="cuentasb" role="tab" data-toggle="tab">
                  <span class="glyphicon glyphicon-credit-card"></span> &nbsp; Cuentas bancarias
               </a>
            </li>-->
            <li role="presentation">
               <a href="#direcciones" aria-controls="direcciones" role="tab" data-toggle="tab">
                  <span class="glyphicon glyphicon-road"></span> &nbsp; Direcciones
               </a>
            </li>
            <!--<li role="presentation">
               <a href="#subcuentas" aria-controls="subcuentas" role="tab" data-toggle="tab">
                  <span class="glyphicon glyphicon-book"></span> &nbsp; Subcuentas
               </a>
            </li>-->
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <li>
                  <a id="b_<?php echo $value1->from;?>" href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&codproveedor=<?php echo $fsc->proveedor->codproveedor;?>">
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

            <li role="presentation">
               <a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">
                  <i class="fa fa-area-chart" aria-hidden="true"></i>&nbsp; Estadísticas
               </a>
            </li>
         </ul>
      </div>
      <div class="col-sm-9 col-lg-10">
         <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="general">
               <form name="f_proveedor" action="<?php echo $fsc->url();?>" method="post" class="form">
                  <input type="hidden" name="codproveedor" value="<?php echo $fsc->proveedor->codproveedor;?>"/>
                  <div class='panel <?php if( $fsc->proveedor->debaja ){ ?>panel-danger<?php }else{ ?>panel-primary<?php } ?>'>
                     <div class="panel-heading">
                        <h3 class="panel-title">Datos generales</h3>
                     </div>
                     <div class="panel-body">
                        <div class="row">
                           <div class="col-sm-4">
                              <div class="form-group">
                                 Nombre:
                                 <input class="form-control" type="text" name="nombre" placeholder="Luis Velez" onkeypress="teclear(event);return texto(event)" value="<?php echo $fsc->proveedor->nombre;?>" autocomplete="off"/>
                                 <p class="help-block">Nombre por el que se conoce al proveedor. Para uso interno.</p>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 Razón social:
                                 <input class="form-control" type="text" name="razonsocial" placeholder="Luis Velez Velez" onkeypress="teclear(event);return texto(event)" value="<?php echo $fsc->proveedor->razonsocial;?>" autocomplete="off"/>
                                 <p class="help-block">Nombre oficial del proveedor, para las facturas y otros documentos.</p>
                              </div>
                           </div><!--
                           <div class="col-sm-2">
                              <div class="form-group">
                                 <br/>
                                 <select name="tipoidfiscal" class="form-control">
                                 <?php $tiposids=$this->var['tiposids']=fs_tipos_id_fiscal();?>

                                 <?php $loop_var1=$tiposids; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <?php if( $value1==$fsc->proveedor->tipoidfiscal ){ ?>

                                    <option value="<?php echo $value1;?>" selected=""><?php echo $value1;?></option>
                                    <?php }else{ ?>

                                    <option value="<?php echo $value1;?>"><?php echo $value1;?></option>
                                    <?php } ?>

                                 <?php } ?>

                                 </select>
                              </div>
                           </div>-->
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <?php  echo FS_CIFNIF;?>:
                                 <input class="form-control" type="text" name="cifnif" value="<?php echo $fsc->proveedor->cifnif;?>" maxlength="15" autocomplete="off" readonly/>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label class="checkbox-inline">
                                    <?php if( $fsc->proveedor->personafisica ){ ?>

                                    <input type="checkbox" name="personafisica" value="TRUE" checked=""/>
                                    <?php }else{ ?>

                                    <input type="checkbox" name="personafisica" value="TRUE"/>
                                    <?php } ?>

                                    Persona física (no empresa)
                                 </label>
                              </div>
                           </div>
                           <div class="col-sm-5">
                              <div class="form-group">
                                 <label class="checkbox-inline">
                                    <?php if( $fsc->proveedor->acreedor ){ ?>

                                    <input type="checkbox" name="acreedor" value="TRUE" checked=""/>
                                    <?php }else{ ?>

                                    <input type="checkbox" name="acreedor" value="TRUE"/>
                                    <?php } ?>

                                    Acreedor
                                    <a href="#" onclick="return acreedores_help()">
                                       <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-2">
                              <div class="form-group">
                                 Teléfono 1:
                                 <input class="form-control" type="text" name="telefono1" placeholder="XXXXXXXXXX" onkeypress="return numeros(event)" value="<?php echo $fsc->proveedor->telefono1;?>" autocomplete="off"/>
                              </div>
                           </div>
                           <div class="col-sm-2">
                              <div class="form-group">
                                 Teléfono 2:
                                 <input class="form-control" type="text" name="telefono2" placeholder="XXXXXXXXXX" onkeypress="return numeros(event)" value="<?php echo $fsc->proveedor->telefono2;?>" autocomplete="off"/>
                              </div>
                           </div>
                           <div class="col-sm-2">
                              <div class="form-group">
                                 Fax:
                                 <input class="form-control" type="text" name="fax" placeholder="Fax" value="<?php echo $fsc->proveedor->fax;?>" autocomplete="off"/>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 Email:
                                 <input class="form-control" type="text" name="email" placeholder="ejemplo@gmail.com" title="ejemplo@gmail.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" value="<?php echo $fsc->proveedor->email;?>" autocomplete="off"/>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 Web:
                                 <input class="form-control" type="text" name="web" value="<?php echo $fsc->proveedor->web;?>" autocomplete="off"/>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <a href="<?php echo $fsc->serie->url();?>" class="text-capitalize"><?php  echo FS_SERIE;?></a>:
                                 <select class="form-control" name="codserie">
                                    <option value="">Predeterminada</option>
                                    <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                       <?php if( $value1->codserie==$fsc->proveedor->codserie ){ ?>

                                       <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                                       <?php }else{ ?>

                                       <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                                       <?php } ?>

                                    <?php } ?>

                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
                                 <select class="form-control" name="codpago">
                                 <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <?php if( $value1->codpago==$fsc->proveedor->codpago ){ ?>

                                    <option value="<?php echo $value1->codpago;?>" selected=""><?php echo $value1->descripcion;?></option>
                                    <?php }else{ ?>

                                    <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
                                    <?php } ?>

                                 <?php } ?>

                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <a href="<?php echo $fsc->divisa->url();?>">Divisa</a>:
                                 <select class="form-control" name="coddivisa">
                                 <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <?php if( $value1->coddivisa==$fsc->proveedor->coddivisa ){ ?>

                                    <option value="<?php echo $value1->coddivisa;?>" selected=""><?php echo $value1->descripcion;?></option>
                                    <?php }else{ ?>

                                    <option value="<?php echo $value1->coddivisa;?>"><?php echo $value1->descripcion;?></option>
                                    <?php } ?>

                                 <?php } ?>

                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 Régimen <?php  echo FS_IVA;?>:
                                 <select class="form-control" name="regimeniva">
                                 <?php $loop_var1=$fsc->proveedor->regimenes_iva(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <?php if( $value1==$fsc->proveedor->regimeniva ){ ?>

                                    <option value="<?php echo $value1;?>" selected=""><?php echo $value1;?></option>
                                    <?php }else{ ?>

                                    <option value="<?php echo $value1;?>"><?php echo $value1;?></option>
                                    <?php } ?>

                                 <?php } ?>

                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                              Observaciones:
                              <textarea class="form-control" placeholder="Observaciones..." onkeypress="teclear(event)" name="observaciones" rows="3"><?php echo $fsc->proveedor->observaciones;?></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="panel-footer text-right">
                        <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                           <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                        </button>
                     </div>
                  </div>
                  <?php if( $fsc->proveedor->codcliente ){ ?>

                  <div class="panel panel-success">
                     <div class="panel-heading">
                        <h3 class="panel-title">Este proveedor también es cliente</h3>
                     </div>
                     <div class="panel-body">
                        <a href="index.php?page=ventas_cliente&cod=<?php echo $fsc->proveedor->codcliente;?>" class="btn btn-sm btn-default">
                           <span class="glyphicon glyphicon-user"></span>&nbsp; ver cliente
                        </a>
                     </div>
                  </div>
                  <?php }else{ ?>

                  <div class="panel panel-warning">
                     <div class="panel-heading">
                        <h3 class="panel-title">Convertir <b>también</b> en cliente</h3>
                     </div>
                     <div class="panel-body">
                        <p class="help-block">
                           Si lo deseas puedes convertir a este proveedor también en cliente,
                           para poder venderle productos y servicios.
                        </p>
                     </div>
                     <div class="panel-footer">
                        <a href="<?php echo $fsc->proveedor->url();?>&convertir=TRUE" class="btn btn-sm btn-warning">
                           <span class="glyphicon glyphicon-random"></span>&nbsp; Convertir
                        </a>
                     </div>
                  </div>
                  <?php } ?>

                  
                  <div class="modal fade" id="modal_debaja" tabindex="-1" role="dialog">
                     <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                              <?php if( $fsc->proveedor->debaja ){ ?>

                              <h4 class="modal-title">
                                 <span class="glyphicon glyphicon-lock"></span>
                                 &nbsp; Este proveedor ha sido dado de baja
                              </h4>
                              <p class="help-block">Concretamente el día <?php echo $fsc->proveedor->fechabaja;?></p>
                              <?php }else{ ?>

                              <h4 class="modal-title">
                                 <span class="glyphicon glyphicon-lock"></span>
                                 &nbsp; ¿Deseas dar de baja al proveedor?
                              </h4>
                              <p class="help-block">
                                 Este proveedor ya tiene facturas o <?php  echo FS_ALBARANES;?> relacionados,
                                 por lo que no es recomendable eliminarlo.
                              </p>
                              <?php } ?>

                           </div>
                           <div class="modal-body">
                              <div class="form-group">
                                 <label class="checkbox-inline">
                                    <?php if( $fsc->proveedor->debaja ){ ?>

                                    <input type="checkbox" name="debaja" value="TRUE" checked=""/>
                                    <?php }else{ ?>

                                    <input type="checkbox" name="debaja" value="TRUE"/>
                                    <?php } ?>

                                    Dar de baja al proveedor.
                                 </label>
                                 <p class="help-block">
                                    Desaparecerá de las búsquedas en facturas, <?php  echo FS_ALBARANES;?>, etc.
                                    Pero seguirá en el listado de proveedores por si cambias de idea.
                                 </p>
                              </div>
                              <div class="text-right">
                                 <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="cuentasb">
               <?php $loop_var1=$fsc->cuenta_banco->all_from_proveedor($fsc->proveedor->codproveedor); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <form action="<?php echo $fsc->url();?>#cuentasb" method="post" class="form">
                  <input type="hidden" name="codcuenta" value="<?php echo $value1->codcuenta;?>"/>
                  <input type="hidden" name="codproveedor" value="<?php echo $value1->codproveedor;?>"/>
                  <div class='panel <?php if( $value1->principal ){ ?>panel-primary<?php }else{ ?>panel-default<?php } ?>'>
                     <div class="panel-heading">
                        <h3 class="panel-title">Cuenta bancaria #<?php echo $value1->codcuenta;?></h3>
                     </div>
                     <div class="panel-body">
                        <div class="row">
                           <div class="col-sm-5">
                              <div class="form-group">
                                 <input class="form-control" type="text" name="descripcion" value="<?php echo $value1->descripcion;?>" placeholder="Cuenta principal" autocomplete="off"/>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="checkbox-inline">
                                    <?php if( $value1->principal ){ ?>

                                    <input type="checkbox" name="principal" value="TRUE" checked=""/>
                                    <?php }else{ ?>

                                    <input type="checkbox" name="principal" value="TRUE"/>
                                    <?php } ?>

                                    Cuenta principal
                                 </label>
                              </div>
                           </div>
                           <div class="col-sm-4 text-right">
                              <div class="btn-group">
                                 <a class="btn btn-sm btn-danger" onclick="delete_cuenta('<?php echo $value1->codcuenta;?>');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    <span class="hidden-xs hidden-sm">&nbsp; Eliminar</span>
                                 </a>
                                 <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>
                                    <span class="hidden-xs">&nbsp; Guardar</span>
                                 </button>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <a target="_blank" href="http://es.wikipedia.org/wiki/International_Bank_Account_Number">IBAN</a>:
                                 <input class="form-control" type="text" name="iban" value="<?php echo $value1->iban;?>" maxlength="34" placeholder="ES12345678901234567890123456" autocomplete="off"/>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <a target="_blank" href="http://es.wikipedia.org/wiki/Society_for_Worldwide_Interbank_Financial_Telecommunication">SWIFT</a> o BIC:
                                 <input class="form-control" type="text" name="swift" value="<?php echo $value1->swift;?>" maxlength="11" autocomplete="off"/>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
               <?php } ?>

               <div class="panel panel-success">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <a id="b_nueva_cuenta" href="#">
                           <span class="glyphicon glyphicon-plus-sign"></span>
                           &nbsp; Nueva cuenta bancaria...
                        </a>
                     </h3>
                  </div>
               </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="direcciones">
               <?php $loop_var1=$fsc->proveedor->get_direcciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <form action="<?php echo $fsc->url();?>#direcciones" method="post" class="form">
                  <input type="hidden" name="codproveedor" value="<?php echo $fsc->proveedor->codproveedor;?>"/>
                  <input type="hidden" name="coddir" value="<?php echo $value1->id;?>"/>
                  <div class='panel <?php if( $value1->direccionppal ){ ?>panel-primary<?php }else{ ?>panel-default<?php } ?>'>
                     <div class="panel-heading">
                        <h3 class="panel-title">
                           <span class="glyphicon glyphicon-road"></span>&nbsp; <?php echo $value1->id;?> &nbsp; | &nbsp;
                           <span class="glyphicon glyphicon-calendar"></span>&nbsp; <?php echo $value1->fecha;?>

                        </h3>
                     </div>
                     <div class="panel-body">
                        <div class="col-sm-3">
                           <div class="form-group">
                              <a href="<?php echo $fsc->pais->url();?>">País</a>
                              <select class="form-control" name="pais">
                                 <?php $loop_var2=$fsc->pais->all(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                                    <?php if( $value1->codpais==$value2->codpais ){ ?>

                                    <option value="<?php echo $value2->codpais;?>" selected=""><?php echo $value2->nombre;?></option>
                                    <?php }else{ ?>

                                    <option value="<?php echo $value2->codpais;?>"><?php echo $value2->nombre;?></option>
                                    <?php } ?>

                                 <?php } ?>

                              </select>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              <span class="text-capitalize"><?php  echo FS_PROVINCIA;?></span>:
                              <input type="text" name="provincia" value="<?php echo $value1->provincia;?>" placeholder="Manabi" onkeypress="teclear(event);return LetrasNumeros(event)" id="ac_provincia" class="form-control"/>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              Ciudad:
                              <input class="form-control" type="text" name="ciudad" placeholder="Manta" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $value1->ciudad;?>"/>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              Código Postal:
                              <input class="form-control" type="text" name="codpostal" value="<?php echo $value1->codpostal;?>" maxlength="10" autocomplete="off" readonly/>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              Dirección:
                              <input class="form-control" type="text" name="direccion" placeholder="Centro de Manta" onkeypress="teclear(event)" value="<?php echo $value1->direccion;?>" autocomplete="off"/>
                              <label class="checkbox-inline">
                                 <?php if( $value1->direccionppal ){ ?>

                                 <input type="checkbox" name="direccionppal" value="TRUE" checked=""/>
                                 <?php }else{ ?>

                                 <input type="checkbox" name="direccionppal" value="TRUE"/>
                                 <?php } ?>

                                 Dirección principal
                              </label>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              <span class="text-capitalize"><?php  echo FS_APARTADO;?></span>:
                              <input class="form-control" type="text" name="apartado" value="<?php echo $value1->apartado;?>" maxlength="10" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              Descripción:
                              <input class="form-control" type="text" name="descripcion" placeholder="Descripcion..." onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $value1->descripcion;?>" autocomplete="off"/>
                           </div>
                        </div>
                     </div>
                     <div class="panel-footer text-right">
                        <a class="btn btn-sm btn-danger pull-left" href="<?php echo $fsc->url();?>&delete_dir=<?php echo $value1->id;?>#direcciones">
                           <span class="glyphicon glyphicon-trash"></span>
                           <span class='hidden-xs'>&nbsp; Eliminar</span>
                        </a>
                        <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                           <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                        </button>
                     </div>
                  </div>
               </form>
               <?php } ?>

               <div class="panel panel-success">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <a id="b_nueva_direccion" href="#">
                           <span class="glyphicon glyphicon-plus-sign"></span>
                           &nbsp; Nueva dirección...
                        </a>
                     </h3>
                  </div>
               </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="subcuentas">
               <div class="table-responsive">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th class="text-left">Ejercicio</th>
                           <th width="60"></th>
                           <th class="text-left">Subcuenta + Descripción</th>
                           <th class="text-right">Debe</th>
                           <th class="text-right">Haber</th>
                           <th class="text-right">Saldo</th>
                        </tr>
                     </thead>
                     <?php $loop_var1=$fsc->proveedor->get_subcuentas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <tr>
                        <td><div class="form-control"><?php echo $value1->codejercicio;?></div></td>
                        <td class="text-right">
                           <a class="btn btn-sm btn-default" href="index.php?page=subcuenta_asociada&pro=<?php echo $fsc->proveedor->codproveedor;?>&idsc=<?php echo $value1->idsubcuenta;?>">
                              <span class="glyphicon glyphicon-wrench"></span>
                           </a>
                        </td>
                        <td>
                           <div class="form-control">
                              <a href="<?php echo $value1->url();?>"><?php echo $value1->codsubcuenta;?></a> <?php echo $value1->descripcion;?>

                           </div>
                        </td>
                        <td>
                           <div class="form-control text-right"><?php echo $fsc->show_precio($value1->debe, $value1->coddivisa);?></div>
                        </td>
                        <td>
                           <div class="form-control text-right"><?php echo $fsc->show_precio($value1->haber, $value1->coddivisa);?></div>
                        </td>
                        <td>
                           <div class="form-control text-right"><?php echo $fsc->show_precio($value1->saldo, $value1->coddivisa);?></div>
                        </td>
                     </tr>
                     <?php } ?>

                     <tr>
                        <td colspan="6" class="text-center">
                           <a class="btn btn-sm btn-block btn-success" href="index.php?page=subcuenta_asociada&pro=<?php echo $fsc->proveedor->codproveedor;?>">
                              Asignar una nueva subcuenta...
                           </a>
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='tab' ){ ?>

               <div role="tabpanel" class="tab-pane" id="ext_<?php echo $key1;?>">
                  <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&cod=<?php echo $fsc->proveedor->codproveedor;?>" width="100%" height="2000" frameborder="0"></iframe>
               </div>
               <?php } ?>

            <?php } ?>

            <div role="tabpanel" class="tab-pane" id="stats">
               <div class="panel panel-primary">
                  <div class="panel-heading">
                     <h3 class="panel-title">Estadísticas</h3>
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-sm-2">
                           <a target="_blank" href="index.php?page=informe_facturas&codproveedor=<?php echo $fsc->proveedor->codproveedor;?>&codcliente=<?php echo $fsc->proveedor->codcliente;?>" class="btn btn-sm btn-block btn-default">
                              <i class="fa fa-area-chart" aria-hidden="true"></i> facturas
                           </a>
                        </div>
                        <div class="col-sm-2">
                           <a target="_blank" href="index.php?page=informe_albaranes&codproveedor=<?php echo $fsc->proveedor->codproveedor;?>&codcliente=<?php echo $fsc->proveedor->codcliente;?>" class="btn btn-sm btn-block btn-default">
                              <i class="fa fa-area-chart" aria-hidden="true"></i> <?php  echo FS_ALBARANES;?>

                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="panel-footer">
                     <p class="help-block">
                        Hemos rediseñado los informes para hacerlos más potentes, con muchos
                        más filtros.
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<form name="f_nueva_cuenta" action="<?php echo $fsc->url();?>#cuentasb" method="post" class="form">
   <input type="hidden" name="codproveedor" value="<?php echo $fsc->proveedor->codproveedor;?>"/>
   <div class="modal" id="modal_nueva_cuenta">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-credit-card"></span>
                  &nbsp; Nueva cuenta bancaria
               </h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Descripción:
                  <input class="form-control" type="text" name="descripcion" placeholder="Banco XXX" autocomplete="off" required=""/>
                  <label class="checkbox-inline">
                     <input type="checkbox" name="principal" value="TRUE" checked=""/>
                     Principal
                  </label>
               </div>
               <div class="form-group">
                  <a target="_blank" href="http://es.wikipedia.org/wiki/International_Bank_Account_Number">IBAN</a>:
                  <input class="form-control" type="text" name="iban" maxlength="34" placeholder="ES12345678901234567890123456" autocomplete="off"/>
               </div>
               <div class="form-group">
                  <a target="_blank" href="http://es.wikipedia.org/wiki/Society_for_Worldwide_Interbank_Financial_Telecommunication">SWIFT</a> o BIC:
                  <input class="form-control" type="text" name="swift" maxlength="11" autocomplete="off"/>
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

<form name="f_nueva_direccion" action="<?php echo $fsc->url();?>#direcciones" method="post">
   <input type="hidden" name="codproveedor" value="<?php echo $fsc->proveedor->codproveedor;?>"/>
   <input type="hidden" name="coddir" value=""/>
   <div class="modal" id="modal_nueva_direccion">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-road"></span>
                  &nbsp; Nueva dirección
               </h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <a href="<?php echo $fsc->pais->url();?>">País</a>:
                  <select class="form-control" name="pais">
                  <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->is_default() ){ ?>

                     <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                     <?php } ?>

                  <?php } ?>

                  </select>
               </div>
               <div class="form-group">
                  <span class="text-capitalize"><?php  echo FS_PROVINCIA;?>:</span>
                  <input id="ac_provincia2" class="form-control" type="text" name="provincia" value="<?php echo $fsc->empresa->provincia;?>"/>
               </div>
               <div class="form-group">
                  Ciudad:
                  <input class="form-control" type="text" name="ciudad" value="<?php echo $fsc->empresa->ciudad;?>"/>
               </div>
               <div class="form-group">
                  Código Postal:
                  <input class="form-control" type="text" name="codpostal" maxlength="10" autocomplete="off"/>
               </div>
               <div class="form-group">
                  Dirección:
                  <input class="form-control" type="text" name="direccion" autocomplete="off"/>
               </div>
               <div class="form-group">
                  <span class="text-capitalize"><?php  echo FS_APARTADO;?>:</span>
                  <input class="form-control" type="text" name="apartado" maxlength="10" autocomplete="off"/>
               </div>
               <div class="form-group">
                  Descripción:
                  <input class="form-control" type="text" name="descripcion" value="Nueva dirección"/>
                  <label class="checkbox-inline">
                     <input type="checkbox" name="direccionppal" value="TRUE" checked=""/>
                     Dirección principal
                  </label>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
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