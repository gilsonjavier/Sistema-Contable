<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es" >
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title><?php if( $fsc->empresa->nombrecorto ){ ?><?php echo $fsc->empresa->nombrecorto;?><?php }else{ ?><?php echo $fsc->empresa->nombre;?><?php } ?></title>
   <meta name="description" content="FacturaScripts es un software de facturación y contabilidad para pymes. Es software libre bajo licencia GNU/LGPL." />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <meta name="generator" content="FacturaScripts" />
   <?php if( file_exists('images/favicon.ico') ){ ?>

   <link rel="shortcut icon" href="<?php  echo FS_PATH;?>images/favicon.ico" />
   <?php }else{ ?>

   <link rel="shortcut icon" href="<?php  echo FS_PATH;?>view/img/favicon.ico" />
   <?php } ?>

   <link rel="stylesheet" href="<?php  echo FS_PATH;?>view/css/bootstrap-yeti.min.css" />
   <link rel="stylesheet" href="<?php  echo FS_PATH;?>view/css/font-awesome.min.css" />
   <link rel="stylesheet" href="<?php  echo FS_PATH;?>view/css/custom.css" />
   <script type="text/javascript" src="<?php  echo FS_PATH;?>view/js/jquery.min.js"></script>
   <script type="text/javascript" src="<?php  echo FS_PATH;?>view/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php  echo FS_PATH;?>view/js/jquery.ui.shake.js"></script>
   <script type="text/javascript">
      <?php if( FS_DEMO ){ ?>

         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
         ga('create', 'UA-417932-8', 'auto');
         ga('send', 'pageview');
      <?php } ?>

      $(document).ready(function() {
         <?php if( $fsc->get_errors() ){ ?>

         $("#box_login").shake();
         <?php } ?>

         
         <?php if( FS_DEMO ){ ?>

         document.f_login.user.focus();
         <?php }else{ ?>

         document.f_login.password.focus();
         <?php } ?>

         
         $("#b_feedback").click(function(event) {
            event.preventDefault();
            $("#modal_feedback").modal('show');
            document.f_feedback.feedback_text.focus();
         });
         $("#b_new_password").click(function(event) {
            event.preventDefault();
            $("#modal_new_password").modal('show');
            document.f_new_password.new_password.focus();
         });
      });
   </script>
</head>
<body>
   <nav class="navbar navbar-default" role="navigation" style="margin: 0px;">
      <div class="container-fluid">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#fs-navbar-collapse-1">
               <span class="sr-only">Menú</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
               <i class="fa fa-lock" aria-hidden="true"></i>&nbsp;
               <?php if( FS_DEMO ){ ?>DEMO FacturaScripts<?php }elseif( $fsc->empresa->nombrecorto ){ ?><?php echo $fsc->empresa->nombrecorto;?><?php }else{ ?><?php echo $fsc->empresa->nombre;?><?php } ?>

            </a>
         </div>
      </div>
   </nav>
   
   <?php if( $fsc->get_errors() ){ ?>

   <div class="alert alert-danger">
      <ul><?php $loop_var1=$fsc->get_errors(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
   </div>
   <?php } ?>

   <?php if( $fsc->get_messages() ){ ?>

   <div class="alert alert-success">
      <ul><?php $loop_var1=$fsc->get_messages(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
   </div>
   <?php } ?>

   <?php if( $fsc->get_advices() ){ ?>

   <div class="alert alert-info">
      <ul><?php $loop_var1=$fsc->get_advices(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
   </div>
   <?php } ?>

   
   <form name="f_login" action="index.php?nlogin=<?php echo $nlogin;?>" method="post" class="form" role="form">
      <div id="box_login" class="container">
         <div class="row">
            <div class="col-md-6 col-md-offset-3">
               <div class="page-header">
                  <h1>
                     <i class="fa fa-user" aria-hidden="true"></i>&nbsp; Iniciar sesión
                  </h1>
                  <p class="help-block">
                     <?php if( FS_DEMO ){ ?>

                     Bienvenido a la demo de FacturaScripts, escribe tu email para continuar:
                     <?php }else{ ?>

                     Debes seleccionar tu usuario e introducir la contraseña para acceder al sistema.
                     <?php } ?>

                  </p>
               </div>
               <div class="well well-sm">
                  <br/>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-4 col-md-5">
                           <div class="thumbnail hidden-xs">
                              <?php if( FS_DEMO ){ ?>

                              <img src="<?php  echo FS_PATH;?>view/img/logo.png" alt="logo"/>
                              <?php }elseif( file_exists(FS_MYDOCS.'images/logo.png') ){ ?>

                              <img src="images/logo.png" alt="<?php echo $fsc->empresa->nombre;?>"/>
                              <?php }elseif( file_exists(FS_MYDOCS.'images/logo.jpg') ){ ?>

                              <img src="images/logo.jpg" alt="<?php echo $fsc->empresa->nombre;?>"/>
                              <?php }else{ ?>

                              <img src="<?php  echo FS_PATH;?>view/img/logo.png" alt="logo"/>
                              <?php } ?>

                           </div>
                        </div>
                        <div class="col-sm-8 col-md-7">
                           <?php if( FS_DEMO ){ ?>

                           <input type="hidden" name="password" value="demo"/>
                           <div class="form-group">
                              <input type="text" name="user" class="form-control input-lg" placeholder="Escribe tu email" required="" autocomplete="off"/>
                           </div>
                           <?php }else{ ?>

                           <div class="form-group">
                              <select name="user" class="form-control input-lg" onchange="document.f_login.password.focus()">
                              <?php $loop_var1=$fsc->user->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <?php if( $value1->nick == $nlogin ){ ?>

                                 <option value="<?php echo $value1->nick;?>" selected=""><?php echo $value1->nick;?></option>
                                 <?php }else{ ?>

                                 <option value="<?php echo $value1->nick;?>"><?php echo $value1->nick;?></option>
                                 <?php } ?>

                              <?php } ?>

                              </select>
                           </div>
                           <div class="form-group">
                              <input type="password" name="password" class="form-control input-lg" maxlength="32" required="" placeholder="Contraseña"/>
                              <p class="help-block">
                                 <a href="#" id="b_new_password">¿Has olvidado la contraseña?</a>
                              </p>
                           </div>
                           <?php } ?>

                           <button class="btn btn-block btn-primary" type="submit" id="login">
                              <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp; Iniciar sesión
                           </button>
                        </div>
                     </div>
                  </div>
                  <br/>
               </div>
            </div>
         </div>
      </div>
   </form>
   
   <div class="visible-md visible-lg" style="margin-bottom: 100px;"></div>
   
   <?php if( !FS_DEMO ){ ?>

   <div class="modal" id="modal_new_password">
      <div class="modal-dialog">
         <div class="modal-content">
            <form name="f_new_password" action="index.php" method="post" class="form" role="form">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                     <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                  </button>
                  <h4 class="modal-title">¿Has olvidado la contraseña?</h4>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <label>Usuario</label>
                     <select name="user" class="form-control">
                     <?php $loop_var1=$fsc->user->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1->nick == $nlogin ){ ?>

                        <option value="<?php echo $value1->nick;?>" selected=""><?php echo $value1->nick;?></option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1->nick;?>"><?php echo $value1->nick;?></option>
                        <?php } ?>

                     <?php } ?>

                     </select>
                  </div>
                  <div class="form-group">
                     <label>Nueva contraseña</label>
                     <input type="password" class="form-control" name="new_password" maxlength="32" placeholder="Nueva contraseña" required=""/>
                     <input type="password" class="form-control" name="new_password2" maxlength="32" placeholder="Repite la nueva contraseña" required=""/>
                  </div>
                  <div class="form-group">
                     <label>Contraseña de la base de datos</label>
                     <input type="password" class="form-control" name="db_password" placeholder="Contraseña de la base de datos"/>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-sm btn-warning">
                     <i class="fa fa-wrench" aria-hidden="true"></i>&nbsp; Cambiar
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <?php } ?>

   
   <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("feedback") . ( substr("feedback",-1,1) != "/" ? "/" : "" ) . basename("feedback") );?>

   
   <?php if( FS_DB_HISTORY ){ ?>

   <hr style="margin-top: 50px;"/>
   <div class="container-fluid" style="margin-bottom: 10px;">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title">Consultas SQL:</h3>
               </div>
               <div class="panel-body">
                  <ol style="font-size: 11px; margin: 0px; padding: 0px 0px 0px 20px;">
                  <?php $loop_var1=$fsc->get_db_history(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?>

                  </ol>
               </div>
            </div>
         </div>
      </div>
   </div>
   <br/>
   <br/>
   <?php } ?>

</body>
</html>