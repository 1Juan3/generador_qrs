
<x-layout titulo="Registro de entradas">
        <form id="myForm" action="{{ route('consutarRegistro')}}" style="display: flex; justify-content: center; align-items: center"> 
          <input class="form-control" name="valor" type="text"style="text-align: center; width: 20%; margin-bottom:20px" placeholder="QR del graduando" oninput="submitForm()" >
      </form>
      
      {{-- Este script me permitira leer automaticamente el codigo --}}
      <script>
          function submitForm() {
            document.getElementById("myForm").submit();
          }
        </script>
        <p><strong>Total de entradas = {{ $total }}</strong></p>
<div class="bd-example" style="height: 75vh">
    <table class="table table-hover">
        <thead>
            <tr>

                <th scope="col">Nombre Estudiante</th>
                <th scope="col">Apelido Estudiante</th>
                <th scope="col">Cedula</th>
                <th scope="col">Comentario</th>
                <th scope="col">Fecha de registro</th>
                <th scope="col">Token</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $registro)
                <tr>

                    <td>{{ $registro['nombres'] }}</td>
                    <td>{{ $registro['apellidos'] }}</td>
                    <td>{{ $registro['cedula'] }}</td>
                    <td>{{ $registro['comentario'] }}</td>
                    <td>{{ $registro['created_at'] }}</td>
                    <td>{{ $registro['token'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-layout>