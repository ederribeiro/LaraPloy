<?php

namespace Ederribeiro\Laraploy;

use Banago\Bridge\Bridge;

class Connection
{
    protected $scheme;
    protected $host;
    protected $user;

    public function __construct()
    {
        $this->scheme = app()->config['LARAPLOY_SCHEME'];
        $this->host   = app()->config['LARAPLOY_HOST'];
        $this->user   = app()->config['LARAPLOY_USER'];
    }

    public function ignition()
    {
        $url  = $this->buildUrl();
        $conn = new Bridge($url);

        return $conn;
    }

    private function buildUrl()
    {
        $url = $this->scheme.'://'.$this->user.'@'.$this->host;

        return $url;
    }
}
