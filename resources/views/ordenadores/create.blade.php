<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST" action="{{ route('ordenadores.store') }}">
            @csrf

            <!-- Marca -->
            <div>
                <x-input-label for="marca" :value="'Marca del Ordenador'" />
                <x-text-input id="marca" class="block mt-1 w-full" type="text" name="marca" :value="old('marca')"
                    required autofocus autocomplete="marca" />
                <x-input-error :messages="$errors->get('marca')" class="mt-2" />
            </div>
            <!-- Modelo -->
            <div>
                <x-input-label for="modelo" :value="'Modelo del Ordenador'" />
                <x-text-input id="modelo" class="block mt-1 w-full" type="text" name="modelo" :value="old('modelo')"
                    required autofocus autocomplete="modelo" />
                <x-input-error :messages="$errors->get('modelo')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="aula_id" :value="'Aula del ordenador'" />
                <select id="aula_id"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                    name="aula_id" required>
                    @forelse ($aulas as $aula)
                    <option value="{{ $aula->id }}"
                        {{ old('aula_id') == $aula->id ? 'selected' : '' }}>
                        {{ $aula->nombre }}
                    </option>

                    @empty
                        No existen desarrolladoras
                    @endforelse
                </select>
                <x-input-error :messages="$errors->get('desarrolladora_id')" class="mt-2" />

            </div>
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('ordenadores.index') }}">
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
