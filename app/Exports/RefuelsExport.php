<?php

namespace App\Exports;

use App\Models\UserRefuels;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RefuelsExport implements FromCollection,WithHeadings,ShouldAutoSize
{

    public function headings():array{
        return[
            'Data raportu',
            'Paliwo (l)',
            'Dystans (km)',
            'Cena (zł)',
            'Spalanie (l/100km)'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return UserRefuels::all();
        return collect(UserRefuels::getRefuels());
    }
}
