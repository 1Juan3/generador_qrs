<x-layout titulo="visualizar">
    <div style="display: flex; flex-wrap: wrap; justify-content: center; width: 100%; ">
        <div style="margin: 10px; width: 200px; flex-shrink: 0; text-align: center;">
            <img src="{{ asset($rutaImagen) }}" alt="Código QR" style="max-width: 100%">
            <p>{{ pathinfo($rutaImagen, PATHINFO_FILENAME) }}</p>
        </div>
    </div>
    
</x-layout>
