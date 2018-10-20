<?php

namespace App\Console\Commands\file;

use Illuminate\Console\Command;
use App\Command as ModelCommand;
use Illuminate\Support\Facades\Artisan;
class PublishFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'genfile:publish {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish the files how have ID';

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
        $id=$this->argument('id');
        $this->ActiveFile($id);
        //type of project
        $cmdfile=$this->CmdFile($id);
        if($cmdfile->project_type=='Api'){
            $this->info("type is from api {$cmdfile->project_type}");
            $this->ApiController($id);
            //$this->ApiRequest($id);
        }
        elseif($cmdfile->project_type=='Blade'){
            $this->info("type is from blade {$cmdfile->project_type}");
        }elseif ($cmdfile->project_type=='Both'){
            $this->info("type is from blade {$cmdfile->project_type}");
        }
    }
    public function ActiveFile($id)
    {
        $command=ModelCommand::find($id);
        $command->published=1;
        $command->update();
    }
    public function CmdFile($id)
    {
        return ModelCommand::find($id);
    }
    public function ApiController($id)
    {
        Artisan::call("genfile:apicontroller", ['id' =>$id]);
    }
    public function ApiRequest($id)
    {
        Artisan::call("genfile:apirequest", ['id' =>$id]);
    }
}
