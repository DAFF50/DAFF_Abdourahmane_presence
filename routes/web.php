<?php

use App\Http\Controllers\ServiceController;
use App\Http\Middleware\CheckRole;
use App\Models\service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


//Authentification
Route::get('/', function () {return view('authentification.auth');})->name('authentification');
Route::post('/login', [\App\Http\Controllers\AuthentificationController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\AuthentificationController::class, 'logout'])->name('logout');

//Réccuperation compte
Route::get('/Mot-de-passe-oublié', function () {return view('CompteOublié.resetPassword');})->name('resetPassword');
Route::get('/showOTPForm', [\App\Http\Controllers\ResetPasswordController::class, 'showOTPForm'])->name('showOTPForm');
Route::post('/OTPVérification',[\App\Http\Controllers\ResetPasswordController::class, 'verifyEmail'])->name('OTPVerification');
Route::post('/VerifyCode', [\App\Http\Controllers\ResetPasswordController::class, 'verifyCode'])->name('VerifyCode');
Route::get('/showNewPasswordForm', [\App\Http\Controllers\ResetPasswordController::class, 'showNewPasswordForm'])->name('showNewPasswordForm');
Route::post('/newPassword', [\App\Http\Controllers\ResetPasswordController::class, 'newPassword'])->name('newPassword');
Route::get('/renvoyerCode', [\App\Http\Controllers\ResetPasswordController::class, 'renvoyerCode'])->name('renvoyerCode');
//Les routes protégées
Route::middleware([\App\Http\Middleware\CheckAuth::class])->group(function () {

    Route::middleware([CheckRole::class])->group(function () {

        Route::middleware([\App\Http\Middleware\CheckGestionnaire::class])->group(function () {
            //Utilisateurs
            Route::get('/Utilisateurs', [\App\Http\Controllers\UtilisateurController::class, 'index'])->name('Utilisateurs');
            Route::get('/Utilisateurs/add', [\App\Http\Controllers\UtilisateurController::class, 'create'])->name('addUtilisateurs');
            Route::post('/Utilisateurs/save', [\App\Http\Controllers\UtilisateurController::class, 'store'])->name('saveUtilisateurs');
            Route::delete('/Utilisateurs/delete/{id}', [\App\Http\Controllers\UtilisateurController::class, 'destroy'])->name('deleteUtilisateurs');
            Route::get('/Utilisateurs/edit/{id}', [\App\Http\Controllers\UtilisateurController::class, 'edit'])->name('editUtilisateurs');
            Route::put('/Utilisateurs/update/{id}', [\App\Http\Controllers\UtilisateurController::class, 'update'])->name('updateUtilisateurs');

        });
        //Service
        Route::get('/Services', [ServiceController::class, 'index'])->name('Services');
        Route::get('/Services/add', [ServiceController::class, 'create'])->name('addServices');
        Route::post('/Services/save', [ServiceController::class, 'store'])->name('saveServices');
        Route::delete('/Services/delete/{id}', [\App\Http\Controllers\ServiceController::class, 'destroy'])->name('deleteServices');
        Route::get('/Services/edit/{id}', [\App\Http\Controllers\ServiceController::class, 'edit'])->name('editServices');
        Route::put('/Services/update/{id}', [\App\Http\Controllers\ServiceController::class, 'update'])->name('updateServices');
        Route::get('/Services/Employe', [ServiceController::class, 'gestionEmploye'])->name('gestionEmploye');
        Route::put('/Services/Employe/update', [\App\Http\Controllers\ServiceController::class, 'updateEmploye'])->name('updateEmploye');

        //Departement
        Route::get('/Departements', [\App\Http\Controllers\DepartementController::class, 'index'])->name('Departements');
        Route::get('/Departements/add', [\App\Http\Controllers\DepartementController::class, 'create'])->name('addDepartements');
        Route::post('/Departements/save', [\App\Http\Controllers\DepartementController::class, 'store'])->name('saveDepartements');
        Route::delete('/Departements/delete/{id}', [\App\Http\Controllers\DepartementController::class, 'destroy'])->name('deleteDepartements');
        Route::get('/Departements/edit/{id}', [\App\Http\Controllers\DepartementController::class, 'edit'])->name('editDepartements');
        Route::put('/Departements/update/{id}', [\App\Http\Controllers\DepartementController::class, 'update'])->name('updateDepartements');

        //Rapport et Statistique
        Route::get('/RapportStatistique/presenceParEmploye', [\App\Http\Controllers\RapportStatistiqueController::class, 'presenceParEmploye'])->name('presenceParEmploye');
        Route::get('/RapportStatistique/evolutionPresence', [\App\Http\Controllers\RapportStatistiqueController::class, 'evolutionPresences'])->name('evolutionPresences');
        Route::get('/RapportStatistique/tauxPresenceService', [\App\Http\Controllers\RapportStatistiqueController::class, 'tauxPresenceParService'])->name('tauxPresenceParService');

        //Emargement
        Route::get('/Emargements/valider/{id}', [\App\Http\Controllers\EmargementController::class, 'valider'])->name('validerEmargements');
        Route::get('/Emargements/invalider/{id}', [\App\Http\Controllers\EmargementController::class, 'invalider'])->name('invaliderEmargements');
        Route::get('/emargements/export-pdf', [\App\Http\Controllers\EmargementController::class, 'exportPdf'])->name('exportPdf');
        Route::get('/emargements/export-excel', [\App\Http\Controllers\EmargementController::class, 'exportExcel'])->name('exportExcel');
    });

    //Accueil
    Route::get('/Accueil', function () {return view('Accueil.accueil');})->name('Accueil');

    //Settings
    Route::get('/Settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('Settings');
    Route::post('/Settings/UpdatePassword', [\App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/Settings/UpdateEmail', [\App\Http\Controllers\SettingsController::class, 'updateEmail'])->name('updateEmail');

    //Emargement
    Route::get('/Emargements', [\App\Http\Controllers\EmargementController::class, 'index'])->name('Emargements');
    Route::get('/Emargements/add', [\App\Http\Controllers\EmargementController::class, 'create'])->name('addEmargements');
    Route::get('/Emargements/save', [\App\Http\Controllers\EmargementController::class, 'store'])->name('saveEmargements');

});
