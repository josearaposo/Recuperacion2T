<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Marca: {{Str::upper($ordenador->marca)}}
                </h1>

                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-md lg:text-md dark:text-gray-400">
                    Modelo: {{$ordenador->modelo}}
                </p>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-md lg:text-md dark:text-gray-400">
                    Aula: {{$ordenador->aula->nombre}}
                </p>
            </div>
        </div>
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        Cambios:
        @foreach ($cambios as $cambio)
                    <br>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('ordenadores.show', $ordenador) }}">
                                {{$cambio->ordenador->nombre }}
                            </a>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('ordenadores.show', $ordenador) }}">
                                {{$cambio->origen->nombre }}
                            </a>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('ordenadores.show', $ordenador) }}">
                                {{$cambio->destino->nombre}}
                            </a>
                        </th>

                    </tr>
                @endforeach
            </div>
    </section>
</x-app-layout>
