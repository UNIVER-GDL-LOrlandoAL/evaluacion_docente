<x-app-layout>
<!-- Inicio de header -->
    <x-slot name="header">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Encuesta de satisfaccion</h2>

    </x-slot>
<!-- Fin de header -->

<form method="POST" action="{{route('npsStore')}}" aria-label="{{ __('Evaluacion') }}" enctype="multipart/form-data">
    
    @csrf
    <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Marca el enunciado que mejor representa tu opinión:</h2>
    
    
        <div class="py-6">
            <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">UNIVER:</h2>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table  class="min-w-full table-auto">
                        <thead class="justify-between">
                            <tr class="bg-gray-800">
                                    <th class="px-16 py-2">
                                        <span class="text-gray-300">¿Qué tan probable es que recomiendes UNIVER a un familiar o amigo?</span>
                                    </th>
                                    <th class="px-16 py-2">
                                    </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
    <tr class="bg-white border-2 border-gray-200">
       <td class="px-0 py-7 w-100">
    <div class="container w-100 mt-4">
        <div style="display: flex;justify-content: space-between;align-items: center;" class="form-group p-4">
            <label style="text-align: left;" for="rango">NADA PROBABLE:</label>
            @foreach(range(1, 10) as $value)
            <input type="radio" name="puntos" id="radio{{ $value }}" value="{{ $value }}">
             <label for="radio{{ $value }}">{{ $value }}</label>
            <br>
@endforeach
            <label style="text-align: right;" for="rango">MUY PROBABLE:</label>
        </div>
    </div>
</td>
        
        </tr>
        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
<!--************************************************************   Textarea   ***************************************************************-->

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <label id="porque" for="porque" class="font-semibold text-gray-500">¿Por qué?</label><br>
        <textarea required name="porque" class="resize-none border-gray-300 font-semibold text-gray-800 w-full px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent"></textarea>
    </div>
    
     
    
<!--************************************************************   Textarea   ***************************************************************-->

    

<!--************************************************************   Botones   ****************************************************************-->
    <div class="flex justify-center">
        <div class="card-body p-4">
            <div class="btn-group">
                <a href="{{route('principal.index')}}">
                    <button type="button" class="btn-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-red-500 hover:bg-red-700 text-white font-normal py-6 px-16 mr-5 rounded">Cancelar</button>
                </a>
                <button type="submit" onclick="this.disabled=true; this.innerHTML='Enviando...'; this.form.submit();" class="btn-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-blue-500 hover:bg-blue-700 text-white font-normal py-6 px-16 mr-5 rounded">Calificar</button>
            </div>
        </div>
    </div>
</form>
<script>
    $('input[type="radio"]').on('change', function() {
    var valor = $(this).val();
    if (valor <= 6)
    {
        $("#porque").text("¿En qué consideras que te hemos fallado?");
    }
    else if (valor > 8)
    {
        $("#porque").text("¿Qué es lo recomiendas o destacas de UNIVER?");
    }
    else
    {
        $("#porque").text("¿Qué podríamos hacer para mejorar su experiencia?");
    }
    // Realiza aquí cualquier acción que desees cuando el rango se mueva.
  });
</script>

</x-app-layout>
