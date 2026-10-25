<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
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
