<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es" >
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title><?php echo $fsc->page->title;?> &lsaquo; <?php if( $fsc->empresa->nombrecorto ){ ?><?php echo $fsc->empresa->nombrecorto;?><?php }else{ ?><?php echo $fsc->empresa->nombre;?><?php } ?></title>
   <meta name="description" content="FacturaScripts es un software de facturación y contabilidad para pymes. Es software libre bajo licencia GNU/LGPL." />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <meta name="generator" content="FacturaScripts" />
   <?php if( file_exists('images/favicon.ico') ){ ?>

   <link rel="shortcut icon" href="<?php  echo FS_PATH;?>images/favicon.ico" />
   <?php }else{ ?>

   <link rel="shortcut icon" href="<?php  echo FS_PATH;?>view/img/favicon.ico" />
   <?php } ?>

   <link rel="stylesheet" href="<?php  echo FS_PATH;?><?php echo $fsc->user->css;?>" />
   <link rel="stylesheet" href="<?php  echo FS_PATH;?>view/css/font-awesome.min.css" />
   <link rel="stylesheet" href="<?php  echo FS_PATH;?>view/css/datepicker.css" />
   <link rel="stylesheet" href="<?php  echo FS_PATH;?>view/css/custom.css?updated=<?php echo $fsc->today();?>" />
   <script type="text/javascript" src="<?php  echo FS_PATH;?>view/js/jquery.min.js"></script>
   <script type="text/javascript" src="<?php  echo FS_PATH;?>view/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php  echo FS_PATH;?>view/js/bootstrap-datepicker.js" charset="UTF-8"></script>
   <script type="text/javascript" src="<?php  echo FS_PATH;?>view/js/jquery.autocomplete.min.js"></script>
   <script type="text/javascript" src="<?php  echo FS_PATH;?>view/js/jquery-ui.min.js"></script>
   <script type="text/javascript" src="<?php  echo FS_PATH;?>view/js/bootbox.min.js"></script>
   <script type="text/javascript" src="<?php echo $fsc->get_js_location('base.js');?>"></script>
   <script type="text/javascript" src="<?php echo $fsc->get_js_location('validaciones.js');?>"></script>
   <script type="text/javascript">
      bootbox.setLocale("es");
      
      function show_precio(precio, coddivisa)
      {
         coddivisa || ( coddivisa = '<?php echo $fsc->empresa->coddivisa;?>' );
         
         if(coddivisa == '<?php echo $fsc->empresa->coddivisa;?>')
         {
            <?php if( FS_POS_DIVISA=='right' ){ ?>

            return number_format(precio, <?php  echo FS_NF0;?>, '<?php  echo FS_NF1;?>', '<?php  echo FS_NF2;?>')+' <?php echo $fsc->simbolo_divisa();?>';
            <?php }else{ ?>

            return '<?php echo $fsc->simbolo_divisa();?>'+number_format(precio, <?php  echo FS_NF0;?>, '<?php  echo FS_NF1;?>', '<?php  echo FS_NF2;?>');
            <?php } ?>

         }
         else
         {
            return number_format(precio, <?php  echo FS_NF0;?>, '<?php  echo FS_NF1;?>', '<?php  echo FS_NF2;?>');
         }
      }
      function show_numero(numero)
      {
         return number_format(numero, <?php  echo FS_NF0;?>, '<?php  echo FS_NF1;?>', '<?php  echo FS_NF2;?>');
      }
   </script>
   <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <?php if( $value1->type=='head' ){ ?><?php echo $value1->text;?><?php } ?>

   <?php } ?>

</head>
<body>
   <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#fs-navbar-collapse-1">
               <span class="sr-only">Menú</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
               <i class="fa fa-home" aria-hidden="true"></i>&nbsp;
               <span class="hidden-sm"><?php if( FS_DEMO ){ ?>DEMO<?php }elseif( $fsc->empresa->nombrecorto ){ ?><?php echo $fsc->empresa->nombrecorto;?><?php }else{ ?><?php echo $fsc->empresa->nombre;?><?php } ?></span>
            </a>
         </div>
         
         <div class="collapse navbar-collapse" id="fs-navbar-collapse-1">
            <ul class="nav navbar-nav">
               <?php $loop_var1=$fsc->folders(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <li class='dropdown<?php if( $value1==$fsc->page->folder ){ ?> active<?php } ?>'>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                     <?php if( $value1=='admin' ){ ?>

                     <i class="fa fa-wrench hidden-xs" aria-hidden="true" title="Administración"></i>
                     <span class="text-capitalize visible-xs"><?php echo $value1;?></span>
                     <?php }else{ ?>

                     <span class="text-capitalize"><?php echo $value1;?></span>
                     <?php } ?>

                  </a>
                  <ul class="dropdown-menu">
                     <?php $loop_var2=$fsc->pages($value1); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                     <li<?php if( $value2->showing() ){ ?> class="active"<?php } ?>><a href="<?php echo $value2->url();?>"><?php echo $value2->title;?></a></li>
                     <?php } ?>

                  </ul>
               </li>
               <?php } ?>

               <?php if( count($GLOBALS['plugins'])>0 ){ ?>

               <li class="dropdown hidden-sm">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="Acceso rápido">
                     <i class="fa fa-star hidden-xs" aria-hidden="true"></i>
                     <span class="visible-xs">Acceso rápido</span>
                  </a>
                  <ul class="dropdown-menu">
                     <?php $menu_ar_vacio=$this->var['menu_ar_vacio']=TRUE;?>

                     <?php $loop_var1=$fsc->user->get_menu(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->important ){ ?>

                        <li><a href="<?php echo $value1->url();?>"><?php echo $value1->title;?></a></li>
                        <?php $menu_ar_vacio=$this->var['menu_ar_vacio']=FALSE;?>

                        <?php } ?>

                     <?php } ?>

                     <?php if( $menu_ar_vacio ){ ?>

                     <li><a href="#">Vacío</a></li>
                     <?php } ?>

                  </ul>
               </li>
               <?php } ?>

            </ul>
            
            <ul class="nav navbar-nav navbar-right">
               <?php if( $fsc->check_for_updates() ){ ?>

               
               <?php } ?>

               
               <?php if( $fsc->get_last_changes() ){ ?>

               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-clock-o hidden-xs" aria-hidden="true"></i>
                     <span class="visible-xs">Historial</span>
                  </a>
                  <ul class="dropdown-menu">
                  <?php $loop_var1=$fsc->get_last_changes(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1['nuevo'] ){ ?>

                     <li title="creado el <?php echo $value1['cambio'];?>">
                        <a href="<?php echo $value1['url'];?>">
                           <i class="fa fa-file" aria-hidden="true"></i>&nbsp; <?php echo $value1['texto'];?>

                        </a>
                     </li>
                     <?php }else{ ?>

                     <li title="modificado el <?php echo $value1['cambio'];?>">
                        <a href="<?php echo $value1['url'];?>">
                           <i class="fa fa-edit" aria-hidden="true"></i>&nbsp; <?php echo $value1['texto'];?>

                        </a>
                     </li>
                     <?php } ?>

                  <?php } ?>

                  </ul>
               </li>
               <?php } ?>

               
               
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo $fsc->user->nick;?>">
                     <i class="fa fa-user-circle hidden-xs" aria-hidden="true"></i>
                     <span class="visible-xs">Usuario</span>
                  </a>
                  <ul class="dropdown-menu">
                     <li>
                        <a href="<?php echo $fsc->user->url();?>">
                           <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp; <?php echo $fsc->user->nick;?>

                        </a>
                     </li>
                     <li class="divider"></li>
                     <li>
                        <a href="<?php echo $fsc->url();?>&logout=TRUE">
                           <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp; Cerrar sesión
                        </a>
                     </li>
                  </ul>
               </li>
            </ul>
         </div>
      </div>
   </nav>
   
   <?php if( $fsc->user->css=='view/css/bootstrap-yeti.min.css' ){ ?>

   <div style="margin-bottom: 55px"></div>
   <?php }else{ ?>

   <div style="margin-bottom: 70px"></div>
   <?php } ?>

   
   <?php if( $fsc->get_errors() ){ ?>

   <div class="alert alert-danger alert-dismissible hidden-print" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
      <ul><?php $loop_var1=$fsc->get_errors(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
   </div>
   <?php } ?>

   <?php if( $fsc->get_messages() ){ ?>

   <div class="alert alert-success alert-dismissible hidden-print" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
      <ul><?php $loop_var1=$fsc->get_messages(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
   </div>
   <?php } ?>

   <?php if( $fsc->get_advices() ){ ?>

   <div class="alert alert-info alert-dismissible hidden-print" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
      <ul><?php $loop_var1=$fsc->get_advices(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
   </div>
   <?php } ?>

   
   <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("feedback") . ( substr("feedback",-1,1) != "/" ? "/" : "" ) . basename("feedback") );?>

   
   <div class="modal fade" id="modal_iframe" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title">Modal title</h4>
            </div>
            <iframe src="" width="100%" height="600">
               Este navegador no soporta frames.
            </iframe>
         </div>
      </div>
   </div>