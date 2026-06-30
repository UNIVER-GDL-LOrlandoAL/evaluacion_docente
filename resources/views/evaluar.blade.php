<x-app-layout>
    <!-- Inicio de header -->
    <x-slot name="header">

        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Docente -
            {{ $docente->nombre_completo }} - Materia - {{ $docente->descripcion }}
        </h2>

    </x-slot>
    <!-- Fin de header -->
    <form id="formEvaluacion" method="POST" action="{{ route('principal.update', $docente->id) }}" aria-label="{{ __('Evaluacion') }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-4">
            <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Marca el enunciado que mejor representa tu opinión:</h2>
        </div>
        @foreach ($preguntas as $pregunta)
        @if ($pregunta->id == 1)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-6">
            <div class="flex items-center border-b border-gray-300 pb-2">
                <span class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></span>
                <h2 class="font-semibold text-xl text-gray-700 tracking-wide">Conocimiento y dominio de la materia</h2>
            </div>
        </div>
        @elseif($pregunta->id == 5)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-6">
            <div class="flex items-center border-b border-gray-300 pb-2">
                <span class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></span>
                <h2 class="font-semibold text-xl text-gray-700 tracking-wide">Comunicación</h2>
            </div>
        </div>
        @elseif($pregunta->id == 9)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-6">
            <div class="flex items-center border-b border-gray-300 pb-2">
                <span class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></span>
                <h2 class="font-semibold text-xl text-gray-700 tracking-wide">Uso de tecnología y recursos</h2>
            </div>
        </div>
        @elseif($pregunta->id == 11)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-6">
            <div class="flex items-center border-b border-gray-300 pb-2">
                <span class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></span>
                <h2 class="font-semibold text-xl text-gray-700 tracking-wide">Metodología de enseñanza</h2>
            </div>
        </div>
        @elseif($pregunta->id == 14)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-6">
            <div class="flex items-center border-b border-gray-300 pb-2">
                <span class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></span>
                <h2 class="font-semibold text-xl text-gray-700 tracking-wide">Interacción y apoyo</h2>
            </div>
        </div>
        @elseif($pregunta->id == 17)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-6">
            <div class="flex items-center border-b border-gray-300 pb-2">
                <span class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></span>
                <h2 class="font-semibold text-xl text-gray-700 tracking-wide">Valores y ética del docente</h2>
            </div>
        </div>
        @elseif($pregunta->id == 21)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-6">
            <div class="flex items-center border-b border-gray-300 pb-2">
                <span class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></span>
                <h2 class="font-semibold text-xl text-gray-700 tracking-wide">Cumplimiento del programa y modelo</h2>
            </div>
        </div>
        @endif
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-x-auto shadow-xl sm:rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                            <tr class="bg-gray-800">
                                <th class="px-4 sm:px-16 py-2 text-left">
                                    <span class="text-gray-300">{{ $pregunta->descripcion }}</span>
                                </th>
                                <th class="px-4 sm:px-16 py-2">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            @foreach ($respuestas as $respuesta)
                            @if ($respuesta->pregunta_id == $pregunta->id)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                                <td class="px-4 sm:px-16 py-3">
                                    <span class="ml-2 font-semibold text-gray-500">{{ $respuesta->descripcion }}</span>
                                </td>
                                <td class="px-4 sm:px-16 py-3 text-right">
                                    @if ($respuesta->puntos == 0)
                                    @if ($respuesta->id == 18)
                                    <label class="inline-flex items-center cursor-pointer">
                                        <span class="mr-2 text-gray-700">Si</span>
                                        <input required type="radio" value="0"
                                            name="pregunta{{ $respuesta->id }}"
                                            id="pregunta{{ $respuesta->id }}_si"
                                            class="form-radio h-5 w-5 text-blue-600">
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer ml-4">
                                        <span class="mr-2 text-gray-700">No</span>
                                        <input required type="radio" value="1"
                                            name="pregunta{{ $respuesta->id }}"
                                            id="pregunta{{ $respuesta->id }}_no"
                                            class="form-radio h-5 w-5 text-blue-600">
                                    </label>
                                    @else
                                    <label class="inline-flex items-center cursor-pointer">
                                        <span class="mr-2 text-gray-700">Si</span>
                                        <input required type="radio" value="1"
                                            name="pregunta{{ $respuesta->id }}"
                                            id="pregunta{{ $respuesta->id }}_si"
                                            class="form-radio h-5 w-5 text-blue-600">
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer ml-4">
                                        <span class="mr-2 text-gray-700">No</span>
                                        <input required type="radio" value="0"
                                            name="pregunta{{ $respuesta->id }}"
                                            id="pregunta{{ $respuesta->id }}_no"
                                            class="form-radio h-5 w-5 text-blue-600">
                                    </label>
                                    @endif
                                    @else
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input required type="radio" value="{{ $respuesta->puntos }}"
                                            name="pregunta{{ $respuesta->pregunta_id }}"
                                            id="pregunta_resp_{{ $respuesta->id }}"
                                            class="form-radio h-5 w-5 text-blue-600">
                                    </label>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
        <!--************************************************************   Textarea   ***************************************************************-->

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
            <div class="flex items-center mb-2 justify-between">
                <label for="observaciones" class="block font-semibold text-gray-700 mb-2">Con la finalidad de mejorar, ¿podrías darnos tus comentarios al respecto?</label>

                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 transition duration-150 ease-in-out" onclick="toggleComentario('observaciones', this)">
                    <span class="ml-2 text-sm text-gray-600 font-medium">No deseo agregar comentarios</span>
                </label>
            </div>
            <textarea required id="observaciones" name="observaciones" rows="4"
                class="w-full resize-y border-gray-300 shadow-sm rounded-md text-gray-800 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                placeholder="Escribe tus comentarios aquí..."></textarea>
        </div>

        <!--************************************************************   Botones   ****************************************************************-->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 pb-12">
                <div class="flex flex-col sm:flex-row justify-center items-center gap-8">
                    <a href="{{ route('principal.index') }}"
                        class="w-full sm:w-auto text-center transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-10 rounded-md shadow-md">
                        Cancelar
                    </a>
                    <button id="btnSubmit" type="submit" class="w-full sm:w-auto transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-10 rounded-md shadow-md">
                        Calificar
                    </button>
                </div>
            </div>
    </form>
    <script src="{{ asset('js/utilidades.js') }}"></script>
</x-app-layout>
