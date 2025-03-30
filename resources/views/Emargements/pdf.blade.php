<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Emargements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            color: #007EB6FF;
        }

        h5 {
            color: #007EB6FF;
        }
    </style>
</head>
<body>
<h1>ISI - Présence</h1>
<h2>Liste des Emargements</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Statut</th>
        <th>Employé</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($emargements as $emargement)
        <tr>
            <td>{{ $emargement->id }}</td>
            <td>{{ $emargement->date }}</td>
            <td>{{ $emargement->status }}</td>
            <td>{{ $emargement->utilisateur->prenom }} {{ $emargement->utilisateur->nom }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<h5>Ce document constitue une compilation complète des émargements effectués par l’ensemble des employés. Il permet de
    suivre avec précision la présence et l’assiduité de chacun, tout en offrant une vue d’ensemble sur l’historique des
    pointages enregistrés</h5>
</body>
</html>
