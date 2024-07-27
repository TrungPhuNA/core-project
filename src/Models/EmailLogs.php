<?php

namespace Core\Project\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLogs extends Model
{
    use HasFactory;

    protected $table = 'email_logs';
    protected $casts = [
        'recipients' => 'array'
    ];
}
