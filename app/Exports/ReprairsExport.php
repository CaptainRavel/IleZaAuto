<?php

namespace App\Exports;

use App\Models\UserReprairs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReprairsExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    public function headings():array{
        return[
            'Data raportu',
            'Przedmiot naprawy',
            'Miejsce naprawy',
            'Przebieg (km)',
            'Cena (zł)'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return UserRefuels::all();
        return collect(UserReprairs::getReprairs());
    }
}
