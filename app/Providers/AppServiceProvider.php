<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Backend\SMTP;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();


        $mailSetting = SMTP::getSingle();
        if (!empty($mailSetting))
        {
            $dataMail = [
                'driver'     =>$mailSetting->mail_mailer,
                'host'       =>$mailSetting->mail_host,
                'port'       =>$mailSetting->mail_port,
                'encryption' =>$mailSetting->mail_encryption,
                'username'   =>$mailSetting->mail_user_name,
                'password'   =>$mailSetting->mail_password,
                'form'       => [
                  'address' =>$mailSetting->mail_form_address,
                   'name'   =>$mailSetting->name
                   // 'name'   => "Muhammad Shakil"
                ]
            ];

            // app('config')->set('mail', $dataMail);
            Config::set('mail',$dataMail);
        }
    }
}
