<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerHistory extends Model
{
    protected $fillable = ['user_id', 'position', 'department', 'start_date', 'end_date', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
