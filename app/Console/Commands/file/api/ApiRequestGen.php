<?php

namespace App\Console\Commands\file\api;

use Illuminate\Console\Command;
use App\Command as ModelCommand;
class ApiRequestGen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filegen:apirequest {id}';

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
    }
    public function CmdFile($id)
    {
        return ModelCommand::find($id);
    }
}
