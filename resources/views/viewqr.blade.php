<x-layout titulo="visualizar">
    <h1 style="text-align: center">Qrs del grupo {{$grupo}}</h1>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; width: 100%; ">
        @foreach ($rutaImagenes as $key => $rutaImagen)
            <div style="margin: 10px; width: 200px; flex-shrink: 0; text-align: center;">
                <img src="{{ asset($rutaImagen) }}" alt="Código QR" style="max-width: 100%">
                <p>{{ pathinfo($rutaImagen, PATHINFO_FILENAME) }}</p>
                <a href="{{ route('visualizar1', ['grupo' => str_replace(' ', '_', $grupo), 'qr' => $qrs[$key]]) }}" style="color:black; font-size: 20px"><i class="bi bi-eye-fill"></i></a>
            </div>
        @endforeach
    </div>
</x-layout>

