<?php
$dep = true;
?>
@extends('template')
@section('content')
    <form method = "POST" action="{{route($departement->id ? 'updateDepartements' : 'saveDepartements', $departement->id)}}">
        @csrf
        @method($departement->id ? 'put' : 'post')
        <div class="container col-md-5 float-start">
            <div class="mb-3">
                <label class="form-label">Libelle</label>
                <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror" value="{{$departement->id ? $departement->libelle : old('libelle')}}" >
                @error('libelle')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{$departement->id ? "Modifier" : "Ajouter"}}</button>
        </div>
    </form>
@endsection
