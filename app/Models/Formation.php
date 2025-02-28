<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'employee_id',
        'title',
        'description',
        'institution',
        'start_date',
        'end_date',
        'status',
        'certificate',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
