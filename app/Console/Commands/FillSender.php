<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FillSender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'senders:fill';

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
    public function handle()
    {
        $senders = [
            ['email' => 'donkolia89@gmail.com', 'password' => 'Moyarobota200'],
            ['email' => 'aniamala252627@gmail.com', 'password' => 'Moyarobota200'],
            ['email' => 'sotniklida7@gmail.com', 'password' => 'Moyarobota200'],
            ['email' => 'lodznastia@gmail.com', 'password' => 'Moyarobota200'],
            ['email' => 'riabyysasha@gmail.com', 'password' => 'Moyarobota200'],
            ['email' => 'andriykirilov232425@gmail.com', 'password' => 'Moyarobota200'],
            ['email' => 'mishalanets@gmail.com', 'password' => 'Moyarobota200'],
            ['email' => 'ivanpetrov121314151699@gmail.com', 'password' => 'Moyarobota200'],
            ['email' => 'lubovayana46@gmail.com', 'password' => 'Moyarobota200'],
            ['email' => 'fondovihor@gmail.com', 'password' => 'Moyarobota200'],
            ['email' => 'mashatverska@gmail.com', 'password' => 'Moyarobota200'],
            ['email' => 'wert50947@gmail.com', 'password' => 'cDV9vgHTw3X8bEF'],
            ['email' => 'slava.u62.1@gmail.com', 'password' => 'SlavaUkraini123'],
            ['email' => 'ukrainislava199123a@gmail.com', 'password' => 'SlavaUkraini123'],
            ['email' => 'slava.u0001@gmail.com', 'password' => 'SlavaUkraini123'],
            ['email' => 'slava.u0002@gmail.com', 'password' => 'SlavaUkraini123'],
            ['email' => 'slava.u0003@gmail.com', 'password' => 'SlavaUkraini123'],
            ['email' => 'arishe4nka@gmail.com', 'password' => 'MangustInn'],
            ['email' => 'irina.kruglove@gmail.com', 'password' => 'MangustInn'],
        ];
        DB::table('senders')->insert($senders);

        return 0;
    }
}
