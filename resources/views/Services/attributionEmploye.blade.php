<?php
$serv = true;
?>
@extends('template.template')
@section('content')
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form method="POST" action="{{route('updateEmploye')}}">
        @csrf
        @method('put')
        <div class="container col-md-5 float-start">
            <div class="mb-3">
                <label class="form-label">Employé</label>
                <select name="employeId" class="form-select  @error('employeId') is-invalid @enderror"
                        aria-label="Default select example">
                    <option value="" selected disabled>Sélectionner...</option>
                    @foreach($employes as $e)
                        <option value="{{$e->id}}">{{$e->prenom}} {{$e->nom}}</option>
                    @endforeach
                </select>
                @error('employeId')
                <span class="text-danger"> {{ $message }}</span><br>
                @enderror

                <label  class="form-label mt-3 ">Services</label>
                <select name="service_id" class="form-select  @error('service_id') is-invalid @enderror"
                        aria-label="Default select example">
                        <option value="" selected disabled>Sélectionner...</option>
                        @foreach($services as $s)
                            <option value="{{$s->id}}">{{$s->libelle}}</option>
                        @endforeach
                </select>
                @error('service_id')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary mt-5">Attribuer</button>
                </div>
            </div>
        </div>
    </form>
@endsection
