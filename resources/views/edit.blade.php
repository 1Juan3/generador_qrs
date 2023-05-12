<x-layout titulo="Editar evento">
  <div class="body" style="text-align: center; width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center"> 
    <h1> Editar {{$grupo->nombe_grupo}} </h1> 
    <form action="{{ route('updated', $grupo->nombe_grupo) }}" method="POST">
      @method('PATCH')
        @csrf
          <div class="form-floating mb-4">
              <input type="text" class="form-control" id="floatingInput" name="nombre_grupo" placeholder="Nombre grupo Qr" value="{{$grupo->nombe_grupo}} " style=" width: 500px;">
              <label for="floatingInput">Nombre grupo Qr</label>
            </div>
            <div class="form-floating mb-4">
              <input type="number" class="form-control" placeholder="Cantidad de qr a generar" name="numero_qr" value="{{$qr_count}}">
              <label>Cantidad de qr a generar</label>
          </div>
          <div class="form-floating mb-3">
              <input type="number" class="form-control" placeholder="Numero de entras por Qr" name="numero_entradas" value="{{$grupo->numero_entradas}}">
              <label>Numero de entras por Qr</label>
          </div> 
          <div >
            <a  class="btn btn-secondary"  href="/verGrupos">cancelar</a>
            <button type="submit" class="btn btn-outline-warning">Editar Qr</button>
          </div>
                  
      </div>
    </form> 
    </div>

</x-layout>
