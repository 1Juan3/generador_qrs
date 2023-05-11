<x-layout>
    <form action="{{ route('subir-excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="archivo_excel">
        <button type="submit">Subir archivo</button>
        <a href="{{ route('descargar-excel') }}">descargar información</a>
    </form>
</x-layout>
