<?php

/// cargamos las constantes de configuración
require_once 'config.php';
require_once 'base/config2.php';
require_once 'base/fs_core_log.php';
require_once 'base/fs_db2.php';
$db = new fs_db2();

require_once 'base/fs_model.php';
require_once 'base/fs_log_manager.php';
require_all_models();

$db->connect();

if (!$db->connected()) {
    echo 'ERROR al conectar a la base de datos';
} else if (!fs_filter_input_req('v')) {
    echo 'Version de la API de FacturaScripts ausente. Actualiza el cliente.';
} else if (fs_filter_input_req('v') != '2') {
    echo 'Version de la API de FacturaScripts incorrecta. Actualiza el cliente.';
} else if (fs_filter_input_req('f')) {
    $ejecutada = FALSE;
    $fsext = new fs_extension();
    foreach ($fsext->all_4_type('api') as $ext) {
        if ($ext->text == fs_filter_input_req('f')) {
            try {
                call_user_func(fs_filter_input_req('f'));
            } catch (Exception $exception) {
                echo 'ERROR: ' . $exception->getMessage();
            }

            $ejecutada = TRUE;
            break;
        }
    }

    if (!$ejecutada) {
        echo 'Ninguna funcion API ejecutada.';
    }
} else {
    echo 'Ninguna funcion ejecutada.';
}

/// guardamos los errores en el log
$log_manager = new fs_log_manager();
$log_manager->save();

$db->close();