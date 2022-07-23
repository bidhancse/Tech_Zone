<?php

namespace App\Http\Controllers\Admin;

use App\LogActivity;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('backend.home');
    }
}
