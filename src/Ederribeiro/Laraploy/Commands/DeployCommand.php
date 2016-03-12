<?php

namespace Ederribeiro\Laraploy\Commands;

use Illuminate\Console\Command;
use Ederribeiro\Laraploy\Laraploy;

class DeployCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laraploy:send
                            {server? : Choose the server you will use to send the deploy, default is development}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send deploy to especific server.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $server   = $this->argument('server');
        
        $laraploy = new Laraploy($server);
        $laraploy->start();
    }
}
