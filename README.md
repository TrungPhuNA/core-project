# Core Project
- Mọi thắc mắc liên hệ qua face <a href="https://www.facebook.com/TrungPhuNA" name = "I">Liên hệ </a>

## Mục lục
[I. Giới thiệu](#I)

[II. Cài đặt](#II)

[III. Ví dụ sử dụng](#III)

<a name = "I"></a>
## I. Giới thiệu
- Build thư viện này nhằm mục đích tiết kiệm thời gian code lại, copy từ dự án này qua dự án khác
- Tăng hiệu năng trong công việc hihi.

<a name = "II"></a>
## II. Cài đặt
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
<a name = "III"></a>
## III. Ví dụ sử dụng

### Ví dụ về việc logs lại quá trình gủi email
Code mẫu
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

### Để xoá logs email bạn có thể sử dụng command 
```bash
php artisan logs-email:delete-old 100
```
- mặc đinh hệ thống sẽ xoá logs sau 30 ngày
- Nếu muốn tăng số ngày thì bạn truyền số ngày
- Mình cũng đã set job chạy hàng tuần để xoá dữ liệu các bạn có thể setup crontab cho project để job có thể chạy
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```
