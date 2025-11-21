<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyWorkPlan extends Model
{
    use HasFactory;

    protected $table = 'daily_work_plans';

    protected $fillable = [
        'daily_work_item_id',
        'plan_name',
    ];

    public function dailyWorkItems()
    {
        return $this->belongsTo(DailyWorkItem::class, 'daily_work_item_id', 'id');
    }
}
