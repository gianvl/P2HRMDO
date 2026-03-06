<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MRFormController;
use App\Http\Controllers\MRFormApprovalController;
use App\Http\Controllers\EvalPageController;
use App\Http\Controllers\EvalDataReportController;
use App\Http\Controllers\DeptEvalDataReportController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForecastingController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ForecastingDataController;
use App\Http\Controllers\ForecastingSystemController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(
        route('login')
    );
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('/forgot-password', [AuthController::class, 'PostForgotPassword'])->name('PostForgotPassword');
Route::get('/reset/{token}', [AuthController::class, 'reset'])->name('reset');
Route::post('/reset/{token}', [AuthController::class, 'Postreset'])->name('Postreset');

// Route::get('/emp/list', function () {
//     $usersQuery = DB::select('SELECT id, user_id, first_name, last_name, 
//     email, prefix, specialization, college, department, emp_type, emp_no, image, 
//     employment_status, hired_at, resigned_at, created_at, updated_at FROM employees');

//     if (!empty($usersQuery)) {
//         $usersList = [];
//         foreach ($usersQuery as $value) {
//             $tempArray = [
//                 "id" => $value->id,
//                 "user_id" => $value->user_id,
//                 "first_name" => $value->first_name,
//                 "last_name" => $value->last_name,
//                 "email" => $value->email,
//                 "prefix" => $value->prefix,
//                 "specialization" => $value->specialization,
//                 "college" => $value->college,
//                 "department" => $value->department,
//                 "emp_type" => $value->emp_type,
//                 "emp_no" => $value->emp_no,
//                 "image" => $value->image,
//                 "employment_status" => $value->employment_status,
//                 "hired_at" => $value->hired_at,
//                 "resigned_at" => $value->resigned_at,
//                 "created_at" => $value->created_at,
//                 "updated_at" => $value->updated_at
//             ];
//             array_push($usersList, $tempArray);
//         }
//         $usersResponse = [
//             "data" => $usersList
//         ];
//         return response()->json($usersResponse);
//     } else {
//         return response()->json([
//             "message" => "No employees found"
//         ], 404);
//     }
// });

// Route::get('/emp/{id}',function($id){
//     $userIdQuery = DB::select('SELECT id, user_id, first_name, last_name, 
//     email, prefix, specialization, college, department, emp_type, emp_no, image, 
//     employment_status, hired_at, resigned_at, created_at, updated_at FROM employees WHERE id = ?', [$id]);

//     if($userIdQuery != null)
//     {
//         $userIdQueryObj = array();
//         foreach($userIdQuery as $value)
//         {
//             $tempArray = array(
//                 "id" => $value->id,
//                 "user_id" => $value->user_id,
//                 "first_name" => $value->first_name,
//                 "last_name" => $value->last_name,
//                 "email" => $value->email,
//                 "prefix" => $value->prefix,
//                 "specialization" => $value->specialization,
//                 "college" => $value->college,
//                 "department" => $value->department,
//                 "emp_type" => $value->emp_type,
//                 "emp_no" => $value->emp_no,
//                 "image" => $value->image,
//                 "employment_status" => $value->employment_status,
//                 "hired_at" => $value->hired_at,
//                 "resigned_at" => $value->resigned_at,
//                 "created_at" => $value->created_at,
//                 "updated_at" => $value->updated_at
//             );
//             array_push($userIdQueryObj, $tempArray);
//         }
//         $objectUserQuery = (object)[
//             // "key" => $value,
//             "data" => $userIdQueryObj
//         ];
//         return response()->json($objectUserQuery);
//     }
//     else
//     {
//         return response()->json([
//             "message" => "Employee ID not found"
//         ], 404);
//     }
// });


// Route::post('/emp/new', function (Request $request) {
//     // Validate incoming request data
//     $validator = Validator::make($request->all(), [
//         'first_name' => 'required|string',
//         'last_name' => 'required',
//         'email' => 'required|email|unique:employees',
//         'prefix' => 'required',
//         'specialization' => 'required',
//         'college' => 'required',
//         'department' => 'required',
//         'emp_type' => 'required',
//         'emp_no' => 'required',
//         'employment_status' => 'required',
//         'hired_at' => 'required',
        
//     ]);

//     // If validation fails, return an error response
//     if ($validator->fails()) {
//         return response()->json([
//             'message' => 'Validation error',
//             'errors' => $validator->errors()
//         ], 400);
//     }

//     // If validation passes, insert the new user into the database
//     $user = [
//         'first_name' => $request->input('first_name'),
//         'last_name' => $request->input('last_name'),
//         'email' => $request->input('email'),
//         'prefix' => $request->input('prefix'),
//         'specialization' => $request->input('specialization'),
//         'college' => $request->input('college'),
//         'department' => $request->input('department'),
//         'emp_type' => $request->input('emp_type'),
//         'emp_no' => $request->input('emp_no'),
//         'employment_status' => $request->input('employment_status'),
//         'hired_at' => $request->input('hired_at'),
//         // Add more fields as needed
//     ];

//     // Insert the user into the 'users' table
//     $userId = DB::table('employees')->insertGetId($user);

//     // Retrieve the created user from the database
//     $createdUser = DB::table('employees')->where('id', $userId)->first();

//     return response()->json([
//         'message' => 'Employee created successfully',
//         'data' => $createdUser
//     ], 201);
// });


Route::group(['middleware' => 'auth'], function(){

    Route::group(['middleware' => 'AdminProcessing'], function(){

        //WILL SHOW PROCESSING DASHBOARD//
        Route::resource('/processing/processingdashboard', HRController::class);

        //SHOW COMPLETED MRFORM//
        Route::get('/processing/processingdashboard/completed/{mrNumProcessing}', [HRController::class, 'show2'])->name('processingdashboard.show2');

        //USER MANAGEMENT PAGE//
        Route::resource('users', UsersController::class);
        Route::post('users/{user}/assignRole', [UsersController::class, 'assignRole'])->name('users.assignRole');
        Route::delete('users/{user}/removeRole/{role}', [UsersController::class, 'removeRole'])->name('users.removeRole');

        //HANDLES THE STATUS OF MRFORM//
        // Route::put('/mrform/pending/{mrform}', [MRFormController::class, 'pending'])->name('pending');
        Route::put('mrform/completed/{mrform}', [HRController::class, 'completed'])->name('completed');

        //SHOW FACULTY PAGE//
        Route::resource('/processing/faculty', FacultyController::class);
        Route::get('/processing/faculty/{id}/delete', [FacultyController::class, 'destroy'])->name('faculty.delete');

        Route::resource('/processing/forecastingdata', ForecastingDataController::class);

        Route::resource('/processing/forecastingsystem', ForecastingSystemController::class);

        //SHOW COMPLETED FORECAST FORM//
        Route::get('/processingdashboard/forecastform/{forecast_num_id}', [HRController::class, 'showForecastForm'])->name('processingdashboard.showForecastForm');

        /*USER PROFILE*/
        Route::get('/processing/profile', [ProfileController::class, 'showProcessingProfile'])->name('showProcessingProfile');
        Route::put('/processing/profile/update{id}', [ProfileController::class, 'updateProcessingProfile'])->name('updateProcessingProfile');

    });
    

    Route::group(['middleware' => 'UserRequesting'], function(){

        //WILL SHOW REQUESTING DASHBOARD//
        Route::resource('/requesting/requestingdashboard', MRFormController::class);

        //SEND MRFORM TO APPROVAL//
        Route::post('/manpower/send-for-approval/{mrf}', [MRFormController::class, 'sendForApproval'])->name('manpower.send-for-approval');
        
        //WILL SHOW INPUTEVALPAGE//
        Route::resource('/requesting/editperformanceEvaluation', EvalPageController::class);

        //WILL SHOW SAVEEVALPAGE//
        Route::get('/editperformanceEvaluation/save/{id}', [App\Http\Controllers\EvalPageController::class, 'show'])->name('evalpages.show');
        
        //WILL SHOW EVALUATION DATA REPORTS//
        Route::resource('/requesting/evaldatareport', EvalDataReportController::class);

        //WILL SHOW DEPARTMENT EVALUATION DATA REPORTS//
        Route::resource('/requesting/deptevaldatareport', DeptEvalDataReportController::class);

        //PRINT PAGES//
        Route::get('/mrpages/showmrform', [PrintController::class, 'printMRPage']);
        Route::get('/evalpages/saveevalpage', [PrintController::class, 'printEvalPage']);

        /*FORECASTING*/
        Route::resource('/requesting/forecast', ForecastingController::class);
        Route::get('/forecast/save/{forecast_num_id}', [App\Http\Controllers\ForecastingController::class, 'show']);
        Route::post('/forecast/save/{forecast_num_id}', [App\Http\Controllers\ForecastingController::class, 'getDepartments'] );
        Route::get('departments/{college}', [ForecastingController::class, 'getDepartments'])->name('departments');

        /*SEND FORECAST TO APPROVAL*/
        Route::post('/forecasting/send-for-approval/{fs1}', [ForecastingController::class, 'sendForApproval'])->name('forecasting.send-for-approval');

        /*USER PROFILE*/
        Route::resource('/requesting/profile', ProfileController::class);

        /*ARIMA FORECAST PAGE*/
        Route::get('/requesting/arimaforecast', [ForecastingDataController::class, 'viewArimaRequesting'])->name('requesting.arima');

    });


    Route::group(['middleware' => 'UserApproval'], function(){

        //WILL SHOW APPROVAL DASHBOARD//
        Route::resource('/approval/approvaldashboard', MRFormApprovalController::class);

        //VIEW APPROVE/DISAPPROVE MRFORM//
        Route::get('/approvaldashboard/{mrNumApproved}', [MRFormApprovalController::class, 'show2'])->name('approvaldashboard.show2');

        //APPROVE MRFORM//
        Route::put('/mrform/approve/{mrform}', [MRFormApprovalController::class, 'approve'])->name('approve');

        //DISAPPROVE MRFORM//
        Route::put('mrform/disapprove/{mrform}', [MRFormApprovalController::class, 'disapprove'])->name('disapprove');

        //VIEW ATTACH SIGNATURE FORECASTFORM//
        Route::get('/approvaldashboard/forecastform/{forecast_num_id}', [MRFormApprovalController::class, 'show3'])->name('approvaldashboard.show3');

        //SAVE ATTACH SIGNATURE FORECASTFORM//
        Route::put('/approvaldashboard/forecastform/save/signature/{forecast_num_id}', [MRFormApprovalController::class, 'updateForecastForm'])->name('approvaldashboard.updateForecastForm');

        //VIEW APPROVE/DISAPPROVE FORECASTFORM//
        Route::get('/approvaldashboard/forecastform/view/{forecast_num_id}', [MRFormApprovalController::class, 'show4'])->name('approvaldashboard.show4');

        //APPROVE FORECAST FORM//
        Route::put('/forecastform/approve/{fs1}', [MRFormApprovalController::class, 'approveForecastForm'])->name('approveForecastForm');

        //DISAPPROVE FORECAST FORM//
        Route::put('forecastform/disapprove/{fs1}', [MRFormApprovalController::class, 'disapproveForecastForm'])->name('disapproveForecastForm');

        /*USER PROFILE*/
        Route::get('/approval/profile', [ProfileController::class, 'showApprovalProfile'])->name('showApprovalProfile');
        Route::put('/approval/profile/update{id}', [ProfileController::class, 'updateApprovalProfile'])->name('updateApprovalProfile');

        /*ARIMA FORECAST PAGE*/
        Route::get('/approval/arimaforecast', [ForecastingDataController::class, 'viewArimaApproval'])->name('approval.arima');
    });

});


