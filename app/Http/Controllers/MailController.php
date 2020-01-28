<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function categoryInformation()
    {
        $data = [
            'title' => 'Kategori import İşlemi',
            'body'  => 'Kategori import işlemi başarıyla tanımlandı'
        ];
        return Mail::send('emails.sendInformation', $data, function ($message) {
            $message->from('import@laravel.dev', 'Laravel Challange');
            $message->subject('Kategori import işlem detayı');
            $message->to('buradayim@90pixel.com');
        });
    }
}
