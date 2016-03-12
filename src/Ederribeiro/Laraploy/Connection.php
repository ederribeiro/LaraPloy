<?php

namespace Ederribeiro\Laraploy;

use phpseclib\Net\SSH2;

class Connection
{
    protected $scheme;
    protected $host;
    protected $user;

    public function __construct()
    {
        $this->scheme = env('LARAPLOY_SCHEME');
        $this->host   = env('LARAPLOY_HOST');
        $this->user   = env('LARAPLOY_USER');
    }

    public function ignition()
    {
        $url  = $this->buildUrl();
        // echo $url;die;
        $conn = new Net_SSH2($this->host);
        $key = new Crypt_RSA();
        $key->loadKey(file_get_contents('/Users/ederribeiro/Documents/keys/ConveniaKEY.pem'));
        if (!$conn->login($this->user, $key)) {
            exit('Login Failed');
        }

        echo $conn->exec('pwd');
        echo $conn->exec('ls -la');
        return $conn;
    }

    private function buildUrl()
    {
        $url = $this->scheme.'://'.$this->host;

        return $url;
    }
}
