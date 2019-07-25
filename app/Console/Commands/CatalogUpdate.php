<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CatalogUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalog:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating product catalog from bizoutmax shop';

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
        
    }
}
