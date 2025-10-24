<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function index()
    {
        $roleUsers = RoleUser::with('role', 'user')->get();
        return view('admin.role-user.index', compact('roleUsers'));
    }
}
