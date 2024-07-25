# Core Project
- Mọi thắc mắc liên hệ qua face <a href="https://www.facebook.com/TrungPhuNA" name = "I">Liên hệ </a>

## Mục lục
[I. Giới thiệu](#I)
- Build thư viện này nhằm mục đích tiết kiệm thời gian code lại, copy từ dự án này qua dự án khác
- Tăng hiệu năng trong công việc hihi.

[II. Cài đặt](#II)
```bash
composer require corebase/project
```
Khai báo service config/app.php
```php
'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        ...
        Core\Project\Providers\CoreServiceProvider::class,
        ...
    ])->toArray(),
```
Publish config, migrate
```bash
php artisan vendor:publish --tag="core_project_migrate"
```
[III. Ví dụ sử dụng](#III)

Ví dụ về việc logs lại quá trình gủi email
```php 
<?php

namespace App\Jobs;

use App\Mail\SendMailTest;
use Core\Project\Illuminate\LogEmail\LogEmailEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class JobSendEmailTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $mailable = new SendMailTest($this->data);
            Mail::to("codethue94@gmail.com")->send($mailable);
            event(new LogEmailEvent("codethue94@gmail.com", $this->data['title'] ?? "", $this->data['body'] ?? "", 'success'));
        } catch (\Exception $e) {
            event(new LogEmailEvent("codethue94@gmail.com", $this->data['title'] ?? "", $this->data['body'] ?? "", 'failure', $e->getMessage()));
        }
    }
}
```
