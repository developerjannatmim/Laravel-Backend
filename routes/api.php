<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\AuthController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::controller(AdminController::class)->group(function () {

  Route::group(['prefix' => 'profile'], function () {
    Route::get('', 'profile');
  });

    //Admin user route
    Route::group(['prefix' => 'admin'], function () {
        Route::get('', 'admin_list');
        Route::post('', 'admin_store');
        Route::group(['prefix' => '{admin}'], function () {
            Route::get('', 'admin_show');
            Route::put('', 'admin_update');
            Route::delete('', 'admin_destroy');
        });
    });

  //Student user route
  Route::group(['prefix' => 'students'], function () {
    Route::get('', 'student_list');
    Route::post('', 'student_store');
    Route::group(['prefix' => '{student}'], function () {
      Route::get('', 'student_show');
      Route::put('', 'student_update');
      Route::delete('', 'student_destroy');
    });
  });

  //Parent user route
  Route::group(['prefix' => 'parents'], function () {
    Route::get('', 'parent_list');
    Route::post('', 'parent_store');
    Route::group(['prefix' => '{parent}'], function () {
      Route::get('', 'parent_show');
      Route::put('', 'parent_update');
      Route::delete('', 'parent_destroy');
    });
  });

  //Teacher user route
  Route::group(['prefix' => 'teachers'], function () {
    Route::get('', 'teacher_list');
    Route::post('', 'teacher_store');
    Route::group(['prefix' => '{teacher}'], function () {
      Route::get('', 'teacher_show');
      Route::put('', 'teacher_update');
      Route::delete('', 'teacher_destroy');
    });
  });

  //Routine routes
  Route::group(['prefix' => 'routines'], function () {
    Route::get('', 'routine_list');
    Route::post('', 'routine_store');
    Route::group(['prefix' => '{routine}'], function () {
      Route::get('', 'routine_show');
      Route::put('', 'routine_update');
      Route::delete('', 'routine_destroy');
    });
  });

//Class Room routes
Route::group(['prefix' => 'classRooms'], function () {
  Route::get('', 'classRoom_list');
  Route::post('', 'classRoom_store');
  Route::group(['prefix' => '{classRoom}'], function () {
    Route::get('', 'classRoom_show');
    Route::put('', 'classRoom_update');
    Route::delete('', 'classRoom_destroy');
  });
});

//School route
Route::group(['prefix' => 'schools'], function () {
  Route::get('', 'school_list');
  Route::post('', 'school_store');
  Route::group(['prefix' => '{school}'], function () {
    Route::get('', 'school_show');
    Route::put('', 'school_update');
    Route::delete('', 'school_destroy');
  });
});

//Class route
Route::group(['prefix' => 'classes'], function () {
    Route::get('', 'class_list');
    Route::post('', 'class_store');
    Route::group(['prefix' => '{class}'], function () {
        Route::get('', 'class_show');
        Route::put('', 'class_update');
        Route::delete('', 'class_destroy');
    });
});

//Subject route
Route::group(['prefix' => 'subjects'], function () {
    Route::get('', 'subject_list');
    Route::post('', 'subject_store');
    Route::group(['prefix' => '{subject}'], function () {
        Route::get('', 'subject_show');
        Route::put('', 'subject_update');
        Route::delete('', 'subject_destroy');
    });
});

  //Marks route
  Route::group(['prefix' => 'marks'], function () {
    Route::get('', 'mark_list');
    Route::post('', 'mark_store');
    Route::group(['prefix' => '{mark}'], function () {
      Route::get('', 'mark_show');
      Route::put('', 'mark_update');
      Route::delete('', 'mark_destroy');
    });
  });

  //Exam route
  Route::group(['prefix' => 'exams'], function () {
    Route::get('', 'exam_list');
    Route::post('', 'exam_store');
    Route::group(['prefix' => '{exam}'], function () {
      Route::get('', 'exam_show');
      Route::put('', 'exam_update');
      Route::delete('', 'exam_destroy');
    });
  });

  //Grade routes
  Route::group(['prefix' => 'grades'], function () {
    Route::get('', 'grade_list');
    Route::post('', 'grade_store');
    Route::group(['prefix' => '{grade}'], function () {
      Route::get('', 'grade_show');
      Route::put('', 'grade_update');
      Route::delete('', 'grade_destroy');
    });
  });

//Syllabus routes
Route::group(['prefix' => 'syllabuses'], function () {
    Route::get('', 'syllabus_list');
    Route::post('', 'syllabus_store');
    Route::group(['prefix' => '{syllabus}'], function () {
        Route::get('', 'syllabus_show');
        Route::put('', 'syllabus_update');
        Route::delete('', 'syllabus_destroy');
    });
});
    
//Section routes
Route::group(['prefix' => 'sections'], function () {
    Route::get('', 'section_list');
    Route::post('', 'section_store');
    Route::group(['prefix' => '{section}'], function () {
    Route::get('', 'section_show');
    Route::put('', 'section_update');
    Route::delete('', 'section_destroy');
    });
});

});

