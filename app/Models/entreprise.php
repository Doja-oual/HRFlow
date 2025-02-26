<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class entreprise extends Model
{
    use HasFactory;

    protected $fillable=[
        'nom',
        'sectteur-activite',
        'address',
        'logo',
        'email_contact',
        'telephone',
        'status',
    ];

    public function users(){
        return $this->hasMany(user::class);
    }
}
