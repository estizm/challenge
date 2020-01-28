<?php

namespace App\Http\Controllers;

use App\Imports\CategoriesImport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{

    public function set()
    {
        try{
            $data = [];
            $files = Storage::disk('categories')->files();
            foreach ($files as $key => $value){
                $parseFileName   = explode('-',$value);
                $parsedFileName  =  str_replace('.xlsx','',$parseFileName[1]);
                array_push($data,$parsedFileName);
                asort($data);
            }


            Excel::import(new CategoriesImport(), storage_path('app/categories/kategoriler-'.end($data).'.xlsx'));
            //MailController::categoryInformation();
        }catch (\Exception $error){
            return $error->getMessage();
        }
    }
}
