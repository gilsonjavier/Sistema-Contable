<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   var codsubcuenta = '';
   function check_librom(cod)
   {
      $("#div_librom_"+cod).html('');
      if( $("#filtro_librom_"+cod).val() == '' )
      {
         $("#f_librom_"+cod).submit();
      }
      else
      {
         $.ajax({
            type: 'POST',
            url: '<?php echo $fsc->url();?>',
            dataType: 'html',
            data: $("#f_librom_"+cod).serialize(),
            success: function(datos) {
               $("#div_librom_"+cod).html(datos);
               $("#ac_subcuenta_"+cod).autocomplete({
                  serviceUrl: '<?php echo $fsc->url();?>&codejercicio='+cod,
                  paramName: 'buscar_subcuenta',
                  onSelect: function (suggestion) {
                     if(suggestion)
                     {
                        if(suggestion.value != codsubcuenta)
                        {
                           add_check_subcuenta(cod, suggestion);
                           codsubcuenta = suggestion.value;
                        }
                     }
                  }
               });
               $("#modal_librom_"+cod).modal('show');
               $("#modal_librom_"+cod).on('hidden.bs.modal', function () {
                  $("#div2_librom_"+cod).html('');
                  codsubcuenta = '';
               })
            }
         });
      }
   }
   function add_check_subcuenta(cod, data)
   {
      $("#div2_librom_"+cod).html( "<div class='checkbox'>\n\
<label>\n\
<input type='checkbox' name='codsubcuenta[]' value='"+data.value+"' checked=''/> <b>"+
              data.value+"</b> "+data.data+"</label></div>"+
              $("#div2_librom_"+cod).html());
   }
   $(document).ready(function() {
      if(window.location.hash)
      {
         $("#collapse_"+window.location.hash.substring(1)).collapse('show');
      }
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <span class="glyphicon glyphicon-book"></span>&nbsp; Informes contables
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
               <b>Haz clic</b> en cualquiera de los <b>ejercicios</b> para mostrar los informes.
            </p>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-12">
         <div class="panel-group" id="accordion">
         <?php $loop_var1=$fsc->ejercicio->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title clickable" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $value1->codejercicio;?>">
                     <i class="fa fa-plus-square" aria-hidden="true"></i> &nbsp; Ejercicio <?php echo $value1->nombre;?>

                     <?php if( $value1->abierto() ){ ?>

                     &nbsp; <span class="label label-default">Abierto</span>
                     <?php }else{ ?>

                     &nbsp; <span class="label label-success">Cerrado</span>
                     <?php } ?>

                  </h3>
               </div>
               <div id='collapse_<?php echo $value1->codejercicio;?>' class='panel-collapse collapse'>
                  <div class="panel-body">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-sm-4">
                              <?php if( $fsc->existe_libro_diario($value1->codejercicio) ){ ?>

                              <a href="<?php  echo FS_PATH;?>tmp/<?php  echo FS_TMP_NAME;?>libro_diario/<?php echo $value1->codejercicio;?>.pdf" target="_blank">
                                 <span class="glyphicon glyphicon-book" aria-hidden="true"></span> Libro diario
                              </a>
                              <?php }else{ ?>

                              <a href="#"><s>Libro diario</s></a>
                              <?php } ?>

                           </div>
                           <div class="col-sm-4">
                              <a href="<?php echo $fsc->url();?>&diario=<?php echo $value1->codejercicio;?>" target="_blank">
                                 <span class="glyphicon glyphicon-file" aria-hidden="true"></span> Libro diario (CSV)
                              </a>
                           </div>
                           <div class="col-sm-4">
                              <?php if( $fsc->existe_libro_inventarios($value1->codejercicio) ){ ?>

                              <a href="<?php  echo FS_PATH;?>tmp/<?php  echo FS_TMP_NAME;?>inventarios_balances/<?php echo $value1->codejercicio;?>.pdf" target="_blank">
                                 <span class="glyphicon glyphicon-book" aria-hidden="true"></span> Libro de inventarios y balances
                              </a>
                              <?php }else{ ?>

                              <a href="#"><s>Libro de inventarios y balances</s></a>
                              <?php } ?>

                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                              <h3>Libro mayor:</h3>
                              <p class="help-block">
                                 Selecciona las fechas y después los filtros: todo, grupos, epígrafes, cuentas o subcuentas.
                              </p>
                           </div>
                        </div>
                        <form id="f_librom_<?php echo $value1->codejercicio;?>" action="<?php echo $fsc->url();?>" method="post" target="_blank" class="form">
                           <input type="hidden" name="codejercicio" value="<?php echo $value1->codejercicio;?>"/>
                           <input type="hidden" name="informe" value="librom"/>
                           <div class="row">
                              <div class="col-sm-2">
                                 <div class="form-group">
                                    Desde:
                                    <input type="text" name="desde" readonly value="<?php echo $value1->fechainicio;?>" class="form-control datepicker" autocomplete="off"/>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <div class="form-group">
                                    Hasta:
                                    <input type="text" name="hasta" readonly value="<?php echo $value1->fechafin;?>" class="form-control datepicker" autocomplete="off"/>
                                 </div>
                              </div>
                              <div class="col-sm-3">
                                 <div class="form-group">
                                    Filtro:
                                    <select name="filtro" id="filtro_librom_<?php echo $value1->codejercicio;?>" class="form-control">
                                       <option value="">Todo</option>
                                       <option value="">------</option>
                                       <option value="grupo">Seleccionar grupo</option>
                                       <option value="epigrafe">Seleccionar epigrafe</option>
                                       <option value="cuenta">Seleccionar cuenta</option>
                                       <option value="subcuenta">Seleccionar subcuenta</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <div class="form-group">
                                    Formato:
                                    <select name="formato" class="form-control">
                                       <option value="csv">CSV</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <br/>
                                 <button type="button" class="btn btn-sm btn-primary" onclick="check_librom('<?php echo $value1->codejercicio;?>')">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> &nbsp; Mostrar
                                 </button>
                              </div>
                           </div>
                           <div class="modal fade" id="modal_librom_<?php echo $value1->codejercicio;?>" tabindex="-1" role="dialog">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                       <h4 class="modal-title">
                                          <span class="glyphicon glyphicon-book" aria-hidden="true"></span> &nbsp; Libro mayor...
                                       </h4>
                                    </div>
                                    <div class="modal-body">
                                       <div id="div_librom_<?php echo $value1->codejercicio;?>">...</div>
                                       <div id="div2_librom_<?php echo $value1->codejercicio;?>"></div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-sm btn-primary" onclick="this.form.submit();">
                                          <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> &nbsp; Mostrar
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
                        <div class="row">
                           <div class="col-sm-12">
                              <hr/>
                              <h3>Balance de sumas y saldos:</h3>
                              <p class="help-block">
                                 Puedes filtrar por fecha, seleccionar el tipo y el formato.
                              </p>
                           </div>
                        </div>
                        <div class="row">
                           <form action="<?php echo $fsc->url();?>" method="post" target="_blank" class="form">
                              <input type="hidden" name="codejercicio" value="<?php echo $value1->codejercicio;?>"/>
                              <input type="hidden" name="informe" value="sumasysaldos"/>
                              <div class="col-sm-2">
                                 <div class="form-group">
                                    Desde:
                                    <input type="text" name="desde" readonly value="<?php echo $value1->fechainicio;?>" class="form-control datepicker" autocomplete="off"/>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <div class="form-group">
                                    Hasta:
                                    <input type="text" name="hasta" readonly value="<?php echo $value1->fechafin;?>" class="form-control datepicker" autocomplete="off"/>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <div class="form-group">
                                    Tipo:
                                    <select name="tipo" class="form-control">
                                       <option value="3">3 dígitos</option>
                                       <option value="normal">Normal</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <div class="form-group">
                                    Formato:
                                    <select name="formato" class="form-control">
                                       <option value="pdf">PDF</option>
                                       <option value="csv">CSV</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <br/>
                                 <button type="submit" class="btn btn-sm btn-primary">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> &nbsp; Mostrar
                                 </button>
                              </div>
                           </form>
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                              <hr/>
                              <h3>Balance de situación:</h3>
                              <p class="help-block">
                                 Puedes filtrar por fecha o bien visualizar el
                                 <a href="<?php echo $fsc->url();?>&balance=sit&eje=<?php echo $value1->codejercicio;?>" target="_blank">balance <b>comparativo</b> con el año anterior</a>.
                                 Si deseas modificar las cuentas a incluir, puedes <a href="index.php?page=editar_balances" target="_blank">editar los balances</a>.
                              </p>
                           </div>
                        </div>
                        <div class="row">
                           <form action="<?php echo $fsc->url();?>" method="post" target="_blank" class="form">
                              <input type="hidden" name="codejercicio" value="<?php echo $value1->codejercicio;?>"/>
                              <input type="hidden" name="informe" value="situacion"/>
                              <div class="col-sm-2">
                                 <div class="form-group">
                                    Desde:
                                    <input type="text" name="desde" readonly value="<?php echo $value1->fechainicio;?>" class="form-control datepicker" autocomplete="off"/>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <div class="form-group">
                                    Hasta:
                                    <input type="text" name="hasta" readonly value="<?php echo $value1->fechafin;?>" class="form-control datepicker" autocomplete="off"/>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <br/>
                                 <button type="submit" class="btn btn-sm btn-primary">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> &nbsp; Mostrar
                                 </button>
                              </div>
                           </form>
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                              <hr/>
                              <h3>Balance de pérdidas y ganancias:</h3>
                              <p class="help-block">
                                 Puedes filtrar por fecha o bien visualizar el
                                 <a href="<?php echo $fsc->url();?>&balance=pyg&eje=<?php echo $value1->codejercicio;?>" target="_blank">balance <b>comparativo</b> con el año anterior</a>.
                                 Si deseas modificar las cuentas a incluir, puedes <a href="index.php?page=editar_balances" target="_blank">editar los balances</a>.
                              </p>
                           </div>
                        </div>
                        <div class="row">
                           <form action="<?php echo $fsc->url();?>" method="post" target="_blank" class="form">
                              <input type="hidden" name="codejercicio" value="<?php echo $value1->codejercicio;?>"/>
                              <input type="hidden" name="informe" value="perdidasyg"/>
                              <div class="col-sm-2">
                                 <div class="form-group">
                                    Desde:
                                    <input type="text" name="desde" readonly value="<?php echo $value1->fechainicio;?>" class="form-control datepicker" autocomplete="off"/>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <div class="form-group">
                                    Hasta:
                                    <input type="text" name="hasta" readonly value="<?php echo $value1->fechafin;?>" class="form-control datepicker" autocomplete="off"/>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <br/>
                                 <button type="submit" class="btn btn-sm btn-primary">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> &nbsp; Mostrar
                                 </button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php } ?>

         </div>
      </div>
   </div>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>