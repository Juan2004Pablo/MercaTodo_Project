<?php

namespace App\Exports;

use App\Models\Category;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoriesExport implements FromCollection, Responsable, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    private $fileName = 'Categories.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/xlsx',
    ];

    public function headings(): array
    {
        return [
            'id',
            'name',
            'description',
            'disable_at',
            'created_at',
            'updated_at',
        ];
    }

    public function collection(): Collection
    {
        return Category::select('id', 'name', 'description', 'disable_at', 'created_at', 'updated_at')->get();
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
