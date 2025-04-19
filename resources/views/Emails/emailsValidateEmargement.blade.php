<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .header {
            font-size: 24px;
            color: #0056b3;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        a {
            color: #0056b3;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class='container'>
    <div class='header'>Emargement validé</div>
    <p>Bonjour {{$emargement->utilisateur->prenom}} {{$emargement->utilisateur->nom}},</p>
    <p>Votre émargement éffectué le
        {{\Carbon\Carbon::parse($emargement->date)->format('d/m/Y')}} a été validé avec succès</p>
    <p>Vous pouvez consulter l'historique de vos émargements directement sur notre site internet <strong> ISI -
            Présences </strong></p>
    <p>Nous vous remercions pour votre implication et votre rigueur.</p>
    <p>Si vous avez des questions ou besoin d'assistance, n'hésitez pas à nous contacter à l'adresse <a
            href='mailto:ISIedusup@gmail.com'>ISIedusup@gmail.com</a></p>
    <div class='footer'>
        Cordialement,<br>
        <strong>Admin-ISI</strong><br>
        Tél : +33 1 23 45 67 89
    </div>
</div>
</body>
</html>
