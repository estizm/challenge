<?php

namespace App\Jobs;

use App\Http\Controllers\CategoriesController;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class ImportCategories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $data = [];
            $files = Storage::disk('categories')->files();
            foreach ($files as $key => $value) {
                $parseFileName = explode('-', $value);
                $parsedFileName = str_replace('.xlsx', '', $parseFileName[1]);
                array_push($data, $parsedFileName);
                asort($data);
            }


            Excel::import(new CategoriesImport(), storage_path('app/categories/kategoriler-' . end($data) . '.xlsx'));
            $data = [
                'title' => 'Kategori import İşlemi',
                'body'  => 'Kategori import işlemi başarıyla tanımlandı'
            ];

        } catch (\Exception $error) {
             dd($error->getMessage());
        }
       return Mail::send('emails.sendInformation', $data, function ($message) {
            $message->from('import@laravel.dev', 'Laravel Challange');
            $message->subject('Kategori import işlem detayı');
            $message->to('foo@example.com');
        });
    }
}
