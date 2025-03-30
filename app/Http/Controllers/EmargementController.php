<?php

namespace App\Http\Controllers;

use App\Models\Emargement;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class EmargementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $emargements = Emargement::orderBy('date', 'desc')->paginate(3);
        $emargementsEmploye = Emargement::where('utilisateur_id', session('user_id'))->orderBy('date', 'DESC')->paginate(3);
        return view('Emargements.list',compact('emargements',  'emargementsEmploye'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $emargements = Emargement::where('utilisateur_id', session('user_id'))->get();
        return view('Emargements.add', compact('emargements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $emargement = new Emargement();
        $emargement->date = now();
        $emargement->status = "En attente";
        $emargement->utilisateur_id = session('user_id');
        $emargement->save();
        return redirect("Emargements")->with("message","Votre émargement à été lancé avec succés, en attente de validation, merci!");
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function valider(string $id)
    {
        $emargement = Emargement::find($id);
        $emargement->status = "Présent";
        $emargement->save();
        return  redirect("Emargements")->with("message","Emargement validé avec succés..");
    }
    public function invalider(string $id)
    {
        $emargement = Emargement::find($id);
        $emargement->status = "Invalide";
        $emargement->save();
        return  redirect("Emargements")->with("message","Emargement invalidé avec succés..");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportPdf()
    {
        $emargements = Emargement::orderBy('date', 'desc')->get();
        $pdf = PDF::loadView('Emargements.pdf', compact('emargements'));
        return $pdf->download('emargements_'.now().'.pdf');
    }

    public function exportExcel()
    {
        // 1. Récupération des données
        $emargements = Emargement::with('utilisateur')->orderBy('date', 'desc')->get()->toArray();

        // 2. Préparation des données pour Excel
        $exportData = [
            ['ID', 'Date', 'Statut', 'Employé'] // En-têtes
        ];

        // 3. Remplissage des données
        foreach ($emargements as $emargement) {
            $exportData[] = [
                $emargement['id'],
                $emargement['date'],
                $emargement['status'],
                $emargement['utilisateur']['nom'] . ' ' . $emargement['utilisateur']['prenom'],
            ];
        }

        // 4. Création et téléchargement du fichier Excel
        $excel = app('excel'); // Obtenez une instance d'Excel

        return $excel->download(
            new class($exportData) implements FromArray, WithHeadings {
                private $data;

                public function __construct(array $data) {
                    $this->data = $data;
                }

                public function array(): array {
                    return array_slice($this->data, 1); // Données sans les en-têtes
                }

                public function headings(): array {
                    return $this->data[0] ?? []; // Juste les en-têtes
                }
            },
            'emargements_'.now().'.xlsx' // Nom du fichier
        );
    }
}
