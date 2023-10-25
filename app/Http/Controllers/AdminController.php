<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassesRequest;
use App\Http\Requests\ClassesUpdateRequest;
use App\Http\Requests\SubjectRequest;
use App\Http\Requests\SubjectUpdateRequest;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
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
      'message' => 'class show successful.',
    ]);
  }

  public function subject_update(SubjectUpdateRequest $request, Subject $subject)
  {
    $subject->update($request->validated());
    return response()->json([
      'data' => [
        'subject' => $subject->update([
          'name' => $request['name'],
          'class_id' => '1',
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
