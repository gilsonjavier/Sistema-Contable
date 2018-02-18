<?php

class fs_rol_access extends fs_model
{

    public $codrol;
    public $fs_page;
    public $allow_delete;

    public function __construct($data = FALSE)
    {
        parent::__construct('fs_roles_access');
        if ($data) {
            $this->codrol = $data['codrol'];
            $this->fs_page = $data['fs_page'];
            $this->allow_delete = $this->str2bool($data['allow_delete']);
        } else {
            $this->codrol = NULL;
            $this->fs_page = NULL;
            $this->allow_delete = FALSE;
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
                    . " AND fs_page = " . $this->var2str($this->fs_page) . ";");
    }

    public function save()
    {
        if ($this->exists()) {
            $sql = "UPDATE " . $this->table_name . " SET allow_delete = " . $this->var2str($this->allow_delete)
                . " WHERE codrol = " . $this->var2str($this->codrol)
                . " AND fs_page = " . $this->var2str($this->fs_page) . ";";
        } else {
            $sql = "INSERT INTO " . $this->table_name . " (codrol,fs_page,allow_delete) VALUES "
                . "(" . $this->var2str($this->codrol)
                . "," . $this->var2str($this->fs_page)
                . "," . $this->var2str($this->allow_delete) . ");";
        }

        return $this->db->exec($sql);
    }

    public function delete()
    {
        return $this->db->exec("DELETE FROM " . $this->table_name
                . " WHERE codrol = " . $this->var2str($this->codrol)
                . " AND fs_page = " . $this->var2str($this->fs_page) . ";");
    }

    public function all_from_rol($codrol)
    {
        $accesslist = array();

        $data = $this->db->select("SELECT * FROM " . $this->table_name . " WHERE codrol = " . $this->var2str($codrol) . ";");
        if ($data) {
            foreach ($data as $a) {
                $accesslist[] = new fs_rol_access($a);
            }
        }

        return $accesslist;
    }
}
