<?php

use App\Http\Controllers\IndexController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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
    $url = "http://pqr.io/01/".$request->produto."/10/".$request->codigo."?17=".substr(preg_replace("/[^0-9]/","",$request->data),2,6);
    //http://pqr.io/01/[EAN com 14 dígitos]/10/[Código de Rastreabilidade]?17=[data de validade - AAMMDD]
    
    return "<p><a target='_blank' href='{$url}'>{$url}</a></p>"."<img src='data:image/png;base64, " .  base64_encode(QrCode::size(200)->format('png')->generate($url)). "'/>";
});
