<?php

namespace App\Repositories\category;

use App\Exports\CategoriesExport;
use App\Helpers\Paginator;
use App\Imports\CategoriesImport;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CategoryRepository extends BaseRepository
{
    public function getModel(): Category
    {
        return new Category();
    }

    public function findCategory(string $id): Model
    {
        return $this->getModel()->where('id', $id)->firstOrFail();
    }

    public function getAllCategories(Request $request): LengthAwarePaginator
    {
        return Paginator::paginate($request, Category::cachedCategories());
    }

    public function createCategory(array $data): Model
    {
        Category::flushCache();

        Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has created a category');

        return $this->getModel()->create($data);
    }

    public function updateCategory(object $object, array $data): object
    {
        $object->fill($data);
        $object->save();

        Category::flushCache();

        Log::channel('contlog')->info('The category: ' . $object->name . ' ' . 'has been updated by: ' . ' ' . Auth::user()->name . ' ' . Auth::user()->surname);

        return $object;
    }

    public function deleteCategory(Category $category): RedirectResponse
    {
        $exist = Product::select('id')->where('category_id', $category->id)->first();
        if ($exist === null) {
            $this->delete($category);

            return redirect()->route('admin.category.index')->with('status_success', 'Category successfully removed');
        } else {
            return redirect()->route('admin.category.index')->with('status_success', 'The Category cannot be removed, there is at least one product with that category');
        }
    }

    public function categoriesExport(): BinaryFileResponse
    {
        Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has exported a list of categories for possible modification');

        return (new CategoriesExport())->download('categories.xlsx');
    }

    public function categoriesImport(Request $request): void
    {
        Category::flushCache();

        $file = $request->file('file');
        $import = new CategoriesImport();

        try {
            $import->import($file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
                dd($failure);
            }
        }
    }
}
