<?php

namespace Core\Project\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CommandResetLogEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs-email:delete-old {days=30}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete logs older than specified number of days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $days = $this->argument('days');
            $date = now()->subDays($days);
            $this->info(" Time :  {$date}.");
            DB::table('email_logs')->where('created_at', '<', $date)->delete();

            $this->info("Deleted logs older than {$days} days.");
        }catch (\Exception $exception){
            \Log::error("=======[CommandResetLogEmail] File: "
                    . $exception->getFile()
                    . " Line: " . $exception->getLine()
                    . " Message: " . $exception->getMessage());
        }
    }
}
