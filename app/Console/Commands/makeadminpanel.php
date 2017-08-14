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
        $local_path = base_path("resources/assets/");
        $layout_path = base_path("resources/views/");
        $layout_mock_source = resource_path('assets\\adminlte\\layout_mock');
        $copyUtil = new CopyUtil;
        $this->info('Generating....');
        $copyUtil->zipAndCopy($server_path,$local_path);
       // $layout_folder = $this->ask('Please Provide the Layout Folder name?');
        $layout_folder = 'backendlayout';
        $layout_path = $layout_path.'layouts/'.$layout_folder;
        //Now creating the Master bootstrapping layout
        if($copyUtil->createLayout($layout_path,$layout_mock_source))   
                        $this->info('Layout has been created.');
        $this->line('Creating Dashboard');
        $dest = resource_path('views\\backend\\');
        $folder_path = 'dashboard';
        $copyUtil->createDashboard($dest.$folder_path);



    }


}
