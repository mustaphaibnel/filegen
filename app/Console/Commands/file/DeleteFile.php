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
        $this->DisableFile($id);
    }
    public function DisableFile($id)
    {
        $command=ModelCommand::find($id);
        $command->published=0;
        $command->update();
    }
}
