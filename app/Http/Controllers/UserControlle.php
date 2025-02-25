<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class UserControlle extends Controller
{
    public function assignAdminRole(Request $request)
    {
        $user = User::find(1); // Trouve l'utilisateur par ID (exemple)
        $user->assignRole('admin'); // Assigne le rôle "admin"
        return response()->json(['message' => 'Rôle admin assigné avec succès']);
    }
}
