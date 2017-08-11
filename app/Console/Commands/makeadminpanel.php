<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Util\CopyUtil;
class MakeAdminPanel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:makeadminpanel';
   

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->copyFromServer();
    }
    function copyFromServer(){
        $server_path = base_path('adminlte.zip');
    $local_path = base_path("resources/adminlte");

        $copyUtil = new CopyUtil;
        $copyUtil->XXcopy($server_path,$local_path);
    }
}
