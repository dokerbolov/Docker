<?php

namespace App\Traits;

use App\Mail\ReportMail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

trait MailTrait
{
    public function sendBitrhdayEmail($user, array $copy_users) {
        Mail::to($user)
            ->cc($copy_users)
            ->send(new TestMail($user));
    }

    public function sendReportEmail(array $users, array $copy_users, $data, $page) {
        Mail::to($users)
            ->cc($copy_users)
            ->send(new ReportMail($data, $page));
    }
}
