<?php

namespace App\Console\Commands\file;

use Illuminate\Console\Command;
use App\Command as ModelCommand;
use Illuminate\Support\Facades\Artisan;

class CreateFile extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'genfile:generator {model}';

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
        //name of model
        $model = $this->argument('model');
        $this->info("Your Model name Is: {$model}!");
        //option project
        $defaultIndex = 'Blade';
        $this->line('Display this on the screen');
        $this->info("Choice Type Of Project Default is the both of API/Blade'{$defaultIndex}'");
        $VersionOfApi = null;
        $typeOfProject = $this->choice('What is your name?', ['Api', 'Blade', 'Both'], $defaultIndex);

        //version if is an API
        if ($typeOfProject) {
            $this->info("your response is: {$typeOfProject}!");
            if ($typeOfProject == 'API' OR $typeOfProject == 'Both') {
                $VersionOfApi = $this->ask('What is the version of You Api');
                $this->info("your Api Version Is: {$VersionOfApi}!");
            }

        }
        //space or folder work on
        $spaceOfWork = $this->ask('What is your space Work Admin /Client /Guest....?');
        $this->info("your space Work Is: {$spaceOfWork}!");

        //$path = app_path('/Http/Requests/Model/Post');
        //$this->FindOrCreate($path);
        //create Saved Schema


        //verify if existe
        $id = $this->FindFiles($model, $typeOfProject, $VersionOfApi, $spaceOfWork);
        //verify & call method
        if ($id) {
            $this->info("Display this on the screen {$id}");
            $valueIndex = 'ignore';
            $this->line('Display this on the screen');
            $this->info("Choice an Action default('{$valueIndex}')");
            $typeOfAction = $this->choice('What is your name?', ['Erase', 'Delete', 'Backup', 'ignore'], $valueIndex);

            //erase call
            if ($typeOfAction == 'Erase') {
                $this->DeleteFiles($id);
                $this->PublishFiles($id);
            } //delete file
            elseif ($typeOfAction == 'Delete') {
                $this->DeleteFiles($id);
            } //backup
            elseif ($typeOfAction = 'Backup') {
                $this->BackupFiles($id);
                $this->DeleteFiles($id);
                $this->PublishFiles($id);
            }

        } else {
            $id = $this->CreateFiles($model, $typeOfProject, $VersionOfApi, $spaceOfWork);
            //generate all file from ID
            $this->PublishFiles($id);
        }
    }
    public function FindFiles($model,$typeOfProject,$VersionOfApi,$spaceOfWork)
    {
        $command=ModelCommand::
        where('name',$model)
            ->where('project_type',$typeOfProject)
            ->where('version_api',$VersionOfApi)
            ->where('space_work',$spaceOfWork)
            ->get()->first();
        if($command !=null){
            if($command->count()>=1){
                return $command->id;
            }
        }

    }
    public function CreateFiles($model,$typeOfProject,$VersionOfApi,$spaceOfWork)
    {
        $command=new ModelCommand();
        $command->name=$model;
        $command->project_type=$typeOfProject;
        $command->version_api=$VersionOfApi;
        $command->space_work=$spaceOfWork;
        $command->save();
        return $command->id;
    }
    public function BackupFiles($id)
    {
        Artisan::call("genfile:backup", ['id' =>$id]);
    }
    public function DeleteFiles($id)
    {
        Artisan::call("genfile:delete", ['id' =>$id]);

    }
    public function ShowFiles($id)
    {
        Artisan::call("genfile:show", ['id' =>$id]);
    }
    public function PublishFiles($id)
    {
        Artisan::call("genfile:publish", ['id' =>$id]);
    }
}
