<x-app-layout>
    <!-- Inicio de header -->
    <x-slot name="header">

        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Evalúa a tu Coordinador y Mentor</h2>

    </x-slot>
    <!-- Fin de header -->

    <form method="POST" action="{{ route('principal.store') }}" aria-label="{{ __('Evaluacion') }}"
        enctype="multipart/form-data">

        @csrf
        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Marca el enunciado que mejor representa
            tu opinión:</h2>
        <div class="py-6">
            <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Coordinador: <span
                    class="text-blue-600">{{ $plantel->coordinador ?? 'N/A' }}</h2>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                            <tr class="bg-gray-800">
                                <th class="px-4 sm:px-16 py-2 text-left">
                                    <span class="text-gray-300">¿Cómo evalúas la atención de tu coordinador
                                        académico?</span>
                                </th>
                                <th class="px-4 sm:px-16 py-2">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span
                                        class="text-center ml-2 font-semibold text-gray-500">Malo</span>
                                </td>
                                <td>
                                    <input required="" type="radio" value="1" name="coordinador"
                                        id="coordinador" class="form-radio h-5 w-5 text-blue-600">
                                    <span class="ml-2 text-gray-700"></span>
                                </td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span
                                        class="text-center ml-2 font-semibold text-gray-500">Regular</span>
                                </td>
                                <td>
                                    <input required="" type="radio" value="2" name="coordinador"
                                        id="coordinador" class="form-radio h-5 w-5 text-blue-600"><span
                                        class="ml-2 text-gray-700"></span>
                                </td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span
                                        class="text-center ml-2 font-semibold text-gray-500">Bueno</span>
                                </td>
                                <td>
                                    <input required="" type="radio" value="3" name="coordinador"
                                        id="coordinador" class="form-radio h-5 w-5 text-blue-600"><span
                                        class="ml-2 text-gray-700"></span>
                                </td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3">
                                    <span class="text-center ml-2 font-semibold text-gray-500">Muy Bueno</span>
                                </td>
                                <td>
                                    <input required="" type="radio" value="4" name="coordinador"
                                        id="coordinador" class="form-radio h-5 w-5 text-blue-600"><span
                                        class="ml-2 text-gray-700"></span>
                                </td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3">
                                    <span class="text-center ml-2 font-semibold text-gray-500">Excelente</span>
                                </td>
                                <td>
                                    <input required="" type="radio" value="5" name="coordinador"
                                        id="coordinador" class="form-radio h-5 w-5 text-blue-600"><span
                                        class="ml-2 text-gray-700"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--************************************************************   Textarea   ***************************************************************-->

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
            <label for="porCoordi" class="font-semibold text-gray-500">¿Por qué?</label><br>
            <textarea required name="porCoordi" rows="4"
                class="w-full resize-y border-gray-300 shadow-sm rounded-md text-gray-800 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                placeholder="Escribe tus comentarios aquí..."></textarea>
        </div>

        <div class="py-6">
            <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Mentor: <span
                    class="text-blue-600">{{ $plantel->mentor ?? 'N/A' }}</h2>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                                <tr class="bg-gray-800">
                                    <th class="px-4 sm:px-16 py-2 text-left">
                                        <span class="text-gray-300">¿Cómo evalúas la atención de tu mentor académico?</span>
                                    </th>
                                    <th class="px-4 sm:px-16 py-2">
                                    </th>
                                </tr>
                            </thead>
                        <tbody class="bg-gray-200">
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span
                                        class="text-center ml-2 font-semibold text-gray-500">Malo</span>
                                </td>
                                <td>
                                    <input required="" type="radio" value="1" name="mentor" id="mentor"
                                        class="form-radio h-5 w-5 text-blue-600">
                                    <span class="ml-2 text-gray-700"></span>
                                </td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span
                                        class="text-center ml-2 font-semibold text-gray-500">Regular</span>
                                </td>
                                <td>
                                    <input required="" type="radio" value="2" name="mentor"
                                        id="mentor" class="form-radio h-5 w-5 text-blue-600"><span
                                        class="ml-2 text-gray-700"></span>
                                </td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3"><span
                                        class="text-center ml-2 font-semibold text-gray-500">Bueno</span>
                                </td>
                                <td>
                                    <input required="" type="radio" value="3" name="mentor"
                                        id="mentor" class="form-radio h-5 w-5 text-blue-600"><span
                                        class="ml-2 text-gray-700"></span>
                                </td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3">
                                    <span class="text-center ml-2 font-semibold text-gray-500">Muy Bueno</span>
                                </td>
                                <td>
                                    <input required="" type="radio" value="4" name="mentor"
                                        id="mentor" class="form-radio h-5 w-5 text-blue-600"><span
                                        class="ml-2 text-gray-700"></span>
                                </td>
                            </tr>
                            <tr class="bg-white border-2 border-gray-200">
                                <td class="px-4 sm:px-16 py-3">
                                    <span class="text-center ml-2 font-semibold text-gray-500">Excelente</span>
                                </td>
                                <td>
                                    <input required="" type="radio" value="5" name="mentor"
                                        id="mentor" class="form-radio h-5 w-5 text-blue-600"><span
                                        class="ml-2 text-gray-700"></span>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--************************************************************   Textarea   ***************************************************************-->

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
            <label for="porMentor" class="font-semibold text-gray-500">¿Por qué?</label><br>
            <textarea required id="observaciones" name="observaciones" rows="4"
                class="w-full resize-y border-gray-300 shadow-sm rounded-md text-gray-800 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                placeholder="Escribe tus comentarios aquí..."></textarea>
        </div>

        <!--************************************************************   Botones   ****************************************************************-->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('principal.index') }}"
                    class="w-full sm:w-auto text-center transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-10 rounded-md shadow-md">
                    Cancelar
                </a>
                <button type="submit"
                    type="submit"class="w-full sm:w-auto transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-10 rounded-md shadow-md">Calificar</button>
            </div>
        </div>
    </form>

</x-app-layout>
