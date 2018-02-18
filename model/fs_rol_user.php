<?php

class fs_rol_user extends fs_model
{

    public $codrol;
    public $fs_user;

    public function __construct($data = FALSE)
    {
        parent::__construct('fs_roles_users');
        if ($data) {
            $this->codrol = $data['codrol'];
            $this->fs_user = $data['fs_user'];
        } else {
            $this->codrol = NULL;
            $this->fs_user = NULL;
        }
    }

    protected function install()
    {
        return '';
    }

    public function exists()
    {
        if (is_null($this->codrol)) {
            return FALSE;
        }

        return $this->db->select("SELECT * FROM " . $this->table_name
                . " WHERE codrol = " . $this->var2str($this->codrol)
                . " AND fs_user = " . $this->var2str($this->fs_user) . ";");
    }

    public function save()
    {
        if ($this->exists()) {
            return TRUE;
        }

        $sql = "INSERT INTO " . $this->table_name . " (codrol,fs_user) VALUES "
            . "(" . $this->var2str($this->codrol)
            . "," . $this->var2str($this->fs_user) . ");";

        return $this->db->exec($sql);
    }

    public function delete()
    {
        return $this->db->exec("DELETE FROM " . $this->table_name .
                " WHERE codrol = " . $this->var2str($this->codrol) .
                " AND fs_user = " . $this->var2str($this->fs_user) . ";");
    }

    public function all_from_rol($codrol)
    {
        $accesslist = array();

        $data = $this->db->select("SELECT * FROM " . $this->table_name . " WHERE codrol = " . $this->var2str($codrol) . ";");
        if ($data) {
            foreach ($data as $a) {
                $accesslist[] = new fs_rol_user($a);
            }
        }

        return $accesslist;
    }
}
