<?php

namespace App\Http\Controllers;

use App\Exports\DatosExport;
use App\Imports\DatosImport;
use App\models\Token;
use App\Models\Registro;
use App\Models\Graduando;

use Illuminate\Support\facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    public function subirExcel(Request $request)
    {
        $file = $request->file('archivo_excel');
        Excel::import(new DatosImport, $file);

        return back()->with('status', 'Importacion Exitosa');
    }
    
    public function index(){

        return view('qrtoperson');
    }
    
    public function index1(){

        return view('qrtoperson');
    }

    public function descargarExcel(Request $request)
    {
        $nombre_grupo = $request->input('grupo');
        return Excel::download(new DatosExport($nombre_grupo), 'datos-graduando.xlsx');
    }
    


} 