<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyWork extends Model
{
    use HasFactory;

    protected $table = 'daily_works';

    protected $fillable = [
        'date',
        'user_id',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(DailyWorkItem::class, 'daily_work_id', 'id');
    }
}
