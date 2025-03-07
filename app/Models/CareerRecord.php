<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'notes', 'start_date', 'end_date', 'status', 'salary', 'formation_id', 'contract_type_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

   
    public function contractType()
    {
        return $this->belongsTo(ContractType::class);
    }
}
