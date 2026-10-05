<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center py-6 bg-cover bg-center bg-no-repeat relative"
         style="background-image: url('{{ asset('img/eva.png') }}');">

        <div class="absolute inset-0 bg-gray-900 opacity-60 z-0"></div>

        <div class="z-10 w-11/12 sm:w-full sm:max-w-3xl px-6 sm:px-10 py-10 sm:py-16 bg-white bg-opacity-95 shadow-2xl overflow-hidden rounded-xl border-t-8 border-indigo-800 text-center">

            <div class="flex justify-center mb-6">
                <svg class="h-16 w-16 sm:h-20 sm:w-20 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4 tracking-tight">
                El periodo de evaluación aún no inicia
            </h1>

            <p class="text-base sm:text-lg text-gray-600 leading-relaxed">
                La evaluación docente correspondiente al <strong>segundo cuatrimestre</strong> no se ha aperturado todavía.
                <br class="hidden sm:block mt-2">
                Te invitamos a estar al pendiente de los comunicados oficiales y de tus coordinadores para conocer las fechas exactas de inicio.
            </p>

        </div>
    </div>
</x-guest-layout>
