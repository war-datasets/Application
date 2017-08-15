<?php

namespace ActivismeBE\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class DeleteDataset
 *
 * @todo: Build op the remove command.
 * @package ActivismeBE\Console\Commands
 */
class DeleteDataset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dataset:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean out the datasets from the database.';

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
