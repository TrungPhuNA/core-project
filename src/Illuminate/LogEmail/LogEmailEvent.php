<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 7/25/24
 */

namespace Core\Project\Illuminate\LogEmail;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogEmailEvent
{
    use Dispatchable, SerializesModels;

    public $recipient;
    public $subject;
    public $subjectId = 0;
    public $body;
    public $status;
    public $error;
    public $subject_type;

    public function __construct($recipient, $subject, $subjectId, $body, $status, $error = null, $subject_type)
    {
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->subjectId = $subjectId;
        $this->body = $body;
        $this->status = $status;
        $this->error = $error;
        $this->subject_type = $subject_type;
    }
}