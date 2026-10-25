<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model // Use a different name to avoid naming conflicts with PHP's `class` keyword
{
    use HasFactory;

    protected $table = 'classes';
    protected $primaryKey = 'C_id';
    public $incrementing = true;
    protected $fillable = ['class_name', 'max_capacity', 'T_id'];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'T_id', 'id')->where('role', 'trainer');
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'C_id', 'C_id');
    }
}