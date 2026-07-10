<x-app-layout>

    <!-- Header con nombre Usuario y boton de Cerrar sesion-->
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center w-full gap-4 sm:gap-0">
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
                Bienvenido/a, {{ Auth::user()->name }}
            </h2>
            <button class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md w-full sm:w-auto"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar sesión
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </x-slot>
    <br>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-4">
        @if($finalizo == 1)
            <h1 class="text-center font-semibold text-lg sm:text-sm text-gray-800 leading-tight p-4 bg-green-50 rounded-lg border border-green-200">
                Muchas gracias por tu participación.<br class="hidden sm:block">
                Tus respuestas nos sirven para mejorar.
            </h1>
        @else
            <h1 class="text-center font-medium text-lg sm:text-xl text-gray-700 leading-relaxed p-4 bg-blue-50 rounded-lg border border-blue-100">
                Los datos en la presente encuesta serán tratados con estricta confidencialidad y en apego a la protección de datos.<br class="hidden sm:block">
                El énfasis de la encuesta es con la intención de mejorar, identificar áreas de oportunidad y conocer nuestras fortalezas.
            </h1>
        @endif
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- TABLE INIT -->
                <table class="min-w-full table-auto">
                    <!-- THEAD INIT-->
                    <thead class="justify-between">
                        <tr class="bg-gray-800">
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Materia</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Evaluar</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Nombre docente</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Status</span>
                            </th>
                        </tr>
                    </thead>
                    <!-- THEAD END -->

                    <!-- TBODY INIT-->
                    <tbody class="bg-gray-200">
                    <!-- materias init -->
                    @foreach($materias as $materia)
                        <tr class="bg-white border-4 border-gray-200">
                            <td>
                                <span class="text-center ml-2 font-semibold">{{$materia->descripcion}}</span>
                            </td>
                            <td class="px-16 py-2">
                                <a href="{{route('principal.edit',$materia->id)}}">
                                @if($materia->contestada == 0)
                                    <button  class="bg-blue-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
                                        Evaluar
                                    </button>
                                @else
                                    <button disabled class="px-4 py-2 border rounded-md bg-gradient-to-r from-green-400 to-green-600 text-white">
                                        Evaluado
                                    </button>
                                @endif
                                </a>
                            </td>

                            <td class="px-16 py-2">
                                <span>{{$materia->docente}}</span>
                            </td>

                            <td class="px-16 py-2">
                                @if($materia->contestada == 0)
                                    <div class="inline-block mr-2 mt-2">
                                        <button type="button" disabled class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gradient-to-r from-red-400 to-red-600 transform hover:scale-110">Sin contestar</button>
                                    </div>
                                @else
                                <div class="inline-block mr-2 mt-2">
                                    <button type="button" disabled class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gradient-to-r from-green-400 to-green-600 transform hover:scale-110">Contestada</button>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <!-- materias end -->

                    <!-- cym init -->
                        <tr class="bg-white border-4 border-gray-200">
                            <td>
                                <span class="text-center ml-2 font-semibold">Evalúa tu Coordinador y Mentor</span>
                            </td>
                            <td class="px-16 py-2">
                                <a href="{{route('principal.show',auth()->user()->username)}}">
                                @if(is_null($EvaluaContestadas))
                                    <button  class="bg-blue-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
                                        Evaluar
                                    </button>
                                @else
                                    <button disabled class="px-4 py-2 border rounded-md bg-gradient-to-r from-green-400 to-green-600 text-white">
                                        Evaluado
                                    </button>
                                @endif
                                </a>
                            </td>
                            <td class="px-16 py-2">
                                <span>{{auth()->user()->alumno->plantel->descripcion}}</span>
                            </td>

                            <td class="px-16 py-2">
                            @if(is_null($EvaluaContestadas))
                                <div class="inline-block mr-2 mt-2">
                                    <button type="button" disabled class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gradient-to-r from-red-400 to-red-600 transform hover:scale-110">Sin contestar</button>
                                </div>
                            @else
                                <div class="inline-block mr-2 mt-2">
                                    <button type="button" disabled class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gradient-to-r from-green-400 to-green-600 transform hover:scale-110">Contestada</button>
                                </div>
                            @endif
                            </td>
                        </tr>
                    <!-- cym end -->

                    {{-- nps--}}
                    {{-- <!--Lineas de comentario para quitar el NPS quitar cuando sea tiempo de evaluar al plantel!-->
                    <!-- nps init -->
                        <tr class="bg-white border-4 border-gray-200">
                            <td>
                                <span class="text-center ml-2 font-semibold">Encuesta de satisfaccion</span>
                            </td>
                            <td class="px-16 py-2">
                                <a href="{{route('nps',auth()->user()->username)}}">
                                @if(is_null($npsContestadas))
                                    <button  class="bg-blue-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
                                        Evaluar
                                    </button>
                                @else
                                    <button disabled class="px-4 py-2 border rounded-md bg-gradient-to-r from-green-400 to-green-600 text-white">
                                        Evaluado
                                    </button>
                                @endif

                                </a>
                            </td>
                            <td class="px-16 py-2">
                                <span>UNIVER</span>
                            </td>

                            <td class="px-16 py-2">
                            @if(is_null($npsContestadas))
                                <div class="inline-block mr-2 mt-2">
                                    <button type="button" disabled class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gradient-to-r from-red-400 to-red-600 transform hover:scale-110">Sin contestar</button>
                                </div>
                            @else
                                <div class="inline-block mr-2 mt-2">
                                    <button type="button" disabled class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gradient-to-r from-green-400 to-green-600 transform hover:scale-110">Contestada</button>
                                </div>
                            @endif
                            </td>
                        </tr>
                        <!-- nps end -->
                        <!--Lineas de comentario para quitar el NPS quitar cuando sea tiempo de evaluar al plantel!--> --}}
                    </tbody>
                    <!-- TBODY END -->
                </table>
                <!-- TABLE END -->
  <!-- **********************************   fin tabla ***************************************-->
            </div>
            @if($finalizo == 1 AND $EvaluaContestadas AND $EvaluaContestadas)
                <div class="mt-8 mb-4 flex justify-center">
                    <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                        @csrf
                        <button onclick="event.preventDefault(); this.closest('form').submit();"
                                type="button"
                                class="w-full sm:w-auto focus:outline-none text-white font-semibold text-base py-3 px-12 rounded-md bg-gray-800 hover:bg-gray-700 transition duration-300 shadow-md transform hover:scale-105">
                            Salir
                        </button>
                    </form>
                </div>
            @endif
        </div>

    </div>

</x-app-layout>
