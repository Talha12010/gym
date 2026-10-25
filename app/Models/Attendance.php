<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // The table associated with the model (optional if table name is 'attendances')
    protected $table = 'attendances';

    // Fields that are mass assignable
    protected $fillable = [
        'class_name',
        'trainer_name',
        'class_date',
        'class_time',
    ];
}
