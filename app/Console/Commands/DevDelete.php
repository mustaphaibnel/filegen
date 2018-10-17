<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Command as ModelCommand;
class DevDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gencmd:delete {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete a cmd';

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
        if($id){
            ModelCommand::destroy($id);
        }
        else{
            ModelCommand::destroy('1');

        }

    }
}
