<x-app-layout>
    <div class="relative overflow-x-auto w-3/4 mx-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ubicacion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lugar
                    </th>
                    <th scope="col" class="px-6 py-3" colspan="2">
                        Acción
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($dispositivos as $dispositivo)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('dispositivos.show', $dispositivo) }}">
                                {{$dispositivo->nombre }}
                            </a>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('dispositivos.show', $dispositivo) }}">
                                {{$dispositivo->colocable_type}}
                            </a>
                        </th>
                        @if ($dispositivo->colocable_type == 'App\Models\Ordenador')
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('dispositivos.show', $dispositivo) }}">
                                {{$dispositivo->colocable->marca }}
                            </a>
                            <a class="text-blue-500 blue" href="{{ route('dispositivos.show', $dispositivo) }}">
                                {{$dispositivo->colocable->modelo }}
                            </a>
                        </th>
                        @else
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('dispositivos.show', $dispositivo) }}">
                                {{"Armario" }}
                            </a>
                        </th>
                        @endif
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('dispositivos.show', $dispositivo) }}">
                                @if($dispositivo->colocable_type == 'App\Models\Ordenador')
                                    {{$dispositivo->colocable->aula->nombre}}
                                @else
                                    {{ $dispositivo->colocable->nombre }}
                                @endif
                            </a>
                        </th>

                        <td class="px-6 py-4">
                            <a href="{{ route('dispositivos.edit', ['dispositivo' => $dispositivo]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <x-primary-button>
                                    Editar
                                </x-primary-button>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('dispositivos.destroy', ['dispositivo' => $dispositivo]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-primary-button class="bg-red-500">
                                    Borrar
                                </x-primary-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('dispositivos.create') }}" class="flex justify-center mt-4 mb-4">
            <x-primary-button class="bg-green-500 mb-2">Insertar un nuevo dispositivo</x-primary-button>
        </form>
    </div>
</x-app-layout>
