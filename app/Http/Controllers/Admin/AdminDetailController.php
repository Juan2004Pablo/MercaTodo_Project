<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Detail\DetailRepository;
use Illuminate\View\View;

class AdminDetailController extends Controller
{
    protected $details;

    public function __construct(DetailRepository $DetailsRepository)
    {
        $this->details = $DetailsRepository;
    }

    public function index(): View
    {
        $details = $this->details->seeDetail();

        return view('admin.detail.index', compact('details'));
    }
}
