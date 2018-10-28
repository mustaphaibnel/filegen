<?php

namespace App\Console\Commands\file;

use Illuminate\Console\Command;
use App\Command as ModelCommand;
class DeleteFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'genfile:delete {id}';

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

        if($cmdfile->project_type=='Api'){
            $pathcontroller=app_path("/Http/Controllers/{$cmdfile->project_type}/{$cmdfile->version_api}/{$cmdfile->name}.php");
            $pathcollection=app_path("/Http/Resources/{$cmdfile->project_type}/{$cmdfile->version_api}/{$cmdfile->name}.php");
            $pathresource=app_path("/Http/Resources/{$cmdfile->project_type}/{$cmdfile->version_api}/{$cmdfile->name}.php");
            $pathrequest=app_path("/Http/Requests/{$cmdfile->project_type}/{$cmdfile->version_api}/{$cmdfile->name}.php");

            $files=[
                $pathcontroller,
                $pathcollection,
                $pathresource,
                $pathrequest
            ];
            $this->Delete($files);

        }
        elseif($cmdfile->project_type=='Blade'){
            $files=[];
            $this->Delete($files);
        }
        elseif ($cmdfile->project_type=='Both'){
            $files=[];
            $this->Delete($files);
        }
        $this->info($this->Delete($cmdfile));
        //$this->DisableFile($id);
    }
    public function DisableFile($id)
    {
        $command=ModelCommand::find($id);
        $command->published=0;
        $command->update();
    }
    public function CmdFile($id)
    {
        return ModelCommand::find($id);
    }
    public function Delete($files){
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}
