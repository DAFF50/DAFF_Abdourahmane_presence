@php
    $emar = true;
@endphp
@extends('template.template')
@section('content')
    <h4>{{session('user_role') != "Employe" ? 'Historique des émargements' : 'Historique de mes émargements'}}</h4>
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('user_role' != "Employe"))
        <a class="btn btn-primary" data-bs-toggle="modal"
           data-bs-target="#exporter">
            Exporter
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
            </svg>
        </a>
    @endif
    <div class="container">
        <div class="modal" tabindex="-1" id="exporter">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Options d'export</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Sélectionnez le format d'export :</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{route('exportPdf')}}"
                               class="btn btn-primary">
                                <i class="bi bi-filetype-pdf"></i> PDF
                            </a>
                            <a href="{{route('exportExcel')}}"
                               class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i> Excel
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table mt-4">
        <thead class="class1">
        <tr>
            <th>ID</th>
            <th>DATE</th>
            <th>STATUS</th>
            <th>Employe</th>
            <th>Service</th>
            <th>{{session('user_role' ) != "Employe" ? 'Action' : ''}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach(session('user_role') == 'Employe' ? $emargementsEmploye : $emargements as $e)
            <tr>
                <td>{{$e->id}}</td>
                <td>{{$e->date}}</td>
                <td>{{$e->status}}</td>
                <td>{{$e->utilisateur->prenom}} {{$e->utilisateur->nom}}</td>
                <td> {{$e->utilisateur->service->libelle ?? 'Aucun'}}</td>
                @if(session('user_role') != "Employe")
                    <td>
                        <a class="btn btn-primary" data-bs-toggle="modal"
                           data-bs-target="#valideremargementmodal{{$e->id}}">
                            Valider
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path
                                        d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg>
                        </a>
                        <a class="btn btn-danger" data-bs-toggle="modal"
                           data-bs-target="#invalideremargementmodal{{$e->id}}">
                            Invalider
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </a>
                    </td>
                @endif
            </tr>
            <div class="container">
                <div class="modal" tabindex="-1" id="valideremargementmodal{{$e->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Avertissement</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>En cliquant sur oui, vous validé la présence de cet employé à la date
                                    correspondante</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                <a type="button" class="btn btn-primary" href="{{route('validerEmargements', $e->id)}}">Oui</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="modal" tabindex="-1" id="invalideremargementmodal{{$e->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Avertissement</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>En cliquant sur oui, vous invalidé la présence de cet employé à la date
                                    correspondante</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                <a type="button" class="btn btn-primary"
                                   href="{{route('invaliderEmargements', $e->id)}}">Oui</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    @if(session('user_role') != "Employe")
        {{ $emargements->links('pagination::bootstrap-5') }}
    @else
        {{ $emargementsEmploye->links('pagination::bootstrap-5') }}
    @endif

@endsection
