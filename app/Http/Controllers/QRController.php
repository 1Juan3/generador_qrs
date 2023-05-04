<?php

namespace App\Http\Controllers;
use App\models\Token;
use App\Models\Registro;
use App\Models\Graduando;
use Illuminate\Support\facades\DB;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode; // libreriaq que utilice parea generar el qr
use Illuminate\Support\Facades\Artisan;

class QRController extends Controller
{
    public function tablaDeqQr(){

    }
    public function verQrPorGrupo(){
        $informacion = Token::select('nombe_grupo')->distinct()->get();
        $grupos = [];
    
        // Obtener la cantidad de datos por grupo
        foreach ($informacion as $grupo) {
            $cantidad = Token::where('nombe_grupo', $grupo->nombe_grupo)->count();
            $grupos[] = [
                'grupo' => $grupo->nombe_grupo,
                'cantidad' => $cantidad
            ];

        }
    
        return view('welcome', ['grupos' => $grupos]);
    }
    

    public function generateQr($grupo)
{
    $grupo = str_replace('_', ' ', $grupo); // Nombre del grupo que deseas mostrar
    $informacion = Token::where('nombe_grupo', $grupo)->get();
    $rutaImagenes = [];
    
    foreach ($informacion as $registro) {
        $token = $registro->token;
        $rutaImagen = 'svg-qrs/codigo-qr-' . str_replace(' ', '-', strtolower($token)) . '.svg'; // Genera una ruta única para cada imagen
        $rutaImagenes[] = $rutaImagen;
    
        QrCode::format('svg')
            ->style('round')
            ->size(100)
            ->errorCorrection('H')
            ->generate($token, public_path($rutaImagen));
    }
    
    return view('viewqr', ['rutaImagenes' => $rutaImagenes, 'grupo' => $grupo]);
    

}


    public function storage(Request  $request)
    {
           
        $request->validate([
            'numero_entradas' => ['required'],
            'numero_qr' => ['required'],
            'nombre_grupo' => ['required', 'unique:tokens,nombe_grupo']]); // validaciones de campo de parte del sevidor 
        $numero_qrs = $request->input('numero_qr'); // Numero de qrs a generar 
            for ($i = 0; $i < $numero_qrs; $i++) {
                $token = bin2hex(random_bytes(10)); // token
                    $qr = New Token;
                    $qr->numero_entradas = $request->input('numero_entradas'); //numero de entradas que va a tener cada qr
                    $qr->nombe_grupo = $request->input('nombre_grupo'); // el grupo al que pertenece cada qr
                    $qr ->token = $token;
                    $qr->save(); // gardar en la base de datos 
                    
            }
            session()->flash('status', 'Qr Generados');


    }
    public function registrar_entrada(Request $request, $datos){
      $registro = new Registro; //creo un nueva instacia de registro o objeto 
      $registro ->comentario = $request->input('comentario'); 
      $registro ->id_qr = $datos; // inserto el token para guardar el registro de da topken 
      $registro->save(); // finalizo guardando en la base de dartos 
      $token_ingreso = $datos; //traigo el token 
      $numero_entradas = Token::where('token', $token_ingreso)->value('numero_entradas');//utilizo el token para consultar el numero de entradas 
      $numero_entradas-=1; // descuento el nmumero de pasadas  
        Token::where('token', $token_ingreso)
        ->update( ['numero_entradas'=> $numero_entradas]);// Finalmente actualizo el numero de entradas eb a BD
        return view('registrar');

    }
    public function consultar_informacion(Request $request){
        $token = $request->input('token');
        $informacion = Graduando::where('id_qr', $token)->first();
        $datos = [];
        if($informacion){
            $datos = [
                'nombres' => $informacion->nombres,
                'apellidos' => $informacion->apellidos,
                'cedula' => $informacion->cedula,
                'titulo' => $informacion->titulo,
                'nombre_invitados' => $informacion->nombre_invitados,
                'token' => $informacion->id_qr,
            ];
        } else{
            echo('no se encontraron datos');
        }
    
        return view('registrar', compact('datos'));
    }
    
    

    public function index(){
        return view('qrcode');
    }
    

    
    


}
