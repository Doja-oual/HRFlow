<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'institution',
        'start_date',
        'end_date',
        'status',
        'certificate',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
