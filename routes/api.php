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


  Route::group(['prefix' => 'roles'], function () {
    Route::get('', 'role_list');
    Route::post('', 'role_store');
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

  Route::group(['prefix' => 'notice'], function () {
    Route::get('', 'notice_list');
    Route::post('', 'notice_store');
    Route::group(['prefix' => '{notice}'], function () {
      Route::get('', 'notice_show');
      Route::put('', 'notice_update');
      Route::delete('', 'notice_destroy');
    });
  });

  //Driver user route
  Route::group(['prefix' => 'driver'], function () {
    Route::get('', 'driver_list');
    Route::post('', 'driver_store');
    Route::group(['prefix' => '{driver}'], function () {
      Route::get('', 'driver_show');
      Route::put('', 'driver_update');
      Route::delete('', 'driver_destroy');
    });
  });

  //Admission route
  Route::group(['prefix' => 'admission'], function () {
    Route::get('', 'admission_list');
    Route::post('', 'admission_store');
    Route::group(['prefix' => '{admission}'], function () {
      Route::get('', 'admission_show');
      Route::put('', 'admission_update');
      Route::delete('', 'admission_destroy');
    });
  });

  //Back Office route
  Route::group(['prefix' => 'backOffice'], function () {
    Route::get('', 'backOffice_list');
    Route::post('', 'backOffice_store');
    Route::group(['prefix' => '{backOffice}'], function () {
      Route::get('', 'backOffice_show');
      Route::put('', 'backOffice_update');
      Route::delete('', 'backOffice_destroy');
    });
  });

  //Event route
  Route::group(['prefix' => 'event'], function () {
    Route::get('', 'event_list');
    Route::post('', 'event_store');
    Route::group(['prefix' => '{event}'], function () {
      Route::get('', 'event_show');
      Route::put('', 'event_update');
      Route::delete('', 'event_destroy');
    });
  });

  //Vehicle route
  Route::group(['prefix' => 'vehicles'], function () {
    Route::get('', 'vehicle_list');
    Route::post('', 'vehicle_store');
    Route::group(['prefix' => '{vehicles}'], function () {
      Route::get('', 'vehicle_show');
      Route::put('', 'vehicle_update');
      Route::delete('', 'vehicle_destroy');
    });
  });

  //Assign Student for vehicle
  Route::group(['prefix' => 'assignStudents'], function () {
    Route::get('', 'assignStudent_list');
    Route::post('', 'assignStudent_store');
    Route::group(['prefix' => '{assignStudents}'], function () {
      Route::get('', 'assignStudent_show');
      Route::put('', 'assignStudent_update');
      Route::delete('', 'assignStudent_destroy');
    });
  });

  //Accountant user route
  Route::group(['prefix' => 'accountant'], function () {
    Route::get('', 'accountant_list');
    Route::post('', 'accountant_store');
    Route::group(['prefix' => '{accountant}'], function () {
      Route::get('', 'accountant_show');
      Route::put('', 'accountant_update');
      Route::delete('', 'accountant_destroy');
    });
  });

  //Librarian user route
  Route::group(['prefix' => 'librarian'], function () {
    Route::get('', 'librarian_list');
    Route::post('', 'librarian_store');
    Route::group(['prefix' => '{librarian}'], function () {
      Route::get('', 'librarian_show');
      Route::put('', 'librarian_update');
      Route::delete('', 'librarian_destroy');
    });
  });

  //Exam Category route
  Route::group(['prefix' => 'exam_category'], function () {
    Route::get('', 'exam_category_list');
    Route::post('', 'exam_category_store');
    Route::group(['prefix' => '{exam_category}'], function () {
      Route::get('', 'exam_category_show');
      Route::put('', 'exam_category_update');
      Route::delete('', 'exam_category_destroy');
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

  //User Role routes
  Route::group(['prefix' => 'userRoles'], function () {
    Route::get('', 'userRole_list');
    Route::post('', 'userRole_store');
    Route::group(['prefix' => '{userRole}'], function () {
      Route::get('', 'userRole_show');
      Route::put('', 'userRole_update');
      Route::delete('', 'userRole_destroy');
    });
  });

  //User routes
  Route::group(['prefix' => 'users'], function () {
    Route::get('', 'user_list');
    Route::post('', 'user_store');
    Route::group(['prefix' => '{user}'], function () {
      Route::get('', 'user_show');
      Route::put('', 'user_update');
      Route::delete('', 'user_destroy');
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

