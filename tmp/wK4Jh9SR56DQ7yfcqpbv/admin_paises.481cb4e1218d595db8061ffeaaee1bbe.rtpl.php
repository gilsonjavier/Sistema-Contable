<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
    function delete_pais(url) {
        bootbox.confirm({
            message: '¿Realmente desea eliminar este país?',
            title: '<b>Atención</b>',
            callback: function (result) {
                if (result) {
                    window.location.href = url;
                }
            }
        });
    }
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <h1>
                    <i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Países
                    <span class="badge"><?php echo count($fsc->resultados); ?></span>
                    <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>
                    <span class="btn-group">
                        <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->type=='button' ){ ?>

                        <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-xs btn-default"><?php echo $value1->text;?></a>
                        <?php } ?>

                        <?php } ?>

                    </span>
                </h1>
                <p class="help-block">
                    El país predeterminado es el de la empresa. Puedes cambiarlo desde
                    Admin &gt; Empresa.
                </p>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-left" width="190">
                                <a href="http://es.wikipedia.org/wiki/ISO_3166-1#C.C3.B3digos_ISO_3166-1" target="_blank">Código Alfa-3</a>
                            </th>
                            <th class="text-left" width="190">
                                <a href="http://es.wikipedia.org/wiki/ISO_3166-1#C.C3.B3digos_ISO_3166-1" target="_blank">Código Alfa-2</a>
                            </th>
                            <th class="text-left">Nombre</th>
                            <th class="text-right" width="120">Acciones</th>
                        </tr>
                    </thead>
                    <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                    <form action="<?php echo $fsc->url();?>" method="post" class="form" role="form">
                        <tr<?php if( $value1->codpais==$fsc->empresa->codpais ){ ?> class="warning"<?php } ?>>
                            <td>
                                <input type="hidden" name="scodpais" value="<?php echo $value1->codpais;?>"/>
                                <div class="form-control"><?php echo $value1->codpais;?></div>
                            </td>
                            <td><input class="form-control" type="text" name="scodiso" value="<?php echo $value1->codiso;?>" autocomplete="off"/></td>
                            <td><input class="form-control" type="text" name="snombre" value="<?php echo $value1->nombre;?>" autocomplete="off"/></td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <?php if( $fsc->allow_delete ){ ?>

                                    <?php if( $value1->codpais==$fsc->empresa->codpais ){ ?>

                                    <a class="btn btn-sm btn-warning" onclick="bootbox.alert({message: 'No puedes eliminar el pais de la empresa.', title: '<b>Atención</b>'});" title="Eliminar">
                                        <span class="glyphicon glyphicon-lock"></span>
                                    </a>
                                    <?php }else{ ?>

                                    <a class="btn btn-sm btn-danger" onclick="delete_pais('<?php echo $fsc->url();?>&delete=<?php echo $value1->codpais;?>')" title="Eliminar">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                    <?php } ?>

                                    <?php } ?>

                                    <button class="btn btn-sm btn-primary" type="submit" title="Guardar">
                                        <span class="glyphicon glyphicon-floppy-disk"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </form>
                    <?php } ?>

                    <form class="form" role="form" name="f_nuevo_pais" action ="<?php echo $fsc->url();?>" method="post">
                        <tr class="info">
                            <td><input class="form-control" type="text" name="scodpais" maxlength="20" placeholder="Nuevo código Alfa-3" autocomplete="off"/></td>
                            <td><input class="form-control" type="text" name="scodiso" placeholder="Código Alfa-2" autocomplete="off"/></td>
                            <td><input class="form-control" type="text" name="snombre" placeholder="Nuevo país..." autocomplete="off"/></td>
                            <td class="text-right">
                                <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled = true;this.form.submit();" title="Nuevo">
                                    <span class="glyphicon glyphicon-plus-sign"></span>
                                    <span class="hidden-sm">&nbsp;Nuevo</span>
                                </button>
                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>