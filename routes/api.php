<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\WebsiteContentResource;
use App\Models\WebsiteContent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/sections/{section}', function ($section) {
    return WebsiteContentResource::collection(WebsiteContent::where('section', $section)->get()->all());
});

Route::get('/sections', function () {
    return WebsiteContentResource::collection(WebsiteContent::get()->unique('section')->skip(3));
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
