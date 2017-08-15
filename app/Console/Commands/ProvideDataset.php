<?php

namespace ActivismeBE\Console\Commands;

use ActivismeBE\Repositories\DataProcessingRepository;
use ActivismeBE\Repositories\DatasetRepository;
use Illuminate\Console\Command;

/**
 * Class ProvideDataset
 *
 * @package ActivismeBE\Console\Commands
 */
class ProvideDataset extends Command
{
    private $dataset;       /** @var $dataset The dataset repository.               */
    private $processing;    /** @var $processing The dataset processing repository. */

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dataset:prepare';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare the war datasets for the application.';

    /**
     * Create a new command instance.
     *
     * @param  DatasetRepository $dataset
     * @return void
     */
    public function __construct(DatasetRepository $dataset, DataProcessingRepository $processing)
    {
        parent::__construct();

        $this->dataset    = $dataset;
        $this->processing = $processing;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // TODO: Register flag that warns when the application has been running in production evironment.
        //       If in production. Kill the process.

        if ($this->dataset->countAllRecords() > 0) { // Check if the db table has records.
            // There are records in the database table. So empty the table for the dataset insert.
            if ($this->dataset->removeAllData('casualties')) {
                $this->info('[INFO]:    The database table is not empty. Beep Beep removing records.');
            }
        }

        if ($this->dataset->migrateKorea() && $this->dataset->migrateVietnam()) { // Insert the dataset into the database table.
            $this->info('[SUCCESS]: Datasets import.');
            $this->info('[INFO]:    Start modifing datasets. Beep Beep running.');

            // Progress bars setup's.
            $timestampBar = $this->output->createProgressBar($this->dataset->countAllRecords() * 6);
            $timestampBar->setFormat("%message%\n %current%/%max% [%bar%] %percent:3s%%");
            $timestampBar->setMessage("Converting dates to timestamps.");
            echo "\n";

            // Start modifying the table data.
            foreach ($this->dataset->getData() as $record) { // Loop through the records for processing.
                $this->processing->convertToTimestamp('full', 'birth_date', $record->birth_date);   // STEP 1: Set the birth date to timestamps.
                $this->processing->convertToTimestamp('full', 'process_dt', $record->process_dt);   // STEP 2: Set the process date to timestamps.
                $this->processing->convertToTimestamp('full', 'death_dt', $record->death_dt);       // STEP 3: Set the death date to timestamps.
                $this->processing->convertToTimestamp('year', 'year', $record->year);               // STEP 4: Set the year of death to timestamps.
                $this->processing->convertToTimestamp('full', 'close_dt', $record->close_dt);       // STEP 5: Set the closure date to timestamps.
                $this->processing->convertToTimestamp('full', 'i_status_dt', $record->i_status_dt); // STEP 6: Set the incident casualty category date to timestamps.
                $timestampBar->advance();
            }

            $timestampBar->finish();
            echo "\n";
        }
    }
}
