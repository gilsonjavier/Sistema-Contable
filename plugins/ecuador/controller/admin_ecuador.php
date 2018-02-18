<?php



require_model('divisa.php');
require_model('pais.php');
require_model('impuesto.php');
require_model('cuenta_especial.php');


class admin_ecuador extends fs_controller
{
    public $adap_var;
    public $adap_conf;

   public function __construct()
   {
      parent::__construct(__CLASS__, 'Ecuador', 'admin');
   }
   
   protected function private_core()
   {

    

      $this->share_extensions();
      $this->adap_var =
          array(  'zona_horaria'=>'America/Guayaquil',
                  'albaran'=>'Guia de Remision',
                  'albaranes'=>'Guias de Remision',
                  'presupuesto'=>'Proforma',
                  'presupuestos'=>'Proformas',
                  'cifnif'=>'Cedula',
                  'factura' => 'factura',
                  'facturas' => 'facturas',
                  'iva' => 'IVA',
                  'factura_simplificada' => 'factura simplificada',
                  'factura_rectificativa' => 'factura rectificativa',
                  'stock_negativo' => 0,
                  'ventas_sin_stock' => 0,
                  'nf1' => ',',
                  'pos_divisa'=>'left');

      
      if( isset($_GET['opcion']) )
      {
         if($_GET['opcion'] == 'moneda')
         {
            $this->empresa->coddivisa = 'USD';
            if( $this->empresa->save() )
            {
               $this->new_message('Datos guardados correctamente.');
            }
         }
         else if($_GET['opcion'] == 'pais')
         {
            $this->empresa->codpais = 'ECU';
            if( $this->empresa->save() )
            {
               $this->new_message('Datos guardados correctamente.');
            }
         }
         else if($_GET['opcion'] == 'adap_conf')
         {
             $this->adap_conf();
         }
         else if($_GET['opcion'] == 'impuestos')
         {
             $this->set_impuestos();
         }
      }
      else
      {
         $this->check_ejercicio();
      }

       $this->adap_conf = ($GLOBALS['config2']['presupuesto'] == 'Proforma') ? TRUE : FALSE;
   }
   
   private function share_extensions()
   {
      $fsext = new fs_extension();
      $fsext->name = 'plan_ecuador';
      $fsext->from = __CLASS__;
      $fsext->to = 'contabilidad_ejercicio';
      $fsext->type = 'fuente';
      $fsext->text = 'Plan contable de Ecuador';
      $fsext->params = 'plugins/ecuador/extras/ecuador.xml';
      $fsext->save();
   }
    public function  adap_conf() {

        $save = FALSE;
        foreach ($GLOBALS['config2'] as $i => $value) {
            if (isset($this->adap_var[$i])) {
                $GLOBALS['config2'][$i] = $this->adap_var[$i];
                $save= TRUE;
            }
        }

        if ($save) {
            $file = fopen('tmp/' . FS_TMP_NAME . 'config2.ini', 'w');
            if ($file) {
                foreach ($GLOBALS['config2'] as $i => $value) {
                    if (is_numeric($value)) {
                        fwrite($file, $i . " = " . $value . ";\n");
                    } else {
                        fwrite($file, $i . " = '" . $value . "';\n");
                    }
                }
                fclose($file);
            }
            $this->new_message('Datos de configuracion Hora y Traducciones Guardados.');
        }
    }

   private function check_ejercicio()
   {
      $ej0 = new ejercicio();
      foreach($ej0->all_abiertos() as $ejercicio)
      {
         if($ejercicio->longsubcuenta == 10)
         {
            $ejercicio->longsubcuenta = 10;
            if( $ejercicio->save() )
            {
               $this->new_message('Datos del ejercicio '.$ejercicio->codejercicio.' modificados correctamente.');
            }
            else
            {
               $this->new_error_msg('Error al modificar el ejercicio.');
            }
         }
      }
   }


    private function set_impuestos()
    {
        /// eliminamos los impuestos que ya existen (los de España)
        $imp0 = new impuesto();
        foreach($imp0->all() as $impuesto)
        {
            if ($impuesto->codimpuesto != 'EC12' AND $impuesto->codimpuesto != 'EC0') {
            $this->desvincular_articulos($impuesto->codimpuesto);
            $impuesto->delete();
             }
        }

        /// añadimos los de Ecuador
        $codimp = array("EC12","EC0");
        $desc = array("EC 12%","EC 0%");
        $recargo = 0;
        $iva = array(12, 0);
        $cant = count($codimp);
        for($i=0; $i<$cant; $i++)
        {
            $impuesto = new impuesto();
            $impuesto->codimpuesto = $codimp[$i];
            $impuesto->descripcion = $desc[$i];
            $impuesto->recargo = $recargo;
            $impuesto->iva = $iva[$i];
            $impuesto->save();
        }

        $this->impuestos_ok = TRUE;
        $this->new_message('Impuestos de Ecuador añadidos.');
    }

    public function impuestos_ok()
    {
        $ok = FALSE;

        $imp0 = new impuesto();
        foreach($imp0->all() as $i)
        {
            if($i->codimpuesto == 'EC12')
            {
                $ok = TRUE;
                break;
            }
        }

        return $ok;
    }


    private function desvincular_articulos($codimpuesto)
    {
        $sql = "UPDATE articulos SET codimpuesto = null WHERE codimpuesto = "
            .$this->empresa->var2str($codimpuesto).';';

        if( $this->db->table_exists('articulos') )
        {
            $this->db->exec($sql);
        }
    }
}
