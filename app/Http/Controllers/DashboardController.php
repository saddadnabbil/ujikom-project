<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct() {}

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        return view('dashboard.index', []);
    }
}
