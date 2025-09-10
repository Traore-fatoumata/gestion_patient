@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-3xl font-bold mb-4">Bienvenue, {{ auth()->guard('medecin')->user()->nom }}</h1>
    <p>Vous êtes connecté en tant que médecin.</p>
</div>
@endsection
