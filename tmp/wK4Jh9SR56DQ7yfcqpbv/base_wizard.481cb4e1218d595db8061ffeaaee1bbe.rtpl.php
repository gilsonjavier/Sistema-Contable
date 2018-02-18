<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->recargar ){ ?>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout("location.href = '<?php echo $fsc->url();?>';", 1000);
    });
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <h1>
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Trabajando...
                </h1>
            </div>
            <p class="help-block">
                Espera a que termine el proceso. Gracias ;-)
            </p>
        </div>
    </div>
</div>
<?php }elseif( $fsc->step==2 ){ ?>

<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<form name="f_empresa" action="<?php echo $fsc->page->url();?>" method="post" class="form" role="form">
    <div class="container-fluid">
        <?php if( $fsc->bad_password ){ ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>
                        <span class="glyphicon glyphicon-warning-sign"></span>
                        Contraseña no segura
                    </h1>
                    <p class="help-block">
                        Si esta instalación está disponible públicamente, es recomendable
                        que cambies la contraseña.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <input class="form-control" type="password" name="npassword" maxlength="32" placeholder="nueva contraseña" autofocus />
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <input class="form-control" type="password" name="npassword2" maxlength="32" placeholder="repite la contraseña"/>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>
                        <span class="glyphicon glyphicon-edit"></span>
                        Datos de la empresa / Autónomo
                    </h1>
                    <p class="help-block">
                        Bienvenido al asiente de instalación de facturacion_base, el plugin
                        de FacturaScripts que integra la facturación y contabilidad básica.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    Nombre:
                    <input class="form-control" type="text" name="nombre" value="<?php echo $fsc->empresa->nombre;?>" autocomplete="off" autofocus />
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    Nombre Corto:
                    <input class="form-control" type="text" name="nombrecorto" value="<?php echo $fsc->empresa->nombrecorto;?>" autocomplete="off"/>
                    <p class="help-block">Para mostrar en el menú.</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php  echo FS_CIFNIF;?>:
                    <input class="form-control" type="text" name="cifnif" value="<?php echo $fsc->empresa->cifnif;?>" maxlength="30" autocomplete="off"/>
                    <p class="help-block">
                        <?php  echo FS_CIFNIF;?> es el identificador fiscal. Si en tu país se llama de otra forma, puedes traducirlo más adelante.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <a href="<?php echo $fsc->pais->url();?>">País</a>:
                    <select name="codpais" class="form-control">
                        <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1->codpais;?>"<?php if( $fsc->empresa->codpais == $value1->codpais ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="text-capitalize"><?php  echo FS_PROVINCIA;?>:</div>
                    <input id="ac_provincia" class="form-control" type="text" name="provincia" value="<?php echo $fsc->empresa->provincia;?>"/>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    Ciudad:
                    <input class="form-control" type="text" name="ciudad" value="<?php echo $fsc->empresa->ciudad;?>" autocomplete="off"/>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    Código Postal:
                    <input class="form-control" type="text" name="codpostal" value="<?php echo $fsc->empresa->codpostal;?>" maxlength="10" autocomplete="off"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    Dirección:
                    <input class="form-control" type="text" name="direccion" value="<?php echo $fsc->empresa->direccion;?>" autocomplete="off"/>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <span class="text-capitalize"><?php  echo FS_APARTADO;?></span>:
                    <input class="form-control" type="text" name="apartado" value="<?php echo $fsc->empresa->apartado;?>" maxlength="10" autocomplete="off"/>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    Administrador de la empresa:
                    <input class="form-control" type="text" name="administrador" value="<?php echo $fsc->empresa->administrador;?>" autocomplete="off"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    Teléfono:
                    <input class="form-control" type="text" name="telefono" value="<?php echo $fsc->empresa->telefono;?>" autocomplete="off"/>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    Fax:
                    <input class="form-control" type="text" name="fax" value="<?php echo $fsc->empresa->fax;?>" autocomplete="off"/>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    Web:
                    <input class="form-control" type="text" name="web" value="<?php echo $fsc->empresa->web;?>" autocomplete="off"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-right">
                <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled = true;this.form.submit();">
                    <span class="glyphicon glyphicon-ok"></span>&nbsp; Continuar
                </button>
            </div>
        </div>
    </div>
</form>
<?php }elseif( $fsc->step==3 ){ ?>

<form name="f_empresa" action="<?php echo $fsc->page->url();?>" method="post" class="form" role="form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>
                        <span class="glyphicon glyphicon-globe"></span>
                        Datos regionales
                    </h1>
                    <p class="help-block">
                        Ahora hay que seleccionar la moneda y traducir lo que necesites
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <a href="<?php echo $fsc->divisa->url();?>">Divisa</a>:
                    <select name="coddivisa" class="form-control">
                        <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1->coddivisa;?>"<?php if( $fsc->empresa->coddivisa == $value1->coddivisa ){ ?> selected=""<?php } ?>><?php echo $value1->descripcion;?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    Decimales de los totales:
                    <select name="nf0" class="form-control">
                        <?php $loop_var1=$fsc->nf0(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1;?>"<?php if( $value1==$GLOBALS['config2']['nf0'] ){ ?> selected=""<?php } ?>><?php echo $value1;?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    Decimales de los precios:
                    <select name="nf0_art" class="form-control">
                        <?php $loop_var1=$fsc->nf0(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1;?>"<?php if( $value1==$GLOBALS['config2']['nf0_art'] ){ ?> selected=""<?php } ?>><?php echo $value1;?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    Separador para los Decimales:
                    <select name="nf1" class="form-control">
                        <?php $loop_var1=$fsc->nf1(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $key1;?>"<?php if( $key1==$GLOBALS['config2']['nf1'] ){ ?> selected=""<?php } ?>><?php echo $value1;?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    Separador para los Millares:
                    <select name="nf2" class="form-control">
                        <option value="">(Ninguno)</option>
                        <?php $loop_var1=$fsc->nf1(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $key1;?>"<?php if( $key1==$GLOBALS['config2']['nf2'] ){ ?> selected=""<?php } ?>><?php echo $value1;?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    Posición del símbolo divisa:
                    <select name="pos_divisa" class="form-control">
                        <option value="right"<?php if( $GLOBALS['config2']['pos_divisa']=='right' ){ ?> selected=""<?php } ?>>123 <?php echo $fsc->simbolo_divisa();?></option>
                        <option value="left"<?php if( $GLOBALS['config2']['pos_divisa']=='left' ){ ?> selected=""<?php } ?>><?php echo $fsc->simbolo_divisa();?>123</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h2><i class="fa fa-language"></i>&nbsp; Traducciones:</h2>
                    <p class="help-block">
                        Puedes traducir ciertos términos para adaptarlos a tu país o simplemente por comodidad.
                        <br/>
                        FACTURA y FACTURAS se traducen únicamente en los documentos de ventas.
                        FACTURA_SIMPLIFICADA se utiliza en los tickets.
                        NUMERO2 es un campo disponible en todos los documentos de ventas y
                        que puedes usar como quieras.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $loop_var1=$fsc->traducciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <div class="col-sm-3">
                <div class="form-group">
                    <span class="text-uppercase"><?php echo $value1['nombre'];?>:</span>
                    <input class="form-control" type="text" name="<?php echo $value1['nombre'];?>" value="<?php echo $value1['valor'];?>" autocomplete="off"/>
                </div>
            </div>
            <?php } ?>

            <div class="col-sm-3">
                <br/>
                <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled = true;this.form.submit();">
                    <span class="glyphicon glyphicon-ok"></span>&nbsp; Continuar
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="well well-sm">
                    <h3>
                        <i class="fa fa-question-circle"></i>&nbsp; Presupuesto
                        <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> Pedido
                        <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> Albarán
                        <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> Factura
                    </h3>
                    <p class="help-block">
                        El <b>presupuesto</b> es cuando simplemente haces un boceto de una compra o venta,
                        el <b>pedido</b> es cuando realmente se ha encargado esa compra o venta y hay un compromiso.
                        El <b>albarán</b> es un documento de salida o entrada de mercancía del almaćen
                        y la <b>factura</b> es un documento oficial que certifica la compra o venta.
                        <br/>
                        A los presupuestos también se les conoce como <b>facturas proforma</b>
                        o <b>cotizaciones</b>. Y a los albaranes como <b>remitos</b>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</form>
<?php }elseif( $fsc->step==4 ){ ?>

<form name="f_empresa" action="<?php echo $fsc->page->url();?>" method="post" class="form" role="form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>
                        <span class="glyphicon glyphicon-edit"></span>
                        Datos de facturación
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <a href="<?php echo $fsc->ejercicio->url();?>">Ejercicio contable</a>:
                    <select name="codejercicio" class="form-control" autofocus >
                        <?php $loop_var1=$fsc->ejercicio->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1->codejercicio;?>"<?php if( $fsc->empresa->codejercicio == $value1->codejercicio ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                        <?php } ?>

                    </select>
                    <p class="help-block">Sólo sirve para inicializar algunos campos.</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <a href="<?php echo $fsc->serie->url();?>" class="text-capitalize"><?php  echo FS_SERIE;?></a>:
                    <select name="codserie" class="form-control">
                        <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1->codserie;?>"<?php if( $fsc->empresa->codserie == $value1->codserie ){ ?> selected=""<?php } ?>><?php echo $value1->descripcion;?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>
            <?php if( $fsc->empresa->codpais=='ECU' or $fsc->empresa->codpais=='EC' ){ ?>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php  echo FS_IRPF;?>:
                    <input type="number" name="irpf_serie" value="<?php echo $fsc->irpf;?>" step="any" class="form-control"/>
                </div>
            </div>
            <?php } ?>

        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    Algoritmo de nuevo código:
                    <select name="new_codigo" class="form-control">
                        <option value="eneboo"<?php if( $GLOBALS['config2']['new_codigo']=='eneboo' ){ ?> selected=''<?php } ?>>Compatible con Eneboo</option>
                        <option value="new"<?php if( $GLOBALS['config2']['new_codigo']=='new' ){ ?> selected=''<?php } ?>>TIPO + EJERCICIO + <?php echo strtoupper(FS_SERIE); ?> + NÚMERO</option>
                        <option value="0-NUM"<?php if( $GLOBALS['config2']['new_codigo']=='0-NUM' ){ ?> selected=''<?php } ?>>Número continuo (con 0s)</option>
                        <option value="NUM"<?php if( $GLOBALS['config2']['new_codigo']=='NUM' ){ ?> selected=''<?php } ?>>Número continuo</option>
                        <option value="SERIE-YY-0-NUM"<?php if( $GLOBALS['config2']['new_codigo']=='SERIE-YY-0-NUM' ){ ?> selected=''<?php } ?>><?php echo strtoupper(FS_SERIE); ?> + AÑO (2 díg.) + NÚMERO (con 0s)</option>
                        <option value="SERIE-YY-0-NUM-CORTO"<?php if( $GLOBALS['config2']['new_codigo']=='SERIE-YY-0-NUM-CORTO' ){ ?> selected=''<?php } ?>><?php echo strtoupper(FS_SERIE); ?> + AÑO (2 díg.) + NÚMERO (mín. 4 car.)</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago predeterminada</a>:
                    <select name="codpago" class="form-control">
                        <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1->codpago;?>"<?php if( $fsc->empresa->codpago == $value1->codpago ){ ?> selected=""<?php } ?>><?php echo $value1->descripcion;?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <a href="<?php echo $fsc->almacen->url();?>">Almacén principal</a>:
                    <select name="codalmacen" class="form-control">
                        <?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1->codalmacen;?>"<?php if( $fsc->empresa->codalmacen == $value1->codalmacen ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="contintegrada" value="TRUE"<?php if( $fsc->empresa->contintegrada ){ ?> checked="checked"<?php } ?>/>
                        Contabilidad integrada: conforme haces facturas se generan los asientos contables.
                    </label>
                </div>
                <?php if( $fsc->empresa->codpais=='ECU' or $fsc->empresa->codpais=='EC' ){ ?>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="recequivalencia" value="TRUE"<?php if( $fsc->empresa->recequivalencia ){ ?> checked="checked"<?php } ?>/>
                        Aplicar recargo de equivalencia (R.E.) a tus compras.
                    </label>
                </div>
                <?php } ?>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-right">
                <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled = true;this.form.submit();">
                    <span class="glyphicon glyphicon-ok"></span>&nbsp; Continuar
                </button>
            </div>
        </div>
    </div>
</form>
<?php }elseif( $fsc->step==5 ){ ?>

<div class="container-fluid">
    <?php if( $fsc->empresa->codpais=='ECU' or $fsc->empresa->codpais=='EC' ){ ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <h1>
                    Fin
                    <a href="<?php echo $fsc->url();?>&restart=TRUE" class="btn btn-xs btn-warning" title="Volver a empezar">
                        <span class="glyphicon glyphicon-fast-backward"></span>
                    </a>
                </h1>
                <p class="help-block">
                    Ya has terminado la configuración del plugin. Si quieres hacer cambios
                    en la configuración de la empresa, puedes ir a <b>Admin &gt; Empresa</b>
                    en cualquier momento.
                </p>
            </div>
            <?php if( $fsc->empresa->contintegrada ){ ?>

            <p class="help-block">
                Ahora es el momento de importar el plan contable, si todavía no lo has hecho.
            </p>
            <a href="index.php?page=contabilidad_ejercicio&cod=<?php echo $fsc->empresa->codejercicio;?>" target="_blank" class="btn btn-sm btn-primary">
                <span class="glyphicon glyphicon-import"></span>&nbsp;
                importar los datos contables
            </a>
            <?php } ?>

        </div>
    </div>
    <?php }else{ ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <h1>
                    <span class="glyphicon glyphicon-map-marker"></span>&nbsp;
                    Fin
                    <a href="<?php echo $fsc->url();?>&restart=TRUE" class="btn btn-xs btn-warning" title="Volver a empezar">
                        <span class="glyphicon glyphicon-fast-backward"></span>
                    </a>
                </h1>
                <p class="help-block">
                    Ahora es el momento de instalar el plugin específico para tu pais.
                </p>
            </div>
        </div>
    </div>
    
        <div class="col-sm-3">
            <a href="index.php?page=admin_home&download=ecuador#plugins" class="btn btn-sm btn-block btn-default">
                <span class="glyphicon glyphicon-download-alt"></span>&nbsp; Ecuador
            </a>
            <br/>
        </div>
        
    </div>
    <?php } ?>

    <div class="row">
        <div class="col-sm-12">
            <br/>
            <div class="page-header">
                <h2>
                    <span class="glyphicon glyphicon-info-sign"></span> Te puede interesar...
                </h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <a href="index.php?page=dashboard" class="btn btn-block btn-default">
                <i class="fa fa-desktop fa-3x" aria-hidden="true"></i>
                <br/>Inicio
            </a>
            <p class="help-block">
                Página de inicio: resumen de compras, ventas, impuestos, beneficios...
            </p>
            <br/>
        </div>
       <div class="col-sm-3">
            <a href="index.php?page=admin_home#descargas" target="_blank" class="btn btn-block btn-default">
                <i class="fa fa-puzzle-piece fa-3x" aria-hidden="true"></i>
                <br/>Plugins
            </a>
            <p class="help-block">
                Revisar la lista de plugins disponibles en la sección
                Para verificar que este activado el Loging de Ecuador
                En caso de no estarlo activarlo.
            </p>
            <br/>
        </div>
    </div>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>