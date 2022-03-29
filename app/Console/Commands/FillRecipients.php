<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SplFileObject;

class FillRecipients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rec:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $file = new SplFileObject(dirname(__DIR__, 3) . '/database/migrations/emails.csv', 'r');
        $file->seek(PHP_INT_MAX);
        $size = $file->key() + 1;

        $file = fopen(dirname(__DIR__, 3) . '/database/migrations/emails.csv', 'r');
        $counter = 0;
        $bar = $this->output->createProgressBar($size / 1000);
        $recipients = [];
        while (($line = fgetcsv($file)) !== false) {
            $recipients[] = [
                'name' => $line[0] ?? null,
                'email' => $line[1],
                'age' => (int)$line[2],
                'city' => $line[3] ?? null,
                'email_sent' => false
            ];

            if ($counter == 999) {
                DB::table('recipients')->insert($recipients);
                $counter = 0;
                $recipients = [];
                $bar->advance();
            } else {
                $counter++;
            }
        }

        $bar->finish();
        fclose($file);
        return 0;
    }
}
