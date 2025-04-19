@extends('template.template')
@section('content')
    <h3 class="mb-4">Paramétre du compte</h3>
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <!-- Section Profil -->
        <div class="col-md-6 mb-4">
            <div class="card shadow rounded-4">
                <div class="card-header text-white py-3" style="background-color: rgb(0, 126, 182); border-radius: 0.5rem 0.5rem 0 0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Profil</span>
                        <small>Compte ouvert en {{\Carbon\Carbon::parse(session('created_at'))->year }}</small>
                    </div>
                </div>
                <div class="card-body p-4" style="border-radius: 0 0 0.5rem 0.5rem;">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="ms-4">
                            <h4 class="mb-1">{{session('user_prenom')}} {{session('user_nom')}}</h4>
                            <a href="#" class="fw-bold small" style="color: #3c97bf">Modifier le nom</a>
                        </div>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">ISI-Présences.me/{{session('user_prenom')}} {{session('user_nom')}}</span>
                    </div>
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-3 px-3 hover-effect" style="border-color: rgb(0, 126, 182); color: rgb(0, 126, 182);">Gérer</a>
                </div>
            </div>
        </div>

        <!-- Email et Mot de passe -->
        <div class="col-md-6">
            <div class="mb-4">
                <h5 class="fw-bold mb-3">Adresse email</h5>
                <div class="p-4 mb-4 rounded-3 shadow-sm d-flex justify-content-between align-items-center bg-white">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                        </svg>
                        <div class="badge bg-light text-dark fw-semibold mb-2">Principal</div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-envelope me-2"></i>
                            <span>{{session('user_email')}}</span>
                        </div>
                    </div>
                    <!-- Button to trigger Email Modal -->
                    <button type="button" class="btn btn-outline-primary rounded-3 px-3 hover-effect" style="border-color: rgb(0, 126, 182); color: rgb(0, 126, 182);" data-bs-toggle="modal" data-bs-target="#emailModal">
                        Modifier
                    </button>
                </div>
            </div>

            <div>
                <h5 class="fw-bold mb-3">Mot de passe</h5>
                <div class="p-4 rounded-3 shadow-sm d-flex justify-content-between align-items-center bg-white">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5"/>
                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                        </svg>
                        <div class="badge bg-light text-dark fw-semibold mb-2">Mot de passe actuel</div>
                        <div class="d-flex align-items-center mb-1">
                            <i class="bi bi-telephone me-2"></i>
                            <span><strong>*******</strong></span>
                        </div>
                        <small class="text-muted">Mobile</small>
                    </div>
                    <!-- Button to trigger Password Modal -->
                    <button type="button" class="btn btn-outline-primary rounded-3 px-3 hover-effect" style="border-color: rgb(0, 126, 182); color: rgb(0, 126, 182);" data-bs-toggle="modal" data-bs-target="#passwordModal">
                        Modifier
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Email -->
    <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(0, 126, 182); color: white;">
                    <h5 class="modal-title" id="emailModalLabel">Modifier l'email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('updateEmail')}}" method="post">
                        @method('post')
                        @csrf
                        <div class="mb-3">
                            <label for="emailInput" class="form-label">Nouvelle adresse email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" placeholder="Entrez votre nouvel email">
                            @error('email')
                            <span class="text-danger"> {{$message}}</span><br>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Password -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(0, 126, 182); color: white;">
                    <h5 class="modal-title" id="passwordModalLabel">Modifier le mot de passe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('updatePassword')}}">
                        @method('post')
                        @csrf
                        <div class="mb-3">
                            <label for="passwordInput" class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="passwordInput" placeholder="Entrez votre nouveau mot de passe">
                            @error('password')
                            <span class="text-danger"> {{$message}}</span><br>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-effect:hover {
            background-color: rgb(0, 126, 182);
            color: white !important;
            transition: all 0.3s ease;
        }
    </style>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            @if ($errors->has('password'))
            let passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'));
            passwordModal.show();
            @endif
        });
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            @if ($errors->has('email'))
            let emailModal = new bootstrap.Modal(document.getElementById('emailModal'));
            emailModal.show();
            @endif
        });
    </script>

@endsection
