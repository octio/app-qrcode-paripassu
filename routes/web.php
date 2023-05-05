<?php

use App\Http\Controllers\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class,'index']);

Route::post('qr-code', function (Request $request) {
    $url = "http://pqr.io/01/".str_pad($request->produto,14,"0",STR_PAD_LEFT)."/10/".$request->codigo."?17=".substr(preg_replace("/[^0-9]/","",$request->data),2,6);
    //return QrCode::size(200)->generate('www.google.com.br');
   return QrCode::size(200)->format('png')->generate('www.google.com.br');
    //return "<p><a target='_blank' href='{$url}'>{$url}</a></p><hr />"."<img src='data:image/png;base64, " .  base64_encode(QrCode::size(200)->format('png')->generate($url)). "'/><hr />";
});
