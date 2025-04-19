<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.settings');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'password' => 'required|min:8',
        ]);

        $user = Utilisateur::find(session('user_id'));
        $user->password = Hash::make($request['password']);
        $user->save();
        return back()->with('message', 'Mot de passe modifié avec succés!');
    }

    public function updateEmail(Request $request){
        $request->validate([
            'email' => 'required|email|unique:utilisateurs,email',
        ]);

        $user = Utilisateur::find(session('user_id'));
        $user->email = $request['email'];
        $user->save();
        Session::put('user_email', $user->email);
        return back()->with('message', 'Email modifié avec succés!');
    }
}
