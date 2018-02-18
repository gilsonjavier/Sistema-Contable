<?php

if ((float) substr(phpversion(), 0, 3) < 5.4) {
    /// comprobamos la versión de PHP
    die('FacturaScripts necesita PHP 5.4 o superior, y usted tiene PHP ' . phpversion());
}

if (!file_exists('config.php')) {
    /// si no hay config.php redirigimos al instalador
    header('Location: install.php');
    die('Redireccionando al instalador...');
}

/// cargamos las constantes de configuración
require_once 'config.php';
require_once 'base/config2.php';
require_once 'base/fs_controller.php';
require_once 'base/fs_log_manager.php';
require_once 'raintpl/rain.tpl.class.php';

/**
 * Registramos la función para capturar los fatal error.
 * Información importante a la hora de depurar errores.
 */
register_shutdown_function("fatal_handler");

/// ¿Qué controlador usar?
$pagename = '';
if (filter_input(INPUT_GET, 'page')) {
    $pagename = filter_input(INPUT_GET, 'page');
} elseif (defined('FS_HOMEPAGE')) {
    $pagename = FS_HOMEPAGE;
}

$fsc_error = FALSE;
if ($pagename != '') {
    /// primero buscamos en los plugins
    $found = FALSE;
    foreach ($GLOBALS['plugins'] as $plugin) {
        if (file_exists('plugins/' . $plugin . '/controller/' . $pagename . '.php')) {
            require_once 'plugins/' . $plugin . '/controller/' . $pagename . '.php';

            try {
                $fsc = new $pagename();
            } catch (Exception $e) {
                echo "<h1>Error fatal</h1>"
                . "<ul>"
                . "<li><b>Código:</b> " . $e->getCode() . "</li>"
                . "<li><b>Mensage:</b> " . $e->getMessage() . "</li>"
                . "</ul>";
                $fsc_error = TRUE;
            }

            $found = TRUE;
            break;
        }
    }

    /// si no está en los plugins, buscamos en controller/
    if (!$found) {
        if (file_exists('controller/' . $pagename . '.php')) {
            require_once 'controller/' . $pagename . '.php';

            try {
                $fsc = new $pagename();
            } catch (Exception $e) {
                echo "<h1>Error fatal</h1>"
                . "<ul>"
                . "<li><b>Código:</b> " . $e->getCode() . "</li>"
                . "<li><b>Mensage:</b> " . $e->getMessage() . "</li>"
                . "</ul>";
                $fsc_error = TRUE;
            }
        } else {
            header("HTTP/1.0 404 Not Found");
            $fsc = new fs_controller();
        }
    }
} else {
    $fsc = new fs_controller();
}

if (is_null(filter_input(INPUT_GET, 'page'))) {
    /// redireccionamos a la página definida por el usuario
    $fsc->select_default_page();
}

if ($fsc_error) {
    die();
}

if ($fsc->template) {
    /// configuramos rain.tpl
    raintpl::configure('base_url', NULL);
    raintpl::configure('tpl_dir', 'view/');
    raintpl::configure('path_replace', FALSE);

    /// ¿Se puede escribir sobre la carpeta temporal?
    if (is_writable('tmp')) {
        raintpl::configure('cache_dir', 'tmp/' . FS_TMP_NAME);
    } 

    $tpl = new RainTPL();
    $tpl->assign('fsc', $fsc);

    if (filter_input(INPUT_POST, 'user')) {
        $tpl->assign('nlogin', filter_input(INPUT_POST, 'user'));
    } elseif (filter_input(INPUT_COOKIE, 'user')) {
        $tpl->assign('nlogin', filter_input(INPUT_COOKIE, 'user'));
    } else {
        $tpl->assign('nlogin', '');
    }

    $tpl->draw($fsc->template);
}

/// guardamos los errores en el log
$log_manager = new fs_log_manager();
$log_manager->save();

/// cerramos las conexiones
$fsc->close();
