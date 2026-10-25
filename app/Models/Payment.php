<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments'; // Just to be explicit

    protected $primaryKey = 'P_ID'; // Since your primary key isn't the default 'id'

    protected $fillable = [
        'member_id',
        'P_mode',
        'P_date',
        'amount',
    ];

    public $timestamps = true; // If your table uses created_at and updated_at

    protected $keyType = 'int'; // If P_ID is an integer

    public $incrementing = true; // Since it's an auto-increment primary key

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}
