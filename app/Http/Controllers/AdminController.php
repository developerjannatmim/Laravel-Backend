<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountantRequest;
use App\Http\Requests\AccountantUpdateRequest;
use App\Http\Requests\ExamCategoryRequest;
use App\Http\Requests\ExamCategoryUpdateRequest;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\LibrarianRequest;
use App\Http\Requests\LibrarianUpdateRequest;
use App\Http\Requests\ClassesRequest;
use App\Http\Requests\ClassesUpdateRequest;
use App\Http\Requests\ClassRoomRequest;
use App\Http\Requests\ClassRoomUpdateRequest;
use App\Http\Requests\SubjectRequest;
use App\Http\Requests\SubjectUpdateRequest;
use App\Http\Requests\ExamRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Http\Requests\GradeRequest;
use App\Http\Requests\GradeUpdateRequest;
use App\Http\Requests\MarkRequest;
use App\Http\Requests\MarkUpdateRequest;
use App\Http\Requests\ParentRequest;
use App\Http\Requests\ParentUpdateRequest;
use App\Http\Requests\RoutineRequest;
use App\Http\Requests\SchoolRequest;
use App\Http\Requests\RoutineUpdateRequest;
use App\Http\Requests\SchoolUpdateRequest;
use App\Http\Requests\SectionRequest;
use App\Http\Requests\SectionUpdateRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Requests\SyllabusRequest;
use App\Http\Requests\SyllabusUpdateRequest;
use App\Http\Requests\TeacherRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Models\Classes;
use App\Models\Role;
use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use App\Models\ClassRoom;
use App\Models\Exam;
use App\Models\ExamCategory;
use App\Models\Grade;
use App\Models\Mark;
use App\Models\Routine;
use App\Models\Section;
use App\Models\Syllabus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

  public function role_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'roles' => Role::all(
          $column = [
            'id',
            'name',
          ],
        ),
      ],
      'message' => 'roles list',
    ]);
  }

//Admin
  public function admin_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'admin' => User::where('role_id', 1)->where('school_id', 1)->get(
          $column = [
            'id',
            'name',
            'email',
            'user_information'
          ],
        ),
      ],
      'message' => 'Admin List Created',
    ]);
  }

  public function admin_store(AdminRequest $request)
  {
    $validation = $request->validated();

    $file = $validation['photo'];
    $extension = $file->getClientOriginalExtension();
    $filename = time() . '-' . $extension;
    $file->move('admin-images/', $filename);
    $photo = $filename;

    $info = array(
      'gender' => $validation['gender'],
      'blood_group' => $validation['blood_group'],
      'birthday' => $validation['birthday'],
      'phone' => $validation['phone'],
      'address' => $validation['address'],
      'photo' => $photo,
    );

    $validation['user_information'] = json_encode($info);
    $admin = User::create([
      'name' => $validation['name'],
      'email' => $validation['email'],
      'password' => bcrypt($validation['password']),
      'user_information' => $validation['user_information'],
      'role_id' => '1',
      'school_id' => '1'
    ]);

    return response()->json([
      'status' => 200,
      'message' => 'Admin store successful.',
    ]);

  }

  public function admin_Show(User $admin)
  {
    $admin->user_information = json_decode($admin->user_information);
    return response()->json([
      'data' => [
        'admin' => $admin,
      ],
      'message' => 'Admin show successful.',
    ]);
  }

  public function admin_update(AdminUpdateRequest $request, User $admin)
  {
    $validation = $request->validated();

      $file = $validation['photo'];
      $extension = $file->getClientOriginalExtension();
      $filename = time() . '-' . $extension;
      $file->move('admin-images/', $filename);
      $photo = $filename;

      $info = array(
        'gender' => $validation['gender'],
        'blood_group' => $validation['blood_group'],
        'birthday' => $validation['birthday'],
        'phone' => $validation['phone'],
        'address' => $validation['address'],
        'photo' => $photo,
      );

      $validation['user_information'] = json_encode($info);

      User::where('id', $admin->id)->update([
        'name' => $validation['name'],
        'email' => $validation['email'],
        'user_information' => $validation['user_information']
      ]);

      return response()->json([
        'data' => $admin,
        'status' => 200,
        'message' => 'Admin update successful.',
      ]);

  }

  public function admin_destroy(User $admin)
  {
    $admin->delete();
    return response()->json([
      'data' => [
        'admin' => $admin,
      ],
      'message' => 'Admin deleted Successful.',
    ]);
  }

//Lirarian
  public function librarian_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'librarian' => User::where('role_id', 6)->where('school_id', 1)->get(
          $column = [
            'id',
            'name',
            'email',
            'user_information'
          ],
        ),
      ],
      'message' => 'Librarian List Created',
    ]);
  }

  public function librarian_store(LibrarianRequest $request)
  {
    $validation = $request->validated();

    $file = $validation['photo'];
    $extension = $file->getClientOriginalExtension();
    $filename = time() . '-' . $extension;
    $file->move('librarian-images/', $filename);
    $photo = $filename;

    $info = array(
      'gender' => $validation['gender'],
      'blood_group' => $validation['blood_group'],
      'birthday' => $validation['birthday'],
      'phone' => $validation['phone'],
      'address' => $validation['address'],
      'photo' => $photo,
    );

    $validation['user_information'] = json_encode($info);
    $librarian = User::create([
      'name' => $validation['name'],
      'email' => $validation['email'],
      'password' => bcrypt($validation['password']),
      'user_information' => $validation['user_information'],
      'role_id' => '6',
      'school_id' => '1'
    ]);

    return response()->json([
      'status' => 200,
      'message' => 'Librarian store successful.',
    ]);

  }

  public function librarian_Show(User $librarian)
  {
    $librarian->user_information = json_decode($librarian->user_information);
    return response()->json([
      'data' => [
        'librarian' => $librarian,
      ],
      'message' => 'Librarian show successful.',
    ]);
  }

  public function librarian_update(LibrarianUpdateRequest $request, User $librarian)
  {
    $validation = $request->validated();

      $file = $validation['photo'];
      $extension = $file->getClientOriginalExtension();
      $filename = time() . '-' . $extension;
      $file->move('librarian-images/', $filename);
      $photo = $filename;

      $info = array(
        'gender' => $validation['gender'],
        'blood_group' => $validation['blood_group'],
        'birthday' => $validation['birthday'],
        'phone' => $validation['phone'],
        'address' => $validation['address'],
        'photo' => $photo,
      );

      $validation['user_information'] = json_encode($info);

      User::where('id', $librarian->id)->update([
        'name' => $validation['name'],
        'email' => $validation['email'],
        'user_information' => $validation['user_information']
      ]);

      return response()->json([
        'data' => $librarian,
        'status' => 200,
        'message' => 'Librarian update successful.',
      ]);

  }

  public function librarian_destroy(User $librarian)
  {
    $librarian->delete();
    return response()->json([
      'data' => [
        'librarian' => $librarian,
      ],
      'message' => 'librarian deleted Successful.',
    ]);
  }

//Accountant
  public function accountant_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'accountant' => User::where('role_id', 5)->where('school_id', 1)->get(
          $column = [
            'id',
            'name',
            'email',
            'user_information'
          ],
        ),
      ],
      'message' => 'accountant List Created',
    ]);
  }

  public function accountant_store(AccountantRequest $request)
  {
    $validation = $request->validated();

    $file = $validation['photo'];
    $extension = $file->getClientOriginalExtension();
    $filename = time() . '-' . $extension;
    $file->move('accountant-images/', $filename);
    $photo = $filename;

    $info = array(
      'gender' => $validation['gender'],
      'blood_group' => $validation['blood_group'],
      'birthday' => $validation['birthday'],
      'phone' => $validation['phone'],
      'address' => $validation['address'],
      'photo' => $photo,
    );

    $validation['user_information'] = json_encode($info);
    $accountant = User::create([
      'name' => $validation['name'],
      'email' => $validation['email'],
      'password' => bcrypt($validation['password']),
      'user_information' => $validation['user_information'],
      'role_id' => '5',
      'school_id' => '1'
    ]);

    return response()->json([
      'status' => 200,
      'message' => 'Accountant store successful.',
    ]);

  }

  public function accountant_show(User $accountant)
  {
    $accountant->user_information = json_decode($accountant->user_information);
    return response()->json([
      'data' => [
        'accountant' => $accountant,
      ],
      'message' => 'Accountant show successful.',
    ]);
  }

  public function accountant_update(AccountantUpdateRequest $request, User $accountant)
  {
    $validation = $request->validated();

      $file = $validation['photo'];
      $extension = $file->getClientOriginalExtension();
      $filename = time() . '-' . $extension;
      $file->move('accountant-images/', $filename);
      $photo = $filename;

      $info = array(
        'gender' => $validation['gender'],
        'blood_group' => $validation['blood_group'],
        'birthday' => $validation['birthday'],
        'phone' => $validation['phone'],
        'address' => $validation['address'],
        'photo' => $photo,
      );

      $validation['user_information'] = json_encode($info);

      User::where('id', $accountant->id)->update([
        'name' => $validation['name'],
        'email' => $validation['email'],
        'user_information' => $validation['user_information']
      ]);

      return response()->json([
        'data' => $accountant,
        'status' => 200,
        'message' => 'Accountant update successful.',
      ]);

  }

  public function accountant_destroy(User $accountant)
  {
    $accountant->delete();
    return response()->json([
      'data' => [
        'accountant' => $accountant,
      ],
      'message' => 'Accountant deleted Successful.',
    ]);
  }

  //Student
  public function student_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'students' => User::where('role_id', 3)->where('school_id', 1)->get(
          $column = [
            'id',
            'name',
            'email',
            'user_information'
          ],
        ),
      ],
      'message' => 'students List Created',
    ]);
  }

  public function student_store(StudentRequest $request)
  {
    $validation = $request->validated();

    $file = $validation['photo'];
    $extension = $file->getClientOriginalExtension();
    $filename = time() . '-' . $extension;
    $file->move('student-images/', $filename);
    $photo = $filename;

    $info = array(
      'gender' => $validation['gender'],
      'blood_group' => $validation['blood_group'],
      'birthday' => $validation['birthday'],
      'phone' => $validation['phone'],
      'address' => $validation['address'],
      'photo' => $photo,
    );

    $validation['user_information'] = json_encode($info);
    $student = User::create([
      'name' => $validation['name'],
      'email' => $validation['email'],
      'password' => bcrypt($validation['password']),
      'user_information' => $validation['user_information'],
      'role_id' => '3',
      'school_id' => '1'
    ]);

    return response()->json([
      'status' => 200,
      'message' => 'Student store successful.',
    ]);
  }

  public function student_Show(User $student)
  {
    $student->user_information = json_decode($student->user_information);
    return response()->json([
      'data' => [
        'student' => $student,
      ],
      'message' => 'student show successful.',
    ]);
  }

  public function student_update(StudentUpdateRequest $request, User $student)
  {
    $validation = $request->validated();

      $file = $validation['photo'];
      $extension = $file->getClientOriginalExtension();
      $filename = time() . '-' . $extension;
      $file->move('student-images/', $filename);
      $photo = $filename;

      $info = array(
        'gender' => $validation['gender'],
        'blood_group' => $validation['blood_group'],
        'birthday' => $validation['birthday'],
        'phone' => $validation['phone'],
        'address' => $validation['address'],
        'photo' => $photo,
      );

      $validation['user_information'] = json_encode($info);

      User::where('id', $student->id)->update([
        'name' => $validation['name'],
        'email' => $validation['email'],
        'user_information' => $validation['user_information']
      ]);

      return response()->json([
        'data' => $student,
        'status' => 200,
        'message' => 'Student update successful.',
      ]);
  }

  public function student_destroy(User $student)
  {
    $student->delete();
    return response()->json([
      'data' => [
        'student' => $student,
      ],
      'message' => 'student deleted Successful.',
    ]);
  }

  //Guardian

  public function parent_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'parents' => User::where('role_id', 4)->get(
          $column = [
            'id',
            'name',
            'email',
            'user_information'
          ],
        ),
      ],
      'message' => 'parent List Created',
    ]);
  }

  public function parent_store(ParentRequest $request)
  {
    $validation = $request->validated();

    $file = $validation['photo'];
    $extension = $file->getClientOriginalExtension();
    $filename = time() . '-' . $extension;
    $file->move('parent-images/', $filename);
    $photo = $filename;

    $info = array(
      'gender' => $validation['gender'],
      'blood_group' => $validation['blood_group'],
      'birthday' => $validation['birthday'],
      'phone' => $validation['phone'],
      'address' => $validation['address'],
      'photo' => $photo,
    );

    $validation['user_information'] = json_encode($info);
    $parent = User::create([
      'name' => $validation['name'],
      'email' => $validation['email'],
      'password' => bcrypt($validation['password']),
      'user_information' => $validation['user_information'],
      'role_id' => '4',
      'school_id' => '1'
    ]);

    return response()->json([
      'status' => 200,
      'message' => 'Parent store successful.',
    ]);
  }

  public function parent_Show(User $parent)
  {
    $parent->user_information = json_decode($parent->user_information);
    return response()->json([
      'data' => [
        'parent' => $parent,
      ],
      'message' => 'parent show successful.',
    ]);
  }

  public function parent_update(ParentUpdateRequest $request, User $parent)
  {
    $validation = $request->validated();

      $file = $validation['photo'];
      $extension = $file->getClientOriginalExtension();
      $filename = time() . '-' . $extension;
      $file->move('parent-images/', $filename);
      $photo = $filename;

      $info = array(
        'gender' => $validation['gender'],
        'blood_group' => $validation['blood_group'],
        'birthday' => $validation['birthday'],
        'phone' => $validation['phone'],
        'address' => $validation['address'],
        'photo' => $photo,
      );

      $validation['user_information'] = json_encode($info);

      User::where('id', $parent->id)->update([
        'name' => $validation['name'],
        'email' => $validation['email'],
        'user_information' => $validation['user_information']
      ]);

      return response()->json([
        'data' => $parent,
        'status' => 200,
        'message' => 'Parent update successful.',
      ]);
  }

  public function parent_destroy(User $parent)
  {
    $parent->delete();
    return response()->json([
      'data' => [
        'parent' => $parent,
      ],
      'message' => 'parent deleted Successful.',
    ]);
  }

  //Teacher
  public function teacher_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'teachers' => User::where('role_id', 2)->get(
          $column = [
            'id',
            'name',
            'email',
            'user_information'
          ],
        ),
      ],
      'message' => 'teacher List Created',
    ]);
  }

  public function teacher_store(TeacherRequest $request)
  {
    $validation = $request->validated();

    $file = $validation['photo'];
    $extension = $file->getClientOriginalExtension();
    $filename = time() . '-' . $extension;
    $file->move('teacher-images/', $filename);
    $photo = $filename;

    $info = array(
      'gender' => $validation['gender'],
      'blood_group' => $validation['blood_group'],
      'birthday' => $validation['birthday'],
      'phone' => $validation['phone'],
      'address' => $validation['address'],
      'photo' => $photo,
    );

    $validation['user_information'] = json_encode($info);
    $teacher = User::create([
      'name' => $validation['name'],
      'email' => $validation['email'],
      'password' => bcrypt($validation['password']),
      'user_information' => $validation['user_information'],
      'role_id' => '2',
      'school_id' => '1'
    ]);

    return response()->json([
      'status' => 200,
      'message' => 'teacher store successful.',
    ]);
  }

  public function teacher_show(User $teacher)
  {
    $teacher->user_information = json_decode($teacher->user_information);
    return response()->json([
      'data' => [
        'teacher' => $teacher,
      ],
      'message' => 'teacher show successful.',
    ]);
  }

  public function teacher_update(TeacherUpdateRequest $request, User $teacher)
  {
    $validation = $request->validated();

      $file = $validation['photo'];
      $extension = $file->getClientOriginalExtension();
      $filename = time() . '-' . $extension;
      $file->move('teacher-images/', $filename);
      $photo = $filename;

      $info = array(
        'gender' => $validation['gender'],
        'blood_group' => $validation['blood_group'],
        'birthday' => $validation['birthday'],
        'phone' => $validation['phone'],
        'address' => $validation['address'],
        'photo' => $photo,
      );

      $validation['user_information'] = json_encode($info);

      User::where('id', $teacher->id)->update([
        'name' => $validation['name'],
        'email' => $validation['email'],
        'user_information' => $validation['user_information']
      ]);

      return response()->json([
        'data' => $teacher,
        'status' => 200,
        'message' => 'Teacher update successful.',
      ]);
  }

  public function teacher_destroy(User $teacher)
  {
    $teacher->delete();
    return response()->json([
      'data' => [
        'teacher' => $teacher,
      ],
      'message' => 'teacher deleted Successful.',
    ]);
  }

  //Class
  public function class_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'classes' => Classes::where('school_id', 1)->get(
          $column = [
            'id',
            'name',
            'section_id'
          ],
        ),
      ],
      'message' => 'class list',
    ]);
  }

  public function class_store(ClassesRequest $request)
  {
    return response()->json([
      'data' => [
        $validation = $request->validated(),
        'classes' => Classes::create([
          'name' => $validation['name'],
          'section_id' => $validation['section_id'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'class store successful.',
    ]);
  }

  public function class_show(Classes $class)
  {
    return response()->json([
      'data' => [
        'classes' => $class,
      ],
      'message' => 'class show successful.',
    ]);
  }

  public function class_update(ClassesUpdateRequest $request, Classes $class)
  {
    $class->update($request->validated());
    return response()->json([
      'data' => [
        'classes' => $class->update([
          'name' => $request['name'],
          'section_id' => $request['section_id'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'class update successful.',
    ]);
  }

  public function class_destroy(Classes $class)
  {
    $class->delete();
    return response()->json([
      'data' => [
        'classes' => $class,
      ],
      'message' => 'class deleted Successful.',
    ]);
  }

  //Subject
  public function subject_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'subjects' => Subject::where('school_id', 1)->get(
          $column = [
            'id',
            'name',
            'class_id'
          ],
        ),
      ],
      'message' => 'subjects list',
    ]);
  }

  public function subject_store(SubjectRequest $request)
  {
    return response()->json([
      'data' => [
        $validated = $request->validated(),
        'subject' => Subject::create([
          'name' => $validated['name'],
          'class_id' => $validated['class_id'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'subject store successful.',
    ]);
  }

  public function subject_show(Subject $subject)
  {
    return response()->json([
      'data' => [
        'subject' => $subject,
      ],
      'message' => 'subject show successful.',
    ]);
  }

  public function subject_update(SubjectUpdateRequest $request, Subject $subject)
  {
    $subject->update($request->validated());
    return response()->json([
      'data' => [
        'subject' => $subject->update([
          'name' => $request['name'],
          'class_id' => $request['class_id'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'subject update successful.',
    ]);
  }

  public function subject_destroy(Subject $subject)
  {
    $subject->delete();
    return response()->json([
      'data' => [
        'subject' => $subject,
      ],
      'message' => 'subject deleted Successful.',
    ]);
  }

  //Grades
  public function grade_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'grades' => Grade::get(
          $column = [
            'id',
            'name',
            'grade_point',
            'mark_from',
            'mark_upto'
          ],
        ),
      ],
      'message' => 'grade List Created',
    ]);
  }

  public function grade_store(GradeRequest $request)
  {
    return response()->json([
      'data' => [
        $validated = $request->validated(),
        'grade' => Grade::create([
          'name' => $validated['name'],
          'grade_point' => $validated['grade_point'],
          'mark_from' => $validated['mark_from'],
          'mark_upto' => $validated['mark_upto'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'grade store successful.',
    ]);
  }

  public function grade_show(Grade $grade)
  {
    return response()->json([
      'data' => [
        'grade' => $grade,
      ],
      'message' => 'grade show successful.',
    ]);
  }

  public function grade_update(GradeUpdateRequest $request, Grade $grade)
  {
    $grade->update($request->validated());
    return response()->json([
      'data' => [
        'grade' => $grade,
      ],
      'message' => 'grade update successful.',
    ]);
  }

  public function grade_destroy(Grade $grade)
  {
    $grade->delete();
    return response()->json([
      'data' => [
        'grade' => $grade,
      ],
      'message' => 'grade deleted Successful.',
    ]);
  }

  //Section
  public function section_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'sections' => Section::get(
          $column = [
            'id',
            'name'
          ],
        ),
      ],
      'message' => 'section List Created',
    ]);
  }

  public function section_show(Section $section)
  {
    return response()->json([
      'data' => [
        'section' => $section,
      ],
      'message' => 'section show successful.',
    ]);
  }

  public function section_store(SectionRequest $request)
  {
    return response()->json([
      'data' => [
        $validation = $request->validated(),
        'section' => Section::create([
          'name' => $validation['name'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'section store successful.',
    ]);
  }

  public function section_update(SectionUpdateRequest $request, Section $section)
  {
    $section->update($request->validated());
    return response()->json([
      'data' => [
        'section' => $section,
      ],
      'message' => 'section update successful.',
    ]);
  }

  public function section_destroy(Section $section)
  {
    $section->delete();
    return response()->json([
      'data' => [
        'section' => $section,
      ],
      'message' => 'section deleted Successful.',
    ]);
  }

  //Exam Category

  public function exam_category_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'exam_category' => ExamCategory::where('school_id', 1)->get(
          $column = [
            'id',
            'name',
          ],
        ),
      ],
      'message' => 'Exam Category List Created',
    ]);
  }

  public function exam_category_store(ExamCategoryRequest $request)
  {
    return response()->json([
      'data' => [
        //$sections = Section::get()->where( 'school_id', 1 ),

        $validated = $request->validated(),
        'exam_category' => ExamCategory::create([
          'name' => $validated['name'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'exam_category store successful.',
    ]);
  }

  public function exam_category_show(ExamCategory $exam_category)
  {
    return response()->json([
      'data' => [
        'exam_category' => $exam_category,
      ],
      'message' => 'exam_category show successful.',
    ]);
  }

  public function exam_category_update(ExamCategoryUpdateRequest $request, ExamCategory $exam_category)
  {
    $exam_category->update($request->validated());
    return response()->json([
      'data' => [
        'exam_category' => $exam_category,
      ],
      'message' => 'exam_category update successful.',
    ]);
  }

  public function exam_category_destroy(ExamCategory $exam_category)
  {
    $exam_category->delete();
    return response()->json([
      'data' => [
        'exam_category' => $exam_category,
      ],
      'message' => 'exam_category deleted Successful.',
    ]);
  }

  //Exam

  public function exam_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'exams' => Exam::where('school_id', 1)->get(
          $column = [
            'id',
            'exam_category_id',
            'starting_time',
            'ending_time',
            'total_marks',
            'class_id',
            'section_id'
          ],
        ),
      ],
      'message' => 'exam List Created',
    ]);
  }

  public function exam_store(ExamRequest $request)
  {
    return response()->json([
      'data' => [
        //$sections = Section::get()->where( 'school_id', 1 ),

        $validated = $request->validated(),
        'exam' => Exam::create([
          'name' => $validated['exam_category_id'],
          'starting_time' => $validated['starting_time'],
          'ending_time' => $validated['ending_time'],
          'total_marks' => $validated['total_marks'],
          'class_id' => $validated['class_id'],
          'section_id' => $validated['section_id'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'exam store successful.',
    ]);
  }

  public function exam_show(Exam $exam)
  {
    return response()->json([
      'data' => [
        'exam' => $exam,
      ],
      'message' => 'exam show successful.',
    ]);
  }

  public function exam_update(ExamUpdateRequest $request, Exam $exam)
  {
    $exam->update($request->validated());
    return response()->json([
      'data' => [
        'exam' => $exam,
      ],
      'message' => 'exam update successful.',
    ]);
  }

  public function exam_destroy(Exam $exam)
  {
    $exam->delete();
    return response()->json([
      'data' => [
        'exam' => $exam,
      ],
      'message' => 'exam deleted Successful.',
    ]);
  }

  //Marks

  public function mark_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'marks' => Mark::get(
          $column = [
            'id',
            'marks',
            'grade_point',
            'comment',
            'user_id',
            'exam_category_id',
            'class_id',
            'section_id',
            'subject_id'
          ],
        ),
      ],
      'message' => 'marks List Created',
    ]);
  }

  public function mark_store(MarkRequest $request)
  {
    return response()->json([
      'data' => [
        $validated = $request->validated(),
        'mark' => Mark::create([
          'marks' => $validated['marks'],
          'grade_point' => $validated['grade_point'],
          'comment' => $validated['comment'],
          'user_id' => $validated['user_id'],
          'exam_category_id' => $validated['exam_category_id'],
          'class_id' => $validated['class_id'],
          'section_id' => $validated['section_id'],
          'subject_id' => $validated['subject_id'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'marks store successful.',
    ]);
  }

  public function mark_show(Mark $mark)
  {
    return response()->json([
      'data' => [
        'mark' => $mark,
      ],
      'message' => 'marks show successful.',
    ]);
  }

  public function mark_update(MarkUpdateRequest $request, Mark $mark)
  {
    $mark->update($request->validated());
    return response()->json([
      'data' => [
        'mark' => $mark,
      ],
      'message' => 'marks update successful.',
    ]);
  }

  public function mark_destroy(Mark $mark)
  {
    $mark->delete();
    return response()->json([
      'data' => [
        'mark' => $mark,
      ],
      'message' => 'marks deleted Successful.',
    ]);
  }

  //Routine

  public function routine_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'routines' => Routine::get(
          $column = [
            'id',
            'day',
            'starting_hour',
            'starting_minute',
            'ending_hour',
            'ending_minute',
            'routine_creator',
            'class_id',
            'subject_id',
            'section_id',
            'room_id',
          ],
        ),
      ],
      'message' => 'routine List Created',
    ]);
  }

  public function routine_store(RoutineRequest $request)
  {
    return response()->json([
      'data' => [
        $validated = $request->validated(),
        'routine' => Routine::create([
          'day' => $validated['day'],
          'starting_hour' => $validated['starting_hour'],
          'starting_minute' => $validated['starting_minute'],
          'ending_hour' => $validated['ending_hour'],
          'ending_minute' => $validated['ending_minute'],
          'routine_creator' => $validated['routine_creator'],
          'class_id' => $validated['class_id'],
          'subject_id' => $validated['subject_id'],
          'section_id' => $validated['section_id'],
          'room_id' => $validated['room_id'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'routine store successful.',
    ]);
  }

  public function routine_show(Routine $routine)
  {
    return response()->json([
      'data' => [
        'routine' => $routine,
      ],
      'message' => 'routine show successful.',
    ]);
  }

  public function routine_update(RoutineUpdateRequest $request, Routine $routine)
  {
    $routine->update($request->validated());
    return response()->json([
      'data' => [
        'routine' => $routine,
      ],
      'message' => 'routine update successful.',
    ]);
  }

  public function routine_destroy(Routine $routine)
  {
    $routine->delete();
    return response()->json([
      'data' => [
        'routine' => $routine,
      ],
      'message' => 'routine deleted Successful.',
    ]);
  }

  //Syllabus

  public function syllabus_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'syllabuses' => Syllabus::get(
          $column = [
            'id',
            'title',
            'class_id',
            'subject_id',
            'section_id',
            'file'
          ],
        ),
      ],
      'message' => 'syllabus List Created',
    ]);
  }

  public function syllabus_store(SyllabusRequest $request)
  {
    return response()->json([
      'data' => [
        $validated = $request->validated(),

        $file = $validated['file'],
        $filename = time() . '-' . $file->getClientOriginalExtension(),
        $file->move('syllabus-images/', $filename),
        $file = $filename,

        'syllabus' => Syllabus::create([
          'title' => $validated['title'],
          'file' => $file,
          'class_id' => $validated['class_id'],
          'subject_id' => $validated['subject_id'],
          'section_id' => $validated['section_id'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'syllabus store successful.',
    ]);
  }

  public function syllabus_show(Syllabus $syllabus)
  {
    return response()->json([
      'data' => [
        'syllabus' => $syllabus,
      ],
      'message' => 'syllabus show successful.',
    ]);
  }

  public function syllabus_update(SyllabusUpdateRequest $request, Syllabus $syllabus)
  {
    return response()->json([
      'data' => [
        $validated = $request->validated(),

        $file = $validated['file'],
        $filename = time() . '-' . $file->getClientOriginalExtension(),
        $file->move('syllabus-images/', $filename),
        $file = $filename,

        'syllabus' => $syllabus->update([
          'title' => $validated['title'],
          'file' => $file,
          'class_id' => $validated['class_id'],
          'subject_id' => $validated['subject_id'],
          'section_id' => $validated['section_id'],
        ]),
      ],
      'message' => 'syllabus update successful.',
    ]);
  }

  public function syllabus_destroy(Syllabus $syllabus)
  {
    $syllabus->delete();
    return response()->json([
      'data' => [
        'syllabus' => $syllabus,
      ],
      'message' => 'syllabus deleted Successful.',
    ]);
  }

  //School

  public function school_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'school' => School::get(
          $column = [
            'id',
            'title',
            'email',
            'phone',
            'address',
            'school_info',
            'status'
          ],
        ),
      ],
      'message' => 'school List Created',
    ]);
  }

  public function school_store(SchoolRequest $request)
  {
    return response()->json([
      'data' => [
        $validated = $request->validated(),
        'school' => School::create([
          'title' => $validated['title'],
          'email' => $validated['email'],
          'phone' => $validated['phone'],
          'address' => $validated['address'],
          'school_info' => $validated['school_info'],
          'status' => "active"
        ]),
      ],
      'message' => 'school store successful.',
    ]);
  }

  public function school_show(School $school)
  {
    return response()->json([
      'data' => [
        'school' => $school,
      ],
      'message' => 'school show successful.',
    ]);
  }

  public function school_update(SchoolUpdateRequest $request, School $school)
  {
    $school->update($request->validated());
    return response()->json([
      'data' => [
        'school' => $school,
      ],
      'message' => 'school update successful.',
    ]);
  }

  public function school_destroy(School $school)
  {
    $school->delete();
    return response()->json([
      'data' => [
        'school' => $school,
      ],
      'message' => 'school deleted Successful.',
    ]);
  }

  //Class Room

  public function classRoom_list(Request $request): JsonResponse
  {
    return response()->json([
      'data' => [
        'classRooms' => ClassRoom::get(
          $column = [
            'id',
            'name',
          ],
        ),
      ],
      'message' => 'classRoom List Created',
    ]);
  }

  public function classRoom_store(ClassRoomRequest $request)
  {
    return response()->json([
      'data' => [
        $validated = $request->validated(),
        'classRoom' => ClassRoom::create([
          'name' => $validated['name'],
          'school_id' => '1'
        ]),
      ],
      'message' => 'classRoom store successful.',
    ]);
  }

  public function classRoom_show(ClassRoom $classRoom)
  {
    return response()->json([
      'data' => [
        'classRoom' => $classRoom,
      ],
      'message' => 'classRoom show successful.',
    ]);
  }

  public function classRoom_update(ClassRoomUpdateRequest $request, ClassRoom $classRoom)
  {
    $classRoom->update($request->validated());
    return response()->json([
      'data' => [
        'classRoom' => $classRoom,
      ],
      'message' => 'classRoom update successful.',
    ]);
  }

  public function classRoom_destroy(ClassRoom $classRoom)
  {
    $classRoom->delete();
    return response()->json([
      'data' => [
        'classRoom' => $classRoom,
      ],
      'message' => 'classRoom deleted Successful.',
    ]);
  }

}