<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\PHPMailer;

class ResetPasswordController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = Utilisateur::where('email', $request['email'])->first();

        if (!$user) {
            return back()->with('messageerror', 'Désolé, cet email n\'existe pas !');
        }

        $user->otp_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

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
            $mail->addAddress($user->email, $user->prenom . ' ' . $user->nom);

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = 'ISI-Présences - Code de vérification temporaire';
            $mail->Body = view('Emails.emailsOTP', ['user' => $user])->render();
            $mail->CharSet = 'UTF-8';
            $mail->send();
        } catch (Exception $e) {
            return back()->with("error", "email non envoyé. Erreur : {$mail->ErrorInfo}");
        }
        $user->otp_expires_at = now()->addMinutes(2);
        $user->save();
        Session::put('otp_expires_at', $user->otp_expires_at);
        Session::put('otp_step_verified', true);
        Session::put('userId', $user->id);
        return to_route('showOTPForm');

    }

    public function showOTPForm()
    {
        if (!Session::get('otp_step_verified')) {
            return redirect()->route('resetPassword')
                ->with('messageerror', 'Veuillez d\'abord entrer votre email.');
        }
        return view('CompteOublié.OTPVerification');
    }

    public function verifyCode(Request $request)
    {

        $codeSaisi = implode('', $request['otp']);
        $user = Utilisateur::where('id', session('userId'))->first();

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->with('messageerror', 'Le code a expiré, veuillez en générer un nouveau.');
        }
        if ($codeSaisi === $user->otp_code) {
            Session::put('code_correct', true);
            return redirect()->route('showNewPasswordForm');
        }
        return back()->with('messageerror', 'Le code saisi est incorrect.');
    }

    public function showNewPasswordForm()
    {
        if (!Session::get('otp_step_verified')) {
            return redirect()->route('resetPassword')
                ->with('messageerror', 'Veuillez d\'abord entrer votre email.');

        }
        if (!Session::get('code_correct')) {
            return redirect()->route('showOTPForm')
                ->with('messageerror', 'Veuillez d\'abord entrer le code de vérification');
        }
        return view('CompteOublié.newPassword');
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ]);

        $user = Utilisateur::find(session('userId'));

        if (!$user) {
            return redirect()->route('resetPassword')->with('messageerror', 'Désolé, cet email n\'existe pas !');
        }

        $user->password = Hash::make($request['password']);
        $user->save();
        Session::forget('code_correct');
        Session::forget('userId');
        Session::forget('otp_step_verified');
        Session::forget('otp_expires_at');
        return redirect('/')->with('message_succes', 'votre mot de passe à été modifié avec succés');
    }

    public function renvoyerCode()
    {
        $user = Utilisateur::find(session('userId'));

        if (!$user) {
            return redirect('resetPassword')->with('messageerror', 'Désolé, cet email n\'existe pas !');
        }

        $user->otp_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

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
            $mail->setFrom('ISIedusup@gmail.com', "Institut supérieur d'informatique");
            $mail->addAddress($user->email, $user->prenom . ' ' . $user->nom);

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = 'ISI-Présences - Code de vérification temporaire';
            $mail->Body = view('Emails.emailsOTP', ['user' => $user])->render();
            $mail->CharSet = 'UTF-8';
            $mail->send();
        } catch (Exception $e) {
            return back()->with("error", "email non envoyé. Erreur : {$mail->ErrorInfo}");
        }

        $user->otp_expires_at = now()->addMinutes(2);
        $user->save();
        Session::put('otp_expires_at', $user->otp_expires_at);
        return back();

    }

}
