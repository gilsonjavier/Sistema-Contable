<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function buscar_subcuentas()
   {
      if(document.f_buscar_subcuentas.query.value == '')
      {
         $("#subcuentas").html('');
      }
      else
      {
         var datos = 'query='+document.f_buscar_subcuentas.query.value;
         datos += "&ejercicio="+document.f_change_subcuenta.codejercicio.value;
         $.ajax({
            type: 'POST',
            url: '<?php echo $fsc->url();?>',
            dataType: 'html',
            data: datos,
            success: function(datos) {
               var re = /<!--(.*?)-->/g;
               var m = re.exec( datos );
               if( m[1] == document.f_buscar_subcuentas.query.value )
               {
                  $("#subcuentas").html(datos);
               }
            }
         });
      }
   }
   function select_subcuenta(id,ejercicio,subcuenta,descripcion,debe,haber,saldo)
   {
      document.f_change_subcuenta.idsc2.value = id;
      document.f_change_subcuenta.codejercicio.value = ejercicio;
      document.f_change_subcuenta.codsubcuenta.value = subcuenta;
      document.f_change_subcuenta.descripcion.value = Base64.decode(descripcion);
      document.f_change_subcuenta.debe.value = debe;
      document.f_change_subcuenta.haber.value = haber;
      document.f_change_subcuenta.saldo.value = saldo;
      $("#modal_subcuentas").modal('hide');
   }
   $(document).ready(function() {
      $("#b_nueva_subcuenta").click(function() {
         $("#modal_nueva_subcuenta").modal('show');
         document.f_nueva_subcuenta.cuenta.focus();
      });
      $("#codsubcuenta").click(function() {
         $("#subcuentas").html('');
         document.f_buscar_subcuentas.query.value = '';
         $("#modal_subcuentas").modal('show');
         document.f_buscar_subcuentas.query.focus();
      });
      $("#f_buscar_subcuentas").submit(function(event) {
         event.preventDefault();
         buscar_subcuentas();
      });
   });
</script>

<form id="f_buscar_subcuentas" name="f_buscar_subcuentas" class="form">
   <input type="hidden" name="codejercicio" value="<?php echo $fsc->codejercicio;?>"/>
   <div class="modal" id="modal_subcuentas">
      <div class="modal-dialog" style="width: 99%; max-width: 950px;">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Buscar subcuentas</h4>
            </div>
            <div class="modal-body">
               <div class="input-group">
                  <input class="form-control" type="text" name="query" onkeyup="buscar_subcuentas();" autocomplete="off"/>
                  <span class="input-group-btn">
                     <button class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                     </button>
                  </span>
               </div>
            </div>
            <div id="subcuentas"></div>
         </div>
      </div>
   </div>
</form>

<form id="f_nueva_subcuenta" name="f_nueva_subcuenta" class="form" action="<?php echo $fsc->url();?>" method="post">
   <input type="hidden" name="codejercicio" value="<?php echo $fsc->codejercicio;?>"/>
   <?php if( $fsc->tipo == 'cli' ){ ?>

   <input type="hidden" name="cli" value="<?php echo $fsc->cliente->codcliente;?>"/>
   <?php }elseif( $fsc->tipo == 'pro' ){ ?>

   <input type="hidden" name="pro" value="<?php echo $fsc->proveedor->codproveedor;?>"/>
   <?php } ?>

   <div class="modal" id="modal_nueva_subcuenta">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nueva subcuenta</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Cuenta a la que pertenece:
                  <select class="form-control" name="cuenta">
                     <?php $loop_var1=$fsc->cuenta->full_from_ejercicio($fsc->codejercicio); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <option value="<?php echo $value1->idcuenta;?>"><?php echo $value1->codcuenta;?> <?php echo $value1->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="">¡No hay cuentas!</option>
                     <?php } ?>

                  </select>
               </div>
               <div class="form-group">
                  Código de la nueva subcuenta:
                  <input class="form-control" type="text" name="codsubcuenta" autocomplete="off"/>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
                  &nbsp; Guardar y asignar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>

<?php if( $fsc->tipo == 'cli' ){ ?>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <h3>
            <span class="glyphicon glyphicon-book"></span>
            Subcuenta asignada para el cliente <a href="<?php echo $fsc->cliente->url();?>"><?php echo $fsc->cliente->nombre;?></a>
            para el ejercicio <small><?php echo $fsc->codejercicio;?></small>
         </h3>
      </div>
   </div>
</div>

<form name="f_change_subcuenta" action="<?php echo $fsc->url();?>" method="post" class="form">
   <input type="hidden" name="cli" value="<?php echo $fsc->cliente->codcliente;?>"/>
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left">Ejercicio</th>
               <th></th>
               <th class="text-left">Subcuenta</th>
               <th class="text-left">Descripción</th>
               <th class="text-right">Debe</th>
               <th class="text-right">Haber</th>
               <th class="text-right">Saldo</th>
               <th></th>
            </tr>
         </thead>
         <?php if( $fsc->subcuenta ){ ?>

         <tr>
            <td>
               <input class="form-control" type="text" name="codejercicio" value="<?php echo $fsc->subcuenta->codejercicio;?>" disabled="disabled"/>
            </td>
            <td class="text-right">
               <a id="b_nueva_subcuenta" class="btn btn-sm btn-success" href="#" title="Crear y asignar una subcuenta...">
                  <span class="glyphicon glyphicon-plus"></span>
               </a>
            </td>
            <td>
               <input type="hidden" name="idsc" value="<?php echo $fsc->subcuenta->idsubcuenta;?>"/>
               <input type="hidden" name="idsc2" value="<?php echo $fsc->subcuenta->idsubcuenta;?>"/>
               <input id="codsubcuenta" class="form-control" type="text" name="subcuenta" value="<?php echo $fsc->subcuenta->codsubcuenta;?>"/>
            </td>
            <td>
               <input class="form-control" type="text" name="descripcion" value="<?php echo $fsc->subcuenta->descripcion;?>" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="debe" value="<?php echo $fsc->subcuenta->debe;?>" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="haber" value="<?php echo $fsc->subcuenta->haber;?>" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="saldo" value="<?php echo $fsc->subcuenta->saldo;?>" disabled="disabled"/>
            </td>
            <td class="text-right">
               <div class="btn-group">
                  <a href="<?php echo $fsc->url();?>&delete_sca=<?php echo $fsc->subcuenta_a->id;?>" class="btn btn-sm btn-danger" title="Quitar">
                     <span class="glyphicon glyphicon-trash"></span>
                  </a>
                  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Guardar">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                  </button>
               </div>
            </td>
         </tr>
         <?php }else{ ?>

         <tr>
            <td>
               <input class="form-control" type="text" name="codejercicio" value="<?php echo $fsc->codejercicio;?>" disabled="disabled"/>
            </td>
            <td class="text-right">
               <a id="b_nueva_subcuenta" class="btn btn-sm btn-success" href="#" title="Crear y asignar una subcuenta...">
                  <span class="glyphicon glyphicon-plus"></span>
               </a>
            </td>
            <td>
               <input type="hidden" name="idsc2"/>
               <input id="codsubcuenta" class="form-control" type="text" name="subcuenta"/>
            </td>
            <td>
               <input class="form-control" type="text" name="descripcion" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="debe" value="0" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="haber" value="0" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="saldo" value="0" disabled="disabled"/>
            </td>
            <td class="text-right">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Guardar">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
               </button>
            </td>
         </tr>
         <?php } ?>

      </table>
   </div>
</form>
<?php }elseif( $fsc->tipo == 'pro' ){ ?>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <h3>
            <span class="glyphicon glyphicon-book"></span>
            Subcuenta asignada para el proveedor <a href="<?php echo $fsc->proveedor->url();?>"><?php echo $fsc->proveedor->nombre;?></a>
            para el ejercicio <small><?php echo $fsc->codejercicio;?></small>
         </h3>
      </div>
   </div>
</div>

<form name="f_change_subcuenta" action="<?php echo $fsc->url();?>" method="post" class="form">
   <input type="hidden" name="pro" value="<?php echo $fsc->proveedor->codproveedor;?>"/>
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left">Ejercicio</th>
               <th></th>
               <th class="text-left">Subcuenta</th>
               <th class="text-left">Descripción</th>
               <th class="text-right">Debe</th>
               <th class="text-right">Haber</th>
               <th class="text-right">Saldo</th>
               <th></th>
            </tr>
         </thead>
         <?php if( $fsc->subcuenta ){ ?>

         <tr>
            <td>
               <input class="form-control" type="text" name="codejercicio" value="<?php echo $fsc->subcuenta->codejercicio;?>" disabled="disabled"/>
            </td>
            <td class="text-right">
               <a id="b_nueva_subcuenta" class="btn btn-sm btn-success" href="#" title="Crear y asignar una subcuenta...">
                  <span class="glyphicon glyphicon-plus"></span>
               </a>
            </td>
            <td>
               <input type="hidden" name="idsc" value="<?php echo $fsc->subcuenta->idsubcuenta;?>"/>
               <input type="hidden" name="idsc2" value="<?php echo $fsc->subcuenta->idsubcuenta;?>"/>
               <input id="codsubcuenta" class="form-control" type="text" name="subcuenta" value="<?php echo $fsc->subcuenta->codsubcuenta;?>"/>
            </td>
            <td>
               <input class="form-control" type="text" name="descripcion" value="<?php echo $fsc->subcuenta->descripcion;?>" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="debe" value="<?php echo $fsc->subcuenta->debe;?>" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="haber" value="<?php echo $fsc->subcuenta->haber;?>" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="saldo" value="<?php echo $fsc->subcuenta->saldo;?>" disabled="disabled"/>
            </td>
            <td class="text-right">
               <div class="btn-group">
                  <a href="<?php echo $fsc->url();?>&delete_sca=<?php echo $fsc->subcuenta_a->id;?>" class="btn btn-sm btn-danger" title="Quitar">
                     <span class="glyphicon glyphicon-trash"></span>
                  </a>
                  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Guardar">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                  </button>
               </div>
            </td>
         </tr>
         <?php }else{ ?>

         <tr>
            <td>
               <input class="form-control" type="text" name="codejercicio" value="<?php echo $fsc->codejercicio;?>" disabled="disabled"/>
            </td>
            <td class="text-right">
               <a id="b_nueva_subcuenta" class="btn btn-sm btn-success" href="#" title="Crear y asignar una subcuenta...">
                  <span class="glyphicon glyphicon-plus"></span>
               </a>
            </td>
            <td>
               <input type="hidden" name="idsc2"/>
               <input id="codsubcuenta" class="form-control" type="text" name="subcuenta"/>
            </td>
            <td>
               <input class="form-control" type="text" name="descripcion" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="debe" value="0" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="haber" value="0" disabled="disabled"/>
            </td>
            <td>
               <input class="form-control text-right" type="text" name="saldo" value="0" disabled="disabled"/>
            </td>
            <td class="text-right">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Guardar">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
               </button>
            </td>
         </tr>
         <?php } ?>

      </table>
   </div>
</form>
<?php }else{ ?>

<div class="thumbnail">
   <img src="<?php  echo FS_PATH;?>view/img/fuuu_face.png" alt="fuuuuu"/>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>