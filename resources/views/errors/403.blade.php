@extends('template.template')

@section('content')
    <div class="container text-center">
        <h1 class="text-danger">403 - Accès interdit</h1>
        <p>Désolé, vous n'avez pas la permission d'accéder à cette page.</p>
        <a href="{{ url('/Accueil') }}" class="btn btn-primary">Retour à l'accueil</a>
    </div>
@endsection
