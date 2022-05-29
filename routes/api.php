<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\RadioNarrationsController;
use App\Http\Controllers\Api\RadioHostingController;
use App\Http\Controllers\Api\RadioQuickNewsController;
use App\Http\Controllers\Api\RadioSponsorshipController;
use App\Http\Controllers\Api\RadioTvController;
use App\Http\Controllers\Api\RadioRecordingController;
use App\Http\Controllers\Api\RadioOutdoorStreamingController;
use App\Http\Controllers\Api\TvNarrationsController;
use App\Http\Controllers\Api\TvHostingController;
use App\Http\Controllers\Api\TvSponsorshipController;
use App\Http\Controllers\Api\TvOutdoorStreamingController;

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

Route::group(['prefix' => 'auth'], function(){
		
    Route::post('register', [AuthController::class, 'register']);
    Route::post('verify', [AuthController::class, 'verify']);
    Route::post('resend_code', [AuthController::class, 'resend_code']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot', [AuthController::class, 'forgot']);
    Route::get('reset/{token}', [AuthController::class, 'find']);
    Route::post('reset', [AuthController::class, 'reset']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:api']);
    
    // Route::post('social/{provider}', 'AuthController@socialLogin');
    
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('home', [HomeController::class, 'index']);
    Route::get('categories', [HomeController::class, 'categories']);

    //radio
    Route::prefix('radio')->group(function () {
        Route::get('services', [RadioNarrationsController::class, 'radio_services']);
        Route::get('get_service_radios/{service_id}', [RadioNarrationsController::class, 'get_service_radios']);
        //narrations
        Route::get('narrations/{radio_id}', [RadioNarrationsController::class, 'radio_narrations']);
        Route::post('narrations_select_times', [RadioNarrationsController::class, 'narrations_select_times']);
        Route::post('set_narration_order', [RadioNarrationsController::class, 'set_narration_order']);
        //hosting
        Route::get('browse_radio/{radio_id}', [RadioHostingController::class, 'browse_radio']);
        Route::get('radio_programs/{radio_id}', [RadioHostingController::class, 'radio_programs']);
        Route::get('program_details/{program_id}', [RadioHostingController::class, 'program_details']);
        Route::get('program_hosting_details/{program_id}', [RadioHostingController::class, 'program_hosting_details']);
        // Route::post('get_hosting_price', [RadioHostingController::class, 'get_hosting_price']);
        Route::post('set_hosting_order', [RadioHostingController::class, 'set_hosting_order']);
        //quick news
        Route::get('quick_news_details/{program_id}', [RadioQuickNewsController::class, 'quick_news_details']);
        Route::post('set_quick_news_order', [RadioQuickNewsController::class, 'set_quick_news_order']);
        //sponsorships
        Route::get('sponsorship_programs/{radio_id}', [RadioSponsorshipController::class, 'sponsorship_programs']);
        Route::get('sponsorship_details/{program_id}', [RadioSponsorshipController::class, 'sponsorship_details']);
        Route::post('set_sponsorship_order', [RadioSponsorshipController::class, 'set_sponsorship_order']);
        //radio TV
        Route::get('radio_tv_details/{radio_id}', [RadioTvController::class, 'radio_tv_details']);
        Route::post('radio_tv_get_price', [RadioTvController::class, 'radio_tv_get_price']);
        Route::post('set_tv_order', [RadioTvController::class, 'set_tv_order']);
        //radio recording     
        Route::get('radio_recording_details/{radio_id}', [RadioRecordingController::class, 'radio_recording_details']);
        Route::post('set_recording_order', [RadioRecordingController::class, 'set_recording_order']);
        //outdoor streaming
        Route::get('outdoor_streaming_details/{radio_id}', [RadioOutdoorStreamingController::class, 'outdoor_streaming_details']);
        Route::post('set_outdoor_streaming_order', [RadioOutdoorStreamingController::class, 'set_outdoor_streaming_order']);
    });

    Route::prefix('tv')->group(function () {
        Route::get('services', [TvNarrationsController::class, 'tv_services']);
        Route::get('get_service_channels/{service_id}', [TvNarrationsController::class, 'get_service_channels']);
        //narrations
        Route::get('narrations/{channel_id}', [TvNarrationsController::class, 'tv_narrations']);
        Route::post('narrations_select_times', [TvNarrationsController::class, 'narrations_select_times']);
        Route::post('set_narration_order', [TvNarrationsController::class, 'set_narration_order']);
        //hosting
        Route::get('browse_tv_channel/{channel_id}', [TvHostingController::class, 'browse_tv_channel']);
        Route::get('tv_programs/{channel_id}', [TvHostingController::class, 'tv_programs']);
        Route::get('program_details/{program_id}', [TvHostingController::class, 'program_details']);
        Route::get('program_hosting_details/{program_id}', [TvHostingController::class, 'program_hosting_details']);
        Route::post('set_hosting_order', [TvHostingController::class, 'set_hosting_order']);
        // sponsorship
        Route::get('sponsorship_programs/{channel_id}', [TvSponsorshipController::class, 'sponsorship_programs']);
        Route::get('sponsorship_details/{program_id}', [TvSponsorshipController::class, 'sponsorship_details']);
        Route::post('set_sponsorship_order', [TvSponsorshipController::class, 'set_sponsorship_order']);
        //outdoor streaming
        Route::get('outdoor_streaming_details/{channel_id}', [TvOutdoorStreamingController::class, 'outdoor_streaming_details']);
        Route::post('set_outdoor_streaming_order', [TvOutdoorStreamingController::class, 'set_outdoor_streaming_order']);
    });
});