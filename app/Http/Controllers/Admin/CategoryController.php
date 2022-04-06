<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Paginator;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function index(Request $request): View
    {
        $categories = $this->categoryRepo->getAllCategories($request);

        return view('admin.category.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.category.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->categoryRepo->createCategory($request->all());

        return redirect()->route('admin.category.index')
            ->with('data', 'Record created successfully!');
    }

    public function show(int $id): View
    {
        $cat = $this->categoryRepo->findCategory($id);
        $edit = 'Si';

        return view('admin.category.show', compact('cat', 'edit'));
    }

    public function edit( int $id): View
    {
        $cat = $this->categoryRepo->findCategory( $id);
        $edit = 'Si';

        return view('admin.category.edit', compact('cat', 'edit'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $cat = $this->categoryRepo->findId($id);
        $this->categoryRepo->updateCategory($cat, $request->all());

        return redirect()->route('admin.category.index')
            ->with('data', 'Record updated successfully!');
    }

    /*public function destroy(int $id): RedirectResponse
    {
        $cat = $this->categoryRepo->findId($id);
        $this->categoryRepo->delete($cat);

        return redirect()->route('admin.category.index')
            ->with('data', 'Category disabled');
    }

    public function restore(Request $request): RedirectResponse
    {
        $this->categoryRepo->restore($request);

        return redirect()->route('admin.category.index')
            ->with('data', 'Category  enabled');
    }*/
}