<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'feedback_id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'feedback_text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}