<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST" action="{{ route('dispositivos.store'), }}">
            @csrf

            <!-- Nombre -->
            <div>
                <x-input-label for="nombre" :value="'Nombre del Dispositivo'" />
                <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')"
                    required autofocus autocomplete="nombre" />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>
            <!-- Tipo -->
            <div>
                <x-input-label for="aula_id" :value="'Ubicación del dispositivo'" />
                <select id="ubicacion"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                    name="ubicacion" required>
                    @forelse ($aulas as $aula)
                        <option value="{{ $aula->id }}" {{ old('ubicacion') == $aula->id ? 'selected' : '' }}>
                            {{ $aula->nombre }}
                        </option>
                    @empty
                        No existen aulas
                    @endforelse

                    @forelse ($ordenadores as $ordenador)
                        <option value="{{ $ordenador->modelo }}" {{ old('ubicacion') == $ordenador->id ? 'selected' : '' }}>
                            {{ $ordenador->marca . ' ' . $ordenador->modelo . ' ' . 'del ' . $ordenador->aula->nombre }}
                        </option>
                    @empty
                        No existen ordenadores
                    @endforelse
                </select>
                <x-input-error :messages="$errors->get('desarrolladora_id')" class="mt-2" />

            </div>
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('dispositivos.index') }}">
                    <x-secondary-button class="ms-4">
                        Volver
                        </x-primary-button>
                </a>
                <x-primary-button class="ms-4">
                    Insertar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
