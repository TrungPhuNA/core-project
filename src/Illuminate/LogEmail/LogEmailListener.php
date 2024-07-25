<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 7/25/24
 */

namespace Helpers\Project\Illuminate\LogEmail;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class LogEmailListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(LogEmailEvent $event)
    {
        DB::table('email_logs')->insert([
            'recipient'  => $event->recipient,
            'subject'    => $event->subject,
            'body'       => $event->body,
            'status'     => $event->status,
            'error'      => $event->error,
            'created_at' => Carbon::now()
        ]);
    }
}