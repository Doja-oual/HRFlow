<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function calculateLeaveDays() {
        $hireDate = $this->hire_date; 
        $yearsWorked = Carbon::parse($hireDate)->diffInYears(Carbon::now());

        if ($yearsWorked >= 1) {
            return 18 + ($yearsWorked - 1) * 0.5; 
        } else {
            $monthsWorked = Carbon::parse($hireDate)->diffInMonths(Carbon::now());
            return $monthsWorked * 1.5; 
        }
    }
}
