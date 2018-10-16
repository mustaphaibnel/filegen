<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Command as ModelCommand;
class DevGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:generator {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all files here';

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
        $model=$this->argument('model');
        $this->info("Your Model name Is: {$model}!");
        $defaultIndex='Blade';
        $this->line('Display this on the screen');
        $this->info("Choice Type Of Project Default is the both of API/Blade'{$defaultIndex}'");

        $typeOfProject = $this->choice('What is your name?', ['API', 'Blade','Both'], $defaultIndex);
        if($typeOfProject)
        {
            $this->info("your response is: {$typeOfProject}!");
            if($typeOfProject=='API' OR $typeOfProject=='Both')
            {
                $VersionOfApi = $this->ask('What is the version of You Api');
                $this->info("your Api Version Is: {$VersionOfApi}!");
            }
        }
        $spaceOfWork = $this->ask('What is your space Work Admin /Client /Guest....?');
        $this->info("your space Work Is: {$spaceOfWork}!");
        $path = app_path('/Http/Requests/Model/Post');
        $this->FindOrCreate($path);

        $command =new ModelCommand();
        $command->name=$model;
        $command->project_type=$typeOfProject;
        $command->version_api=$VersionOfApi;
        $command->space_work=$spaceOfWork;
        $command->save();

    }

    public function FindOrCreate($path)
    {
        if(!file_exists($path))
        {
        mkdir($path, 0777, true);
        }
    }
}
