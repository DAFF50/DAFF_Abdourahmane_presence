<?php
$emar = true;
?>
@extends('template')
@section('content')
    <h3>Vos émargements du mois</h3><br>
    <div class="row">
        @php
            // Configuration locale en français
            \Carbon\Carbon::setLocale('fr');

            // Date actuelle
            $now = now();
            $currentDay = $now->day;
            $currentMonth = $now->month;
            $currentYear = $now->year;

            // Nombre de jours dans le mois actuel
            $daysInMonth = $now->daysInMonth;

            // Création des dates du mois
            $dates = [];
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = \Carbon\Carbon::create($currentYear, $currentMonth, $day);
                $dates[] = $date;
            }
        @endphp

        @foreach($dates as $date)
            @php $checkEmargement =false @endphp
            @php $checkStatus =false @endphp
            @foreach($emargements as $e)
                @php
                    $edate = \Carbon\Carbon::parse($e->date);
                @endphp
                @if($edate->format('Y-m-d') ==  $date->format('Y-m-d'))
                    @php
                        $checkEmargement = true;
                        $checkStatus = $e->status;
                        break;
                    @endphp

                @endif
            @endforeach
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 {{ $date->isToday() ? 'border-primary' : '' }}">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $date->translatedFormat('l j F Y') }}
                            @if($date->isToday())
                                <span class="badge bg-primary">Aujourd'hui</span>
                            @endif
                        </h5>

                        <div class="mb-2">
                            <strong>Nom:</strong> {{ session('user_prenom') }} {{ session('user_nom') }}
                        </div>
                        <div class="mb-2">
                            <strong>Service:</strong> {{ session('user_service') }}
                        </div>
                        <div class="mb-2">
                            <strong>Département:</strong> {{ session('user_departement') }}
                        </div>

                        @if($date->isToday() && !$checkEmargement)
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#emargementmodal">Émarger
                            </button>
                        @elseif($date->isPast())
                            <div class="text-muted">Jour passé</div>
                        @else
                            <div class="text-muted">À venir</div>
                        @endif
                        @if($checkEmargement == true)
                            <span
                                class="badge {{$checkStatus == "Présent" ? 'bg-success' : 'bg-danger'}}">{{$checkStatus}}</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <div class="container">
            <div class="modal" tabindex="-1" id="emargementmodal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>En cliquant sur oui, vous confirmez votre présence aujourd'hui</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                            <a type="button" class="btn btn-primary" href="{{route('saveEmargements')}}">Oui</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
