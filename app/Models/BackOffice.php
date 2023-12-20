<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackOffice extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'author',
    'copies',
    'availble_copies',
    'school_id',
  ];
  protected $table = 'back_offices';
}
