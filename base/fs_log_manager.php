<?php

class fs_log_manager
{

    private $core_log;

    public function __construct()
    {
        $this->core_log = new fs_core_log();
    }

    public function save()
    {
        foreach ($this->core_log->get_to_save() as $err) {
            $new_log = new fs_log();
            $new_log->tipo = $err['type'];
            $new_log->detalle = $err['message'];
            $new_log->alerta = $err['alert'];
            $new_log->save();
        }
    }
}
