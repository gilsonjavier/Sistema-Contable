<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->proveedor_s ){ ?>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("block/nueva_compra") . ( substr("block/nueva_compra",-1,1) != "/" ? "/" : "" ) . basename("block/nueva_compra") );?>

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

<script type="text/javascript">
    function acreedores_help() {
        bootbox.alert({
            message: 'Los acreedores son todos aquellos proveedores a los que no les compramos mercancias. Por ejemplo: proveedor de internet, teléfono, bancos...',
            title: "<b>Atención</b>"
        });
        return false;
    }
    $(document).ready(function () {
        $("#modal_proveedor").modal('show');
        document.f_nueva_compra.ac_proveedor.focus();
        $("#ac_proveedor").autocomplete({
            serviceUrl: '<?php echo $fsc->url();?>',
            paramName: 'buscar_proveedor',
            onSelect: function (suggestion) {
                if (suggestion) {
                    if (document.f_nueva_compra.proveedor.value != suggestion.data) {
                        document.f_nueva_compra.proveedor.value = suggestion.data;
                        document.f_nueva_compra.nuevo_proveedor.value = '';
                        document.f_nueva_compra.nuevo_cifnif.value = '';
                    }
                }
            }
        });
    });
</script>

<form name="f_nueva_compra" class="form" action="<?php echo $fsc->url();?>" method="post">
    <input type="hidden" name="proveedor"/>
    <div class="modal" id="modal_proveedor">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        <span class="glyphicon glyphicon-search"></span>
                        &nbsp; Selecciona el proveedor o acreedor
                    </h4>
                    <p class="help-block">
                        Busca y selecciona el proveedor o acreedor. Si lo deseas puedes crear uno nuevo usando el recuadro en azul.
                    </p>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control" type="text" name="ac_proveedor" id="ac_proveedor" placeholder="Buscar" autocomplete="off"/>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" onclick="this.disabled = true;
                                this.form.submit();">
                                    <span class="glyphicon glyphicon-share-alt"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-body bg-info">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                Nuevo proveedor:
                                <input type="text" name="nuevo_proveedor" onkeypress="teclear(event);return texto(event)" class="form-control" placeholder="Nombre" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <select name="nuevo_tipoidfiscal" class="form-control">
                                <?php $tiposid=$this->var['tiposid']=fs_tipos_id_fiscal();?>

                                <?php $loop_var1=$tiposid; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                <option value="<?php echo $value1;?>"><?php echo $value1;?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="text" id="ced" onblur="validarc()" name="nuevo_cifnif" minlength="10"  maxlength="13" class="form-control" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="personafisica" value="TRUE"/> Persona física (no empresa)
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="acreedor" value="TRUE"/>
                                Es un <b>acreedor</b>
                                <a href="#" onclick="return acreedores_help()">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                </a>
                            </label>
                        </div>
                        <div class="col-sm-5 text-right">
                            <button class="btn btn-sm btn-primary" type="submit">
                                <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar y seleccionar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <h1>Paso 1:</h1>
            </div>
            <p>Selecciona el proveedor o acreedor al que quieres realizar la compra.</p>
            <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_proveedor">
                <span class="glyphicon glyphicon-search"></span>&nbsp; Selecciona el proveedor o acreedor
            </a>
            <div class="page-header">
                <h2>Paso 2:</h2>
            </div>
            <p>Introduce línea a línea todos los artículos de la compra.</p>
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
