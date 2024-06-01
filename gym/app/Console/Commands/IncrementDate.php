<?php

namespace App\Console\Commands;

use App\Models\ScheduledClass;
use Illuminate\Console\Command;

class IncrementDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:increment-date {--days=1}';

    /**
     * Command: IncrementScheduledClassesDate
     *
     * Description:
     * This command increments the date of all scheduled classes by a specified number of days (default is 1).
     * It ensures that classes are sorted in ascending order based on the new date to prevent potential
     * issues where incrementing a class on a specific day might overlap with a future class, causing
     * incorrect date calculations. Sorting the classes ensures that future classes are processed first,
     * followed by the oldest ones.
     *
     * Execute the console command:
     * php artisan scheduled-classes:increment-date
     * php artisan scheduled-classes:increment-date --days=2
     *
     * Options:
     * --days=1 : The number of days to increment the scheduled classes' dates by (default is 1).

     */
    protected $description = 'Increment the date of all scheduled classes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scheduledClasses = ScheduledClass::latest('date_time')->get();
        $scheduledClasses->each(function ($class) {
            $class->date_time = $class->date_time->addDays($this->option('days'));
            $class->save();
        });
    }
}