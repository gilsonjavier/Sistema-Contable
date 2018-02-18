<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript">
   function comprobar_url()
   {
      if(window.location.hash.substring(1) == 'email')
      {
         mostrar_seccion('email');
      }
      else if(window.location.hash.substring(1) == 'facturacion')
      {
         mostrar_seccion('facturacion');
      }
      else if(window.location.hash.substring(1) == 'cuentasb')
      {
         mostrar_seccion('cuentasb');
      }
      else if(window.location.hash.substring(1) == 'impresion')
      {
         mostrar_seccion('impresion');
      }
      else
      {
         mostrar_seccion('');
      }
   }
   function mostrar_seccion(id)
   {
      $("#panel_generales").hide();
      $("#panel_email").hide();
      $("#panel_facturacion").hide();
      $("#panel_cuentasb").hide();
      $("#panel_impresion").hide();
      $("#b_generales").removeClass('active');
      $("#b_email").removeClass('active');
      $("#b_facturacion").removeClass('active');
      $("#b_cuentasb").removeClass('active');
      $("#b_impresion").removeClass('active');
      
      if(id == 'email')
      {
         $("#panel_email").show();
         $("#b_email").addClass('active');
         document.f_empresa.email.focus();
      }
      else if(id == 'facturacion')
      {
         $("#panel_facturacion").show();
         $("#b_facturacion").addClass('active');
         document.f_empresa.coddivisa.focus();
      }
      else if(id == 'cuentasb')
      {
         $("#panel_cuentasb").show();
         $("#b_cuentasb").addClass('active');
      }
      else if(id == 'impresion')
      {
         $("#panel_impresion").show();
         $("#b_impresion").addClass('active');
         document.f_empresa.pie_factura.focus();
      }
      else
      {
         $("#panel_generales").show();
         $("#b_generales").addClass('active');
         document.f_empresa.nombre.focus();
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
   $(document).ready(function() {
      comprobar_url();
      window.onpopstate = function() {
         comprobar_url();
      };
      $("#b_nueva_cuenta").click(function(event) {
         event.preventDefault();
         $("#modal_nueva_cuenta").modal('show');
         document.f_nueva_cuenta.descripcion.focus();
      });
      $("#b_add_logo").click(function(event) {
         event.preventDefault();
         $("#modal_logo").modal('show');
      });
   });
</script>

<div class='container-fluid'>
   <div class="row">
      <div class="col-md-2 col-sm-3"></div>
      <div class="col-md-10 col-sm-9">
         <div class="page-header">
            <h1>
               <i class="fa fa-building-o" aria-hidden="true"></i>
               Empresa
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </h1>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-2 col-sm-3">
         <ul class="nav nav-pills nav-stacked">
            <li id="b_generales" class="active">
               <a href="#generales" onclick="mostrar_seccion('')">
                  <span class="glyphicon glyphicon-dashboard"></span> &nbsp; Datos generales
               </a>
            </li>
            <li id="b_email">
               <a href="#email" onclick="mostrar_seccion('email')">
                  <span class="glyphicon glyphicon-envelope"></span> &nbsp; Email
               </a>
            </li>
            <li id="b_facturacion">
               <a href="#facturacion" onclick="mostrar_seccion('facturacion')">
                  <span class="glyphicon glyphicon-usd"></span> &nbsp; Facturación
               </a>
            </li>
            <li id="b_cuentasb">
               <a href="#cuentasb" onclick="mostrar_seccion('cuentasb')">
                  <span class="glyphicon glyphicon-credit-card"></span> &nbsp; Cuentas bancarias
               </a>
            </li>
            <li id="b_impresion">
               <a href="#impresion" onclick="mostrar_seccion('impresion')">
                  <span class="glyphicon glyphicon-print"></span> &nbsp; Impresión
               </a>
            </li>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <li>
                  <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>"><?php echo $value1->text;?></a>
               </li>
               <?php } ?>

            <?php } ?>

         </ul>
      </div>
      <div class="col-md-10 col-sm-9">
         <form name="f_empresa" action="<?php echo $fsc->page->url();?>" method="post" class="form" role="form">
            <div class="panel panel-primary" id="panel_generales">
               <div class="panel-heading">
                  <h3 class="panel-title">Datos generales</h3>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-5">
                        <div class="form-group">
                           Nombre:
                           <input class="form-control" type="text" name="nombre" value="<?php echo $fsc->empresa->nombre;?>" onkeypress="teclear(event);return LetrasNumeros(event)" autocomplete="off" autofocus />
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           Nombre Corto:
                           <input class="form-control" type="text" name="nombrecorto" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->empresa->nombrecorto;?>" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <?php  echo FS_CIFNIF;?>:
                           <input class="form-control" type="text" name="cifnif" onkeypress="teclear(event);return numeros(event)"value="<?php echo $fsc->empresa->cifnif;?>" maxlength="30" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           Administrador:
                           <input class="form-control" type="text" name="administrador" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->empresa->administrador;?>" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <a href="<?php echo $fsc->pais->url();?>">País</a>:
                           <select name="codpais" class="form-control">
                           <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <?php if( $fsc->empresa->codpais==$value1->codpais ){ ?>

                              <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                              <?php }else{ ?>

                              <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                              <?php } ?>

                           <?php } ?>

                           </select>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <span class="text-capitalize"><?php  echo FS_PROVINCIA;?>:</span>
                           <input id="ac_provincia" class="form-control" type="text" placeholder="Manabi" name="provincia" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->empresa->provincia;?>"/>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           Ciudad:
                           <input class="form-control" type="text" name="ciudad" placeholder="Manata" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->empresa->ciudad;?>" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group">
                           Código Postal:
                           <input class="form-control" type="text" name="codpostal" value="<?php echo $fsc->empresa->codpostal;?>" maxlength="10" autocomplete="off" readonly/>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           Dirección:
                           <input class="form-control" type="text" name="direccion" placeholder="Centro de Manta" onkeypress="teclear(event)" value="<?php echo $fsc->empresa->direccion;?>" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <span class="text-capitalize"><?php  echo FS_APARTADO;?></span>:
                           <input class="form-control" type="text" name="apartado" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->empresa->apartado;?>" maxlength="10" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           Teléfono:
                           <input class="form-control" type="text" name="telefono" placeholder="XXXXXXXXXX" onkeypress="teclear(event);return numeros(event)" minlength="10" maxlength="10" value="<?php echo $fsc->empresa->telefono;?>" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           Fax:
                           <input class="form-control" type="text" name="fax" onkeypress="teclear(event)" value="<?php echo $fsc->empresa->fax;?>" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           Web:
                           <input class="form-control" type="text" name="web" value="<?php echo $fsc->empresa->web;?>" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="panel-footer text-right">
                  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                  </button>
               </div>
            </div>
            
            <div id="panel_email">
               <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active">
                     <a href="#email_cfg" aria-controls="email_cfg" role="tab" data-toggle="tab">
                        Configuración
                     </a>
                  </li>
                  <li role="presentation">
                     <a href="#plantillas" aria-controls="plantillas" role="tab" data-toggle="tab">
                        Firma y plantillas
                     </a>
                  </li>
               </ul>
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="email_cfg">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-sm-12">
                              <p class="help-block">
                                 Si configuras tu cuenta de email, podrás usarla para enviar documentos.
                              </p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-envelope"></span>
                                    </span>
                                    <input class="form-control" type="email" name="email" value="<?php echo $fsc->empresa->email;?>" title="ejemplo@gmail.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" autocomplete="off" placeholder="email" autofocus=""/>
                                 </div>
                                 <p class="help-block">
                                    Introduzca el correo email de la Empresa. 
                                    </p>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-eye-close"></span>
                                    </span>
                                    <input class="form-control" type="password" name="mail_password" value="<?php echo $fsc->empresa->email_config['mail_password'];?>" placeholder="contraseña"/>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-duplicate"></span>
                                    </span>
                                    <input class="form-control" type="text" name="mail_bcc" value="<?php echo $fsc->empresa->email_config['mail_bcc'];?>" placeholder="Enviar copias a (opcional)"/>
                                 </div>
                                 <p class="help-block">Puedes escribir un email para que se envíe copia de todo.</p>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 text-right">
                              <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.action='<?php echo $fsc->url();?>#email';this.form.submit();">
                                 <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                              </button>
                           </div>
                        </div>
                     </div>
                     <br/>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="plantillas">
                     <br/>
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group">
                                 Firma:
                                 <textarea class="form-control" name="mail_firma" rows="5"><?php echo $fsc->empresa->email_config['mail_firma'];?></textarea>
                              </div>
                              <p class='help-block'>
                                 A continuación tienes las plantillas de emails para los documentos de venta.
                                 <br/>
                                 El texto <b>#DOCUMENTO#</b> será sustituido por el nombre del documento y su código.
                                 <br/>
                                 El texto <b>#FIRMA#</b> será sustituido por la forma predeterminada.
                              </p>
                              <div class="form-group">
                                 Factura:
                                 <textarea class="form-control" name="mail_factura" rows="6"><?php echo $fsc->email_plantillas['mail_factura'];?></textarea>
                              </div>
                              <div class="form-group">
                                 <span class="text-capitalize"><?php  echo FS_ALBARAN;?>:</span>
                                 <textarea class="form-control" name="mail_albaran" rows="6"><?php echo $fsc->email_plantillas['mail_albaran'];?></textarea>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 text-right">
                              <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.action='<?php echo $fsc->url();?>#email';this.form.submit();">
                                 <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
            <div class="panel panel-primary" id="panel_facturacion">
               <div class="panel-heading">
                  <h3 class="panel-title">Facturación</h3>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-4">
                        <a href="<?php echo $fsc->divisa->url();?>">Divisa</a>:
                        <select name="coddivisa" class="form-control">
                        <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $fsc->empresa->coddivisa==$value1->coddivisa ){ ?>

                           <option value="<?php echo $value1->coddivisa;?>" selected=""><?php echo $value1->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->coddivisa;?>"><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                     </div>
                     <div class="col-sm-4">
                        <a href="<?php echo $fsc->ejercicio->url();?>">Ejercicio</a>:
                        <select name="codejercicio" class="form-control" autofocus >
                        <?php $loop_var1=$fsc->ejercicio->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $fsc->empresa->codejercicio==$value1->codejercicio ){ ?>

                           <option value="<?php echo $value1->codejercicio;?>" selected=""><?php echo $value1->nombre;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codejercicio;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                        <p class="help-block">Sólo sirve para inicializar algunos campos.</p>
                     </div>
                     <div class="col-sm-4">
                        <a href="<?php echo $fsc->serie->url();?>" class="text-capitalize"><?php  echo FS_SERIE;?></a>:
                        <select name="codserie" class="form-control">
                        <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $fsc->empresa->codserie==$value1->codserie ){ ?>

                           <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                        <!--<p class="help-block">El <?php  echo FS_IRPF;?> se define para cada <?php  echo FS_SERIE;?>.</p>-->
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="checkbox">
                           <label>
                              <?php if( $fsc->empresa->contintegrada ){ ?>

                              <input type="checkbox" name="contintegrada" value="TRUE" checked=""/>
                              <?php }else{ ?>

                              <input type="checkbox" name="contintegrada" value="TRUE"/>
                              <?php } ?>

                              Contabilidad integrada
                           </label>
                        </div>
                        <div class="checkbox">
                           <label>
                              <?php if( $fsc->empresa->recequivalencia ){ ?>

                              <input type="checkbox" name="recequivalencia" value="TRUE" checked=""/>
                              <?php }else{ ?>

                              <input type="checkbox" name="recequivalencia" value="TRUE"/>
                              <?php } ?>

                              Aplicar recargo de equivalencia
                           </label>
                        </div>
                     </div>
                     <div class="col-sm-5">
                        <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
                        <select name="codpago" class="form-control">
                        <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $fsc->empresa->codpago==$value1->codpago ){ ?>

                           <option value="<?php echo $value1->codpago;?>" selected=""><?php echo $value1->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                     </div>
                     <div class="col-sm-3">
                        <a href="<?php echo $fsc->almacen->url();?>">Almacén</a>:
                        <select name="codalmacen" class="form-control">
                        <?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $fsc->empresa->codalmacen==$value1->codalmacen ){ ?>

                           <option value="<?php echo $value1->codalmacen;?>" selected=""><?php echo $value1->nombre;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                     </div>
                  </div>
               </div>
               <div class="panel-footer" style="text-align: right;">
                  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.action='<?php echo $fsc->url();?>#facturacion';this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                  </button>
               </div>
            </div>
            
            <div class="panel panel-primary" id="panel_impresion">
               <div class="panel-heading">
                  <h3 class="panel-title">Impresión</h3>
               </div>
               <div class="panel-body">
                  <div class="form-group">
                     <label class="checkbox-inline">
                        <?php if( $fsc->impresion['print_ref'] ){ ?>

                        <input type="checkbox" name="print_ref" value="TRUE" checked=""/>
                        <?php }else{ ?>

                        <input type="checkbox" name="print_ref" value="TRUE"/>
                        <?php } ?>

                        mostrar referencias.
                     </label>
                     &nbsp;
                     <label class="checkbox-inline">
                        <?php if( $fsc->impresion['print_dto'] ){ ?>

                        <input type="checkbox" name="print_dto" value="TRUE" checked=""/>
                        <?php }else{ ?>

                        <input type="checkbox" name="print_dto" value="TRUE"/>
                        <?php } ?>

                        mostrar descuentos.
                     </label>
                     &nbsp;
                     <label class="checkbox-inline">
                        <?php if( $fsc->impresion['print_alb'] ){ ?>

                        <input type="checkbox" name="print_alb" value="TRUE" checked=""/>
                        <?php }else{ ?>

                        <input type="checkbox" name="print_alb" value="TRUE"/>
                        <?php } ?>

                        mostrar <?php  echo FS_ALBARANES;?> relacionados.
                     </label>
                     &nbsp;
                     <label class="checkbox-inline">
                        <?php if( $fsc->impresion['print_formapago'] ){ ?>

                        <input type="checkbox" name="print_formapago" value="TRUE" checked=""/>
                        <?php }else{ ?>

                        <input type="checkbox" name="print_formapago" value="TRUE"/>
                        <?php } ?>

                        mostrar forma de pago en las facturas.
                     </label>
                  </div>
                  <div class="form-group">
                     Pie de página de la factura:
                     <textarea name="pie_factura" rows="3" class="form-control"><?php echo $fsc->empresa->pie_factura;?></textarea>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <?php if( $fsc->logo ){ ?>

                        <div class="thumbnail">
                           <img src="<?php echo $fsc->logo;?>" alt="logotipo"/>
                        </div>
                        <button class="btn btn-sm btn-block btn-default" id="b_add_logo">
                           <span class="glyphicon glyphicon-picture"></span>
                           Cambiar logotipo
                        </button>
                        <?php }else{ ?>

                        <button class="btn btn-sm btn-default" id="b_add_logo">
                           <span class="glyphicon glyphicon-picture"></span>
                           Añadir logotipo
                        </button>
                        <?php } ?>

                     </div>
                     <div class="col-sm-8">
                        <div class="form-group">
                           Lema:
                           <input class="form-control" type="text" name="lema" value="<?php echo $fsc->empresa->lema;?>" autocomplete="off"/>
                           <!--<p class="help-block">Lema y horario se utilizan solamente en los tickets.</p>-->
                        </div>
                        <div class="form-group">
                           Horario:
                           <input class="form-control" type="text" name="horario" value="<?php echo $fsc->empresa->horario;?>" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="panel-footer" style="text-align: right;">
                  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.action='<?php echo $fsc->url();?>#impresion';this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                  </button>
               </div>
            </div>
         </form>
         
         <div id="panel_cuentasb">
            <?php $loop_var1=$fsc->cuenta_banco->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <form action="<?php echo $fsc->url();?>#cuentasb" method="post" class="form">
               <input type="hidden" name="codcuenta" value="<?php echo $value1->codcuenta;?>"/>
               <div class="panel panel-primary">
                  <div class="panel-heading">
                     <h3 class="panel-title">Cuenta bancaria #<?php echo $value1->codcuenta;?></h3>
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-md-8">
                           <div class="form-group">
                              <input class="form-control" type="text" name="descripcion" value="<?php echo $value1->descripcion;?>" placeholder="Cuenta principal" autocomplete="off"/>
                              <p class="help-block">
                                 Puedes asociar tus cuentas bancarias con las
                                 <a href="index.php?page=contabilidad_formas_pago">formas de pago</a>
                                 para que aparezcan en las facturas.
                              </p>
                           </div>
                        </div>
                        <div class="col-md-4 text-right">
                           <div class="btn-group">
                              <a class="btn btn-sm btn-danger" onclick="delete_cuenta('<?php echo $value1->codcuenta;?>');">
                                 <span class="glyphicon glyphicon-trash"></span>&nbsp; Eliminar
                              </a>
                              <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.action='<?php echo $fsc->url();?>#facturacion;this.form.submit();">
                                 <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                              </button>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-5">
                           <div class="form-group">
                              <a target="_blank" href="http://es.wikipedia.org/wiki/International_Bank_Account_Number">IBAN</a>:
                              <input class="form-control" type="text" name="iban" value="<?php echo $value1->iban;?>" maxlength="34" placeholder="ES12345678901234567890123456" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <a target="_blank" href="http://es.wikipedia.org/wiki/Society_for_Worldwide_Interbank_Financial_Telecommunication">SWIFT</a> o BIC:
                              <input class="form-control" type="text" name="swift" value="<?php echo $value1->swift;?>" maxlength="11" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              Contabilidad:
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="fa fa-balance-scale" aria-hidden="true"></i>
                                 </span>
                                 <input type="text" name="codsubcuenta" value="<?php echo $value1->codsubcuenta;?>" class="form-control" maxlength="15" placeholder="subcuenta" autocomplete="off"/>
                                 <!-- Campo oculto para validacion del autocomplete  -->
                                 <input type="hidden" name="validarsubcuenta" value="0">
                              </div>
                              <p class="help-block">
                                 Subcuenta asociada para esta cuenta bancaria.
                              </p>
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
      </div>
   </div>
</div>

<form enctype="multipart/form-data" action="<?php echo $fsc->url();?>#impresion" method="post">
   <input type="hidden" name="logo" value="TRUE"/>
   <div class="modal fade" id="modal_logo">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-picture"></span>
                  Logotipo para los documentos
               </h4>
            </div>
            <div class="modal-body">
               <?php if( $fsc->logo ){ ?>

               <div class="thumbnail">
                  <img src="<?php echo $fsc->logo;?>" alt="logotipo"/>
               </div>
               <?php } ?>

               <div class="form-group">
                  <input name="fimagen" type="file" accept="image/jpeg, image/png"/>
               </div>
            </div>
            <div class="modal-footer">
               <?php if( $fsc->logo ){ ?>

               <a class="btn btn-sm btn-danger pull-left" href="<?php echo $fsc->url();?>&delete_logo=TRUE#impresion">
                  <span class="glyphicon glyphicon-trash"></span>&nbsp; Eliminar
               </a>
               <?php } ?>

               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>

<form name="f_nueva_cuenta" action="<?php echo $fsc->url();?>#cuentasb" method="post" class="form">
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
                  <input class="form-control" type="text" name="descripcion" placeholder="Cuenta principal" autocomplete="off" required=""/>
               </div>
               <div class="form-group">
                  <a target="_blank" href="http://es.wikipedia.org/wiki/International_Bank_Account_Number">IBAN</a>:
                  <input class="form-control" type="text" name="iban" maxlength="34" placeholder="ES12345678901234567890123456" autocomplete="off"/>
               </div>
               <div class="form-group">
                  <a target="_blank" href="http://es.wikipedia.org/wiki/Society_for_Worldwide_Interbank_Financial_Telecommunication">SWIFT</a> o BIC:
                  <input class="form-control" type="text" name="swift" maxlength="11" autocomplete="off"/>
               </div>
               <div class="form-group">
                  Contabilidad:
                  <div class="input-group">
                     <span class="input-group-addon">
                        <i class="fa fa-balance-scale" aria-hidden="true"></i>
                     </span>
                     <input type="text" name="codsubcuenta" class="form-control" maxlength="15" placeholder="subcuenta" autocomplete="off"/>
                     <!-- Campo oculto para validacion del autocomplete  -->
                     <input type="hidden" name="validarsubcuenta" value="0">
                  </div>
                  <p class="help-block">
                     Subcuenta asociada para esta cuenta bancaria.
                  </p>
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

<!--  Script que permite el autocomplete de la subcuenta  -->
<script>
//Autocomplete en el campo contabilidad
   $("input[name='codsubcuenta']").each(function () {
      $(this).autocomplete({
           serviceUrl: 'index.php?page=admin_empresa',
           paramName: 'subcuenta',
           onSelect: function (data){
               $(this).val(data.data);
               $('input[name="validarsubcuenta"]').val('1');
           }
      });
   });
// Validar que se leccione una subcuenta
   $('input[name="codsubcuenta"]').on("keydown", function(e) {
      if ($('input[name="validarsubcuenta"]').val() == '1' ) {
         if(e.keyCode == 8 || e.keyCode == 46) {
            $('input[name="codsubcuenta"]').val('');
            $('input[name="validarsubcuenta"]').val('0');
         }
      }
   });
// Validar que se leccione una subcuenta
   $('input[name="codsubcuenta"]').blur(function() { 
      if ($('input[name="validarsubcuenta"]').val() == '0' ) {
         $('input[name="codsubcuenta"]').val('');
      }
   });
</script>

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
       