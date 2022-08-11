<?php

namespace App\Admin\Dashboard\Controllers;

use Domain\Cats\Models\Breed;
use Domain\Cats\Models\Cat;
use Domain\Users\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __invoke()
    {
        return Inertia::render('Dashboard', [
            'breed_total' => Breed::count(),
            'cat_total' => Cat::count(),
            'user_total' => User::count(),
        ]);
    }
}
