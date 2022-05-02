<?php

namespace App\Repositories\category;

use App\Exports\CategoriesExport;
use App\Helpers\Paginator;
use App\Imports\CategoriesImport;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
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

    public function categoriesExport(): BinaryFileResponse
    {
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
            }
        }
    }
}
