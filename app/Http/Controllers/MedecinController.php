<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medecin;


class MedecinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $medecins = Medecin::all();
        return view('medecins.index', compact('medecins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("medecins.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'Nom_Prenom' => 'required|string|max:200',
            'Sexe' => 'required',
            'Specialite' => 'required|string|max:100',
            'Telephone' => 'nullable|string|max:20',
            'Email' => 'nullable|email|unique:medecins|max:100',
            'Disponibilites' => 'nullable|array',
        ]);

        //validation des disponibilités
        $validated['Disponibilites'] = json_encode($validated['Disponibilites']); // convertir en JSON

        Medecin::create($validated);

        return redirect()->route('medecins.index')->with("success", "Medecin ajouté avec succès");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view("medecins.show", [
            'medecin' => Medecin::findOrFail($id)
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view("medecins.edit", [
            'medecin' => Medecin::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated=$request->validate([
            'Nom_Prenom' =>"required|string|max:200",
            'Sexe' => 'required',
            'Specialite' => 'required|string|max:100',
            'Telephone' => 'nullable|string|max:20',
            'Email' => 'nullable|email|max:100|unique:medecins,Email,'.$id,
            'Disponibilites' => 'nullable|array',
        ]);

        $medecin = Medecin::findOrFail($id);

        if (isset($validated['Disponibilites'])) 
            {
                $validated['Disponibilites'] = json_encode($validated['Disponibilites']); // convertir en JSON
            }

        $medecin->update($validated);

        return redirect()->route("medecins.index")->with("succes", "Medecin modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $medecin = Medecin::findOrFail($id);
        $medecin->delete();

         return redirect()->route("medecins.index")->with("success", "Médecin supprimé avec succès");
    }
}
