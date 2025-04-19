<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Service;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departements = Departement::paginate(3);
        return view('Departements.list',compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departement = new Departement();
        return view('Departements.add', compact('departement'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
        ]);
        $departement = new Departement();
        $departement->libelle = $request['libelle'];
        $departement->save();
        return redirect("Departements")->with("message","Nouveau département créer avec succés");
        //to_route('Services');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departement = Departement::find($id);
        return view('Departements.add',compact('departement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'libelle' => 'required',
        ]);
        $departement = Departement::find($id);
        $departement->libelle = $request['libelle'];
        $departement->save();
        return  redirect("Departements")->with("message","département modifié avec succés..");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servicesCount = Service::where('departement_id', $id)->count();
        if($servicesCount > 0){
            return  redirect("Departements")->with("messageerror","Impossible de supprimer ce département car il contient de(s) service(s)!");
        }
        Departement::destroy([$id]);
        return  redirect("Departements")->with("message","Departement supprimé avec succés..");
    }
}
