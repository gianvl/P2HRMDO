<?php

use App\Http\Controllers\{
    CollegeController,
    EvalDataReportController,
    EvalPageController,
    ForecastingDataController,
    ForecastingController,
    ForecastingSystemController,
    ProfessorController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['cors'])->group(function () {
    Route::get('/professor/{id}', [ProfessorController::class, 'professor'])->name('api.professor.professor');
    Route::get('/college/{college}/department', [CollegeController::class, 'departmentList'])->name('api.college.departmentList');
    Route::get('/college/{college}/department/{department}', [CollegeController::class, 'employeeList'])->name('api.college.employeeList');
    Route::get('/evaluation/check/{employeeId}/{ay}/{semester}', [EvalPageController::class, 'evaluationCheck'])->name('api.evalpage.evaluationCheck');
    Route::post('/evaluation/post', [EvalPageController::class, 'storeViaAPI'])->name('api.evalpage.storeViaAPI');
    Route::get('/evaluation/datareport/{employeeId}/{ayFrom}/{ayTo}', [EvalDataReportController::class, 'fetchEvalReport'])->name('api.evaldatareport.fetchEvalReport');
    Route::get('/evaluation/department/datareport/{department}/{ayFrom}/{ayTo}', [EvalDataReportController::class, 'fetchDepartmentEvalReport'])->name('api.evaldatareport.fetchDepartmentEvalReport');
    Route::get('/forecasting/system/{college}/{department}/{ay}/{semester}', [ForecastingSystemController::class, 'forecastingSystem'])->name('api.forecastingSystem.forecastingSystem');
    Route::get('/forecasting/professors/{college}/{department}', [ForecastingController::class, 'professorsDepartment'])->name('api.forecastingSystem.professorsDepartment');
    Route::get('/forecasting/professionalMajorSubjects/{ay}/{semester}', [ForecastingController::class, 'professionalMajorSubjects'])->name('api.forecastingSystem.professionalMajorSubjects');
    Route::get('/processing/forecastingdata/{college}/{department}/{ay}/{semester}', [ForecastingDataController::class, 'forecastingData'])->name('api.forecastingSystem.forecastingData');


});