<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobApplicationApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(JobApplicationApiController::class)->group(function () {
    Route::get('/applicants', 'getAllApplicants');
    Route::get('/applicant/{id}', 'getApplicantById');
    Route::post('/applicant', 'saveApplicant');
    Route::put('/applicant/{id}', 'updateApplicantById');
    Route::delete('/applicant/{id}', 'deleteApplicantById');
});
