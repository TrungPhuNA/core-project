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
    public $body;
    public $status;
    public $error;

    public function __construct($recipient, $subject, $body, $status, $error = null)
    {
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->body = $body;
        $this->status = $status;
        $this->error = $error;
    }
}