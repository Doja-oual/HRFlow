<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\LeaveRequestList;
use Illuminate\Support\Facades\Route;
use App\Livewire\UserComponent;
use App\Livewire\ContractComponent;
use App\Livewire\Departments;
use App\Livewire\FormationComponent;
use App\Livewire\CareerHistoryComponent;
use App\Livewire\CongeForm;



// Route::middleware('role:admin')



Route::middleware(['auth'])->group(function () {
    Route::get('/career-histories',CareerHistoryComponent ::class)->name('career-histories.index');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/departments', Departments::class)->name('departments');
Route::get('/contracts', ContractComponent::class)->name('contracts');
Route::get('/formation', FormationComponent::class)->name('trainings');
Route::get('/addConge', CongeForm::class)->name('livewire.conge-form');
Route::get('/ListConge', LeaveRequestList::class)->name('livewire.leave-request-list');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/user',UserComponent::class)->name('user');

