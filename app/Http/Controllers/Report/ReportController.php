<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): view
    {
        $this->authorize('report.generate');

        return view('report.index');
    }
}
