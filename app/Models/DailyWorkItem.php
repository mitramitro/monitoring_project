<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyWorkItem extends Model
{
    use HasFactory;

    protected $table = 'daily_work_items';

    protected $fillable = [
        'daily_work_id',
        'contract_id',
        'time_in',
        'time_out',
        'overtime_until_plan',
        'is_absen',
        'absen_reason',
        'note',
        'total_workers',
        'daily_work_plan',
        'approval',
    ];

    public function dailyWork()
    {
        return $this->belongsTo(DailyWork::class, 'daily_work_id', 'id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }

    public function dailyWorkPlan()
    {
        return $this->hasMany(DailyWorkPlan::class, 'daily_work_item_id', 'id');
    }
}
