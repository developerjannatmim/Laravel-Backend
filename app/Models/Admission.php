<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
		'name',
		'email',
		'password',
		'class_id',
		'section_id',
        'address',
        'phone',
        'dob',
        'gender',
        'image',
		'blood_group',
    ];

    protected $with = ['class', 'section'];

    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
