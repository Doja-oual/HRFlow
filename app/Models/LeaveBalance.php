<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'annual_leave', 'recovery_leave'
    ];

    protected $casts = [
        'annual_leave' => 'float',
        'recovery_leave' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'employee_id', 'employee_id');
    }
}