<?php

class fs_default_items
{

    private static $default_page;
    private static $showing_page;
    private static $codejercicio;
    private static $codalmacen;
    private static $coddivisa;
    private static $codpago;
    private static $codimpuesto;
    private static $codpais;
    private static $codserie;

    public function codejercicio()
    {
        return self::$codejercicio;
    }

    public function set_codejercicio($cod)
    {
        self::$codejercicio = $cod;
    }

    public function codalmacen()
    {
        return self::$codalmacen;
    }

    public function set_codalmacen($cod)
    {
        self::$codalmacen = $cod;
    }

    public function coddivisa()
    {
        return self::$coddivisa;
    }

    public function set_coddivisa($cod)
    {
        self::$coddivisa = $cod;
    }

    public function codpago()
    {
        return self::$codpago;
    }

    public function set_codpago($cod)
    {
        self::$codpago = $cod;
    }

    public function codimpuesto()
    {
        return self::$codimpuesto;
    }

    public function set_codimpuesto($cod)
    {
        self::$codimpuesto = $cod;
    }

    public function codpais()
    {
        return self::$codpais;
    }

    public function set_codpais($cod)
    {
        self::$codpais = $cod;
    }

    public function codserie()
    {
        return self::$codserie;
    }

    public function set_codserie($cod)
    {
        self::$codserie = $cod;
    }

    public function default_page()
    {
        return self::$default_page;
    }

    public function set_default_page($name)
    {
        self::$default_page = $name;
    }

    public function showing_page()
    {
        return self::$showing_page;
    }

    public function set_showing_page($name)
    {
        self::$showing_page = $name;
    }
}
