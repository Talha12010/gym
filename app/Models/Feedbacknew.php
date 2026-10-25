<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedbacknew extends Model
{
    protected $table = 'feedbacknew';

    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
