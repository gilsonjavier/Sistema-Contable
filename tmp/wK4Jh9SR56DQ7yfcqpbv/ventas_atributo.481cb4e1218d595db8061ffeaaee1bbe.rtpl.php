<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
    function eliminar_valor(id)
    {
        bootbox.confirm({
            message: '¿Estas seguro de que deseas eliminar este valor?',
            title: '<b>Atención</b>',
            callback: function (result) {
                if (result) {
                    window.location.href = "<?php echo $fsc->atributo->url();?>&delete_val=" + encodeURIComponent(id);
                }
            }
        });
    }
    $(document).ready(function () {
        $("#b_eliminar_atributo").click(function (event) {
            event.preventDefault();
            bootbox.confirm({
                message: '¿Estas seguro de que deseas eliminar este atributo?',
                title: '<b>Atención</b>',
                callback: function (result) {
                    if (result) {
                        window.location.href = "<?php echo $fsc->url();?>&delete=" + encodeURIComponent("<?php echo $fsc->atributo->codatributo;?>");
                    }
                }
            });
        });
    });
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group">
                <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                    <span class="hidden-xs">&nbsp;Todos</span>
                </a>
                <a class="btn btn-sm btn-default" href="<?php echo $fsc->atributo->url();?>" title="Recargar la página">
                    <span class="glyphicon glyphicon-refresh"></span>
                </a>
            </div>
            <a class="btn btn-sm btn-success" href="<?php echo $fsc->url();?>#nuevo" title="Nuevo atributo">
                <span class="glyphicon glyphicon-plus"></span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <h1>
                    <span class="glyphicon glyphicon-edit"></span>
                    Atributo
                    <small><?php echo $fsc->atributo->codatributo;?></small>
                </h1>
                <p class="help-block">
                    Desde aquí puedes definir los valores posibles para este atributo.
                    <b>Recuerda</b> que para poder elegir los atributos de un artículo
                    debes modificar su <b>tipo</b> a <b>producto con atributos</b>.
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <form action="<?php echo $fsc->atributo->url();?>" method="post" class="form">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="nombre" value="<?php echo $fsc->atributo->nombre;?>" placeholder="Nombre del atributo" onkeypress="teclear(event);return LetrasNumeros(event)" class="form-control" autocomplete="off"/>
                </div>
                <div class="btn-group">
                    <?php if( $fsc->allow_delete ){ ?>

                    <a href="#" id="b_eliminar_atributo" class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                    <?php } ?>

                    <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled = true;
                            this.form.submit();">
                        <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                    </button>
                </div>
            </div>
        </form>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Valores <span class="badge"><?php echo count($fsc->resultados); ?></span>
                    </h3>
                </div>
                <div class="panel-body">
                    <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                    <form action="<?php echo $fsc->atributo->url();?>" method="post" class="form">
                        <input type="hidden" name="id" value="<?php echo $value1->id;?>"/>
                        <div class="form-group">
                            <div class="input-group">
                                <?php if( $fsc->allow_delete ){ ?>

                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button" title="Eliminar este valor" onclick="eliminar_valor('<?php echo $value1->id;?>')">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </span>
                                <?php } ?>

                                <input type="text" name="valor" value="<?php echo $value1->valor;?>" onkeypress="teclear(event);return LetrasNumeros(event)" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <span class="glyphicon glyphicon-floppy-disk"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                    <?php }else{ ?>

                    <div class="alert alert-warning">No hay valores creados.</div>
                    <?php } ?>

                </div>
                <div class="panel-footer">
                    <form action="<?php echo $fsc->atributo->url();?>" method="post" class="form">
                        <div class="input-group">
                            <input type="text" name="nuevo_valor" onkeypress="teclear(event);return LetrasNumeros(event)" class="form-control" placeholder="Nuevo valor..." autocomplete="off" required=""/>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <span class="glyphicon glyphicon-plus-sign"></span>
                                    <span class="hidden-xs">&nbsp;Nuevo</span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
  