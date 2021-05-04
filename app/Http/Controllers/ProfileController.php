<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Meal;

class ProfileController extends Controller
{
    public function index() {

        return view('profile.index', [
            'user' => Auth::user(),
        ]);
    }
}
