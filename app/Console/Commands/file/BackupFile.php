<?php

namespace App\Console\Commands\file;
use App\Command as ModelCommand;
use Illuminate\Console\Command;

class BackupFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'genfile:backup {id}';

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
        $this->BackedFile($id);
    }
    public function BackedFile($id)
    {
        $command=ModelCommand::find($id);
        $command->backed_up=1;
        $command->update();
    }
}
