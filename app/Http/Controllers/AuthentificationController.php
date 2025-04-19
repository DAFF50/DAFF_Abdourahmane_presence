<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthentificationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Utilisateur::where('email', $request['email'])->first();

        if ($user && Hash::check($request['password'], $user->password)) {
            Session::put('user_id', $user->id);
            Session::put('user_email', $user->email);
            Session::put('user_nom', $user->nom);
            Session::put('user_prenom', $user->prenom);
            Session::put('user_role', $user->role);
            Session::put('user_service', $user->service->libelle ?? 'Aucun');
            Session::put('user_departement', $user->service->departement->libelle ?? 'Aucun');
            Session::put('created_at', $user->created_at);
            Session::put('user_password', $user->password);
            return to_route('Accueil');
        }
        return back()->with('messageerror', 'Email ou mot de passe incorrect.');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
