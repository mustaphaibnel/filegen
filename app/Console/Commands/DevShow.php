<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Command as ModelCommand;
class DevShow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gencmd:show {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'show all commands';

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
        $id=$this->option('id');
        $headers = ['ID','Name','Type', 'Space','Version'];
        if($id){
            $commands =ModelCommand::where('id',$id)->get(['id','name', 'project_type','space_work','version_api'])->toArray();
        }
        else{
            $commands =ModelCommand::all(['id','name', 'project_type','space_work','version_api'])->toArray();

        }

        $this->table($headers, $commands);
    }
}
