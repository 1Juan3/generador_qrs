<?php

namespace App\Imports;

use App\Models\Graduando;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;

class DatosImport implements ToModel
{        const COLUMN_TO_SKIP = 1; 
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Busca un registro existente por su ID
        $informacion = Graduando::find($row[0]);
    
        // Si se encuentra el registro, agrega la información del graduando
        if ($informacion) {
            $informacion->nombres = $row[1];
            $informacion->apellidos = $row[2];
            $informacion->cedula = $row[3];
            $informacion->nombre_invitados = $row[4];
            $informacion->titulo = $row[5];
            $informacion->save();
        }
    
        return $informacion;
    }
    
}
