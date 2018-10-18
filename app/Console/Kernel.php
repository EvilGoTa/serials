<?php

namespace App\Console;

use App\Serial;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function() {
            $questions = [
                1 => 'humor',
                2 => 'drama',
                3 => 'melodrama',
                4 => 'trash',
                5 => 'action',
                6 => 'erotic',
                7 => 'beauty',
                8 => 'concept',
                9 => 'story',
                10 => 'fantastic',
                11 => 'wow',
                12 => 'criminal',
                13 => 'horror',
            ];
            $marks = DB::table('marks')->selectRaw('serial_id, question_id, avg(mark_value) as value')
                ->groupBy('serial_id')
                ->groupBy('question_id')
                ->orderBy('serial_id')
                ->get();
            foreach ($marks as $m) {
                if (isset($serial)) {
                    if ($serial->id != $m->serial_id) {
                        $serial->save();
                        $serial = Serial::find($m->serial_id);
                    }
                } else {
                    $serial = Serial::find($m->serial_id);
                }
                $serial->{$questions[$m->question_id]} = $m->value;
            }
        })->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
