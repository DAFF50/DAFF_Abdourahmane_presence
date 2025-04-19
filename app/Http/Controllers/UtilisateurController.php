<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Service;
use App\Models\utilisateur;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $utilisateurs = Utilisateur::orderBy('created_at', 'desc')->paginate(3);
        return view('Utilisateurs.list',compact('utilisateurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        $utilisateur = new utilisateur();
        return view('Utilisateurs.add', compact('utilisateur', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:utilisateurs,email',
            'role' => 'required',
            'service' => 'nullable',
        ]);
        $utilisateur = new Utilisateur();
        $utilisateur->nom = $request['nom'];
        $utilisateur->prenom = $request['prenom'];
        $utilisateur->email = $request['email'];
        $utilisateur->password = Hash::make("passer");
        $utilisateur->role = $request['role'];
        $utilisateur->service_id = null;
        $utilisateur->save();

        // Envoi d'email avec PHPMailer
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'in-v3.mailjet.com'; // Remplacez par votre serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'f4dfe8514f40b252a6cd2c9eb6a78084';
            $mail->Password = '7a0a7e12f4e9c534b21593d284ed3a0b';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Expéditeur et destinataire
            $mail->setFrom('ISIedusup@gmail.com', "Institut supérieur d'infotmatique");
            $mail->addAddress($utilisateur->email, $utilisateur->prenom . ' ' . $utilisateur->nom);

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = 'Bienvenue à ISI';
            $mail->Body = view('Emails.emailsAddUsers', ['utilisateur' => $utilisateur])->render();
            $mail->CharSet = 'UTF-8';
            $mail->send();
        } catch (Exception $e) {
            return redirect("Utilisateurs")->with("error", "Utilisateur ajouté, mais email non envoyé. Erreur : {$mail->ErrorInfo}");
        }
        return redirect("Utilisateurs")->with("message","Nouveau Utilisateur ajouté avec succés");
        //to_route('Utilisateur');
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
        $services = Service::all();
        $utilisateur = Utilisateur::find($id);
        return view('Utilisateurs.add',compact('utilisateur', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $utilisateur = Utilisateur::find($id);
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:utilisateurs,email,'.$utilisateur->id,
            'role' => 'required',
            'service' => 'nullable',
        ]);
        $utilisateur = Utilisateur::find($id);
        $utilisateur->nom = $request['nom'];
        $utilisateur->prenom = $request['prenom'];
        $utilisateur->email = $request['email'];
        $utilisateur->role = $request['role'];
        $utilisateur->save();
        return  redirect("Utilisateurs")->with("message","utilisateur modifié avec succes..");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Utilisateur::destroy([$id]);
        return  redirect("Utilisateurs")->with("message","Utilisateur supprimé avec succes..");
    }
}
