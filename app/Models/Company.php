<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'pic',
        'safety_man',
        'handphone',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'company_id', 'id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'company_id', 'id');
    }
}
