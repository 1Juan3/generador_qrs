<x-layout titulo="Ver eventos">
    <section style="display: flex; justify-content: center; align-items: inherit">
            <strong style="width: 50%">Lista de grupos de qr</strong>
            
                <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#exampleModal" >
            Crear Evento
        </button>

    </section>
 


      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">GENERAR QRS </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{ route('create')}}" method="POST">
              @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="nombre_grupo" placeholder="Nombre grupo Qr">
                    <label for="floatingInput">Nombre del evento</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="number" class="form-control" placeholder="Cantidad de qr a generar" name="numero_qr">
                    <label>Cantidad de graduandos</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="date" class="form-control" placeholder="Cantidad de qr a generar" name="fecha">
                  <label>Fecha del evento</label>
              </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" placeholder="Numero de entras por Qr" name="numero_entradas">
                    <label>Numero de invitados</label>
                </div> 
                        
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Crear evento</button>
            </div>
          </form> 
          </div>
        </div>
      </div>


      <div class="bd-example" style="height: 75vh">
        <table class="table table-striped table-hover">
            <thead>
          <tr>
          
            <th scope="col">Nombre del evento</th>
            <th scope="col">Fecha del evento</th>
            <th scope="col">Cantidad de graduandos</th>
            <th scope="col">Visualizar</th>
            <th scope="col">Eliminar evento</th>
            <th scope="col">Editar evento</th>
          </tr>
        </thead>
        <tbody>
          @foreach($grupos as $grupo)
          <tr>
            <td>{{ $grupo['grupo'] }}</td>
            <td>{{  $grupo['fecha'] }}</td>
            <td>{{ $grupo['cantidad'] }}</td>
            <td><a href="{{route('visualizar', str_replace(' ', '_', $grupo['grupo'])) }}"><i class="bi bi-qr-code" style="font-size: 18px; color: black"></i></a></td> 
            <td><form method="POST" action="{{ route('eliminar', str_replace(' ', '_', $grupo['grupo'])) }}">
              @csrf
              @method('POST')
              <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash" style="font-size: 15px;"></i></button>
          </form>
          </td>
          <td>
           <a  class="btn btn-outline-warning"   href="{{ route('updated', str_replace(' ', '_', $grupo['grupo'])) }}"><i class="bi bi-pen" style="font-size: 18px ;" ></i></a>
        </td>
            @endforeach
          </tr>
        </tbody>
        </table>
      </div>


</x-layout>