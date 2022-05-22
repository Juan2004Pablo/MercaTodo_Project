<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\category\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function index(Request $request): View
    {
        $this->authorize('category.index');

        $categories = $this->categoryRepo->getAllCategories($request);

        return view('admin.category.index', compact('categories'));
    }

    public function create(): View
    {
        $this->authorize('category.create');

        return view('admin.category.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('category.create');

        $this->categoryRepo->createCategory($request->all());

        return redirect()->route('admin.category.index')
            ->with('data', 'Record created successfully!');
    }

    public function edit(int $id): View
    {
        $this->authorize('category.update');

        $cat = $this->categoryRepo->findCategory($id);

        return view('admin.category.edit', compact('cat'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $this->authorize('category.update');

        $cat = $this->categoryRepo->findId($id);
        $this->categoryRepo->updateCategory($cat, $request->all());

        return redirect()->route('admin.category.index')
            ->with('data', 'Record updated successfully!');
    }

    public function show(int $id): View
    {
        $this->authorize('category.show');

        $cat = $this->categoryRepo->findCategory($id);

        return view('admin.category.show', compact('cat'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('category.disable');
        return $this->categoryRepo->deleteCategory($category);
    }

    public function restore(Request $request): RedirectResponse
    {
        $this->authorize('category.disable');

        $this->categoryRepo->restore($request);

        return redirect()->route('admin.category.index')->with('data', 'Category  enabled');
    }
}
