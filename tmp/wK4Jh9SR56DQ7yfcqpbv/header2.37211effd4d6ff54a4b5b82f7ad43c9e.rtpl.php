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