<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //

    public function readCSV($csvFile, $array)
    {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
        }
        fclose($file_handle);
        return $line_of_text;
    }

    public function index(Type $var = null)
    {
        $date = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $daysToAdd = 10;
        $date = substr($date->addDays($daysToAdd), 0, 10);

        $csvFileName = "produtos.csv";
        $csvFile = storage_path('app/' . $csvFileName);
        $produtos=$this->readCSV($csvFile, array('delimiter' => ','));
        
        return view('form', ['validade' => $date,'produtos'=>$produtos]);
    }
}
