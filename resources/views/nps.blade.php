<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Encuesta de Satisfacción</h2>
    </x-slot>

    <form method="POST" action="{{ route('npsStore') }}" aria-label="{{ __('Evaluacion') }}" enctype="multipart/form-data" class="pb-8">
        @csrf

        <div x-data="{
                puntos: null,
                get preguntaDinamica() {
                    if (!this.puntos) return '¿Por qué?';
                    if (this.puntos <= 6) return '¿En qué consideras que te hemos fallado?';
                    if (this.puntos >= 9) return '¿Qué es lo que recomiendas o destacas de UNIVER?';
                    return '¿Qué podríamos hacer para mejorar tu experiencia?';
                }
            }" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">

            <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight mb-8">Marca el enunciado que mejor representa tu opinión:</h2>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8 mb-6">
                <h3 class="text-center font-semibold text-lg text-gray-700 mb-8">
                    ¿Qué tan probable es que recomiendes UNIVER a un familiar o amigo?
                </h3>

                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <span class="text-sm font-bold text-gray-500 hidden md:block w-32 text-left">NADA PROBABLE</span>

                    <div class="flex flex-wrap justify-center gap-2 md:gap-3 flex-1">
                        @foreach(range(1, 10) as $value)
                            <label class="cursor-pointer">
                                <input type="radio" name="puntos" value="{{ $value }}" x-model="puntos" class="sr-only" required>

                                <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-md border-2 font-semibold transition-all duration-200"
                                     :class="puntos == {{ $value }}
                                        ? 'bg-blue-600 text-white border-blue-600 shadow-md scale-105'
                                        : 'bg-white text-gray-600 border-gray-200 hover:border-blue-400 hover:bg-blue-50'">
                                    {{ $value }}
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <span class="text-sm font-bold text-gray-500 hidden md:block w-32 text-right">MUY PROBABLE</span>
                </div>

                <div class="flex justify-between mt-4 md:hidden text-xs font-bold text-gray-500">
                    <span>NADA PROBABLE</span>
                    <span>MUY PROBABLE</span>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8 mb-6" x-show="puntos" x-transition.opacity.duration.300ms style="display: none;">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
                    <label for="porque" class="font-semibold text-gray-700 text-lg block" x-text="preguntaDinamica"></label>

                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 transition duration-150 ease-in-out"
                               onclick="toggleComentario('porque', this)">
                        <span class="ml-2 text-sm text-gray-600 font-medium">No deseo agregar comentarios</span>
                    </label>
                </div>

                <textarea required name="porque" id="porque" rows="4"
                    class="w-full resize-y border-gray-300 shadow-sm rounded-md text-gray-800 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                    placeholder="Escribe tus comentarios aquí..."></textarea>
            </div>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-2">
                <a href="{{ route('principal.index') }}"
                    class="w-full sm:w-auto text-center transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-10 rounded-md shadow-md">
                    Cancelar
                </a>
                <button type="submit"
                    onclick="this.disabled=true; this.innerHTML='Enviando...'; this.form.submit();"
                    class="w-full sm:w-auto transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-10 rounded-md shadow-md">
                    Calificar
                </button>
            </div>

        </div>
    </form>

    <script src="{{ asset('js/utilidades.js') }}"></script>
</x-app-layout>
