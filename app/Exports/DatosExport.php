<?php

namespace App\Exports;

use App\Models\Graduando;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class DatosExport implements FromQuery
{
    use Exportable;

    protected $nombre_grupo;

    
    public function __construct(string $nombre_grupo)
    {
        $this->nombre_grupo = $nombre_grupo;
    }

    public function query()
    {
        return Graduando::query()->where('nombre_grupo', $this->nombre_grupo);
    }
}
