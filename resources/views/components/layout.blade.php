<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{$css ?? ''}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <title>Inicio - {{$titulo ?? ''}}</title>
</head>
<body>
  <nav style="background-color: rgb(0, 150, 63); ">
    <ul class="nav justify-content-center">
        <li class="nav-item">
          <strong > <a class="nav-link" href="{{ route('gruposQr')}}" style="color:white">Evento con generación de QR</a></strong>
        </li>
        <li class="nav-item">
         <strong > <a class="nav-link" href="{{ route('consultar')}}" style="color:white">Registrar entradas al evento</a></strong>
        </li>
        <li class="nav-item">
          <strong > <a class="nav-link" href="{{ route('consutarRegistro')}}" style="color:white">Ver registro de entradas</a></strong>
         </li>
         <li class="nav-item">
          <strong > <a class="nav-link" href="{{ route('entrada')}}" style="color:white">Consultar entradas al evento</a></strong>
         </li>
         <li class="nav-item">
          <strong > <a class="nav-link" href="{{ route('descargar-excel1')}}" style="color:white">Vincular estudiante al Qrs</a></strong>
         </li>
         @auth
         <li  class="nav-item">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
           <button  class="nav-link" type="submit" style="border:none; background-color: transparent; color:white;">  <strong >Cerrar sesión</strong ></button> 
        </form>
         </li>
         @endauth
      </ul>
    </nav>
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show " style="text-align: center">
        {{ session('status') }}
    </div>
  @endif
  
    @if (session('status1'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center">
      {{session('status1')}}
    </div>
    @endif


    {{$slot}}
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<footer>
  <img src="{{ asset('images/logo.png') }}" alt="logo" style="height: 100px">
</footer>

<style>
  body{
    background-image: linear-gradient(135deg, rgba(49, 49, 49,0.07) 0%, rgba(49, 49, 49,0.07) 12.5%,rgba(76, 76, 76,0.07) 12.5%, rgba(76, 76, 76,0.07) 25%,rgba(102, 102, 102,0.07) 25%, rgba(102, 102, 102,0.07) 37.5%,rgba(129, 129, 129,0.07) 37.5%, rgba(129, 129, 129,0.07) 50%,rgba(155, 155, 155,0.07) 50%, rgba(155, 155, 155,0.07) 62.5%,rgba(182, 182, 182,0.07) 62.5%, rgba(182, 182, 182,0.07) 75%,rgba(208, 208, 208,0.07) 75%, rgba(208, 208, 208,0.07) 87.5%,rgba(235, 235, 235,0.07) 87.5%, rgba(235, 235, 235,0.07) 100%),linear-gradient(45deg, rgba(5, 5, 5,0.07) 0%, rgba(5, 5, 5,0.07) 12.5%,rgba(39, 39, 39,0.07) 12.5%, rgba(39, 39, 39,0.07) 25%,rgba(73, 73, 73,0.07) 25%, rgba(73, 73, 73,0.07) 37.5%,rgba(107, 107, 107,0.07) 37.5%, rgba(107, 107, 107,0.07) 50%,rgba(141, 141, 141,0.07) 50%, rgba(141, 141, 141,0.07) 62.5%,rgba(175, 175, 175,0.07) 62.5%, rgba(175, 175, 175,0.07) 75%,rgba(209, 209, 209,0.07) 75%, rgba(209, 209, 209,0.07) 87.5%,rgba(243, 243, 243,0.07) 87.5%, rgba(243, 243, 243,0.07) 100%),linear-gradient(90deg, #ffffff,#ffffff);
  }
      footer{
        background-image: linear-gradient(135deg, rgba(49, 49, 49,0.07) 0%, rgba(49, 49, 49,0.07) 12.5%,rgba(76, 76, 76,0.07) 12.5%, rgba(76, 76, 76,0.07) 25%,rgba(102, 102, 102,0.07) 25%, rgba(102, 102, 102,0.07) 37.5%,rgba(129, 129, 129,0.07) 37.5%, rgba(129, 129, 129,0.07) 50%,rgba(155, 155, 155,0.07) 50%, rgba(155, 155, 155,0.07) 62.5%,rgba(182, 182, 182,0.07) 62.5%, rgba(182, 182, 182,0.07) 75%,rgba(208, 208, 208,0.07) 75%, rgba(208, 208, 208,0.07) 87.5%,rgba(235, 235, 235,0.07) 87.5%, rgba(235, 235, 235,0.07) 100%),linear-gradient(45deg, rgba(5, 5, 5,0.07) 0%, rgba(5, 5, 5,0.07) 12.5%,rgba(39, 39, 39,0.07) 12.5%, rgba(39, 39, 39,0.07) 25%,rgba(73, 73, 73,0.07) 25%, rgba(73, 73, 73,0.07) 37.5%,rgba(107, 107, 107,0.07) 37.5%, rgba(107, 107, 107,0.07) 50%,rgba(141, 141, 141,0.07) 50%, rgba(141, 141, 141,0.07) 62.5%,rgba(175, 175, 175,0.07) 62.5%, rgba(175, 175, 175,0.07) 75%,rgba(209, 209, 209,0.07) 75%, rgba(209, 209, 209,0.07) 87.5%,rgba(243, 243, 243,0.07) 87.5%, rgba(243, 243, 243,0.07) 100%),linear-gradient(90deg, #ffffff,#ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
        }
</style>
</body>
</html>