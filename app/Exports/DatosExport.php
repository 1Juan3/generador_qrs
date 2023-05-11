<?php

namespace App\Exports;

use App\Models\Graduando;
use Maatwebsite\Excel\Concerns\FromCollection;

class DatosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Graduando::all();
    }
}
