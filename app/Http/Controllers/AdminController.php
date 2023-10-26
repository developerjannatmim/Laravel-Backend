<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\ClassesRequest;
use App\Http\Requests\ClassesUpdateRequest;
use App\Http\Requests\SubjectRequest;
use App\Http\Requests\SubjectUpdateRequest;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
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
    return response()->json([
      'data' => [
        $validated = $request->validated(),

          // $file = $validated['photo'],
          // $filename = time() . '-' . $file,
          // //$file->move('admin-images/', $filename),
          // $photo = $filename,


        $info = array(
          'gender' => $validated['gender'],
          'blood_group' => $validated['blood_group'],
          'birthday' => $validated['birthday'],
          'phone' => $validated['phone'],
          'address' => $validated['address'],
          'photo' => $validated['photo'],
        ),
        $validated['user_information'] = json_encode($info),

        'admin' => User::create([
          'name' => $validated['name'],
          'email' => $validated['email'],
          'password' => bcrypt($validated['password']),
          'user_information' => $validated['user_information'],
          'role_id' => '1',
          'school_id' => '1'
        ]),
      ],
      'message' => 'Admin store successful.',
    ]);

  }

  public function admin_Show(User $admin)
  {
    return response()->json([
      'data' => [
        'admin' => $admin,
      ],
      'message' => 'Admin show successful.',
    ]);
  }

  public function admin_update(AdminUpdateRequest $request, User $admin)
  {
    $admin->update($request->validated());
    return response()->json([
      'data' => [
        $validated = $request->validated(),

        $info = array(
          'gender' => $validated['gender'],
          'blood_group' => $validated['blood_group'],
          'birthday' => $validated['birthday'],
          'phone' => $validated['phone'],
          'address' => $validated['address'],
          'photo' => $validated['photo']
        ),

        $validated['user_information'] = json_encode($info),

        'admin' => $admin->update([
          'name' => $validated['name'],
          'email' => $validated['email'],
          'user_information' => $validated['user_information'],
          'role_id' => '1',
          'school_id' => '1'
        ]),
      ],
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
}
