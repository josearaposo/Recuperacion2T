<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Cambio;
use App\Models\Ordenador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;


class OrdenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
   {
       return view('ordenadores.index', [
           'ordenadores' => Ordenador::all(),
       ]);
   }


   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
    return view('ordenadores.create', [
        'aulas' => Aula::all(),
    ]);
   }


   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
       $validated = $request->validate([
           'marca' => 'required|max:255',
           'modelo' => 'required|max:255',
           'aula_id' => 'required|max:255',
       ]);


       $ordenador = new Ordenador();
       $imagen = $request->file('foto');
       Storage::makeDirectory('public/album');
       $nombre = Carbon::now() . '.jpeg';
       $manager = new ImageManager(new Driver());

       $ordenador->guardar_imagen($imagen, $nombre, 100, $manager);

       $ordenador->marca = $validated['marca'];
       $ordenador->modelo = $validated['modelo'];
       $ordenador->aula_id = $validated['aula_id'];
       $ordenador->foto = $nombre;
       $ordenador->save();
       session()->flash('success', 'El ordenador se ha creado correctamente.');
       return redirect()->route('ordenadores.index');
   }


   /**
    * Display the specified resource.
    */
   public function show(Ordenador $ordenador)
   {
    return view('ordenadores.detalle', [
        'ordenador' => $ordenador,
        'cambios' => $ordenador-> cambios,
        'dispositivos' => $ordenador->dispositivos,
    ]);
   }


   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Ordenador $ordenador)
   {
       return view('ordenadores.edit', [
           'ordenador' => $ordenador,
           'aulas' => Aula::all(),
       ]);
   }


   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, Ordenador $ordenador)
   {
    if($ordenador->aula_id != $request->aula_id){
        $cambio = new Cambio();
        $cambio-> ordenador_id = $ordenador->id;
        $cambio->origen_id = $ordenador->aula_id;
        $cambio->destino_id = $request->aula_id;
        $cambio -> save();
    };
    $validated = $request->validate([
        'marca' => 'required|max:255',
        'modelo' => 'required|max:255',
        'aula_id' => 'required|max:255',
    ]);

    $ordenador->marca = $validated['marca'];
    $ordenador->modelo = $validated['modelo'];
    $ordenador->aula_id = $validated['aula_id'];
    $ordenador->save();
       session()->flash('success', 'El companya se ha editado correctamente.');
       return redirect()->route('ordenadores.index');
   }


   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Ordenador $ordenador)
   {
    if ($ordenador->cambios->isEmpty() && $ordenador->dispositivos->isEmpty() ){
        $ordenador->delete();
    } else {
        session()->flash('error', 'El ordenador tiene cambios o dispositivos.');
    }
    return redirect()->route('ordenadores.index');
}
   }


