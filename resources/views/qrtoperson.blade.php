<x-layout titulo="Vincular qrs">
    <section style="display: flex; justify-content: center; align-items: center; ">
        <form action="{{ route('subir-excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3" style="width: 50%">
                <input type="file" class="form-control" name="archivo_excel" style="width: 800px">
              </div>
            <button type="submit" class="btn btn-outline-success">Subir Archivo</button>
        </form>
        <form action="{{ route('descargar-excel') }}" method="POST" >
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Nombre Grupo" name="grupo" style="width: 200px;">
                <label>Nombre del evento</label>
            </div> 

            
            
            <button class="btn btn-outline-info" href="{{ route('descargar-excel') }}">descargar información</button>
        </form>
    </section>

</x-layout>
