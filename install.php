<?php


$nombre_archivo = "config.php";
error_reporting(E_ALL);
$errors = array();
$errors2 = array();
$db_type = 'MYSQL';
$db_host = 'localhost';
$db_port = '3306';
$db_name = 'contabilidad';
$db_user = '';

function random_string($length = 20)
{
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

function guarda_config(&$errors, $nombre_archivo)
{
    $archivo = fopen($nombre_archivo, "w");
    if ($archivo) {
        fwrite($archivo, "<?php\n");
        fwrite($archivo, "/*\n");
        fwrite($archivo, " * Configuración de la base de datos.\n");
        fwrite($archivo, " * type: postgresql o mysql (mysql está en fase experimental).\n");
        fwrite($archivo, " * host: la ip del ordenador donde está la base de datos.\n");
        fwrite($archivo, " * port: el puerto de la base de datos.\n");
        fwrite($archivo, " * name: el nombre de la base de datos.\n");
        fwrite($archivo, " * user: el usuario para conectar a la base de datos\n");
        fwrite($archivo, " * pass: la contraseña del usuario.\n");
        fwrite($archivo, " * history: TRUE si quieres ver todas las consultas que se hacen en cada página.\n");
        fwrite($archivo, " */\n");
        fwrite($archivo, "define('FS_DB_TYPE', '" . filter_input(INPUT_POST, 'db_type') . "'); /// MYSQL o POSTGRESQL\n");
        fwrite($archivo, "define('FS_DB_HOST', '" . filter_input(INPUT_POST, 'db_host') . "');\n");
        fwrite($archivo, "define('FS_DB_PORT', '" . filter_input(INPUT_POST, 'db_port') . "'); /// MYSQL -> 3306, POSTGRESQL -> 5432\n");
        fwrite($archivo, "define('FS_DB_NAME', '" . filter_input(INPUT_POST, 'db_name') . "');\n");
        fwrite($archivo, "define('FS_DB_USER', '" . filter_input(INPUT_POST, 'db_user') . "'); /// MYSQL -> root, POSTGRESQL -> postgres\n");
        fwrite($archivo, "define('FS_DB_PASS', '" . filter_input(INPUT_POST, 'db_pass') . "');\n");
        fwrite($archivo, "\n");
        fwrite($archivo, "/*\n");
        fwrite($archivo, " * Un directorio de nombre aleatorio para mejorar la seguridad del directorio temporal.\n");
        fwrite($archivo, " */\n");
        fwrite($archivo, "define('FS_TMP_NAME', '" . random_string(20) . "/');\n");
        fwrite($archivo, "\n");
        fwrite($archivo, "/*\n");
        fwrite($archivo, " * En cada ejecución muestra todas las sentencias SQL utilizadas.\n");
        fwrite($archivo, " */\n");
        fwrite($archivo, "define('FS_DB_HISTORY', FALSE);\n");
        fwrite($archivo, "\n");
        fwrite($archivo, "/*\n");
        fwrite($archivo, " * Habilita el modo demo, para pruebas.\n");
        fwrite($archivo, " * Este modo permite hacer login con cualquier usuario y la contraseña demo,\n");
        fwrite($archivo, " * además deshabilita el límite de una conexión por usuario.\n");
        fwrite($archivo, " */\n");
        fwrite($archivo, "define('FS_DEMO', FALSE);\n");
        fwrite($archivo, "\n");
        fwrite($archivo, "/*\n");
        fwrite($archivo, " * Configuración de memcache.\n");
        fwrite($archivo, " * Host: la ip del servidor donde está memcached.\n");
        fwrite($archivo, " * port: el puerto en el que se ejecuta memcached.\n");
        fwrite($archivo, " * prefix: prefijo para las claves, por si tienes varias instancias de\n");
        fwrite($archivo, " * FacturaScripts conectadas al mismo servidor memcache.\n");
        fwrite($archivo, " */\n");
        fwrite($archivo, "\n");
        fwrite($archivo, "define('FS_CACHE_HOST', '" . filter_input(INPUT_POST, 'cache_host') . "');\n");
        fwrite($archivo, "define('FS_CACHE_PORT', '" . filter_input(INPUT_POST, 'cache_port') . "');\n");
        fwrite($archivo, "define('FS_CACHE_PREFIX', '" . filter_input(INPUT_POST, 'cache_prefix') . "');\n");
        fwrite($archivo, "\n");
        fwrite($archivo, "/// caducidad (en segundos) de todas las cookies\n");
        fwrite($archivo, "define('FS_COOKIES_EXPIRE', 604800);\n");
        fwrite($archivo, "\n");
        fwrite($archivo, "/// el número de elementos a mostrar en pantalla\n");
        fwrite($archivo, "define('FS_ITEM_LIMIT', 50);\n");
        fwrite($archivo, "\n");
        fwrite($archivo, "/// desactiva el poder modificar plugins (añadir, descargar y eliminar)\n");
        fwrite($archivo, "define('FS_DISABLE_MOD_PLUGINS', FALSE);\n");
        fwrite($archivo, "\n");
        fwrite($archivo, "/// desactiva el poder añadir plugins manualmente\n");
        fwrite($archivo, "define('FS_DISABLE_ADD_PLUGINS', FALSE);\n");
        fwrite($archivo, "\n");
        fwrite($archivo, "/// desactiva el poder eliminar plugins manualmente\n");
        fwrite($archivo, "define('FS_DISABLE_RM_PLUGINS', FALSE);\n");

        if (filter_input(INPUT_POST, 'proxy_type')) {
            fwrite($archivo, "\n");
            fwrite($archivo, "define('FS_PROXY_TYPE', '" . filter_input(INPUT_POST, 'proxy_type') . "');\n");
            fwrite($archivo, "define('FS_PROXY_HOST', '" . filter_input(INPUT_POST, 'proxy_host') . "');\n");
            fwrite($archivo, "define('FS_PROXY_PORT', '" . filter_input(INPUT_POST, 'proxy_port') . "');\n");
        }

        fclose($archivo);

        header("Location: index.php");
        exit();
    } else {
        $errors[] = "permisos";
    }
}
if (file_exists('config.php')) {
    header('Location: index.php');
} else if (floatval(substr(phpversion(), 0, 3)) < 5.4) {
    $errors[] = 'php';
} else if (floatval('3,1') >= floatval('3.1')) {
    $errors[] = "floatval";
    $errors2[] = 'El separador de decimales de esta versión de PHP no es el punto,'
        . ' como sucede en las instalaciones estándar. Debes corregirlo.';
} else if (!function_exists('mb_substr')) {
    $errors[] = "mb_substr";
} else if (!extension_loaded('simplexml')) {
    $errors[] = "simplexml";
    $errors2[] = 'No se encuentra la extensión simplexml en tu instalación de PHP.'
        . ' Debes instalarla o activarla.';
    $errors2[] = 'Linux: instala el paquete <b>php-xml</b> y reinicia el Apache.';
} else if (!extension_loaded('openssl')) {
    $errors[] = "openssl";
} else if (!extension_loaded('zip')) {
    $errors[] = "ziparchive";
} else if (!is_writable(getcwd())) {
    $errors[] = "permisos";
} else if (filter_input(INPUT_POST, 'db_type')) {
    if (filter_input(INPUT_POST, 'db_type') == 'MYSQL') {
        if (class_exists('mysqli')) {
            if (filter_input(INPUT_POST, 'mysql_socket') != '') {
                ini_set('mysqli.default_socket', filter_input(INPUT_POST, 'mysql_socket'));
            }

            // Omitimos el valor del nombre de la BD porque lo comprobaremos más tarde
            $connection = @new mysqli(filter_input(INPUT_POST, 'db_host'), filter_input(INPUT_POST, 'db_user'), filter_input(INPUT_POST, 'db_pass'), "", intval(filter_input(INPUT_POST, 'db_port')));
            if ($connection->connect_error) {
                $errors[] = "db_mysql";
                $errors2[] = $connection->connect_error;
            } else {
                // Comprobamos que la BD exista, de lo contrario la creamos
                $db_selected = mysqli_select_db($connection, filter_input(INPUT_POST, 'db_name'));
                if ($db_selected) {
                    guarda_config($errors, $nombre_archivo);
                } else {
                    $sqlCrearBD = "CREATE DATABASE `" . filter_input(INPUT_POST, 'db_name') . "`;";
                    if (mysqli_query($connection, $sqlCrearBD)) {
                        guarda_config($errors, $nombre_archivo);
                    } else {
                        $errors[] = "db_mysql";
                        $errors2[] = mysqli_error($connection);
                    }
                }
            }
        } else {
            $errors[] = "db_mysql";
            $errors2[] = 'No tienes instalada la extensión de PHP para MySQL.';
        }
    } else if (filter_input(INPUT_POST, 'db_type') == 'POSTGRESQL') {
        if (function_exists('pg_connect')) {
            $connection = @pg_connect('host=' . filter_input(INPUT_POST, 'db_host')
                    . ' port=' . filter_input(INPUT_POST, 'db_port')
                    . ' user=' . filter_input(INPUT_POST, 'db_user')
                    . ' password=' . filter_input(INPUT_POST, 'db_pass'));

            if ($connection) {
                // Comprobamos que la BD exista, de lo contrario la creamos
                $connection2 = @pg_connect('host=' . filter_input(INPUT_POST, 'db_host') . ' port=' . filter_input(INPUT_POST, 'db_port') . ' dbname=' . filter_input(INPUT_POST, 'db_name')
                        . ' user=' . filter_input(INPUT_POST, 'db_user') . ' password=' . filter_input(INPUT_POST, 'db_pass'));

                if ($connection2) {
                    guarda_config($errors, $nombre_archivo);
                } else {
                    $sqlCrearBD = 'CREATE DATABASE "' . filter_input(INPUT_POST, 'db_name') . '";';
                    if (pg_query($connection, $sqlCrearBD)) {
                        guarda_config($errors, $nombre_archivo);
                    } else {
                        $errors[] = "db_postgresql";
                        $errors2[] = 'Error al crear la base de datos.';
                    }
                }
            } else {
                $errors[] = "db_postgresql";
                $errors2[] = 'No se puede conectar a la base de datos. Revisa los datos de usuario y contraseña.';
            }
        } else {
            $errors[] = "db_postgresql";
            $errors2[] = 'No tienes instalada la extensión de PHP para PostgreSQL.';
        }
    }

    $db_type = filter_input(INPUT_POST, 'db_type');
    $db_host = filter_input(INPUT_POST, 'db_host');
    $db_port = filter_input(INPUT_POST, 'db_port');
    $db_name = filter_input(INPUT_POST, 'db_name');
    $db_user = filter_input(INPUT_POST, 'db_user');
}

$system_info = 'Sistema_Contable: ' . file_get_contents('VERSION') . "\n";
$system_info .= 'os: ' . php_uname() . "\n";
$system_info .= 'php: ' . phpversion() . "\n";

if (isset($_SERVER['REQUEST_URI'])) {
    $system_info .= 'url: ' . $_SERVER['REQUEST_URI'] . "\n------";
}
foreach ($errors as $e) {
    $system_info .= "\n" . $e;
}

$system_info = str_replace('"', "'", $system_info);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Sistema_Contable</title>
        <meta name="description" content="FacturaScripts es un software de facturación y contabilidad para pymes. Es software libre bajo licencia GNU/LGPL." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="view/img/favicon.ico" />
        <link rel="stylesheet" href="view/css/bootstrap-yeti.min.css" />
        <link rel="stylesheet" href="view/css/font-awesome.min.css" />
        <link rel="stylesheet" href="view/css/datepicker.css" />
        <link rel="stylesheet" href="view/css/custom.css" />
        <script type="text/javascript" src="view/js/jquery.min.js"></script>
        <script type="text/javascript" src="view/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="view/js/bootstrap-datepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="view/js/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="view/js/base.js"></script>
        <script type="text/javascript" src="view/js/jquery.validate.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation" style="margin: 0px;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Menú</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Sistema_Contable</a>
                </div>
            </div>
        </nav>
        <script type="text/javascript">
            function change_db_type() {
                if (document.f_configuracion_inicial.db_type.value == 'POSTGRESQL') {
                    document.f_configuracion_inicial.db_port.value = '5432';
                    if (document.f_configuracion_inicial.db_user.value == '')
                    {
                        document.f_configuracion_inicial.db_user.value = 'postgres';
                    }
                    
            }
            $(document).ready(function () {
                $("#f_configuracion_inicial").validate({
                    rules: {
                        db_type: {required: false},
                        db_host: {required: true, minlength: 2},
                        db_port: {required: true, minlength: 2},
                        db_name: {required: true, minlength: 2},
                        db_user: {required: true, minlength: 2},
                        db_pass: {required: false},
                        cache_host: {required: true, minlength: 2},
                        cache_port: {required: true, minlength: 2},
                        cache_prefix: {required: false, minlength: 2}
                    },
                    messages: {
                        db_host: {
                            required: "El campo es obligatorio.",
                            minlength: $.validator.format("Requiere mínimo {0} carácteres!")
                        },
                        db_port: {
                            required: "El campo es obligatorio.",
                            minlength: $.validator.format("Requiere mínimo {0} carácteres!")
                        },
                        db_name: {
                            required: "El campo es obligatorio.",
                            minlength: $.validator.format("Requiere mínimo {0} carácteres!")
                        },
                        db_user: {
                            required: "El campo es obligatorio.",
                            minlength: $.validator.format("Requiere mínimo {0} carácteres!")
                        },
                        cache_host: {
                            required: "El campo es obligatorio.",
                            minlength: $.validator.format("Requiere mínimo {0} carácteres!")
                        },
                        cache_port: {
                            required: "El campo es obligatorio.",
                            minlength: $.validator.format("Requiere mínimo {0} carácteres!")
                        }
                    }
                });
            });
        </script>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1>
                            <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                            Bienvenido al instalador de Sistema_Contable
                        </h1>
                    </div>
                </div>
            </div>

            
            <form name="f_configuracion_inicial" id="f_configuracion_inicial" action="install.php" class="form" role="form" method="post">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#db" aria-controls="db" role="tab" data-toggle="tab">
                                    <i class="fa fa-database"></i>&nbsp;
                                    Base de datos
                                </a>
                            </li>
                        </ul>
                        <br/>
                    </div>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="db">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    Tipo de servidor SQL:
                                    <select name="db_type" class="form-control" onchange="change_db_type()">
                                        <option value="MYSQL"<?php
                                        if ($db_type == 'MYSQL') {
                                            echo ' selected=""';
                                        }

                                        ?>>MySQL</option>
                                        <option value="POSTGRESQL"<?php
                                        if ($db_type == 'POSTGRESQL') {
                                            echo ' selected=""';
                                        }

                                        ?>>PostgreSQL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    Servidor:
                                    <input class="form-control" type="text" name="db_host" value="<?php echo $db_host; ?>" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    Puerto:
                                    <input class="form-control" type="number" name="db_port" value="<?php echo $db_port; ?>" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    Nombre base de datos:
                                    <input class="form-control" type="text" name="db_name" value="<?php echo $db_name; ?>" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    Usuario:
                                    <input class="form-control" type="text" name="db_user" value="<?php echo $db_user; ?>" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    Contraseña:
                                    <input class="form-control" type="password" name="db_pass" value="" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button id="submit_button" class="btn btn-sm btn-primary" type="submit">
                            <i class="fa fa-check" aria-hidden="true"></i>&nbsp; Aceptar
                        </button>
                    </div>
                </div>
            </form>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-12 text-center">
                    <hr/>
                    <small>
                        &COPY; 2017-2018
                    </small>
                </div>
            </div>
        </div>
    </body>
</html>