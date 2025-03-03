<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryPromotion extends Model
{
  use HasFactory;
    
  protected $fillable=[ 'user_id','new_salary','new_job_title','comment','date_of_change'];


  public function user(){
    return $this->belongsTo(User::class);
  }
}
