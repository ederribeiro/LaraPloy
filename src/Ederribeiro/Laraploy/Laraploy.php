<?php

namespace Ederribeiro\Laraploy;

use Illuminate\Console\Command;
use Ederribeiro\Laraploy\Connection;
class Laraploy
{
    protected $server;

    public function __construct($server)
    {
        $this->server = $server;
    }

    public function start()
    {
        $conn = new Connection();
        $ignition = $conn->ignition();
    }
}
