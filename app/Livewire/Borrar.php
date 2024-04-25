<?php

namespace App\Livewire;

use App\Models\Cambio;
use Livewire\Component;

use function Laravel\Prompts\confirm;

class Borrar extends Component
{

    public function borrado()
    {

            $cambios = Cambio::all();
            $cambios->each(function ($cambio) {
                $cambio->delete();
            });


            return redirect()->route('ordenadores.index');
    }

    public function render()
    {
        return view('livewire.borrar');
    }
}
