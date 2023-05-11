<x-layout>
  <form id="myForm" action="{{ route('consultar')}}" style="display: flex; justify-content: center; align-items: center"> 
    <input class="form-control" name="token" type="text"style="text-align: center; width: 20%; margin-top: 30px; margin-bottom:30px" placeholder="QR del graduando" oninput="submitForm()" >
</form>

{{-- Este script me permitira leer automaticamente el codigo --}}
<script>
    function submitForm() {
      document.getElementById("myForm").submit();
    }
  </script>
  <section style="display: flex; justify-content: center; align-content: center" >
    <div class="card text-center" style="width: 60%; text-align: ">
      <div class="card-header">
        Informacion del graduando
      </div>
      <h1 style="font-size: 30px; text-align: center; margin-top: 30px;  ">INVITADO ESPECIAL DE:</h1>
      <div class="card-body" style="display: flex; justify-content: center; align-items: center; flex-direction: column">
        <label for="Nombres"> <Strong>Nombres</Strong></label>
        @if(isset($datos['nombres']))
        <p class="card-text" id="nombres">{{ $datos['nombres'] }}</p>
        @endif
        <label for="Apellido"> <Strong>Apellidos</Strong></label>
        @if(isset($datos['apellidos']))
        <p class="card-text" id="apellidos">{{ $datos['apellidos'] }}</p>
        @endif
        <label for="Titulo"> <Strong>Titulo</Strong></label>
        @if(isset($datos['titulo']))
        <p class="card-text" id="titulo">{{ $datos['titulo'] }}</p>
        @endif
        <label for="Invitados"> <Strong>Invitados</Strong></label>
        @if(isset($datos['nombre_invitados']))
        <p class="card-text" id="nombre_invitados">{{ $datos['nombre_invitados'] }}</p>
        @endif
        <label for="numero_entradas"> <Strong>Numero entradas disponibles</Strong></label>
        @if(isset($datos['numero_entradas']))
        <p class="card-text" id="numero_entradas">{{ $datos['numero_entradas'] }}</p>
        @endif
        @if(isset($datos['token']))
        <form action="{{ route('registrar', $datos['token'])}}" method="POST" >
          @csrf
        @endif
          <div class="form-floating">
            <textarea class="form-control" placeholder="Si tiene alguna observacion registrela aqui por favor" id="floatingTextarea2" style="height: 100px; width: 500px;" name="comentario"></textarea>
              <label for="floatingTextarea2">Si tiene alguna observacion ingresela aqui por favor</label>
            </div>
            <button type="submit" class="btn btn-outline-success" style="margin-top: 20px;  ">Registrar Entrada</button>
        </form>

      </div>
      <div class="card-footer text-body-secondary">
        {{ date('Y-m-d') }}
    </div>
    
    </div>
  </section>


</x-layout>