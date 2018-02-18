<?php

class fs_ip_filter
{

    const BAN_SECONDS = 600;
    const MAX_ATTEMPTS = 5;

    private $filePath;
    private $ipList;

    public function __construct()
    {
        $this->filePath = 'tmp/' . FS_TMP_NAME . 'ip.log';
        $this->ipList = array();

        if (file_exists($this->filePath)) {
            /// Read IP list file
            $file = fopen($this->filePath, 'r');
            if ($file) {
                while (!feof($file)) {
                    $line = explode(';', trim(fgets($file)));
                    if (count($line) == 3 && intval($line[2]) > time()) { /// if not expired
                        $this->ipList[] = array('ip' => $line[0], 'count' => (int) $line[1], 'expire' => (int) $line[2]);
                    }
                }

                fclose($file);
            }
        }
    }

    public function isBanned($ip)
    {
        $banned = FALSE;

        foreach ($this->ipList as $line) {
            if ($line['ip'] == $ip && $line['count'] > self::MAX_ATTEMPTS) {
                $banned = TRUE;
                break;
            }
        }

        return $banned;
    }

    public function inWhiteList($ip)
    {
        if (FS_IP_WHITELIST === '*' || FS_IP_WHITELIST === '') {
            return TRUE;
        }

        $aux = explode(',', FS_IP_WHITELIST);
        return in_array($ip, $aux);
    }

    public function setAttempt($ip)
    {
        $found = FALSE;
        foreach ($this->ipList as $key => $line) {
            if ($line['ip'] == $ip) {
                $this->ipList[$key]['count'] ++;
                $this->ipList[$key]['expire'] = time() + self::BAN_SECONDS;
                $found = TRUE;
                break;
            }
        }

        if (!$found) {
            $this->ipList[] = array('ip' => $ip, 'count' => 1, 'expire' => time() + self::BAN_SECONDS);
        }

        $this->save();
    }

    private function save()
    {
        $file = fopen($this->filePath, 'w');
        if ($file) {
            foreach ($this->ipList as $line) {
                fwrite($file, $line['ip'] . ';' . $line['count'] . ';' . $line['expire'] . "\n");
            }

            fclose($file);
        }
    }
}
