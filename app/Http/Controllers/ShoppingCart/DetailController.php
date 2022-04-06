<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\Controller;
use App\Repositories\DetailRepository;
use Illuminate\View\View;

class DetailController extends Controller
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
