<?php

namespace App\Imports;

use App\Models\Asset;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssetsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Asset([
            'sort_number' => $row['sort_number'] ?? null,
            'item_code' => $row['item_code'],
            'register' => $row['register'] ?? null,
            'merk' => $row['merk'] ?? null,
            'machine_number' => $row['machine_number'] ?? null,
            'material' => $row['material'] ?? null,
            'acquisition_source' => $row['acquisition_source'] ?? null,
            'acquisition_year' => $row['acquisition_year'] ?? null,
            'specification' => $row['specification'] ?? null,
            'unit' => $row['unit'] ?? null,
            'condition' => $row['condition'] ?? 'Baik',
            'qty' => $row['qty'] ?? 0,
            'price' => $row['price'] ?? 0,
            'notes' => $row['notes'] ?? null,
        ]);
    }
}
