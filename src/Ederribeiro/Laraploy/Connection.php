<?php

namespace Ederribeiro\Laraploy;

use phpseclib\Net\SFTP;
use phpseclib\Crypt\RSA;

class Connection
{
    protected $scheme;
    protected $host;
    protected $user;

    public function __construct()
    {
        $this->scheme = env('LARAPLOY_SCHEME', null);
        $this->host = env('LARAPLOY_HOST', null);
        $this->user = env('LARAPLOY_USER', null);
        $this->pass = env('LARAPLOY_PASS', null);
        $this->key = env('LARAPLOY_KEYFILE', null);
        $this->path = env('LARAPLOY_PATH', null);
    }

    public function ignition()
    {
        $conn = $this->chooseConn();

        $conn->chdir($this->path);
        echo $conn->pwd();

        return $conn;
    }

    private function chooseConn()
    {
        if (in_array($this->scheme, ['ssh', 'sftp'])) {
            $conn = new SFTP($this->host);
            $key = $this->pass;
            if (!is_null($this->key)) {
                try {
                    $key = new RSA();
                    $key->loadKey(file_get_contents($this->key));
                } catch (Exception $e) {
                    throw new Exception('Invalid KEYFILE', 1);
                }
            }
            $conn->login($this->user, $key);

            return $conn;
        }
    }

    private function buildUrl()
    {
        $credentials = [
            'scheme' => $this->scheme,
            'host' => $this->host,
            'path' => $this->path,
        ];

        return http_build_url($credentials);
    }
}
