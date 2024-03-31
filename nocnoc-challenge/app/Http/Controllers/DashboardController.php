<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Models\Tasks;


class DashboardController extends Controller
{

    public function index()
    {
        $tasks = Tasks::paginate(20);
    
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'tasks' => $tasks,
        ]);
    }

    public function dashboard(){
        return Inertia::render('Dashboard');

    }

}
