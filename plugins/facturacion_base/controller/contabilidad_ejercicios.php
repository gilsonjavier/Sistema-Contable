<?php

class contabilidad_ejercicios extends fs_controller
{

    public $ejercicio;

    public function __construct()
    {
        parent::__construct(__CLASS__, 'Ejercicios', 'contabilidad', FALSE, TRUE);
    }

    protected function private_core()
    {
        $this->ejercicio = new ejercicio();

        if (isset($_GET['delete'])) {
            $this->delete_ejercicio();
        } else if (isset($_POST['codejercicio'])) {
            $this->new_ejercico();
        } else if (isset($_POST['predeterminado'])) {
            $this->predeterminado();
        }
    }

    private function new_ejercico()
    {
        /// ¿Existe ya el ejercicio?
        $eje0 = $this->ejercicio->get($_POST['codejercicio']);
        if ($eje0) {
            header('Location: ' . $eje0->url());
        } else {
            $this->ejercicio->codejercicio = $_POST['codejercicio'];
            $this->ejercicio->nombre = $_POST['nombre'];
            $this->ejercicio->fechainicio = $_POST['fechainicio'];
            $this->ejercicio->fechafin = $_POST['fechafin'];
            $this->ejercicio->estado = $_POST['estado'];
            if ($this->ejercicio->save()) {
                $this->new_message("Ejercicio " . $this->ejercicio->codejercicio . " guardado correctamente.");
                header('location: ' . $this->ejercicio->url());
            } else
                $this->new_error_msg("¡Imposible guardar el ejercicio!");
        }
    }

    private function predeterminado()
    {
        $this->empresa->codejercicio = $_POST['predeterminado'];

        if ($this->empresa->save()) {
            $this->default_items->set_codejercicio($this->empresa->codejercicio);
            $this->new_message('Datos guardados correctamente.');
        } else {
            $this->new_error_msg('Error al guardar los cambios.');
        }
    }

    private function delete_ejercicio()
    {
        $eje0 = $this->ejercicio->get($_GET['delete']);
        if ($eje0) {
            if ($eje0->delete()) {
                $this->new_message('Ejercicio eliminado correctamente.');
            } else
                $this->new_error_msg("¡Imposible eliminar el ejercicio!");
        } else
            $this->new_error_msg("Ejercicio no encontrado");
    }
}
