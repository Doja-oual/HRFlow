<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'employee_id', 'position',
        'department', 'hire_date', 'status', 'phone', 'address',
        'date_of_birth', 'gender', 'contract_type', 'profile_picture'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'hire_date' => 'date',
        ];
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function salaryPromotions()
    {
        return $this->hasMany(SalaryPromotion::class);
    }

    public function careerHistories()
    {
        return $this->hasMany(CareerHistory::class);
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class, 'employee_id');
    }

    public function leaveBalance()
    {
        return $this->hasOne(LeaveBalance::class, 'employee_id', 'id');
    }
    // calcule mitr ajour
    public function getOrUpdateLeaveBalance()
{
    $leaveBalance = $this->leaveBalance ?? new LeaveBalance(['employee_id' => $this->id]);

    // Calcul du solde annuel
    $calculatedLeave = $this->calculateAnnualLeave();

    if ($leaveBalance->annual_leave != $calculatedLeave) {
        $leaveBalance->annual_leave = $calculatedLeave;
        $leaveBalance->save(); 
    }

    return $leaveBalance;
}


    public function calculateAnnualLeave()
    {
        if (!$this->hire_date) {
            return 0;
        }

        $hireDate = Carbon::parse($this->hire_date);
        $yearsWorked = $hireDate->diffInYears(Carbon::now());

        if ($yearsWorked < 1) {
            $monthsWorked = $hireDate->diffInMonths(Carbon::now());
            return $monthsWorked * 1.5; 
        }

        return 18 + ($yearsWorked * 0.5); 
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id',)
            ->where('model_type', User::class);
    }

}