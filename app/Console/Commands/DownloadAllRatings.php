<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DownloadAllRatings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ratings:download:all {year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download all ratings';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump($this->argument('year'));
    }
}
