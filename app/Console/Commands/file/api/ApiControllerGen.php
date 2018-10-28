<?php

namespace App\Console\Commands\file\api;

use Illuminate\Console\Command;
use App\Command as ModelCommand;

class ApiControllerGen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'genfile:apicontroller {id}';

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
        $id=$this->argument('id');
        $cmdfile=$this->CmdFile($id);
        $this->controller($cmdfile);
    }
    public function CmdFile($id)
    {
        return ModelCommand::find($id);
    }
    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }
    protected function controller($cmdfile)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$cmdfile->name],
            $this->getStub('Controller')
        );
        $path=app_path("/Http/Controllers/{$cmdfile->project_type}/{$cmdfile->version_api}");
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }

        file_put_contents($path."/{$cmdfile->name}.php", $modelTemplate);
    }
}
