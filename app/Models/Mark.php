<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mark extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'exam_category_id',
    'class_id',
    'section_id',
    'subject_id',
    'marks',
    'grade_point',
    'school_id',
    'comment',
  ];

  protected $with = ['exam_category', 'section', 'subject', 'class',  'user'];

  public function section(): BelongsTo
  {
    return $this->belongsTo(Section::class, 'section_id', 'id');
  }

  public function class(): BelongsTo
  {
    return $this->belongsTo(Classes::class, 'class_id', 'id');
  }

  public function subject(): BelongsTo
  {
    return $this->belongsTo(Subject::class, 'subject_id', 'id');
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function exam_category(): BelongsTo
  {
    return $this->belongsTo(ExamCategory::class, 'exam_category_id', 'id');
  }

}