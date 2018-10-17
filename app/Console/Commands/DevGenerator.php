<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Command as ModelCommand;
use Artisan;
class DevGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gencmd:generator {model}';

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
        $VersionOfApi=null;
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
        $id=$this->CreateFiles($model,$typeOfProject,$VersionOfApi,$spaceOfWork);
        $find=$this->FindFiles($id);

        $this->line($id);
        if($find){
            $this->line('Found');

        }
        else{
            $this->line('Not Found');
            $this->ExcuteFiles($id);
        }
        //$this->DeleteFiles('1');

    }

    public function FindOrCreate($path)
    {
        if(!file_exists($path))
        {
        mkdir($path, 0777, true);
        }
    }
    public function SearchFiles($path)
    {
        if(file_exists($path))
        {
            return true;
        }
        else {
            return false;
        }
    }
    public function FindFiles($id)
    {
        $searched=ModelCommand::find($id);
        $commands=ModelCommand::
        where('name',$searched->name)
            ->where('project_type',$searched->project_type)
            ->where('version_api',$searched->version_api)
            ->where('space_work',$searched->space_work)
            ->where('published','=','1')
            ->get();

        if($commands->count()>=1){
            return true;
        }
    }
    public function ExcuteFiles($id)
    {
        $command=ModelCommand::find($id);
        $command->published=1;
        $command->update();
    }
    public function BackupFiles($id)
    {
        Artisan::call("gencmd:backup", ['--id' =>$id]);
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
    public function DeleteFiles($id)
    {
        Artisan::call("gencmd:delete", ['--id' =>$id]);

    }
    public function ShowFiles($id)
    {
        Artisan::call("gencmd:show", ['--id' =>$id]);
    }
}
