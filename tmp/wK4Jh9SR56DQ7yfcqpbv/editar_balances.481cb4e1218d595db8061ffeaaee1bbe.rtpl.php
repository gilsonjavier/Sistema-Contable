<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <span class="glyphicon glyphicon-wrench"></span> Balances contables
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
               <a href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal_nuevo_balance">
                  <span class="glyphicon glyphicon-plus"></span> Nuevo
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
               Estos son los códigos de balance que definen cómo FacturaScripts genera
               los informes contables. Puedes hacer clic en cada uno de ellos para añadir
               o quitar cuentas.
            </p>
            <a href="#naturaleza_A" class="label label-success">A = Activo</a>
            <a href="#naturaleza_P" class="label label-info">P = Pasivo</a>
            <a href="#naturaleza_PG" class="label label-warning">PG = Pérdidas y ganancias</a>
            <a href="#naturaleza_IG" class="label label-default">IG = Ingresos y gastos</a>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th>Código</th>
                     <th>Naturaleza</th>
                     <th>Descripción</th>
                     <th>Descripción 2</th>
                     <th>Descripción 3</th>
                  </tr>
               </thead>
               <!--<?php $naturaleza=$this->var['naturaleza']='';?>-->
               <?php $loop_var1=$fsc->all_balances(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class="clickableRow" href="<?php echo $value1->url();?>">
                  <td>
                     <?php if( $value1->naturaleza!=$naturaleza ){ ?>

                     <a name="naturaleza_<?php echo $value1->naturaleza;?>"></a>
                     <!--<?php $naturaleza=$this->var['naturaleza']=$value1->naturaleza;?>-->
                     <?php } ?>

                     <a href="<?php echo $value1->url();?>"><?php echo $value1->codbalance;?></a>
                  </td>
                  <td<?php if( $value1->naturaleza=='A' ){ ?> class="success"<?php }elseif( $value1->naturaleza=='P' ){ ?> class="info"<?php }elseif( $value1->naturaleza=='PG' ){ ?> class="warning"<?php } ?>>
                     <?php echo $value1->naturaleza;?>

                  </td>
                  <td><?php echo $value1->descripcion1;?></td>
                  <td><?php echo $value1->descripcion2;?></td>
                  <td><?php echo $value1->descripcion3;?></td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="5">
                     Sin resultados. ¿Has importado el plan contable?
                  </td>
               </tr>
               <?php } ?>

            </table>
         </div>
      </div>
   </div>
</div>

<form action="<?php echo $fsc->url();?>" method="post" class="form">
   <div class="modal fade" id="modal_nuevo_balance">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nuevo balance contable</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Código:
                  <input type="text" name="ncodbalance" class="form-control" maxlength="15" required="" autocomplete="off" autofocus=""/>
               </div>
               <div class="form-group">
                  Naturaleza:
                  <select name="naturaleza" class="form-control">
                     <?php $loop_var1=$fsc->all_naturalezas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
                     <?php } ?>

                  </select>
               </div>
               <div class="form-group">
                  Descripción:
                  <input type="text" name="descripcion" class="form-control" required="" autocomplete="off"/>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-sm btn-primary">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>