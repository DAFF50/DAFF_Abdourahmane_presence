<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\service;
use App\Models\Service as ModelsService;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $departements = Departement::all();
        $services = Service::paginate(3);
        return view('Services.list', compact('services', 'departements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departements = Departement::all();
        $service = new Service();
        return view('Services.add', compact('service', 'departements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'departement_id' => 'required',
        ]);
        $service = new Service();
        $service->libelle = $request['libelle'];
        $service->departement_id = $request['departement_id'];
        $service->save();
        return redirect("Services")->with("message", "Nouveau service créer avec succés");
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
        $departements = Departement::all();
        $service = Service::find($id);
        return view('Services.add', compact('service', 'departements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'libelle' => 'required',
            'departement_id' => 'required',
        ]);
        $service = Service::find($id);
        $service->libelle = $request['libelle'];
        $service->departement_id = $request['departement_id'];
        $service->save();
        return redirect("Services")->with("message", "service modifié avec succés..");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $utilisateursCount = Utilisateur::where('service_id', $id)->count();
        if ($utilisateursCount > 0) {
            return redirect("Services")->with("messageerror", "Impossible car ce service contient de(s) utilisateur(s)!");
        }
        Service::destroy([$id]);
        return redirect("Services")->with("message", "Service supprimé avec succés..");
    }

    public function gestionEmploye()
    {
        $employes = Utilisateur::where('role', 'Employe')->get();
        $services = Service::all();
        return view('Services.attributionEmploye', compact('services', 'employes'));
    }

    public function updateEmploye(Request $request)
    {
        $request->validate([
            'employeId' => 'required',
            'service_id' => 'required',
        ]);

        $employe = Utilisateur::find($request['employeId']);
        $employe->service_id = $request['service_id'];
        $employe->save();
        return redirect("Services/Employe")->with("message", "Attribution d'un service à un employé reussi! ");
    }
}
