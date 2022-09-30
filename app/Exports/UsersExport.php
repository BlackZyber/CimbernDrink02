<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UsersExport implements FromArray, WithStrictNullComparison, WithPreCalculateFormulas, WithColumnFormatting, ShouldAutoSize
{
    private $invoices;

    public function __construct(array $invoices){
        $this->invoices = $invoices;
    }

    public function array(): array
    {
        return $this->invoices;
    }


    public function columnFormats(): array
    {
        return [
            'B:AA' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

}
