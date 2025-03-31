<?php

namespace App\Http\Controllers;

use App\Models\Emargement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RapportStatistiqueController extends Controller
{
    public function presenceParEmploye()
    {
        // Récupérer le nombre de présences par employé
        $presences = Emargement::selectRaw('utilisateur_id, count(*) as total')
            ->where('status', 'Présent')
            ->groupBy('utilisateur_id')
            ->with('utilisateur') // Charger la relation utilisateur
            ->get();

        // Préparer les données pour le graphique
        $employes = [];
        $totaux = [];

        foreach ($presences as $presence) {
            $employes[] = $presence->utilisateur->prenom . ' ' . $presence->utilisateur->nom;
            $totaux[] = $presence->total;
        }

        return view('RapportsStatistiques.presenceEmploye', compact('employes', 'totaux'));
    }

    public function evolutionPresences(Request $request)
    {
        $periode = $request->input('periode', 'jour');

        $query = Emargement::where('status', 'Présent');

        switch ($periode) {
            case 'semaine':
                $query->select(
                    DB::raw("TO_CHAR(date, 'IYYY-IW') as periode"),
                    DB::raw("COUNT(*) as total")
                )->groupBy('periode');
                break;

            case 'mois':
                $query->select(
                    DB::raw("TO_CHAR(date, 'YYYY-MM') as periode"),
                    DB::raw("COUNT(*) as total")
                )->groupBy('periode');
                break;

            default: // jour
                $query->select(
                    DB::raw("DATE(date) as periode"),
                    DB::raw("COUNT(*) as total")
                )->groupBy('periode');
        }

        $data = $query->orderBy('periode')->get();

        // Formatage des résultats
        $labels = [];
        $values = [];

        foreach ($data as $item) {
            switch ($periode) {
                case 'semaine':
                    $parts = explode('-', $item->periode);
                    $labels[] = 'Sem ' . $parts[1] . ' ' . $parts[0];
                    break;
                case 'mois':
                    // Format plus lisible pour les mois (ex: "Janv 2023")
                    $labels[] = Carbon::createFromFormat('Y-m', $item->periode)
                        ->locale('fr') // Pour les noms de mois en français
                        ->translatedFormat('M Y'); // Format abrégé
                    break;
                default:
                    $labels[] = Carbon::parse($item->periode)->format('d/m/Y');
            }

            $values[] = $item->total;
        }

        return view('RapportsStatistiques.evolutionPresences', compact('labels', 'values', 'periode'));
    }
}
