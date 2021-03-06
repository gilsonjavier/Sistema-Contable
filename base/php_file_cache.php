<?php

class php_file_cache
{

    /**
     * Configuration
     *
     * @access private
     */
    private static $config;

    public function __construct()
    {
        self::$config = array(
            'cache_path' => 'tmp/' . FS_TMP_NAME . 'cache',
            'expires' => 180,
        );

        if (!file_exists(self::$config['cache_path'])) {
            mkdir(self::$config['cache_path']);
        }
    }

    /**
     * Get a route to the file associated to that key.
     *
     * @access public
     * @param string $key
     * @return string the filename of the php file
     */
    public function get_route($key)
    {
        return self::$config['cache_path'] . '/' . md5($key) . '.php';
    }

    /**
     * Get the data associated with a key
     *
     * @access public
     * @param string $key
     * @return mixed the content you put in, or null if expired or not found
     */
    public function get($key, $raw = false, $custom_time = NULL)
    {
        if (!$this->file_expired($file = $this->get_route($key), $custom_time)) {
            $content = file_get_contents($file);
            return $raw ? $content : unserialize($content);
        }

        return NULL;
    }

    /**
     * Put content into the cache
     *
     * @access public
     * @param string $key
     * @param mixed $content the the content you want to store
     * @param bool $raw whether if you want to store raw data or not. If it is true, $content *must* be a string
     * @return bool whether if the operation was successful or not
     */
    public function put($key, $content, $raw = FALSE)
    {
        $dest_file_name = $this->get_route($key);
        /** Use a unique temporary filename to make writes atomic with rewrite */
        $temp_file_name = str_replace(".php", uniqid("-", true) . ".php", $dest_file_name);
        $ret = @file_put_contents($temp_file_name, $raw ? $content : serialize($content));
        if ($ret !== FALSE) {
            return @rename($temp_file_name, $dest_file_name);
        }
        unlink($temp_file_name);
        return false;
    }

    /**
     * Delete data from cache
     *
     * @access public
     * @param string $key
     * @return bool true if the data was removed successfully
     */
    public function delete($key)
    {
        $done = TRUE;
        $ruta = $this->get_route($key);
        if (file_exists($ruta)) {
            $done = unlink($ruta);
        }

        return $done;
    }

    /**
     * Flush all cache
     *
     * @access public
     * @return bool always true
     */
    public function flush()
    {
        foreach (scandir(getcwd() . '/' . self::$config['cache_path']) as $file_name) {
            if (substr($file_name, -4) == '.php') {
                unlink(self::$config['cache_path'] . '/' . $file_name);
            }
        }

        return TRUE;
    }

    /**
     * Check if a file has expired or not.
     *
     * @access public
     * @param $file the rout to the file
     * @param int $time the number of minutes it was set to expire
     * @return bool if the file has expired or not
     */
    public function file_expired($file, $time = NULL)
    {
        if (file_exists($file)) {
            return (time() > (filemtime($file) + 60 * ($time ? $time : self::$config['expires'])));
        }

        return TRUE;
    }
}
