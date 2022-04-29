<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, Responsable, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    private $fileName = 'productsYes.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/xlsx',
    ];

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Description',
            'Price',
            'Quantity',
            'Disable at',
            'Category id',
            'Status',
            'Created at',
            'Updated at',
        ];
    }

    public function collection(): collection
    {
        return Product::select('id', 'name', 'description', 'price', 'quantity', 'disable_at', 'category_id', 'status', 'created_at', 'updated_at')->get();
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}