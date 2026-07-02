<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Evalúa a tu Coordinador y Mentor</h2>
    </x-slot>

    <form method="POST" action="{{ route('principal.store') }}" aria-label="{{ __('Evaluacion') }}" enctype="multipart/form-data">
        @csrf
        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight mt-6">Marca el enunciado que mejor representa tu opinión:</h2>

        <div class="py-6">
            <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight mb-4">
                Coordinador:
                <span class="text-blue-600">
                    @if(isset($coordinadores) && $coordinadores->isNotEmpty())
                        @foreach($coordinadores->unique('nombre') as $coordinador)
                            {{ $coordinador->nombre }} @if(!$loop->last), @endif
                        @endforeach
                    @else
                    No Asignado
                    @endif
                </span>
            </h2>

            @if(isset($coordinadores) && $coordinadores->isNotEmpty())
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                            <tr class="bg-gray-800">
                                <th class="px-4 sm:px-16 py-2 text-left">
                                    <span class="text-gray-300">¿Cómo evalúas la atención de tu coordinador académico?</span>
                                </th>
                                <th class="px-4 sm:px-16 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span class="text-center ml-2 font-semibold text-gray-500">Malo</span></td>
                                <td><input required type="radio" value="1" name="coordinador" class="form-radio h-5 w-5 text-blue-600"></td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span class="text-center ml-2 font-semibold text-gray-500">Regular</span></td>
                                <td><input required type="radio" value="2" name="coordinador" class="form-radio h-5 w-5 text-blue-600"></td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span class="text-center ml-2 font-semibold text-gray-500">Bueno</span></td>
                                <td><input required type="radio" value="3" name="coordinador" class="form-radio h-5 w-5 text-blue-600"></td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span class="text-center ml-2 font-semibold text-gray-500">Muy Bueno</span></td>
                                <td><input required type="radio" value="4" name="coordinador" class="form-radio h-5 w-5 text-blue-600"></td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span class="text-center ml-2 font-semibold text-gray-500">Excelente</span></td>
                                <td><input required type="radio" value="5" name="coordinador" class="form-radio h-5 w-5 text-blue-600"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
                <div class="flex items-center mb-2 justify-between">
                    <label for="porCoordi" class="font-semibold text-gray-500">¿Por qué?</label>

                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 transition duration-150 ease-in-out" onclick="toggleComentario('porCoordi', this)">
                        <span class="ml-2 text-sm text-gray-600 font-medium">No deseo agregar comentarios</span>
                    </label>
                </div>

                <textarea required id="porCoordi" name="porCoordi" rows="4"
                    class="w-full resize-y border-gray-300 shadow-sm rounded-md text-gray-800 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                    placeholder="Escribe tus comentarios aquí..."></textarea>
            </div>
            @else
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 text-center">
                <div class="bg-gray-100 border border-gray-300 text-gray-600 py-6 rounded-lg shadow-sm">
                    <p class="font-semibold text-lg">Actualmente no cuentas con un coordinador asignado.</p>
                    <p class="text-sm mt-1">No es necesario realizar esta parte de la evaluación.</p>
                </div>
                <input type="hidden" name="coordinador" value="0">
                <input type="hidden" name="porCoordi" value="No Asignado">
            </div>
            @endif
        </div>

        <div class="py-6">
            <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight mb-4">
                Mentor:
                <span class="text-blue-600">
                    @if(isset($mentores) && $mentores->isNotEmpty())
                        @foreach($mentores->unique('nombre') as $mentor)
                            {{ $mentor->nombre }} @if(!$loop->last), @endif
                        @endforeach
                    @else
                    No Asignado
                    @endif
                </span>
            </h2>

            @if(isset($mentores) && $mentores->isNotEmpty())
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                            <tr class="bg-gray-800">
                                <th class="px-4 sm:px-16 py-2 text-left">
                                    <span class="text-gray-300">¿Cómo evalúas la atención de tu mentor académico?</span>
                                </th>
                                <th class="px-4 sm:px-16 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span class="text-center ml-2 font-semibold text-gray-500">Malo</span></td>
                                <td><input required type="radio" value="1" name="mentor" class="form-radio h-5 w-5 text-blue-600"></td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span class="text-center ml-2 font-semibold text-gray-500">Regular</span></td>
                                <td><input required type="radio" value="2" name="mentor" class="form-radio h-5 w-5 text-blue-600"></td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span class="text-center ml-2 font-semibold text-gray-500">Bueno</span></td>
                                <td><input required type="radio" value="3" name="mentor" class="form-radio h-5 w-5 text-blue-600"></td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span class="text-center ml-2 font-semibold text-gray-500">Muy Bueno</span></td>
                                <td><input required type="radio" value="4" name="mentor" class="form-radio h-5 w-5 text-blue-600"></td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span class="text-center ml-2 font-semibold text-gray-500">Excelente</span></td>
                                <td><input required type="radio" value="5" name="mentor" class="form-radio h-5 w-5 text-blue-600"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
                <div class="flex items-center mb-2 justify-between">
                    <label for="porMentor" class="font-semibold text-gray-500">¿Por qué?</label>

                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 transition duration-150 ease-in-out" onclick="toggleComentario('porMentor', this)">
                        <span class="ml-2 text-sm text-gray-600 font-medium">No deseo agregar comentarios</span>
                    </label>
                </div>

                <textarea required id="porMentor" name="porMentor" rows="4"
                    class="w-full resize-y border-gray-300 shadow-sm rounded-md text-gray-800 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                    placeholder="Escribe tus comentarios aquí..."></textarea>
            </div>
            @else
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 text-center">
                <div class="bg-gray-100 border border-gray-300 text-gray-600 py-6 rounded-lg shadow-sm">
                    <p class="font-semibold text-lg">Actualmente no cuentas con un mentor asignado.</p>
                    <p class="text-sm mt-1">No es necesario realizar esta parte de la evaluación.</p>
                </div>
                <input type="hidden" name="mentor" value="0">
                <input type="hidden" name="porMentor" value="No Asignado">
            </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 mt-4">
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('principal.index') }}"
                    class="w-full sm:w-auto text-center transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-10 rounded-md shadow-md">
                    Cancelar
                </a>
                <button type="submit"
                    class="w-full sm:w-auto transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-10 rounded-md shadow-md">
                    Calificar
                </button>
            </div>
        </div>
    </form>
    <script src="{{ asset('js/utilidades.js') }}"></script>
</x-app-layout>
