<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->cliente_s ){ ?>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/nueva_venta") . ( substr("block/nueva_venta",-1,1) != "/" ? "/" : "" ) . basename("block/nueva_venta") );?>

<?php }elseif( !$fsc->user->get_agente() ){ ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <h1>
                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                    No tienes un empleado asociado
                </h1>
            </div>
            <p class="help-block">
                No tienes un emleado asociado a tu <a href="<?php echo $fsc->user->url();?>">usuario</a>.
                Habla con el administrador para que te asigne un empleado.
            </p>
            <p class="help-block">
                Si crees que es un error de FacturaScripts, haz clic en el botón de ayuda,
                arriba a la derecha, e infórmanos del error.
            </p>
        </div>
    </div>
</div>
<?php }else{ ?>

<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#modal_cliente").modal('show');
        document.f_nueva_venta.ac_cliente.focus();

        $("#ac_cliente").autocomplete({
            serviceUrl: '<?php echo $fsc->url();?>',
            paramName: 'buscar_cliente',
            onSelect: function (suggestion) {
                if (suggestion) {
                    if (document.f_nueva_venta.cliente.value != suggestion.data) {
                        document.f_nueva_venta.cliente.value = suggestion.data;
                    }
                }
            }
        });
    });
</script>

<div class="modal" id="modal_cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">
                    <span class="glyphicon glyphicon-search"></span>
                    &nbsp; Selecciona el cliente
                </h4>
                <p class="help-block">
                    Busca y selecciona el cliente o bien crea uno nuevo usando
                    el recuadro en azul. Además, puedes cambiar las
                    <a href="index.php?page=ventas_clientes_opciones">opciones para nuevos clientes</a>.
                </p>
            </div>
            <div class="modal-body">
                <form name="f_nueva_venta" action="<?php echo $fsc->url();?>" method="post" class="form">
                    <input type="hidden" name="cliente"/>
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control" type="text" name="ac_cliente" id="ac_cliente" onkeypress="teclear(event);return LetrasNumeros(event)"  placeholder="Buscar" autocomplete="off"/>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" onclick="this.disabled = true;this.form.submit();">
                                    <span class="glyphicon glyphicon-share-alt"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-body bg-info">
                <form action="<?php echo $fsc->url();?>" method="post" class="form-horizontal">
                    <input type="hidden" name="cliente"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" name="nuevo_cliente" class="form-control" placeholder="Nuevo cliente" onkeypress="teclear(event);return LetrasNumeros(event)" autocomplete="off" required=""/>
                        </div>
                    </div>
                    <!--<?php $form_class=$this->var['form_class']='';?>-->
                    <?php if( $fsc->nuevocli_setup['nuevocli_cifnif_req'] ){ ?><!--<?php $form_class=$this->var['form_class']=' has-warning';?>--><?php } ?>

                    <div class="form-group<?php echo $form_class;?>">
                        <label class="col-sm-2 control-label"><?php  echo FS_CIFNIF;?></label>
                        <div class="col-sm-3">
                            <select name="nuevo_tipoidfiscal" class="form-control">
                                <!--<?php $tiposid=$this->var['tiposid']=fs_tipos_id_fiscal();?>-->
                                <?php $loop_var1=$tiposid; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                <option value="<?php echo $value1;?>"><?php echo $value1;?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="col-sm-7">
                            <?php if( $fsc->nuevocli_setup['nuevocli_cifnif_req'] ){ ?>

                            <input type="text" name="nuevo_cifnif" class="form-control" id="ced" minlength="10" maxlength="13" onblur="validarc()" onkeypress="teclear(event);return numeros(event)" autocomplete="off" required=""/>
                            <?php }else{ ?>

                            <input type="text" name="nuevo_cifnif" class="form-control" id="ced" minlength="10" maxlength="13" onblur="validarc()" onkeypress="teclear(event);return numeros(event)" autocomplete="off"/>
                            <?php } ?>

                            <label class="checkbox-inline">
                                <input type="checkbox" name="personafisica" value="TRUE" checked=""/> Persona física (no empresa)
                            </label>
                        </div>
                    </div>
                    <?php if( $fsc->grupo->all() ){ ?>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Grupo</label>
                        <div class="col-sm-10">
                            <select name="codgrupo" class="form-control">
                                <option value="">Ninguno</option>
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
                    <?php } ?>

                    <?php if( $fsc->nuevocli_setup['nuevocli_telefono1'] ){ ?>

                    <!--<?php $form_class=$this->var['form_class']='';?>--><?php if( $fsc->nuevocli_setup['nuevocli_telefono1_req'] ){ ?><!--<?php $form_class=$this->var['form_class']=' has-warning';?>--><?php } ?>

                    <div class="form-group<?php echo $form_class;?>">
                        <label class="col-sm-2 control-label">Teléfono 1</label>
                        <div class="col-sm-10">
                            <?php if( $fsc->nuevocli_setup['nuevocli_telefono1_req'] ){ ?>

                            <input type="text" name="nuevo_telefono1" placeholder="XXXXXXXXXX" onkeypress="teclear(event);return numeros(event)" class="form-control" autocomplete="off" required=""/>
                            <?php }else{ ?>

                            <input type="text" name="nuevo_telefono1" placeholder="XXXXXXXXXX" onkeypress="teclear(event);return numeros(event)" class="form-control" autocomplete="off"/>
                            <?php } ?>

                        </div>
                    </div>
                    <?php } ?>

                    <?php if( $fsc->nuevocli_setup['nuevocli_telefono2'] ){ ?>

                    <!--<?php $form_class=$this->var['form_class']='';?>--><?php if( $fsc->nuevocli_setup['nuevocli_telefono2_req'] ){ ?><!--<?php $form_class=$this->var['form_class']=' has-warning';?>--><?php } ?>

                    <div class="form-group<?php echo $form_class;?>">
                        <label class="col-sm-2 control-label">Teléfono 2</label>
                        <div class="col-sm-10">
                            <?php if( $fsc->nuevocli_setup['nuevocli_telefono2_req'] ){ ?>

                            <input type="text" name="nuevo_telefono2" placeholder="XXXXXXXXXX" onkeypress="teclear(event);return numeros(event)" class="form-control" autocomplete="off" required=""/>
                            <?php }else{ ?>

                            <input type="text" name="nuevo_telefono2" placeholder="XXXXXXXXXX" onkeypress="teclear(event);return numeros(event)" class="form-control" autocomplete="off"/>
                            <?php } ?>

                        </div>
                    </div>
                    <?php } ?>

                    <?php if( $fsc->nuevocli_setup['nuevocli_email'] ){ ?>

                    <!--<?php $form_class=$this->var['form_class']='';?>--><?php if( $fsc->nuevocli_setup['nuevocli_email_req'] ){ ?><!--<?php $form_class=$this->var['form_class']=' has-warning';?>--><?php } ?>

                    <div class="form-group<?php echo $form_class;?>">
                        <label class="col-sm-2 control-label">E-mail</label>
                        <div class="col-sm-10">
                            <?php if( $fsc->nuevocli_setup['nuevocli_email_req'] ){ ?>

                            <input type="text" name="nuevo_email" class="form-control" placeholder="Ejemplo@gmail.com" title="ejemplo@gmail.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" autocomplete="off" required=""/>
                            <?php }else{ ?>

                            <input type="text" name="nuevo_email" class="form-control" placeholder="Ejemplo@gmail.com" title="ejemplo@gmail.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" autocomplete="off"/>
                            <?php } ?>

                        </div>
                    </div>
                    <?php } ?>

                    <?php if( $fsc->nuevocli_setup['nuevocli_pais'] ){ ?>

                    <!--<?php $form_class=$this->var['form_class']='';?>--><?php if( $fsc->nuevocli_setup['nuevocli_pais_req'] ){ ?> has-warning<?php } ?>

                    <div class="form-group<?php echo $form_class;?>">
                        <label class="col-sm-2 control-label">
                            <a href="<?php echo $fsc->pais->url();?>">País</a>
                        </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="nuevo_pais">
                                <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                <?php if( $value1->is_default() ){ ?>

                                <option value="<?php echo $value1->codpais;?>" selected=""><?php echo $value1->nombre;?></option>
                                <?php }else{ ?>

                                <option value="<?php echo $value1->codpais;?>"><?php echo $value1->nombre;?></option>
                                <?php } ?>

                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if( $fsc->nuevocli_setup['nuevocli_provincia'] ){ ?>

                    <!--<?php $form_class=$this->var['form_class']='';?>--><?php if( $fsc->nuevocli_setup['nuevocli_provincia_req'] ){ ?><!--<?php $form_class=$this->var['form_class']=' has-warning';?>--><?php } ?>

                    <div class="form-group<?php echo $form_class;?>">
                        <label class="col-sm-2 control-label text-capitalize"><?php  echo FS_PROVINCIA;?></label>
                        <div class="col-sm-10">
                            <?php if( $fsc->nuevocli_setup['nuevocli_provincia_req'] ){ ?>

                            <input type="text" name="nuevo_provincia" onkeypress="teclear(event);return LetrasNumeros(event)" placeholder="Manabi" id="ac_provincia" class="form-control" autocomplete="off" required=""/>
                            <?php }else{ ?>

                            <input type="text" name="nuevo_provincia" onkeypress="teclear(event);return LetrasNumeros(event)" placeholder="Manabi" value="<?php echo $fsc->empresa->provincia;?>" id="ac_provincia" class="form-control" autocomplete="off"/>
                            <?php } ?>

                        </div>
                    </div>
                    <?php } ?>

                    <?php if( $fsc->nuevocli_setup['nuevocli_ciudad'] ){ ?>

                    <!--<?php $form_class=$this->var['form_class']='';?>--><?php if( $fsc->nuevocli_setup['nuevocli_ciudad_req'] ){ ?><!--<?php $form_class=$this->var['form_class']=' has-warning';?>--><?php } ?>

                    <div class="form-group<?php echo $form_class;?>">
                        <label class="col-sm-2 control-label">Ciudad</label>
                        <div class="col-sm-10">
                            <?php if( $fsc->nuevocli_setup['nuevocli_ciudad_req'] ){ ?>

                            <input type="text" name="nuevo_ciudad" placeholder="Ciudad" onkeypress="teclear(event);return LetrasNumeros(event)" class="form-control" required=""/>
                            <?php }else{ ?>

                            <input type="text" name="nuevo_ciudad" placeholder="Ciudad" onkeypress="teclear(event);return LetrasNumeros(event)" value="<?php echo $fsc->empresa->ciudad;?>" class="form-control"/>
                            <?php } ?>

                        </div>
                    </div>
                    <?php } ?>

                    <?php if( $fsc->nuevocli_setup['nuevocli_codpostal'] ){ ?>

                    <!--<?php $form_class=$this->var['form_class']='';?>--><?php if( $fsc->nuevocli_setup['nuevocli_codpostal_req'] ){ ?><!--<?php $form_class=$this->var['form_class']=' has-warning';?>--><?php } ?>

                    <div class="form-group<?php echo $form_class;?>">
                        <label class="col-sm-2 control-label">Código Postal</label>
                        <div class="col-sm-10">
                            <?php if( $fsc->nuevocli_setup['nuevocli_codpostal_req'] ){ ?>

                            <input type="text" name="nuevo_codpostal" onkeypress="teclear(event);return numeros(event)" class="form-control" readonly/>
                            <?php }else{ ?>

                            <input type="text" name="nuevo_codpostal" onkeypress="teclear(event);return numeros(event)" value="<?php echo $fsc->empresa->codpostal;?>" readonly class="form-control"/>
                            <?php } ?>

                        </div>
                    </div>
                    <?php } ?>

                    <?php if( $fsc->nuevocli_setup['nuevocli_direccion'] ){ ?>

                    <!--<?php $form_class=$this->var['form_class']='';?>--><?php if( $fsc->nuevocli_setup['nuevocli_direccion_req'] ){ ?><!--<?php $form_class=$this->var['form_class']=' has-warning';?>--><?php } ?>

                    <div class="form-group<?php echo $form_class;?>">
                        <label class="col-sm-2 control-label">Dirección</label>
                        <div class="col-sm-10">
                            <?php if( $fsc->nuevocli_setup['nuevocli_direccion_req'] ){ ?>

                            <input type="text" name="nuevo_direccion" placeholder="Direccion..." onkeypress="teclear(event)" class="form-control" autocomplete="off" required=""/>
                            <?php }else{ ?>

                            <input type="text" name="nuevo_direccion" placeholder="Direccion..." value="C/ " onkeypress="teclear(event)" class="form-control" autocomplete="off"/>
                            <?php } ?>

                        </div>
                    </div>
                    <?php } ?>

                    <div class="text-right">
                        <button class="btn btn-sm btn-primary" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar y seleccionar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <h1>Paso 1:</h1>
            </div>
            <p>Selecciona el cliente al que quieres realizar la venta.</p>
            <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_cliente">
                <span class="glyphicon glyphicon-search"></span>&nbsp; Selecciona el cliente
            </a>
            <div class="page-header">
                <h2>Paso 2:</h2>
            </div>
            <p>Introduce línea a línea todos los artículos de la venta.</p>
            <div class="page-header">
                <h2>Paso 3:</h2>
            </div>
            <p>Pulsa el botón guardar.</p>
        </div>
    </div>
</div>
<?php } ?>


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
