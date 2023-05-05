<x-layout>
    <section style="display: flex; justify-content: center; align-items: inherit">
            <strong style="width: 50%">Lista de grupos de qr</strong>
            
                <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#exampleModal" >
            Crear Qr
        </button>

    </section>
 


      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">GENERAR QRS</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{ route('create')}}" method="POST">
              @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="nombre_grupo" placeholder="Nombre grupo Qr">
                    <label for="floatingInput">Nombre grupo Qr</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="number" class="form-control" placeholder="Cantidad de qr a generar" name="numero_qr">
                    <label>Cantidad de qr a generar</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" placeholder="Numero de entras por Qr" name="numero_entradas">
                    <label>Numero de entras por Qr</label>
                </div> 
                        
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Crear Qr</button>
            </div>
          </form> 
          </div>
        </div>
      </div>

      <div class="bd-example" style="height: 75vh">
        <table class="table table-striped table-hover">
            <thead>
          <tr>
          
            <th scope="col">Nombre del grupo</th>
            <th scope="col">Numero qr</th>
            <th scope="col">Visualizar</th>
            <th scope="col">Eliminar grupo</th>
          </tr>
        </thead>
        <tbody>
          @foreach($grupos as $grupo)
          <tr>
            <td>{{ $grupo['grupo'] }}</td>
            <td>{{ $grupo['cantidad'] }}</td>
            <td><a href="{{route('visualizar', str_replace(' ', '_', $grupo['grupo'])) }}"><i class="bi bi-qr-code" style="font-size: 18px; color: black"></i></a></td> 
            <td><form method="POST" action="{{ route('eliminar', str_replace(' ', '_', $grupo['grupo'])) }}">
              @csrf
              @method('POST')
              <button type="submit" class="btn btn-danger"><i class="bi bi-trash" style="font-size: 15px;"></i></button>
          </form>
          </td>
            @endforeach
          </tr>
        </tbody>
        </table>
      </div>


</x-layout>