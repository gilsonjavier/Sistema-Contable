<?php

class fs_rol extends fs_model
{

    public $codrol;
    public $descripcion;

    public function __construct($data = FALSE)
    {
        parent::__construct('fs_roles');
        if ($data) {
            $this->codrol = $data['codrol'];
            $this->descripcion = $data['descripcion'];
        } else {
            $this->codrol = NULL;
            $this->descripcion = NULL;
        }
    }

    protected function install()
    {
        return '';
    }

    public function url()
    {
        if (is_null($this->codrol)) {
            return 'index.php?page=admin_rol';
        }

        return 'index.php?page=admin_rol&codrol=' . urlencode($this->codrol);
    }

    public function get($codrol)
    {
        $data = $this->db->select("SELECT * FROM " . $this->table_name . " WHERE codrol = " . $this->var2str($codrol) . ";");
        if ($data) {
            return new fs_rol($data[0]);
        }

        return FALSE;
    }

    /**
     * Devuelve la lista de accesos permitidos del rol.
     * @return type
     */
    public function get_accesses()
    {
        $access = new fs_rol_access();
        return $access->all_from_rol($this->codrol);
    }

    /**
     * Devuelve la lista de usuarios con este rol.
     * @return type
     */
    public function get_users()
    {
        $ru = new fs_rol_user();
        return $ru->all_from_rol($this->codrol);
    }

    public function exists()
    {
        if (is_null($this->codrol)) {
            return FALSE;
        }

        return $this->db->select("SELECT * FROM " . $this->table_name . " WHERE codrol = " . $this->var2str($this->codrol) . ";");
    }

    public function save()
    {
        $this->descripcion = $this->no_html($this->descripcion);

        if ($this->exists()) {
            $sql = "UPDATE " . $this->table_name . " SET descripcion = " . $this->var2str($this->descripcion)
                . " WHERE codrol = " . $this->var2str($this->codrol) . ";";
        } else {
            $sql = "INSERT INTO " . $this->table_name . " (codrol,descripcion) VALUES "
                . "(" . $this->var2str($this->codrol)
                . "," . $this->var2str($this->descripcion) . ");";
        }

        return $this->db->exec($sql);
    }

    public function delete()
    {
        $sql = "DELETE FROM " . $this->table_name . " WHERE codrol = " . $this->var2str($this->codrol) . ";";
        return $this->db->exec($sql);
    }

    public function all()
    {
        $lista = array();

        $sql = "SELECT * FROM " . $this->table_name . " ORDER BY descripcion ASC;";
        $data = $this->db->select($sql);
        if ($data) {
            foreach ($data as $d) {
                $lista[] = new fs_rol($d);
            }
        }

        return $lista;
    }

    public function all_for_user($nick)
    {
        $lista = array();

        $sql = "SELECT * FROM " . $this->table_name . " WHERE codrol IN "
            . "(SELECT codrol FROM fs_roles_users WHERE fs_user = " . $this->var2str($nick) . ");";
        $data = $this->db->select($sql);
        if ($data) {
            foreach ($data as $d) {
                $lista[] = new fs_rol($d);
            }
        }

        return $lista;
    }
}
