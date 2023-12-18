<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_model',
        'vehicle_info',
        'driver_id',
        'capacity',
        'route',
        'school_id',
    ];

    protected $with = ['driver'];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }
}
