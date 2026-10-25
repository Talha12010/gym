<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    use HasFactory;

    // This matches the 'sub' table
    protected $table = 'sub';

    protected $fillable = [
        'name',
        'email',
        'contact',
        'payment',
        'plan_name',
        'duration',
        'price',
        'feature',
    ];
}
