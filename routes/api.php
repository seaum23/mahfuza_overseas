<?php

use App\Http\Resources\PackageResource;
use App\Http\Resources\PackageSingleResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\WebsiteContentResource;
use App\Http\Resources\LogoBackgroundBrandNameResource;
use App\Models\Package;
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
    return WebsiteContent::where('section', $section)->value('image');
});

Route::get('/sections', function () {
    return WebsiteContentResource::collection(WebsiteContent::get()->unique('section')->skip(3));
});

Route::get('/packages/{package_section_id}', function ($package_section_id) {
    return PackageResource::collection(Package::where('package_section_id', $package_section_id)->get()->all());
});

Route::get('/package/{id}', function ($id) {
    return new PackageResource(Package::findOrFail($id));
});

Route::get('/package_detail/{id}', function ($id) {
    return Package::select('package_detail')->where('id', $id)->get()->toJson();
});

Route::get('/packages/{package_section_id}', function ($package_section_id) {
    return PackageResource::collection(Package::where('package_section_id', $package_section_id)->get()->all());
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/section_name/{id}', function ($id) {
    return WebsiteContent::where('id',$id)->value('section');
});