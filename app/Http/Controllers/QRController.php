<?php

namespace App\Http\Controllers;
use App\models\Token;
use App\Models\Registro;
use App\Models\Graduando;
use Illuminate\Support\facades\DB;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode; // libreriaq que utilice parea generar el qr
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class QRController extends Controller
{

    // controller para generar los grupos con  qr 
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
            ->size(200)
            ->errorCorrection('H')
            ->generate($token, public_path($rutaImagen));
    }
    
    return view('viewqr', ['rutaImagenes' => $rutaImagenes, 'grupo' => $grupo]);
    
}

    //Controller para mostrar los grupos por qr 
    public function verQrPorGrupo(){
        $informacion = Token::select('nombe_grupo')
        ->distinct()
        ->get();

    

        
        $grupos = [];
       
        // Obtener la cantidad de datos por grupo
        foreach ($informacion as $grupo) {
            $cantidad = Token::where('nombe_grupo', $grupo->nombe_grupo)->count();
            $grupos[] = [
                'grupo' => $grupo->nombe_grupo,
                'cantidad' => $cantidad,
                'fecha'=>$grupo->fecha
            ];

        }
        return view('welcome', ['grupos' => $grupos]);
    }

    //Controller para guardar los qr en la base de datos 
public function storage(Request  $request)
{
 
    $request->validate([
        'numero_entradas' => ['required'],
        'numero_qr' => ['required'],
        'nombre_grupo' => ['required']]); // validaciones de campo de parte del sevidor 
    $numero_qrs = $request->input('numero_qr'); // Numero de qrs a generar 
        for ($i = 0; $i < $numero_qrs; $i++) {
            $token = bin2hex(random_bytes(10)); // token
                $graduando = New Graduando;
                $graduando ->nombre_grupo = $request->input('nombre_grupo');
                $graduando->id_qr = $token;
                $graduando->save();
                $qr = New Token;
                $qr->numero_entradas = $request->input('numero_entradas'); //numero de entradas que va a tener cada qr
                $qr->nombe_grupo = $request->input('nombre_grupo'); // el grupo al que pertenece cada qr
                $qr->fecha= $request->input('fecha');
                $qr ->token = $token;
                $qr->save(); // gardar en la base de datos 
                
        }
        session()->flash('status', 'Qr Generados');


        return to_route('gruposQr');

}

    //Controller para cerrar session  
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function eliminarQrPorGrupo($grupo)
{
    $grupo = str_replace('_', ' ', $grupo); 
    $informacion = Token::where('nombe_grupo', $grupo)->get();
    
    foreach ($informacion as $registro) {
        $token = $registro->token;
        $rutaImagen = 'svg-qrs/codigo-qr-' . str_replace(' ', '-', strtolower($token)) . '.svg'; // Genera una ruta única para cada imagen
        if (file_exists(public_path($rutaImagen))) { // Verifica si el archivo existe
            unlink(public_path($rutaImagen)); // Elimina el archivo
        }
    }
    
    Token::where('nombe_grupo', $grupo)->delete();
    Graduando::where('nombre_grupo', $grupo)->delete();
    Registro::where('nombre_grupo', $grupo)->delete();
    session()->flash('status1', 'Lista de QRS por grupo eliminada');
    return redirect()->route('gruposQr');
}


    // controller para consulatr la informacion del graduandi
    public function consultar_informacion(Request $request){
        $token = $request->input('token');
        $informacion = Graduando::where('id_qr', $token)->first();
        $numero_entradas = Token::where('token', $token)->value('numero_entradas');//utilizo el token para consultar el numero de entradas 
        $nombre_grupo = Token::where('token', $token)->value('nombe_grupo');

        $datos = [];
        if($informacion){
            $datos = [
                'nombres' => $informacion->nombres,
                'apellidos' => $informacion->apellidos,
                'cedula' => $informacion->cedula,
                'titulo' => $informacion->titulo,
                'nombre_invitados' => $informacion->nombre_invitados,
                'token' => $informacion->id_qr,
                'numero_entradas' =>$numero_entradas
            ];
        } else{
           
        }
        return view('registrar', compact('datos'));
    }
    
    //controller parqa registrar la entrada
    public function registrar_entrada(Request $request, $datos){

      $token_ingreso = $datos; //traigo el token 
      $numero_entradas = Token::where('token', $token_ingreso)->value('numero_entradas');//utilizo el token para consultar el numero de entradas 
      $nombe_grupo = Token::where('token', $token_ingreso)->value('nombe_grupo');


      if($numero_entradas>0){
        $registro = new Registro; //creo un nueva instacia de registro o objeto 
        $registro ->comentario = $request->input('comentario'); 
        $registro ->nombre_grupo = $nombe_grupo;
        $registro ->id_qr = $datos; // inserto el token para guardar el registro de da topken 
        $registro->save(); // finalizo guardando en la base de dartos 
        $numero_entradas-=1; // descuento el nmumero de pasadas  
        Token::where('token', $token_ingreso)
        ->update( ['numero_entradas'=> $numero_entradas]);// Finalmente actualizo el numero de entradas eb a BD

        session()->flash('status', 'Entrada Registrada');
      }else{
        session()->flash('status1', 'Ya se registraron todas las entradas');
      }

        return view('registrar');

    }
    

    //controeller para consultar la informacion de la entrada
    public function consultar_informacion_entrada(Request $request){
        $token = $request->input('token');
        $informacion1 = Registro::where('id_qr', $token)->get(); 

    $informacion = Graduando::join('registro_entrada', 'informacion_graduando.id_qr', '=', 'registro_entrada.id_qr')
    ->where('informacion_graduando.id_qr', '=', $token)
    ->get();
        $datos = [];
        if($informacion){
        foreach($informacion as $registro){
            $datos[] = [
                'id'=> $registro ->id,
                'comentario' => $registro->comentario,
                'created_at' => $registro->created_at,
                'token' => $registro->id_qr,
                'cedula'=> $registro->cedula,
                'nombres'=>$registro->nombres,
                'apellidos'=>$registro->apellidos
            ];
        }
        
        } 
    
        return view('viewEntradas', compact('datos'));
    }
    public function editQrCount(Request $request, $grupo){
        $grupo = str_replace('_', ' ', $grupo); // Nombre del grupo que deseas actualizar
        $informacion =  Token::where('nombe_grupo', $grupo)->first();

        $qr_count = Token::where('nombe_grupo', $grupo)->count();


        return view('edit', ['grupo' => $informacion, 'qr_count' => $qr_count]);

    }


    public function updateQrCount(Request $request, $grupo)
    {
        $numero_qr = $request->input('numero_qr'); // Nueva cantidad de QRs a generar
    
        // Obtener el número actual de QRs generados para el grupo especificado
        $qr_count = Token::where('nombe_grupo', $grupo)->count();
    
        // Si la nueva cantidad de QRs es mayor que el número actual de QRs, generar los QRs adicionales
        if ($numero_qr > $qr_count) {
            $qr_diff = $numero_qr - $qr_count;
    
            for ($i = 0; $i < $qr_diff; $i++) {
                $token = bin2hex(random_bytes(10));
                $qr = new Token;
                $qr->numero_entradas = $request->input('numero_entradas');
                $qr->nombe_grupo = $grupo;
                $qr->token = $token;
                $qr->save();
            }
        }
        // Redireccionar de vuelta a la página de grupos QR
        return redirect()->route('gruposQr')->with('status', 'Cantidad de QRs actualizada para el grupo ' . $grupo);
    }
    

    public function consultar_entrada(Request $request){
        $grupo = $request->input('nombre_grupo');
        $grupo = str_replace('_', ' ', $grupo); 
        $conteo_entradas = Registro::where('nombre_grupo', $grupo)->count();
        return view('view', ['numero_entradas'=> $conteo_entradas]);

    }
    

}