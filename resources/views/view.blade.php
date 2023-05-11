<x-layout>  
    <section style="display: flex; justify-content: center; align-items: center; margin-top:60px  ">
            <form action="{{ route('entrada')}}">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Numero de entras por Qr" name="nombre_grupo" style="width: 200px;">
                    <label>Nombre del evento</label>
                </div> 
                <button> Consultar </button>
            </form>
    </section>
            
    <section class="parte1" style="display: flex; justify-content: center; align-items: center; flex-direction: column; margin-top: 100px;">
            <img src="{{ asset('images/team.png') }}" alt="people" style="height: 300px">

            <p style="font-size: 300px"> {{$numero_entradas}}</p>
    </section>























                
                <style>
                    button {
 padding: 0.8em 1.8em;
 border: 2px solid #17C3B2;
 position: relative;
 overflow: hidden;
 background-color: transparent;
 text-align: center;
 text-transform: uppercase;
 font-size: 16px;
 transition: .3s;
 z-index: 1;
 font-family: inherit;
 color: #17C3B2;
}

button::before {
 content: '';
 width: 0;
 height: 300%;
 position: absolute;
 top: 50%;
 left: 50%;
 transform: translate(-50%, -50%) rotate(45deg);
 background: #17C3B2;
 transition: .5s ease;
 display: block;
 z-index: -1;
}

button:hover::before {
 width: 105%;
}

button:hover {
 color: #111;
}

                </style>
</x-layout>
