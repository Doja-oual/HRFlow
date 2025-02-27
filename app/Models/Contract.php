<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'salary',
        'status',
        'contract_type_id'
    ];
    public function contractType()
{
    return $this->belongsTo(ContractType::class, 'contract_type_id');
}
public function user()
    {
        return $this->belongsTo(User::class);
    }
}
