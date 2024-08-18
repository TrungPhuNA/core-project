<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 7/25/24
 */

namespace Core\Project\Illuminate\LogEmail;

use Carbon\Carbon;
use Core\Project\Models\EmailLogs;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class LogEmailListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(LogEmailEvent $event)
    {
        EmailLogs::insert([
            'recipient'  => is_array($event->recipient) ? null : $event->recipient,
            'recipients' => is_array($event->recipient) ? json_encode($event->recipient) : null,
            'subject'    => $event->subject,
            'subject_id'    => $event->subjectId,
            'body'       => $event->body,
            'status'     => $event->status,
            'error'      => $event->error,
            'created_at' => Carbon::now()
        ]);
    }
}