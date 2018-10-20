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
        $this->controller($cmdfile->name);
    }
    public function CmdFile($id)
    {
        return ModelCommand::find($id);
    }
    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }
    protected function controller($name)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/{$name}.php"), $modelTemplate);
    }
}
