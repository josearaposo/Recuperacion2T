<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;
use App\Models\Dispositivo;
use App\Models\Ordenador;
use Faker\Core\Number;
use Ramsey\Uuid\Type\Integer;

class DispositivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dispositivos.index', [
            'dispositivos' => Dispositivo::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dispositivos.create', [
            'ordenadores' => Ordenador::all(),
            'aulas' => Aula::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
        ]);

        if (is_numeric($request->ubicacion)){
            $aula = Aula::find($request->ubicacion);
        }
        else{
            $aula = Ordenador::where('modelo', $request->ubicacion)->first();
        }

        $dispositivo = new Dispositivo();
        $dispositivo->nombre = $validated['nombre'];
        $dispositivo->colocable()->associate($aula);
        $dispositivo -> save();
        session()->flash('success', 'El dispositivo se ha creado correctamente.');
        return redirect()->route('dispositivos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dispositivo $dispositivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dispositivo $dispositivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dispositivo $dispositivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dispositivo $dispositivo)
    {
        //
    }
}
