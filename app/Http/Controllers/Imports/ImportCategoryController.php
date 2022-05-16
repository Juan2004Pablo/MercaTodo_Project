<?php

namespace App\Http\Controllers\Imports;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportFileRequest;
use App\Repositories\category\CategoryRepository;

class ImportCategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function import(ImportFileRequest $request)
    {
        $this->authorize('categories.import');

        $this->categoryRepo->categoriesImport($request);

        return back()->with('success', 'All good!');
    }
}
