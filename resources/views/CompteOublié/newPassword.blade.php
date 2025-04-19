<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In/Up Form</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background: #FFFFFF;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 92vh;
            margin: -20px 0 50px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
            margin-bottom: 20px;
        }

        .h1C {
            color: rgb(0, 126, 182);
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid rgb(0, 126, 182);
            background-color: rgb(0, 126, 182);
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button:hover {
            cursor: pointer;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .container {
            margin-top: 50px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
            0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 800px;
            max-width: 100%;
            min-height: 440px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .overlay {
            background: linear-gradient(to right, rgb(0, 126, 182), rgb(0, 126, 182));
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        footer {
            background-color: #222;
            color: #fff;
            font-size: 14px;
            bottom: 0;
            position: fixed;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 999;
        }

        footer p {
            margin: 10px 0;
        }

        footer i {
            color: red;
        }

        footer a {
            color: #3c97bf;
            text-decoration: none;
        }

        input.is-invalid {
            border: 2px solid red;
        }

        .text-danger {
            color: red;
        }

        /* Styles pour l'effet machine à écrire */
        .typewriter-container {
            min-height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .typewriter-text {
            display: inline-block;
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .typewriter-cursor {
            display: inline-block;
            width: 2px;
            height: 20px;
            background-color: white;
            animation: blink-caret 0.75s step-end infinite;
            vertical-align: middle;
            margin-left: 2px;
        }

        @keyframes blink-caret {
            from, to { opacity: 0 }
            50% { opacity: 1 }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container sign-in-container">
        <form method="post" action="{{route('newPassword')}}">
            @csrf
            @method('post')
            <h1 class="h1C">&nbsp;&nbsp;Nouveau  mot de passe du compte</h1>
            <input type="password" name="password" placeholder="Nouveau mot de passe"
                   class="form-control @error('password') is-invalid @enderror"/>
            @error('password')
            <span class="text-danger"> {{$message}}</span>
            @enderror
            <input type="password" name="confirm_password" placeholder="confirmer mot de passe"
                   class="form-control @error('confirm_password') is-invalid @enderror"/>
            @error('confirm_password')
            <span class="text-danger"> {{$message}}</span>
            @enderror
            <p>Réccupérer votre compte</p>
            <button type="submit">Envoyer</button>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>ISI - Presence</h1>
                <div class="typewriter-container">
                    <div class="typewriter-text" id="changing-text"></div>
                    <div class="typewriter-cursor" id="cursor"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const messages = [
            "Accédez à notre plateforme en ligne",
            "Gérez facilement vos émargements ",
            "Solution simple pour suivre vos présences",
            "Connectez-vous à votre espace en ligne"
        ];

        const textElement = document.getElementById("changing-text");
        let messageIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        // Paramètres ajustables
        const typingSpeed = 60;    // Vitesse d'écriture (ms)
        const deleteSpeed = 60;    // Vitesse d'effacement (plus rapide)
        const pauseBetweenMessages = 2500; // Pause après un message complet
        const pauseBeforeNextMessage = 1000; // Pause après effacement

        function typeWriter() {
            const currentMessage = messages[messageIndex];

            if (isDeleting) {
                textElement.textContent = currentMessage.substring(0, charIndex - 1);
                charIndex--;
            } else {
                textElement.textContent = currentMessage.substring(0, charIndex + 1);
                charIndex++;
            }

            // Fin de l'écriture → pause puis effacement
            if (!isDeleting && charIndex === currentMessage.length) {
                isDeleting = true;
                setTimeout(typeWriter, pauseBetweenMessages);
                return;
            }

            // Fin de l'effacement → passage au message suivant
            if (isDeleting && charIndex === 0) {
                isDeleting = false;
                messageIndex = (messageIndex + 1) % messages.length;
                setTimeout(typeWriter, pauseBeforeNextMessage);
                return;
            }

            // Vitesse adaptée (écriture ou effacement)
            const speed = isDeleting ? deleteSpeed : typingSpeed;
            setTimeout(typeWriter, speed);
        }

        // Démarrer après 1s (pour l'effet initial)
        setTimeout(typeWriter, 1000);
    });
</script>

</body>
</html>
