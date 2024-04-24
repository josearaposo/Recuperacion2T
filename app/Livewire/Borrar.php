<?php

namespace App\Livewire;

use App\Models\Cambio;
use Livewire\Component;

use function Laravel\Prompts\confirm;

class Borrar extends Component
{

    public function borrado()
    {
        if (confirm('¿Estás seguro de que deseas borrar todos los registros?')) {
            $cambios = Cambio::all();
            $cambios->each(function ($cambio) {
                $cambio->delete();
            });
        }

        return back();
    }

    public function render()
    {
        return view('livewire.borrar');
    }
}
