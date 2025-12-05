<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts';

    protected $fillable = [
        'contract_number',
        'budget',
        'job_title',
        'company_id',
        'pic',
        'safety_man',
        'handphone',
        'latitude',
        'longitude',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function dailyWorkItems()
    {
        return $this->hasMany(DailyWorkItem::class, 'contract_id', 'id');
    }
}
