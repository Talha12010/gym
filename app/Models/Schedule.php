<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule';
    protected $primaryKey = 'S_id';
    public $incrementing = true;
    protected $fillable = ['C_id', 'day', 'start_time', 'end_time'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'C_id', 'C_id');
    }
}