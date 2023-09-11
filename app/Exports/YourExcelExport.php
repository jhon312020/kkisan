<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class YourExcelExport implements FromCollection, WithHeadings {
  /**
  * @return \Illuminate\Support\Collection
  */
  public function collection() {
    return new Collection([]);
  }

  public function headings(): array {
    return [
        'company_name',
        'manufacturing_name',
        'suppliername',
        'product_name',
        'category',
        'subcategory',
        'brand_name',
        'uomid',
        'weight',
    ];
  }
}
