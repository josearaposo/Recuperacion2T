<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdenadorRequest;
use App\Http\Requests\UpdateOrdenadorRequest;
use App\Models\Ordenador;

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
       return view('ordenadores.create');
   }


   /**
    * Store a newly created resource in storage.
    */
   public function store(StoreCompanyaRequest $request)
   {
       $validated = $request->validate([
           'nombre' => 'required|max:255',
       ]);


       $companya = new Companya();
       $companya->nombre = $validated['nombre'];
       $companya->save();
       session()->flash('success', 'El companya se ha creado correctamente.');
       return redirect()->route('ordenadores.index');
   }


   /**
    * Display the specified resource.
    */
   public function show(Companya $companya)
   {
       //
   }


   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Companya $companya)
   {
       return view('ordenadores.edit', [
           'companya' => $companya,
       ]);
   }


   /**
    * Update the specified resource in storage.
    */
   public function update(UpdateCompanyaRequest $request, Companya $companya)
   {
       $validated = $request->validate([
           'nombre' => 'required|max:255',
       ]);


       $companya->nombre = $validated['nombre'];
       $companya->save();
       session()->flash('success', 'El companya se ha editado correctamente.');
       return redirect()->route('ordenadores.index');
   }


   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Companya $companya)
   {
       $companya->delete();
       return redirect()->route('ordenadores.index');
   }

}
