<?php

namespace FacturaScripts\model;


class cuenta_banco extends \fs_model
{

    /**
     * Clave primaria. Varchar (6).
     * @var string 
     */
    public $codcuenta;
    public $descripcion;
    public $iban;
    public $swift;

    /**
     * Código de la subcuenta de contabilidad
     * @var string 
     */
    public $codsubcuenta;

    public function __construct($data = FALSE)
    {
        parent::__construct('cuentasbanco');
        if ($data) {
            $this->codcuenta = $data['codcuenta'];
            $this->descripcion = $data['descripcion'];
            $this->iban = $data['iban'];
            $this->swift = $data['swift'];
            $this->codsubcuenta = $data['codsubcuenta'];
        } else {
            $this->codcuenta = NULL;
            $this->descripcion = NULL;
            $this->iban = NULL;
            $this->swift = NULL;
            $this->codsubcuenta = NULL;
        }
    }

    protected function install()
    {
        return '';
    }

    /**
     * Devuelve el IBAN con o sin espacios.
     * @param boolean $espacios
     * @return string
     */
    public function iban($espacios = FALSE)
    {
        if ($espacios) {
            $txt = '';
            $iban = str_replace(' ', '', $this->iban);
            for ($i = 0; $i < strlen($iban); $i += 4) {
                $txt .= substr($iban, $i, 4) . ' ';
            }
            return $txt;
        }

        return str_replace(' ', '', $this->iban);
    }

    /**
     * Devuelve la URL donde ver/modificar los datos de esta cuenta bancaria
     * @return string
     */
    public function url()
    {
        return 'index.php?page=admin_empresa#cuentasb';
    }

    /**
     * Devuelve la cuenta bancaria con codcuenta = $cod
     * @param string $cod
     * @return boolean|\cuenta_banco
     */
    public function get($cod)
    {
        $data = $this->db->select("SELECT * FROM " . $this->table_name . " WHERE codcuenta = " . $this->var2str($cod) . ";");
        if ($data) {
            return new \cuenta_banco($data[0]);
        }

        return FALSE;
    }

    /**
     * Devuelve un nuevo código para una cuenta bancaria
     * @return int
     */
    private function get_new_codigo()
    {
        $sql = "SELECT MAX(" . $this->db->sql_to_int('codcuenta') . ") as cod FROM " . $this->table_name . ";";
        $data = $this->db->select($sql);
        if ($data) {
            return (string) (1 + (int) $data[0]['cod']);
        }

        return '1';
    }

    /**
     * Devuelve TRUE si la cuenta bancaria existe
     * @return boolean
     */
    public function exists()
    {
        if (is_null($this->codcuenta)) {
            return FALSE;
        }

        return $this->db->select("SELECT * FROM " . $this->table_name . " WHERE codcuenta = " . $this->var2str($this->codcuenta) . ";");
    }

    /**
     * Guarda los datos en la base de datos.
     * @return boolean
     */
    public function save()
    {
        $this->descripcion = $this->no_html($this->descripcion);

        if ($this->exists()) {
            $sql = "UPDATE " . $this->table_name . " SET descripcion = " . $this->var2str($this->descripcion) .
                ", iban = " . $this->var2str($this->iban) .
                ", swift = " . $this->var2str($this->swift) .
                ", codsubcuenta = " . $this->var2str($this->codsubcuenta) .
                "  WHERE codcuenta = " . $this->var2str($this->codcuenta) . ";";
        } else {
            $this->codcuenta = $this->get_new_codigo();
            $sql = "INSERT INTO " . $this->table_name . " (codcuenta,descripcion,iban,swift,codsubcuenta)
                 VALUES (" . $this->var2str($this->codcuenta) .
                "," . $this->var2str($this->descripcion) .
                "," . $this->var2str($this->iban) .
                "," . $this->var2str($this->swift) .
                "," . $this->var2str($this->codsubcuenta) . ");";
        }

        return $this->db->exec($sql);
    }

    /**
     * Elimina esta cuenta bancaria
     * @return boolean
     */
    public function delete()
    {
        return $this->db->exec("DELETE FROM " . $this->table_name . " WHERE codcuenta = " . $this->var2str($this->codcuenta) . ";");
    }

    public function all()
    {
        return $this->all_from_empresa();
    }

    /**
     * Devuelve un array con todas las cuentas bancarias de la empresa
     * @return \cuenta_banco
     */
    public function all_from_empresa()
    {
        $clist = array();

        $data = $this->db->select("SELECT * FROM " . $this->table_name . " ORDER BY descripcion ASC;");
        if ($data) {
            foreach ($data as $d) {
                $clist[] = new \cuenta_banco($d);
            }
        }

        return $clist;
    }

    /**
     * Calcula el IBAN a partir de la cuenta bancaria del cliente CCC
     * @param string $ccc
     * @return string
     */
    public function calcular_iban($ccc)
    {
        $codpais = substr($this->default_items->codpais(), 0, 2);

        $pesos = array('A' => '10', 'B' => '11', 'C' => '12', 'D' => '13', 'E' => '14', 'F' => '15',
            'G' => '16', 'H' => '17', 'I' => '18', 'J' => '19', 'K' => '20', 'L' => '21', 'M' => '22',
            'N' => '23', 'O' => '24', 'P' => '25', 'Q' => '26', 'R' => '27', 'S' => '28', 'T' => '29',
            'U' => '30', 'V' => '31', 'W' => '32', 'X' => '33', 'Y' => '34', 'Z' => '35'
        );

        $dividendo = $ccc . $pesos[substr($codpais, 0, 1)] . $pesos[substr($codpais, 1, 1)] . '00';
        $digitoControl = 98 - bcmod($dividendo, '97');

        if (strlen($digitoControl) == 1) {
            $digitoControl = '0' . $digitoControl;
        }

        return $codpais . $digitoControl . $ccc;
    }
}
