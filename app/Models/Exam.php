<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exam_category_id',
        'starting_time',
        'ending_time',
        'total_marks',
        'class_id',
        'section_id',
        'status',
        'school_id'
    ];
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    protected $with = ['section', 'class', 'exam_category'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function exam_category(): BelongsTo
    {
        return $this->belongsTo(ExamCategory::class, 'exam_category_id', 'id');
    }

    public function getStartingDateAttribute($date)
	{
		return $this->attributes['starting_date'] = date('Y-m-d', $date);
	}

    public function getEndingDateAttribute($date)
	{
		return $this->attributes['ending_date'] = date('Y-m-d', $date);
	}

    // public function getEndingTimeAttribute($date)
	// {
	// 	return $this->attributes['ending_time'] = date('H:i', $date);
	// }

    // public function getStartingTimeAttribute($date)
	// {
	// 	return $this->attributes['starting_time'] = date('H:i', $date);
	// }
}
