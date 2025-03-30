<?php
$serv = true;
?>
@extends('template')
@section('content')
    <form method="POST" action="{{route($service->id ? 'updateServices' : 'saveServices', $service->id)}}">
        @csrf
        @method($service->id ? 'put' : 'post')
        <div class="container col-md-5 float-start">
            <div class="mb-3">
                <label class="form-label">Libelle</label>
                <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror"
                       value="{{$service->id ? $service->libelle : old('libelle')}}">
                @error('libelle')
                <span class="text-danger"> {{$message}}</span><br>
                @enderror
                <label class="form-label">Département</label>
                <select name="departement_id" class="form-select  @error('departement_id') is-invalid @enderror"
                        aria-label="Default select example">
                    @if(!$service->id)
                        <option value="" selected disabled>Sélectionner...</option>
                        @foreach($departements as $d)
                            <option value="{{$d->id}}">{{$d->libelle}}</option>
                        @endforeach
                    @else
                        <option value="{{$service->departement_id}}">{{$service->departement->libelle}}</option>
                        @foreach($departements as $d)
                            @if($service->departement_id!= $d->id)
                                <option value="{{$d->id}}">{{$d->libelle}}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
                @error('departement_id')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">{{$service->id ? "Modifier" : "Ajouter"}}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
