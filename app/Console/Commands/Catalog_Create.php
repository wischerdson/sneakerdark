<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Catalog_Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalog:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create product catalog from scratch';

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
        //
    }
}
