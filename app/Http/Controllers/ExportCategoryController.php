<?php

namespace App\Http\Controllers;

use App\Repositories\category\CategoryRepository;
use App\Http\Controllers\Controller;
use App\Exports\CategoriesExport;

class ExportCategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function export()
    {
        $this->authorize('categories.export');

        return $this->categoryRepo->categoriesExport();
    }
}
