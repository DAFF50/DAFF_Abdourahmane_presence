@php
    $users = true;
@endphp
@extends('template')
@section('content')
    <h2>{{$utilisateur->id ? 'Modifier les informations de l\'utilisateur' : 'Ajouter un nouveau utilisateur'}}</h2>
    <form method="POST"
          action="{{ route($utilisateur->id ? 'updateUtilisateurs' : 'saveUtilisateurs', $utilisateur->id) }}">
        @csrf
        @method($utilisateur->id ? 'put' : 'post')
        <div class="container col-md-5 float-start">
            <div class="mb-3">
                <!-- Row pour les champs Nom et Prénom -->

                <div class="col-md-12">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                           value="{{ $utilisateur->id ? $utilisateur->nom : old('nom') }}">
                    @error('nom')
                    <span class="text-danger"> {{ $message }}</span><br>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                           value="{{ $utilisateur->id ? $utilisateur->prenom : old('prenom') }}">
                    @error('prenom')
                    <span class="text-danger"> {{ $message }}</span><br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ $utilisateur->id ? $utilisateur->email : old('email') }}">
                    @error('email')
                    <span class="text-danger"> {{ $message }}</span><br>
                    @enderror
                </div>

                <!-- Row pour les champs Role et Département -->
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror"
                                aria-label="Default select example">
                            @if(!$utilisateur->id)
                                <option value="" selected disabled>Sélectionner...</option>
                                <option value="Administrateur">Administrateur</option>
                                <option value="Gestionnaire">Gestionnaire</option>
                                <option value="Employe">Employe</option>
                            @else
                                <option value="{{ $utilisateur->role }}">{{ $utilisateur->role }}</option>
                                @if($utilisateur->role != "Administrateur")
                                    <option value="Administrateur">Administrateur</option>
                                @endif
                                @if($utilisateur->role != "Gestionnaire")
                                    <option value="Gestionnaire">Gestionnaire</option>
                                @endif
                                @if($utilisateur->role != "Employe")
                                    <option value="Employe">Employe</option>
                                @endif
                            @endif
                        </select>
                        @error('role')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Service</label>
                        <select name="service" class="form-select @error('service') is-invalid @enderror"
                                aria-label="Default select example">
                            @if(!$utilisateur->id)
                                <option value="" selected disabled>Sélectionner...</option>
                                @foreach($services as $s)
                                    <option value="{{$s->id}}">{{$s->libelle}}</option>
                                @endforeach
                            @else
                                <option
                                    value="{{$utilisateur->service_id}}">{{$utilisateur->service->libelle}}</option>
                                @foreach($services as $s)
                                    @if($utilisateur->service_id!= $s->id)
                                        <option value="{{$s->id}}">{{$s->libelle}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @error('service')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-5">{{ $utilisateur->id ? "Modifier" : "Ajouter" }}</button>
        </div>
    </form>
@endsection
