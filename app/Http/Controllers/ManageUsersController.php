<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
class ManageUsersController extends Controller
{
    public function index(){
        return Inertia::render("ManagerUsers/Index/Index");

    }
}
